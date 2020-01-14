<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Support\Facades\Lang;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin\Customer;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ApiUrl;
use App\Helpers\Curl;

class CustomerController extends Controller
{
    private $curl;
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->curl->setAccessToken($request->cookie('authToken'));
        $response = $this->curl->httpGet(ApiUrl::$url.'customers');
        $response = json_decode($response, true);

        return view('admin.customers.index')
            ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $customer = $this->customerRepository->create($input);

        Flash::success('Customer saved successfully.');

        return redirect(route('admin.customers.index'));
    }

    /**
     * Display the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $res = $this->curl->httpGet(ApiUrl::$url.'customers/'. $id);
        $res =  json_decode($res, true);
        $response = $res['customer'];
        // var_dump($response);exit;
        if (empty($response)) {
            return redirect()->route('admin.customers.index')->withErrors(['error' => 'Customer not found']);
        }

        return view('admin.customers.show')->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $customer = $this->customerRepository->findWithoutFail($id);

        // if (empty($customer)) {
        //     Flash::error('Customer not found');

        //     return redirect(route('customers.index'));
        // }

        // return view('admin.customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // $customer = $this->customerRepository->findWithoutFail($id);



        // if (empty($customer)) {
        //     Flash::error('Customer not found');

        //     return redirect(route('customers.index'));
        // }

        // $customer = $this->customerRepository->update($request->all(), $id);

        // Flash::success('Customer updated successfully.');

        // return redirect(route('admin.customers.index'));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
        //   $error = '';
        //   $model = '';
        //   $confirm_route =  route('admin.customers.delete',['id'=>$id]);
        //   return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
        //    $sample = Customer::destroy($id);

        //    // Redirect to the group management page
        //    return redirect(route('admin.customers.index'))->with('success', Lang::get('message.success.delete'));

       }

}

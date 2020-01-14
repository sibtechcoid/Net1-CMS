<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Support\Facades\Lang;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin\ProductType;
use App\Models\Admin\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ApiUrl;
use App\Helpers\Curl;

class ProductTypeController extends Controller
{
    private $curl;
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * Display a listing of the ProductType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->curl->setAccessToken($request->cookie('authToken'));
        $response = $this->curl->httpGet(ApiUrl::$url.'productTypes');
        $response = json_decode($response, true);

        return view('admin.productTypes.index')
            ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for creating a new ProductType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.productTypes.create')->with('userInfo', User::getSlightInfo());
    }

    /**
     * Store a newly created ProductType in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $field = $request->validate([
            'product_type' => 'required'
        ]);

        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpPost(ApiUrl::$url.'productTypes', $field);
        $response = json_decode($response, true);
        if(is_array($response)) {
            if(array_key_exists('errors', $response)) {
                $message = "";
                foreach($response['errors'] as $errorKey => $errorValue) {
                    $message .= $errorValue[0] ."<br>";
                }

                return back()->withInput()->withErrors(['error' => $message]);
            }
            else if(array_key_exists('code', $response) && $response['code']==200) {
                // echo $response['access_token'];
                return redirect()->route('admin.productTypes.index');
            }
        }
        else if($response == 7) {
            return back()->withInput();
        }

        return redirect()->route('admin.products.index')->with('response', $response);
        // $productType = $this->productTypeRepository->create($input);

        // Flash::success('ProductType saved successfully.');

        // return redirect(route('admin.productTypes.index'));
    }

    /**
     * Display the specified ProductType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $productType = $this->productTypeRepository->findWithoutFail($id);

        // if (empty($productType)) {
        //     Flash::error('ProductType not found');

        //     return redirect(route('productTypes.index'));
        // }

        // return view('admin.productTypes.show')->with('productType', $productType);
    }

    /**
     * Show the form for editing the specified ProductType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $res = $this->curl->httpGet(ApiUrl::$url.'productTypes/'. $id);
        $res =  json_decode($res, true);
        $response['productType'] = $res['productType'];

        // echo "<pre>";var_dump($response);echo "</pre>";exit;

        if (empty($response['productType'])) {
            Flash::error('Product Type not found');

            return redirect()->route('productTypes.index');
        }

        return view('admin.productTypes.edit')->with('response', $response)->with('userInfo', User::getSlightInfo());
        // $productType = $this->productTypeRepository->findWithoutFail($id);

        // if (empty($productType)) {
        //     Flash::error('ProductType not found');

        //     return redirect(route('productTypes.index'));
        // }

        // return view('admin.productTypes.edit')->with('productType', $productType);
    }

    /**
     * Update the specified ProductType in storage.
     *
     * @param  int              $id
     * @param UpdateProductTypeRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $field = $request->validate([
            'product_type' => 'required'
        ]);

        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpPut(ApiUrl::$url.'productTypes/'.$id, $field);
        $response = json_decode($response, true);
        // var_dump($response);exit;
        if(is_array($response)) {
            if(array_key_exists('errors', $response)) {
                $message = "";
                foreach($response['errors'] as $errorKey => $errorValue) {
                    $message .= $errorValue[0] ."<br>";
                }

                return back()->withInput()->withErrors(['error' => $message]);
            }
            else if(array_key_exists('code', $response) && $response['code']==200) {
                // echo $response['access_token'];
                return redirect()->route('admin.productTypes.index');
            }
        }
        else if($response == 7) {
            return back()->withInput();
        }
        // $productType = $this->productTypeRepository->findWithoutFail($id);



        // if (empty($productType)) {
        //     Flash::error('ProductType not found');

        //     return redirect(route('productTypes.index'));
        // }

        // $productType = $this->productTypeRepository->update($request->all(), $id);

        // Flash::success('ProductType updated successfully.');

        // return redirect(route('admin.productTypes.index'));
    }

    /**
     * Remove the specified ProductType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
        //   $error = '';
        //   $model = '';
        //   $confirm_route =  route('admin.productTypes.delete',['id'=>$id]);
        //   return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
        //    $sample = ProductType::destroy($id);

        //    // Redirect to the group management page
        //    return redirect(route('admin.productTypes.index'))->with('success', Lang::get('message.success.delete'));

       }

}

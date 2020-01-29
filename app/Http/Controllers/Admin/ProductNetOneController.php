<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateProductNetOneRequest;
use App\Http\Requests\UpdateProductNetOneRequest;
use App\Repositories\ProductNetOneRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\ProductNetOne;
use GuzzleHttp\Client;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductNetOneController extends InfyOmBaseController
{
    /** @var  ProductNetOneRepository */
    private $productNetOneRepository;

    public function __construct(ProductNetOneRepository $productNetOneRepo)
    {
        $this->productNetOneRepository = $productNetOneRepo;
    }

    /**
     * Display a listing of the ProductNetOne.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->productNetOneRepository->pushCriteria(new RequestCriteria($request));
        $productNetOnes = $this->productNetOneRepository->all();
        return view('admin.productNetOnes.index')
            ->with('productNetOnes', $productNetOnes);
    }

    /**
     * Show the form for creating a new ProductNetOne.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.productNetOnes.create');
    }

    /**
     * Store a newly created ProductNetOne in storage.
     *
     * @param CreateProductNetOneRequest $request
     *
     * @return Response
     */
    public function store(CreateProductNetOneRequest $request)
    {
        $input = $request->all();

        $productNetOne = $this->productNetOneRepository->create($input);

        Flash::success('ProductNetOne saved successfully.');

        return redirect(route('admin.productNetOnes.index'));
    }

    /**
     * Display the specified ProductNetOne.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productNetOne = $this->productNetOneRepository->findWithoutFail($id);

        if (empty($productNetOne)) {
            Flash::error('ProductNetOne not found');

            return redirect(route('productNetOnes.index'));
        }

        return view('admin.productNetOnes.show')->with('productNetOne', $productNetOne);
    }

    /**
     * Show the form for editing the specified ProductNetOne.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productNetOne = $this->productNetOneRepository->findWithoutFail($id);

        if (empty($productNetOne)) {
            Flash::error('ProductNetOne not found');

            return redirect(route('productNetOnes.index'));
        }

        return view('admin.productNetOnes.edit')->with('productNetOne', $productNetOne);
    }

    /**
     * Update the specified ProductNetOne in storage.
     *
     * @param  int              $id
     * @param UpdateProductNetOneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductNetOneRequest $request)
    {
        $productNetOne = $this->productNetOneRepository->findWithoutFail($id);

        

        if (empty($productNetOne)) {
            Flash::error('ProductNetOne not found');

            return redirect(route('productNetOnes.index'));
        }

        $productNetOne = $this->productNetOneRepository->update($request->all(), $id);

        Flash::success('ProductNetOne updated successfully.');

        return redirect(route('admin.productNetOnes.index'));
    }

    /**
     * Remove the specified ProductNetOne from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.productNetOnes.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ProductNetOne::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.productNetOnes.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function reload()
       {
        $now = date('Y-m-d', strtotime('+20 years'));

            $data= [
                'data' => [''],
            ];

        $client = new Client([

                'auth' => [
                    'admin',
                    'admin'
                    ],

            'header' => [
                'content-type' => 'application/json;charset=UTF-8'],
                ]);

        $request = $client->request('POST','http://10.211.1.21:8000/v1/uat/getProductList',[
            'json' => $data,
        ]);

        $response = $request->getBody()->getContents();
        $result = json_decode($response,true);
        $p=$result['responseObject'];
        // dd($p);
        foreach($p as $mydata)
        {
            if (empty($mydata['description'])){
                $e=$mydata['description']='kosong';
                // echo $e;
        }else{
                 //call model for insert data      
            ProductNetOne::insert([
                    'offer_id' =>$mydata['offerID'],
                    'offer_name'=>$mydata['offerName'],
                    'display_name'=>$mydata['offerName'],
                    'description'=>$mydata['description'],
                    'charging_type'=>$mydata['chargingType'],
                    'offer_type'=>$mydata['offerType'],
                    'service_zone'=>$mydata['serviceZone'],
                     'validity_date'=>$now,
                    'total_price'=>$mydata['totalPrice']
            ]);}
            
            }
            return redirect(route('admin.productNetOnes.index'));
            
    }

       }

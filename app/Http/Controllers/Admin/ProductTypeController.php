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
// use App\Helpers\ApiUrl;
// use App\Helpers\Curl;
use GuzzleHttp\Client;


class ProductTypeController extends Controller
{
 

    /**
     * Display a listing of the ProductType.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
       
// ganti sama product list

$data= [
    'data' => [''],
];
$client = new Client([
    'auth' => [
        'admin',
         'admin'],
    'header' => [
        'content-type' => 'application/json;charset=UTF-8'],
       
    ]);
$request = $client->request('POST','http://10.211.1.21:8000/v1/uat/getProductList',[
    'json' => $data,
]);
$response = $request->getBody()->getContents();
$result = json_decode($response,true);
 $p=$result['responseObject'];
// $p=collect($result);
// dd($p);
foreach($p as $mydata)

    {
        //  echo $mydata['offerID'] . "\n";
        //  echo $mydata['offerName'];
         isset($mydata['description']) ? $mydata['description'] :  
         $e=$mydata['descripstion']='kosong'; 
     
        //  echo $mydata['chargingType'];
        // //  echo isset($mydata['chargingType']) ? $mydata['chargingType'] :  
        // //  $s=$mydata['chargingType']='kosong'; 
        //  echo $mydata['offerType'];
        //  echo $mydata['serviceZone'];
        //  echo $mydata['totalPrice'];
        
        //  if ($mydata['offerID']) {
        //      # code...
        //  } else {
        //      # code...
        //  }
         
         ProductType::insert([
            'offerID' =>$mydata['offerID'],
            'offerName'=>$mydata['offerName'],
            'description'=>$e,
            'chargingType'=>$mydata['chargingType'],
            'offerType'=>$mydata['offerType'],
            'serviceZone'=>$mydata['serviceZone'],
            'totalPrice'=>$mydata['totalPrice']
        ]);
        return view('admin.productTypes.index',['productlist'=>$mydata]);
    } 

  
// public function saveDB()
// {
//     $res = $this->$result;
//    $p= collect([$res]);
  
// dd($p);
//    foreach($p as $a=>$value){
//        echo $value;

//    }
// ->each(function ($resl,$key){
//     Productlist::insert([
//         'offerID' =>$resl[0]['responseObject']['offerID'],
//         'offerName'=>$resl[0]['responseObject']['offerName'],
//         'description'=>$resl[0]['responseObject']['description'],
//         'changingType'=>$resl[0]['responseObject']['changingType'],
//         'offerType'=>$resl[0]['responseObject']['offerType'],
//         'serviceZone'=>$resl[0]['responseObject']['serviceZone'],
//         'totalPrice'=>$resl[0]['responseObject']['totalPrice']
//     ]);
    // });
}


// return view('admin.productTypes.index')->with('product',$mydata);
        //     ->with('response', $response)->with('userInfo', User::getSlightInfo());
        // dd($result);
    
    
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
    public function show()
    {
        // $productType = $this->productTypeRepository->findWithoutFail($id);

        // if (empty($productType)) {
        //     Flash::error('ProductType not found');

        //     return redirect(route('productTypes.index'));
        // }
        $productlist = DB::table('productlist')->get();
        return view('admin.productTypes.show',['productType'=>$productlist]);
// $show = App\ProductType::all();
// return view('admin.productTypes.show')->with('productType', $show);
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

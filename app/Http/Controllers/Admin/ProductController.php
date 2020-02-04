<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Support\Facades\Lang;
use App\Models\User;
use App\Excel\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Excel\Imports\ProductsImport;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Client;
// use App\Http\Controllers\Admin\DB;
use App\Models\Admin\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Helpers\Curl;
// use App\Helpers\ApiUrl;


class ProductController extends Controller
{
    public function index()
    {
        $products = \DB::select('select * from product');
        return view('admin.products.index',['products'=>$products]); 
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return
     */
    public function create()
    {
        // $this->curl->setAccessToken(Cookie::get('authToken'));
        // $response = $this->curl->httpGet(ApiUrl::$url.'productTypes');
        // $response = json_decode($response, true);

        // return view('admin.products.create')
        //     ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param Request $request
     *
     * @return
     */
    public function store()
    {
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
        $p = $result['responseObject'];
        foreach($p as $mydata)
        {
            if ( isset($mydata['description'])== null){
                $e = $mydata['description']='null';
            }else{
                Product::insert([
                    'offer_id' =>$mydata['offerID'],
                    'offer_name'=>$mydata['offerName'],
                    'display_name'=>$mydata['offerName'],
                    'description'=>$e,
                    'charging_type'=>$mydata['chargingType'],
                    'offer_type'=>$mydata['offerType'],
                    'service_zone'=>$mydata['serviceZone'],
                    // 'validity_date'=>$mydata['serviceZone'],
                    'total_price'=>$mydata['totalPrice']
                ]);
            }
        }
        return redirect('admin/products');
    }

//     /**
//      * Display the specified Product.
//      *
//      * @param  int $id
//      *
//      * @return
//      */
    public function show()
    {
        $products = \DB::select('select * from product');
        return view('admin.products.index',['products'=>$products]);
        // $this->curl->setAccessToken(Cookie::get('authToken'));
        // $res = $this->curl->httpGet(ApiUrl::$url.'products/'. $id);
        // $res =  json_decode($res, true);
        // $response = $res['product'];

        // return view('admin.products.show')->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return
     */
    public function edit($id)
    {
        // echo "product_id: ". $id;exit;

        // $this->curl->setAccessToken(Cookie::get('authToken'));
        // $res = $this->curl->httpGet(ApiUrl::$url.'productTypes');
        // $res = json_decode($res, true);
        // $response['productTypes'] = $res['productTypes'];

        // $this->curl->setAccessToken(Cookie::get('authToken'));
        // $res = $this->curl->httpGet(ApiUrl::$url.'products/'. $id);
        // $res =  json_decode($res, true);
        // $response['product'] = $res['product'];

        // // echo "<pre>";var_dump($response);echo "</pre>";exit;

        // if (empty($response['product'])) {
        //     Flash::error('Product not found');

        //     return redirect()->route('products.index');
        // }

        return view('admin.products.edit');//->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return
     */
    public function update($id, Request $request)
    {
        $fields = $request->validate([
            'plan' => 'required',
            'product_type_id' => 'required|numeric',
            'product_name' => 'required',
            'product_speed' => 'required|numeric',
            'product_description' => 'required',
            'product_expiry_in_days' => 'required|numeric',
//            'publish' => 'boolean'
        ]);
//         var_dump($request->all());exit;

        if(!$request->hasAny('publish')) $fields['publish'] = false;
        else $fields['publish'] = true;

        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpPut(ApiUrl::$url.'products/'.$id, $fields);
        $response = json_decode($response, true);
//        var_dump($response);exit;
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
                return redirect()->route('admin.products.index');
            }
        }
        else if($response == 7) {
            return back()->withInput();
        }
    }

    public function getProduct($id) {
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpGet(ApiUrl::$url.'products/'.$id);
        $res =  json_decode($response, true);
        $response = $res['product'];

        return response()->json($res);
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return
     */
      public function getModalDelete($id = null)
      {
        //   $error = '';
        //   $model = '';
        //   $confirm_route =  route('admin.products.delete',['id'=>$id]);
        //   return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
        //    $sample = Product::destroy($id);

        //    // Redirect to the group management page
        //    return redirect(route('admin.products.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function uploadAsExcel(Request $request) {
        $request->validate([
            'productExcel' => 'required'
        ]);
        try {
//            $pathTemp = $request->file('productExcel')->store('temp');
//            $path = storage_path('app').'/'.$pathTemp;
            // echo "<h2>Excel File Name: <font style='font-weight:normal; font-size: 17px;'>'".$request->file('productExcel')->getClientOriginalName()."'</font></h2>";
            // echo "
            // <style>
            //     table {
            //       border-collapse: collapse;
            //     }

            //     table, th, td {
            //       border: 1px solid black;
            //     }
            // </style>";

            // echo "<table>";
            $import = Excel::import(new ProductsImport, $request->file('productExcel'));
            // return redirect('admin/products');
            // echo "</table>";
        //    var_dump($data);
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $exception) {
            $failures = $exception->failures();
            $error = [];
            foreach ($failures as $failure) {
                    $error['row'] .= $failure->row() ."<br>"; // row that went wrong
                    $error['attribute'] .= $failure->attribute() ."<br>"; // either heading key (if using heading row concern) or column index
                    // dd($failure);
                    foreach ($failure->error() as $value) {
                        $error['error'] .= $value ."<br>";
                    }
                }
            // dd($error);
            // exit;
            return back()->withErrors(['error' => $error]);
            // echo get_class($exception) ."<br>";
            // echo $exception->getCode() ."<br>";
            // echo $exception->getMessage();
        }
        return back();
       }

       public function downloadAsExcel() {
        return Excel::download(new ProductsExport, 'products.xlsx');
       }
       
}

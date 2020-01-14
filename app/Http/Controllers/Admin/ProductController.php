<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Support\Facades\Lang;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Excel\ProductsImport;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin\ProductType;
use App\Models\Admin\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Curl;
use App\Helpers\ApiUrl;


class ProductController extends Controller
{
    private $curl;
    public function __construct() {
        $this->curl = new Curl();
//        $this->curl->setAccessToken(Cookie::get('authToken'));
    }

    /**
     * Display a listing of the Product.
     *
     * @param
     * @return
     */
    public function index()
    {
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpGet(ApiUrl::$url.'products');
        $response = json_decode($response, true);

        return view('admin.products.index')
            ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return
     */
    public function create()
    {
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpGet(ApiUrl::$url.'productTypes');
        $response = json_decode($response, true);

        return view('admin.products.create')
            ->with('response', $response)->with('userInfo', User::getSlightInfo());
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param Request $request
     *
     * @return
     */
    public function store(Request $request)
    {
//        var_dump($request->all());
        $fields = $request->validate([
            'plan' => 'required|regex:/^[a-zA-Z]+$/u',
            'product_type_id' => 'required',
            'product_name' => 'required',
            'product_speed' => 'required',
            'product_description' => 'required',
            'product_expiry_in_days' => 'required|numeric',
            'zone_price_status' => 'required|boolean',
            'product_price' => 'nullable|numeric',
            'zone_prices.*' => 'nullable'
        ]);
        // dd($request->all());exit;
//        var_dump($fields);exit;
        $fields['insert_type'] = 'insert';
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpPost(ApiUrl::$url.'products', $fields);
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


        return redirect()->route('admin.products.index')->with('response', $response);
    }

    public function createZonePrice(Request $request)
    {
        $fields = $request->validate([
            'product_id' => 'required',
            'zone_id' => 'required',
            'zone_price' => 'required|numeric'
        ]);

        $this->curl->setAccessToken(Cookie::get('authToken'));
        $response = $this->curl->httpPost(ApiUrl::$url.'zonePrices', $fields);
        $response = json_decode($response, true);
        if(is_array($response)) {
            if(array_key_exists('errors', $response)) {
                $message = "";
                foreach($response['errors'] as $errorKey => $errorValue) {
                    $message .= $errorValue[0] ."<br>";
                }

                return response()->json(['errors' => $message]);
            }
            else if(array_key_exists('code', $response) && $response['code']==200) {
                return response()->json(['code' => 200, 'message' => 'success']);
            }
        }
        else if($response == 7) {
            return response(['code' => 500, 'message' => 'server down']);
        }

        return response()->json(['code' => 200,'message' => 'wrong ending']);
    }

    public function uploadProductExcel(Request $request)
    {
        $request->validate([
            'productExcel' => 'required'
        ]);
        try {
//            $pathTemp = $request->file('productExcel')->store('temp');
//            $path = storage_path('app').'/'.$pathTemp;
            echo "<h2>Excel File Name: <font style='font-weight:normal; font-size: 17px;'>'".$request->file('productExcel')->getClientOriginalName()."'</font></h2>";
            echo "
            <style>
                table {
                  border-collapse: collapse;
                }

                table, th, td {
                  border: 1px solid black;
                }
            </style>";

            echo "<table>";
            $data = Excel::import(new ProductsImport, $request->file('productExcel'));
            echo "</table>";
//            var_dump($data);
//            exit;
        }
        catch (\Exception $exception) {
            echo $exception;
        }
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return
     */
    public function show($id)
    {
        $this->curl->setAccessToken(Cookie::get('authToken'));
        $res = $this->curl->httpGet(ApiUrl::$url.'products/'. $id);
        $res =  json_decode($res, true);
        $response = $res['product'];

        return view('admin.products.show')->with('response', $response)->with('userInfo', User::getSlightInfo());
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

        $this->curl->setAccessToken(Cookie::get('authToken'));
        $res = $this->curl->httpGet(ApiUrl::$url.'productTypes');
        $res = json_decode($res, true);
        $response['productTypes'] = $res['productTypes'];

        $this->curl->setAccessToken(Cookie::get('authToken'));
        $res = $this->curl->httpGet(ApiUrl::$url.'products/'. $id);
        $res =  json_decode($res, true);
        $response['product'] = $res['product'];

        // echo "<pre>";var_dump($response);echo "</pre>";exit;

        if (empty($response['product'])) {
            Flash::error('Product not found');

            return redirect()->route('products.index');
        }

        return view('admin.products.edit')->with('response', $response)->with('userInfo', User::getSlightInfo());
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

}

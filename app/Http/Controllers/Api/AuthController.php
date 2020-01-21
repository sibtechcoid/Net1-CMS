<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Mail\CustomerLoginInfo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\ApiModels\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate(['login_type' => 'required|regex:/^[a-zA-Z]+$/u']);
        $user_id = 0;
        if($request->login_type == 'customer') {
            $request->validate([
                'msisdn' => 'required|numeric',
                'password' => 'required'
            ]);
            $user_id = \DB::table('customers')->select('id')->where('msisdn', $request->msisdn)->value('id');
            if($user_id) {
                $delete_old_tokens = \DB::statement(
                    "DELETE t1,t2 
                        FROM oauth_access_tokens t1 
                        LEFT JOIN oauth_refresh_tokens t2 
                        ON t1.id = t2.access_token_id 
                        WHERE t1.user_id=". $user_id ." AND t1.name IS NULL");
                if($delete_old_tokens) {
                    $request = Request::create('oauth/token', 'POST', [
                        'grant_type' => 'password',
                            'client_id' => 2,
                            'client_secret' => 'Ony8BNoGLaiUYSZpeYEa5gawZYIgj4qtbvVbk39w',
                            'username' => $request->msisdn,
                            'password' => $request->password
                    ]);
                
                    $response = app()->handle($request);
                    $response = json_decode($response->getContent(), true);
                    $response['code'] = 200;
                    return response()->json($response, $response['code']);
                }
            }
            else {
                $custom_error = ValidationException::withMessages([
                   'msisdn' => ['Customer account is not found. Please check your credentials'],
                ]);
                $response['message'] = $custom_error->getMessage();
                $response['errors'] = $custom_error->errors();
                $response['code'] = 401;
                return response()->json($response, $response['code']);
            }
        }
        if($request->login_type == 'admin') {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $loginData = [
                'email' => $request->email,
                'password' => $request->password
            ];
            $user = User::where('email', $request->email)->select(['id', 'password'])->first();

            if($user) {
                $delete_old_tokens = \DB::statement(
                    "DELETE t1,t2 
                        FROM oauth_access_tokens t1 
                        LEFT JOIN oauth_refresh_tokens t2 
                        ON t1.id = t2.access_token_id 
                        WHERE t1.user_id=". $user->id ." AND t1.name ='authToken'");
                if($delete_old_tokens && Hash::check($request->password, $user['password'])) {
                    $accessToken = $user->createToken('authToken');
                    return response()->json([
                        'token_type' => 'Bearer', 
                        'token_name' => $accessToken->token->name, 
                        'expires_at' => strtotime($accessToken->token->expires_at), 
                        'access_token' => $accessToken->accessToken
                    ], 200);
                }
                else {
                    $custom_error = ValidationException::withMessages([
                       'email_or_password' => ['User account is not found. Please check your credentials'],
                    ]);
                    $response['message'] = $custom_error->getMessage();
                    $response['errors'] = $custom_error->errors();
                    $response['code'] = 401;
                    return response()->json($response, $response['code']);
                }
            }
            else {
                $custom_error = ValidationException::withMessages([
                   'email_or_password' => ['User account is not found. Please check your credentials'],
                ]);
                $response['message'] = $custom_error->getMessage();
                $response['errors'] = $custom_error->errors();
                $response['code'] = 401;
                return response()->json($response, $response['code']);
            }
        }
    }

    /**
     * Method to create new customer in customerAccounts table
     * 
     * 
     */
    public function register(Request $request) {
        $response = [];
        $request->validate([
            'account_customer_segment' => 'required',
            'residence_type' => 'required',
            'customer_cis_to_category' => 'required',
            'customer_company_regnum' => 'required',
            'customer_id_type' => 'required',
            'customer_identity_no' => 'required',
            'msisdn' => 'required|numeric|unique:customers',
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'last_name' => 'regex:/^[a-zA-Z]+$/u|max:255',
            // 'nik' => 'required|numeric',
            'kk_number' => 'required|numeric',
            'email' => 'required|email|max:255',
            'address_one' => 'required',
            'mobile_number' => 'required|numeric',
            // 'password' => 'required|min:6',
            'device_id' => 'required',
            'preferred_language' => 'regex:/^[a-zA-Z]+$/u|min:2',
        ]);
        
        try {
            \DB::transaction(function () use ($request, &$response) {
                $account_name = $request->first_name;
                $last_name = null;
                $password = $this->stringRandomizer();
                if($request->has('last_name')) {
                    $last_name = $request->last_name;
                    $account_name .= ' '. $last_name;
                }
                $preferred_language = 'id';
                if ($request->has('preferred_language')) {
                    $preferred_language = $request->preferred_language;
                }
                $created_at = Carbon::now();
                $customer_id = 
                    \DB::table('customers')
                    ->insertGetId([
                        'msisdn' => $request->msisdn,
                        'account_customer_segment' => $request->account_customer_segment,
                        'residence_type' => $request->residence_type,
                        'customer_cis_to_category' => $request->customer_cis_to_category,
                        'customer_company_regnum' => $request->customer_company_regnum,
                        'customer_id_type' => $request->customer_id_type,
                        'customer_identity_no' => $request->customer_identity_no,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'password' => bcrypt($password),
                        'account_name' => $account_name,
                        'kk_number' => $request->kk_number,
                        'email' => $request->email,
                        'device_id' => $request->device_id,
                        'preferred_language' => $preferred_language,
                        'created_at' => $created_at,
                        'updated_at' => $created_at
                    ]);
               
                $contact_id = $this->insertCustomerAddress($customer_id, $request, $created_at);
                $address_id = $this->insertCustomerContact($customer_id, $request, $created_at);

                \DB::table('customer_balances')->insert([
                    'customer_id' => $customer_id,
                    'total_balance' => '0',
                    'balance_consumed' => '0',
                    'balance_available' => '0',
                    'created_at' => $created_at,
                    'updated_at' => $created_at
                ]);
                
                Mail::to($request->email)->send(new CustomerLoginInfo($request->msisdn, $password));
                $response['message'] = 'New Customer Account added.';
                $response['password'] = $password;
                $response['code'] = 200;
            });
        } catch (\Exception $e) {
            $custom_error = ValidationException::withMessages([
               'internal_server' => ['Failed to add new customer. Please try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }
        
        return response()->json($response);
    }

    private function insertCustomerAddress($custAcc_id, $request, $created_at) {
        $contactId = \DB::table('customer_contacts')->insertGetId([
            'customer_id' => $custAcc_id,
            'mobile_number' => $request->mobile_number,
            'phone_home' => '-',
            'phone_office' => '-',
            'fax_number' => '-',
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        return $contactId;
    }
    
    private function insertCustomerContact($custAcc_id, $request, $created_at) {
        $addressId = \DB::table('customer_addresses')->insertGetId([
            'customer_id' => $custAcc_id,
            'district_id' => '-',
            'city_id' => '-',
            'country_id' => '-',
            'state_id' => '-',
            'address_one' => $request->address_one,
            'house_number' => $request->house_number,
            'zip_postal_code' => '',
            'district' => '',
            'city' => '',
            'country' => '',
            'state' => '',
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
        return $addressId;
    }

    public function logout(Request $request) {
        /**
         * This method is to delete current access token and refresh token from db.
         */
        auth()->user()->token()->delete();
        \DB::table('oauth_refresh_tokens')->where('access_token_id', '=', auth()->user()->token()->id)->delete();
        $response['message'] = 'Logged out successfully.';
        $response['code'] = 200;
        return response()->json($response);
    }

    private function stringRandomizer($length = 8) 
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#*_';
        $chars_length = strlen($chars);
        $randomString = '';
        for($i=0; $i < $length; $i++) {
            $randomString .= $chars[rand(0, $chars_length-1)];
        }
        return $randomString;
    }
}

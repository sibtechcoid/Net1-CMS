<?php

namespace App\Http\Controllers\Api;

use App\CustomerAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerInfo extends Controller
{
    
    public function homeSummary() {
        
    }

    public function customerAccountDetail() {
        $customer_id = auth()->user()->token()->id;
        $customer_detail = \DB::table('customers')
            ->leftJoin('customer_addresses', 'customers.id', '=', 'customer_addresses.customer_id')
            ->leftJoin('customer_contacts', 'customers.id', '=', 'customer_contacts.customer_id')
            ->select(
                'customers.account_customer_segment',
                'customers.residence_type',
                'customers.msisdn',
                'customers.account_name',
                'customers.customer_cis_to_category',
                'customers.customer_company_regnum',
                'customers.customer_id_type',
                'customers.customer_identity_no',
                'customers.first_name',
                'customers.last_name',
                'customers.kk_number',
                'customers.email',
                'customers.preferred_language',
                'customer_addresses.address_one',
                'customer_addresses.address_two',
                'customer_addresses.house_number',
                'customer_addresses.zip_postal_code',
                'customer_addresses.district',
                'customer_addresses.city',
                'customer_addresses.country',
                'customer_addresses.state',
                'customer_addresses.created_at as customer_addresses_created_at',
                'customer_addresses.updated_at as customer_addresses_updated_at',
                'customer_contacts.mobile_number',
                'customer_contacts.phone_home',
                'customer_contacts.phone_office',
                'customer_contacts.fax_number',
                'customer_contacts.created_at as customer_contacts_created_at',
                'customer_contacts.updated_at as customer_contacts_updated_at',
                )
            ->first();
            $response['customerDetail'] = $customer_detail;
            $response['code'] = 200;
        return response()->json($response);
    }
}

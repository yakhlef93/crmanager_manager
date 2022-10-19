<?php

namespace App\Http\Controllers;

use App\Models\CustomerBlackListCustomer;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Resources\CustomerBlackListCustomerResource;

class CustomerBlackListCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()   
    {
        $blacklistcustomers = CustomerBlackListCustomer::whereHas('customer', function($query){
            $query->where('global_black_list','enabled');
        })->WithFilters()->WithPagination();
        return CustomerBlackListCustomerResource::collection($blacklistcustomers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::where('account_id', $request->request_code)->first();
        $blacklistcustomer = CustomerBlackListCustomer::create(
            array_merge(
                    $request->all(),
                    ['customer_id' => $customer->id]
                )
        );
        return new CustomerBlackListCustomerResource($blacklistcustomer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerBlackListCustomer  $customerBlackListCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerBlackListCustomer $customerBlackListCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerBlackListCustomer  $customerBlackListCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerBlackListCustomer $customerBlackListCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerBlackListCustomer  $customerBlackListCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerBlackListCustomer $customerBlackListCustomer)
    {
        //$customerBlackListCustomer->update($request->all())
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerBlackListCustomer  $customerBlackListCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $customer = Customer::where('account_id', $request->request_code)->first();
        if($customer)
            CustomerBlackListCustomer::where('cin_number',$request->cin_number)->where('customer_id', $customer->id)->delete();
    }
}

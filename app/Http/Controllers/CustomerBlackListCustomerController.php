<?php

namespace App\Http\Controllers;

use App\Models\CustomerBlackListCustomer;
use Illuminate\Http\Request;

class CustomerBlackListCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $blacklistcustomers = Customer::WithFilters()->WithPagination();
            return [ 'blacklistcustomers'=>$blacklistcustomers];
        }
        return view('blacklistcustomers.index');
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
        CustomerBlackListCustomer::create(
            array_merge(
                    $request->all(),
                    ['customer_id' => $customer->id]
                )
        );
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerBlackListCustomer  $customerBlackListCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerBlackListCustomer $customerBlackListCustomer)
    {
        //
    }
}

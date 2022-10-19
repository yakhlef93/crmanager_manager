<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $customers = Customer::WithFilters()->WithPagination();
            $filter_customers = Customer::select('id','last_name','first_name')->get();
            return [ 'customers'=>$customers, 'filter_customers'=>$filter_customers];
        }
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $last = Customer::orderBy('id', 'DESC')->first();
        $id = '01';
        if($last){
            $last = substr($last->account_id, 0, 2);
            $id = intval($last)+1; 
            $id = sprintf("%02d", $id);
        }
        $customer = Customer::create(
            array_merge(
                    $request->all(),
                    ['account_id' => $id.sprintf("%02d", date('d')).strtoupper(substr($request->first_name, 0, 1)) . sprintf("%02d", date('m')).strtoupper(substr($request->last_name, 0, 1)). date('y')]
                )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customer->load('blacklistcustomers');
        return view('customers.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
    }
    public function remote_update(Request $request)
    {
        $customer = Customer::where('account_id', $request->request_code)->first();
        if($customer)
            $customer->update($request->all());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // $customer->blacklistcustomers()->delete();
        $customer->delete();
    }
}

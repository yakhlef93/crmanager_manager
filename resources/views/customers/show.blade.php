@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-print-none">{{ __('Client') }} 
                    <a href="/customers" class="btn btn-sm btn-outline-secondary float-right"><i class="fas fa-long-arrow-alt-left"></i> Retour</a>
                    <a href="{{'/customers/'.$customer->id.'/edit'}}" class="btn btn-sm btn-warning mx-2 float-right"><i class="fas fa-pen"></i> Editer</a>
                </div>
                <div class="card-body">
                    <flash message=""></flash>
                    <show-customer :contract_badged_status="{{json_encode(__('contracts.badged_status'))}}" :customer="{{$customer}}" :badged_status="{{json_encode(__('customers.badged_status'))}}" :revenue_solde="'{{ $RevenueSolde }}'"></show-customer>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    @media print {
    html, body {
        height:100% !important; 
        margin: 0 !important; 
        padding: 0 !important;
        overflow: hidden !important;
      }
}
</style>
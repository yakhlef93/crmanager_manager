@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Clients') }} 
                    <a href="{{route('customers.create')}}" class="btn btn-sm btn-primary float-right ml-2">Nouveau Client</a>
                    <a href="/customers_black_list" class="btn btn-sm btn-outline-dark float-right ml-2"><i class="fas fa-list"></i> Liste Noire</a>
                    <a href="/tiers" class="btn btn-sm btn-outline-dark float-right"><i class="fas fa-users-cog"></i> Tiers</a>
                </div>

                <div class="card-body">
                    <flash message=""></flash>
                    <customers :badged_status="{{json_encode(__('customers.badged_status'))}}" :options_status="{{json_encode(__('customers.options_status'))}}"></customers>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
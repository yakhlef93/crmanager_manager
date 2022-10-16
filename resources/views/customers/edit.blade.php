@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Editer Client') }} <a href="/customers" class="btn btn-sm btn-outline-primary float-right"><i class="fas fa-long-arrow-alt-left"></i> Retour</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <flash message=""></flash>
                    <edit-customer :customer="{{$customer}}" :options_status="{{json_encode(__('customers.options_status'))}}"></edit-customer>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
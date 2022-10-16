@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Nouveau Client') }} <a href="/customers" class="btn btn-sm btn-outline-primary float-right"><i class="fas fa-long-arrow-alt-left"></i> Retour</a></div>

                <div class="card-body">
                    <flash message=""></flash>
                    <new-customer></new-customer>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
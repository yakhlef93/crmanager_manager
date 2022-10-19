@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Black List') }}
                </div>

                <div class="card-body">
                    <flash message=""></flash>
                    <black-customers></black-customers>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('partials.sidebar')
        <a href="{{ url()->previous() }}" class="mt-1 btn btn-outline-primary btn-block">Go Back</a>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Create a User</div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    {{ csrf_field() }}
                    @include('helpers.input', ['fieldName' => 'email', 'fieldType' => 'email', 'fieldTitle' => 'Email Address'])
                    @include('helpers.input', ['fieldName' => 'name', 'fieldTitle' => 'Full Name'])
                    @include('helpers.input', ['fieldName' => 'password', 'fieldType' => 'password', 'fieldTitle' => 'Password'])
                    @include('helpers.input', ['fieldName' => 'password_confirmation', 'fieldType' => 'password', 'fieldTitle' => 'Confirm'])
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <input type="submit" class="btn btn-success btn-block" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

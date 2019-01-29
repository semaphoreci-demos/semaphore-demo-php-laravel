@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('partials.sidebar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h3>Welcome, {{ auth()->user()->name }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection

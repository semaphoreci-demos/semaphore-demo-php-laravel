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
                <a href="{{ route('users.create') }}" id="add-user-button" class="btn btn-success">Add New</a>
                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th>{{$user->id}}</th>
                                <th>{{$user->name}}</th>
                                <th>{{$user->email}}</th>
                                <th>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
                                        Edit
                                    </a>
                                    <a href="{{ route('users.destroy', $user->id) }}"
                                       onclick="
                                               event.preventDefault();
                                               document.getElementById('delete-form-{{$user->id}}').submit();"
                                       class="btn btn-danger">
                                        Delete
                                    </a>
                                    <form id="delete-form-{{$user->id}}"
                                          action="{{ route('users.destroy', $user->id) }}"
                                          method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.homelayout')

@section('content')

<div class="container mt-2">

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD</h2>
            </div>
            <div class="pull-right mb-2">
                @if(Auth::user()->role === 'admin')
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create Users</a>
                @endif
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Role</th>
            <th>User Name</th>
            <th>User Email</th>
            @if(Auth::user()->role === 'admin')
            <th width="280px">Action</th>
            @endif
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                    @if(Auth::user()->role === 'admin')
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @endif
   
                    @csrf
                    @method('DELETE')
                    @if(Auth::user()->role === 'admin')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Want to Delete this User Attachment?')">Delete</button>
                    @endif
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection
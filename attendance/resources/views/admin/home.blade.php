@extends('layouts.app')

@section('main-content')
    <div>
        <h3>Welcome to the Admin Dashboard</h3>
        <a href="{{ route('admin.userlist') }}" class="text-black">User Management</a>
        <a href="#">Course Management</a>
    </div>
@endsection

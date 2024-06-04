@extends('layouts.app')

@section('main-content')
    @if ($pendingUsers->isEmpty())
        <div class="alert alert-info" role="alert">
            No pending users.
        </div>       
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingUsers as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->pendingUserDetail->firstname }}</td>
                    <td>{{ $user->pendingUserDetail->lastname }}</td>
                    <td>{{ $user->pendingUserDetail->dob }}</td>
                    <td>{{ $user->pendingUserDetail->gender == '1' ? 'Male' : 'Female' }}</td>
                    <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#selectRoleModal" data-user-id="{{ $user->id }}">Approve</button>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @include('admin.modal.selectrole')
@endsection

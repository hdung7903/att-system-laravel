@extends('layouts.app')

@section('main-content')
    <div class="my-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selectionModal">Import Users</button>
        <button class="btn btn-info">Exports Users</button>
        <a href="{{ route('admin.pending') }}" class="btn btn-primary position-relative">
            Pending user request
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                {{ $pending == 0 ? 'hidden' : '' }}>
                {{ $pending }}
            </span>
        </a>
    </div>
    <table class="table table-bordered">
        <thead class="text-center">
            <th>No.</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Account Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($userList as $index => $user)
                <tr class="text-center">
                    <td class="w-2">{{ $index + 1 }}</td>
                    <td class="w-2">{{ $user['firstname'] ?? 'N/A' }} {{ $user['lastname'] ?? 'N/A' }}</td>
                    <td class="w-2">
                        @foreach ($user['roles'] as $role)
                            <p>{{ ucfirst($role) }}</p>
                        @endforeach
                    </td>
                    <td class="w-2">{{ $user['email'] }}</td>
                    <td class="w-2">{{ $user['status'] }}</td>
                    <td class="gap-2 align-item-start">
                        <a href="{{ route('admin.userdetails', $user['id']) }}" class="btn btn-primary">View Details</a>
                        @if ($user['status'] == 'Active')
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-user-id="{{ $user['id'] }}">Delete</button>
                        @elseif($user['status'] == 'Inactive')
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#restoreModal"
                                data-user-id="{{ $user['id'] }}">Restore</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.modal.addselection')
    @include('admin.modal.selectfile')
    @include('admin.modal.deleteselection')
    @include('admin.modal.restore')
@endsection

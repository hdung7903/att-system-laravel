@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Todo List</h1>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add a new task
            </button>
        </div>
        <p>Filter:</p>
        <form method="get" action="{{ route('todolist.filter') }}">
            <div class="my-3 d-flex gap-2">
                <label for="searchDate">Date</label>
                <select class="form-select" id="searchDate" name="searchDate">
                    <option value="" disabled selected>Choose a day</option>
                    @php
                        $collection = collect($todoLists);
                        $days = $collection->unique(function ($item) {
                            return $item->datetime->format('Y-m-d');
                        });
                    @endphp
                    @foreach ($days as $day)
                        <option value="{{ $day->datetime->format('Y-m-d') }}">
                            {{ $day->datetime->format('d-m-Y') }}
                        </option>
                    @endforeach
                </select>
                <label for="searchStatus">Status</label>
                <select class="form-select" id="searchStatus" name="searchStatus">
                    <option value="all">All</option>
                    <option value="0">Not Finished</option>
                    <option value="1">Finished</option>
                </select>
                <label for="searchTitle">Title</label>
                <input type="text" id="searchTitle" name="searchTitle" />
                <button type="submit" class="btn btn-primary">Find</button>
            </div>
        </form>
        <div>
            <table class="table table-border">
                <thead>
                    <th>Date</th>
                    <th>Your Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($todoLists as $todoList)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($todoList->datetime)->format('d-m-Y H:i') }}</td>
                            <td>{{ $todoList->title }}</td>
                            <td>{!! $todoList->status
                                ? '<span class="badge rounded-pill text-bg-success">Finished</span>'
                                : '<span class="badge rounded-pill text-bg-danger">Not Finished</span>' !!}</td>
                            <td class="">
                                <form action="{{ route('todolist.toggleStatus', $todoList->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @php
                                        $taskDateTime = \Carbon\Carbon::parse($todoList->datetime);
                                        $currentDateTime = \Carbon\Carbon::now();
                                    @endphp
                                    <button type="submit" class="btn btn-warning me-2"
                                        {{ $taskDateTime->isFuture() ? '' : 'disabled' }}>
                                        {{ $todoList->status ? 'Mark as Incomplete' : 'Mark as Complete' }}
                                    </button>
                                </form>
                                <button type="button"
                                    class="btn btn-primary me-2 {{ $taskDateTime->isFuture() ? '' : 'disabled' }}"
                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                    Edit Details
                                </button>
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                    data-id="{{ $todoList->id }}" data-bs-target="#checkConfirmation">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('todolist.add')
    @include('todolist.edit')
    @include('todolist.checkConfirm')
@endsection

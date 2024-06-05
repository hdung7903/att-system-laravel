@extends('layouts.app')

@section('main-content')
    <div>
        <label for="fromDate">From:</label>
        <input type="date" id="fromDate" name="fromDate" class="form-control" />
        <label for="toDate">To:</label>
        <input type="date" id="toDate" name="toDate" class="form-control" />
        <table>
            <thead>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $dates??'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

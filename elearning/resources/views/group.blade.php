<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <a href="{{ route('add_student') }}" class="my-3 text-decoration-none btn btn-primary">Add Student</a>
        <input type="hidden" value="{{ request('id') }}" id="group" name="group" />
        <table class="table table-striped table-border">
            <thead>
                <th>No.</th>
                <th>First Name</th>
                <th>Second Name</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($result as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>{{ $student->gender === 1 ? 'Male' : 'Female' }}</td>
                        <td>{{ $student->dob->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-danger" data-bs-toggle=modal data-bs-target=#confirmModal
                                data-id="{{ $student->id }}">
                                Remove Student
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>
@include('modal.confirm')

</html>

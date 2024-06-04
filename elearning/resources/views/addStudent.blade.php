<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <div>
            <form method="get" action="{{ route('list_add_student') }}">
                <label for="group">Select a group</label>
                <select id="group" name="group" value=>
                    <option disabled selected value>
                        -- select an option --
                    </option>
                    @foreach ($groups as $class)
                        <option value="{{ $class->id }}" {{ request('group') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <div>
            @if (!empty($result))
                <form method="post" action="{{ route('add_student') }}">
                    @csrf
                    <input type="hidden" name="group" value="{{ request('group') }}" />
                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @foreach ($result as $student)
                                <tr>
                                    <td>{{ $student->firstname . ' ' . $student->lastname }}</td>
                                    <td>
                                        <input type="checkbox" name="students[]" value="{{ $student->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit">Add Student</button>
                </form>
            @else
                <p>Please choose a class to show the list</p>
            @endif
        </div>
    </div>
</body>

</html>

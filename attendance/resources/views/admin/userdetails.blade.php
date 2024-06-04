@extends('layouts.app')

@section('main-content')
    <a href="{{ route('admin.userlist') }}" class="text-black">Back</a>
    <div class="row">
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img src="https://avatars.githubusercontent.com/u/113019393?s=400&v=4" class="card-img-top" alt="user_image">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p>Major: Software Engineering</p>
                    <p>at FPT University</p>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card" style="max-width: 100%,width:auto">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    @foreach ($details as $detail)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" value="{{ $detail['firstname'] }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" value="{{ $detail['lastname'] }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $detail['email'] }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <input type="text" class="form-control" id="gender"
                                    value="{{ $detail['gender'] == '1' ? 'Male' : 'Female' }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="text" class="form-control" id="dob"
                                    value="{{ Carbon\Carbon::parse($detail['dob'])->format('d-m-Y') }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="roles" class="form-label">Roles</label>
                                <input type="text" class="form-control" id="roles"
                                    value="{{ implode(', ', array_map('ucfirst', $detail['roles'])) }}" disabled>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

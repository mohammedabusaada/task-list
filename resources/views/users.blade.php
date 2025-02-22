@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1>User List App</h1>
        <div class="offset-md-2 col-md-8">
            <div class="card">

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                
                @if(isset($user))
                    <div class="card-header">
                        Update User
                    </div>
                    <div class="card-body">
                        <!-- Update User Form -->
                        <form action="{{ url('/users/update/' . $user->id) }}" method="POST">

                            @csrf

                            <!-- User Name -->
                            <div class="mb-3">
                                <label for="user-name" class="form-label">User</label>
                                <input type="text" name="name" id="user-name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="user-email" class="form-label">Email</label>
                                <input type="email" name="email" id="user-email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" name="password" id="user-password" class="form-control">
                            </div>

                            <!-- Update User Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-2"></i> Update User
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        New User
                    </div>
                    <div class="card-body">
                        
                        

                        <!-- New User Form -->
                        <form action="{{ url('/users/addUser') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user-name" class="form-label">User</label>
                                <input type="text" name="name" id="user-name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="user-email" class="form-label">Email</label>
                                <input type="email" name="email" id="user-email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" name="password" id="user-password" class="form-control">
                            </div>

                            <!-- Add User Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i> Add User
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Current Users -->
            <div class="card mt-4">
                <div class="card-header">
                    Current Users
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                    <form action="{{ url('/users/delete/' . $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash me-2"></i> Delete
                                        </button>
                                    </form>


                                        <a href="{{ url('/users/edit/' . $user->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit me-2"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout/layout')

@section('content')

    <!------main-content-start----------->

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">

                    <div class="table-title">
                        <div class="row">
                            <div class="flex p-0 col-sm-6 justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Manage Users</h2>
                            </div>
                            <div class="flex p-0 col-sm-6 justify-content-lg-end justify-content-center">
                                <a href="#addUserModal" class="btn btn-success" data-toggle="modal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Add New User</span>
                                </a>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><span class="custom-checkbox">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($users as $data)
                                <tr>
                                    <th><span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox1" name="option[]" value="1">
                                            <label for="checkbox1"></label></th>

                                    <th>{{ $data->id }}</th>
                                    <th>{{ $data->name }}</th>
                                    <th>{{ $data->email }}</th>
                                    <th>{{ $data->role->role_name }}</th>

                                    <th>
                                        <a href="#editUserModal" class="edit" data-toggle="modal"
                                            data-id="{{ $data->id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>

                                        <a href="#deleteUserModal" class="delete" data-toggle="modal"
                                            data-id="{{ $data->id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </th>

                                </tr>


                            @empty
                                <tr>
                                    <td colspan="6">No record found</td>
                                </tr>
                            @endforelse

                        </tbody>


                    </table>

                    {{ $users->links() }}


                </div>
            </div>


            <!----add-modal start--------->
            <div class="modal fade" tabindex="-1" id="addUserModal" role="dialog">
                <div class="modal-dialog" role="document">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p style="color:red;">{{ $error }}</p>
                        @endforeach
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Users</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label><br>
                                    <input type="text" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label><br>
                                    <input type="email" name="email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label><br>
                                    <input type="password" name="password" placeholder="Enter Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Retype Password</label><br>
                                    <input type="password" name="password_confirmation" placeholder="Enter Confirm Password"
                                        required>
                                </div>
                                {{-- <div class="form-group">
       <label>Department</label><br>
       <select name="role_id" required class="form-control" style="border: 1px solid;">
        <option value="">Select Role</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
        @endforeach
    </select>
     </div> --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="Add">
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <!----add-modal end--------->





            <!----edit-modal start--------->
            <div class="modal fade" tabindex="-1" id="editUserModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('editUser') }}" method="POST">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="userId" id="userId">

                                <div class="form-group">
                                    <label>Name</label><br>
                                    <input type="text" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label><br>
                                    <input type="email" name="email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label><br>
                                    <input type="password" name="password" placeholder="Enter Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Retype Password</label><br>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Enter Confirm Password" required>
                                </div>

                                {{-- <div class="form-group">
    <label>Department</label><br>
    <select name="role_id" required class="form-control" style="border: 1px solid;">
     <option value="">Select Role</option>
     @foreach ($roles as $role)
         <option value="{{ $role->id }}">{{ $role->role_name }}</option>
     @endforeach
 </select>
  </div> --}}
                                {{-- uncomment this for update user from here --}}

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!----edit-modal end--------->


            <!----delete-modal start--------->
            <div class="modal fade" tabindex="-1" id="deleteUserModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('deleteUser') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <input type="hidden" name="user" id="user">

                            <div class="modal-body">
                                <p>Are you sure you want to delete this Records</p>
                                <p class="text-warning"><small>this action Cannot be Undone,</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="DELETE"></input>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!----delete-modal end--------->

        </div>
    </div>

    <!------main-content-end----------->

@endsection

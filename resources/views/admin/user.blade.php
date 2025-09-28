@extends('layout/layout')

@section('content')
    <div class="main-content" data-entity="users">
        <div class="row">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->hasBag('bulkUsers'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->bulkUsers->all() as $bulkError)
                                <li>{{ $bulkError }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="flex p-0 col-sm-6 justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Manage Users</h2>
                            </div>
                            <div class="flex p-0 col-sm-6 justify-content-lg-end justify-content-center">
                                <button type="button" class="btn btn-danger mr-2" id="bulkDeleteUsersButton">
                                    <i class="material-icons">&#xE15C;</i>
                                    <span>Bulk Delete</span>
                                </button>
                                <a href="#addUserModal" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Add New User</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="selectAllUsers" class="select-all-checkbox">
                                        <label for="selectAllUsers"></label>
                                    </span>
                                </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr data-row-id="{{ $user->id }}">
                                    <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="user-checkbox-{{ $user->id }}" class="row-checkbox user-row-checkbox"
                                                value="{{ $user->id }}">
                                            <label for="user-checkbox-{{ $user->id }}"></label>
                                        </span>
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ optional($user->role)->role_name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="#editUserModal" class="edit edit-user-trigger" data-toggle="modal"
                                            data-target="#editUserModal" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                            data-role-id="{{ $user->role_id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <a href="#deleteUserModal" class="delete delete-user-trigger" data-toggle="modal"
                                            data-target="#deleteUserModal" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </td>
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
        </div>

        <!-- Add user modal -->
        <div class="modal fade" tabindex="-1" id="addUserModal" role="dialog" aria-labelledby="addUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('addUser') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="add-user-name">Name</label>
                                <input type="text" id="add-user-name" name="name" class="form-control"
                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name', 'addUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="add-user-email">Email</label>
                                <input type="email" id="add-user-email" name="email" class="form-control"
                                    placeholder="Enter Email" value="{{ old('email') }}" required>
                                @error('email', 'addUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="add-user-password">Password</label>
                                <input type="password" id="add-user-password" name="password" class="form-control"
                                    placeholder="Enter Password" required>
                                @error('password', 'addUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="add-user-password-confirmation">Confirm Password</label>
                                <input type="password" id="add-user-password-confirmation" name="password_confirmation"
                                    class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group">
                                <label for="add-user-role">Department</label>
                                <select id="add-user-role" name="role_id" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ (string) old('role_id') === (string) $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id', 'addUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit user modal -->
        <div class="modal fade" tabindex="-1" id="editUserModal" role="dialog" aria-labelledby="editUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('editUser') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="edit-user-id" value="{{ old('user_id') }}">

                            <div class="form-group">
                                <label for="edit-user-name">Name</label>
                                <input type="text" id="edit-user-name" name="name" class="form-control"
                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name', 'editUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="edit-user-email">Email</label>
                                <input type="email" id="edit-user-email" name="email" class="form-control"
                                    placeholder="Enter Email" value="{{ old('email') }}" required>
                                @error('email', 'editUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="edit-user-password">Password <span class="text-muted">(leave blank to keep
                                        current)</span></label>
                                <input type="password" id="edit-user-password" name="password" class="form-control"
                                    placeholder="Enter New Password">
                                @error('password', 'editUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="edit-user-password-confirmation">Confirm Password</label>
                                <input type="password" id="edit-user-password-confirmation"
                                    name="password_confirmation" class="form-control" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="edit-user-role">Department</label>
                                <select id="edit-user-role" name="role_id" class="form-control">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ (string) old('role_id') === (string) $role->id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id', 'editUser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete user modal -->
        <div class="modal fade" tabindex="-1" id="deleteUserModal" role="dialog" aria-labelledby="deleteUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('deleteUser') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="delete-user-id" value="{{ old('user_id') }}">
                            <p id="delete-user-message">Are you sure you want to delete this record?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk delete users modal -->
        <div class="modal fade" tabindex="-1" id="bulkDeleteUsersModal" role="dialog"
            aria-labelledby="bulkDeleteUsersModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('bulkDeleteUsers') }}" method="POST" id="bulkDeleteUsersForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bulkDeleteUsersModalLabel">Delete Users</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="bulk-delete-users-message">Are you sure you want to delete the selected users?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <div id="bulk-delete-users-inputs"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Selected</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

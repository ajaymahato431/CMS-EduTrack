@extends('layout/layout')

@section('page_title', 'Manage Users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@section('content')
<div class="main-content" data-entity="users">
    {{-- Alerts --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="material-icons mr-2 text-success">check_circle</i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="material-icons mr-2 text-danger">error</i>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if ($errors->hasBag('bulkUsers'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
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

    {{-- Filter Toolbar --}}
    <div class="filter-card">
        <form action="{{ route('AdminUsers') }}" method="GET" class="row align-items-center">
            <div class="col-md-5 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;">
                            <i class="material-icons text-muted" style="font-size: 18px;">search</i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0" placeholder="Search by name or email..." value="{{ request('search') }}" style="border-radius: 0 8px 8px 0;">
                </div>
            </div>
            <div class="col-md-4 mb-2 mb-md-0">
                <select name="role_id" class="form-control">
                    <option value="">All Departments / Roles</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->role_name) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex" style="gap: 8px;">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; font-weight: 500;">
                    Filter
                </button>
                @if(request('search') || request('role_id'))
                <a href="{{ route('AdminUsers') }}" class="btn btn-light" style="border-radius: 8px;" title="Reset Filters">
                    <i class="material-icons" style="font-size: 18px; vertical-align: middle;">refresh</i>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Data Table Card --}}
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="mb-0">System Users Directory</h2>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
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

        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAllUsers" class="select-all-checkbox">
                                <label for="selectAllUsers"></label>
                            </span>
                        </th>
                        <th style="width: 60px;">ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Department / Role</th>
                        <th style="width: 120px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr data-row-id="{{ $user->id }}">
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="user-checkbox-{{ $user->id }}"
                                    class="row-checkbox user-row-checkbox" value="{{ $user->id }}">
                                <label for="user-checkbox-{{ $user->id }}"></label>
                            </span>
                        </td>
                        <td class="text-muted">#{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="user-avatar-sm">
                                <div class="font-weight-bold" style="color: #1e293b;">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td>
                            @php
                                $roleName = strtolower(optional($user->role)->role_name ?? 'user');
                            @endphp
                            <span class="badge-role badge-role-{{ in_array($roleName, ['admin', 'teacher', 'student']) ? $roleName : 'default' }}">
                                <i class="material-icons" style="font-size: 13px;">
                                    {{ $roleName === 'admin' ? 'security' : ($roleName === 'teacher' ? 'school' : 'person') }}
                                </i>
                                {{ optional($user->role)->role_name ?? 'Unassigned' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="#quickRoleModal" class="btn-action btn-action-role quick-role-trigger" data-toggle="modal"
                                data-target="#quickRoleModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                data-role-id="{{ $user->role_id }}" title="Change Role">
                                <i class="material-icons" style="font-size: 18px;">manage_accounts</i>
                            </a>
                            <a href="#editUserModal" class="btn-action btn-action-edit edit-user-trigger" data-toggle="modal"
                                data-target="#editUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}" data-role-id="{{ $user->role_id }}" title="Edit Details">
                                <i class="material-icons" style="font-size: 18px;">edit</i>
                            </a>
                            <a href="#deleteUserModal" class="btn-action btn-action-delete delete-user-trigger" data-toggle="modal"
                                data-target="#deleteUserModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" title="Delete User">
                                <i class="material-icons" style="font-size: 18px;">delete</i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="material-icons">people_outline</i>
                                <h5>No Users Found</h5>
                                <p>No users matched your current search and filter criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 d-flex justify-content-between align-items-center flex-wrap">
            <div class="text-muted small">
                Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Modals --}}

    {{-- Add User Modal --}}
    <div class="modal fade" tabindex="-1" id="addUserModal" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('addUser') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="form-group">
                            <label for="add-user-name" class="font-weight-bold text-muted small">Full Name</label>
                            <input type="text" id="add-user-name" name="name" class="form-control"
                                placeholder="e.g. John Doe" value="{{ old('name') }}" required>
                            @error('name', 'addUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-user-email" class="font-weight-bold text-muted small">Email Address</label>
                            <input type="email" id="add-user-email" name="email" class="form-control"
                                placeholder="name@domain.com" value="{{ old('email') }}" required>
                            @error('email', 'addUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-user-password" class="font-weight-bold text-muted small">Password</label>
                            <input type="password" id="add-user-password" name="password" class="form-control"
                                placeholder="Minimum 6 characters" required>
                            @error('password', 'addUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-user-password-confirmation" class="font-weight-bold text-muted small">Confirm Password</label>
                            <input type="password" id="add-user-password-confirmation" name="password_confirmation"
                                class="form-control" placeholder="Re-type password" required>
                        </div>
                        <div class="form-group mb-0">
                            <label for="add-user-role" class="font-weight-bold text-muted small">Department / Role</label>
                            <select id="add-user-role" name="role_id" class="form-control" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ (string) old('role_id')===(string) $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->role_name) }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id', 'addUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">Create User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit User Modal --}}
    <div class="modal fade" tabindex="-1" id="editUserModal" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('editUser') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="editUserModalLabel">Edit User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="user_id" id="edit-user-id" value="{{ old('user_id') }}">

                        <div class="form-group">
                            <label for="edit-user-name" class="font-weight-bold text-muted small">Full Name</label>
                            <input type="text" id="edit-user-name" name="name" class="form-control"
                                placeholder="Enter Name" value="{{ old('name') }}" required>
                            @error('name', 'editUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-user-email" class="font-weight-bold text-muted small">Email Address</label>
                            <input type="email" id="edit-user-email" name="email" class="form-control"
                                placeholder="Enter Email" value="{{ old('email') }}" required>
                            @error('email', 'editUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-user-password" class="font-weight-bold text-muted small">Password <span class="text-muted font-weight-normal">(leave blank to keep current)</span></label>
                            <input type="password" id="edit-user-password" name="password" class="form-control"
                                placeholder="New password">
                            @error('password', 'editUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-user-password-confirmation" class="font-weight-bold text-muted small">Confirm Password</label>
                            <input type="password" id="edit-user-password-confirmation" name="password_confirmation"
                                class="form-control" placeholder="Confirm new password">
                        </div>
                        <div class="form-group mb-0">
                            <label for="edit-user-role" class="font-weight-bold text-muted small">Department / Role</label>
                            <select id="edit-user-role" name="role_id" class="form-control">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ (string) old('role_id')===(string) $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->role_name) }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id', 'editUser')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Quick Role Change Modal --}}
    <div class="modal fade" tabindex="-1" id="quickRoleModal" role="dialog" aria-labelledby="quickRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <form action="{{ route('updateRole') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="quickRoleModalLabel">Change Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="user_id" id="quick-role-user-id">
                        <p class="text-muted small mb-2">Selected User: <strong id="quick-role-user-name" class="text-dark"></strong></p>
                        <div class="form-group mb-0">
                            <label for="quick-role-select" class="font-weight-bold text-muted small">Assign Role</label>
                            <select id="quick-role-select" name="role_id" class="form-control" required>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->role_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-3">Update Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete User Modal --}}
    <div class="modal fade" tabindex="-1" id="deleteUserModal" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('deleteUser') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold text-danger" id="deleteUserModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="user_id" id="delete-user-id" value="{{ old('user_id') }}">
                        <p id="delete-user-message" class="mb-1 text-dark">Are you sure you want to delete this user?</p>
                        <small class="text-muted">This action is irreversible and will remove all user privileges.</small>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Delete User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bulk Delete Users Modal --}}
    <div class="modal fade" tabindex="-1" id="bulkDeleteUsersModal" role="dialog" aria-labelledby="bulkDeleteUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('bulkDeleteUsers') }}" method="POST" id="bulkDeleteUsersForm">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold text-danger" id="bulkDeleteUsersModalLabel">Delete Multiple Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <p id="bulk-delete-users-message" class="mb-1 text-dark">Are you sure you want to delete the selected users?</p>
                        <small class="text-muted">This action cannot be undone for the selected accounts.</small>
                        <div id="bulk-delete-users-inputs"></div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Delete Selected</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#quickRoleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var name = button.data('name');
            var roleId = button.data('role-id');

            var modal = $(this);
            modal.find('#quick-role-user-id').val(userId);
            modal.find('#quick-role-user-name').text(name);
            modal.find('#quick-role-select').val(roleId);
        });
    });
</script>
@endpush

@extends('layout/layout')

@section('page_title', 'Role Management & Permissions')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Roles</li>
@endsection

@section('content')
<div class="main-content">
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

    {{-- Role Summary KPI Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-primary mb-0">
                <div class="stat-info">
                    <div class="stat-label">Non-Admin Users</div>
                    <div class="stat-value">{{ $roleCounts['total'] ?? 0 }}</div>
                    <p class="stat-subtext">Manageable accounts</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">people</i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-info mb-0">
                <div class="stat-info">
                    <div class="stat-label">Teachers</div>
                    <div class="stat-value">{{ $roleCounts['teachers'] ?? 0 }}</div>
                    <p class="stat-subtext">Instructor privileges</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">school</i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-success mb-0">
                <div class="stat-info">
                    <div class="stat-label">Students</div>
                    <div class="stat-value">{{ $roleCounts['students'] ?? 0 }}</div>
                    <p class="stat-subtext">Learner privileges</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">person</i>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Role Reassignment Card --}}
    <div class="content-card mb-4">
        <div class="content-card-header">
            <h5 class="content-card-title">
                <i class="material-icons text-primary">manage_accounts</i>
                Quick Role Assignment
            </h5>
        </div>
        <div class="content-card-body">
            <form action="{{ route('updateRole') }}" method="POST" class="row align-items-end">
                @csrf
                <div class="col-md-5 mb-3 mb-md-0">
                    <label class="font-weight-bold text-muted small">Select User</label>
                    <select name="user_id" required class="form-control">
                        <option value="">-- Choose User --</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">
                                {{ $u->name }} ({{ $u->email }}) &bull; Current: {{ $u->role?->role_name ?? 'None' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="font-weight-bold text-muted small">New Role</label>
                    <select name="role_id" required class="form-control">
                        <option value="">-- Choose Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->role_name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; height: 40px; font-weight: 500;">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Search & Filter Toolbar --}}
    <div class="filter-card">
        <form action="{{ route('manageRole') }}" method="GET" class="row align-items-center">
            <div class="col-md-6 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;">
                            <i class="material-icons text-muted" style="font-size: 18px;">search</i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0" placeholder="Search user by name or email..." value="{{ request('search') }}" style="border-radius: 0 8px 8px 0;">
                </div>
            </div>
            <div class="col-md-4 mb-2 mb-md-0">
                <select name="role_id" class="form-control">
                    <option value="">All Roles</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->role_name) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex" style="gap: 8px;">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; font-weight: 500;">
                    Filter
                </button>
                @if(request('search') || request('role_id'))
                <a href="{{ route('manageRole') }}" class="btn btn-light" style="border-radius: 8px;" title="Reset Filters">
                    <i class="material-icons" style="font-size: 18px; vertical-align: middle;">refresh</i>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Role Audit Table --}}
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="mb-0">User Role Audit Directory</h2>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <span class="badge badge-light px-3 py-2 text-dark font-weight-normal" style="border-radius: 20px;">
                        Showing active permissions
                    </span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th>Joined Date</th>
                        <th style="width: 220px;" class="text-center">Modify Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
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
                                    {{ $roleName === 'teacher' ? 'school' : 'person' }}
                                </i>
                                {{ optional($user->role)->role_name ?? 'Unassigned' }}
                            </span>
                        </td>
                        <td class="text-muted" style="font-size: 13px;">
                            {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('updateRole') }}" method="POST" class="d-inline-flex align-items-center" style="gap: 6px;">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <select name="role_id" class="form-control form-control-sm" style="width: 120px; border-radius: 6px; font-size: 13px;">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->role_name) }}
                                    </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;" title="Apply Role Change">
                                    <i class="material-icons" style="font-size: 16px; vertical-align: middle;">check</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="material-icons">manage_accounts</i>
                                <h5>No Users Found</h5>
                                <p>No non-admin accounts match your search query.</p>
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
</div>
@endsection

@extends('layout/layout')

@section('page_title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<div class="dashboard-wrapper">
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

    {{-- 4 KPI Metric Cards --}}
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-primary">
                <div class="stat-info">
                    <div class="stat-label">Total Students</div>
                    <div class="stat-value">{{ number_format($totalStudents) }}</div>
                    <p class="stat-subtext">Registered learners</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">school</i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-info">
                <div class="stat-info">
                    <div class="stat-label">Total Teachers</div>
                    <div class="stat-value">{{ number_format($totalTeachers) }}</div>
                    <p class="stat-subtext">Faculty members</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">supervisor_account</i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-warning">
                <div class="stat-info">
                    <div class="stat-label">Total Courses</div>
                    <div class="stat-value">{{ number_format($totalCourses) }}</div>
                    <p class="stat-subtext">Active academic programs</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">menu_book</i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card stat-success">
                <div class="stat-info">
                    <div class="stat-label">Fee Collection</div>
                    <div class="stat-value">Rs. {{ number_format($totalCollectedFee) }}</div>
                    <p class="stat-subtext">Total revenue to date</p>
                </div>
                <div class="stat-icon">
                    <i class="material-icons">payments</i>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="row">
        {{-- Left Section: Tables & Activity --}}
        <div class="col-lg-8">
            {{-- Recent Students Card --}}
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="material-icons text-primary">person_add</i>
                        Recent Enrollments
                    </h5>
                    <a href="/admin/students" class="btn btn-sm btn-outline-primary" style="border-radius: 20px; font-weight: 500;">
                        View All
                    </a>
                </div>
                <div class="p-0 table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="thead-light" style="background: #f8fafc; font-size: 13px;">
                            <tr>
                                <th>Student</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Paid Fee</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $student)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2 font-weight-bold" style="color: #1e293b;">{{ $student->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-gender badge-gender-{{ $student->sex }}">
                                        {{ ucfirst($student->sex) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-light border" style="font-weight: 500;">
                                        {{ $student->course->course_name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-fee">Rs. {{ number_format($student->paid_fee) }}</span>
                                </td>
                                <td class="text-muted" style="font-size: 13px;">
                                    {{ $student->phone }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No student enrollments found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Recent Courses Card --}}
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="material-icons text-warning">local_library</i>
                        Featured Courses
                    </h5>
                    <a href="/admin/course" class="btn btn-sm btn-outline-warning" style="border-radius: 20px; font-weight: 500;">
                        Manage Courses
                    </a>
                </div>
                <div class="p-0 table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light" style="background: #f8fafc; font-size: 13px;">
                            <tr>
                                <th>Course Title</th>
                                <th>Credit Hours</th>
                                <th>Course Fee</th>
                                <th>Enrolled Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCourses as $course)
                            <tr>
                                <td class="font-weight-bold" style="color: #1e293b;">
                                    {{ $course->course_name }}
                                </td>
                                <td>
                                    <span class="badge badge-light border">{{ $course->credit_hours }} Hours</span>
                                </td>
                                <td>
                                    <span class="badge-fee">Rs. {{ number_format($course->fee) }}</span>
                                </td>
                                <td>
                                    <span class="badge-count">{{ $course->students_count }} Students</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    No courses configured yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right Section: Profile Card & Quick Actions --}}
        <div class="col-lg-4">
            {{-- Admin Profile Card --}}
            <div class="content-card text-center mb-4">
                <div class="content-card-body pt-4">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="user-avatar-lg">
                    </div>
                    <h5 class="font-weight-bold mb-1" style="color: #1e293b;">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small mb-2">{{ Auth::user()->email }}</p>
                    <div class="mb-3">
                        <span class="badge-role badge-role-admin">
                            <i class="material-icons" style="font-size: 14px;">verified_user</i>
                            Administrator
                        </span>
                    </div>

                    <div class="d-flex flex-column gap-2 mt-4" style="gap: 8px;">
                        <button class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#updateProfileModal" style="border-radius: 8px;">
                            <i class="material-icons mr-1" style="font-size: 16px; vertical-align: middle;">photo_camera</i>
                            Change Profile Photo
                        </button>
                        <button class="btn btn-outline-secondary btn-sm btn-block" data-toggle="modal" data-target="#updateNameModal" style="border-radius: 8px;">
                            <i class="material-icons mr-1" style="font-size: 16px; vertical-align: middle;">edit</i>
                            Update Full Name
                        </button>
                        <button class="btn btn-outline-secondary btn-sm btn-block" data-toggle="modal" data-target="#updatePasswordModal" style="border-radius: 8px;">
                            <i class="material-icons mr-1" style="font-size: 16px; vertical-align: middle;">lock</i>
                            Change Password
                        </button>
                    </div>
                </div>
            </div>

            {{-- Quick Navigation Actions --}}
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="material-icons text-info">flash_on</i>
                        Quick Actions
                    </h5>
                </div>
                <div class="content-card-body p-3">
                    <a href="/admin/users" class="quick-action-link">
                        <div class="quick-action-icon" style="background: #eef2ff; color: #4f46e5;">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div>
                            <div class="font-weight-bold" style="font-size: 14px;">Manage Users</div>
                            <small class="text-muted">Create or modify platform users</small>
                        </div>
                    </a>

                    <a href="/admin/manage-role" class="quick-action-link">
                        <div class="quick-action-icon" style="background: #fef3c7; color: #f59e0b;">
                            <i class="material-icons">manage_accounts</i>
                        </div>
                        <div>
                            <div class="font-weight-bold" style="font-size: 14px;">Role Permissions</div>
                            <small class="text-muted">Promote or change user roles</small>
                        </div>
                    </a>

                    <a href="/admin/course" class="quick-action-link">
                        <div class="quick-action-icon" style="background: #e0f2fe; color: #0ea5e9;">
                            <i class="material-icons">add_box</i>
                        </div>
                        <div>
                            <div class="font-weight-bold" style="font-size: 14px;">Add New Course</div>
                            <small class="text-muted">Define curriculum and tuition fee</small>
                        </div>
                    </a>

                    <a href="/admin/students" class="quick-action-link mb-0">
                        <div class="quick-action-icon" style="background: #dcfce7; color: #10b981;">
                            <i class="material-icons">how_to_reg</i>
                        </div>
                        <div>
                            <div class="font-weight-bold" style="font-size: 14px;">Enroll Student</div>
                            <small class="text-muted">Register student into a course</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modals Section --}}
<div class="modal fade" tabindex="-1" id="updateNameModal" role="dialog" aria-labelledby="updateNameModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('updateName') }}" method="POST">
            @csrf
            <div class="modal-content shadow border-0" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title font-weight-bold" id="updateNameModalTitle">Edit Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-muted small">Full Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Name" required>
                        @error('name', 'updateName')
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

<div class="modal fade" tabindex="-1" id="updatePasswordModal" role="dialog" aria-labelledby="updatePasswordModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('updatePassword') }}" method="POST">
            @csrf
            <div class="modal-content shadow border-0" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title font-weight-bold" id="updatePasswordModalTitle">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <div class="form-group">
                        <label class="font-weight-bold text-muted small">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters" required>
                        @error('password', 'updatePassword')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-muted small">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Re-type new password" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Update Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="updateProfileModal" role="dialog" aria-labelledby="updateProfileModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content shadow border-0" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title font-weight-bold" id="updateProfileModalTitle">Update Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-muted small">Select Photo (JPEG, PNG, JPG, max 2MB)</label>
                        <input type="file" name="image" class="form-control-file" accept="image/jpeg,image/png,image/jpg" required>
                        @error('image', 'updateProfile')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Upload Photo</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        @if ($errors->updateName->any())
            $('#updateNameModal').modal('show');
        @endif

        @if ($errors->updatePassword->any())
            $('#updatePasswordModal').modal('show');
        @endif

        @if ($errors->updateProfile->any())
            $('#updateProfileModal').modal('show');
        @endif
    });
</script>
@endpush

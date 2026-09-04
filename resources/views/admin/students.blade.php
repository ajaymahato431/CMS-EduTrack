@extends('layout/layout')

@section('page_title', 'Manage Students')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Students</li>
@endsection

@section('content')
<div class="main-content" data-entity="students">
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

    @if ($errors->hasBag('bulkStudents'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
        <ul class="mb-0">
            @foreach ($errors->bulkStudents->all() as $bulkError)
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
        <form action="{{ route('admin.students') }}" method="GET" class="row align-items-center">
            <div class="col-md-5 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;">
                            <i class="material-icons text-muted" style="font-size: 18px;">search</i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0" placeholder="Search by name, phone, address..." value="{{ request('search') }}" style="border-radius: 0 8px 8px 0;">
                </div>
            </div>
            <div class="col-md-4 mb-2 mb-md-0">
                <select name="course_id" class="form-control">
                    <option value="">All Enrolled Courses</option>
                    @foreach ($courses as $courseOption)
                    <option value="{{ $courseOption->id }}" {{ request('course_id') == $courseOption->id ? 'selected' : '' }}>
                        {{ $courseOption->course_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex" style="gap: 8px;">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; font-weight: 500;">
                    Filter Students
                </button>
                @if(request('search') || request('course_id'))
                <a href="{{ route('admin.students') }}" class="btn btn-light" style="border-radius: 8px;" title="Reset Filters">
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
                    <h2 class="mb-0">Student Enrollment Directory</h2>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <button type="button" class="btn btn-danger mr-2" id="bulkDeleteStudentsButton">
                        <i class="material-icons">&#xE15C;</i>
                        <span>Bulk Delete</span>
                    </button>
                    <a href="#addStudentModal" class="btn btn-success" data-toggle="modal" data-target="#addStudentModal">
                        <i class="material-icons">&#xE147;</i>
                        <span>Add New Student</span>
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
                                <input type="checkbox" id="selectAllStudents" class="select-all-checkbox">
                                <label for="selectAllStudents"></label>
                            </span>
                        </th>
                        <th style="width: 60px;">ID</th>
                        <th>Student Name</th>
                        <th>Sex</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Enrolled Course</th>
                        <th>Paid Fee</th>
                        <th style="width: 100px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr data-row-id="{{ $student->id }}">
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="student-checkbox-{{ $student->id }}"
                                    class="row-checkbox student-row-checkbox" value="{{ $student->id }}">
                                <label for="student-checkbox-{{ $student->id }}"></label>
                            </span>
                        </td>
                        <td class="text-muted">#{{ $student->id }}</td>
                        <td>
                            <div class="font-weight-bold" style="color: #1e293b; font-size: 14px;">
                                {{ $student->name }}
                            </div>
                        </td>
                        <td>
                            <span class="badge-gender badge-gender-{{ $student->sex }}">
                                {{ ucfirst($student->sex) }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $student->phone }}</td>
                        <td class="text-muted">{{ $student->address }}</td>
                        <td>
                            <span class="badge badge-light border" style="font-weight: 500;">
                                {{ optional($student->course)->course_name ?? 'Unassigned' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-fee">Rs. {{ number_format($student->paid_fee) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="#editStudentModal" class="btn-action btn-action-edit edit-student-trigger" data-toggle="modal"
                                data-target="#editStudentModal" data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}" data-sex="{{ $student->sex }}"
                                data-phone="{{ $student->phone }}" data-address="{{ $student->address }}"
                                data-course-id="{{ $student->course_id }}" data-fee="{{ $student->paid_fee }}" title="Edit Student">
                                <i class="material-icons" style="font-size: 18px;">edit</i>
                            </a>
                            <a href="#deleteStudentModal" class="btn-action btn-action-delete delete-student-trigger" data-toggle="modal"
                                data-target="#deleteStudentModal" data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}" title="Delete Student">
                                <i class="material-icons" style="font-size: 18px;">delete</i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <i class="material-icons">school</i>
                                <h5>No Students Found</h5>
                                <p>No student records match your search or filter selection.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 d-flex justify-content-between align-items-center flex-wrap">
            <div class="text-muted small">
                Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} students
            </div>
            <div>
                {{ $students->links() }}
            </div>
        </div>
    </div>

    {{-- Modals --}}

    {{-- Add Student Modal --}}
    <div class="modal fade" tabindex="-1" id="addStudentModal" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('addStudent') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="addStudentModalLabel">Enroll New Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="form-group">
                            <label for="add-student-name" class="font-weight-bold text-muted small">Full Name</label>
                            <input type="text" id="add-student-name" name="name" class="form-control"
                                placeholder="Student Full Name" value="{{ old('name') }}" required>
                            @error('name', 'addStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-student-sex" class="font-weight-bold text-muted small">Gender</label>
                            <select id="add-student-sex" name="sex" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('sex')==='male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex')==='female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('sex')==='other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('sex', 'addStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-student-phone" class="font-weight-bold text-muted small">Phone Number</label>
                            <input type="text" id="add-student-phone" name="phone" class="form-control"
                                placeholder="e.g. 9800000000" value="{{ old('phone') }}" required>
                            @error('phone', 'addStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-student-address" class="font-weight-bold text-muted small">Residential Address</label>
                            <input type="text" id="add-student-address" name="address" class="form-control"
                                placeholder="City / Address" value="{{ old('address') }}" required>
                            @error('address', 'addStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-student-course" class="font-weight-bold text-muted small">Select Course</label>
                            <select id="add-student-course" name="course_id" class="form-control" required>
                                <option value="">Choose Course</option>
                                @foreach ($courses as $courseOption)
                                <option value="{{ $courseOption->id }}" {{ (string) old('course_id')===(string) $courseOption->id ? 'selected' : '' }}>
                                    {{ $courseOption->course_name }} (Fee: Rs. {{ number_format($courseOption->fee) }})
                                </option>
                                @endforeach
                            </select>
                            @error('course_id', 'addStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="add-student-fee" class="font-weight-bold text-muted small">Paid Fee (Rs.)</label>
                            <input type="number" id="add-student-fee" name="paid_fee" class="form-control"
                                placeholder="Amount deposited in Rs." value="{{ old('paid_fee') }}" min="0" required>
                            @error('paid_fee', 'addStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">Register Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Student Modal --}}
    <div class="modal fade" tabindex="-1" id="editStudentModal" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('editStudent') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="editStudentModalLabel">Edit Student Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="student_id" id="edit-student-id" value="{{ old('student_id') }}">

                        <div class="form-group">
                            <label for="edit-student-name" class="font-weight-bold text-muted small">Full Name</label>
                            <input type="text" id="edit-student-name" name="name" class="form-control"
                                placeholder="Enter Name" value="{{ old('name') }}" required>
                            @error('name', 'editStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-student-sex" class="font-weight-bold text-muted small">Gender</label>
                            <select id="edit-student-sex" name="sex" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('sex')==='male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex')==='female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('sex')==='other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('sex', 'editStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-student-phone" class="font-weight-bold text-muted small">Phone Number</label>
                            <input type="text" id="edit-student-phone" name="phone" class="form-control"
                                placeholder="Enter Phone" value="{{ old('phone') }}" required>
                            @error('phone', 'editStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-student-address" class="font-weight-bold text-muted small">Address</label>
                            <input type="text" id="edit-student-address" name="address" class="form-control"
                                placeholder="Enter Address" value="{{ old('address') }}" required>
                            @error('address', 'editStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-student-course" class="font-weight-bold text-muted small">Enrolled Course</label>
                            <select id="edit-student-course" name="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach ($courses as $courseOption)
                                <option value="{{ $courseOption->id }}" {{ (string) old('course_id')===(string) $courseOption->id ? 'selected' : '' }}>
                                    {{ $courseOption->course_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('course_id', 'editStudent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="edit-student-fee" class="font-weight-bold text-muted small">Paid Fee (Rs.)</label>
                            <input type="number" id="edit-student-fee" name="paid_fee" class="form-control"
                                placeholder="Enter Paid Fee" value="{{ old('paid_fee') }}" min="0" required>
                            @error('paid_fee', 'editStudent')
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

    {{-- Delete Student Modal --}}
    <div class="modal fade" tabindex="-1" id="deleteStudentModal" role="dialog" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('deleteStudent') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold text-danger" id="deleteStudentModalLabel">Delete Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="student_id" id="delete-student-id" value="{{ old('student_id') }}">
                        <p id="delete-student-message" class="mb-1 text-dark">Are you sure you want to delete this student?</p>
                        <small class="text-muted">This action will remove the student enrollment record permanently.</small>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Delete Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bulk Delete Students Modal --}}
    <div class="modal fade" tabindex="-1" id="bulkDeleteStudentsModal" role="dialog" aria-labelledby="bulkDeleteStudentsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('bulkDeleteStudents') }}" method="POST" id="bulkDeleteStudentsForm">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold text-danger" id="bulkDeleteStudentsModalLabel">Delete Selected Students</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <p id="bulk-delete-students-message" class="mb-1 text-dark">Are you sure you want to delete the selected students?</p>
                        <small class="text-muted">This action cannot be undone.</small>
                        <div id="bulk-delete-students-inputs"></div>
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

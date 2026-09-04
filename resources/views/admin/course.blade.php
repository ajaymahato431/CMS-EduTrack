@extends('layout/layout')

@section('page_title', 'Manage Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Courses</li>
@endsection

@section('content')
<div class="main-content" data-entity="courses">
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

    @if ($errors->hasBag('bulkCourses'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
        <ul class="mb-0">
            @foreach ($errors->bulkCourses->all() as $bulkError)
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
        <form action="{{ route('admin.course') }}" method="GET" class="row align-items-center">
            <div class="col-md-9 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;">
                            <i class="material-icons text-muted" style="font-size: 18px;">search</i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0" placeholder="Search by course name..." value="{{ request('search') }}" style="border-radius: 0 8px 8px 0;">
                </div>
            </div>
            <div class="col-md-3 d-flex" style="gap: 8px;">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 8px; font-weight: 500;">
                    Search Courses
                </button>
                @if(request('search'))
                <a href="{{ route('admin.course') }}" class="btn btn-light" style="border-radius: 8px;" title="Reset Search">
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
                    <h2 class="mb-0">Academic Courses Directory</h2>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <button type="button" class="btn btn-danger mr-2" id="bulkDeleteCoursesButton">
                        <i class="material-icons">&#xE15C;</i>
                        <span>Bulk Delete</span>
                    </button>
                    <a href="#addCourseModal" class="btn btn-success" data-toggle="modal" data-target="#addCourseModal">
                        <i class="material-icons">&#xE147;</i>
                        <span>Add New Course</span>
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
                                <input type="checkbox" id="selectAllCourses" class="select-all-checkbox">
                                <label for="selectAllCourses"></label>
                            </span>
                        </th>
                        <th style="width: 60px;">ID</th>
                        <th>Course Title</th>
                        <th>Credit Hours</th>
                        <th>Tuition Fee</th>
                        <th>Students Enrolled</th>
                        <th style="width: 100px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                    <tr data-row-id="{{ $course->id }}">
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="course-checkbox-{{ $course->id }}"
                                    class="row-checkbox course-row-checkbox" value="{{ $course->id }}">
                                <label for="course-checkbox-{{ $course->id }}"></label>
                            </span>
                        </td>
                        <td class="text-muted">#{{ $course->id }}</td>
                        <td>
                            <div class="font-weight-bold" style="color: #1e293b; font-size: 14px;">
                                {{ $course->course_name }}
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-light border" style="font-weight: 500;">
                                {{ $course->credit_hours }} {{ $course->credit_hours == 1 ? 'Hour' : 'Hours' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-fee">Rs. {{ number_format($course->fee) }}</span>
                        </td>
                        <td>
                            <span class="badge-count">{{ $course->students_count ?? $course->students()->count() }} Students</span>
                        </td>
                        <td class="text-center">
                            <a href="#editCourseModal" class="btn-action btn-action-edit edit-course-trigger" data-toggle="modal"
                                data-target="#editCourseModal" data-id="{{ $course->id }}"
                                data-name="{{ $course->course_name }}"
                                data-credit-hours="{{ $course->credit_hours }}"
                                data-fee="{{ $course->fee }}" title="Edit Course">
                                <i class="material-icons" style="font-size: 18px;">edit</i>
                            </a>
                            <a href="#deleteCourseModal" class="btn-action btn-action-delete delete-course-trigger" data-toggle="modal"
                                data-target="#deleteCourseModal" data-id="{{ $course->id }}"
                                data-name="{{ $course->course_name }}" title="Delete Course">
                                <i class="material-icons" style="font-size: 18px;">delete</i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="material-icons">menu_book</i>
                                <h5>No Courses Found</h5>
                                <p>No academic courses match your search criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 d-flex justify-content-between align-items-center flex-wrap">
            <div class="text-muted small">
                Showing {{ $courses->firstItem() ?? 0 }} to {{ $courses->lastItem() ?? 0 }} of {{ $courses->total() }} courses
            </div>
            <div>
                {{ $courses->links() }}
            </div>
        </div>
    </div>

    {{-- Modals --}}

    {{-- Add Course Modal --}}
    <div class="modal fade" tabindex="-1" id="addCourseModal" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('addCourse') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="addCourseModalLabel">Add New Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="form-group">
                            <label for="add-course-name" class="font-weight-bold text-muted small">Course Title</label>
                            <input type="text" id="add-course-name" name="course_name" class="form-control"
                                placeholder="e.g. Advanced Web Development" value="{{ old('course_name') }}" required>
                            @error('course_name', 'addCourse')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="add-course-credit-hours" class="font-weight-bold text-muted small">Credit Hours</label>
                            <input type="number" id="add-course-credit-hours" name="credit_hours"
                                class="form-control" placeholder="e.g. 3"
                                value="{{ old('credit_hours') }}" min="1" required>
                            @error('credit_hours', 'addCourse')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="add-course-fee" class="font-weight-bold text-muted small">Tuition Fee (Rs.)</label>
                            <input type="number" id="add-course-fee" name="fee" class="form-control"
                                placeholder="e.g. 2500" value="{{ old('fee') }}" min="0" required>
                            @error('fee', 'addCourse')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">Create Course</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Course Modal --}}
    <div class="modal fade" tabindex="-1" id="editCourseModal" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('editCourse') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold" id="editCourseModalLabel">Edit Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="course_id" id="edit-course-id" value="{{ old('course_id') }}">

                        <div class="form-group">
                            <label for="edit-course-name" class="font-weight-bold text-muted small">Course Title</label>
                            <input type="text" id="edit-course-name" name="course_name" class="form-control"
                                placeholder="Enter Course Name" value="{{ old('course_name') }}" required>
                            @error('course_name', 'editCourse')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="edit-course-credit-hours" class="font-weight-bold text-muted small">Credit Hours</label>
                            <input type="number" id="edit-course-credit-hours" name="credit_hours"
                                class="form-control" placeholder="Enter Credit Hours"
                                value="{{ old('credit_hours') }}" min="1" required>
                            @error('credit_hours', 'editCourse')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="edit-course-fee" class="font-weight-bold text-muted small">Tuition Fee (Rs.)</label>
                            <input type="number" id="edit-course-fee" name="fee" class="form-control"
                                placeholder="Enter Course Fee" value="{{ old('fee') }}" min="0" required>
                            @error('fee', 'editCourse')
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

    {{-- Delete Course Modal --}}
    <div class="modal fade" tabindex="-1" id="deleteCourseModal" role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('deleteCourse') }}" method="POST">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold text-danger" id="deleteCourseModalLabel">Delete Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <input type="hidden" name="course_id" id="delete-course-id" value="{{ old('course_id') }}">
                        <p id="delete-course-message" class="mb-1 text-dark">Are you sure you want to delete this course?</p>
                        <small class="text-muted">This action will also affect students enrolled in this course.</small>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Delete Course</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bulk Delete Courses Modal --}}
    <div class="modal fade" tabindex="-1" id="bulkDeleteCoursesModal" role="dialog" aria-labelledby="bulkDeleteCoursesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('bulkDeleteCourses') }}" method="POST" id="bulkDeleteCoursesForm">
                @csrf
                <div class="modal-content shadow border-0" style="border-radius: 12px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title font-weight-bold text-danger" id="bulkDeleteCoursesModalLabel">Delete Selected Courses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-3">
                        <p id="bulk-delete-courses-message" class="mb-1 text-dark">Are you sure you want to delete the selected courses?</p>
                        <small class="text-muted">This action cannot be undone.</small>
                        <div id="bulk-delete-courses-inputs"></div>
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

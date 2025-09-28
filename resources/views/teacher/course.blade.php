@extends('layout/layout')

@section('content')
    <div class="main-content" data-entity="teacher-courses">
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

                @if ($errors->hasBag('tBulkCourses'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->tBulkCourses->all() as $bulkError)
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
                                <h2 class="ml-lg-2">Manage Courses</h2>
                            </div>
                            <div class="flex p-0 col-sm-6 justify-content-lg-end justify-content-center">
                                <button type="button" class="btn btn-danger mr-2" id="teacherBulkDeleteCoursesButton">
                                    <i class="material-icons">&#xE15C;</i>
                                    <span>Bulk Delete</span>
                                </button>
                                <a href="#addCourseModal" class="btn btn-success" data-toggle="modal"
                                    data-target="#addCourseModal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Add New Course</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="teacherSelectAllCourses" class="select-all-checkbox">
                                        <label for="teacherSelectAllCourses"></label>
                                    </span>
                                </th>
                                <th>ID</th>
                                <th>Course Name</th>
                                <th>Credit Hours</th>
                                <th>Course Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $course)
                                <tr data-row-id="{{ $course->id }}">
                                    <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="teacher-course-checkbox-{{ $course->id }}"
                                                class="row-checkbox teacher-course-row-checkbox"
                                                value="{{ $course->id }}">
                                            <label for="teacher-course-checkbox-{{ $course->id }}"></label>
                                        </span>
                                    </td>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->course_name }}</td>
                                    <td>{{ $course->credit_hours }}</td>
                                    <td>{{ $course->fee }}</td>
                                    <td>
                                        <a href="#editCourseModal" class="edit teacher-edit-course-trigger" data-toggle="modal"
                                            data-target="#editCourseModal" data-id="{{ $course->id }}"
                                            data-name="{{ $course->course_name }}"
                                            data-credit-hours="{{ $course->credit_hours }}"
                                            data-fee="{{ $course->fee }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <a href="#deleteCourseModal" class="delete teacher-delete-course-trigger" data-toggle="modal"
                                            data-target="#deleteCourseModal" data-id="{{ $course->id }}"
                                            data-name="{{ $course->course_name }}">
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

                    {{ $courses->links() }}
                </div>
            </div>
        </div>

        <!-- Add course modal -->
        <div class="modal fade" tabindex="-1" id="addCourseModal" role="dialog"
            aria-labelledby="teacherAddCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('taddCourse') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherAddCourseModalLabel">Add Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="teacher-add-course-name">Course Name</label>
                                <input type="text" id="teacher-add-course-name" name="course_name" class="form-control"
                                    placeholder="Enter Course Name" value="{{ old('course_name') }}" required>
                                @error('course_name', 'tAddCourse')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-course-credit-hours">Credit Hours</label>
                                <input type="number" id="teacher-add-course-credit-hours" name="credit_hours"
                                    class="form-control" placeholder="Enter Credit Hours"
                                    value="{{ old('credit_hours') }}" min="1" required>
                                @error('credit_hours', 'tAddCourse')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-course-fee">Course Fee</label>
                                <input type="number" id="teacher-add-course-fee" name="fee" class="form-control"
                                    placeholder="Enter Course Fee" value="{{ old('fee') }}" min="0" required>
                                @error('fee', 'tAddCourse')
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

        <!-- Edit course modal -->
        <div class="modal fade" tabindex="-1" id="editCourseModal" role="dialog"
            aria-labelledby="teacherEditCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('teditCourse') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherEditCourseModalLabel">Edit Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="course_id" id="teacher-edit-course-id" value="{{ old('course_id') }}">

                            <div class="form-group">
                                <label for="teacher-edit-course-name">Course Name</label>
                                <input type="text" id="teacher-edit-course-name" name="course_name" class="form-control"
                                    placeholder="Enter Course Name" value="{{ old('course_name') }}" required>
                                @error('course_name', 'tEditCourse')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-course-credit-hours">Credit Hours</label>
                                <input type="number" id="teacher-edit-course-credit-hours" name="credit_hours"
                                    class="form-control" placeholder="Enter Credit Hours"
                                    value="{{ old('credit_hours') }}" min="1" required>
                                @error('credit_hours', 'tEditCourse')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-course-fee">Course Fee</label>
                                <input type="number" id="teacher-edit-course-fee" name="fee" class="form-control"
                                    placeholder="Enter Course Fee" value="{{ old('fee') }}" min="0" required>
                                @error('fee', 'tEditCourse')
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

        <!-- Delete course modal -->
        <div class="modal fade" tabindex="-1" id="deleteCourseModal" role="dialog"
            aria-labelledby="teacherDeleteCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('tdeleteCourse') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherDeleteCourseModalLabel">Delete Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="course_id" id="teacher-delete-course-id"
                                value="{{ old('course_id') }}">
                            <p id="teacher-delete-course-message">Are you sure you want to delete this course?</p>
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

        <!-- Bulk delete courses modal -->
        <div class="modal fade" tabindex="-1" id="teacherBulkDeleteCoursesModal" role="dialog"
            aria-labelledby="teacherBulkDeleteCoursesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('tbulkDeleteCourses') }}" method="POST"
                    id="teacherBulkDeleteCoursesForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherBulkDeleteCoursesModalLabel">Delete Courses</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="teacher-bulk-delete-courses-message">Are you sure you want to delete the selected courses?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <div id="teacher-bulk-delete-courses-inputs"></div>
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

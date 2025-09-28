@extends('layout/layout')

@section('content')
    <div class="main-content" data-entity="teacher-students">
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

                @if ($errors->hasBag('tBulkStudents'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->tBulkStudents->all() as $bulkError)
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
                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Manage Students</h2>
                            </div>
                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                <button type="button" class="btn btn-danger mr-2" id="teacherBulkDeleteStudentsButton">
                                    <i class="material-icons">&#xE15C;</i>
                                    <span>Bulk Delete</span>
                                </button>
                                <a href="#addStudentModal" class="btn btn-success" data-toggle="modal"
                                    data-target="#addStudentModal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Add New Student</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="teacherSelectAllStudents" class="select-all-checkbox">
                                        <label for="teacherSelectAllStudents"></label>
                                    </span>
                                </th>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Sex</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Course</th>
                                <th>Paid Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr data-row-id="{{ $student->id }}">
                                    <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="teacher-student-checkbox-{{ $student->id }}"
                                                class="row-checkbox teacher-student-row-checkbox"
                                                value="{{ $student->id }}">
                                            <label for="teacher-student-checkbox-{{ $student->id }}"></label>
                                        </span>
                                    </td>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ ucfirst($student->sex) }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ optional($student->course)->course_name ?? 'N/A' }}</td>
                                    <td>{{ $student->paid_fee }}</td>
                                    <td>
                                        <a href="#editStudentModal" class="edit teacher-edit-student-trigger" data-toggle="modal"
                                            data-target="#editStudentModal" data-id="{{ $student->id }}"
                                            data-name="{{ $student->name }}" data-sex="{{ $student->sex }}"
                                            data-phone="{{ $student->phone }}" data-address="{{ $student->address }}"
                                            data-course-id="{{ $student->course_id }}" data-fee="{{ $student->paid_fee }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <a href="#deleteStudentModal" class="delete teacher-delete-student-trigger" data-toggle="modal"
                                            data-target="#deleteStudentModal" data-id="{{ $student->id }}"
                                            data-name="{{ $student->name }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No record found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $students->links() }}
                </div>
            </div>
        </div>

        <!-- Add student modal -->
        <div class="modal fade" tabindex="-1" id="addStudentModal" role="dialog"
            aria-labelledby="teacherAddStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('taddStudent') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherAddStudentModalLabel">Add Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="teacher-add-student-name">Name</label>
                                <input type="text" id="teacher-add-student-name" name="name" class="form-control"
                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name', 'tAddStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-student-sex">Sex</label>
                                <select id="teacher-add-student-sex" name="sex" class="form-control" required>
                                    <option value="">Select Sex</option>
                                    <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('sex') === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('sex', 'tAddStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-student-phone">Phone</label>
                                <input type="text" id="teacher-add-student-phone" name="phone" class="form-control"
                                    placeholder="Enter Phone" value="{{ old('phone') }}" required>
                                @error('phone', 'tAddStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-student-address">Address</label>
                                <input type="text" id="teacher-add-student-address" name="address" class="form-control"
                                    placeholder="Enter Address" value="{{ old('address') }}" required>
                                @error('address', 'tAddStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-student-course">Course</label>
                                <select id="teacher-add-student-course" name="course_id" class="form-control" required>
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $courseOption)
                                        <option value="{{ $courseOption->id }}"
                                            {{ (string) old('course_id') === (string) $courseOption->id ? 'selected' : '' }}>
                                            {{ $courseOption->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id', 'tAddStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-add-student-fee">Paid Fee</label>
                                <input type="number" id="teacher-add-student-fee" name="paid_fee" class="form-control"
                                    placeholder="Enter Paid Fee" value="{{ old('paid_fee') }}" min="0" required>
                                @error('paid_fee', 'tAddStudent')
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

        <!-- Edit student modal -->
        <div class="modal fade" tabindex="-1" id="editStudentModal" role="dialog"
            aria-labelledby="teacherEditStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('teditStudent') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherEditStudentModalLabel">Edit Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="student_id" id="teacher-edit-student-id"
                                value="{{ old('student_id') }}">

                            <div class="form-group">
                                <label for="teacher-edit-student-name">Name</label>
                                <input type="text" id="teacher-edit-student-name" name="name" class="form-control"
                                    placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name', 'tEditStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-student-sex">Sex</label>
                                <select id="teacher-edit-student-sex" name="sex" class="form-control" required>
                                    <option value="">Select Sex</option>
                                    <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('sex') === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('sex', 'tEditStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-student-phone">Phone</label>
                                <input type="text" id="teacher-edit-student-phone" name="phone" class="form-control"
                                    placeholder="Enter Phone" value="{{ old('phone') }}" required>
                                @error('phone', 'tEditStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-student-address">Address</label>
                                <input type="text" id="teacher-edit-student-address" name="address" class="form-control"
                                    placeholder="Enter Address" value="{{ old('address') }}" required>
                                @error('address', 'tEditStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-student-course">Course</label>
                                <select id="teacher-edit-student-course" name="course_id" class="form-control" required>
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $courseOption)
                                        <option value="{{ $courseOption->id }}"
                                            {{ (string) old('course_id') === (string) $courseOption->id ? 'selected' : '' }}>
                                            {{ $courseOption->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id', 'tEditStudent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="teacher-edit-student-fee">Paid Fee</label>
                                <input type="number" id="teacher-edit-student-fee" name="paid_fee" class="form-control"
                                    placeholder="Enter Paid Fee" value="{{ old('paid_fee') }}" min="0" required>
                                @error('paid_fee', 'tEditStudent')
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

        <!-- Delete student modal -->
        <div class="modal fade" tabindex="-1" id="deleteStudentModal" role="dialog"
            aria-labelledby="teacherDeleteStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('tdeleteStudent') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherDeleteStudentModalLabel">Delete Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="student_id" id="teacher-delete-student-id"
                                value="{{ old('student_id') }}">
                            <p id="teacher-delete-student-message">Are you sure you want to delete this student?</p>
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

        <!-- Bulk delete students modal -->
        <div class="modal fade" tabindex="-1" id="teacherBulkDeleteStudentsModal" role="dialog"
            aria-labelledby="teacherBulkDeleteStudentsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('tbulkDeleteStudents') }}" method="POST"
                    id="teacherBulkDeleteStudentsForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="teacherBulkDeleteStudentsModalLabel">Delete Students</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="teacher-bulk-delete-students-message">Are you sure you want to delete the selected students?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <div id="teacher-bulk-delete-students-inputs"></div>
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

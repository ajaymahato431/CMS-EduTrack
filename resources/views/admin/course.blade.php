@extends('layout/layout')

@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrapper">

                    <div class="table-title">
                        <div class="row">
                            <div class="flex p-0 col-sm-6 justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Manage Course</h2>
                            </div>
                            <div class="flex p-0 col-sm-6 justify-content-lg-end justify-content-center">
                                <a href="#addCourseModal" class="btn btn-success" data-toggle="modal">
                                    <i class="material-icons">&#xE147;</i>
                                    <span>Add New Course</span>
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
                                <th>Course Name</th>
                                <th>Credit Hours</th>
                                <th>Course Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($courses as $data)
                                <tr>
                                    <th><span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox1" name="option[]" value="1">
                                            <label for="checkbox1"></label></th>

                                    <th>{{ $data->course_id }}</th>
                                    <th>{{ $data->course_name }}</th>
                                    <th>{{ $data->credit_hours }}</th>
                                    <th>{{ $data->fee }}</th>

                                    <th>
                                        <a href="#editCourseModal" class="edit" data-toggle="modal"
                                            data-id="{{ $data->course_id }}">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>

                                        <a href="#deleteCourseModal" class="delete" data-toggle="modal"
                                            data-id="{{ $data->course_id }}">
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
                    {{ $courses->links() }}
                </div>
            </div>

            <!----add-modal start--------->
            <div class="modal fade" tabindex="-1" id="addCourseModal" role="dialog">
                <div class="modal-dialog" role="document">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p style="color:red;">{{ $error }}</p>
                        @endforeach
                    @endif

                    <form action="{{ route('addCourse') }}" method="POST">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Course Name</label><br>
                                    <input type="text" name="course_name" placeholder="Enter Course Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Credit Hours</label><br>
                                    <input type="number" name="credit_hours" placeholder="Enter Credit Hours" required>
                                </div>
                                <div class="form-group">
                                    <label>Course Fee</label><br>
                                    <input type="number" name="fee" placeholder="Enter Course Fee" required>
                                </div>
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
            <div class="modal fade" tabindex="-1" id="editCourseModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('editCourse') }}" method="POST">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="userId" id="userId">

                                <div class="form-group">
                                    <label>Course Name</label><br>
                                    <input type="text" name="course_name" placeholder="Enter Course Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Credit Hours</label><br>
                                    <input type="int" name="credit_hours" placeholder="Enter Credit Hours" required>
                                </div>
                                <div class="form-group">
                                    <label>Course Fee</label><br>
                                    <input type="int" name="fee" placeholder="Enter Course Fee" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

         <!----delete-modal start--------->
            <div class="modal fade" tabindex="-1" id="deleteCourseModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('deleteCourse') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Course</h5>
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

@extends('layout/layout')

@section('content')

		   <!------main-content-start-----------> 
		     
           <div class="main-content">
            <div class="row">
               <div class="col-md-12">
                  <div class="table-wrapper">
                    
                  <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                           <h2 class="ml-lg-2">Manage  Students</h2>
                        </div>
                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                          <a href="#addStudentModal" class="btn btn-success" data-toggle="modal">
                          <i class="material-icons">&#xE147;</i>
                          <span>Add New Student</span>
                          </a>
                          {{-- <a href="#deleteStudentModal" class="btn btn-danger" data-toggle="modal">
                          <i class="material-icons">&#xE15C;</i>
                          <span>Delete</span> --}}
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

                        @forelse($students as $data)

                            <tr>
                                <th><span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox1" name="option[]" value="1">
                                    <label for="checkbox1"></label></th>

                                <th>{{ $data->id}}</th>
                                <th>{{ $data->name}}</th>
                                <th>{{ $data->sex}}</th>
                                <th>{{ $data->phone}}</th>
                                <th>{{ $data->address}}</th>
                                <th>{{ $data->course_name}}</th>
                                <th>{{ $data->paid_fee}}</th>

                                <th>
                                  <a href="#editStudentModal" class="edit" data-toggle="modal" data-id="{{ $data->id }}">
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>
                                
                                   <a href="#deleteStudentModal" class="delete" data-toggle="modal" data-id="{{ $data->id }}">
                                   <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                   </a>
                                 </th>

                            </tr>


                            @empty
                                <tr><td colspan="9">No record found</td></tr>
                            @endforelse
                                                 
                     </tbody>
                     
                     
                  </table>

                  {{ $students->links() }}


                  </div>
               </div>
               
               
                               <!----add-modal start--------->
   <div class="modal fade" tabindex="-1" id="addStudentModal" role="dialog">
    <div class="modal-dialog" role="document">
    
      @if($errors->any())
      @foreach($errors->all() as $error)
      <p style="color:red;">{{ $error }}</p>
      @endforeach
    @endif
    
      <form action="{{ route('addStudent') }}" method="POST">
        @csrf
    
    <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">Add Student</h5>
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
      <label>Sex</label><br>
      <select name="sex" required class="form-control" style="border: 1px solid;">
        <option value="">Select Sex</option>        
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Not Specified">Not Specified</option>

    </select>
    </div>
       <div class="form-group">
           <label>Phone</label><br>
           <input type="tel" name="phone" placeholder="Enter Phone">
          </div>
       <div class="form-group">
        <label>Address</label><br>
        <input type="text" name="address" placeholder="Enter Address">
      </div>
      <div class="form-group">
        <label>Course</label><br>
        <select name="course_id" required class="form-control" style="border: 1px solid;">
            <option value="">Select Course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
            @endforeach
        </select>
    </div>
    
         <div class="form-group">
          <label>Paid Fee</label><br>
          <input type="number" name="paid_fee" placeholder="Enter Paid Fee">
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
       <div class="modal fade" tabindex="-1" id="editStudentModal" role="dialog">
    <div class="modal-dialog" role="document">
      <form action="{{ route('editStudent') }}" method="POST">
        @csrf
    
    <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">Edit Student</h5>
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
   <label>Sex</label><br>
   <select name="sex" required class="form-control" style="border: 1px solid;">
     <option value="">Select Sex</option>        
         <option value="Male">Male</option>
         <option value="Female">Female</option>
         <option value="Not Specified">Not Specified</option>

 </select>
 </div>
    <div class="form-group">
        <label>Phone</label><br>
        <input type="tel" name="phone" placeholder="Enter Phone">
       </div>
    <div class="form-group">
     <label>Address</label><br>
     <input type="text" name="address" placeholder="Enter Address">
   </div>
    <div class="form-group">
        <label>Course</label><br>
        <select name="course_id" required class="form-control" style="border: 1px solid;">
         <option value="">Select Course</option>
         @foreach ($courses as $courses)
             <option value="{{ $courses->course_id }}">{{ $courses->course_name }}</option>
         @endforeach
     </select>
      </div>
      <div class="form-group">
       <label>Paid Fee</label><br>
       <input type="number" name="paid_fee" placeholder="Enter Paid Fee">
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
    
                      <!----edit-modal end--------->	   
                      
                      
                    <!----delete-modal start--------->
       <div class="modal fade" tabindex="-1" id="deleteStudentModal" role="dialog">
    <div class="modal-dialog" role="document">
      <form action="{{ route('deleteStudent') }}" method="POST">
        @csrf
    <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">Delete Student</h5>
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
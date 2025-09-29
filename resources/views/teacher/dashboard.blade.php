@extends('layout/layout')

@section('content')
<style>
    .card-img-top {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .card {
        padding: 1.5em 0.5em 0.5em;
        text-align: center;
        border-radius: 2em;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
        font-size: 1.5em;
    }

    .btn-primary {
        border-radius: 2em;
        padding: 0.5em 1.5em;
        margin-top: 10px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>
    <div class="container">
        <div class="card" style="width: 25rem;">
            <img src="/storage/{{ Auth::user()->profile_photo_path }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ Auth::user()->name }}</h5>
                <p class="card-text">
                    ID = {{ Auth::user()->id }} <br>
                    Email = {{ Auth::user()->email }} <br>
                    Department =
                    @if (Auth::user()->role_id == 1)
                    Admin
                    @elseif (Auth::user()->role_id == 2)
                    Teacher
                    @else
                    Student
                    @endif
                    <br>
                </p>
                <a href="#updateProfileModal" data-toggle="modal" class="btn btn-primary">Update Profile</a><br>
                <a href="#updateNameModal" data-toggle="modal" class="btn btn-primary">Update Name</a><br>
                <a href="#updatePasswordModal" data-toggle="modal" class="btn btn-primary">Update Password</a>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" tabindex="-1" id="updateNameModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tupdateName') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label>Name</label>
                        {{-- 👇 Pre-filled value, old input on error, and proper class --}}
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Name" required>

                        {{-- 👇 Show validation error for the 'name' field --}}
                        @error('name', 'updateName')
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
<div class="modal fade" tabindex="-1" id="updatePasswordModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tupdatePassword') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter New Password"
                            required>

                        {{-- 👇 Show validation error for the 'password' field --}}
                        @error('password', 'updatePassword')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm New Password" required>
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
<div class="modal fade" tabindex="-1" id="updateProfileModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tupdateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="image" class="form-control-file" required>

                        {{-- 👇 Show validation error for the 'image' field --}}
                        @error('image', 'updateProfile')
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // 👇 Re-open the modal if there are validation errors

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - EduTrack</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* CSS Reset and Global Styles */
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-color: #f0f2f5;
            --card-background: #ffffff;
            --text-color: #333;
            --light-text-color: #888;
            --border-color: #dee2e6;
            --shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Main Container */
        .profile-container {
            max-width: 800px;
            margin: 100px auto 30px;
            padding: 20px;
        }

        /* Profile Card */
        .profile-card {
            background: var(--card-background);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            text-align: center;
        }

        .card-header {
            height: 200px;
            background: url('https://images.unsplash.com/photo-1507525428034-b723a996f6ea?auto=format&fit=crop&w=1200&q=80') no-repeat center center/cover;
            position: relative;
        }

        .avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 5px solid var(--card-background);
            background: var(--card-background);
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 100px 30px 30px;
        }

        .card-body .name {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .card-body .role {
            font-size: 1rem;
            color: var(--light-text-color);
            margin-bottom: 20px;
        }

        .card-body .description {
            color: var(--secondary-color);
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .social-links a {
            color: var(--secondary-color);
            margin: 0 12px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--primary-color);
        }

        .action-buttons {
            margin-top: 30px;
            padding: 25px;
            border-top: 1px solid var(--border-color);
            background-color: #f8f9fa;
        }

        .action-buttons .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .action-buttons .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 0;
            border: 1px solid #888;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: slide-down 0.4s ease;
        }

        @keyframes slide-down {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h5 {
            font-size: 1.25rem;
        }

        .close-button {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-button:hover {
            color: #000;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--border-color);
            text-align: right;
        }

        .modal-footer .btn {
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            margin-left: 10px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        /* Simple Top Navigation */
        .top-nav {
            background: #2a3b4c;
            padding: 0 2rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .top-nav .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            height: 60px;
        }

        .top-nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .top-nav .brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .top-nav .nav-links a:hover {
            color: #b0c4de;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-container {
                margin-top: 80px;
            }

            .card-header {
                height: 150px;
            }

            .avatar {
                width: 120px;
                height: 120px;
                bottom: -60px;
            }

            .card-body {
                padding-top: 75px;
            }

            .card-body .name {
                font-size: 1.5rem;
            }

            .action-buttons {
                display: flex;
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>

    <nav class="top-nav">
        <div class="nav-container">
            <a href="/home" class="brand">EduTrack</a>
            <div class="nav-links">
                <a href="/home">Home</a>
                <a href="/logout">Log Out</a>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-card">
            <div class="card-header">
                <div class="avatar">
                    <img src="/storage/{{ Auth::user()->profile_photo_path }}" alt="User Profile Picture">
                </div>
            </div>
            <div class="card-body">
                <h2 class="name">{{ Auth::user()->name }}</h2>
                <p class="role">
                    @if (Auth::user()->role_id === 1)
                    Admin
                    @elseif (Auth::user()->role_id === 2)
                    Teacher
                    @else
                    Student
                    @endif
                </p>
                <p class="description">Welcome to your personal profile page. Manage your details and keep your account
                    secure.</p>
                <div class="social-links">
                    <a href="https://linkedin.com/in/ajaymahato9988?" target="_blank" title="LinkedIn"><i
                            class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/summerlove9988/" target="_blank" title="Instagram"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/harekrishna431" target="_blank" title="Facebook"><i
                            class="fab fa-facebook-square"></i></a>
                </div>
            </div>
            <div class="action-buttons">
                <button class="btn" onclick="openModal('updateProfileModal')">Update Profile</button>
                <button class="btn" onclick="openModal('updateNameModal')">Update Name</button>
                <button class="btn" onclick="openModal('updatePasswordModal')">Update Password</button>
            </div>
        </div>
    </div>

    <div id="updateNameModal" class="modal">
        <div class="modal-content">
            <form action="{{ route('supdateName') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5>Edit Name</h5>
                    <span class="close-button" onclick="closeModal('updateNameModal')">&times;</span>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            placeholder="Enter Name" required>
                        @error('name', 'updateName') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('updateNameModal')">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="updatePasswordModal" class="modal">
        <div class="modal-content">
            <form action="{{ route('supdatePassword') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5>Edit Password</h5>
                    <span class="close-button" onclick="closeModal('updatePasswordModal')">&times;</span>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" placeholder="Enter New Password" required>
                        @error('password', 'updatePassword') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm New Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('updatePasswordModal')">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateProfileModal" class="modal">
        <div class="modal-content">
            <form action="{{ route('supdateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5>Edit Profile Photo</h5>
                    <span class="close-button" onclick="closeModal('updateProfileModal')">&times;</span>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="image">Upload New Image</label>
                        <input type="file" name="image" required>
                        @error('image', 'updateProfile') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('updateProfileModal')">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple JavaScript for Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal if user clicks outside of the modal content
        window.onclick = function(event) {
            const modals = document.getElementsByClassName('modal');
            for (let i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>

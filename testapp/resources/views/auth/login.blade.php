<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth-blog.css') }}">
    </head>
<body>
    @php
        $serverMessage = session('status') ?: ($errors->first() ?? null);
        $serverType = session('status') ? 'success' : ($errors->any() ? 'error' : null);
    @endphp

    <div class="auth-page">
        <div id="authMessage" class="auth-message" aria-live="polite" @if($serverMessage) style="display:block;" @else hidden @endif>
            <div id="authMessageBox" class="auth-message-box @if($serverType){{ $serverType }}@endif">{{ $serverMessage ?? '' }}</div>
        </div>

        <div class="auth-container">
            <div class="welcome-section">
                <div class="welcome-content">
                    <h1>Welcome</h1>
                    <p>Sign in to write and manage your posts.</p>
                </div>
            </div>

            <div class="auth-forms">
                <div class="form-toggle">
                    <button class="toggle-btn" onclick="authBlog.showForm('login', this)">Login</button>
                    <button class="toggle-btn" onclick="authBlog.showForm('register', this)">Register</button>
                </div>

                <form id="loginForm" class="auth-form active" action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username or email" required>
                    </div>
                    <div class="form-group">
                        <label for="loginpassword">Password</label>
                        <input type="password" name="loginpassword" id="loginpassword" class="form-control" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>

                <form id="registerForm" class="auth-form" action="/register" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Create a strong password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </form>
            </div>
        </div>

        <script src="{{ asset('js/auth-blog.js') }}"></script>
    </div>
</body>
</html>

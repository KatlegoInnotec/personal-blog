<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

    {{-- Check if user is authenticated --}}
    {{-- If user is authenticated show logout button and create post form --}}
    {{-- Else show register and login form --}}
    {{-- Show all posts --}}
    {{-- Loop through all posts --}}
    {{-- Show edit and delete button for each post --}}
    {{-- Edit button should link to edit-post page --}}
    {{-- Delete button should send a delete request to delete-post route --}}
    {{-- Only show edit and delete button if user is authenticated --}}
    {{-- Only show edit and delete button if user is the author of the post --}}
    {{-- Use blade directives --}}

    {{-- Check if user is authenticated --}}    
 
    	<!-- Auth-only styles/scripts -->
    	<link rel="stylesheet" href="{{ asset('css/auth-blog.css') }}">
    	<div class="auth-page">
		<!-- auth message box (appears on submit or when server flashes) -->
		@php
			$serverMessage = session('status') ?: ($errors->first() ?? null);
			$serverType = session('status') ? 'success' : ($errors->any() ? 'error' : null);
		@endphp
		<div id="authMessage" class="auth-message" aria-live="polite" @if($serverMessage) style="display:block;" @else hidden @endif>
			<div id="authMessageBox" class="auth-message-box @if($serverType){{ $serverType }}@endif">{{ $serverMessage ?? '' }}</div>
		</div>
    		<div class="auth-container">
		<!-- Welcome Section -->
		<div class="welcome-section">
			<div class="welcome-content">
				<h1>i</h1>
				<p style="margin-top: 20px">
					"Writing is the painting of the voice." - Voltaire
				</p>
			</div>
		</div>

		<!-- Authentication Forms -->
		<div class="auth-forms">
			<!-- Form Toggle -->
			<div class="form-toggle">
					<button class="toggle-btn" onclick="authBlog.showForm('login', this)">Login</button>
					<button class="toggle-btn" onclick="authBlog.showForm('register', this)">Register</button>
			</div>
			 <!-- Login Form -->
			 <form 
			 		id="loginForm" class="auth-form active" action="/login"
			 		method="POST" 
			 	>
			 	 @csrf
			 	<div class="form-group">
			 		<label for="username">Username or Email</label>
					   <input 
						   type="text"
						   name="username"
						   id="username"
						   class="form-control"
						   placeholder="Enter your username or email"
						   required>
			 	</div>

			 	<div class="form-group">
			 		<label for="loginpassword">Password</label>
			 		<input 
			 			type="password"
			 			 name="loginpassword"
			 			 id="loginpassword"
			 			 class="form-control"
			 			 placeholder="Enter password"
			 			 required 
			 			 >
			 	</div>


			 	<button  type="submit" class="btn btn-primary">Sign In</button>

			 	<div class="form-footer">
			 		<a href="">Forgot your password?</a>
			 	</div>

			 	 <!-- Social Login -->
			 	 <div class="social-login">
			 	 		<p>Or continue with</p>
			 	 		<div class="social-buttons">
			 	 			<button type="button" class="social-btn">
			 	 				 <span>Google</span>
			 	 			</button>
			 	 			<button type="button" class="social-btn">
			 	 				<span>Facebook</span>
			 	 			</button>
			 	 		</div>
			 	 </div>
			 </form>	

		 <!-- Register Form -->
		 <form 
		 	id="registerForm"
		 	class="auth-form"
		 	action="/register"
		 	method="POST">
		 	 @csrf
		 	<div class="form-group">
		 		 <label for="name">Full Name</label>
                   <input
                   	 	type="text"
                   	  	id="name"
                   	    name="name"
                   	    class="form-control"
                   	    placeholder="Enter your full name"
                   	     required>
		 	</div>

		 	<div  class="form-group">
		 		<label  for="email">Email Address</label>
				<input 
					type="email"
					name="email"
					id="email"
					class="form-control"
					placeholder="Enter your email address"
					required>
		 	</div>

		 	<div class="form-group">
		 		<label for="password">Password</label>
		 		<input 
		 			type="password"
		 		    name="password"
		 		    id="password"
		 		    class="form-control"
		 		    placeholder="Create a strong password"
		 		    required>
		 	</div>

		 	<button 
		 		type="submit"
		 	    class="btn btn-primary">
		 		Create Account
		 	</button>

		 	<div class="form-footer">
		 		<p>By registering, you agree to our <a href=""> Terms of Serice</a> and <a href=""> Privacy Policy</a></p>
		 	</div>
		 </form> 
		</div>
		</div>
		
		<!-- include auth-only script for toggling/validation -->
		<script src="{{ asset('js/auth-blog.js') }}"></script>
		</div>



</body>
</html>
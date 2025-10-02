<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome</h1>

    @auth
        <p>Congrats you are logged in</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>
        <div style="border: 3px solid black;">
            <h2>Create a new post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title">
                <br>
                <textarea 
                    name="body" id="" 
                    cols="30"
                    rows="10"
                    placeholder="body content..."
                    >
                </textarea><br>
                <button>Save Blog</button>
            </form>
        </div>

         <div style="border: 3px solid black;">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
                <div 
                    style="background-color: gray; padding: 10px;
                            margin:10px;"    
                >
                    <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                    {{$post['body']}}
                    <p></p>
                    <button><a href="/edit-post/{{$post->id}}">Edit</a></button>
                    <form 
                        action="/delete-post/{{$post->id}}" 
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
         </div>
    @else 
         <div style="border: 3px solid black;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input type="text"  name="name" placeholder="Name" autocomplete="off">
                <input type="text" name="email" placeholder="Email" autocomplete="off">
                <input type="password"name="password" placeholder="Password" autocomplete="off">
                <button>Register</button>
            </form>
    </div>
     <div style="border: 3px solid black;">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="text"  name="username" placeholder="Name" autocomplete="off">
                <input type="password"name="loginpassword" placeholder="Password" autocomplete="off">
                <button>Login</button>
            </form>
    </div>
    @endauth

   
</body>
</html>
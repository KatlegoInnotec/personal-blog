<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form 
        action="/edit-post/{{$post->id}}" 
        method="POST"
    >
    @csrf
    @method('PUT')
    <input type="text" name="title">
                <br>
                <textarea 
                    name="body" id="" 
                    cols="30"
                    rows="10"
                    placeholder="body content..."
                    >
                </textarea><br>
                <button>Edit Blog</button>
    </form>
</body>
</html>
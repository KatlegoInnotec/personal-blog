<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Write a post</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
        <p>Congrats you are logged in</p>
        <form action="/logout" method="POST">
            {{-- Add CSRF token --}}
            @csrf
            <button>Log Out</button>
        </form>

    <!-- remove incorrect onclick input; keep logout form above to logout properly -->
        <div style="border: 3px solid black;">
            <h2>Create a new post</h2>
            <form action="/create-post" method="POST">
                {{-- Add CSRF token --}}
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

            {{-- Loop through all posts --}}
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
    
            <script>
                (function () {
                    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    document.querySelectorAll('form[action^="/delete-post/"]').forEach(form => {
                        form.addEventListener('submit', function (e) {
                            e.preventDefault();
                            if (!confirm('Delete this post?')) return;

                            const url = form.action;

                            fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Accept': 'application/json'
                                },
                                credentials: 'same-origin'
                            }).then(async res => {
                                if (res.redirected) {
                                    // server redirected (likely to login) — follow it
                                    window.location = res.url;
                                    return;
                                }

                                if (res.ok) {
                                    // remove the post container from the DOM
                                    const postEl = form.closest('div[style*="background-color: gray"]');
                                    if (postEl) postEl.remove();
                                } else {
                                    let msg = 'Failed to delete.';
                                    try { const data = await res.json(); if (data.message) msg = data.message; } catch (err) {}
                                    alert(msg);
                                }
                            }).catch(err => {
                                console.error(err);
                                alert('Network error while deleting post.');
                            });
                        });
                    });
                })();
            </script>
   
</body>
</html>

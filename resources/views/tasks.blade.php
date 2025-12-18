<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialFeed ✨</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .post-card { border-radius: 15px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .btn-like { transition: transform 0.2s; }
        .btn-like:hover { transform: scale(1.1); }
    </style>
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center fw-bold mb-4 text-primary">SocialFeed</h1>

            <div class="card p-4 mb-5 post-card">
                <h5 class="fw-bold mb-3">Create a Post</h5>
                <form action="/tasks" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" class="form-control mb-2" placeholder="Post Title" required>
                    <textarea name="description" class="form-control mb-2" placeholder="What's on your mind?" rows="3"></textarea>
                    
                    <label class="form-label small text-muted">Upload Photo or Video</label>
                    <input type="file" name="attachment" class="form-control mb-3" accept="image/*,video/*">
                    
                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">Post to Feed</button>
                </form>
            </div>

            <hr class="mb-5">

            @foreach($tasks->reverse() as $post)
            <div class="card mb-4 post-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold m-0">{{ $post->title }}</h5>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    
                    <p class="card-text">{{ $post->description }}</p>

                    @if($post->attachment)
                        <div class="rounded-3 overflow-hidden border mb-3 bg-light">
                            @php 
                                $extension = pathinfo($post->attachment, PATHINFO_EXTENSION); 
                            @endphp

                            @if(in_array(strtolower($extension), ['mp4', 'mov', 'avi']))
                                <video controls class="w-100 d-block">
                                    <source src="{{ asset('storage/' . $post->attachment) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $post->attachment) }}" class="img-fluid w-100 d-block">
                            @endif
                        </div>
                    @endif

                    <div class="d-flex align-items-center justify-content-between border-top pt-3">
                        <div class="d-flex gap-2">
                            <form action="/post/{{ $post->id }}/like" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-3 btn-like">
                                    ❤️ {{ $post->likes ?? 0 }}
                                </button>
                            </form>

                            <a href="/post/{{ $post->id }}/edit" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                ✏️ Edit
                            </a>
                        </div>

                        <form action="/post/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-danger btn-sm p-0 text-decoration-none" onclick="return confirm('Delete this post?')">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            @if($tasks->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted">No posts yet. Be the first to share something!</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
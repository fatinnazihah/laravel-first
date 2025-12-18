<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Feed 🐾</title>
    <link rel="icon" href="https://img.icons8.com/emoji/48/cat-face.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center text-md-start">
            <h1>🐾 Cat Feed</h1>
            <p class="text-muted">A bombastic place for tabby meow-ments</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 order-2 order-md-1">
            <h4 class="fw-bold mb-4" style="color: #5d4037;">Latest Meows</h4>
            
            @foreach($tasks->reverse() as $post)
            <div class="card mb-4 post-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="m-0">{{ $post->title }}</h5>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    
                    @if($post->description)
                        <p class="card-text mt-2" style="white-space: pre-wrap;">{{ $post->description }}</p>
                    @endif

                    @if($post->attachment)
                        <div class="media-container mb-3">
                            @php $extension = pathinfo($post->attachment, PATHINFO_EXTENSION); @endphp
                            @if(in_array(strtolower($extension), ['mp4', 'mov', 'avi']))
                                <video controls class="w-100 d-block"><source src="{{ asset('storage/' . $post->attachment) }}" type="video/mp4"></video>
                            @else
                                <img src="{{ asset('storage/' . $post->attachment) }}" class="img-fluid w-100 d-block" alt="Cat content">
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
                            <a href="/post/{{ $post->id }}/edit" class="btn btn-outline-secondary btn-sm rounded-pill px-3">✏️ Edit</a>
                        </div>
                        <form action="/post/{{ $post->id }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-link text-danger btn-sm p-0 text-decoration-none" onclick="return confirm('Delete this meow-ment?')">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-4 order-1 order-md-2 mb-5">
            <div class="sticky-top" style="top: 20px;">
                <div class="card p-4 post-card">
                    <h5 class="fw-bold mb-3">Share a Meow-ment</h5>
                    <form action="/tasks" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="title" class="form-control mb-2 rounded-pill" placeholder="Post Title" required>
                        <textarea name="description" class="form-control mb-2 rounded-3" placeholder="What's your kitty thinking?" rows="3"></textarea>
                        
                        <label class="form-label small fw-bold text-muted">📸 Upload Photo or Video</label>
                        <input type="file" name="attachment" class="form-control mb-3 rounded-pill" accept="image/*,video/*">
                        
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">Post to Feed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
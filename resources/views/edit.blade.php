<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Meow-ment 🐾</title>
    <link rel="icon" href="https://img.icons8.com/emoji/48/cat-face.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card post-card p-4">
                <h2 class="mb-4">✏️ Edit Meow-ment</h2>
                <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="title" class="form-control mb-3 rounded-pill" value="{{ $post->title }}" required>
                    
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control mb-3 rounded-3" rows="3">{{ $post->description }}</textarea>
                    
                    <label class="form-label fw-bold">Replace Media (Optional)</label>
                    <input type="file" name="attachment" class="form-control mb-4 rounded-pill" accept="image/*,video/*">

                    <button class="btn btn-primary w-100">Save Changes</button>
                    <a href="/" class="btn btn-link w-100 mt-2 text-decoration-none text-muted text-center">Back to Feed</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
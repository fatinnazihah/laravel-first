<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Post</title>
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Edit Post</h2>
            <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                
                <label class="form-label fw-bold">Title</label>
                <input type="text" name="title" class="form-control mb-3" value="{{ $post->title }}" required>
                
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control mb-3" rows="3">{{ $post->description }}</textarea>
                
                <label class="form-label fw-bold">Change Media (Optional)</label>
                <input type="file" name="attachment" class="form-control mb-4" accept="image/*,video/*">

                <button class="btn btn-success w-100 fw-bold">Save Changes</button>
                <a href="/" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
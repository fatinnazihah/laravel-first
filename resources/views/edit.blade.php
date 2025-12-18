<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Edit Post</h2>
            <form action="/post/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT') <input type="text" name="title" class="form-control mb-2" value="{{ $post->title }}">
                <textarea name="description" class="form-control mb-3" rows="3">{{ $post->description }}</textarea>
                <button class="btn btn-success w-100">Update Post</button>
                <a href="/" class="btn btn-link w-100 mt-2">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>My Task Manager</title>
</head>
<body>
    <h1>Task List</h1>

    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="New Task" required>
        <button type="submit">Add Task</button>
    </form>

    <ul>
        @foreach($tasks as $task)
            <li>{{ $task->title }} ({{ $task->is_completed ? 'Done' : 'Pending' }})</li>
        @endforeach
    </ul>
</body>
</html>
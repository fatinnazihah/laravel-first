<h1>My Tasks</h1>
<ul>
    @foreach($tasks as $task)
        <li>{{ $task->title }} - {{ $task->is_completed ? 'Done' : 'Pending' }}</li>
    @endforeach
</ul>
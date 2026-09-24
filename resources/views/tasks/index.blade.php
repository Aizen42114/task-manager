<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    
    <title>Personal Task Manager</title>
</head>
<body>

<div class="container">

    <h1>Personal Task Manager</h1>

    <div class="add-task">

        <h2>Add Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <label for="task_name">Task Name:</label>

            <input
                type="text"
                name="task_name"
                id="task_name"
                placeholder="Enter a task"
            >

            <br><br>

            <label for="description">Description:</label>

            <textarea
                name="description"
                id="description"
                placeholder="Enter a description"
                rows="4"
            ></textarea>

            <br><br>

            <label for="due_date">Due Date:</label>

            <input
                type="date"
                name="due_date"
                id="due_date"
            >

            <br><br>

            <button type="submit" class="add-button">
                Add Task
            </button>
        </form>

    </div>

    <h2>My Tasks</h2>

    @if ($tasks->count() > 0)

        <ul class="task-list">

            @foreach ($tasks as $task)

                <li class="task-card">

                    <h3>{{ $task->task_name }}</h3>

                    @if ($task->description)
                        <p>{{ $task->description }}</p>
                    @endif

                    <p>
                        <strong>Status:</strong>

                        <span class="status {{ strtolower($task->status) }}">
                            {{ $task->status }}
                        </span>
                    </p>

                    @if ($task->due_date)
                        <p>
                            <strong>Due Date:</strong>
                            {{ $task->due_date }}
                        </p>
                    @endif

                    <div class="task-actions">

                        <a
                            href="{{ route('tasks.edit', $task) }}"
                            class="button edit-button"
                        >
                            Edit
                        </a>

                        @if ($task->status === 'Pending')

                            <form
                                action="{{ route('tasks.complete', $task) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="complete-button"
                                >
                                    Mark as Completed
                                </button>
                            </form>

                        @else

                            <strong class="completed">
                                Completed
                            </strong>

                        @endif

                        <form
                            action="{{ route('tasks.destroy', $task) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button"
                            >
                                Delete
                            </button>
                        </form>

                    </div>

                </li>

            @endforeach

        </ul>

    @else

        <p>No tasks yet.</p>

    @endif

</div>

</body>
</html>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Edit Task</title>
</head>
<body>

<div class="container">

    <h1>Edit Task</h1>

    <div class="edit-card">

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="task_name">Task Name:</label>

            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ $task->task_name }}"
            >

            <br><br>

            <label for="description">Description:</label>

            <textarea
                id="description"
                name="description"
                rows="4"
            >{{ $task->description }}</textarea>

            <br><br>

            <label for="status">Status:</label>

            <select name="status" id="status">

                <option
                    value="Pending"
                    {{ $task->status === 'Pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="Completed"
                    {{ $task->status === 'Completed' ? 'selected' : '' }}
                >
                    Completed
                </option>

            </select>

            <br><br>

            <label for="due_date">Due Date:</label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ $task->due_date }}"
            >

            <br><br>

            <button type="submit" class="add-button">
                Update Task
            </button>

            <a
                href="{{ route('tasks.index') }}"
                class="button back-button"
            >
                Back to Tasks
            </a>

        </form>

    </div>

</div>

</body>
</html>
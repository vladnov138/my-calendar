<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>My Calendar</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="add-task-form">
            <h2>Add Task</h2>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf()
                <input type="text" placeholder="Тема" name="title" required><br>
                <select name="type">
                    <option selected>Встреча</option>
                    <option>Звонок</option>
                    <option>Совещание</option>
                    <option>Дело</option>
                </select>
                <input type="text" placeholder="Место" name="place" required><br>
                <input type="datetime-local" name="datetime" required><br>
                <input type="number" name="duration" required><br>
                <textarea placeholder="Описание" name="description"></textarea><br>
                <button type="submit">Добавить</button>
            </form>
        </div>
        <div class="add-task-form">
            @csrf()
            <form action="#" method="GET">
                <input type="date" name="date" required><br>
                <button type="submit">Поиск по дате</button>
            </form>
        </div>
        <div class="buttons">
            <a href="?type=current">Текущие задачи</a>
            <a href="?type=failed">Просроченные задачи</a>
            <a href="?type=successful">Выполненные задачи</a>
        </div>
        @foreach ($notes as $note)
        <div class="tasks-container">
            <div class="task">
                <div class="title">Название: {{ $note->title }}</div>
                <div class="due-date">Дата: {{ $note->datetime }}</div>
                <div class="type">Тип встречи: {{ $note->type }}</div>
                <div class="place">Место: {{ $note->place }}</div>
                <div class="duration">Длительность: {{ $note->duration }}</div>
                <div class="description">{{ $note->description }}</div>
                <div class="status">Статус: {{ $note->status }}</div>
                <div class="actions">
                    <a href="{{ route('tasks.edit', ['task' => $note->id]) }}">Edit</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
                </div>
            </div>
        </div>
        <form id="delete-form" action="{{ route('tasks.delete', ['id' => $note->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <!-- Дополнительные поля формы, если необходимо -->
        </form>
        @endforeach
    </div>
</body>

</html>
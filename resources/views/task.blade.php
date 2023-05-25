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
    <div class="add-task-form">
        <h2>Change Task</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
            @method("PUT")
            @csrf()
            <input type="text" placeholder="Тема" name="title" value="{{ $task->title }}" required><br>
            <select name="type" value="{{ $task->place }}">
                <option>Встреча</option>
                <option>Звонок</option>
                <option>Совещание</option>
                <option>Дело</option>
            </select>
            <input type="text" placeholder="Место" value="{{ $task->place }}" name="place" required><br>
            <input type="datetime-local" name="datetime" value="{{ $task->datetime }}" required><br>
            <input type="number" name="duration" placeholder="Длительность" value="{{ $task->duration }}" required><br>
            <textarea name="description">{{ $task->description }}</textarea><br>
            <select name="status" value="{{ $task->status }}">
                <option>Текущее</option>
                <option>Провалено</option>
                <option>Выполнено</option>
            </select>
            <button type="submit">Добавить</button>
        </form>
    </div>
</body>

</html>
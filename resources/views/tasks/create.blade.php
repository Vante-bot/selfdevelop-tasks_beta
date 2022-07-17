@extends('layouts.app')
 
@section('content')

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク登録</title>
</head>
<body>
<h1>新規登録</h1>
<form action="{{ url('tasks/create') }}" method="post">
@csrf
<div>
    <label for="task-name">タスク名</label>
    <input type="text" name="task" id="form-name" required>    
</div>
   
<div>
    <label for="">サブタスク1</label>
    <input type="text" name="subtasks" id="form-name">
</div>

<div>
    <label for="">サブタスク2</label>
    <input type="text" name="subtasks" id="form-name">
</div>

<div>
    <label for="">サブタスク3</label>
    <input type="text" name="subtasks" id="form-name">
</div>


<button type="submit">登録</button>
</form>

</body>
</html>


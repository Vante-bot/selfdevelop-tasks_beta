@extends('layouts.app')
 
@section('content')
 
<!-- タスク一覧表示 -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Tasks
    </div>
 
    <div class="panel-body">
        <table class="table table-striped task-table">
 
            <!-- テーブルヘッダ -->
            <thead>
                <th>Task</th>
                <th>&nbsp;</th>
            </thead>
 
            <!-- テーブル本体 -->
            <tbody>
                <?php //dd($tasks) ?>
                @foreach ($tasks as $task)
                <tr>
                    <!-- タスク名 -->
                    <td class="table-text">
                        <div>{{ $task->task }}</div>
                    </td>
 
                    <td>
                        <!-- TODO: 削除ボタン -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
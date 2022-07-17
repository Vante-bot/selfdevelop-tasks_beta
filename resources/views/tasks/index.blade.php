@extends('layouts.app')
 
@section('content')
 
<!-- タスク一覧表示 -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Tasks
    </div>
 
   <a href="/tasks/create">新規登録</a>

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
                
                        @foreach ( $task->subtasks as $sub)
                
                <!--bootstrapでのプルダウン機能-->        
                <!-- <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button type="button" class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> -->
                        <!-- サブタスク一覧
                        </button>  
                    </h2>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample"> -->
                        <div class="card-body">{{$sub->subtasks}}</div>
                        @endforeach
                    </div>
                    </div>  

                       
                </div>     
                                 
                    </td>
 
                    <!--: 削除ボタン -->
                    <td>
                        
                        <form action="{{url('task/')}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}

                        <button type="submit" id="delete-task-{{$task}}">削除する</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
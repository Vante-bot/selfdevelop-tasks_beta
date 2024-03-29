@extends('layouts.app')
 
@section('content')
 
<!-- タスク一覧表示 -->
<a href="/tasks/create">新規登録</a>


@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Tasks_Beta -ver.1.0
    </div>
 

    <div class="panel-body">
        <table class="table table-striped task-table">
 
            <!-- テーブルヘッダ -->
            <thead>
                <th>タスク一覧</th>
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
                        サブタスク一覧 
                        @foreach ( $task->subtasks as $sub)
                
                       
                 <div class="accordion" id="accordionExample">
                    <div class="accordion-item"> 
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button type="button" class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 
                
                        </button>  
                    </h2>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">{{$sub->subtasks}}</div>
                        @endforeach
                    </div>
                    </div>  

                       
                </div>     
                                 
                    </td>
 
                    <!--: 削除ボタン -->
                    <td>
                        
                        <form action="{{url('task/'.$task->id)}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}

                        <button type="submit" id="delete-task-{{$task->id}}" class="btn btn-danger">削除する</button>
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
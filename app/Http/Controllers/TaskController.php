<?php
 
namespace App\Http\Controllers;

use App\Models\subtask;
use Illuminate\Http\Request;
 
use App\Models\Task;
 
class TaskController extends Controller
{
    /**
        * タスク一覧
        *
        * @param Request $request
        * @return Response
        */
    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        // $tasks = Task::all()->with('subtasks');
        // dd($tasks);//ddの中身を表示して処理が中止される
        // dd(subtask::find(1));
        // dd(task::find(2)->task);

        // $data = task::all();
        //  dd($tasks);

        return view('tasks.index', [ //Tasksフォルダ内のindexファイルを利用するという意味。//
            
            'tasks' => $tasks,  //hasManyモデルをかく方法を明日質問する
            
        ]);
    }

    // public function store(Request $request){
    //     $this ->validate($request,['name'=>'required|max:255',]);
    // }


    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required|max:255',
        ]);
      
        
       
    }
    
  /**createManyメソッドを利用してsubtasksを複数追加できる機能を追加する */

public function create(request $request){

    return view('tasks.create');


    // タスク作成
    //  Task::create([
    //     'user_id' => 0,
    //     'task' => $request->task
    // ]);
     
    

}

    /**
        * タスク削除
        *
        * @param Request $request
        * @param Task $task
        * @return Response
        */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
}



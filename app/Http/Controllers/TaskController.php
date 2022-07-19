<?php
 
namespace App\Http\Controllers;

use App\Models\subtask;
use Illuminate\Http\Request;
 
use App\Models\Task;
// use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Exception;

 
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

        $data = task::all();
        //  dd($tasks);

        return view('tasks.index', [ //Tasksフォルダ内のindexファイルを利用するという意味。//
            
            'tasks' => $tasks,  
        ]);
    }

    
  /**createManyメソッドを利用してsubtasksを複数追加できる機能を追加する */

 /**タスクとサブタスクをまとめて登録するよりは一度タスク登録ページを作成してから
  *ホーム画面に一度戻り、そのタスクから登録されたタスクに紐づく形でサブタスクに遷移するページをが作業しやすい 
  */


public function create(request $request){

    return view('tasks.create');
    // タスク作成ページへ移項
     
}

public function store(Request $request) {
  
        // $this->validate($request, [
        //     'task' => 'required|max:255',
        // ]);
    //   dd($request->subtasks);
      
        DB::beginTransaction();
       
        try{
            $task =new Task([

             'task'=>$request->task,
             'user_id'=>1,

            ]);

            $task->save();	//idは振られているはず

            foreach($request->subtasks as $subtask){
                $data = [
                    'subtasks' => $subtask,
                    'task_id' => $task->id,
                    'user_id'=>1,
                ];
		
                SubTask::insert($data);
            }

            
        }catch(Exception $e){ // ⑥
            DB::rollback();
            return back()->withInput();
        }
        DB::commit();
        return redirect(route('tasks'));
        
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



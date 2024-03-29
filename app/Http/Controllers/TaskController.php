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

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $tasks =$request->user()->tasks()->get();    
        // $tasks = Task::orderBy('created_at', 'asc')->get();
        // $tasks = Task::all()->with('subtasks');
        // dd($tasks);//ddの中身を表示して処理が中止される
        
        // $data = task::all();
        //  dd($tasks);

        return view('tasks.index', [ //Tasksフォルダ内のindexファイルを利用するという意味。//
            
            'tasks' => $tasks,  
        ]);
    }

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
             'user_id'=>1,//ここをログイン時にはどうするか聞く

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
        $this->authorize('destory',$task);
        $task->delete();
        return redirect('/tasks');
    }
}



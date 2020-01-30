<?php

namespace App\Http\Controllers;

use App\Task;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TasksController extends Controller
{
    /**
     * 顯示個人待辦清單.
     *
     * @return Factory|View
     */
    public function index()
    {

        $tasks = Task::orderBy('id')->where('user_id', Auth::user()->id)->get();

        return view('tasks.index', compact('tasks')); // 回傳畫面給使用者
    }
    /**
     * View Create Form.
     *
     * @return View
     */
    public function create()
    {
        return view('todo.create');
    }
    /**
     * 建立新的待辦事項.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:255',]);

        Task::create([
            'name' => $request->get('name'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/tasks')
            ->with('flash_notification.message', '新的事件添加成功!')
            ->with('flash_notification.level', '成功');
    }
    /**
     * 切換事項狀態.
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function update(Request $request, Task $task)
    {
        $task->completed = true;    //左邊底線正常別理他
        $task->save();

        return redirect('/tasks');
    }
    /**
     * 從資料庫中刪除事項.
     *
     * @param Task $task
     * @return Response
     * @throws Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks')
            ->with('flash_notification.message', '待辦事項成功刪除')
            ->with('flash_notification.level', '成功');
    }
}

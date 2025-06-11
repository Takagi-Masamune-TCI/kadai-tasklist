<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            // タスク覧を取得
            $user = \Auth::user();
            $tasks = Task::where('user_id', $user->id)->get();
            $data = [
                'user' => $user,
                'tasks' => $tasks,   
            ];
        }
        
        // タスク覧ビューでそれを表示（第２引数は渡すデータ。Viewでは $tasks で呼び出せる。）
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    // Get /tasks/create
    public function create()
    {
        $task = new Task;

        // タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // POST /tasks/
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

        // タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id = \Auth::user()->id;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    // GET /tasks/id
    public function show(string $id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        if (\Auth::id() !== $task->user_id) {
            return back()
                ->with('Auth Fail', 'ログインしているユーザーが異なります');
        }

        // タスク詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // GET /tasks/{id}/edit
    public function edit(string $id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        if (\Auth::id() !== $task->user_id) {
            return back()
                ->with('Auth Fail', 'ログインしているユーザーが異なります');
        }

        // タスク編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // PUT or PATCH /tasks/{id}
    public function update(Request $request, string $id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        if (\Auth::id() !== $task->user_id) {
            return back()
                ->with('Auth Fail', 'ログインしているユーザーが異なります');
        }

        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

        // タスクを更新
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE /tasks/id
    public function destroy(string $id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);

        if (\Auth::id() !== $task->user_id) {
            return back()
                ->with('Auth Fail', 'ログインしているユーザーが異なります');
        }

        // タスクを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}

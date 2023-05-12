<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskRequest;
use Illuminate\Routing\Redirector;
use App\Models\Project;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $tasks = Task::with('project')->orderBy('priority')->get();
        return view('tasks.index', ["tasks" => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $projects = Project::get();
        return view('tasks.create', ["projects" => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(TaskRequest $request): Redirector|RedirectResponse|Application
    {
        $task = new Task();
        $task->name = $request['name'];
        $task->priority = $request['priority'];
        $project = Project::findOrFail($request['project_id']);
        $task->project()->associate($project);
        $task->save();
        return redirect()->route('task.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function edit(Task $task): View|Factory|Application
    {
        $projects = Project::get();
        return view('tasks.edit', ["task" => $task, "projects" => $projects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param int $taskId
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, int $taskId): RedirectResponse
    {
        $task = Task::findOrFail($taskId);
        $task->name = $request['name'];
        $task->priority = $request['priority'];
        $project = Project::findOrFail($request['project_id']);
        $task->project()->associate($project);
        $task->save();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $taskId
     * @return RedirectResponse
     */
    public function destroy(int $taskId): RedirectResponse
    {
        Task::findOrFail($taskId)->delete();
        return redirect()->back();
    }
}

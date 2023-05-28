<?php

namespace App\Http\Controllers;

use App\Models\CardList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskRequest;
use Illuminate\Routing\Redirector;
use App\Models\Board;
use Inertia\Inertia;
use Inertia\Response;


class CardListController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function show(): Response
    {
        $projects = Project::findOrFail(1);
        $tasks = Task::where('project_id', 1)->get();
        return Inertia::render('Project', ["tasks" => $tasks]);
//        return view('tasks.show', ["projects" => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Board $board
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Board $board): Redirector|RedirectResponse|Application
    {
        CardList::create([
            "name" => request('name'),
            'user_id' => auth()->id(),
            "board_id" => $board->id,
        ]);
        return redirect()->back();
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

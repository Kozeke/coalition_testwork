<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $boards = Board::with('lists')->get();
//        return Inertia::render('Project',["projects" => $projects]);
        return Inertia::render('Boards/Index', ["boards" => $boards]);
    }

    public function show(Board $board): Response
    {
        $board->load(['lists.cards' => fn($query) => $query->orderBy('position')]);
//        $projects = Project::with('tasks')->get();
        return Inertia::render('Boards/Show', ["board" => $board]);
    }


    public function update(Board $project): RedirectResponse
    {
        request()->validate([
            'name' => ['required', 'max:255']
        ]);
        $project->update(['name' => request('name')]);
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BoardRequest $request
     * @return RedirectResponse
     */
    public function store(BoardRequest $request): RedirectResponse
    {
        Board::create(['name' => $request['name']]);
        return redirect()->back();
    }
}

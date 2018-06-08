<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = strtolower($request->query('filter', 'none'));
        switch ($filter) {
            default:
                $projects = Project::orderBy('created_at', 'desc')->get();
                $selected = 'all';
                break;

            case 'pending':
                $projects = Project::where('status', 'PENDING')->orderBy('created_at', 'desc')->get();
                $selected = 'pending';
                break;

            case 'ongoing':
                $projects = Project::where('status', 'ONGOING')->orderBy('created_at', 'desc')->get();
                $selected = 'ongoing';
                break;

            case 'done':
                $projects = Project::where('status', 'DONE')->orderBy('created_at', 'desc')->get();
                $selected = 'done';
                break;
        }

        return view('layouts.index')->with(array(
            'projects' => $projects,
            'selected' => $selected
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|min:5',
            'description' => 'required',
            'status' => 'required'
        ));

        Project::create(array(
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'active' => $request->has('active'),
        ));

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('layouts.index')->with('project', Project::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        if ($project != null) {
            return view('layouts.edit')->with(array('project' => $project));
        } else {
            return redirect('/projects');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|min:5',
            'description' => 'required',
            'status' => 'required'
        ));

        Project::where('id', $id)->update(array(
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'active' => $request->has('active'),
        ));

        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return redirect('/projects');
    }
}

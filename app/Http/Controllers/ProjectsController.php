<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all projects
        // $projects = Project::all();
        
        if(Auth::check()) {
            // Get all compnaies of the logged user.
            $projects = Project::where('user_id', Auth::user()->id)->get();
        
            return view('projects.index', ['projects' => $projects]);
        }
        
        return view('auth.login');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        //
        return view('projects.create', ['company_id'=> $company_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Auth::check()) {
            
            $Project = new Project;
            $Project->name = $request->input('name');
            $Project->description = $request->input('description');
            $Project->company_id = $request->input('company_id');
            $Project->user_id = Auth::user()->id;            
            
            $Project->save();
            
            if($Project){
                return redirect()->route('projects.show', ['Project' => $Project->id])
                    ->with('success', 'Project created successfully');
            }
            
            return back()->withInput()->with('errors', 'Error creating new Project');
        }
        
        return back()->withInput()->with('errors', 'You must to be logged to create new Project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $Project)
    {
        //
        $Project = Project::find($Project->id);        
        return view('projects.show', ['project' => $Project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $Project)
    {
        //
        $Project = Project::find($Project->id);
        return view('projects.edit', ['project' => $Project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $Project)
    {
        // save data
        $ProjectUpdate = Project::where('id', $Project->id)
            ->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description')
            ]);
            
        if($ProjectUpdate){
            return redirect()->route('projects.show', ['project'=>$Project->id])
                ->with('success', 'Project updated successfully');   
        }

        // redirect 
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $Project)
    {
        //
        $findProject = Project::find($Project->id);
        if($findProject->delete()){
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
        }
        
        // redirect
        return back()->withInput()->with('errors', 'Project could not be deleted');        
    }
}

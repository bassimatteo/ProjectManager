<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProjectUser;
use Psy\Command\WhereamiCommand;

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
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        
        return view('projects.create', ['company_id'=> $company_id, 'companies'=>$companies]);
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
    public function show(Project $project)
    {
        //
        $project = Project::find($project->id);
        $comments = $project->comments;
        return view('projects.show', ['project' => $project, 'comments' => $comments]);
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
    
    /**
     * Add user to a project
     */
    public function addUser(Request $request){
        
        $project = Project::find($request->input('project_id'));
        $user = User::where('email', $request->input('email'))->first();
        
        if($project && $user){           
            
            $projectUser = ProjectUser::where(['user_id'=> $user->id, 'project_id'=> $project->id])->get();
            if(!$projectUser){
            
                $project->users()->attach($user->id); 
                return redirect()->route('projects.show', ['project'=>$project->id])->with('success', $request->input('email'). ' was added to the project');
            }
            
            return redirect()->route('projects.show', ['project'=>$project->id])->with('errors', 'User already exists');
            
        }
        return redirect()->route('projects.show', ['project'=>$project->id])->with('errors', 'Error adding user to the project');     
        
    }
}

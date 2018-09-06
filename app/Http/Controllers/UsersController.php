<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\PunchInOut;
use App\PunchJustifications;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        
    }
    
    public function userDashboard($user_id = null)
    {
        if(Auth::user()->role->id > 2 && $user_id != Auth::user()->id){
            
            return back()->withInput()->with('title', 'Errore')->with('body', 'Non sei autorizzato ad accedere alla pagina')->with('class', 'alert alert-danger alert-dismissible');
        }
        
        $punchs = DB::table('users')
        ->join('punch_in_outs', 'users.id', '=', 'punch_in_outs.user_id')
        ->join('punch_justifications', 'punch_in_outs.punch_justifications_id', '=', 'punch_justifications.id')
        ->select('users.name as user_name', 'punch_in_outs.*', 'punch_justifications.name as j_name')
        //->orderBy('users.name', 'asc')
        ->orderBy('punch_in_outs.punch_timestamp', 'desc')
        //Se l'utente loggato non è admin o manager può vedere solo le sue timbrature
        ->when(Auth::user()->role->id > 2, function ($query) use ($user_id) {
            return $query->where('users.id', '=', $user_id);
        })
        ->whereNull('punch_in_outs.deleted_at')
        ->get();
        
        $users = User::all();
        $punchJustifications = PunchJustifications::where('visibleDashboard', '=', 1)->get();
        
        $timesheets = DB::select('CALL timesheet(' . $user_id . ')');
        
        return view('users.show', ['punchs' => $punchs, 'users' => $users, 'punch_justifications' => $punchJustifications, 'timesheets' => $timesheets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

<?php
namespace App\Http\Controllers;

use App\PunchInOut;
use App\PunchJustifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \Datetime;
use Validator;

class PunchInOutController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $justifications = PunchJustifications::where('visible', '=', 1)->get();
        
        return view('punchinout.index', [
            'justifications' => $justifications
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // PunchInOut::find(2)->delete();
        $validator = Validator::make($request->all(), [
            'justification' => 'required'
        ]);
        
        if ($validator->fails()) {
            return back()->withInput()
                ->with('title', 'Errore')
                ->with('body', 'Seleziona un gustificativo')
                ->with('class', 'alert alert-danger alert-dismissible');
        }
        
        $user = User::where('badge', $request->input('badge'))->first();
        
        if ($user === null) {
            return back()->withInput()
                ->with('title', 'Errore')
                ->with('body', 'Codice del Badge  non valido')
                ->with('class', 'alert alert-danger alert-dismissible');
        } else {
            
            $lastPunchInOut = PunchInOut::where('user_id', '=', $user->id)->orderBy('id', 'desc')->first();
            // $x = $punchInOut->punchPustification()->first()['in_out'];
            
            $justification = PunchJustifications::where('id', '=', $request->input('justification'))->first();
            
            // Verifica prima timbratura
            if ($lastPunchInOut == null && $justification['in_out'] == 0) {
                
                return back()->withInput()
                    ->with('title', 'Errore')
                    ->with('body', 'Non hai timbrato l\'ingresso')
                    ->with('class', 'alert alert-danger alert-dismissible');
                
                // Verificare lo stato precedente dell'utente
            } else if ($lastPunchInOut != null && strcmp($lastPunchInOut->punchJustification()->first()['in_out'], $justification['in_out']) == 0 ||
                //stato precendete riposo e stato richiesto uscita   
                ($lastPunchInOut != null && $lastPunchInOut->punchJustification()->first()['in_out'] == -1  && $justification['in_out'] == 0 ) ||
                //stato attuale in, business trip... e stato richiesto riposo --> devo prima uscire
                ($lastPunchInOut != null && $lastPunchInOut->punchJustification()->first()['in_out'] == 1  && $justification['in_out'] == -1 )) {
                return back()->withInput()
                    ->with('title', 'Errore')
                    ->with('body', 'Il tuo stato e: ' . strtoupper($lastPunchInOut->punchJustification->name) . '. Utilizza un giustificativo corretto')
                    ->with('class', 'alert alert-danger alert-dismissible');
            }
            
            
            
            date_default_timezone_set("Europe/Rome");
            $punchInOut = new PunchInOut();
            $punchInOut->user_id = $user->id;
            // Se l'utente non sta uscendo, devo selezionare il giustificativo corretto (per raggruppare nella query del calcolo mensile)
            if($request->input('justification') != 2){
                $punchInOut->punch_justifications_id = $request->input('justification');
            } else {
                $pj = PunchJustifications::where('visible', '=', 0)->where('grouping', '=', $lastPunchInOut->punchJustification()->first()['grouping'])->first();
                
                $punchInOut->punch_justifications_id = $pj['id'];
            }
            
            $punchInOut->punch_timestamp = date("Y-m-d H:i:s");
            $punchInOut->save();
            
            if ($punchInOut) {
                $message['title'] = 'Successo';
                $message['body'] = 'Evento registrato';
                return redirect('/punchinouts')->with('title', 'Successo')
                    ->with('body', 'Evento registrato')
                    ->with('class', 'alert alert-success alert-dismissible');
                ;
            }
        }
        return back()->withInput()
            ->with('title', 'Errore')
            ->with('body', 'Errore generico')
            ->with('class', 'alert alert-danger alert-dismissible');
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function show(PunchInOut $punchInOut)
    {
        //
        $punchInOut = PunchInOut::find($punchInOut->id);
        return view('punchInOut.show', [
            'punchInOut' => $punchInOut
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function apiShow($punch_id)
    {
       if (Auth::check() && Auth::user()->role->id < 3) {
            $punchInOut = PunchInOut::find($punch_id);
            if($punchInOut == null)
                return response(null, 404);
            return new \App\Http\Resources\PunchInOut(\App\PunchInOut::find($punch_id));
       } else {
            return response()->json(['message' => 'Non puoi accedere alla risorsa'], 401)->header('Content-Type', 'application/json');
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function edit(PunchInOut $punchInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PunchInOut $punchInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function apiUpdate(Request $request)
    {
        $format = 'd/m/Y H:i';
        $date = DateTime::createFromFormat($format, $request->data . " " . $request->time);
        //Nuova timbratura
        if($date != false && $request->id == 0){
            date_default_timezone_set("Europe/Rome");
            $punchInOut = new PunchInOut;
            $punchInOut->punch_timestamp = $date;
            $punchInOut->user_id = $request->user_id;
            $punchInOut->punch_justifications_id = $request->punch_justifications_id;;
            $punchInOut->save();
           
        } else if ($date != false && PunchInOut::where('id', '=', $request->id)->update(['punch_timestamp' => $date, 'punch_justifications_id' => $request->punch_justifications_id])){
            return response('', 200);
        } else {
            return response('Errore, dato non aggiornato', 500)->header('Content-Type', 'text/plain');
        }
       
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function apiDestroy(PunchInOut $punchInOut)
    {
        if(PunchInOut::destroy($punchInOut->id))
            return response('', 200);
        return response('Errore, impossibile cancellare la timbratura', 500)->header('Content-Type', 'text/plain');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(PunchInOut $punchInOut)
    {
        //
    }
    
    /**
     * Monthly hours worked.
     *
     * @param \App\PunchInOut $punchInOut
     * @return \Illuminate\Http\Response
     */
    public function apiMonthlyHoursWorked(int $userId, int $year, int $month)
    {
        //
    }
}

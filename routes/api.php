<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PunchInOut;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth'])->group(function (){ 

//     Route::get('punchinouts/{punch_in_out}', function ($punch_id) {
        
//         if (Auth::check() && Auth::user()->role->id < 3) {
//             $punchInOut = PunchInOut::find($punch_id);
//             if($punchInOut == null)
//                 return response(null, 404);
//                 return new PunchInOut(\App\PunchInOut::find($punch_id));
//         } else {
//             return response()->json(['message' => 'Non puoi accedere alla risorsa'], 403)->header('Content-Type', 'application/json');
//         }
        
        
        
//     });
    
    
}); 

//Route::get('punchinouts/{punch_in_out}', 'PunchInOutController@ajaxShow');

// Route::get('punchinouts/{punch_in_out}', function ($punch_id) {
    
//    if (Auth::check() && Auth::user()->role->id < 3) {
//         $punchInOut = PunchInOut::find($punch_id);
//         if($punchInOut == null)
//             return response(null, 404);
//         return new PunchInOut(\App\PunchInOut::find($punch_id));
//    } else {
//         return response()->json(['message' => 'Non puoi accedere alla risorsa'], 403)->header('Content-Type', 'application/json');
//    }
    
    
    
// });
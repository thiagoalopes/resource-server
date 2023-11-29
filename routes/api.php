<?php

use App\Models\MovimentacoesModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::get('/', function(){
    return redirect()->route('prepare');
})->name('login');

Route::get('/prepare', function (Request $request) {

    $state = Str::random(40);

    $query = http_build_query([
        'client_id' =>  env('CLIENT_ID'),
        'redirect_uri' => 'http://localhost:8001/api/auth/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
        // 'prompt' => '', // "none", "consent", or "login"
    ]);

    return redirect('http://localhost:8000/oauth/authorize?'.$query);
})->name('prepare');

//http://localhost:8001/api/movimentacoes
Route::get('/auth/callback', function (Request $request) {

    $state = $request->input('state');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $response = Http::asForm()->post('http://192.168.150.20:8000/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'redirect_uri' => 'http://localhost:8001/api/auth/callback',
        'code' => $request->code,
    ]);

    //dd($response);

    return $response->json()['access_token'];
})->name('callback');
*/
Route::get('/movimentacoes', function (Request $request) {
    $movimentacoes = MovimentacoesModel::where('dia', $request->input('dia'))
        ->where('mes', $request->input('mes'))
        ->where('ano', $request->input('ano'))
        ->paginate(100);

    return response()->json($movimentacoes);
    
})->middleware("oauth.introspection");


Route::get('/tokenIsValid', function (Request $request) {
    return response()->json(null, 200);
    
})->middleware("oauth.introspection");
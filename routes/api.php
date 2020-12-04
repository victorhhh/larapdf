<?php
// require "vendor/autoload.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorJPG;
//use Barryvdh\DomPDF\Facade as PDF;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/cupon', function () {

    $saved_path="\barcode.jpg";

    $pdf = PDF::loadView('cupon',compact("saved_path"));

    return $pdf->stream();

   //return view("cupon", compact('saved_path'));
});
Route::post('/cupon', function (Request $req) {


    // echo($req->getContent());
    $folio = strval(round(microtime(true)*1000));

    $generador = new BarcodeGeneratorJPG();
    $saved_path= public_path() . "\barcode.jpg";
    echo file_put_contents($saved_path, $generador->getBarcode($folio, $generador::TYPE_INTERLEAVED_2_5, 3, 100));


});

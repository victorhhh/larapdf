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
    $folio = strval(round(microtime(true)*1000));
    $generador = new BarcodeGeneratorJPG();
    $path_to_save= public_path() . "\\barcodes\\" . $folio . ".jpg";

    file_put_contents($path_to_save, $generador->getBarcode($folio, $generador::TYPE_INTERLEAVED_2_5, 3, 75));


    $saved_path= $folio . ".jpg";
    $lineas = ["hola", "te acabas", "de ganar", "unos", "besotes"];
    // $pdf = PDF::loadView('cupon',compact('saved_path', 'lineas', 'folio'));
    // $pdf->setPaper("letter", "portrait");
    // return $pdf->stream('cupon.pdf');

    return view("cupon", compact('saved_path', 'lineas', 'folio'));
});
Route::post('/cupon', function (Request $req) {


    // echo($req->getContent());







});

<?php
// require "vendor/autoload.php";


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Illuminate\Support\Facades\File; 
use Barryvdh\DomPDF\Facade as PDF;


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
    $folio_local = strval(round(microtime(true)*1000));
    $folio = "75" . $folio_local;
    $generador = new BarcodeGeneratorJPG();
    $path_to_save= public_path() . "\\barcodes\\" . $folio . ".jpg";

    file_put_contents($path_to_save, $generador->getBarcode("47160743887577400000000000", $generador::TYPE_INTERLEAVED_2_5, 2, 75));


    $saved_path= $folio . ".jpg";
    $lineas = ["hola", "te acabas", "de ganar", "unos", "cupones"];
    $pdf = PDF::loadView('cupon',compact('saved_path', 'lineas', 'folio_local'));
    $pdf->setPaper("letter", "portrait");
    // $pdf->save(public_path('files\\'));

    return $pdf->stream('cupon.pdf');

    // return view("cupon", compact('saved_path', 'lineas', 'folio'));
});
Route::post('/cupon', function (Request $req) {

//generate barcode
    $info = json_decode($req->getContent());

    $generador = new BarcodeGeneratorJPG();
    if(!file_exists(public_path('barcodes\\'))){
        File::makeDirectory(public_path('barcodes\\', 777, true));
    }
    $path_to_save= public_path() . "\\barcodes\\" . $info->folio . ".jpg";
    file_put_contents($path_to_save, $generador->getBarcode($info->folio, $generador::TYPE_INTERLEAVED_2_5, 2, 75));

//generate pdf
    $folio_local = $info->folio;
    $saved_path= $info->folio . ".jpg";
    $lineas = $info->lineas;
    $pdf = PDF::loadView('cupon',compact('saved_path', 'lineas', 'folio_local'));
    $pdf->setPaper("letter", "portrait");
    $cupon_file = $info->folio . ".pdf";
   
    if(!file_exists(public_path('files\\'))){
        File::makeDirectory(public_path('files\\', 777, true));
    }
    $pdf->save(public_path('files\\' . $cupon_file));
    $pdf->save(public_path('files\\' . $cupon_file));
    $returned_path =  public_path('files\\' . $cupon_file);

    $respuesta = array(
        "returned_path"=> $returned_path,
        "file_name"=> $cupon_file
    );


    return response()->json($respuesta);

});

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="{{asset('assets\css\bootstrap.min.css')}}" rel="stylesheet">

</head>
<style>
    /* body{
        display: flex;
        justify-content: center;
        align-items: center;
    } */
    img{
        display: block;
        max-width: 50%;
        height: auto;
    }
</style>

<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(480, 800, "Página $PAGE_NUM de $PAGE_COUNT", $font, 11);
            ');
        }
    </script>
<div class="container mb-4" id="ticket">

        <div class="col-6">
            <div class="card">

                    <img id="imgHeader" src="{{asset('assets/cupon-header.jpg')}}" alt="Cabecera con el logotipo de chedraui" class="card-img-top img-fluid"/>



                <div class="card-body">
                    @foreach ($lineas as $linea)
                    <h5 class="card-title font-weight-bold text-center">{{$linea}}</h5>
                    @endforeach



                </div>
                <img src="{{asset('assets/cupon-cinta.jpg')}}" alt="cinta promcional de chedraui" class="img-fluid"/>
                <br />
            <img src="{{asset('barcodes/' . $saved_path)}}" alt="barcode" class="align-self-center img-fluid">
            <p class="text-center">{{$folio}}</p>

                    <img src="{{asset('assets/cupon-footer.jpg')}}" class="card-img-bottom img-fluid"  />


            </div>
        </div>

</div>


</body>
</html>

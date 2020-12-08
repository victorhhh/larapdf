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
    @font-face {
    font-family: 'Your custom font name';
    src: url("../../storage/fonts/Roboto-Regular.ttf") format("truetype");
    font-weight: normal;
    font-style: normal;
    }
    body{
        font-family: "Roboto-Regular"
    }
    img{
        display: block;
        max-width: 100%;
        height: auto;
    }
    .centrar-img{
        margin-top: 2%;
        margin-left: 7%

    }
    .center-card{
        display: block;
        margin-left: 20%;
        margin-right: 20%;

    }
    .center-text{

       text-align: center;

    }
</style>

<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 750, "Página $PAGE_NUM de $PAGE_COUNT", $font, 11);
            ');
        }
    </script>

<div class="container center-card" id="ticket">
        <div class="col-6 justify-center">
            <div class="card">
                    <img id="imgHeader" src="{{asset('assets/cupon-header.jpg')}}" alt="Cabecera con el logotipo de chedraui" class="card-img-top img-fluid"/>
                <div class="card-body  ">
                    @foreach ($lineas as $linea)
                    <h5 class="card-title center-text font-weight-bold">{{$linea}}</h5>
                    @endforeach
                </div>
                <img src="{{asset('assets/cupon-cinta.jpg')}}" alt="cinta promcional de chedraui" class="img-fluid "/>
                <br />

        <img src="{{asset('barcodes/' . $saved_path)}}" alt="barcode" class="img-fluid centrar-img">
            <p class="center-text">{{$folio_local}}</p>

                    <img src="{{asset('assets/cupon-footer.jpg')}}" class="card-img-bottom img-fluid"  />
            </div>
        </div>


</div>



</body>
</html>

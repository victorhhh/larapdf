<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

</head>

<body>
<div class="container" id="ticket">

        <div class="col-6 ">
            <div class="card">
                <img id="imgHeader" src="{{asset('assets/cupon-header.jpg')}}" class="card-img-top"/>

                <div class="card-body align-self-center">
                    <h5 class="card-title">Titulo</h5>
                    <p class="card-text">precio</p>
                </div>
                <img src="{{asset('assets/cupon-cinta.jpg')}}" alt="" />
                <br />
                <img src="{{asset('assets/barcode.jpg')}}" alt="barcode" class="col-6 align-self-center">
                <img src="{{asset('assets/cupon-footer.jpg')}}" class="card-img-bottom" alt="" />
            </div>
        </div>

</div>


</body>
</html>

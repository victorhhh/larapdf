<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario PDF</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <style>
        .striped {
            background-color: rgba(0, 0, 0, .05);
        }
        table{
            page-break-inside:auto;
        }
    </style>
</head>

<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(480, 800, "Página $PAGE_NUM de $PAGE_COUNT", $font, 11);
            ');
        }
    </script>
    <div class="container-fluid">
        <h1 class="border-bottom border-dark pb-2 mb-4">
            <img width="200" src="{{ asset('img/fge_logo2020.png') }}" alt="logo fge">
            <span class="float-right text-right">
                <span class="h3">Calendario</span><br>
                <span style="font-size: 13px;" class="font-weight-normal">Del {{ $dates['start'] }} a {{ $dates['end'] }}</span>
            </span>
        </h1>
        <table class="table">
            <thead>
                <tr>
                    <!-- <th style="border-top: none;" class="text-center border-top-0">Fecha</th> -->
                    <th style="border-top: none;" class="text-center border-top-0">Proceso Penal</th>
                    <th style="border-top: none;" class="text-center border-top-0">Evento</th>
                    @if($observacion === true)
                    <th style="border-top: none;" class="text-center border-top-0">Observaciones</th>
                    @endif
                </tr>
            </thead>
            <tbody class="border-bottom">
                @php
                    $date = '';
                @endphp
                @foreach($eventos as $evento)
                @if($date != $evento['start'])
                <tr>
                    <th style="font-size: 13px;" colspan="3" class="text-center">{{ $evento['start'] }}</th>
                </tr>
                @php
                    $date = $evento['start'];
                    $striped = true;
                @endphp
                @endif
                @php
                    $pos = strpos($evento['name'], ']') + 1;
                    $event = substr($evento['name'], 0, $pos);
                    $name = substr($evento['name'], $pos, strlen($evento['name']));
                @endphp
                <tr>
                    <td style="border-left: 10px solid {{ $evento['color'] }};" class="text-center {{ $striped ? 'striped' : '' }}" style="font-size: 13px;">{{ $evento['ppa'] }}</td>
                    <td style="font-size: 12px;" class="border-right {{ $striped ? 'striped' : '' }}"><strong style="{{ $event == '[Finaliza]' ? 'color:red;' : '' }}">{{ $event }}</strong> {{ $name }}</td>
                    @if($observacion === true)
                    <td style="font-size: 10px;" class="border-right {{ $striped ? 'striped' : '' }}">{{ $evento['observacion'] }}</td>
                    @endif
                </tr>
                @php
                    $striped = !$striped;
                @endphp
                @endforeach
                @if(count($eventos) === 0)
                <tr>
                    <td colspan="2" class="text-center">SIN EVENTOS</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
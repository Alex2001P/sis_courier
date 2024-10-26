<!DOCTYPE html>
<html>

<head>
    <style>
        /* Estilos CSS */
        html {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            border: none;
        }

        .ticket {
            width: 85%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin: 0px auto;
            margin-top: 10px;
            padding: 5px;
        }

        h1 {
            font-size: 14px;
            margin: 0;
            text-align: center;
            padding: 3px;
        }

        h2 {
            font-size: 9px;
        }

        p {
            font-size: 8px;
            line-height: 1.2;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
        }

        .ticket-info p {
            margin: 0
        }

        hr {
            color: rgb(199, 198, 198);
        }

        .verde {
            background: green;
            padding: 3px 8px;
            color: white;
        }

        .rojo {
            background: rgb(238, 24, 0);
            padding: 3px 8px;
            color: white;
        }

        .azul {
            background: rgb(0, 69, 207);
            padding: 3px 8px;
            color: white;
        }

        .naranja {
            background: rgb(237, 114, 0);
            padding: 3px 8px;
            color: white;
        }

        .ticket-info {
            text-align: center;
            margin-top: 20px;
        }

        .numero {
            background: black;
            color: white;
            padding: 5px 10px;
            font-size: 9px;
        }

        .show {
            font-style: italic;
        }

        img {
            width: 80px;
            margin: 5px;
        }
    </style>
</head>

<body>
    @foreach ($datos as $datos)
        <div class="ticket">
            @foreach ($empresa as $item)
                <h1>{{ $item->nombre }}</h1>
                <a class="numero">Ticket N° {{ $datos->numero_reg }}</a>
                <hr>
                <h2>DATOS DE LA EMPRESA</h2>
                <p><strong>Ubicacion:</strong> {{ $item->ubicacion }}</p>
                <p><strong>Teléfono:</strong> {{ $item->telefono }}</p>
                <p><strong>Correo:</strong> {{ $item->correo }}</p>
                {{-- <p><strong>Descripcion:</strong> {{ $item->descripcion }}</p> --}}
            @endforeach
            <hr>
            <h2>DATOS DEL REMITENTE</h2>
            <p><strong>DPI:</strong> {{ $datos->dniRemitente }}</p>
            <p><strong>Nombre / Razon Social:</strong> {{ $datos->nomRemitente }}</p>
            <p><strong>Teléfono:</strong> {{ $datos->remitenteTelefono }}</p>
            <p><strong>Dirección:</strong> {{ $datos->remitenteDireccion }}</p>
            <hr>
            <h2>DATOS DEL CONSIGNATARIO</h2>
            <p><strong>DPI:</strong> {{ $datos->dniReceptor }}</p>
            <p><strong>Nombre / Razon Social:</strong> {{ $datos->nomReceptor }}</p>
            <p><strong>Teléfono:</strong> {{ $datos->receptorTelefono }}</p>
            <p><strong>Dirección:</strong> {{ $datos->receptorDireccion }}</p>
            <hr>
            <h2>LUGAR DE PARTIDA / LLEGADA</h2>
            <p><strong>Lugar de partida:</strong>
                {{ $datos->desde_barrio . ' - ' . $datos->desde_provincia_nombre . ' - ' . $datos->desde_departamento_nombre . ' - ' . $datos->desde_direccion }}
            </p>
            <p><strong>Lugar de llegada:</strong>
                {{ $datos->hasta_barrio . ' - ' . $datos->hasta_provincia_nombre . ' - ' . $datos->hasta_departamento_nombre . ' - ' . $datos->hasta_direccion }}
            </p>
            <hr>
            <h2>DATOS DEL ENVÍO</h2>

            <div>
                <p><b>Tipo envio:</b> {{ $datos->tipo_envio }}</p>

                @if ($datos->tipo_envio != 'documento')
                    <p><b>Tarifa:</b> {{ $datos->tarifa }}</p>
                @endif

                @if ($datos->tarifa == 'peso')
                    <p><b>Km:</b> {{ $datos->km }}</p>
                    <p><b>Peso (KG):</b> {{ $datos->peso }}</p>
                @endif

                @if ($datos->tarifa == 'volumen')
                    <p><b>Km:</b> {{ $datos->km }}</p>
                    <p><b>Largo (cm):</b> {{ $datos->largo }}</p>
                    <p><b>Ancho (cm):</b> {{ $datos->ancho }}</p>
                    <p><b>Alto (cm):</b> {{ $datos->alto }}</p>
                @endif
            </div>

            <p><strong>Cantidad:</strong> {{ $datos->cantidad }}</p>
            <p><strong>Precio: Q</strong>{{ $datos->precio }} .00</p>
            <p><strong>Estado de pago:</strong>
                @if ($datos->pago_estado == 1)
                    <a class="verde">PAGADO</a>
                @else
                    <a class="rojo">NO PAGADO</a>
                @endif
            </p>
            <p><strong>Fecha de envío:</strong> {{ $datos->fecha_salida }}</p>
            <p><strong>Fecha de recojo:</strong> {{ $datos->fecha_recojo }}</p>
            <p><strong>Estado de Envío:</strong>
                @if ($datos->envio_estado == 1)
                    <a class="azul">{{ strtoupper($datos->nombre) }}</a>
                @else
                    @if ($datos->envio_estado == 2)
                        <a class="naranja">{{ strtoupper($datos->nombre) }}</a>
                    @else
                        @if ($datos->envio_estado == 3)
                            <a class="rojo">{{ strtoupper($datos->nombre) }}</a>
                        @else
                            @if ($datos->envio_estado == 4)
                                <a class="verde">{{ strtoupper($datos->nombre) }}</a>
                            @endif
                        @endif
                    @endif
                @endif
            </p>


            <p><strong>Descripcion:</strong> {{ $datos->descripcion }}</p>
        </div>
        <div class="ticket-info">
            <p class="show">Revisa el estado de tu envio aqui:</p>
            <img src="{{ asset("storage/qr-ticket-envio/$id.png") }}"
                alt="{{ asset("storage/qr-ticke-envio/$id.png") }}">
            <p><span>Fecha y hora de emision del ticket:</span> {{ date('d-m-Y h:i:s') }}</p>
        </div>


    @endforeach
</body>

</html>

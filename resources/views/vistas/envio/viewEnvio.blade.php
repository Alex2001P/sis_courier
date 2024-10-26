@extends('layouts/app')
@section('titulo', 'Registro de envios')
@section('content')

    <style>
        legend {
            background-color: rgb(79, 227, 136);
            color: rgb(0, 0, 0);
            padding: 7px 12px;
            font-weight: 500;
        }

        legend.etiqueta {
            color: rgb(0, 0, 0);
            padding: 4px 9px;
            width: max-content;
            font-size: 15px;
        }



        .checkbox-toggle input:checked+label:before {
            background-color: #00a20e;
            padding: 12px;
            font-size: 40px;
        }

        .checkbox-toggle input+label:before {
            background-color: #f90000;
            padding: 12px;
            font-size: 40px;
        }

        #miLabel {
            font-weight: bold;
        }


        #numero {
            background: rgb(0, 0, 0);
            color: white;
            cursor: default;
            border: none;
        }

        #numero:hover {
            background: black;
            color: white;
        }

        .pagar,
        .noPagar {
            height: max-content !important;
            padding: 10px 20px;
        }

        .error-message {
            position: absolute;
            bottom: -20px;
        }
    </style>



    <h4 class="text-center text-secondary">DATOS DEL ENVIO</h4>
    @if (session('INCORRECTO'))
        <div class="alert alert-danger">{{ session('INCORRECTO') }}</div>
    @endif

    @if (session('CORRECTO'))
        <div class="alert alert-success">{{ session('CORRECTO') }}</div>
    @endif

    @if (session('CORRECTO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "{{ session('CORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif

    @if (session('INCORRECTO'))
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "{{ session('INCORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
        </script>
    @endif

    <div id="incorrecto"></div>
    <div id="correcto"></div>


    @foreach ($sql as $datos)
        <div class="modal-body bg-light">
            <form action="{{ route('envio.update', $datos->id_envio) }}" id="formMod" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="input-group input-group-lg col-12">
                        <span class="input-group-btn">
                            <button id="numero" class="btn bootstrap-touchspin-down" type="button">Número [Ult. Registro
                                {{ $ultimoRegistro }}]</button>
                        </span>
                        <input readonly required id="cod" type="number" placeholder="N° de orden de envío"
                            name="numero_envio" class="form-control input-lg" style="display: block;"
                            value="{{ old('numero_envio', $datos->numero_reg) }}">
                    </div>
                    @error('numero_envio')
                        <p class="error-message text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <legend>Datos del Remitente</legend>
                    <input type="hidden" name="idRemitente" value="{{ $datos->id_remitente }}">
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                        <input required type="number" placeholder="DPI" class="input input__text"
                            name="dni_del_remitente" value="{{ old('dni_del_remitente', $datos->dniRemitente) }}">
                        @error('dni_del_remitente')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-8">
                        <input required type="text" placeholder="Nombre o Razon Social" class="input input__text"
                            name="nombre_del_remitente" value="{{ old('nombre_del_remitente', $datos->nomRemitente) }}">
                        @error('nombre_del_remitente')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                        <input type="number" placeholder="Teléfono" class="input input__text" name="telefono_del_remitente"
                            value="{{ old('telefono_del_remitente', $datos->remitenteTelefono) }}">
                        @error('telefono_del_remitente')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-8">
                        <input type="text" placeholder="Dirección" class="input input__text"
                            name="direccion_del_remitente"
                            value="{{ old('direccion_del_remitente', $datos->remitenteDireccion) }}">
                        @error('direccion_del_remitente')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                </div>

                <div>
                    <legend>Datos del Consignatario</legend>
                    <input type="hidden" name="idReceptor" value="{{ $datos->id_receptor }}">
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                        <input required type="number" placeholder="DPI" class="input input__text"
                            name="dni_del_consignatario" value="{{ old('dni_del_consignatario', $datos->dniReceptor) }}">
                        @error('dni_del_consignatario')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-8">
                        <input required type="text" placeholder="Nombre o Razon Social" class="input input__text"
                            name="nombre_del_consignatario"
                            value="{{ old('nombre_del_consignatario', $datos->nomReceptor) }}">
                        @error('nombre_del_consignatario')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                        <input type="number" placeholder="Teléfono" class="input input__text"
                            name="telefono_del_consignatario"
                            value="{{ old('telefono_del_consignatario', $datos->receptorTelefono) }}">
                        @error('telefono_del_consignatario')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-8">
                        <input type="text" placeholder="Dirección" class="input input__text"
                            name="direccion_del_consignatario"
                            value="{{ old('direccion_del_consignatario', $datos->receptorDireccion) }}">
                        @error('direccion_del_consignatario')
                            <p class="error-message text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                </div>

                <div>
                    <legend>Lugar de Salida - Llegada</legend>
                    <div>
                        <legend class="etiqueta">Lugar de partida</legend>
                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                            <label class="title">Departamento</label>
                            <select required class="input input__select" name="departamento_partida"
                                id="departamento_partida">
                                <option value="">Seleccionar...</option>
                                @foreach ($departamento as $item)
                                    <option value="{{ $item->idDepa }}"
                                        {{ $datos->desdeIdDepa == $item->idDepa ? 'selected' : '' }}>
                                        {{ $item->Departamento }}</option>
                                @endforeach
                            </select>
                            @error('departamento_partida')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                            <label class="title">Municipio</label>
                            <select required class="input input__select" name="provincia_partida" id="provincia_partida">
                                <option value="">Seleccionar...</option>
                                @foreach ($provincia as $item)
                                    <option value="{{ $item->idProv }}"
                                        {{ $datos->desdeIdProv == $item->idProv ? 'selected' : '' }}>
                                        {{ $item->Provincia }}</option>
                                @endforeach
                            </select>
                            @error('provincia_partida')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                            <label class="title">Distrito</label>
                            <input type="text" class="input input__text" name="distrito_partida"
                                value="{{ $datos->desde_barrio }}">
                            @error('distrito_partida')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-12">
                            <input type="text" class="input input__select" name="direccion_partida"
                                placeholder="Dirección" value="{{ old('direccion_partida', $datos->desde_direccion) }}">
                            @error('direccion_partida')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <legend class="etiqueta">Lugar de llegada</legend>
                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                            <label class="title">Departamento</label>
                            <select required class="input input__select" name="departamento_llegada"
                                id="departamento_llegada">
                                <option value="">Seleccionar...</option>
                                @foreach ($departamento as $item)
                                    <option value="{{ $item->idDepa }}"
                                        {{ $datos->hastaIdDepa == $item->idDepa ? 'selected' : '' }}>
                                        {{ $item->Departamento }}</option>
                                @endforeach
                            </select>
                            @error('departamento_llegada')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                            <label class="title">Municipio</label>
                            <select required class="input input__select" name="provincia_llegada" id="provincia_llegada">
                                <option value="">Seleccionar...</option>
                                @foreach ($provincia2 as $item)
                                    <option value="{{ $item->idProv }}"
                                        {{ $datos->hastaIdProv == $item->idProv ? 'selected' : '' }}>
                                        {{ $item->Provincia }}</option>
                                @endforeach
                            </select>
                            @error('provincia_llegada')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-4">
                            <label class="title">Distrito</label>
                            <input type="text" class="input input__text" name="distrito_llegada"
                                value="{{ $datos->hasta_barrio }}">
                            @error('distrito_llegada')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-md-12">
                            <input required type="text" class="input input__select" name="direccion_llegada"
                                placeholder="Dirección" value="{{ old('direccion_llegada', $datos->hasta_direccion) }}">
                            @error('direccion_llegada')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>


                <div>
                    <legend>Datos del Envio</legend>
                    <div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-sm-6 col-md-3">
                            <label class="title">Tipo de envio</label>
                            <select required class="input input__select" name="tipo_envio" id="tipo_envio">
                                <option value="">Seleccionar...</option>
                                @foreach ($tipo_envio as $item)
                                    <option {{ $datos->tipo_envio == $item->tipo ? 'selected' : '' }}
                                        value="{{ $item->tipo }}" data-idenvio="{{ $item->id_tipo_envio }}">
                                        {{ $item->tipo }}</option>
                                @endforeach
                            </select>
                            @error('tipo_envio')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="fl-flex-label mb-4 px-2 col-12 col-sm-6 col-md-3" hidden id="tarifa">
                            <label class="title">Tarifa</label>
                            <select class="input input__select" name="tarifa" id="value_tarifa">
                                <option value="">Seleccionar...</option>
                                <option {{ $datos->tarifa == 'peso' ? 'selected' : '' }} value="peso">Tarifa Peso
                                </option>
                                <option {{ $datos->tarifa == 'volumen' ? 'selected' : '' }} value="volumen">Tarifa Volumen
                                </option>
                            </select>
                            @error('tarifa')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="fl-flex-label mb-4 px-2 col-12 col-sm-6 col-md-3" hidden id="km">
                            <label class="title">KM</label>
                            <input class="input input__select" type="number" name="km"
                                value="{{ old('km', $datos->km) }}" id="kmvalue">
                            @error('km')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3" hidden id="peso">
                            <label class="title">Peso (KG)</label>
                            <input class="input input__select" type="number" name="peso" step="0.01"
                                id="pesovalue" value="{{ old('peso', $datos->peso) }}">
                            @error('peso')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3" id="largo" hidden>
                            <label class="title">Largo (cm)</label>
                            <input class="input input__select" type="number" name="largo" step="0.01"
                                value="{{ old('largo', $datos->largo) }}" id="value_largo">
                            @error('largo')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3" id="ancho" hidden>
                            <label class="title">Ancho (cm)</label>
                            <input class="input input__select" type="number" name="ancho" step="0.01"
                                value="{{ old('ancho', $datos->ancho) }}" id="value_ancho">
                            @error('ancho')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3" id="alto" hidden>
                            <label class="title">Alto (cm)</label>
                            <input class="input input__select" type="number" name="alto" step="0.01"
                                value="{{ old('alto', $datos->alto) }}" id="value_alto">
                            @error('alto')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3">
                            <label class="title">Cantidad</label>
                            <input required class="input input__select" type="number" name="cantidad"
                                value="{{ old('cantidad', $datos->cantidad) }}">
                            @error('cantidad')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3">
                            <label class="title">Precio</label>
                            <input required class="input input__select" type="text" name="precio" id="precio"
                                value="{{ old('precio', $datos->precio) }}">
                            @error('precio')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3">
                            <label class="title">Estado de pago</label>
                            @if ($datos->pago_estado == '1')
                                <span style="color: rgb(21, 181, 0);font-size: 38px;"><i
                                        class="fas fa-toggle-on"></i></span>
                            @else
                                <span style="color: red;font-size: 38px;"><i class="fas fa-toggle-on"></i></span>
                            @endif

                            @error('estado_pago')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3">
                            <label class="title">Fecha de envío</label>
                            <input required class="input input__select" type="date"
                                value="{{ old('fecha_salida', $datos->fecha_salida) }}" name="fecha_salida">
                            @error('fecha_salida')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-6">
                            <label class="title">Observaciones</label>
                            <textarea required name="descripcion" class="input input__select" rows="2" placeholder="Descripcion">{{ old('descripcion', $datos->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 px-2 col-12 col-sm-6 col-md-3" hidden>
                            <label class="title">Fecha de recojo <button type="button" id="hoy"
                                    class="btn btn-secondary btn-sm">HOY</button></label>
                            <input class="input input__select" type="text"
                                value="{{ old('fecha_recojo', $datos->fecha_recojo) }}" name="fecha_recojo"
                                id="fechaRecojo">
                            @error('fecha_recojo')
                                <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                </div>

            </form>
            <div class="text-right p-2 d-flex justify-content-end flex-wrap gap-2 col-12">
                <button type="button" class="btn btn-success" id="boton" hidden>Calcular</button>

                <a href="{{ route('envio.index') }}" class="btn btn-secondary"><i class="fas fa-caret-left"></i>
                    Atras</a>

                @if ($datos->pago_estado == '1')
                    <form action="{{ route('eliminar.pago', $datos->id_envio) }}" method="get"
                        class="d-inline formulario-noPagar">
                    </form>
                    <a class="btn btn-sm bg-success noPagar"data-id="{{ $datos->id_envio }}"><i class="fas fa-check"></i>
                        PAGADO</a>
                @else
                    <form action="{{ route('realizar.pago', $datos->id_envio) }}" method="get"
                        class="d-inline formulario-pagar">
                    </form>
                    <a class="btn btn-sm bg-danger pagar"data-id="{{ $datos->id_envio }}"><i class="fas fa-times"></i>
                        DEBE</a>
                @endif

                @if ($datos->envio_estado == '1')
                    <a data-toggle="modal" data-target="#estadoEnvio" class="btn bg-primary"><i
                            class="fas fa-people-carry"></i> {{ strtoupper($datos->nombre) }}</a>
                @else
                    @if ($datos->envio_estado == '2')
                        <a data-toggle="modal" data-target="#estadoEnvio" class="btn bg-warning"><i
                                class="fas fa-car-side"></i> {{ strtoupper($datos->nombre) }}</a>
                    @else
                        @if ($datos->envio_estado == '3')
                            <a data-toggle="modal" data-target="#estadoEnvio" class="btn bg-danger"><i
                                    class="fas fa-times"></i> {{ strtoupper($datos->nombre) }}</a>
                        @else
                            @if ($datos->envio_estado == '4')
                                <a data-toggle="modal" data-target="#estadoEnvio" class="btn bg-success"><i
                                        class="fas fa-check"></i> {{ strtoupper($datos->nombre) }}</a>
                            @endif
                        @endif
                    @endif
                @endif


                <form action="{{ route('envio.destroy', $datos->id_envio) }}" method="POST"
                    class="d-inline formulario-eliminar">
                    @csrf
                    @method('DELETE')
                </form>
                <a class="btn btn-danger eliminar" data-id="{{ $datos->id_envio }}"><i class="fas fa-trash-alt"></i>
                    Eliminar Registro</a>

                <a href="{{ route('pdf.ticketRegistro', $datos->id_envio) }}" target="_blank" class="btn btn-primary"><i
                        class="fas fa-ticket-alt"></i>
                    Ticket</a>

                <button form="formMod" type="submit" value="ok" name="btnmodificar" class="btn bg-primary"><i
                        class="fas fa-save"></i> Guardar cambios</button>
            </div>
        </div>


        <!-- Modal para cambiar estado de envio-->
        <div class="modal fade" id="estadoEnvio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title w-100" id="exampleModalLabel">CAMBIAR ESTADO DE ENVIO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="{{ route('estado.recepcionado', $datos->id_envio) }}"
                                    class="btn bg-primary">RECEPCIONADO</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('estado.enTransito', $datos->id_envio) }}" class="btn bg-warning">EN
                                    TRANSITO</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('estado.enDestino', $datos->id_envio) }}" class="btn bg-danger">EN
                                    DESTINO</a>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('estado.entregado', $datos->id_envio) }}"
                                    class="btn bg-success">ENTREGADO</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach


    <script>
        //buscar distrito por ajax
        let departamento_partida = document.getElementById("departamento_partida");
        let provincia_partida = document.getElementById("provincia_partida");
        let distrito_partida = document.getElementById("distrito_partida");


        let departamento_llegada = document.getElementById("departamento_llegada");
        let provincia_llegada = document.getElementById("provincia_llegada");
        let distrito_llegada = document.getElementById("distrito_llegada");

        departamento_partida.addEventListener("change", buscarProvinciaPartida)
        provincia_partida.addEventListener("change", buscarDistritoPartida)

        departamento_llegada.addEventListener("change", buscarProvinciaLlegada)
        provincia_llegada.addEventListener("change", buscarDistritoLlegada)


        function buscarProvinciaPartida() {

            let departamento_partida = document.getElementById("departamento_partida").value;
            let departamento_llegada = document.getElementById("departamento_llegada").value;
            var ruta = "{{ url('buscar-provincia') }}-" + departamento_partida + "-" + departamento_llegada + "";

            $.ajax({
                url: ruta,
                type: "get",
                success: function(data) {
                    let option = '';
                    let defecto = `<option value="">Seleccionar...</option>`;
                    data.datos.forEach(function(ele) {
                        option +=
                            `<option value="${ele.idProv}">${ele.Provincia}</option>`
                    });
                    let nuevoOption = `${defecto}${option}`;
                    provincia_partida.innerHTML = nuevoOption;

                    //poner el km en el input
                    document.getElementById("kmvalue").value = data.km
                },
                error: function(data) {
                    let option = `<option value="">Seleccionar...</option>`;
                    provincia_partida.innerHTML = option;
                }
            })
            buscarDistritoPartida()
        }

        function buscarDistritoPartida() {
            let provincia_partida = document.getElementById("provincia_partida").value;

            var ruta = "{{ url('buscar-distrito') }}-" + provincia_partida + "";

            $.ajax({
                url: ruta,
                type: "get",
                success: function(data) {
                    let option;
                    let defecto = `<option value="">Seleccionar...</option>`;
                    data.datos.forEach(function(ele) {
                        option += `<option value="${ele.idDist}">${ele.Distrito}</option>`
                    });
                    let nuevoOption = `${defecto}${option}`;
                    distrito_partida.innerHTML = nuevoOption;
                },
                error: function(data) {
                    let option = `<option value="">Seleccionar...</option>`;
                    distrito_partida.innerHTML = option;
                }
            })
        }



        function buscarProvinciaLlegada() {

            let departamento_llegada = document.getElementById("departamento_llegada").value;
            let departamento_partida = document.getElementById("departamento_partida").value;
            var ruta = "{{ url('buscar-provincia') }}-" + departamento_llegada + "-" + departamento_partida + "";

            $.ajax({
                url: ruta,
                type: "get",
                success: function(data) {
                    let option;
                    let defecto = `<option value="">Seleccionar...</option>`;
                    data.datos.forEach(function(ele) {
                        option += `<option value="${ele.idProv}">${ele.Provincia}</option>`
                    });
                    let nuevoOption = `${defecto}${option}`;
                    provincia_llegada.innerHTML = nuevoOption;
                    //poner el km en el input
                    document.getElementById("kmvalue").value = data.km
                },
                error: function(data) {
                    let option = `<option value="">Seleccionar...</option>`;
                    provincia_llegada.innerHTML = option;
                }
            })
            buscarDistritoLlegada()
        }

        function buscarDistritoLlegada() {
            let provincia_llegada = document.getElementById("provincia_llegada").value;

            var ruta = "{{ url('buscar-distrito') }}-" + provincia_llegada + "";

            $.ajax({
                url: ruta,
                type: "get",
                success: function(data) {
                    let option;
                    let defecto = `<option value="">Seleccionar...</option>`;
                    data.datos.forEach(function(ele) {
                        option += `<option value="${ele.idDist}">${ele.Distrito}</option>`
                    });
                    let nuevoOption = `${defecto}${option}`;
                    distrito_llegada.innerHTML = nuevoOption;
                },
                error: function(data) {
                    let option = `<option value="">Seleccionar...</option>`;
                    distrito_llegada.innerHTML = option;
                }
            })
        }
    </script>

    <script>
        let hoy = document.getElementById("hoy")
        hoy.addEventListener("click", fechaHoy)

        function fechaHoy() {
            //poner la fecha y hora actual en el input con id fechaRecojo
            let fechaRecojo = document.getElementById("fechaRecojo")
            let fecha = new Date()
            let dia = fecha.getDate()
            let mes = fecha.getMonth() + 1
            let anio = fecha.getFullYear()
            let hora = fecha.getHours()
            let minutos = fecha.getMinutes()
            let segundos = fecha.getSeconds()
            fechaRecojo.value = `${anio}-${mes}-${dia} ${hora}:${minutos}:${segundos}`
        }
    </script>

    <script>
        //ejecutar la funcion mostrarTarifa al cargar la pagina y al cambiar el tipo de envio
        //window.onload = mostrarTarifa
        //window.onload = ocultarTarifa

        //llamar a todas las funciones
        document.addEventListener("DOMContentLoaded", mostrarTarifa)
        document.addEventListener("DOMContentLoaded", ocultarTarifa)
        document.addEventListener("DOMContentLoaded", ponerPrecioCero)
        document.addEventListener("DOMContentLoaded", ocultarPeso)
        document.addEventListener("DOMContentLoaded", ocultarVolumen)
        document.addEventListener("DOMContentLoaded", mostrarVolumen)
        document.addEventListener("DOMContentLoaded", mostrarBotonCalcular)
        document.addEventListener("DOMContentLoaded", verificarTarifa)




        document.getElementById("tipo_envio").addEventListener("change", mostrarTarifa)
        document.getElementById("tipo_envio").addEventListener("change", ocultarTarifa)
        document.getElementById("tipo_envio").addEventListener("change", buscarPrecio)


        //hacer una funcion si tipo_envio esta en SELECCIONAR... entonces poner en precio 0
        document.getElementById("tipo_envio").addEventListener("change", ponerPrecioCero)

        function ponerPrecioCero() {
            let tipo_envio = document.getElementById("tipo_envio")
            tipo_envio = tipo_envio.value
            if (tipo_envio == "") {
                document.getElementById("precio").value = 0
            }

        }


        //mostrar el select de tarifa solo si el tipo de envio esta seleccionado en paquete, caso contrario ocultar
        function mostrarTarifa() {
            let tipo_envio = document.getElementById("tipo_envio")
            tipo_envio = tipo_envio.value
            if (tipo_envio == "paquete" || tipo_envio == "paquetes") {
                document.getElementById("tarifa").hidden = false
                document.getElementById("peso").hidden = false
                console.log("funciona")
            } else {
                document.getElementById("tarifa").hidden = true
                document.getElementById("peso").hidden = true
                console.log("error")
            }
        }

        //si el tipo de envio es documento, entonces ocultar tarifa y km
        function ocultarTarifa() {
            let tipo_envio = document.getElementById("tipo_envio")
            tipo_envio = tipo_envio.value
            if (tipo_envio == "documento" || tipo_envio == "documentos") {
                document.getElementById("tarifa").hidden = true
                document.getElementById("km").hidden = true
            } else {
                document.getElementById("tarifa").hidden = false
                document.getElementById("km").hidden = false
            }
        }

        //si tarifa esta seleccionado en valumen, entonces oculatar peso; caso contrario mostrar
        document.getElementById("value_tarifa").addEventListener("change", ocultarPeso)

        function ocultarPeso() {
            let tarifa = document.getElementById("value_tarifa")
            tarifa = tarifa.value
            if (tarifa == "volumen") {
                document.getElementById("peso").hidden = true
            } else {
                document.getElementById("peso").hidden = false
            }

            //ocultar si tipo de envio es documentos
            let tipo_envio = document.getElementById("tipo_envio")
            tipo_envio = tipo_envio.value
            if (tipo_envio == "documento" || tipo_envio == "documentos") {
                document.getElementById("peso").hidden = true
            }

        }


        //mostrar largo,ancho y alto solo si tarifa es volumen; caso contrario ocultar
        document.getElementById("value_tarifa").addEventListener("change", mostrarVolumen)

        function mostrarVolumen() {
            let tarifa = document.getElementById("value_tarifa")
            tarifa = tarifa.value
            if (tarifa == "volumen") {
                document.getElementById("largo").hidden = false
                document.getElementById("ancho").hidden = false
                document.getElementById("alto").hidden = false
            } else {
                document.getElementById("largo").hidden = true
                document.getElementById("ancho").hidden = true
                document.getElementById("alto").hidden = true
            }
        }

        // si tipo envio es documentos, entonces ocultar largo,ancho y alto
        document.getElementById("tipo_envio").addEventListener("change", ocultarVolumen)

        function ocultarVolumen() {
            let tipo_envio = document.getElementById("tipo_envio")
            tipo_envio = tipo_envio.value
            if (tipo_envio == "documento" || tipo_envio == "documentos") {
                document.getElementById("largo").hidden = true
                document.getElementById("ancho").hidden = true
                document.getElementById("alto").hidden = true
            } else {
                document.getElementById("largo").hidden = false
                document.getElementById("ancho").hidden = false
                document.getElementById("alto").hidden = false
            }
        }

        //mostrar el boton calcular solo si el tipo de envio no es documentos
        document.getElementById("tipo_envio").addEventListener("change", mostrarBotonCalcular)

        function mostrarBotonCalcular() {
            let tipo_envio = document.getElementById("tipo_envio")
            tipo_envio = tipo_envio.value
            if (tipo_envio == "documento" || tipo_envio == "documentos") {
                document.getElementById("boton").hidden = true
            } else {
                document.getElementById("boton").hidden = false
            }
        }

        //si tarifa esta seleccionado en peso, entonces al presionar el boton calcular, ejecutar la funcion calcularTarifaPeso
        //si tarifa esta seleccionado en volumen, entonces al presionar el boton calcular, ejecutar la funcion calcularTarifaVolumen

        //verificar que valor esta seleccionado en tarifa
        document.getElementById("value_tarifa").addEventListener("change", verificarTarifa)

        function verificarTarifa() {
            let tarifa = document.getElementById("value_tarifa")
            tarifa = tarifa.value
            if (tarifa == "peso") {
                document.getElementById("boton").addEventListener("click", calcularTarifaPeso)
            } else {
                document.getElementById("boton").addEventListener("click", calcularTarifaVolumen)
            }
        }



        //ajax para poner el precio si el TIPO_ENVIO ES DOCUMENTOS
        function buscarPrecio() {
            let selectElement = document.getElementById("tipo_envio");
            let selectedOption = selectElement.options[selectElement.selectedIndex];
            let tipo_envio = selectedOption.getAttribute("data-idEnvio");

            var ruta = "{{ url('buscar-precio') }}-" + tipo_envio + "";

            $.ajax({
                url: ruta,
                type: "get",
                success: function(data) {
                    document.getElementById("precio").value = data.datos
                },
                error: function(data) {
                    console.log("error")
                }
            })
        }


        //calcular tarifa por peso
        function calcularTarifaPeso() {
            let Q = 0.13;
            let KG = 2.5;
            let km = document.getElementById("kmvalue").value
            let peso = document.getElementById("pesovalue").value
            let precioTotal = (km * Q) + (peso * KG)

            //validar que se ingresen los datos
            if (km == "" || peso == "") {
                alert("Ingrese los datos")
                return
            }

            precioTotal = precioTotal.toFixed(2)
            document.getElementById("precio").value = precioTotal

        }


        //calcular tarifa por volumen
        function calcularTarifaVolumen() {
            let Q = 0.13;
            let KG = 2.5;
            let km = document.getElementById("kmvalue").value
            //let peso = document.getElementById("pesovalue").value
            let largo = document.getElementById("value_largo").value
            let ancho = document.getElementById("value_ancho").value
            let alto = document.getElementById("value_alto").value
            let volumetrico = ((largo * ancho * alto) / 2272)
            let precioTotal = (volumetrico * KG) + (km * Q)
            //validar que se ingresen los datos

            if (km == "" || largo == "" || ancho == "" || alto == "") {
                alert("Ingrese los datos")
                return
            }
            precioTotal = precioTotal.toFixed(2)
            document.getElementById("precio").value = precioTotal
        }
    </script>


@endsection

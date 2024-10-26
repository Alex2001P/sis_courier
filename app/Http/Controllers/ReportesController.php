<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ReportesController extends Controller
{
    public function ticketRegistro($id)
    {
        $datos = DB::select(" SELECT
            envio.id_envio,
            envio.numero_reg,
            envio.id_remitente,
            envio.id_receptor,
            DATE(envio.fecha_salida) AS 'fecha_salida',
            envio.fecha_recojo,
            envio.desde_distrito,
            envio.desde_direccion,
            envio.hasta_distrito,
            envio.hasta_direccion,
            envio.cantidad,
            envio.descripcion,
            envio.precio,
            envio.pago_estado,
            envio.envio_estado,
            envio.registrado_por,
            envio.recepcionado_por,
            envio.desde_barrio,
            envio.hasta_barrio,
            envio.tipo_envio,
            envio.tarifa,
            envio.km,
            envio.peso,
            envio.largo,
            envio.ancho,
            envio.alto,
            remitente.nombre_razon_social AS nomRemitente,
            remitente.dni AS dniRemitente,
            remitente.telefono AS remitenteTelefono,
            remitente.direccion AS remitenteDireccion,
            receptor.telefono AS receptorTelefono,
            receptor.direccion AS receptorDireccion,
            receptor.dni AS dniReceptor,
            receptor.nombre_razon_social AS nomReceptor,
            prov1.Provincia AS desde_provincia_nombre,
            prov2.Provincia AS hasta_provincia_nombre,
            depa1.Departamento AS desde_departamento_nombre,
            depa2.Departamento AS hasta_departamento_nombre,
            estado_envio.nombre,
            depa2.idDepa AS hastaIdDepa,
            depa1.idDepa AS desdeIdDepa,
            prov2.idProv AS hastaIdProv,
            prov1.idProv AS desdeIdProv
        FROM
            envio
            INNER JOIN remitente ON envio.id_remitente = remitente.id_remitente
            INNER JOIN receptor ON envio.id_receptor = receptor.id_receptor
            LEFT JOIN provincias AS prov1 ON envio.desde_distrito = prov1.idProv
            LEFT JOIN provincias AS prov2 ON envio.hasta_distrito = prov2.idProv
            LEFT JOIN departamentos AS depa1 ON prov1.idDepa = depa1.idDepa
            LEFT JOIN departamentos AS depa2 ON prov2.idDepa = depa2.idDepa
            INNER JOIN estado_envio ON envio.envio_estado = estado_envio.id_estado_envio
                where id_envio=$id ");

        $numero = $datos[0]->numero_reg;

        $empresa = DB::select("select * from empresa limit 1");

        QrCode::format('png')->size(500)->generate(url("buscar-envio?numero=".$numero), storage_path("app/public/qr-ticket-envio/$id.png"));



        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 700, 226.77], 'landscape'); //FORMATO HORIZONTAL
        $pdf->loadView('vistas/reportes.ticketEnvio', compact('datos', "empresa", "id"));
        return $pdf->stream("Ticket N° $id");
    }
}

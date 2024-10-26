<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisesController extends Controller
{
    public function buscarProvincia($id, $id2)
    {
        $consulta = DB::select(" select * from provincias where idDepa = $id ");
        $departamento_salida = DB::selectOne(" select Departamento from departamentos where idDepa=$id ");
        $departamento_llegada = DB::selectOne(" select Departamento from departamentos where idDepa=$id2 ");
        //$km = $km[0]->km;

        $nombre_salida = $departamento_salida->Departamento;
        $nombre_llegada = $departamento_llegada->Departamento;

        $distancias = [
            "Alta Verapaz" => [
                "Guatemala" => 219,
                "Izabal" => 193,
                "Petén" => 304,
                "Chiquimula" => 196,
                "Retalhuleu" => 110
            ],
            "Baja Verapaz" => [
                "Guatemala" => 155,
                "Izabal" => 240,
                "Petén" => 358,
                "Chiquimula" => 141,
                "Retalhuleu" => 90
            ],
            "Chimaltenango" => [
                "Guatemala" => 58,
                "Izabal" => 264,
                "Petén" => 452,
                "Chiquimula" => 158,
                "Retalhuleu" => 65
            ],
            "Chiquimula" => [
                "Guatemala" => 174,
                "Izabal" => 140,
                "Petén" => 508,
                "Chiquimula" => 0,
                "Retalhuleu" => 130
            ],
            "El Progreso" => [
                "Guatemala" => 80,
                "Izabal" => 187,
                "Petén" => 406,
                "Chiquimula" => 90,
                "Retalhuleu" => 115
            ],
            "Escuintla" => [
                "Guatemala" => 54,
                "Izabal" => 284,
                "Petén" => 486,
                "Chiquimula" => 176,
                "Retalhuleu" => 30
            ],
            "Guatemala" => [
                "Guatemala" => 0,
                "Izabal" => 308,
                "Petén" => 531,
                "Chiquimula" => 174,
                "Retalhuleu" => 120
            ],
            "Huehuetenango" => [
                "Guatemala" => 263,
                "Izabal" => 398,
                "Petén" => 412,
                "Chiquimula" => 318,
                "Retalhuleu" => 200
            ],
            "Izabal" => [
                "Guatemala" => 308,
                "Izabal" => 0,
                "Petén" => 490,
                "Chiquimula" => 120,
                "Retalhuleu" => 160
            ],
            "Jalapa" => [
                "Guatemala" => 102,
                "Izabal" => 155,
                "Petén" => 492,
                "Chiquimula" => 88,
                "Retalhuleu" => 100
            ],
            "Jutiapa" => [
                "Guatemala" => 124,
                "Izabal" => 212,
                "Petén" => 518,
                "Chiquimula" => 72,
                "Retalhuleu" => 130
            ],
            "Petén" => [
                "Guatemala" => 531,
                "Izabal" => 490,
                "Petén" => 0,
                "Chiquimula" => 508,
                "Retalhuleu" => 290
            ],
            "Quetzaltenango" => [
                "Guatemala" => 204,
                "Izabal" => 401,
                "Petén" => 515,
                "Chiquimula" => 302,
                "Retalhuleu" => 50
            ],
            "Quiché" => [
                "Guatemala" => 164,
                "Izabal" => 364,
                "Petén" => 357,
                "Chiquimula" => 257,
                "Retalhuleu" => 135
            ],
            "Retalhuleu" => [
                "Guatemala" => 192,
                "Izabal" => 451,
                "Petén" => 558,
                "Chiquimula" => 319,
                "Retalhuleu" => 0
            ],
            "Sacatepéquez" => [
                "Guatemala" => 45,
                "Izabal" => 320,
                "Petén" => 471,
                "Chiquimula" => 162,
                "Retalhuleu" => 75
            ],
            "San Marcos" => [
                "Guatemala" => 252,
                "Izabal" => 477,
                "Petén" => 552,
                "Chiquimula" => 346,
                "Retalhuleu" => 100
            ],
            "Santa Rosa" => [
                "Guatemala" => 69,
                "Izabal" => 287,
                "Petén" => 501,
                "Chiquimula" => 100,
                "Retalhuleu" => 75
            ],
            "Sololá" => [
                "Guatemala" => 147,
                "Izabal" => 362,
                "Petén" => 474,
                "Chiquimula" => 218,
                "Retalhuleu" => 70
            ],
            "Suchitepéquez" => [
                "Guatemala" => 167,
                "Izabal" => 408,
                "Petén" => 524,
                "Chiquimula" => 272,
                "Retalhuleu" => 45
            ],
            "Totonicapán" => [
                "Guatemala" => 201,
                "Izabal" => 372,
                "Petén" => 493,
                "Chiquimula" => 238,
                "Retalhuleu" => 120
            ],
            "Zacapa" => [
                "Guatemala" => 140,
                "Izabal" => 94,
                "Petén" => 458,
                "Chiquimula" => 47,
                "Retalhuleu" => 150
            ]
        ];


        try {
            $km = $distancias[$nombre_salida][$nombre_llegada];
        } catch (\Throwable $th) {
            $km = $distancias[$nombre_llegada][$nombre_salida];
        }



        if (count($consulta) > 0) {
            return response()->json([
                'success' => true,
                'datos' => $consulta,
                "km" => $km
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron resultados para la consulta'
            ], 400);
        }
    }

    public function buscarDistrito($id)
    {
        $consulta = DB::select("select * from distritos where idProv = $id");
        if (count($consulta) > 0) {
            return response()->json([
                'success' => true,
                'datos' => $consulta
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron resultados para la consulta'
            ], 400);
        }
    }
}

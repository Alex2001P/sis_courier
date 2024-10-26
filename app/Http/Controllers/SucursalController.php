<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucursalController extends Controller
{
    public function index()
    {
        $sql = DB::select(" SELECT
        sucursal.*,
        provincias.idProv,
        departamentos.idDepa,
        provincias.Provincia,
        departamentos.Departamento
        FROM
        sucursal
        INNER JOIN provincias ON sucursal.distrito = provincias.idProv
        INNER JOIN departamentos ON provincias.idDepa = departamentos.idDepa
        
         ");
        $departamento = DB::select(" select * from departamentos ");

        $provincia = DB::select(" select * from provincias ");
        $distrito = DB::select(" select * from distritos ");

        return view("vistas/sucursal/sucursal", compact("sql", "departamento", "provincia", "distrito"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required",
            "distrito" => "required",
            "direccion" => "required",
            "telefono" => "required",
        ]);
        try {
            $insertar = DB::insert("insert into sucursal(distrito,nombre,direccion,telefono,barrio) values(?,?,?,?,?)  ", [
                $request->provincia,
                $request->nombre,
                $request->direccion,
                $request->telefono,
                $request->distrito
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($insertar == 1) {
            return back()->with("CORRECTO", "Sucursal registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "nombre" => "required",
            "distrito" => "required",
            "direccion" => "required",
            "telefono" => "required",
        ]);
        try {
            $actualizar = DB::update("update sucursal set distrito=?, nombre=?, direccion=?, telefono=?, barrio=? where id_sucursal=?  ", [
                $request->provincia,
                $request->nombre,
                $request->direccion,
                $request->telefono,
                $request->distrito,
                $id
            ]);
            if ($actualizar == 0) {
                $actualizar = 1;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($actualizar == 1) {
            return back()->with("CORRECTO", "Sucursal actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }


    public function destroy($id)
    {

        try {
            $sql = DB::delete(" delete from sucursal where id_sucursal=$id ");
        } catch (\Throwable $th) {
            $sql = 0;
        }


        if ($sql == 1) {
            return back()->with("CORRECTO", "Sucursal eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}

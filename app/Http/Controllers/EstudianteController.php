<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\Grado_seccion;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['estudiantes'] = Estudiante::paginate(10);
        return view('estudiante.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $grados = Grado_seccion::all();
        return view('estudiante.create', compact('grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datosEstudiante = request()->except("_token");
        $nombresApoderado = request()->input('nombres_apoderado');
        $apellidosApoderado = request()->input('apellidos_apoderado');
        $celularApoderado = request()->input('celular_apoderado');
        // crear objeto de apodaerado
        $dataApoderado = new class
        {
        };
        $dataApoderado->nombres_apoderado = $nombresApoderado;
        $dataApoderado->apellidos_apoderado = $apellidosApoderado;
        $dataApoderado->celular_apoderado = $celularApoderado;
        // pasarlo a json, para almacenarlo en la bd asi
        $datosEstudiante['apoderado'] = json_encode($dataApoderado);
        //quitar los atributos que no van a la bd asi
        unset($datosEstudiante['nombres_apoderado']);
        unset($datosEstudiante['apellidos_apoderado']);
        unset($datosEstudiante['celular_apoderado']);

        Estudiante::insert($datosEstudiante);
        return redirect("estudiante")->with("mensaje", "Estudiante registrado con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $grados = Grado_seccion::all();
        $estudiante = Estudiante::findOrFail($id);

        $apoderado = json_decode($estudiante['apoderado']);
        //formatear la data acorde al formulario
        $estudiante['nombres_apoderado'] = $apoderado->nombres_apoderado;
        $estudiante['apellidos_apoderado'] = $apoderado->apellidos_apoderado;
        $estudiante['celular_apoderado'] = $apoderado->celular_apoderado;
        // eliminar lo del apoderado como tal
        unset($estudiante['apoderado']);
        return view('estudiante.edit', compact('estudiante', 'grados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $datosEstudiante = request()->except(["_token", "_method"]);
        $nombresApoderado = request()->input('nombres_apoderado');
        $apellidosApoderado = request()->input('apellidos_apoderado');
        $celularApoderado = request()->input('celular_apoderado');
        // crear objeto de apodaerado
        $dataApoderado = new class
        {
        };
        $dataApoderado->nombres_apoderado = $nombresApoderado;
        $dataApoderado->apellidos_apoderado = $apellidosApoderado;
        $dataApoderado->celular_apoderado = $celularApoderado;
        // pasarlo a json, para almacenarlo en la bd asi
        $datosEstudiante['apoderado'] = json_encode($dataApoderado);
        //quitar los atributos que no van a la bd asi
        unset($datosEstudiante['nombres_apoderado']);
        unset($datosEstudiante['apellidos_apoderado']);
        unset($datosEstudiante['celular_apoderado']);
        Estudiante::where('id', '=', $id)->update($datosEstudiante);
        return redirect("estudiante")->with("mensaje", "Estudiante editado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Estudiante::destroy($id);
        return redirect("estudiante")->with("mensaje", "Estudiante eliminado con éxito");
    }
}

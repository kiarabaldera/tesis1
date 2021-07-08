<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\grado_seccion;
use App\Models\Seccion;
use Illuminate\Http\Request;

class GradoSeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['grados'] = Grado_seccion::all();
        return view('grado_seccion.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $grados = Grado::all();
        $secciones = Seccion::all();
        return view('grado_seccion.create', compact('grados', 'secciones'));
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
        $datos = request()->except("_token");
        Grado_seccion::insert($datos);
        return redirect("grado-seccion")->with("mensaje", "Grado y sección registrado con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grado_seccion  $grado_seccion
     * @return \Illuminate\Http\Response
     */
    public function show(grado_seccion $grado_seccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grado_seccion  $grado_seccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $grados = Grado::all();
        $secciones = Seccion::all();
        $grado = Grado_seccion::findOrFail($id);
        return view('grado_seccion.edit', compact('grados', 'secciones','grado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grado_seccion  $grado_seccion
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $datosGrado = request()->except(["_token", "_method"]);
        Grado_seccion::where('id', '=', $id)->update($datosGrado);
        return redirect("grado-seccion")->with("mensaje", "Grado Sección editado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grado_seccion  $grado_seccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(grado_seccion $grado_seccion)
    {
        //
    }
}

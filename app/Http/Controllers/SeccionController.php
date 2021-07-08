<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['secciones'] = Seccion::paginate(10);
        return view('seccion.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('seccion.create');
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
        $datosSeccion = request()->except("_token");
        Seccion::insert($datosSeccion);
        return redirect("seccion")->with("mensaje", "Seccción registrada con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function show(Seccion $seccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $seccion = Seccion::findOrFail($id);
        return view('seccion.edit', compact('seccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $datosSeccion = request()->except(["_token", "_method"]);
        Seccion::where('id', '=', $id)->update($datosSeccion);
        return redirect("seccion")->with("mensaje", "Sección editada con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Seccion::destroy($id);
        return redirect("seccion")->with("mensaje", "Seccion eliminado con éxito");
    }
}

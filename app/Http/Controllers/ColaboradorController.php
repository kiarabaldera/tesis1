<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['colaboradores'] = Colaborador::paginate(10);
        return view('colaborador.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cargos = Cargo::all();
        return view('colaborador.create', compact('cargos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            "nombres" => 'required|max:50',
            "apellidos" => 'required|max:50',
            "dni" => 'required|max:8'
        ];
        $mensaje = [
            'dni.required' => 'El dni es requerido',
            'nombres.required' => 'Los nombres son requeridos',
            'apellidos.required' => 'Los apellidos son requeridos',
            'required' => 'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);
        // esto obtiene la data enviada desde un form
        $datosColaborador = request()->except("_token");

        if ($request->hasFile("foto")) {
            $campos = ["foto" => "required|max:10000|mimes:jpeg,png,jpg"];
            $mensaje = ['foto.required' => 'La foto es requerida'];
            // estraer el nombre y subir la foto a la carpeta de storage
            $datosColaborador['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Colaborador::insert($datosColaborador);
        return redirect("colaborador")->with("mensaje", "Colaborador registrado con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function show(Colaborador $colaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cargos = Cargo::all();
        $colaborador = Colaborador::findOrFail($id);
        return view('colaborador.edit', compact('colaborador', 'cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosColaborador = request()->except(["_token", "_method"]);
        if ($request->hasFile("foto")) {
            $colaborador = Colaborador::findOrFail($id);
            Storage::delete('public/' . $colaborador->foto);
            // estraer el nombre y subir la foto a la carpeta de storage
            $datosColaborador['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Colaborador::where('id', '=', $id)->update($datosColaborador);
        return redirect("colaborador")->with("mensaje", "Colaborador editado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $colaborador = Colaborador::findOrFail($id);
        // if (Storage::delete('public/' . $colaborador->foto)) {
        //     Colaborador::destroy($id);
        // }
        Colaborador::destroy($id);
        return redirect("colaborador")->with("mensaje", "Colaborador eliminado con éxito");
    }
}

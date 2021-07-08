<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['preguntas'] = Pregunta::paginate(10);
        return view('pregunta.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoriasPreguntas = Categoria::all();
        return view('pregunta.create', compact('categoriasPreguntas'));
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
        $datosPreguntas = request()->except("_token");
        $descripciones = $request->input('descripciones', []);
        $puntajes = $request->input('puntajes', []);
        $opciones = [];
        for ($i = 0; $i < count($descripciones); $i++) {
            if ($descripciones[$i] != '') {
                array_push($opciones, (object)[
                    'descripcion' =>  $descripciones[$i],
                    'puntaje' => $puntajes[$i],
                ]);
            }
        }
        $datosPreguntas['opciones'] = json_encode($opciones);
        unset($datosPreguntas['puntajes']);
        unset($datosPreguntas['descripciones']);
        Pregunta::insert($datosPreguntas);
        return redirect("pregunta")->with("mensaje", "Estudiante registrada con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show(Pregunta $pregunta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pregunta = Pregunta::findOrFail($id);
        $categoriasPreguntas = Categoria::all();
        $opciones = json_decode($pregunta['opciones']);
        $descripciones = [];
        $puntajes = [];
        for ($i = 0; $i < count($opciones); $i++) {
            array_push($descripciones, $opciones[$i]->descripcion);
            array_push($puntajes, $opciones[$i]->puntaje);
        }
        $pregunta['puntajes'] = $puntajes;
        $pregunta['descripciones'] = $descripciones;
        unset($pregunta['opciones']);
        return view('pregunta.edit', compact('pregunta', 'categoriasPreguntas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $datosPreguntas = request()->except(["_token", "_method"]);
        $descripciones = request()->input('descripciones', []);
        $puntajes = request()->input('puntajes', []);
        $opciones = [];
        for ($i = 0; $i < count($descripciones); $i++) {
            if ($descripciones[$i] != '') {
                array_push($opciones, (object)[
                    'descripcion' =>  $descripciones[$i],
                    'puntaje' => $puntajes[$i],
                ]);
            }
        }
        $datosPreguntas['opciones'] = json_encode($opciones);
        unset($datosPreguntas['puntajes']);
        unset($datosPreguntas['descripciones']);
        Pregunta::where('id', '=', $id)->update($datosPreguntas);
        return redirect("pregunta")->with("mensaje", "Pregunta editada con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pregunta $pregunta)
    {
        //
    }
}

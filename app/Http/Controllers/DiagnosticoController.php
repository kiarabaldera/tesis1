<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Estudiante;
use App\Models\Pregunta;
use App\Models\Pregunta_test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['estudiantes'] = DB::table('estudiantes')
            ->leftJoin("diagnosticos", "diagnosticos.estudiante_id", "estudiantes.id")
            ->leftJoin("grado_secciones", "grado_secciones.id", "estudiantes.grado_seccion_id")
            ->leftJoin("grados", "grados.id", "grado_secciones.grado_id")
            ->leftJoin("secciones", "secciones.id", "grado_secciones.grado_id")
            ->select("estudiantes.*", "diagnosticos.resultado", "diagnosticos.id as diagnostico_id", DB::raw("CONCAT(grados.descripcion,secciones.descripcion) AS grado_seccion"))
            ->paginate(10);
        return view('diagnostico.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idEstudiante)
    {
        //
        $estudiante = Estudiante::findOrFail($idEstudiante);
        $preguntas = Pregunta::all();
        foreach ($preguntas as $key => $pregunta) {
            $preguntas[$key]['opciones'] = json_decode($pregunta['opciones']);
        }
        // return $preguntas;
        return view("diagnostico.create", compact('estudiante', 'preguntas'));
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
        $respuestas = $request->input('respuesta', []);
        $preguntas = $request->input('preguntas_id', []);
        $estudianteId = $request->input("estudiante_id");
        $resultadoDiagnostico = request()->input("resultado");
        $dataDiagnostico = [];
        array_push($dataDiagnostico, (array)[
            'resultado' => 20,
            'colaborador_id' => 50,
            'estudiante_id' => $estudianteId
        ]);
        try {
            DB::beginTransaction();
            // insertar la data a la bd del diagnostico, para obtener a que id del diagnostico se van a asignar las preguntas
            $diagnostico = new Diagnostico();
            $diagnostico->resultado = $resultadoDiagnostico;
            // $diagnostico->resultado = 30; //TODO: aca iria el resultado
            $diagnostico->colaborador_id = 23; //TODO: data del colaborador
            $diagnostico->estudiante_id = $estudianteId;
            $diagnostico->save();

            //armar el bundle de preguntas
            $dataPreguntas = [];
            for ($i = 0; $i < count($respuestas); $i++) {
                $data = json_decode($respuestas[$i]);
                array_push($dataPreguntas, (array)[
                    'diagnostico_id' => $diagnostico->id,
                    'pregunta_id' => $preguntas[$i],
                    'opcion_seleccionada' => $respuestas[$i],
                    'puntaje' => $data->puntaje
                ]);
            }
            Pregunta_test::insert($dataPreguntas);
            // database queries here
            DB::commit();
        } catch (\PDOException $e) {
            // Woopsy
            return $e;
            DB::rollBack();
        }
        return redirect("diagnostico")->with("mensaje", "Test registrado con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostico $diagnostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function edit($idEstudiante)
    {
        //
        $estudiante = Estudiante::findOrFail($idEstudiante);
        $preguntas = DB::table('diagnosticos')
            ->join("pregunta_tests", "pregunta_tests.diagnostico_id", "diagnosticos.id")
            ->join("preguntas", "preguntas.id", "pregunta_tests.pregunta_id")
            ->join("categorias", "categorias.id", "preguntas.categoria_id")
            ->select("preguntas.*", "pregunta_tests.opcion_seleccionada","categorias.descripcion as categoria")
            ->where("diagnosticos.estudiante_id", "=", $idEstudiante)
            ->get();
        $diagnostico = Diagnostico::where('estudiante_id', '=', $idEstudiante)->firstOrFail();
        foreach ($preguntas as $key => $pregunta) {
            $preguntas[$key]->opciones = json_decode($pregunta->opciones);
        }
        // return $preguntas;
        return view("diagnostico.edit", compact('estudiante', 'preguntas', 'diagnostico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function update($idDiagnostico)
    {
        //
        $respuestas = request()->input('respuesta', []);
        $preguntas = request()->input('preguntas_id', []);
        $estudianteId = request()->input("estudiante_id");
        $resultadoDiagnostico = request()->input("resultado");
        $dataDiagnostico = [];
        array_push($dataDiagnostico, (array)[
            'resultado' => 20,
            'colaborador_id' => 50,
            'estudiante_id' => 1
        ]);

        try {
            DB::beginTransaction();
            // insertar la data a la bd del diagnostico, para obtener a que id del diagnostico se van a asignar las preguntas
            $diagnostico = Diagnostico::find($idDiagnostico);
            $diagnostico->resultado = $resultadoDiagnostico;
            $diagnostico->colaborador_id = 23; //TODO: data del colaborador
            $diagnostico->estudiante_id = $estudianteId;
            $diagnostico->save();

            //armar el bundle de preguntas
            $dataPreguntas = [];
            for ($i = 0; $i < count($respuestas); $i++) {
                $data = json_decode($respuestas[$i]);
                array_push($dataPreguntas, (array)[
                    'diagnostico_id' => $idDiagnostico,
                    'pregunta_id' => $preguntas[$i],
                    'opcion_seleccionada' => $respuestas[$i],
                    'puntaje' => $data->puntaje
                ]);
            }
            //borrar preguntas y volverlas a registrar
            Pregunta_test::where('diagnostico_id', $idDiagnostico)->delete();
            Pregunta_test::insert($dataPreguntas);
            // database queries here
            DB::commit();
        } catch (\PDOException $e) {
            // Woopsy
            return $e;
            DB::rollBack();
        }
        return redirect("diagnostico")->with("mensaje", "Test actualizado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostico $diagnostico)
    {
        //
    }

    public function rptresgrados(Request $request)
    {
        //
        $datos['diagnosticos'] = DB::table('estudiantes')
            ->leftJoin("diagnosticos", "diagnosticos.estudiante_id", "estudiantes.id")
            ->leftJoin("grado_secciones", "grado_secciones.id", "estudiantes.grado_seccion_id")
            ->leftJoin("grados", "grados.id", "grado_secciones.grado_id")
            ->select("grados.descripcion as grado", "diagnosticos.resultado")
            ->where("diagnosticos.resultado", "=", "TRATAMIENTO URGENTE!")
            // ->groupBy("grados.descripcion")
            ->get();
        return response(json_encode($datos),200)->header("Content-type","text/plain");
    }

    public function rptressecciones(Request $request)
    {
        //
        $datos['diagnosticos'] = DB::table('estudiantes')
            ->leftJoin("diagnosticos", "diagnosticos.estudiante_id", "estudiantes.id")
            ->leftJoin("grado_secciones", "grado_secciones.id", "estudiantes.grado_seccion_id")
            ->leftJoin("grados", "grados.id", "grado_secciones.grado_id")
            ->leftJoin("secciones", "secciones.id", "grado_secciones.grado_id")
            ->select("diagnosticos.resultado", DB::raw("CONCAT(grados.descripcion,secciones.descripcion) AS grado_seccion"))
            ->where("diagnosticos.resultado", "=", "TRATAMIENTO URGENTE!")
            // ->groupBy("grados.descripcion")
            ->get();
        return response(json_encode($datos),200)->header("Content-type","text/plain");
    }

     public function rptresniveles(Request $request)
    {
        //
        $datos['diagnosticos'] = DB::table('estudiantes')
            ->leftJoin("diagnosticos", "diagnosticos.estudiante_id", "estudiantes.id")
            ->leftJoin("grado_secciones", "grado_secciones.id", "estudiantes.grado_seccion_id")
            ->leftJoin("grados", "grados.id", "grado_secciones.grado_id")
            ->select("grados.descripcion as grado", "diagnosticos.resultado")
            // ->groupBy("grados.descripcion")
            ->get();
        return response(json_encode($datos),200)->header("Content-type","text/plain");
    }
}

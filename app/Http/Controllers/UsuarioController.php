<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['usuarios'] = User::paginate(10);
        return view('usuario.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Rol::all();
        $colaboradores = Colaborador::all();
        $modo = "Crear";
        return view('auth.register', compact('roles', 'colaboradores', 'modo'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $roles = Rol::all();
        $colaboradores = Colaborador::all();
        $usuario = User::findOrFail($id);
        $modo = "Editar";
        return view('auth.register', compact('roles', 'colaboradores', 'usuario', 'modo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosColaborador = request()->except(["_token", "_method", "password_confirmation"]);
        $datosColaborador['password'] = Hash::make($datosColaborador['password']);
        User::where('id', '=', $id)->update($datosColaborador);
        return redirect("usuario")->with("mensaje", "Usuario editado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        //
    }
}

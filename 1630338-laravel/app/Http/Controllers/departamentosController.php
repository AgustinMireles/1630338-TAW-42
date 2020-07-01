<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use DB;
class departamentosController extends Controller
{
    public function index(){
        //Obtener todos los departamentos de la tabla de la bd
        $departamentos = Departamento::all();
        //Mostrar vista de la consulta de departamentos
        return view('departamentos.admin_departamentos',compact('departamentos'));
    }

    //Controlador para crear nuevo departamento
    public function create(){
        //Mostrar el formulario para crear departamento
      
        //Se crea un array asociativo que contendra la informacion del nuevo dpto
        return view('departamentos.alta_departamento',compact('departamentos'));
    }

    //Controlador para almacenar dptos
    public function store(Request $request){
        //Retirar los datos del Request
        $datosDepartamento = request()->except('departamentos');
        //Retirar el token del request
        $datosDepartamento = request()->except(['_token']);
        //Insertar en la tabla departamentos los datos para la creación de un nuevo registro
        $id = DB::table('departamentos')->insertGetId($datosDepartamento);
        //Alert::success('Datos guardados con éxito');
        return redirect('departamentos');
    }
    

    //Controlador para editar departamentos
    public function edit($id){
        //Editar departamento y mandar a la vista la información
        $departamento = Departamento::findOrFail($id);
        //Mostrar la vista
        return view('departamentos.editar_departamento',compact('departamento'));
    }


    //Controlador para eliminar empleado
    public function destroy($id){
        $usuario = Departamento::findOrFail($id);
        $usuario->delete();
        //Alert::success('Datos eliminados de la base de datos');
        return redirect('departamentos');
    }

    public function update(Request $request){
        //Retirar el token del request
        //$datosEmpleado = request()->except(['_token']);

        //obtengo el id del input tipo hidden
        $id = $request->input('id');

             //validar data de empleados:
            $request->validate([
                'nombre' => 'required|max:50'
            ]);


        
        $departamento = Departamento::findOrfail($id);
        $departamento->nombre = $request->input('nombre');
        $departamento->save();
        return redirect('departamentos');
    
        //echo '<h1>'.$datosEmpleado.'</h1>';
    }
}

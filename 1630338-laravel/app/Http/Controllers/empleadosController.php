<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Departamento;
use DB;

class empleadosController extends Controller
{
    public function index(){
        //Obtener todos los empleados de la tabla de la bd
        $empleados = Empleado::join('departamentos','empleados.id_departamento','=','departamentos.id')
        ->select('empleados.id','empleados.nombres','empleados.apellidos','empleados.cedula','empleados.email',
        'empleados.lugar_nacimiento','empleados.sexo','empleados.estado_civil','empleados.telefono','departamentos.nombre as nombre_departamento')->get();
        //Mostrar vista de la consulta de empleados
        return view('empleados.admin_empleados',compact('empleados'));
    }

    //Controlador para crear nuevo empleado
    public function create(){
        //Mostrar el formulario para crear empleado
        $departamentos =  Departamento::all();
        //Se crea un array asociativo que contendra la informacion del nuevo empleado
        return view('empleados.alta_empleado',compact('empleados','departamentos'));
    }

    //Controlador para almacenar empleados
    public function store(Request $request){
        //Retirar los datos del Request
        $datosEmpleado = request()->except('empleados');
        //Retirar el token del request
        $datosEmpleado = request()->except(['_token']);
        //Insertar en la tabla empleado los datos para la creación de un nuevo registro
        $id = DB::table('empleados')->insertGetId($datosEmpleado);
        //Alert::success('Datos guardados con éxito');
        return redirect('empleados');
    }
    

    //Controlador para editar Empleados
    public function edit($id){
        //Editar empleados y mandar a la vista la información
        $empleado = Empleado::findOrFail($id);
        $departamentos = Departamento::all();
        //echo $empleado;
        //Mostrar la vista
        return view('empleados.editar_empleado',compact('empleado','departamentos'));
    }


    //Controlador para eliminar empleado
    public function destroy($id){
        $usuario = Empleado::findOrFail($id);
        $usuario->delete();
        //Alert::success('Datos eliminados de la base de datos');
        return redirect('empleados');
    }

    public function update(Request $request){
        //Retirar el token del request
        //$datosEmpleado = request()->except(['_token']);

        //obtengo el id del input tipo hidden
        $id = $request->input('id');

             //validar data de empleados:
            $request->validate([
                'nombres' => 'required|max:50',
                'apellidos' => 'required|max:50',
                'cedula' => 'required|max:20',
                'email' => 'required|max:50|email|unique:empleados,email,' . $id,
                'lugar_nacimiento' => 'required|max:50',
                'estado_civil' => 'required|max:50',
                'telefono' => 'required|numeric'
            ]);


        
        $empleado = Empleado::findOrfail($id);
        $empleado->id_departamento = $request->input('id_departamento');
        $empleado->nombres = $request->input('nombres');
        $empleado->apellidos = $request->input('apellidos');
        $empleado->cedula = $request->input('cedula');
        $empleado->email = $request->input('email');
        $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
        $empleado->sexo = $request->input('sexo');
        $empleado->estado_civil = $request->input('estado_civil');
        $empleado->telefono = $request->input('telefono');
        $empleado->save();
        return redirect('empleados');
    
        //echo '<h1>'.$datosEmpleado.'</h1>';
    }
}

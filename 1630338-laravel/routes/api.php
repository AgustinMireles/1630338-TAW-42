<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Empleado;

//comandos
/**
 * 1-crear migración:
 * php artisan make:migration Nombre
 * 
 * 2-crear modelo
 * php artisan make:model Nombre
 */

 //Listar empleador
 Route::get('empleados', function(){
     $empleados =  Empleado::get();
     return $empleados;
 });

 //ruta para guardar nuevos empleados y recibir data (fase 1)

 Route::post('empleados',function(Request $request){
     //verificamos que los datos enviados se reciban bien para gurdar en la bd, utilizando request

    //return $request->all();

    //retornar un solo parametro
    //return $request->input('estado_civil');



    //validar data de empleados:
    $request->validate([
        'nombres' => 'required|max:50',
        'apellidos' => 'required|max:50',
        'cedula' => 'required|max:20',
        'email' => 'required|max:50|email|unique:empleados',
        'lugar_nacimiento' => 'required|max:50',
        'estado_civil' => 'required|max:50',
        'telefono' => 'required|numeric'
    ]);

    //Llenar los parámetros usando request y guardarlo en la tabla de la base de datos:
    $empleado = new Empleado;
    $empleado->nombres = $request->input('nombres');
    $empleado->apellidos = $request->input('apellidos');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado->estado_civil = $request->input('estado_civil');
    $empleado->telefono = $request->input('telefono');
    $empleado->save();
    return "Usuario creado";
 });

 //ruta para actualizar empleados
Route::put('empleados/{id}', function(Request $request, $id){


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
    $empleado->nombres = $request->input('nombres');
    $empleado->apellidos = $request->input('apellidos');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado->estado_civil = $request->input('estado_civil');
    $empleado->telefono = $request->input('telefono');
    $empleado->save();
    return "Empleado actualizado";

});

//ruta para eliminar empleados
Route::delete('empleados/{id}', function($id){
    $empleado = Empleado::findOrfail($id);
    $empleado->delete();
    return "Empleado eliminado";
});
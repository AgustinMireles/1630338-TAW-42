@extends('layout.patron')
@section('titulo','Administración de Departamentos')
@section('contenido')
    <!--Código HTML puro para mostrar el listado empleados-->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Administración de Departamentos</h3>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>    
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Listado de departamentos</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-keytable" class="table table-striped table-bordered" style="width_100%">
                                        <thead>
                                            <tr>
                                                <th>Nombre departamento</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        _create_departamentos_table
                                            @foreach($departamentos as $departamento)
                                                <tr>
                                                    <td>{{$departamento->nombre}}</td>
                                                   
                                                   

                                                    <!--Agregar columna para editar y eliminar registros-->
                                                    <td>
                                                        <div style="display:flex;">
                                                            <a href="{{url('departamentos/'.$departamento->id.'/edit')}}" class='btn btn-secondary'><i class='fas fa-edit'></i></a>
                                                            <form action="{{url('departamentos/'.$departamento->id)}}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button class='btn btn-danger'><i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
@endsection    

 
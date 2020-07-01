@extends('layout.patron')
@section ('titulo', 'Editar Departamento')
@section ('contenido')
<div class="right_col" role="main">
<div class="">
<div class="page-title">
<div class="title_left">
<h3> Editar Departamento</h3>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="x_panel">
<div class="x_title">
<h2>Datos del Departamento</h2>
<div class="clearfix"></div>
</div>
<div class="x_content">

<form action="{{ url('departamentos/update') }}" enctype="multipart/form-data" method="POST" data-parsley-validate class="form-horizontal form-label-left">
{{csrf_field()}}
{{ method_field('PUT') }}
<input type="hidden" id="id" name="id" value="{{$departamento->id}}" class="form-control">


<div class="item form-group">
<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombres"> Nombre Departamento <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6">
<input type="text" id="nombre" name="nombre" value="{{$departamento->nombre}}" required="required" class="form-control">
</div>
</div>

<div class="In_solid"></div>
<div class="Item form-group">
<div class="col-md-6 col-sm-6 offset-md-3">
<button class="btn btn-primary" type="button">Cancelar</button>
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</div>
</form>
</div>
</div>
</div>
@endsection


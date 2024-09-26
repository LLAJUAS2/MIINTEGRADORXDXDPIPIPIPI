@extends('tablar::page')

@section('title', 'Create Proyecto')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Proyectos
                    </div>
                    <h2 class="page-title">
                        {{ __('Crear Nuevo Proyecto') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('proyectos.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 14l-4 -4l4 -4"/>
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1"/>
                            </svg>
                            Atrás
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del proyecto</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('proyectos.store') }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                @csrf
                                
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('titulo') }}</label>
    <div>
        {{ Form::text('titulo', $proyecto->titulo, ['class' => 'form-control' .
        ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Titulo']) }}
        {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('descripcion', 'Descripción') }}</label>
    <div>
        {{ Form::textarea('descripcion', $proyecto->descripcion, ['class' => 'form-control' .
        ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción', 'style' => 'resize: none;']) }}
        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha_ini', 'Fecha de creación') }}</label>
    <div>
        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha_fin', 'Fecha de plazo máximo') }}</label>
    <div>
        {{ Form::date('fecha_fin', $proyecto->fecha_fin, ['class' => 'form-control' .
        ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha máxima', 'min' => \Carbon\Carbon::now()->addDay()->format('Y-m-d')]) }}
        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('estado', 'Estado') }}</label>
    <div>
        {{ Form::select('estado', ['activo' => 'Activo', 'inactivo' => 'Inactivo', 'completado' => 'Completado', 'en_revision' => 'En Revisión', 'primera_fase' => 'Primera Fase', 'fase_final' => 'Fase Final'], $proyecto->estado, ['class' => 'form-select' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Estado']) }}
        {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('usuario_creador_id', 'Creador del Proyecto') }}</label>
    <div>
        <input type="text" class="form-control" value="{{ Auth::user()->name . ' ' . Auth::user()->apPaterno . ' ' . Auth::user()->apMaterno }}" disabled>
    </div>
</div>


<!-- Agrega este campo oculto -->
<input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">



    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('proyectos.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Agregar</button>
            </div>
        </div>
    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


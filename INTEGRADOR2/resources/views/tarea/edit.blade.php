@extends('tablar::page')

@section('title', 'Editar')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Tareas
                    </div>
                    <h2 class="page-title">
                        {{ __('Editar Tarea') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tareas.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
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
                            <h3 class="card-title">Detalles</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('tareas.update', $tarea->id) }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('proyecto_id', 'Proyecto') }}</label>
                                    <div>
                                        <select name="proyecto_id" class="form-select">
                                            @foreach($proyectos as $proyecto)
                                                <option value="{{ $proyecto->id }}" {{ $tarea->proyecto_id == $proyecto->id ? 'selected' : '' }}>
                                                    {{ $proyecto->titulo }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('proyecto_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', $tarea->nombre, ['class' => 'form-control' .
        ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('descripcion') }}</label>
    <div>
        {{ Form::textarea('descripcion', $tarea->descripcion, ['class' => 'form-control' .
        ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('creador_id', 'Creador de la tarea') }}</label>
    <div>
        <input type="text" class="form-control" value="{{ Auth::user()->name . ' ' . Auth::user()->apPaterno . ' ' . Auth::user()->apMaterno }}" disabled>
    </div>
</div>


<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha_inicio', 'Fecha de creación') }}</label>
    <div>
        <input type="date" class="form-control" value="{{ now()->toDateString() }}" disabled>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('fecha máxima de entrega') }}</label>
    <div>
        {{ Form::date('fecha_fin', $tarea->fecha_fin, ['class' => 'form-control' .
        ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin', 'min' => \Carbon\Carbon::now()->toDateString()]) }}
        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>


    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Modificar</button>
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




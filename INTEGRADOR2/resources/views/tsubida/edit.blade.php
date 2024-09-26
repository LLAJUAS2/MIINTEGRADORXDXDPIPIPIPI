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
                        Tarea
                    </div>
                    <h2 class="page-title">
                        {{ __('Editar tarea') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tsubidas.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
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
                                  action="{{ route('tsubidas.update', $tsubida->id) }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf
                                <div class="mb-3">
                                    <div class="form-label">{{ Form::label('Usuario') }}</div>
                                    <select name="usuario_id" class="form-select{{ $errors->has('usuario_id') ? ' is-invalid' : '' }}">
                                        <option value="">Seleccionar usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}" {{ $tsubida->usuario_id == $usuario->id ? 'selected' : '' }}>
                                                {{ $usuario->name }} {{ $usuario->apPaterno }} {{ $usuario->apMaterno }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('usuario_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('Tarea Asignada') }}</label>
                                    <div>
                                        {{ Form::select('tarea_id', $tareas, $tsubida->tarea_id, ['class' => 'form-control' . ($errors->has('tarea_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar tarea']) }}
                                        {!! $errors->first('tarea_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('Proyecto') }}</label>
                                    <div>
                                        {{ Form::select('proyecto_id', $proyectos, $tsubida->proyecto_id, ['class' => 'form-control' . ($errors->has('proyecto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar proyecto']) }}
                                        {!! $errors->first('proyecto_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('descripción') }}</label>
                                    <div>
                                        {{ Form::textarea('descripcion', $tsubida->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                                        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('imagen') }}</label>
                                    <div>
                                        @if($tsubida->imagen)
                                            <div class="mb-2">Imagen actual: {{ $tsubida->imagen }}</div>
                                    
                                        @endif
                                        {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : '')]) }}
                                        {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
                                        <small class="form-hint">Modifica tu imagen referencial</small>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('archivo') }}</label>
                                    <div>
                                        @if($tsubida->archivo)
                                            <div class="mb-2">Archivo actual: {{ $tsubida->archivo }}</div>
                   
                                        @endif
                                        {{ Form::file('archivo', ['class' => 'form-control' . ($errors->has('archivo') ? ' is-invalid' : '')]) }}
                                        {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
                                        <small class="form-hint">Modifica tu archivo de trabajo</small>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('fecha_subida') }}</label>
                                    <div>
                                        {{ Form::date('fecha_subida', $tsubida->fecha_subida, ['class' => 'form-control' . ($errors->has('fecha_subida') ? ' is-invalid' : ''), 'readonly' => true]) }}
                                        {!! $errors->first('fecha_subida', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                
                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="{{ route('tsubidas.index') }}" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Editar</button>
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

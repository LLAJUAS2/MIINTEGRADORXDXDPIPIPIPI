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
                        Archivos
                    </div>
                    <h2 class="page-title">
                        {{ __('Editar Archivos') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('recursosenfolders.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
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
                            <h3 class="card-title">Recursosenfolder Details</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('recursosenfolders.update', $recursosenfolder->id) }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('folder_id', 'Escoge un folder') }}</label>
                                    <div>
                                        <select name="folder_id" class="form-control{{ $errors->has('folder_id') ? ' is-invalid' : '' }}">
                                            <option value="">Selecciona un folder</option>
                                            @foreach($folders as $folder)
                                                <option value="{{ $folder->id }}" {{ $folder->id == $recursosenfolder->folder_id ? 'selected' : '' }}>
                                                    {{ $folder->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('folder_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('usuario_creador_id', 'Usuario') }}</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name . ' ' . Auth::user()->apPaterno . ' ' . Auth::user()->apMaterno }}" disabled>
                                        <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('Nombre del archivo') }}</label>
                                    <div>
                                        {{ Form::text('nomrecurso', $recursosenfolder->nomrecurso, ['class' => 'form-control' .
                                        ($errors->has('nomrecurso') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del recurso']) }}
                                        {!! $errors->first('nomrecurso', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('archivo', 'Archivo') }}</label>
                                    <div>
                                        @if($recursosenfolder->archivo)
                                            <p>
                                                Archivo actual: 
                                                <a href="{{ asset('storage/' . $recursosenfolder->archivo) }}" target="_blank">{{ $recursosenfolder->archivo }}</a>
                                            </p>
                                        @endif
                                        {{ Form::file('archivo', null, ['class' => 'form-control' .
                                        ($errors->has('archivo') ? ' is-invalid' : ''), 'placeholder' => 'Archivo']) }}
                                        {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('fecha_subida', 'Fecha de subida') }}</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{ now()->toDateString() }}" disabled>
                                        <input type="hidden" name="fecha_subida" value="{{ now()->toDateString() }}">
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="{{ route('recursosenfolders.index') }}" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
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

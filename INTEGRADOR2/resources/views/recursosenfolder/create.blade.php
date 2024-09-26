@extends('tablar::page')

@section('title', 'Crear ')

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
                        {{ __('Sube un nuevo archivo') }}
                    </h2>
                </div>
                
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('recursosenfolders.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
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
                        
                        <div class="card-body">
                            <form method="POST" action="{{ route('recursosenfolders.store') }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="form-label">Escoge un folder</label>
                                    <div>
                                        <select name="folder_id" class="form-control{{ $errors->has('folder_id') ? ' is-invalid' : '' }}">
                                            <option value="">Selecciona un folder</option>
                                            @foreach($folders as $folder)
                                                <option value="{{ $folder->id }}">{{ $folder->nombre }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('folder_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Usuario</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name . ' ' . Auth::user()->apPaterno . ' ' . Auth::user()->apMaterno }}" disabled>
                                        <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Nombre del archivo</label>
                                    <div>
                                        <input type="text" name="nomrecurso" class="form-control{{ $errors->has('nomrecurso') ? ' is-invalid' : '' }}" placeholder="Nombre del recurso">
                                        {!! $errors->first('nomrecurso', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Archivo</label>
                                    <div>
                                        <input type="file" name="archivo" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}">
                                        {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
                                        <small class="form-hint">Sube el archivo de trabajo</small>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Fecha de subida</label>
                                    <div>
                                        <input type="text" class="form-control" value="{{ now()->toDateString() }}" disabled>
                                        <input type="hidden" name="fecha_subida" value="{{ now()->toDateString() }}">
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="{{ route('recursosenfolders.index') }}" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Subir</button>
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

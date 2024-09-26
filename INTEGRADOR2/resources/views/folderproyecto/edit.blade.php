@extends('tablar::page')

@section('title', 'Update Folderproyecto')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Archivo
                    </div>
                    <h2 class="page-title">
                        {{ __('Editar datos') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href=" {{ route('folderproyectos.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
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
                            <form method="POST"
                                  action="{{ route('folderproyectos.update', $folderproyecto->id) }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ Form::label('proyecto_id', 'Cambia de proyecto') }}</label>
                                    <div>
                                        <select name="proyecto_id" class="form-control{{ $errors->has('proyecto_id') ? ' is-invalid' : '' }}">
                                            <option value="">Selecciona un proyecto</option>
                                            @foreach($proyectos as $proyecto)
                                                <option value="{{ $proyecto->id }}" {{ $folderproyecto->proyecto_id == $proyecto->id ? 'selected' : '' }}>{{ $proyecto->titulo }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('proyecto_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                

<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Nuevo nombre de folder') }}</label>
    <div>
        {{ Form::text('nombre', $folderproyecto->nombre, ['class' => 'form-control' .
        ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
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




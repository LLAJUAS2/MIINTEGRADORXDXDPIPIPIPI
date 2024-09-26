@extends('tablar::page')

@section('title', 'Update User')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Usuarios
                    </div>
                    <h2 class="page-title">
                        {{ __('Editar Usuarios') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('users.index') }}" class="btn btn-orange btn-pill d-none d-sm-inline-block">
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
                                  action="{{ route('users.update', $user->id) }}" id="ajaxForm" role="form"
                                  enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf
                                
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Nombre') }}</label>
    <div>
        {{ Form::text('name', $user->name, ['class' => 'form-control' .
        ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('apPaterno') }}</label>
    <div>
        {{ Form::text('apPaterno', $user->apPaterno, ['class' => 'form-control' .
        ($errors->has('apPaterno') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Paterno']) }}
        {!! $errors->first('apPaterno', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('apMaterno') }}</label>
    <div>
        {{ Form::text('apMaterno', $user->apMaterno, ['class' => 'form-control' .
        ($errors->has('apMaterno') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Materno']) }}
        {!! $errors->first('apMaterno', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('celular') }}</label>
    <div>
        {{ Form::text('celular', $user->celular, ['class' => 'form-control' .
        ($errors->has('celular') ? ' is-invalid' : ''), 'placeholder' => 'Celular']) }}
        {!! $errors->first('celular', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nacimiento') }}</label>
    <div>
        {{ Form::date('nacimiento', $user->nacimiento, ['class' => 'form-control' .
        ($errors->has('nacimiento') ? ' is-invalid' : ''), 'placeholder' => 'Nacimiento']) }}
        {!! $errors->first('nacimiento', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('email') }}</label>
    <div>
        {{ Form::email('email', $user->email, ['class' => 'form-control' .
        ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
      
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('password', 'Contraseña') }}</label>
    <div>
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('password_confirmation', 'Confirmar Contraseña') }}</label>
    <div>
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar Contraseña']) }}
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar Cambios</button>
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




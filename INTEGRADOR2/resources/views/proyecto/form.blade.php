
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
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('usuarios[]', 'Usuarios con acceso') }}</label>
    <div>
        @foreach($usuarios as $usuario)
            <div class="form-check">
                {{ Form::checkbox('usuarios[]', $usuario->id, false, ['class' => 'form-check-input', 'id' => 'usuario_' . $usuario->id]) }}
                <label class="form-check-label" for="usuario_{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apPaterno }} {{ $usuario->apMaterno }}</label>
            </div>
        @endforeach
        {!! $errors->first('usuarios', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Agregar</button>
            </div>
        </div>
    </div>

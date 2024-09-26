<div class="mb-3">
    <div class="form-label">{{ Form::label('Usuario') }}</div>
    <select name="usuario_id" class="form-select{{ $errors->has('usuario_id') ? ' is-invalid' : '' }}" disabled>
        <option value="">Seleccionar usuario</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ $currentUser->id == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->name }} {{ $usuario->apPaterno }} {{ $usuario->apMaterno }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('usuario_id', '<div class="invalid-feedback">:message</div>') !!}
    <input type="hidden" name="usuario_id" value="{{ $currentUser->id }}"> <!-- Campo oculto -->
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
        {{ Form::textarea('descripcion', $tsubida->descripcion, ['class' => 'form-control' .
        ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('imagen') }}</label>
    <div>
        {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : '')]) }}
        {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('archivo') }}</label>
    <div>
        {{ Form::file('archivo', ['class' => 'form-control' . ($errors->has('archivo') ? ' is-invalid' : '')]) }}
        {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha de subida') }}</label>
    <div>
        {{ Form::date('fecha_subida', $tsubida->fecha_subida, ['class' => 'form-control' . ($errors->has('fecha_subida') ? ' is-invalid' : '')]) }}
        {!! $errors->first('fecha_subida', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="d-grid">
    <button type="submit" class="btn btn-primary">Subir Tarea</button>
</div>

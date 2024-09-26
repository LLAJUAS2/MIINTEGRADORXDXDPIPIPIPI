
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('proyecto_id', 'Proyecto') }}</label>
    <div>
        <select name="proyecto_id" class="form-select">
            @foreach($proyectos as $proyecto)
                <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
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
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Agregar</button>
            </div>
        </div>
    </div>


<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('proyecto_id', 'Selecciona un proyecto') }}</label>
    <div>
        <select name="proyecto_id" class="form-control{{ $errors->has('proyecto_id') ? ' is-invalid' : '' }}">
            <option value="">Selecciona un proyecto</option>
            @foreach($proyectos as $proyecto)
                <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
            @endforeach
        </select>
        {!! $errors->first('proyecto_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Nombre del folder') }}</label>
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

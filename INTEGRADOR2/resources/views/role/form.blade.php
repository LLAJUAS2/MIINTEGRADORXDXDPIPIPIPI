
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre_rol') }}</label>
    <div>
        {{ Form::text('nombre_rol', $role->nombre_rol, ['class' => 'form-control' .
        ($errors->has('nombre_rol') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Rol']) }}
        {!! $errors->first('nombre_rol', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Crear</button>
            </div>
        </div>
    </div>

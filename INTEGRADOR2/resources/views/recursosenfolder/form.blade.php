
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('folder_id') }}</label>
    <div>
        {{ Form::text('folder_id', $recursosenfolder->folder_id, ['class' => 'form-control' .
        ($errors->has('folder_id') ? ' is-invalid' : ''), 'placeholder' => 'Folder Id']) }}
        {!! $errors->first('folder_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">recursosenfolder <b>folder_id</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('usuario_id') }}</label>
    <div>
        {{ Form::text('usuario_id', $recursosenfolder->usuario_id, ['class' => 'form-control' .
        ($errors->has('usuario_id') ? ' is-invalid' : ''), 'placeholder' => 'Usuario Id']) }}
        {!! $errors->first('usuario_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">recursosenfolder <b>usuario_id</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nomrecurso') }}</label>
    <div>
        {{ Form::text('nomrecurso', $recursosenfolder->nomrecurso, ['class' => 'form-control' .
        ($errors->has('nomrecurso') ? ' is-invalid' : ''), 'placeholder' => 'Nomrecurso']) }}
        {!! $errors->first('nomrecurso', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">recursosenfolder <b>nomrecurso</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('archivo') }}</label>
    <div>
        {{ Form::text('archivo', $recursosenfolder->archivo, ['class' => 'form-control' .
        ($errors->has('archivo') ? ' is-invalid' : ''), 'placeholder' => 'Archivo']) }}
        {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">recursosenfolder <b>archivo</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('fecha_subida') }}</label>
    <div>
        {{ Form::text('fecha_subida', $recursosenfolder->fecha_subida, ['class' => 'form-control' .
        ($errors->has('fecha_subida') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Subida']) }}
        {!! $errors->first('fecha_subida', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">recursosenfolder <b>fecha_subida</b> instruction.</small>
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

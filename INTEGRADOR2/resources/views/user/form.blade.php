
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
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Agregar</button>
            </div>
        </div>
    </div>

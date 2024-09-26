<div class="form-group mb-3">
    <label class="form-label">{{ __('Rol') }}</label>
    <div>
        <select name="role_id" class="form-select{{ $errors->has('role_id') ? ' is-invalid' : '' }}">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->nombre_rol }}</option>
            @endforeach
        </select>
        {!! $errors->first('role_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ __('Usuario') }}</label>
    <div>
        <select name="user_id" class="form-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">
            @foreach ($users as $user)
                <!-- Aquí modificamos para mostrar el nombre completo -->
                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->apPaterno }} {{ $user->apMaterno }}</option>
            @endforeach
        </select>
        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('roleuser.index') }}" class="btn btn-danger">{{ __('Cancelar') }}</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">{{ __('Asignar') }}</button>
        </div>
    </div>
</div>

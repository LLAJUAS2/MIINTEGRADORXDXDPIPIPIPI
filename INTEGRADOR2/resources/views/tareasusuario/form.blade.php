
<div class="mb-3">
    <label class="form-label">Seleccionar Usuario</label>
    <select name="user_id" class="form-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">
        <option value="">Seleccionar Usuario</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}" {{ $tareasusuario->user_id == $usuario->id ? 'selected' : '' }}>
                {{ $usuario->name }} {{ $usuario->apPaterno }} {{ $usuario->apMaterno }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="mb-3">
    <div class="form-label">Nombre de la tarea</div>
    <select class="form-select" name="tarea_id">
      @foreach($tareas as $tarea)
        <option value="{{ $tarea->id }}" {{ $tarea->id == $tareasusuario->tarea_id ? 'selected' : '' }}>
          {{ $tarea->nombre }}
        </option>
      @endforeach
    </select>
  </div>
  

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Asignar</button>
            </div>
        </div>
    </div>

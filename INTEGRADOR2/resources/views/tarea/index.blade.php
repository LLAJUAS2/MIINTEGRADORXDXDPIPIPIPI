@extends('tablar::page')

@section('title')
    Tarea
@endsection

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Tareas</div>
                    <h2 class="page-title">{{ __('Gestión de tareas') }}</h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tsubidas.index') }}" class="btn btn-rss btn-pill d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                <path stroke="none" d="M0 0h24V0H0z" fill="none"/>
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"/>
                                <path d="M7 9l5 -5l5 5"/>
                                <path d="M12 4l0 12"/>
                            </svg>
                            Subir Tareas
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tareasusuarios.index') }}" class="btn btn-purple btn-pill d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus">
                                <path stroke="none" d="M0 0h24V0H0z" fill="none"/>
                                <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                <path d="M16 19h6"/>
                                <path d="M19 16v6"/>
                            </svg>
                            Asignar Tareas
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tareas.create') }}" class="btn btn-primary btn-pill d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24V0H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Crear una nueva tarea
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Todas las tareas</h3>
                            <!-- Formulario para seleccionar el proyecto y el usuario -->
                            <div class="filtros">
                                <form method="GET" action="{{ url('tareas') }}" class="form-inline ms-auto">
                                
                                    <select name="usuario" class="form-select" onchange="this.form.submit()">
                                        <option value="">Seleccione el usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}" {{ request('usuario') == $usuario->id ? 'selected' : '' }}>
                                                {{ $usuario->name }} {{ $usuario->apPaterno }} {{ $usuario->apMaterno }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                                <form method="GET" action="{{ url('tareas') }}" class="form-inline ms-auto">
                                    <select name="proyecto" class="form-select" onchange="this.form.submit()">
                                        <option value="">Seleccione el proyecto</option>
                                        @foreach($proyectos as $proyecto)
                                            <option value="{{ $proyecto->id }}" {{ request('proyecto') == $proyecto->id ? 'selected' : '' }}>
                                                {{ $proyecto->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>

                            </div>
                            
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24V0H0z" fill="none"/>
                                                <polyline points="6 15 12 9 18 15"/>
                                            </svg>
                                        </th>
                                        <th>Proyecto</th>
                                        <th>Nombre de la tarea</th>
                                        <th>Descripción</th>
                                        <th>Creador</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Finalización estimada</th>
                                        <th>Usuario Asignado</th> <!-- Nueva columna -->
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tareas as $tarea)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $tarea->proyecto ? $tarea->proyecto->titulo : 'Proyecto no asignado' }}</td>
                                            <td>{{ $tarea->nombre }}</td>
                                            <td>{{ $tarea->descripcion }}</td>
                                            <td>
                                                @if($tarea->user)
                                                    {{ $tarea->user->name }} {{ $tarea->user->apPaterno }} {{ $tarea->user->apMaterno }}
                                                @else
                                                    Usuario no asignado
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($tarea->fecha_inicio)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tarea->fecha_fin)->format('Y-m-d') }}</td>
                                            <td>
                                                @forelse($tarea->users as $usuario)
                                                    {{ $usuario->name }} {{ $usuario->apPaterno }} {{ $usuario->apMaterno }}@if(!$loop->last), @endif
                                                @empty
                                                    Sin usuario asignado
                                                @endforelse
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{ route('tareas.show', $tarea->id) }}">Ver</a>
                                                            <a class="dropdown-item" href="{{ route('tareas.edit', $tarea->id) }}">Editar</a>
                                                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="if(!confirm('¿Seguro que quieres eliminar esta tarea?')){return false;}" class="dropdown-item text-red">
                                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">No hay tareas existentes</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {!! $tareas->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .filtros{
        display: flex;
        flex-direction:row;
        gap: 10px;
        padding-left:30px ;
        padding-top: 10px;
    }
</style>

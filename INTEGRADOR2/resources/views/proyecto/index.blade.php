@extends('tablar::page')

@section('title')
    Proyectos
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                       Proyectos
                    </div>
                    <h2 class="page-title">
                        {{ __('Gestión de Proyectos') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('proyectos.create') }}" class="btn btn-google btn-pill d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                            Crear un Proyecto Nuevo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; align-items: center;">
                            <h3 class="card-title">Todos los proyectos</h3>
                            <!-- Formulario para seleccionar el año y estado -->
                            <form method="GET" action="{{ url('proyectos') }}" class="form-inline" style="display: flex; gap: 10px; margin-left: 50px;">
                                <select name="year" class="form-select" onchange="this.form.submit()">
                                    <option value="">Seleccione el año</option>
                                    @for($year = 2018; $year <= date('Y'); $year++)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                                <select name="estado" class="form-select" onchange="this.form.submit()">
                                    <option value="">Busqueda estado</option>
                                    @foreach(['activo', 'inactivo', 'completado', 'en_revision', 'primera_fase', 'fase_final'] as $estado)
                                        <option value="{{ $estado }}" {{ request('estado') == $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-sm text-dark icon-thick" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <polyline points="6 15 12 9 18 15"/>
                                        </svg>
                                    </th>
                                    
										<th>Título</th>
										<th>Descripción</th>
										<th>Fecha de inicio</th>
										<th>Plazo máximo</th>
										<th>Estado</th>
										<th>Creador del proyecto</th>
                                        

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($proyectos as $proyecto)
                                    <tr>
                                        
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $proyecto->titulo }}</td>
											<td>{{ $proyecto->descripcion }}</td>
											<td>{{ $proyecto->fecha_ini }}</td>
											<td>{{ $proyecto->fecha_fin }}</td>
											<td>{{ $proyecto->estado }}</td>
                                            <td>
                                                @if ($proyecto->user)
                                                    {{ $proyecto->user->name }} {{ $proyecto->user->apPaterno }} {{ $proyecto->user->apMaterno }}
                                                @else
                                                    Usuario no encontrado
                                                @endif
                                            </td>
                                        
											

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('folderproyectos.index',$proyecto->id) }}">
                                                            Archivos
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('proyectos.edit',$proyecto->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('proyectos.destroy',$proyecto->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('¿Estás seguro?Si eliminas el proyecto tambien se eliminarán las tareas que contiene')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td>No hay proyectos existentes</td>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $proyectos->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

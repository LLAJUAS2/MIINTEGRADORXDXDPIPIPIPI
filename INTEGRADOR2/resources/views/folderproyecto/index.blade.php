@extends('tablar::page')

@section('title')
    Folderproyecto
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Archivos
                    </div>
                    <h2 class="page-title">
                        {{ __('Gestión de archivos') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('folderproyectos.create') }}" class="btn btn-google btn-pill d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Crear nuevo Folder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Filtro de búsqueda -->
    <div class="container-xl mt-4">
        <form action="{{ route('folderproyectos.index') }}" method="GET">
            <div class="row g-2">
                <div class="col">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre de folder" value="{{ request()->search }}">
                </div>
                <div class="col">
                    <select name="proyecto_id" class="form-control">
                        <option value="">Seleccionar Proyecto</option>
                        @foreach($proyectos as $proyecto)
                            <option value="{{ $proyecto->id }}" {{ request()->proyecto_id == $proyecto->id ? 'selected' : '' }}>
                                {{ $proyecto->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                @forelse ($folderproyectos as $folderproyecto)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $folderproyecto->nombre }}</h3>
                                <p class="text-secondary">Proyecto: {{ $folderproyecto->proyecto->titulo }}</p>
                                <div class="btn-list flex-nowrap">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                           
                                            <a class="dropdown-item" href="{{  route('recursosenfolders.index') }}">
                                                Recursos
                                            </a>
                                            
                                            <a class="dropdown-item" href="{{ route('folderproyectos.edit', $folderproyecto->id) }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('folderproyectos.destroy', $folderproyecto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="if(!confirm('Al eliminar el folder eliminarás todos los recursos internos ¿Estás seguro?')){return false;}" class="dropdown-item text-red">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                No hay folders existentes
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex align-items-center justify-content-center mt-4">
                {!! $folderproyectos->links('tablar::pagination') !!}
            </div>
        </div>
    </div>
@endsection

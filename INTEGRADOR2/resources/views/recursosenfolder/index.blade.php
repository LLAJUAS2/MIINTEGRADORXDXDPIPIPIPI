@extends('tablar::page')

@section('title')
    Folders
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
                        {{ __('Recursos del Folder') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('recursosenfolders.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Subir nuevo archivo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtro de búsqueda -->
    <div class="container-xl mt-4">
        <form action="{{ route('recursosenfolders.index') }}" method="GET">
            <div class="row g-2">
                <div class="col">
                    <select name="folder_id" class="form-control">
                        <option value="">Seleccionar Folder</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder->id }}" {{ request()->folder_id == $folder->id ? 'selected' : '' }}>
                                {{ $folder->nombre }}
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
                @forelse ($recursosenfolders as $recursosenfolder)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $recursosenfolder->nomrecurso }}</h3>
                                <p class="text-secondary">Folder: {{ $recursosenfolder->folderproyecto->nombre }}</p>
                                <p class="text-secondary">Archivo: {{ $recursosenfolder->archivo }}</p>
                                <p class="text-secondary">Fecha Subida: {{ $recursosenfolder->fecha_subida }}</p>
                                <div class="btn-list flex-nowrap">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ asset('storage/' . $recursosenfolder->archivo) }}" download>
                                                Descargar
                                            </a>
                                            <a class="dropdown-item" href="{{ route('recursosenfolders.edit', $recursosenfolder->id) }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('recursosenfolders.destroy', $recursosenfolder->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="if(!confirm('¿Estás seguro de eliminar el archivo?')){return false;}" class="dropdown-item text-red">
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
                                No hay archivos subidos en este folder
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex align-items-center justify-content-center mt-4">
                {!! $recursosenfolders->links('tablar::pagination') !!}
            </div>
        </div>
    </div>
@endsection

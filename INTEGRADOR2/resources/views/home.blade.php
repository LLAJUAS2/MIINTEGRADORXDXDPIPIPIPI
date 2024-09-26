@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                </div>
                <!-- Page title actions -->
                <div class="row row-deck row-cards">
                    <h2 class="page-title">Dashboard</h2>
                    <div class="col-4">
                        <div class="card">
                            <!-- Photo -->
                            <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url('{{ asset('assets/reporte2.jpg') }}')"></div>
                            <div class="card-body">
                                <h3 class="card-title">Reporte 1</h3>
                                <p class="text-secondary">Podrá ver a todos los usuarios y sus roles registrados dentro de su sistema.</p>
                                <a href="{{ route('user.REPORTES.pdf') }}" class="btn btn-purple">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <!-- Photo -->
                            <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url('{{ asset('assets/reporte1.jpg') }}')"></div>
                            <div class="card-body">
                                <h3 class="card-title">Reporte 2</h3>
                                <p class="text-secondary">Podrá ver todos los proyectos de la empresa y los creadores de estos.</p>
                                <a href="{{ route('proyecto.REPORTES.pdf') }}" class="btn btn-yellow">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="page-title m-4">REPORTES</h2>
                <h3 class="page-subtitle m-5 mt-0 mb-2" style="color:#f59f00 ">Tareas por usuario</h3>

                <!-- Filtro de búsqueda -->
                <div class="container-xl m-4">
                    <form action="{{ route('home') }}" method="GET">
                        <div class="row g-2">
                            <div class="col">
                                <select name="user_id" class="form-control">
                                    <option value="all" {{ $selectedUserId == 'all' ? 'selected' : '' }}>Todos los usuarios</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} {{ $user->apPaterno }} {{ $user->apMaterno }}
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

                <!-- Tabla de tareas -->
                <div class="row m-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Usuarios con Tareas Asignadas</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre de la Tarea</th>
                                            <th>Descripción de la Tarea</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tasks as $user)
                                            @if($user->tareas->isEmpty())
                                                <tr>
                                                    <td colspan="3">{{ $user->name }} {{ $user->apPaterno }} {{ $user->apMaterno }} - Usuario sin tareas asignadas</td>
                                                </tr>
                                            @else
                                                @foreach($user->tareas as $tarea)
                                                    <tr>
                                                        <td>{{ $user->name }} {{ $user->apPaterno }} {{ $user->apMaterno }}</td>
                                                        <td>{{ $tarea->nombre }}</td>
                                                        <td>{{ $tarea->descripcion }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="3">No se encontraron usuarios.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="page-subtitle m-5 mt-0 mb-2" style="color:#f59f00 ">Proyectos por año</h3>

                <!-- Filtro de proyectos por año -->
                <div class="container-xl m-4">
                    <form action="{{ route('home') }}" method="GET">
                        <div class="row g-2">
                            <div class="col">
                                <select name="year" class="form-control">
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
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

                <!-- Tabla de proyectos -->
                <div class="row m-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Proyectos por Año</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Fecha de Inicio</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($projects as $proyecto)
                                            <tr>
                                                <td>{{ $proyecto->titulo }}</td>
                                                <td>{{ $proyecto->fecha_ini }}</td>
                                                <td>{{ $proyecto->estado }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No se encontraron proyectos para el año seleccionado.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

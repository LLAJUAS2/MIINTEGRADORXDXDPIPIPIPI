@extends('tablar::page')

@section('title')
    Usuarios
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="dropdown">
                    <a href="#" class="btn dropdown-toggle  border border-yellow" style="background-color: rgba(220, 185, 8, 0.471)"
                       data-bs-toggle="dropdown">Roles</a>
                    <div class="dropdown-menu">
                        <span class="dropdown-header ">Roles de Usuarios</span>
                        <a class="dropdown-item" href="{{ route('roles.index') }}">
                            <!-- SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"/>
                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                <path d="M17 10h2a2 2 0 0 1 2 2v1"/>
                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2"/>
                            </svg>
                            Gestión de Roles
                        </a>
                        <a class="dropdown-item" href="{{ route('roleuser.index') }}">
                            <!-- SVG icon from http://tabler-icons.io/i/pencil -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                <path d="M16 19h6"/>
                                <path d="M19 16v6"/>
                            </svg>
                            Asignar Roles
                        </a>
                    </div>
                </div>


                <div class="col">
                    <!-- Page pre-title -->


                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('users.create') }}" class="btn btn-pill btn-google d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                <path d="M16 19h6"/>
                                <path d="M19 16v6"/>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4"/>
                            </svg>
                            Crear Nuevo Usuario
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
                    <div class="card" >
                        <div class="card-header">
                            <h3 class="card-title" >Todos los usuarios</h3>
                        </div>

                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <polyline points="6 15 12 9 18 15"/>
                                        </svg>
                                    </th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Celular</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->apPaterno }}</td>
                                        <td>{{ $user->apMaterno }}</td>
                                        <td>{{ $user->celular }}</td>
                                        <td>{{ $user->nacimiento }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->roles->count() > 0)
                                                @foreach ($user->roles as $role)
                                                    {{ $role->nombre_rol }}<br>
                                                @endforeach
                                            @else
                                                Sin rol asignado
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
                                                           href="{{ route('users.show',$user->id) }}">
                                                            Vista
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('users.edit',$user->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('users.destroy',$user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('¿Estás seguro?')){return false;}"
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
                                    <td>No hay datos existentes</td>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $users->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


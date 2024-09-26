@extends('tablar::page')

@section('title')
    Tareas Subidas
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Tareas
                    </div>
                    <h2 class="page-title">
                        {{ __('Tareas Subidas') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tsubidas.create') }}" class="btn btn-google btn-pill d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-table-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-7.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" /><path d="M3 10h18" /><path d="M10 3v18" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                            Subir tarea
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
                        <div class="card-header">
                            <h3 class="card-title">Todas las tareas</h3>
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
                                    
                                    <th>Usuario</th>
                                    <th>Tarea</th>
                                    <th>Proyecto</th>
                                    <th>Descripción</th>
                                    <th>Imagen Referencial</th>
                                    <th>Archivo</th>
                                    <th>Fecha Subida</th>

                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @php $i = 0; @endphp <!-- Inicializa la variable $i -->
                                @forelse ($tsubidas as $tsubida)
                                    <tr>
                                        
                                        <td>{{ ++$i }}</td>
                                        
                                        <td>
                                            @if ($tsubida->user)
                                                {{ $tsubida->user->name }} {{ $tsubida->user->apPaterno }} {{ $tsubida->user->apMaterno }}
                                            @else
                                                Usuario no asignado
                                            @endif
                                        </td>
                                        <td>
                                            @if ($tsubida->tarea)
                                                {{ $tsubida->tarea->nombre }}
                                            @else
                                                Tarea no asignada
                                            @endif
                                        </td>
                                        <td>
                                            @if ($tsubida->proyecto)
                                                {{ $tsubida->proyecto->titulo }}
                                            @else
                                                Proyecto no asignado
                                            @endif
                                        </td>
                                        <td>{{ $tsubida->descripcion }}</td>
                                            
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $tsubida->id }}">
                                                    <img src="{{ asset($tsubida->imagen) }}" width="100" height="" class="img" alt="">
                                                </a>
                                                
                                                <!-- Image Modal -->
                                                <div class="modal fade" id="imageModal{{ $tsubida->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $tsubida->id }}" aria-hidden="true">
                                                  <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel{{ $tsubida->id }}">Imagen Referencial</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <img src="{{ asset($tsubida->imagen) }}" class="img-fluid" alt="Imagen Referencial">
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($tsubida->archivo)
                                                    <a href="{{ asset($tsubida->archivo) }}" download="{{ $tsubida->archivo }}">Descargar</a>
                                                @else
                                                    No disponible
                                                @endif
                                            </td>
                                            
                                            <td>{{ $tsubida->fecha_subida }}</td>

                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('tsubidas.show',$tsubida->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                        href="{{ route('tsubidas.edit',$tsubida->id) }}">
                                                         Editar
                                                     </a>
                                                     <form
                                                         action="{{ route('tsubidas.destroy',$tsubida->id) }}"
                                                         method="POST">
                                                         @csrf
                                                         @method('DELETE')
                                                         <button type="submit"
                                                                 onclick="if(!confirm('¿Seguro que quieres eliminar la tarea?')){return false;}"
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
                                 <td>No hay tareas subidas</td>
                             @endforelse
                             </tbody>

                         </table>
                     </div>
                    <div class="card-footer d-flex align-items-center">
                         {!! $tsubidas->links('tablar::pagination') !!}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection

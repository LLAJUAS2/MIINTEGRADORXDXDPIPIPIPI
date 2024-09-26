<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyectos de la empresa</title>
</head>
<body>
    <h1>Proyectos de la empresa</h1>
    <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
        <tr>
            <th class="w-1">No.</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha de inicio</th>
            <th>Plazo máximo</th>
            <th>Creador del proyecto</th>
            <th>Tareas por proyecto</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0; @endphp <!-- Inicializa la variable $i -->
        @foreach ($proyectos as $proyecto)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $proyecto->titulo }}</td>
                <td>{{ $proyecto->descripcion }}</td>
                <td>{{ $proyecto->fecha_ini }}</td>
                <td>{{ $proyecto->fecha_fin }}</td>
                <td>
                    @if ($proyecto->user)
                        {{ $proyecto->user->name }} {{ $proyecto->user->apPaterno }} {{ $proyecto->user->apMaterno }}
                    @else
                        Usuario no asignado
                    @endif
                </td>
                <td>
                    <ul>
                        @foreach ($proyecto->tareas as $tarea)
                            <li>{{ $tarea->nombre }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #F2B705;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
            color: #333;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:hover {
            background-color: #f1f1f1;
        }
        .table th, .table td {
            padding: 12px;
        }
        .table thead th {
            background-color: #F2B705;
            color: white;
            font-weight: bold;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
    </style>
</body>
</html>

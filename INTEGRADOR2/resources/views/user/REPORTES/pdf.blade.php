<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios del sistema</title>
</head>
<body>
    <h1>USUARIOS DEL SISTEMA</h1>
    <table class="table card-table table-vcenter text-nowrap datatable">
        <thead >
        <tr>
            <th class="w-1">No.
                
            </th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido materno</th>
            <th>Celular</th>
            <th>Fecha de Nacimiento</th>
            <th>Email</th>
            <th>Roles Asignados</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->apPaterno }}</td>
                <td>{{ $user->apMaterno }}</td>
                <td>{{ $user->celular }}</td>
                <td>{{ $user->nacimiento }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role->nombre_rol }}<br>
                    @endforeach
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No hay usuarios disponibles.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #D363FF;
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
            background-color: #D363FF;
            color: white;
            font-weight: bold;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
    </style>
</body>
</html>

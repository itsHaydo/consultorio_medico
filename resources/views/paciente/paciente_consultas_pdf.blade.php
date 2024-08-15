<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consulta Detalles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
            background: #f1f1f1;
        }
        .content {
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table td {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detalles de la Consulta</h1>
        </div>
        <div class="content">
            <p><strong>Fecha:</strong> {{ $consulta->fecha }}</p>
            <p><strong>Doctor:</strong> {{ $consulta->doctor->name ?? 'N/A' }}</p>
            <p><strong>Talla:</strong> {{ $consulta->talla }} cm</p>
            <p><strong>Peso:</strong> {{ $consulta->peso }} kg</p>
            <p><strong>Temperatura:</strong> {{ $consulta->temperatura }} °C</p>
            <p><strong>Presión:</strong> {{ $consulta->presion }} mmHg</p>
            <p><strong>Notas:</strong> {{ $consulta->notas ?? 'Sin notas adicionales' }}</p>

            <!-- Tratamientos -->
            @if($tratamientos->isEmpty())
                <p>No se realizaron tratamientos durante esta consulta.</p>
            @else
                <h2>Tratamientos Realizados:</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tratamientos as $tratamiento)
                            <tr>
                                <td>{{ $tratamiento->descripcion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="footer">
            <p>Generado por el Sistema de Consultas Médicas</p>
        </div>
    </div>
</body>
</html>

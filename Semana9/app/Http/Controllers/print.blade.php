<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relación de Transferencia - {{ $transfer->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td, .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .info-table th {
            background-color: #f2f2f2;
            width: 25%;
        }
        .items-table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; cursor: pointer;">Imprimir Relación</button>
    </div>

    <div class="header">
        <h2>INVENTARIO DE TRANSFERENCIA DOCUMENTAL</h2>
        <h3>{{ strtoupper(str_replace('_', ' ', $transfer->type)) }}</h3>
    </div>

    <table class="info-table">
        <tr>
            <th>Unidad Administrativa Origen:</th>
            <td>{{ $transfer->originUnit->name ?? 'N/A' }}</td>
            <th>Fecha de Transferencia:</th>
            <td>{{ $transfer->transfer_date ? $transfer->transfer_date->format('d/m/Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <th>Unidad Administrativa Destino:</th>
            <td>{{ $transfer->destinationUnit->name ?? 'N/A' }}</td>
            <th>Estado:</th>
            <td>{{ strtoupper($transfer->status) }}</td>
        </tr>
        <tr>
            <th>Notas:</th>
            <td colspan="3">{{ $transfer->notes ?? 'Ninguna' }}</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Código de Expediente</th>
                <th>Sección / Serie</th>
                <th>Asunto</th>
                <th>Fojas</th>
                <th>Apertura</th>
                <th>Cierre</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transfer->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->archivalFile->file_code ?? 'N/A' }}</td>
                    <td>
                        {{ $item->archivalFile->section->code ?? '' }} / 
                        {{ $item->archivalFile->series->code ?? '' }}
                    </td>
                    <td>{{ $item->archivalFile->title ?? 'N/A' }}</td>
                    <td class="text-center">{{ $item->archivalFile->page_count ?? 0 }}</td>
                    <td class="text-center">{{ $item->archivalFile->opened_at ? $item->archivalFile->opened_at->format('d/m/Y') : 'N/A' }}</td>
                    <td class="text-center">{{ $item->archivalFile->closed_at ? $item->archivalFile->closed_at->format('d/m/Y') : 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay expedientes incluidos en esta transferencia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 60px; width: 100%; display: flex; justify-content: space-around;">
        <div style="text-align: center; width: 30%;">
            <p>___________________________________</p>
            <p><strong>Entregó</strong></p>
            <p>{{ $transfer->originUnit->responsible_name ?? 'Responsable Origen' }}</p>
        </div>
        <div style="text-align: center; width: 30%;">
            <p>___________________________________</p>
            <p><strong>Recibió</strong></p>
            <p>{{ $transfer->destinationUnit->responsible_name ?? 'Responsable Destino' }}</p>
        </div>
    </div>
</body>
</html>
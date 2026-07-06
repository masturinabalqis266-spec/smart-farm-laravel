<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Harvest Report</title>

    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 12px;
            color: #111827;
        }

        h1 {
            color: #166534;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #166534;
            color: #ffffff;
            padding: 8px;
            border: 1px solid #d1d5db;
            text-align: left;
        }

        td {
            padding: 7px;
            border: 1px solid #d1d5db;
        }
    </style>
</head>
<body>

<h1>Harvest Report</h1>
<p class="subtitle">Generated on {{ now()->format('d M Y, h:i A') }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Worker</th>
            <th>Farm Zone</th>
            <th>Yield KG</th>
            <th>Grade</th>
            <th>Notes</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($harvests as $index => $harvest)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $harvest->user->name ?? '-' }}</td>
                <td>{{ $harvest->cropBlock->block_name ?? '-' }}</td>
                <td>{{ number_format($harvest->yield_kg, 2) }}</td>
                <td>{{ $harvest->grade }}</td>
                <td>{{ $harvest->notes ?? '-' }}</td>
                <td>{{ $harvest->created_at ? $harvest->created_at->format('d M Y') : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No harvest records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
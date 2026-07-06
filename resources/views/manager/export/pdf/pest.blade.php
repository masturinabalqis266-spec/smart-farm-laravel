<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pest Report</title>

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

<h1>Pest Report</h1>
<p class="subtitle">Generated on {{ now()->format('d M Y, h:i A') }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Worker</th>
            <th>Farm Zone</th>
            <th>Pest Type</th>
            <th>Count</th>
            <th>Severity</th>
            <th>Status</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($reports as $index => $report)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $report->user->name ?? '-' }}</td>
                <td>{{ $report->cropBlock->block_name ?? '-' }}</td>
                <td>{{ $report->pest_type ?? '-' }}</td>
                <td>{{ $report->count ?? '-' }}</td>
                <td>{{ $report->severity ?? '-' }}</td>
                <td>{{ $report->status ?? '-' }}</td>
                <td>{{ $report->description ?? '-' }}</td>
                <td>{{ $report->created_at ? $report->created_at->format('d M Y') : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No pest reports found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>

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

<h1>Inventory Report</h1>
<p class="subtitle">Generated on {{ now()->format('d M Y, h:i A') }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Current Stock</th>
            <th>Minimum Stock</th>
            <th>Unit</th>
            <th>Supplier</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($inventories as $index => $inventory)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $inventory->item_name ?? '-' }}</td>
                <td>{{ $inventory->category ?? '-' }}</td>
                <td>{{ $inventory->current_stock ?? '-' }}</td>
                <td>{{ $inventory->minimum_stock ?? '-' }}</td>
                <td>{{ $inventory->unit ?? '-' }}</td>
                <td>{{ $inventory->supplier ?? '-' }}</td>
                <td>{{ $inventory->description ?? '-' }}</td>
                <td>{{ $inventory->created_at ? $inventory->created_at->format('d M Y') : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No inventory records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
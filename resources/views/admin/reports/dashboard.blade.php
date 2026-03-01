<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin-bottom: 5px; color: #4f46e5; }
        .stats { margin-bottom: 30px; border-bottom: 1px solid #ddd; padding-bottom: 20px; }
        .stats table { width: 100%; }
        .stats-box { background: #f9fafb; padding: 15px; border-radius: 8px; text-align: center; }
        .stats-label { font-size: 10px; font-weight: bold; color: #6b7280; text-transform: uppercase; margin-bottom: 5px; }
        .stats-value { font-size: 18px; font-weight: bold; color: #111827; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table.data th, table.data td { border: 1px solid #e5e7eb; padding: 10px; text-align: left; }
        table.data th { background-color: #f3f4f6; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENJUALAN EVENT</h1>
        <p>Generated on: {{ $date }} | PIC: {{ $user }}</p>
    </div>

    <div class="stats">
        <table>
            <tr>
                <td width="50%">
                    <div class="stats-box">
                        <div class="stats-label">Total Pendapatan</div>
                        <div class="stats-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    </div>
                </td>
                <td width="50%">
                    <div class="stats-box">
                        <div class="stats-label">Tiket Terjual (Transaksi Berhasil)</div>
                        <div class="stats-value">{{ $totalTickets }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <h3 style="text-transform: uppercase; font-size: 14px;">Ringkasan Event Terbaru</h3>
    <table class="data">
        <thead>
            <tr>
                <th>Judul Event</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->category->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($event->start_time)->format('d M Y') }}</td>
                <td>{{ $event->venue }}, {{ $event->city }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Eventify Infrastructure v1.0 - Platform Manajemen Event & Ticketing
    </div>
</body>
</html>

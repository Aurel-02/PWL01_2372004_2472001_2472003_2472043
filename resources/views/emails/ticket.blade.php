<x-mail::message>
# Halo, {{ $transaction->user->name }}!

Terima kasih telah melakukan pembelian tiket untuk event **{{ $transaction->event->title }}**.
Pembayaran Anda telah berhasil dikonfirmasi.

Berikut adalah detail tiket Anda:

<x-mail::table>
| No. Tiket | Tipe | Harga |
| :--- | :--- | :--- |
@foreach($transaction->tickets as $ticket)
| {{ $ticket->ticket_code }} | {{ $ticket->ticketType->name }} | Rp {{ number_format($ticket->ticketType->price, 0, ',', '.') }} |
@endforeach
</x-mail::table>

Anda dapat melihat dan mengunduh E-Ticket Anda melalui tombol di bawah ini:

<x-mail::button :url="route('user.tickets')">
Lihat Tiket Saya
</x-mail::button>

Silakan tunjukkan kode tiket atau QR Code saat memasuki area event untuk proses validasi.

Terima kasih,<br>
Tim {{ config('app.name') }}
</x-mail::message>

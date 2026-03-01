@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Buat Event</h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="title" placeholder="Judul Event" class="w-full border p-2 rounded">

        <textarea name="description" placeholder="Deskripsi" class="w-full border p-2 rounded"></textarea>

        <input type="text" name="category" placeholder="Kategori" class="w-full border p-2 rounded">

        <input type="date" name="event_date" class="w-full border p-2 rounded">

        <input type="text" name="location" placeholder="Lokasi" class="w-full border p-2 rounded">

        <input type="number" name="quota" placeholder="Kuota" class="w-full border p-2 rounded">

        <input type="file" name="banner" class="w-full border p-2 rounded">

        <button type="submit" class="bg-secondary text-white px-4 py-2 rounded">
            Simpan Event
        </button>
    </form>
</div>
@endsection

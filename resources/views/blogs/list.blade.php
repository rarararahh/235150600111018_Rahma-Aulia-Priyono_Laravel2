<a href="/tambah">Tambah Blog</a>

@foreach($blogs as $blog)
<div>
    <h1>Judul : {{ $blog["judul"] }}</h1>
    <p>{{ $blog["isi"] }}</p>
    <p>{{ $blog["tanggal_buat"] }}</p>
    <p>Author : {{ $blog["pembuat"] }}</p>
    <div>
        <p>Aksi</p>
        <a href="">Edit</a>
        <a href="">Delete</a>
    </div>
</div>
@endforeach

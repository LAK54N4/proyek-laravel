@extends('layout.view_template')
@section('title','Detail Guru')
@section('content')

<table class="table">
    <tr>
        <th width="100px">Nama</th>
        <th width="30px">:</th>
        <th>{{ $guru->nama_guru}}</th>
    </tr>
    <tr>
        <th width="100px">NIP</th>
        <th width="30px">:</th>
        <th>{{ $guru->nip}}</th>
    </tr>
    <tr>
        <th width="100px">Mata Pelajaran</th>
        <th width="30px">:</th>
        <th>{{ $guru->mapel}}</th>
    </tr>
    <tr>
        <th width="100px">Foto</th>
        <th width="30px">:</th>
        <td><img src="{{ url('foto_guru/'.$guru->foto) }}" width="400px" alt="foto-guru"></td>
    </tr>
    <tr>
        <th><a href="/guru" class="btn btn-success tbn-sm">Kembali</a></th>
    </tr>
</table>

@endsection

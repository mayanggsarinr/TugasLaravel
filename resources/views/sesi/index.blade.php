@extends('layout.main') @section('title', 'Sesi') @section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Sesi</h3>
                <div class="card-tools">
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-collapse"
                        title="Collapse"
                    >
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-remove"
                        title="Remove"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{ route('sesi.create') }}" class="btn btn-primary"> Tambah </a>
                <hr>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nama Sesi</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($sesi as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>
                            <a href="{{ route('sesi.show', $item->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('sesi.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="{{ route('sesi.destroy', $item->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                                    data-toggle="tooltip" title='Delete'
                                    data-nama='{{ $item->nama }}'>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
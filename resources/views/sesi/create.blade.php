@extends('layout.main')
@section('title', 'Sesi')
@section('content')
<!--begin::Row-->
<div class="col-12">
    {{-- form tambah Sesi --}}
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Sesi</div>
        </div>
        <!--end::Header-->
        <form action="{{ route('sesi.store') }}" method="POST">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Sesi</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                    />
                    @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->

    </div>
</div>
@endsection
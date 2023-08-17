@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Darah Keluar</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                <button type="button" class=" d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    style="margin-left: 70vw;" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                </button>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kontributor</th>
                                <th>Jenis Darah</th>
                                <th>Surat Rekomendasi</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <!-- isi -->
                        <tbody>
                            @foreach ($blood_out as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->recipient_name }}</td>
                                    <td>{{ $item->fkBloodtypes->type }}</td>
                                    <td><button type="button" data-bs-toggle="modal"
                                            data-bs-target="#foto{{ $item->id }}"
                                            class="btn-sm btn btn-primary shadow-sm "><i class="fa-sm text-white-50"></i>
                                            Lihat</button></td>


                                    <td class="d-flex justify-content-center"><a
                                            href="{{ route('bloodin.destroy', $item->id) }}"
                                            class="btn-sm btn btn-danger shadow-sm "><i class="fa-sm text-white-50"></i>
                                            Hapus</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="foto{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Surat rekomendasi</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>


                                            <div class="modal-body">

                                                <img style="max-width: 360px"
                                                    src="{{ asset('storage/' . $item->recom_letter) }}" alt="">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('bloodout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row" style="margin-buttom: 20px">

                                <label for="contributor">Nama Pendonor</label>
                                <input type="text" id="contributor" name="contributor">
                            </div>

                            <div class="row" style="margin-buttom: 20px">

                                <label for="type">Tipe darah</label>
                                <select id="type" name="type" class="form-select form-select-sm"
                                    aria-label=".form-select-sm example">
                                    <option selected>Pilih..</option>
                                    @foreach ($type as $item)
                                        <option value="{{ $item->id }}">{{ $item->type }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="row" style="margin-buttom: 20px">
                                <label for="photo">
                                    Surat Rekomendasi
                                </label>
                                <input type="file" name="photo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection

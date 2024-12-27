{{-- ada dua cara extend --}}
@extends('components.pasien')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hasil Pemeriksaan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-pasien') }}">Pasien</a></li>
                            <li class="breadcrumb-item active">Hasil Pemeriksaan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.List History Obat -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Riwayat Hasil Pemeriksaan</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalRiwayat" tabindex="-1" role="dialog"
                                aria-labelledby="modalRiwayatLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalRiwayatLabel">Riwayat Pemeriksaan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tanggal Periksa: <span id="tgl_periksa"></span></p>
                                            <p>Catatan: <span id="catatan"></span></p>
                                            <p>Biaya Periksa: <span id="biaya_periksa"></span></p>
                                            <p>Daftar Obat:</p>
                                            <ul id="daftar_obat"></ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabel -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Poli</th>
                                            <th>Dokter</th>
                                            <th>Hari Praktek</th>
                                            <th>Antrian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->jadwalPeriksa->dokter->ruangPoli->nama_poli }}</td>
                                                <td>{{ $d->jadwalPeriksa->dokter->nama }}</td>
                                                <td>{{ $d->jadwalPeriksa->hari }}</td>
                                                <td>{{ $d->no_antrian }}</td>
                                                <td>
                                                    @php
                                                        $showEdit =
                                                            $d->periksa->isNotEmpty() &&
                                                            $d->periksa->first()->detailPeriksa->isNotEmpty();
                                                    @endphp

                                                    @if ($showEdit)
                                                        <a href="#" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modalRiwayat"
                                                            data-id="{{ $d->periksa->first()->id }}">
                                                            <i class="fas fa-tags"></i> Riwayat
                                                        </a>
                                                    @else
                                                        <a href="#" class="badge bg-warning">
                                                            Belum Diperiksa
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- JavaScript -->
    <script>
        $('#modalRiwayat').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id'); // Ambil ID dari atribut data-id

            // AJAX request untuk mengambil data pemeriksaan
            $.ajax({
                url: '/hasil/' + id,
                method: 'GET',
                success: function(data) {
                    var modal = $('#modalRiwayat');
                    modal.find('#tgl_periksa').text(data.tgl_periksa);
                    modal.find('#catatan').text(data.catatan);
                    modal.find('#biaya_periksa').text(data.biaya_periksa);

                    var obatList = modal.find('#daftar_obat');
                    obatList.empty();
                    data.detail_periksa.forEach(function(item) {
                        obatList.append('<li>' + item.obat.nama_obat + '</li>');
                    });
                }
            });
        });
    </script>
@endsection

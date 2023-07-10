<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="main-content">
    <div class="section-header">
        <br />
        <h3 style="text-align: center;">Laporan List Printer Device</h3>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                    @foreach(App\Models\Logo::all() as $logos)
                    <p>Nama Perusahaan :  &nbsp; {{ $logos->nama_perusahaan}}</p>
                    @endforeach
                    <!-- card-body -->
                        <div class="col-12 table-responsive">
                        <br />
                            @if ($data->isEmpty())
                                <p>Tidak Ada Data Device Printer</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th>Serial Number</th>
                                            <th>Brand rak</th>
                                            <th>Type rak</th>
                                            <th>Kode rak</th>
                                            <th>Dimensi rak</th>
                                            <th>Ukuran U rak</th>
                                            <th>Sisa Penggunaan U rak</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Harga rak</th>
                                            <th>Deskripsi</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $rak)
                                        <tr>
                                            <td><p>{{ $rak->sn_rak }}</p></td>
                                            <td><p>{{ $rak->brand_rak }}</p></td>
                                            <td><p>{{ $rak->type_rak }}</p></td>
                                            <td><p>{{ $rak->kode_rak  }}</p></td>
                                            <td><p>{{ $rak->dimensi_rak  }}</p></td>
                                            <td><p>{{ $rak->ukuran_u_rak  }}</p></td>
                                            <td><p>{{ $rak->sisa_u  }}</p></td>
                                            <td><p>{{ $rak->tahun_anggaran  }}</p></td>
                                            <td><p>{{ $rak->harga_rak  }}</p></td>
                                            <td><p>{{ $rak->deskripsi  }}</p></td>
                                            <td> <img src="{{ public_path('/images-rak/'.$rak->foto_rak ) }}" style="width: 100px; height: 100px"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                            @endif
                        </div>
                    <!-- card-body -->
            </div>
        </div>
    </div>
</div>
</body>
</html>
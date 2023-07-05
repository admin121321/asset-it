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
                                <p>Tidak Ada Data Lisensi Software</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th>Serial Number</th>
                                            <th>Brand Software</th>
                                            <th>Model Software</th>
                                            <th>Type Lisensi</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Masa Aktif</th>
                                            <th>Harga Lisensi</th>
                                            <th>Key Lisensi</th>
                                            <th>Versi Bit</th>
                                            <th>Stok</th>
                                            <th>Sisa Stok</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $lisensi)
                                        <tr>
                                            <td><p>{{ $lisensi->sn_lisensi }}</p></td>
                                            <td><p>{{ $lisensi->brand_lisensi }}</p></td>
                                            <td><p>{{ $lisensi->model_lisensi }}</p></td>
                                            <td><p>{{ $lisensi->type_lisensi  }}</p></td>
                                            <td><p>{{ $lisensi->tahun_anggaran  }}</p></td>
                                            <td><p>{{ $lisensi->masa_aktif  }}</p></td>
                                            <td><p>{{ $lisensi->harga_lisensi  }}</p></td>
                                            <td><p>{{ $lisensi->key_lisensi  }}</p></td>
                                            <td><p>{{ $lisensi->bit_os  }}</p></td>
                                            <td><p>{{ $lisensi->stok  }}</p></td>
                                            <td><p>{{ $lisensi->sisa_stok  }}</p></td>
                                            <td> <img src="{{ public_path('/images-lisensi/'.$lisensi->foto_lisensi ) }}" style="width: 50px; height: 50px"></td>
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
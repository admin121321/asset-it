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
                                            <th>SN Aksesoris</th>
                                            <th>Brand Aksesoris</th>
                                            <th>Model Aksesoris</th>
                                            <th>Type Aksesoris</th>
                                            <th>Garansi Aksesoris</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Harga Aksesoris</th>
                                            <th>Stok</th>
                                            <th>Sisa Stok</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $aksesoris)
                                        <tr>
                                            <td><p>{{ $aksesoris->sn_aksesoris }}</p></td>
                                            <td><p>{{ $aksesoris->brand_aksesoris }}</p></td>
                                            <td><p>{{ $aksesoris->model_aksesoris }}</p></td>
                                            <td><p>{{ $aksesoris->type_aksesoris  }}</p></td>
                                            <td><p>{{ $aksesoris->garansi_aksesoris  }}</p></td>
                                            <td><p>{{ $aksesoris->tahun_anggaran  }}</p></td>
                                            <td><p>{{ $aksesoris->harga_aksesoris  }}</p></td>
                                            <td><p>{{ $aksesoris->stok  }}</p></td>
                                            <td><p>{{ $aksesoris->sisa_stok  }}</p></td>
                                            <td> <img src="{{ public_path('/images-aksesoris/'.$aksesoris->foto_aksesoris ) }}" style="width: 50px; height: 50px"></td>
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
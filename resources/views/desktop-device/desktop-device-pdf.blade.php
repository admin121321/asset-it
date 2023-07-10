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
        <h3 style="text-align: center;">Laporan List Desktop Device</h3>
        <p style="text-align: center;">Komputer / Laptop</p>
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
                                <p>Tidak Ada Data Desktop</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th>SN Desktop</th>
                                            <th>Brand Desktop</th>
                                            <th>Model Desktop</th>
                                            <th>Type Desktop</th>
                                            <th>RAM Desktop</th>
                                            <th>Hardisk Desktop</th>
                                            <th>Processor Desktop</th>
                                            <th>Core Processor Desktop</th>
                                            <th>Garansi</th>
                                            <th>Thn Anggaran</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Sisa Stok</th>
                                            <th>Foto</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $desktop)
                                        <tr>
                                            <td><p>{{ $desktop->sn_desktop }}</p></td>
                                            <td><p>{{ $desktop->brand_desktop }}</p></td>
                                            <td><p>{{ $desktop->model_desktop }}</p></td>
                                            <td><p>{{ $desktop->type_aksesoris  }}</p></td>
                                            <td><p>{{ $desktop->ram_desktop }}</p></td>
                                            <td><p>{{ $desktop->hardisk_desktop }}</p></td>
                                            <td><p>{{ $desktop->processor_desktop }}</p></td>
                                            <td><p>{{ $desktop->core_desktop }}</p></td>
                                            <td><p>{{ $desktop->garansi_desktop  }}</p></td>
                                            <td><p>{{ $desktop->tahun_anggaran  }}</p></td>
                                            <td><p>{{ $desktop->harga_desktop  }}</p></td>
                                            <td><p>{{ $desktop->stok  }}</p></td>
                                            <td><p>{{ $desktop->sisa_stok  }}</p></td>
                                            <td> <img src="{{ public_path('/images-desktop/'.$desktop->foto_desktop ) }}" style="width: 50px; height: 50px"></td>
                                            <td><p>{{ $desktop->deskripsi_desktop  }}</p></td>
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
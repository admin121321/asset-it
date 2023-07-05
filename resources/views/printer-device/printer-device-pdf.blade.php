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
                                            <th>Brand Printer</th>
                                            <th>Model Printer</th>
                                            <th>Type Printer</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Harga Printer</th>
                                            <th>Stok Awal</th>
                                            <th>Sisa Stok</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $printer)
                                        <tr>
                                            <td><p>{{ $printer->serial_number }}</p></td>
                                            <td><p>{{ $printer->brand_printer }}</p></td>
                                            <td><p>{{ $printer->model_printer }}</p></td>
                                            <td><p>{{ $printer->type_printer  }}</p></td>
                                            <td><p>{{ $printer->tahun_anggaran  }}</p></td>
                                            <td><p>{{ $printer->harga_printer  }}</p></td>
                                            <td><p>{{ $printer->stok  }}</p></td>
                                            <td><p>{{ $printer->sisa_stok  }}</p></td>
                                            <td> <img src="{{ public_path('/images-printer/'.$printer->foto_printer ) }}" style="width: 100px; height: 100px"></td>
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
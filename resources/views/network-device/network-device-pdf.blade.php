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
        <h3 style="text-align: center;">Laporan List Device Network</h3>
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
                                <p>Tidak Ada Data Device Network</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th>Serial Number</th>
                                            <th>Brand Device</th>
                                            <th>Model Device</th>
                                            <th>Type Device</th>
                                            <th>Port Device</th>
                                            <th>Masa Garansi</th>
                                            <th>Tahun Anggaran</th>
                                            <th>Harga Device</th>
                                            <th>Stok Awal</th>
                                            <th>Sisa Stok</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $network)
                                        <tr>
                                            <td><p>{{ $network->sn_network }}</p></td>
                                            <td><p>{{ $network->brand_network }}</p></td>
                                            <td><p>{{ $network->model_network }}</p></td>
                                            <td><p>{{ $network->type_network }}</p></td>
                                            <td><p>{{ $network->port_network }}</p></td>
                                            <td><p>{{ $network->garansi_network }}</p></td>
                                            <td><p>{{ $network->tahun_anggaran }}</p></td>
                                            <td><p>{{ $network->harga_network }}</p></td>
                                            <td><p>{{ $network->stok }}</p></td>
                                            <td><p>{{ $network->sisa_stok }}</p></td>
                                            <td> <img src="{{ public_path('/images-network/'.$network->foto_network ) }}" style="width: 100px; height: 100px"></td>
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
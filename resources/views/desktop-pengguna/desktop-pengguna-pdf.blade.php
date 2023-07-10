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
                                            <th>Nama Pengguna</th>
                                            <th>ID Pengguna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $desktop)
                                        <tr>
                                            <td><p>{{ $desktop->sn_desktop }}</p></td>
                                            <td><p>{{ $desktop->brand_desktop }}</p></td>
                                            <td><p>{{ $desktop->model_desktop }}</p></td>
                                            <td><p>{{ $desktop->type_desktop  }}</p></td>
                                            <td><p>{{ $desktop->name  }}</p></td>
                                            <td><p>{{ $desktop->card_id  }}</p></td>
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
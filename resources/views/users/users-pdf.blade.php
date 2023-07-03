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
        <h3 style="text-align: center;">Laporan List User</h3>
        <h5 style="text-align: center;">Pengguna Device IT</h5>
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
                                <p>Tidak Ada Data Anggota</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th><p>ID Card</p></th>
                                            <th><p>Nama</p></th>
                                            <th><p>Divisi</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $user)
                                        <tr>
                                            <td><p>{{ $user->card_id }}</p></td>
                                            <td><p>{{ $user->name }}</p></td>
                                            <td><p>{{ $user->nama_divisi }}</p></td>
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
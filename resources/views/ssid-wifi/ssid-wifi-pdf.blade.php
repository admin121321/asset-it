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
        <h3 style="text-align: center;">Laporan List SSID WIFI</h3>
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
                                <p>Tidak Ada Data SSID WIFI</p>
                            @else
                            <table class="table table-striped table-bordered zero-configuration"> 
                                    <thead>
                                        <tr>
                                            <th>SSID Name</th>
                                            <th>IP Segment</th>
                                            <th>Provider</th>
                                            <th>Lokasi</th>
                                            <th>Akun Login</th>
                                            <th>Pass Lama</th>
                                            <th>Pass Baru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $ssid)
                                        <tr>
                                            <td><p>{{ $ssid->ssid_name }}</p></td>
                                            <td><p>{{ $ssid->ip_segment }}</p></td>
                                            <td><p>{{ $ssid->provider }}</p></td>
                                            <td><p>{{ $ssid->lokasi_ssid }}</p></td>
                                            <td><p>{{ $ssid->user_ssid }}</p></td>
                                            <td><p>{{ $ssid->password_lama }}</p></td>
                                            <td><p>{{ $ssid->password_baru }}</p></td>
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
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="main-content">
    <div class="section-header">
        <br />
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="section-body">
                            <!-- card-body -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                <br />
                                    @if ($data->isEmpty())
                                        <p>Tidak Ada Data Anggota</p>
                                    @else
                                    <table class="table table-striped table-bordered zero-configuration printerdevice_datatable"> 
                                            <thead>
                                                <tr>
                                                    <th><p>ID Anggota</p></th>
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
                            </div>
                            <!-- card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@extends('layouts.app-backend')

@section('content')
  <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Users</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('users')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Server</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('server_device')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-server"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Rak Server</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('rak_server')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-reorder"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Desktop Device</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('desktop_device')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-desktop"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Aksesoris Desktop</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('aksesoris_device')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-mouse-pointer"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Licensi Software</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('lisensi_software')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-book"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Printer Device</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('printer_devices')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-print"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Network Device</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('network_device')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-sitemap"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">SSID Wifi</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ DB::table('ssid_wifi')->count() }}</h2>
                                    <p class="text-white mb-0">Total</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-wifi"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection

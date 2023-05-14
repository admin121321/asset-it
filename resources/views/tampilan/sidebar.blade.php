  <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/home">Home</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Asset</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-server menu-icon"></i> <span class="nav-text">Server</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('server-device.index') }}">Device</a></li>
                            <li><a href="{{ route('server-akun.index') }}">Akun Akses</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-reorder menu-icon"></i> <span class="nav-text">Rak Server</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('rak-server-lokasi.index') }}">Lokasi</a></li>
                            <li><a href="{{ route('rak-server.index') }}">Data Rak</a></li>
                            <li><a href="{{ route('rak-server-pengguna.index') }}">Penggunaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-desktop menu-icon"></i> <span class="nav-text">Desktop</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('desktop-device.index') }}">Device</a></li>
                            <li><a href="{{ route('desktop-pengguna.index') }}">Penggunaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-mouse-pointer menu-icon"></i> <span class="nav-text">Aksesoris</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('aksesoris-device.index') }}">Device</a></li>
                            <li><a href="{{ route('aksesoris-pengguna.index') }}">Penggunaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-book menu-icon"></i> <span class="nav-text">Lisensi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('lisensi-software.index') }}">Data Lisensi</a></li>
                            <li><a href="{{ route('lisensi-software-pengguna.index') }}">Penggunaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-print menu-icon"></i> <span class="nav-text">Printer</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('printer-device.index') }}">Data Printer</a></li>
                            <li><a href="{{ route('printer-pengguna.index') }}">Penggunaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-sitemap menu-icon"></i> <span class="nav-text">Network</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('network-device.index') }}">Device</a></li>
                            <li><a href="{{ route('network-lokasi.index') }}">Lokasi</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-wifi menu-icon"></i> <span class="nav-text">Wifi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('ssid-wifi.index') }}">SSID</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Settings</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-users menu-icon"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('users.index') }}">Data User</a></li>
                            <li><a href="{{ route('users-divisi.index') }}">Data Divisi</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Logo</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/logo">Input Logo</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
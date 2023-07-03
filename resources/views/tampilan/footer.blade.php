  <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                @foreach(App\Models\Logo::all() as $logos)
                    <p>Copyright &copy; Designed & Developed by <a href=#">&nbsp; {{ $logos->nama_perusahaan}}</a> 2023</p>
                @endforeach
            </div>
        </div>
        <!--**********************************
            Footer end Created By Sudiman Syah Widodo 2023
        ***********************************-->
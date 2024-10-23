<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mosikola-App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;&nbsp;
                        <p>
                            Data Utama
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sekolah" class="nav-link">
                                <i class="fa fa-home" aria-hidden="true"></i>&nbsp;
                                <p>Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/guru" class="nav-link">
                                <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                                <p>Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tendik/index" class="nav-link">
                                <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                                <p>Tendik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/mapel" class="nav-link">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kelas" class="nav-link">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;
                                <p>Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/lokasi" class="nav-link">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;
                                <p>Lokasi Kerja</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/laporan/perbulan" class="nav-link">
                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                <p>Guru Per Bulan</p>
                            </a>
                            <a href="/laporan/perkelas" class="nav-link">
                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                <p>Per Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/laporan/perperiode" class="nav-link">
                                <i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;
                                <p>Per Periode</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/periode" class="nav-link">
                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                <p>Periode</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jam" class="nav-link">
                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                <p>Jam Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/target" class="nav-link">
                                <i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;
                                <p>Target</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kontrol" class="nav-link">
                                <i class="fa fa-bullseye" aria-hidden="true"></i>&nbsp;
                                <p>Kontrol</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <hr>

                <li class="nav-item active">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __(' Keluar | Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

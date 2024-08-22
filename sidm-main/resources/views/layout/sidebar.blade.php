<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="">
                    <a href="/" class="d-flex justify-content-center align-items-center">
                        <img src="/mazer/images/logo/logo1.png" alt="Logo" srcset=""
                            style="width: 8rem;height:8rem;" />
                        <h1> SIDM</h1>
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ $title == 'Home' ? 'active' : '' }} ">
                    <a href="/" class='sidebar-link'>
                        <i class="bi bi-house-door-fill"></i>
                        <span>Home</span>
                    </a>
                </li>
                @if (auth()->check())
                    @if (auth()->user()->level != 'pasien')
                        <li class="sidebar-item {{ $title == 'Dashboard' ? 'active' : '' }} ">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->level == 'admin' || auth()->user()->level == 'poli')
                        <li
                            class="sidebar-item
                    {{ $title == 'Penyakit' || $title == 'Gejala' || $title == 'Pengguna' || $title == 'Pasien' ? 'active' : '' }}
                     has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Data Master</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{ $title == 'Penyakit' ? 'active' : '' }} ">
                                    <a href="{{ route('hypothesis.index') }}">Data Penyakit</a>
                                </li>
                                <li class="submenu-item {{ $title == 'Gejala' ? 'active' : '' }} ">
                                    <a href="{{ route('evidence.index') }}">Data Gejala</a>
                                </li>
                                @if (auth()->user()->level == 'admin')
                                    <li class="submenu-item {{ $title == 'Pengguna' ? 'active' : '' }} ">
                                        <a href="{{ route('user.index') }}">Data Pengguna</a>
                                    </li>
                                @endif
                                <li class="submenu-item {{ $title == 'Pasien' ? 'active' : '' }} ">
                                    <a href="{{ route('patient.index') }}">Data Pasien</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (auth()->user()->level == 'admin')
                        <li
                            class="sidebar-item
                {{ $title == 'Rule Certainty Factor' || $title == 'Rule Forward Chaining' ? 'active' : '' }}
                 has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-ui-checks"></i>
                                <span>Rule</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{ $title == 'Rule Forward Chaining' ? 'active' : '' }} ">
                                    <a href="{{ route('role.forward.index') }}"> Forward Chaining</a>
                                </li>
                                <li class="submenu-item {{ $title == 'Rule Certainty Factor' ? 'active' : '' }} ">
                                    <a href="{{ route('role.index') }}"> Certainty Factor</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->level != 'sik')
                        <li class="sidebar-item {{ $title == 'Konsultasi' ? 'active' : '' }}">
                            <a href="{{ route('expert-system') }}" class='sidebar-link'>
                                <i class="bi bi-list-check"></i>
                                <span>Deteksi Dini</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-item {{ $title == 'Riwayat' ? 'active' : '' }}">
                        <a href="{{ route('history.index') }}" class='sidebar-link'>
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat</span>
                        </a>
                    </li>
                    @if (auth()->user()->level != 'pasien')
                        <li
                            class="sidebar-item
                {{ $title == 'Laporan Penyakit' || $title == 'Laporan Pengguna' ? 'active' : '' }}
                 has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-journal-text"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{ $title == 'Laporan Penyakit' ? 'active' : '' }} ">
                                    <a href="{{ route('report.hypothesis.index') }}">Penyakit</a>
                                </li>
                                <li class="submenu-item {{ $title == 'Laporan Pengguna' ? 'active' : '' }} ">
                                    <a href="{{ route('report.user.index') }}">Pengguna</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if (auth()->user()->level != 'sik' && auth()->user()->level != 'pasien' && auth()->user()->level != 'poli')
                        <li class="sidebar-title">
                            <hr>
                        </li>
                        <li class="sidebar-item {{ $title == 'Setting' ? 'active' : '' }}">
                            <a href="{{ route('setting.index') }}" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                    @endif




                    {{-- <li class="sidebar-item {{ $title == 'Setting' || $title == 'Users' ? 'active' : '' }} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-gear"></i>
                            <span>Setting</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ $title == 'Setting' ? 'active' : '' }}">
                                <a href="{{ route('setting.index') }}">Setting</a>
                            </li>
                            @if (auth()->user()->level == 'admin')
                                <li class="submenu-item {{ $title == 'User' ? 'active' : '' }}">
                                    <a href="{{ route('user.index') }}">User data</a>
                                </li>
                            @endif
                        </ul>
                    </li> --}}
                @else
                    <li class="sidebar-item {{ $title == 'Expert System' ? 'active' : '' }}">
                        <a href="{{ route('expert-system') }}" class='sidebar-link'>
                            <i class="bi bi-list-check"></i>
                            <span>Expert System</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title == 'Login' ? 'active' : '' }} ">
                        <a href="/login" class='sidebar-link'>
                            <i class="bi bi-box-arrow-in-left"></i>
                            <span>Login</span>
                        </a>
                    </li>
                @endif

                <!-- <li class="sidebar-title">Setting</li> -->

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>

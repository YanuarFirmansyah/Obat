
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          @if (Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pasien.index') }}" class="nav-link {{ request()->is('pasien*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Pasien</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dokter.index') }}" class="nav-link {{ request()->is('dokter*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Dokter</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('poli.index') }}" class="nav-link {{ request()->is('poli*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-hospital"></i>
              <p>Poli</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('obat.index') }}" class="nav-link {{ request()->is('obat*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-capsules"></i>
              <p>Obat</p>
            </a>
          </li>

          @elseif (Auth::user()->role == 'dokter')
          <!-- Sidebar Profil Dokter -->
          <li class="nav-item">
            <a href="{{ route('dokter.profil') }}" class="nav-link {{ request()->is('dokter/profil') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-md"></i>
              <p>Profil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('jadwal_periksa.index') }}" class="nav-link {{ request()->is('jadwal-periksa*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Jadwal Periksa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('memeriksa.index') }}" class="nav-link {{ request()->is('memeriksa*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-stethoscope"></i>
              <p>
                Memeriksa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('riwayat_pasien.index') }}" class="nav-link {{ request()->is('riwayat-pasien*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Pasien
              </p>
            </a>
          </li>

          @elseif (Auth::user()->role == 'pasien')
          <li class="nav-item">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/periksa" class="nav-link {{ request()->is('periksa') ? 'active' : '' }}">
              <i class="nav-icon fas fa-stethoscope"></i>
              <p>
                Periksa
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                      Logout
                  </p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
        </ul>
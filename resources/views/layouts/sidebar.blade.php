  <aside class="page-sidebar">
      <div class="page-logo">
          <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
              data-toggle="modal" data-target="#modal-shortcut">

          </a>
      </div>
      <!-- BEGIN PRIMARY NAVIGATION -->
      <nav id="js-primary-nav" class="primary-nav" role="navigation">
          <div class="nav-filter">
              <div class="position-relative">
                  <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                      tabindex="0">
                  <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                      data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                      <i class="fal fa-chevron-up"></i>
                  </a>
              </div>
          </div>
          <div class="info-card">
              {{-- <img src="/img/logo_dlhsm.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern"> --}}
              <div class="info-card-text">
                  <a href="#" class="text-white d-flex align-items-center">
                      <span class="text-truncate text-truncate-sm d-inline-block">
                          Admin StuntAIDS
                      </span>
                  </a>
              </div>
              <img src="/image/bg-home.png" class="cover" alt="cover">
              <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                  data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                  <i class="fal fa-angle-down"></i>
              </a>
          </div>
          <ul id="js-nav-menu" class="nav-menu">
              <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                  <a href="{{ route('admin.dashboard') }}" title="Admin Dashboard"
                      data-filter-tags="application intel analytics dashboard">
                      <span class="nav-link-text color-white"
                          data-i18n="nav.application_intel_analytics_dashboard">Dashboard</span>
                  </a>
              </li>
              {{-- <li class="{{ Request::is('transaksi*') ? 'active open' : '' }}">
                  <a href="#" title="Application Intel" data-filter-tags="application intel">
                      <i class="fal fa-info-circle" style="color: white"> </i>
                      <span class="nav-link-text color-white" data-i18n="nav.application_intel">Transaksi</span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('transaksi/permohonan/pribadi') ? 'active' : '' }}">
                          <a href="/transaksi/permohonan/pribadi" title="Marketing Dashboard">
                              <span class="nav-link-text color-white"
                                  data-i18n="nav.application_intel_marketing_dashboard">Permohonan Pribadi</span>
                          </a>
                      </li>
                      <li class="{{ Request::is('transaksi/permohonan/droppoint') ? 'active' : '' }}">
                          <a href="/transaksi/permohonan/droppoint" title="Marketing Dashboard">
                              <span class="nav-link-text color-white"
                                  data-i18n="nav.application_intel_marketing_dashboard">Permohonan
                                  Drop Point</span>
                          </a>
                      </li>
                  </ul>
              </li> --}}
              <li class="{{ Request::is('master*') ? 'active open' : '' }}">
                  <a href="#" title="Application Intel" data-filter-tags="application intel">
                      <i class="fal fa-info-circle" style="color: white;"></i>
                      <span class="nav-link-text color-white" data-i18n="nav.application_intel">Master</span>
                  </a>
                  <ul>
                      <li class=" {{ Request::is('master/puskesmas') ? 'active' : '' }}">
                          <a href="/master/puskesmas" title="Data Puskesmas"
                              data-filter-tags="Data Puskesmas">
                              <span class="nav-link-text color-white"
                                  data-i18n="nav.datapuskesmas">Puskesmas</span>
                          </a>
                      </li>
                      <li class=" {{ Request::is('master/operationaltime') ? 'active' : '' }}">
                        <a href="/master/operationaltime" title="Data Operational Time"
                            data-filter-tags="Data Operational Time">
                            <span class="nav-link-text color-white"
                                data-i18n="nav.dataoperationaltime">Operational Time</span>
                        </a>
                    </li>
                    <li class=" {{ Request::is('master/doctor') ? 'active' : '' }}">
                        <a href="/master/doctor" title="Data Doctor Puskesmas"
                            data-filter-tags="Data Doctor Puskesmas">
                            <span class="nav-link-text color-white"
                                data-i18n="nav.dataoperationaltime">Doctor</span>
                        </a>
                    </li>
                    <li class=" {{ Request::is('master/doctoroperationaltime') ? 'active' : '' }}">
                        <a href="/master/doctoroperationaltime" title="Data Jadwal Dokter Puskesmas"
                            data-filter-tags="Data Jadwal Dokter Puskesmas">
                            <span class="nav-link-text color-white"
                                data-i18n="nav.dataoperationaltime">Doctor Operational Time</span>
                        </a>
                    </li>
                  </ul>
              </li>
          </ul>
          <div class="filter-message js-filter-message bg-success-600"></div>
      </nav>
      <!-- END PRIMARY NAVIGATION -->
      <!-- NAV FOOTER -->
      <div class="nav-footer shadow-top">
          <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
              class="hidden-md-down">
              <i class="ni ni-chevron-right"></i>
              <i class="ni ni-chevron-right"></i>
          </a>
      </div> <!-- END NAV FOOTER -->
  </aside>

  <!-- Menu -->
  @php

      $modules = [
          [
              'module_name' => 'posts',
              'text' => __('Posts'),
              'icon' => 'fa-regular fa-file-lines',
              'permission' => 'view_posts',
              'url' => route('backend.posts.index'),
          ],
          [
              'module_name' => 'categories',
              'text' => __('Categories'),
              'icon' => 'fa-solid fa-diagram-project',
              'permission' => 'view_categories',
              'url' => route('backend.categories.index'),
          ],
          [
              'module_name' => 'tags',
              'text' => __('Tags'),
              'icon' => 'fa-solid fa-tags',
              'permission' => 'view_tags',
              'url' => route('backend.tags.index'),
          ],
          [
              'module_name' => 'settings',
              'text' => __('Settings'),
              'icon' => 'fa-solid fa-gears',
              'permission' => 'edit_settings',
              'url' => route('backend.settings'),
          ],
          [
              'module_name' => 'backups',
              'text' => __('Backups'),
              'icon' => 'fa-solid fa-box-archive',
              'permission' => 'view_backups',
              'url' => route('backend.backups.index'),
          ],
          [
              'module_name' => 'users',
              'text' => __('Users'),
              'icon' => 'fa-solid fa-user-group',
              'permission' => 'view_users',
              'url' => route('backend.users.index'),
          ],
          [
              'module_name' => 'roles',
              'text' => __('Roles'),
              'icon' => 'fa-solid fa-user-shield',
              'permission' => 'view_roles',
              'url' => route('backend.roles.index'),
          ],
          [
              'module_name' => 'logs',
              'text' => __('Logs'),
              'icon' => 'bx bx-dock-top',
              'permission' => 'view_logs',
              'url' => 'javascript:void(0);',
              'sub_menu' => [
                  [
                      'text' => __('Log Dashboard'),
                      'url' => route('log-viewer::dashboard'),
                  ],
                  [
                      'text' => __('Daily Log'),
                      'url' => route('log-viewer::logs.list'),
                  ],
              ],
          ],
      ];
  @endphp
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
          <a href="{{ route('home') }}" class="app-brand-link">
              <img class="w-25" src="{{ asset('img/logo-1-dark.png') }}" alt="">
              {{-- <span class="app-brand-logo demo">
                  <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink">
                      <defs>
                          <path
                              d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                              id="path-1"></path>
                          <path
                              d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                              id="path-3"></path>
                          <path
                              d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                              id="path-4"></path>
                          <path
                              d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                              id="path-5"></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                              <g id="Icon" transform="translate(27.000000, 15.000000)">
                                  <g id="Mask" transform="translate(0.000000, 8.000000)">
                                      <mask id="mask-2" fill="white">
                                          <use xlink:href="#path-1"></use>
                                      </mask>
                                      <use fill="#696cff" xlink:href="#path-1"></use>
                                      <g id="Path-3" mask="url(#mask-2)">
                                          <use fill="#696cff" xlink:href="#path-3"></use>
                                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                      </g>
                                      <g id="Path-4" mask="url(#mask-2)">
                                          <use fill="#696cff" xlink:href="#path-4"></use>
                                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                      </g>
                                  </g>
                                  <g id="Triangle"
                                      transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                      <use fill="#696cff" xlink:href="#path-5"></use>
                                      <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
              </span>
             --}}
              <span class=" demo menu-text text-black fw-bolder ms-2">UNIQUE MED SERVICES</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
              <a href="{{ route('backend.dashboard') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Dashboard</div>
              </a>
          </li>
          @if (auth()->user()->hasRole('super admin'))
              @php
                  $masterFilesRoutes = [
                      'backend.colors',
                      'backend.colors.create',
                      'backend.colors.edit',
                      'backend.sizes',
                      'backend.sizes.create',
                      'backend.sizes.edit',
                      'backend.qualification-types',
                      'backend.qualification-types.create',
                      'backend.qualification-types.edit',
                      'backend.shift-types',
                      'backend.shift-types.create',
                      'backend.shift-types.edit',
                      'backend.shift-hours',
                      'backend.shift-hours.create',
                      'backend.shift-hours.edit',
                      'backend.clinician-types',
                      'backend.clinician-types.create',
                      'backend.clinician-types.edit',
                  ];
              @endphp
              <li class="menu-item {{ areAnyRoutesActive($masterFilesRoutes) ? 'open' : '' }}" style="">

                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-folder-open"></i>
                      <div data-i18n="Misc">Master Files</div>
                  </a>
                  <ul class="menu-sub">
                      <li
                          class="menu-item {{ request()->routeIs('backend.colors') || request()->routeIs('backend.colors.create') || request()->routeIs('backend.colors.edit') ? 'active' : '' }}">
                          <a href="{{ route('backend.colors') }}" class="menu-link">
                              <i class="menu-icon tf-icons bx bx-folder-open"></i>
                              <div data-i18n="Analytics">Colors</div>
                          </a>
                      </li>
                      <li
                          class="menu-item {{ request()->routeIs('backend.sizes') || request()->routeIs('backend.sizes.create') || request()->routeIs('backend.sizes.edit') ? 'active' : '' }}">
                          <a href="{{ route('backend.sizes') }}" class="menu-link">
                              <i class="menu-icon tf-icons bx bx-folder-open"></i>
                              <div data-i18n="Analytics">Sizes</div>
                          </a>
                      </li>
                      <li
                          class="menu-item {{ request()->routeIs('backend.qualification-types') || request()->routeIs('backend.qualification-types.create') || request()->routeIs('backend.qualification-types.edit') ? 'active' : '' }}">

                          <a href="{{ route('backend.qualification-types') }}" class="menu-link">
                              <i class="menu-icon tf-icons bx bx-folder-open"></i>
                              <div data-i18n="Analytics">Qualification Types</div>
                          </a>
                      </li>
                      <li
                          class="menu-item {{ request()->routeIs('backend.shift-types') || request()->routeIs('backend.shift-types.create') || request()->routeIs('backend.shift-types.edit') ? 'active' : '' }}">

                          <a href="{{ route('backend.shift-types') }}" class="menu-link">
                              <i class="menu-icon tf-icons bx bx-folder-open"></i>
                              <div data-i18n="Analytics">Shift Types</div>
                          </a>
                      </li>
                      <li
                          class="menu-item {{ request()->routeIs('backend.shift-hours') || request()->routeIs('backend.shift-hours.create') || request()->routeIs('backend.shift-hours.edit') ? 'active' : '' }}">

                          <a href="{{ route('backend.shift-hours') }}" class="menu-link">
                              <i class="menu-icon tf-icons bx bx-folder-open"></i>
                              <div data-i18n="Analytics">Shift Hours</div>
                          </a>
                      </li>
                      <li
                          class="menu-item {{ request()->routeIs('backend.clinician-types') || request()->routeIs('backend.clinician-types.create') || request()->routeIs('backend.clinician-types.edit') ? 'active' : '' }}">

                          <a href="{{ route('backend.clinician-types') }}" class="menu-link">
                              <i class="menu-icon tf-icons bx bx-folder-open"></i>
                              <div data-i18n="Analytics">Clinician Types</div>
                          </a>
                      </li>
                  </ul>
              </li>

              <li
                  class="menu-item {{ request()->routeIs('backend.products') || request()->routeIs('backend.products.create') || request()->routeIs('backend.products.edit') ? 'active' : '' }}">

                  <a href="{{ route('backend.products') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-cart"></i>
                      <div data-i18n="Analytics">Products</div>
                  </a>
              </li>
              <li
                  class="menu-item {{ request()->routeIs('backend.courses') || request()->routeIs('backend.courses.create') || request()->routeIs('backend.courses.edit') || request()->routeIs('backend.courses.content') || request()->routeIs('backend.course-schedules') || request()->routeIs('backend.course-schedules.create') || request()->routeIs('backend.course-schedules.edit') ? 'active' : '' }}">

                  <a href="{{ route('backend.courses') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-file"></i>
                      <div data-i18n="Analytics">Courses</div>
                  </a>
              </li>
              <li
                  class="menu-item {{ request()->routeIs('backend.facilities') || request()->routeIs('backend.facilities.create') || request()->routeIs('backend.facilities.edit') ? 'active' : '' }}">
                  <a href="{{ route('backend.facilities') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
                      <div data-i18n="Analytics">Facilities</div>
                  </a>
              </li>
              <li
                  class="menu-item {{ request()->routeIs('backend.clinicians') || request()->routeIs('backend.clinicians.create') || request()->routeIs('backend.clinicians.edit') ? 'active' : '' }}">
                  <a href="{{ route('backend.clinicians') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
                      <div data-i18n="Analytics">Clinicians</div>
                  </a>
              </li>
          @endif
          @if (auth()->user()->hasRole('facility'))
              <li
                  class="menu-item {{ request()->routeIs('backend.payment-methods') || request()->routeIs('backend.payment-methods.create') || request()->routeIs('backend.payment-methods.edit') ? 'active' : '' }}">
                  <a href="{{ route('backend.payment-methods') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                      <div data-i18n="Analytics">Payment Methods</div>
                  </a>
              </li>
              <li
                  class="menu-item {{ request()->routeIs('backend.funds') || request()->routeIs('backend.funds.create') || request()->routeIs('backend.funds.edit') ? 'active' : '' }}">
                  <a href="{{ route('backend.funds') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                      <div data-i18n="Analytics">Funds</div>
                  </a>
              </li>
          @endif
          @if (!auth()->user()->hasRole('clinician'))
              <li
                  class="menu-item {{ request()->routeIs('backend.shifts') || request()->routeIs('backend.shifts.create') || request()->routeIs('backend.shifts.edit') ? 'active' : '' }}">
                  <a href="{{ route('backend.shifts') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-briefcase"></i>
                      <div data-i18n="Analytics">Shifts</div>
                  </a>
              </li>
          @endif
          @if (auth()->user()->hasRole('clinician'))
              <li
                  class="menu-item {{ request()->routeIs('backend.user-courses') || request()->routeIs('backend.user-courses.view') ? 'active' : '' }}">
                  <a href="{{ route('backend.shifts') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-briefcase"></i>
                      <div data-i18n="Analytics">Courses</div>
                  </a>
              </li>
          @endif
          @if (auth()->user()->hasRole('super admin'))
              <li
                  class="menu-item {{ request()->routeIs('backend.frontend-contents') || request()->routeIs('backend.frontend-contents.create') || request()->routeIs('backend.frontend-contents.edit') ? 'active' : '' }}">
                  <a href="{{ route('backend.frontend-contents') }}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-detail"></i>
                      <div data-i18n="Analytics">Frontend Contents</div>
                  </a>
              </li>
          @endif
          {{-- <li class="menu-item ">
              <a href="{{ route('backend.colors') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Colors</div>
              </a>
          </li>
          <li class="menu-item ">
              <a href="{{ route('backend.colors') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Colors</div>
              </a>
          </li>
          @foreach ($modules as $module)
              @can($module['permission'])
                  <li class="menu-item">
                      <a href="{{ isset($module['sub_menu']) ? 'javascript:void(0);' : $module['url'] }}"
                          class="menu-link {{ isset($module['sub_menu']) ? 'menu-toggle' : '' }}">
                          <i class="menu-icon {{ $module['icon'] }}"></i>
                          <div data-i18n="{{ $module['text'] }}">{{ $module['text'] }}</div>
                      </a>
                      @if (isset($module['sub_menu']))
                          <ul class="menu-sub">
                              @foreach ($module['sub_menu'] as $sub_item)
                                  <li class="menu-item">
                                      <a href="{{ $sub_item['url'] }}" class="menu-link">
                                          <div data-i18n="{{ $sub_item['text'] }}">{{ $sub_item['text'] }}</div>
                                      </a>
                                  </li>
                              @endforeach

                          </ul>
                      @endif

                  </li>
              @endcan
          @endforeach --}}
      </ul>
  </aside>
  <!-- / Menu -->

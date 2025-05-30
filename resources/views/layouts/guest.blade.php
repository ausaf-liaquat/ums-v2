<!DOCTYPE html>

<!-- beautify ignore:start -->
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/assets/') }}" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title') | Unique Med Services</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/theme-default.css') }}"
    class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/demo.css') }}" />

   <!-- Vendors CSS -->
   <link rel="stylesheet" href="{{ asset('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

   <link rel="stylesheet" href="{{ asset('assets/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

   {{-- @livewireStyles --}}
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/pages/page-auth.css') }}" />
   <!-- Page CSS -->

    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

        <style>
          .parsley-errors-list {
                 list-style: none;
                color: #ff2222;
                font-size: small;
                margin-left: -31px;
                font-weight: 800;
          }

          .form-check {
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100%;
          }

          .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
              color: #696cff;
              cursor: pointer;
              display: inline-block;
              font-weight: bold;
              margin-right: 2px;
          }

          .select2-container--default .select2-selection--multiple .select2-selection__choice {
              background-color: #fff;
              border: 1px solid #5f61e6;
              border-radius: 4px;
              cursor: default;
              float: left;
              margin-right: 5px;
              margin-top: 5px;
              padding: 0 5px;
              color: #5f61e6;
          }


          .filepond--drop-label {
              color: #4c4e53;
          }

          .filepond--label-action {
              text-decoration-color: #babdc0;
          }

          .filepond--panel-root {
              border-radius: 2em;
              background-color: #edf0f4;
              height: 1em;
          }

          .filepond--item-panel {
              background-color: #595e68;
          }

          .filepond--drip-blob {
              background-color: #7f8a9a;
          }

          .select2-container--default .select2-selection--single .select2-selection__arrow {
              height: 37px;
              position: absolute;
              top: 1px;
              right: 1px;
              width: 20px;
          }

          .select2-container .select2-selection--single {
              box-sizing: border-box;
              cursor: pointer;
              display: block;
              height: 40px;
              user-select: none;
              -webkit-user-select: none;
          }

          .select2-container--default .select2-selection--single .select2-selection__rendered {
              color: #444;
              line-height: 37px;
          }

          .select2-container--default .select2-selection--single {
              background-color: #fff;
              border: 1px solid #d3d3d3;
              border-radius: 4px;
          }
          .filepond--root {
            border:none;
          }

      </style>

@yield('css')

   <!-- Helpers -->
   <script src="{{ asset('assets/assets/vendor/js/helpers.js') }}"></script>

   <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
   <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
   <script src="{{ asset('assets/assets/js/config.js') }}"></script>
   {!! RecaptchaV3::initJs() !!}
  </head>

  <body>
    <!-- Content -->

    @yield('content')

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    {{-- @vite(['resources/sass/app-backend.scss', 'resources/js/app-backend.js']) --}}

    {{-- @livewireScripts --}}

    <script src="{{ asset('assets/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <!-- Load FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('script')

    @stack('after-scripts')
  </body>
</html>

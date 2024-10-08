<!DOCTYPE html>
<html lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('asset') }}/assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>System Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/setting') }}/{{ $setting->favicon }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />



    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/css/demo.css" />

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/css/pages/page-auth.css" />

    <script src="{{ asset('asset') }}/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          @yield('loginContent')
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <script src="{{ asset('asset') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('asset') }}/assets/vendor/js/bootstrap.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('asset') }}/assets/js/main.js"></script>

  </body>
</html>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('asset') }}/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>{{ $setting->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/setting') }}/{{ $setting->favicon }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/css/datatables.css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('asset') }}/assets/vendor/libs/apex-charts/apex-charts.css" />

     {{-- calander --}}
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Helpers -->
    <script src="{{ asset('asset') }}/assets/vendor/js/helpers.js"></script>
    <script src="{{ asset('asset') }}/assets/js/config.js"></script>


    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging.js"></script>
    <style>
        body{
            overflow-x: hidden;
        }
        .table-responsive{
            padding-bottom: 70px;
        }
    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('main.layout.sitebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('main.layout.header')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            @include('main.layout.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('sweetalert::alert')
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('asset') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('asset') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('asset') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('asset') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('asset') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('asset') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

     {{-- calander --}}
     <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('asset/assets/js/datatables.js') }}"></script>
    <script src="{{ asset('asset') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('asset') }}/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "pageLength": 25
        });
    } );
  </script>
<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "4c5e6e6b-e53a-4988-9a63-d6666360c99c",
    });
  });
</script>
{{-- <script type="module">
    // Import necessary Firebase modules
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js';
    import { getMessaging, getToken, onMessage, onBackgroundMessage } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging.js';

    // Firebase config from Firebase console
    const firebaseConfig = {
        apiKey: "AIzaSyBe03zQH1HyjnSB16CeaRSYecBLJv83p64",
        authDomain: "vipsystem-c6a35.firebaseapp.com",
        projectId: "vipsystem-c6a35",
        storageBucket: "vipsystem-c6a35.appspot.com", // Fixed storageBucket URL
        messagingSenderId: "472431567567",
        appId: "1:472431567567:web:f177ade51fdb8bca5c8dba",
        measurementId: "G-YWKTL9XKF3"
    };

    // Initialize Firebase app
    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    // Request notification permission and get device token
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            getToken(messaging, { vapidKey: 'BM1cMNNVr_IzOFuYpO-K5_VxqzrjS4V1mTMCTaVLbYV20JOrJvZ-dGyz33u-Erhl0qvcSRBwtWO3_8oBG-xzivE' })
                .then((currentToken) => {
                    if (currentToken) {
                        console.log('Device token:', currentToken);
                        // Send the token to your Laravel backend to save
                        saveDeviceToken(currentToken);
                    } else {
                        console.error('No device token available.');
                    }
                })
                .catch((err) => {
                    console.error('Error getting token:', err);
                });
        } else {
            console.error('Notification permission denied');
        }
    });

    // Save the device token to the server
    function saveDeviceToken(token) {
        // Example of sending token to the server (using Fetch API)
        fetch('/save-device-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ token: token })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Token saved successfully:', data);
        })
        .catch(error => {
            console.error('Error saving token:', error);
        });
    }

    // Handle foreground push notifications
    onMessage(messaging, (payload) => {
        console.log('Message received in foreground:', payload);
        // Customize the notification for the foreground
        new Notification(payload.notification.title, {
            body: payload.notification.body,
            icon: payload.notification.icon
        });
    });

    // Handle background push notifications
    onBackgroundMessage(messaging, (payload) => {
        console.log('Background message received:', payload);
        self.registration.showNotification(payload.notification.title, {
            body: payload.notification.body,
            icon: payload.notification.icon
        });
    });
</script> --}}


    @yield('footer_content')
  </body>
</html>

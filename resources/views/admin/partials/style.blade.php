 @vite(['resources/css/app.css', 'resources/js/app.js'])
 <!--     Fonts and icons     -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
 <!-- Nucleo Icons -->
 <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
 <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
 <!-- Font Awesome Icons -->
 <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
     integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css"
     integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

 <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
     rel="stylesheet">
 <!-- Select2 CSS (ADD HERE IN HEAD) -->
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 <!-- CSS Files -->
 <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
 <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css.map') }}">
 <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.min.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
 {{-- <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}"> --}}

 {{-- @if (session('toast'))
     <script>
         window.__toast = @json(session('toast'));
     </script>
 @endif --}}
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}

 <style>
     /* .action-btn {
         padding: 0.25rem 0.5rem;
         font-size: 0.875rem;
     }

     .form-select {
         height: 40px;
     }

     .alert-light {
         background-color: #f8f9fa;
         border-color: #e9ecef;
     } */
 </style>
 <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
 @stack('styles')

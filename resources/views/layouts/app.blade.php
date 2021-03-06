<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <link rel="shortcut icon" type="image/jpg" href="{{ asset('assets/img/logo/logo2.png') }}"/>

    <title>@yield('title')</title>

    <!-- vendor css -->
    <!-- jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script> -->

    
    <script src="{{ asset('azia/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('azia/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet"/>

    <link href="{{ asset('azia/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('azia/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('azia/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('azia/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('azia/lib/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{ asset('assets/DataTables/datatables.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>

    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('azia/css/azia.css') }}">


    @yield('css')

  </head>
  <body>
    @include('layouts.navbar')

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          @yield('content')
        </div>
      </div>
    </div>

    @include('layouts.footer')


    <script src="{{ asset('azia/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('azia/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('azia/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('azia/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('azia/lib/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('azia/lib/select2/js/select2.min.js') }}"></script>
    <!-- <script src="{{ asset('azia/lib/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script> -->

    <script src="{{ asset('azia/js/azia.js') }}"></script>
    <script src="{{ asset('azia/js/chart.flot.sampledata.js') }}"></script>
    <script src="{{ asset('azia/js/dashboard.sampledata.js') }}"></script>
    <!-- <script src="{{ asset('azia/js/jquery.cookie.js') }}"></script> -->

    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script>
      tinymce.init({
        selector: 'textarea.descJob',
        height: 400,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount',
          'fullscreen'
        ],
        toolbar: 'undo redo | formatselect | ' +
          'bold italic backcolor | alignleft aligncenter ' +
          'alignright alignjustify | bullist numlist outdent indent | ' +
          'removeformat | help fullscreen',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });

    </script>
    
    @yield('js')

  </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- header start -->
    @include('layouts.head')
    <!-- header end -->

    <style>
        #wrapper {
            overflow: auto !important;
        }
    </style>
</head>

<body class="loading" data-sidebar-icon="twotones">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('layouts.header')
        <!-- Topbar end -->

        <!-- ========== Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!-- sidebar start -->
                @include('layouts.sidebar')
                <!-- sidebar end -->

                <div class="clearfix"></div>

            </div>

        </div>
        <!-- ========== Sidebar End ========== -->

        <!-- select2 dropdown -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
        <script>
            $(document).ready(function() {
                // Select2 Multiple
                $('.select2-multiple').select2({
                   // placeholder: "Select",
                    allowClear: true
                });
            });
        </script>
        <div class="content-page">
            <div class="content">
            <input type="hidden" name="base_url" id="base_url" value="{{URL::to('/')}}">
                <!-- content start -->
                @yield('content')
                <!-- content end -->
            </div>

            <!-- footer start -->
            @include('layouts.footer')
            <!-- footer end -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- select2 dropdown -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                allowClear: true
            });

            //search toggle
            $('.search-button').click(function(){
                $('.search-form').fadeToggle('slow','swing');
                return false;
            });

        });
    </script>
    <!-- select2 dropdown -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{asset('/assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('/assets/js/app.min.js')}}"></script>

    <!-- Bootstrap Tables js -->
    <script src="{{asset('/assets/libs/bootstrap-table/bootstrap-table.min.js')}}"></script>

    <!-- Init js -->
    <script src="{{asset('/assets/js/pages/bootstrap-tables.init.js')}}"></script>


    <!-- icons -->
    <link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />


    <!-- for validation -->
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/comman.js') }}" defer></script>
        <!-- only number with dot allowed -->
        <script type="text/javascript">
            $('.number').keypress(function(event) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
                    ((event.which < 48 || event.which > 57) &&
                        (event.which != 0 && event.which != 8))) {
                    event.preventDefault();
                }

                var text = $(this).val();

                if ((text.indexOf('.') != -1) &&
                    (text.substring(text.indexOf('.')).length > 5) &&
                    (event.which != 0 && event.which != 8) &&
                    ($(this)[0].selectionStart >= text.length - 5)) {
                    event.preventDefault();
                }
            });
            function onlyNumberKey(evt) {

                // Only ASCII character in that range allowed
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                    return false;
                return true;
            }
        </script>
</body>

</html>


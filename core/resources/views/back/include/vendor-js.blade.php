<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/backend/js/sb-admin-2.min.js') }}"></script>

<script src="{{ asset('assets/backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/jv/dist/jquery.validate.js') }}"></script>
<script src='{{ asset("assets/fullcalendar/lib/main.js") }}'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function myBlock(){
        $.blockUI({ css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });
    }
</script>

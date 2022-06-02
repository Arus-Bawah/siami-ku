<!-- Core JS files -->
<script src="{{asset('global_assets/js/main/jquery.min.js')}}"></script>
<script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
<!-- /core JS files -->

<script src="{{asset('global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{url('assets/js/jquery-sortable-min.js')}}"></script>
<script src="{{asset('global_assets/js/demo_pages/dashboard.js')}}"></script>
<script src="{{asset('global_assets/js/demo_pages/form_layouts.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/forms/styling/switch.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.flatpickr').flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
    function doDelete(link) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                }
            });
    }
</script>

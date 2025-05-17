<script src="{{asset('../asset/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('../asset/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('../asset/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('../asset/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('../asset/js/sidebarmenu.js')}}"></script>
<script src="{{asset('../asset/js/app.min.js')}}"></script>
<script src="{{asset('../asset/js/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#jobCategory').select2({
            placeholder: "Search for job categories",
            allowClear: true,
            width: '75%',
            minimumResultsForSearch: 0, 
            dropdownParent: $('#jobCategory').parent(),
            ajax: {
                url: "{{ route('job-categories.search') }}", 
                delay: 250, 
                data: function (params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function (data) {
                    
                    return {
                        results: data, 
                    };
                },
                cache: true, 
            },
           
            maximumSelectionLength:1 
        });
        // $('#province').select2({
        //     placeholder: "Search Province",
        //     allowClear: true,
        //     width: '75%',
        //     minimumResultsForSearch: 0, 
        //     dropdownParent: $('#province').parent(),
        //     ajax: {
        //         url: "{{ route('showProvince') }}", 
        //         delay: 250, 
        //         data: function (params) {
        //             return {
        //                 q: params.term,
        //             };
        //         },
        //         processResults: function (data) {
                    
        //             return {
        //                 results: data, 
        //             };
        //         },
        //         cache: true, 
        //     },
           
        //     maximumSelectionLength:1 
        // });
        
       
    });
</script>
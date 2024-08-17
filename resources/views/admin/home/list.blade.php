@extends('admin.layout.index')

@section('content')
<div class="container-fluid py-4">
    <!-- Sales -->
    @include('admin.home.sales')
    <!-- Chart -->
    @include('admin.home.chart')
    <!-- Sales By movie -->
    @include('admin.home.revenue')

</div>

<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Morris.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<!-- jQuery (necessary for Morris.js and AJAX calls) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Raphael.js (required for Morris.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<!-- Morris.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        flatpickr($("#end_time"), {
            maxDate: "today",
            dateFormat: "Y-m-d",
            locale: "@lang('lang.language')"
        });
        
        var start_time = flatpickr($("#start_time"), {
            maxDate: "today",
            dateFormat: "Y-m-d",
            locale: "@lang('lang.language')"
        });
        
        $('#end_time').on("change", function() {
            start_time.set('maxDate', $('#end_time').val());
        });

        var chart = new Morris.Bar({
            element: 'admin_chart',
            barColors: ['#09b1f3', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
            parseTime: false,
            hideHover: 'auto',
            data: [],
            xkey: 'date',
            ykeys: ['total'],
            labels: ['Total']
        });

        $('#btn-statistical-filter').click(function() {
            var from_date = $('#start_time').val();
            var to_date = $('#end_time').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('admin/filter-by-date') }}",
                method: "GET",
                datatype: "JSON",
                data: {
                    from_date: from_date,
                    to_date: to_date
                },
                success: function(data) {
                    $('#admin_chart').empty();
                    chart = new Morris.Bar({
                        element: 'admin_chart',
                        barColors: ['#09b1f3', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                        parseTime: false,
                        hideHover: 'auto',
                        data: data.chart_data,
                        xkey: 'date',
                        ykeys: ['total'],
                        labels: ['Total']
                    });
                },
                error: function(xhr) {
                    alert('An error occurred while fetching data.');
                }
            });
        });
    });



    $('.statistical-filter').change(function() {
            var statistical_value = $(this).val();
            if (statistical_value === "null") {
                chart.setData([{
                    date: null,
                    total: null,
                    seat_count: null
                }]);
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "admin/statistical-filter",
                method: "GET",
                datatype: "JSON",
                data: {
                    'statistical_value': statistical_value,
                },
                success: function(data) {
                    $('#admin_chart').empty();
                    chart = new Morris.Bar({
                        element: 'admin_chart',
                        barColors: ['#09b1f3', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                        parseTime: false,
                        hideHover: 'auto',
                        data: [{
                            date: null,
                            total: null
                        }],
                        xkey: 'date',
                        ykeys: ['total'],
                        labels: ['total']
                    });
                    if (data['success']) {
                        chart.setData(data.chart_data);
                    } else if (data['error']) {
                        alert(data.error);
                    }
                }
            });
        });

          //statistical sortby
          $('.statistical-sortby').change(function() {
            var statistical_value = $(this).val();
            if (statistical_value === "null") {
                chart.setData([{
                    date: null,
                    seat_count: null
                }]);
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "admin/statistical-sortby",
                method: "GET",
                datatype: "JSON",
                data: {
                    'statistical_value': statistical_value,
                },
                success: function(data) {
                    $('#admin_chart').empty();
                    if (statistical_value == 'ticket') {
                        chart = new Morris.Bar({
                            element: 'admin_chart',
                            barColors: ['#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                            parseTime: false,
                            hideHover: 'auto',
                            data: [{
                                date: null,
                                seat_count: null
                            }],
                            xkey: 'date',
                            ykeys: ['seat_count'],
                            labels: ['seat_count']
                        });
                        if (data['success']) {
                            chart.setData(data.chart_data);
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    } else if (statistical_value == 'theater') {
                        chart = new Morris.Bar({
                            element: 'admin_chart',
                            barColors: ['#fc8710', '#2dce89', '#A4ADD3', '#766B56'],
                            parseTime: false,
                            hideHover: 'auto',

                            data: [{
                                date: null,
                                '1': null,
                                '2': null,
                                '3': null
                            }],
                            xkey: 'date',
                            ykeys: ['1', '2', '3'],
                            labels: ['Rạp Cao Lỗ', 'Rạp Hồ Gươm', 'Rạp VinCom Đà Nẵng']
                        });
                        if (data['success']) {
                            chart.setData(data.chart_data);
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                }
            });
        });
</script>


@endsection

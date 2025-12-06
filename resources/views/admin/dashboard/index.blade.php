@extends('admin.layouts.app')
@section('title', $title)
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @include('admin.dashboard.details.date')
        </div>
        <div class="row" id="sortable-4">

            {{-- @include('admin.dashboard.details.chart') --}}
            {{-- @include('admin.dashboard.details.menus') --}}
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('/admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/custom/charts_functions.js') }}"></script>
    {{-- <script>
        function timeJS() {
            const d = new Date();
            const local = d.getTime();
            const offset = d.getTimezoneOffset() * (60 * 1000);
            const utc = new Date(local + offset);
            const date = new Date(utc.getTime() + (3 * 60 * 60 * 1000));
            const options = {
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true,
            };
            const time = date.toLocaleTimeString('{{ defaultLang() == 'ar' ? 'ar-SA' : 'en-US' }}', options);
            $('.dashboard-clock-now').text(time);
        }

        timeJS();
        setInterval(function() {
            timeJS()
        }, 1000);

        var optionsWarehouses = {
            series: [
                // {
                //     name: '{{ __('admin.tasks_TODO') }}',
                //     data: @json($tasks_TODO)
                // },
                // {
                //     name: '{{ __('admin.tasks_IN_PROGRESS') }}',
                //     data: @json($tasks_IN_PROGRESS)
                // },
                // {
                //     name: '{{ __('admin.tasks_DONE') }}',
                //     data: @json($tasks_DONE)
                // }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: [
                    '{{ __('admin.January') }}',
                    '{{ __('admin.February') }}',
                    '{{ __('admin.March') }}',
                    '{{ __('admin.April') }}',
                    '{{ __('admin.May') }}',
                    '{{ __('admin.June') }}',
                    '{{ __('admin.July') }}',
                    '{{ __('admin.August') }}',
                    '{{ __('admin.September') }}',
                    '{{ __('admin.October') }}',
                    '{{ __('admin.November') }}',
                    '{{ __('admin.December') }}'
                ]
            }
        };

        var chartWarehouses = new ApexCharts(document.querySelector("#warehouses-chart"), optionsWarehouses);
        chartWarehouses.render();

        var warehousesStatisticsChartOptions = {
            chart: {
                height: 270,
                type: 'line',
            },
            series: [{
                name: "{{ __('admin.warehouses_total_monthly') }}",
                data: @json($usersStatistics)
            }]
        };

        var warehousesStatisticsChart = new ApexCharts(document.querySelector("#warehouses-statistics-chart"),
            warehousesStatisticsChartOptions);
        warehousesStatisticsChart.render();
    </script> --}}
@endsection

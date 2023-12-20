@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Charts /</span> Chart.js
        </h4>

        <div class="row">


            <!-- Line Charts -->
            @foreach ($surveys as $survey)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header header-elements">
                            <div>
                                <h5 class="card-title mb-0">Statistics</h5>
                                <small class="text-muted">Commercial networks and enterprises</small>
                            </div>
                            <div class="card-header-elements ms-auto py-0">
                                <h5 class="mb-0 me-3">$ 78,000</h5>
                                <span class="badge bg-label-secondary">
                                    <i class='ti ti-arrow-up ti-xs text-success'></i>
                                    <span class="align-middle">37%</span>
                                </span>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <canvas id="lineChart{{$survey->id}}" class="chartjs" data-height="500"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- /Line Charts -->


            <!-- /Scatter Chart -->
        </div>

    </div>
@endsection

@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
@endsection


@section('script')
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/chartjs/chartjs.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>


    <!-- Page JS -->
    <script src="../../assets/js/charts-chartjs.js"></script>
@endsection

@section('after_script')
    <script>
        // Color Variables
        const purpleColor = '#836AF9',
            yellowColor = '#ffe800',
            cyanColor = '#28dac6',
            orangeColor = '#FF8132',
            orangeLightColor = '#FDAC34',
            oceanBlueColor = '#299AFF',
            greyColor = '#4F5D70',
            greyLightColor = '#EDF1F4',
            blueColor = '#2B9AFF',
            blueLightColor = '#84D0FF';
        var configX = {
            colors: {
                primary: "#7367f0",
                secondary: "#a8aaae",
                success: "#28c76f",
                info: "#00cfe8",
                warning: "#ff9f43",
                danger: "#ea5455",
                dark: "#4b4b4b",
                black: "#000",
                white: "#fff",
                cardColor: "#fff",
                bodyBg: "#f8f7fa",
                bodyColor: "#6f6b7d",
                headingColor: "#5d596c",
                textMuted: "#a5a3ae",
                borderColor: "#dbdade"
            }
        };

        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = config.colors.borderColor;
    </script>
    @foreach ($surveys as $survey)
        <script>
            const lineChart{{$survey->id}} = document.getElementById('lineChart{{$survey->id}}');
            if (lineChart{{$survey->id}}) {
                const lineChart{{$survey->id}}Var = new Chart(lineChart{{$survey->id}}, {
                    type: 'line',
                    data: {
                        labels: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140],
                        datasets: [{
                                data: [80, 150, 180, 270, 210, 160, 160, 202, 265, 210, 270, 255, 290, 360, 375],
                                label: 'Listrik Saya',
                                borderColor: configX.colors.danger,
                                tension: 0.5,
                                pointStyle: 'circle',
                                backgroundColor: configX.colors.danger,
                                fill: false,
                                pointRadius: 1,
                                pointHoverRadius: 5,
                                pointHoverBorderWidth: 5,
                                pointBorderColor: 'transparent',
                                pointHoverBorderColor: cardColor,
                                pointHoverBackgroundColor: configX.colors.danger
                            },
                            {
                                data: [80, 125, 105, 130, 215, 195, 140, 160, 230, 300, 220, 170, 210, 200, 280],
                                label: 'Rekomenasi Pelaratan Listrik',
                                borderColor: configX.colors.primary,
                                tension: 0.5,
                                pointStyle: 'circle',
                                backgroundColor: configX.colors.primary,
                                fill: false,
                                pointRadius: 1,
                                pointHoverRadius: 5,
                                pointHoverBorderWidth: 5,
                                pointBorderColor: 'transparent',
                                pointHoverBorderColor: cardColor,
                                pointHoverBackgroundColor: configX.colors.primary
                            },

                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                },
                                ticks: {
                                    color: labelColor
                                }
                            },
                            y: {
                                scaleLabel: {
                                    display: true
                                },
                                min: 0,
                                max: 400,
                                ticks: {
                                    color: labelColor,
                                    stepSize: 100
                                },
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                // Updated default tooltip UI
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            },
                            legend: {
                                position: 'top',
                                align: 'start',
                                rtl: isRtl,
                                labels: {
                                    usePointStyle: true,
                                    padding: 35,
                                    boxWidth: 6,
                                    boxHeight: 6,
                                    color: legendColor
                                }
                            }
                        }
                    }
                });
            }
        </script>
    @endforeach
@endsection

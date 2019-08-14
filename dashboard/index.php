<?php
include("auth.php");
include("header.php");
include("functions.php");
?>


<body class="az-body az-body-sidebar az-body-dashboard-nine">
    <?php include("sidebarmenu.php");?>
    <div class="az-content az-content-dashboard-nine">
        <?php include("defaultcontent.php");?>
        <div class="az-content-body">
            <div class="row row-sm">
                <div class="col-sm-6 col-xl-3">
                    <div class="card card-dashboard-twentytwo">
                        <div class="media">
                            <div class="media-icon bg-purple"><i class="typcn typcn-chart-line-outline"></i></div>
                            <div class="media-body">
                                <h6><?php echo $total_users;?></h6>
                                <span>Doctor</span>
                            </div>
                        </div>
                        <!--<div class="chart-wrapper">
                <div id="flotChart1" class="flot-chart"></div>
              </div> chart-wrapper -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                    <div class="card card-dashboard-twentytwo">
                        <div class="media">
                            <div class="media-icon bg-primary"><i class="typcn typcn-chart-line-outline"></i></div>
                            <div class="media-body">
                                <h6><?php echo $total_patients;?></h6>
                                <span>Patients</span>
                            </div>
                        </div>
                        <!--<div class="chart-wrapper">
                <div id="flotChart2" class="flot-chart"></div>
              </div> chart-wrapper -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card card-dashboard-twentytwo">
                        <div class="media">
                            <div class="media-icon bg-pink"><i class="typcn typcn-chart-line-outline"></i></div>
                            <div class="media-body">
                                <h6><?php echo $total_symptoms;?> </h6>
                                <span>Symtoms added</span>
                            </div>
                        </div>
                        <!--<div class="chart-wrapper">
                <div id="flotChart3" class="flot-chart"></div>
              </div> chart-wrapper -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card card-dashboard-twentytwo">
                        <div class="media">
                            <div class="media-icon bg-teal"><i class="typcn typcn-chart-line-outline"></i></div>
                            <div class="media-body">
                                <h6><?php echo $total_medicines;?>
                                    <!--<small class="up">+0.8%</small>-->
                                </h6>
                                <span>Verified Medicines</span>
                            </div>
                        </div>
                        <!--<div class="chart-wrapper">
                <div id="flotChart4" class="flot-chart"></div>
              </div> chart-wrapper -->
                    </div><!-- card -->
                </div><!-- col -->
                <!--this is the place where we would place metrics-->
            </div><!-- row -->
        </div><!-- az-content-body -->
        <div class="az-footer">
            <div class="container-fluid">
                <span>&copy; 2018 Azia Responsive Bootstrap 4 Dashboard Template</span>
                <span>Designed by: ThemePixels</span>
            </div><!-- container -->
        </div><!-- az-footer -->
    </div><!-- az-content -->


    <script src="../old/lib/jquery/jquery.min.js"></script>
    <script src="../old/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../old/lib/ionicons/ionicons.js"></script>
    <script src="../old/lib/jquery.flot/jquery.flot.js"></script>
    <script src="../old/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../old/lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../old/lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="../old/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../old/js/azia.js"></script>
    <script src="../old/js/dashboard.sampledata.js"></script>
    <script>
    $(function() {
        'use strict'

        $('.az-sidebar .with-sub').on('click', function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('show');
            $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e) {
            e.stopPropagation();

            // closing of sidebar menu when clicking outside of it
            if (!$(e.target).closest('.az-header-menu-icon').length) {
                var sidebarTarg = $(e.target).closest('.az-sidebar').length;
                if (!sidebarTarg) {
                    $('body').removeClass('az-sidebar-show');
                }
            }
        });


        $('#azSidebarToggle').on('click', function(e) {
            e.preventDefault();

            if (window.matchMedia('(min-width: 992px)').matches) {
                $('body').toggleClass('az-sidebar-hide');
            } else {
                $('body').toggleClass('az-sidebar-show');
            }
        });

        new PerfectScrollbar('.az-sidebar-body', {
            suppressScrollX: true
        });

        /* ----------------------------------- */
        /* Dashboard content */


        $.plot('#flotChart1', [{
            data: dashData1,
            color: '#6f42c1'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0
                        }, {
                            opacity: 1
                        }]
                    }
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 0
            },
            yaxis: {
                show: false,
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        });

        $.plot('#flotChart2', [{
            data: dashData2,
            color: '#007bff'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0
                        }, {
                            opacity: 1
                        }]
                    }
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 0
            },
            yaxis: {
                show: false,
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        });

        $.plot('#flotChart3', [{
            data: dashData3,
            color: '#f10075'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0
                        }, {
                            opacity: 1
                        }]
                    }
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 0
            },
            yaxis: {
                show: false,
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        });

        $.plot('#flotChart4', [{
            data: dashData4,
            color: '#00cccc'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0
                        }, {
                            opacity: 1
                        }]
                    }
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 0
            },
            yaxis: {
                show: false,
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        });

        $.plot('#flotChart5', [{
            data: dashData2,
            color: '#00cccc'
        }, {
            data: dashData3,
            color: '#007bff'
        }, {
            data: dashData4,
            color: '#f10075'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: false,
                    fillColor: {
                        colors: [{
                            opacity: 0
                        }, {
                            opacity: 1
                        }]
                    }
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 20
            },
            yaxis: {
                show: false,
                min: 0,
                max: 100
            },
            xaxis: {
                show: true,
                color: 'rgba(0,0,0,.16)',
                ticks: [
                    [0, ''],
                    [10, '<span>Nov</span><span>05</span>'],
                    [20, '<span>Nov</span><span>10</span>'],
                    [30, '<span>Nov</span><span>15</span>'],
                    [40, '<span>Nov</span><span>18</span>'],
                    [50, '<span>Nov</span><span>22</span>'],
                    [60, '<span>Nov</span><span>26</span>'],
                    [70, '<span>Nov</span><span>30</span>'],
                ]
            }
        });

        $.plot('#flotChart6', [{
            data: dashData2,
            color: '#6f42c1'
        }, {
            data: dashData3,
            color: '#007bff'
        }, {
            data: dashData4,
            color: '#00cccc'
        }], {
            series: {
                shadowSize: 0,
                stack: true,
                bars: {
                    show: true,
                    lineWidth: 0,
                    fill: 0.85
                    //fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 20
            },
            yaxis: {
                show: false,
                min: 0,
                max: 100
            },
            xaxis: {
                show: true,
                color: 'rgba(0,0,0,.16)',
                ticks: [
                    [0, ''],
                    [10, '<span>Nov</span><span>05</span>'],
                    [20, '<span>Nov</span><span>10</span>'],
                    [30, '<span>Nov</span><span>15</span>'],
                    [40, '<span>Nov</span><span>18</span>'],
                    [50, '<span>Nov</span><span>22</span>'],
                    [60, '<span>Nov</span><span>26</span>'],
                    [70, '<span>Nov</span><span>30</span>'],
                ]
            }
        });

        $('#vmap').vectorMap({
            map: 'world_en',
            showTooltip: true,
            backgroundColor: '#f8f9fa',
            color: '#ced4da',
            colors: {
                us: '#6610f2',
                gb: '#8b4bf3',
                ru: '#aa7df3',
                cn: '#c8aef4',
                au: '#dfd3f2'
            },
            hoverColor: '#222',
            enableZoom: false,
            borderOpacity: .3,
            borderWidth: 3,
            borderColor: '#fff',
            hoverOpacity: .85
        });

    });
    </script>
</body>

</html>
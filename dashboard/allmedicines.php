<?php
include("auth.php");
include("header.php");
include("functions.php");
?>

<body class="az-body az-body-sidebar az-body-dashboard-nine">

    <?php include("sidebarmenu.php");?>

    <div class="az-content az-content-dashboard-nine">
        <?php include("defaultcontent.php");?>
        <div class="az-content">
            <div class="container">
                <div class="az-content-body">
                    <div class="az-content-breadcrumb">
                        <span>Medicines</span>
                        <span>ALL Medicines</span>
                    </div>
                    <br />
                    <div style="float:right;"><a href="" data-toggle="modal" data-target="#modaldemoadd"><button
                                class="btn btn-success btn-with-icon"><i class="typcn typcn-document-add"></i> Add
                                new</button></a></div>
                    <div class="az-content-label mg-b-5">ALL Medicines</div>

                    <br />
                    <table id="datatable1" class="display responsive nowrap">
                        <thead>
                            <tr>


                                <th class="wd-5p">ID</th>
                                <th class="wd-10p">Name</th>
                                <th class="wd-10p">Short Form</th>
                                <th class="wd-10p">Chapter</th>
                                <th class="wd-10p">Source</th>
                                <th class="wd-10p">Type</th>
                                <th class="wd-10p">Anti DOT</th>

                                <th class="wd-10p">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php showmedicine($con,$role);?>

                        </tbody>
                    </table>
                    <div class="mg-lg-b-30"></div>
                    <center>
                    <div id="modaldemoadd" class="modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Add New Medicine</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="medname" required>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medshort"
                                                    placeholder="Medicine Short Form" required>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medchap"
                                                    placeholder="Chapter" required>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medsubchap"
                                                    placeholder="Sub Chapter">
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medsource"
                                                    placeholder="Source" required>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medprov"
                                                    placeholder="Prover">
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medtype"
                                                    placeholder="Type" required>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <textarea class="form-control" name="medagam"
                                                    placeholder="Ag/Am"></textarea>
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medsupp"
                                                    placeholder="Supplement">
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medresupp"
                                                    placeholder="Re Supplement">
                                            </div><!-- form-group -->

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="medprohi"
                                                    placeholder="Prohibition">
                                            </div><!-- form-group -->

                                            <div class="form-group antiadd">
                                                    <select class="form-control select2" name="antidot[]">
                                                    <option value="" selected>Antidot</option>
                                                        <?php getrelated($con);?>
                                                    </select>
                                                    <div style="clear:both"></div>
                                                </div><!-- form-group -->
                                                
                                                <button class="addantibtn btn btn-success btn-icon"><i
                                                        class="typcn typcn-document-add"></i></button>
                                                        
                                                <br />

                                            <button name="addmed" class="btn btn-az-primary pd-x-20">Add</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->
                </center>
                </div><!-- az-content-body -->
            </div>
        </div><!-- az-content -->

        <div class="az-footer">
            <div class="container">
                <span>&copy; 2018 Azia Responsive Bootstrap 4 Dashboard Template</span>
                <span>Designed by: ThemePixels</span>
            </div><!-- container -->
        </div><!-- az-footer -->

        <script src="../old/lib/jquery/jquery.min.js"></script>
        <script src="../old/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../old/lib/ionicons/ionicons.js"></script>
        <script src="../old/lib/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../old/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
        <script src="../old/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../old/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
        <script src="../old/lib/select2/js/select2.min.js"></script>

        <script src="../old/js/azia.js"></script>

        <script>
        var i = 1;
        $(".addantibtn").click(function(e) {
            e.preventDefault();
            $("<div />", {
                    "class": "add13",
                    id: "input" + i
                })
                .append($('<select id="name' + i +
                    '" class="form-control select2" name="antidot[]"><option value="" selected>Select one</option><?php getrelated($con);?></select>'
                )).append($('<a href="#" class="remove_field_anti"><i class="fa fa-times"></a>'))

                .appendTo(".antiadd");
            i++;

            $('.remove_field_anti').click(function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            })

        });


        </script>

        <script>
        $(document).ready(function() {
            'use strict';

            $('#datatable1').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            $('#datatable2').DataTable({
                bLengthChange: false,
                searching: false,
                responsive: true
            });

            // Select2
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

        });
        </script>
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
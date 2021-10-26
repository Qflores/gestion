<!-- page content -->
<div class="" id="app">
    <div class="page-title" style="height: 37PX;">
        <div class="">
            <h5>
                GRAFÍCOS ESTADÍSTICOS 
                <small>
                    VENTAS, COMPRAS, Y OTROS MOVIMIENTOS
                </small>
            </h5>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        VENTAS Y COMPRAS
                        <small>
                            HISTOGRAMA
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <canvas id="lineChart">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        VENTAS Y COMPRAS
                        <small>
                            HISTOGRAMA
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <canvas id="mybarChart">
                    </canvas>
                </div>
            </div>
        </div>
    </div>

     <div class="clearfix"> </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Productos con mas movimiento
                        <small>
                            año 2021
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content" >
                    <canvas id="labelsline" height="100vh%">
                    </canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        PRODUCTOS CON MAYOR GANANCIA
                        <small>
                            HISTORIA
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <canvas id="canvasRadar">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        PRODUTO MAS VENDIDOS POR CATEGORÍA
                        <small>
                            HISTORIA
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <canvas id="canvasDoughnut">
                    </canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"> </div>
    
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Pie Graph Chart
                        <small>
                            Sessions
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>                        
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <canvas id="pieChart">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        Pie Area Graph
                        <small>
                            Sessions
                        </small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <canvas id="polarArea">
                    </canvas>
                </div>
            </div>
        </div>        
    </div>

</div>
<!-- page content -->
<!-- Chart.js -->
<!-- <script src="assets/Chart.js/dist/Chart.min.js"></script> -->
<script src="assets/chartjs/dist/Chart.min.js"></script>

<script type="text/javascript">

    if ($('#labelsline').length) {
        var ctx = document.getElementById("labelsline");
        var labelsline = new Chart(ctx, {
            type: 'line',
            data:{
                labels: ["Enero","Febrero","Marzo","Abríl","Mayo","Junio","Julio","Agosto","Septiembre","Octubre"],
                datasets: [
                    {
                      label: 'D0',
                      data: [2,5,8,6,5,1,6,2,6,3],
                      borderColor: "rgba(241, 13, 54, 1)",
                      pointColor: "#da3e2f", 
                      backgroundColor: "rgba(255,255, 255, .2)",
                      hidden: false,
                      tension: 0.4,
                      fill:'origin'                      
                    },
                    {
                      label: 'D1',
                      data: [11,12,10,13,15,11,13,10,13,15],
                      borderColor: "rgba(255, 106, 0, 1)",
                      pointColor: "#da3e2f", 
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: '-1'
                    },
                    {
                      label: 'D2',
                      data: [15,17,18,16,19,17,14,17,18,16],
                      borderColor: "rgba(253, 209, 1, 1)",
                      backgroundColor: "rgba(4, 250, 46, 0.3)",
                      fill: {
                        target: {value: 17},
                        above: 'rgba(20, 12, 242, .8)', 
                        below: 'rgba(255, 0, 0, .7)', 
                      },
                      hidden: false,
                      tension: 0.4,
                    },
                    {
                      label: 'D3',
                      data: [19,20,22,18,22,19,23,23,22,18],
                      borderColor: "rgba(0, 168, 33, 1)",
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: '-1'
                    },
                    {
                      label: 'D4',
                      data: [21,22,20,23,21,22,26,20,23,21],
                      borderColor: "rgba(1, 108, 253, 1)",
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: '-1'
                    },
                    {
                      label: 'D5',
                      data: [27,28,27,29,25,27,29,28,27,29],
                      borderColor: "rgba(115, 63, 0, 1)",
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: '+2'
                    },
                    {
                      label: 'D6',
                      data: [31,32,30,33,35,31,33,32,30,33,],
                      borderColor: "rgba(178, 0, 255, 1)",
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: false
                    },
                    {
                      label: 'D7',
                      data: [48,42,40,43,45,41,43,42,40,43],
                      borderColor: "rgba(255, 0, 39, 1)",
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: 40
                    },
                    {
                      label: 'D8',
                      data: [51,52,50,53,55,51,53,52,50,53],
                      borderColor: "rgba(161, 127, 255, 1)",
                      backgroundColor: "rgba(255, 255, 255, .0)",
                      tension: 0.4,
                      fill: 'end',
                      hidden: false
                    },
                    {
                      label: 'D9',
                      data: [69,62,60,63,68,61,63,72,60,63],
                      borderColor: "rgba(0, 137, 255, 1)",
                      backgroundColor: "rgba(192, 192, 192, .0)",
                      tension: 0.4,
                      fill: {
                        target: {value: 65},
                        above: 'rgba(20, 12, 242, .8)', 
                        below: 'rgba(255, 0, 0, .7)', 
                      }
                    }
                ],
            },
            options: {
                legend:{
                    display:true,
                    labels:{
                        fondcolor: '#000',
                        boxWidth: 15

                    }
                },
                plugins: {
                  filler: {
                    propagate: true
                  },
                  'samples-filler-analyser': {
                    target: 'chart-analyser'
                  },
                  title:{
                    display: true,
                    text: 'Productos Mas Vendidos'
                  }
                },                
                interaction: {
                  intersect: false,
                },
            },
        });
    }



    // Line chart
    // rgba(38, 185, 154, 0.9)
    // rgba(0, 148, 255, 0.2)
    // linear-gradient(180deg, rgba(3,228,83,1) 0%, rgba(1,125,48,0.96) 45%, rgba(0,110,60,0.97) 100%);

    if ($('#lineChart').length) {

        var ctx = document.getElementById("lineChart");
        var lineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"],
                datasets: [
                {
                    label: 'Ventas',
                    type: 'bar',
                    data: [45, 84, 65, 78, 40, 34, 55],                    
                    backgroundColor: 'rgba(255, 0, 144, .20)',
                    borderColor: "rgba(255, 127, 127, 1)",
                    borderWidth: 2,
                },
                {
                    label: "Compras",
                    data: [31, 64, 45, 60, 30, 25, 45],
                    backgroundColor: "rgba(0, 148, 255, 0.2)",
                    borderColor: "rgba(38, 185, 154, 0.9)",
                    borderWidth: 2,
                    
                }, {
                    label: "Promedio",
                    type: 'line',
                    data: [38, 74, 55, 69, 35, 29.5, 50],
                    borderColor: "rgba(5, 183, 249, 1)",
                    borderWidth: 3,
                    backgroundColor: "rgba(3, 88, 106, 0.2)",
                    fill:true,
                    tension: 0.4
                    
                }
                
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontColor: '#14E',
                            boxWidth: 10
                        }
                    },
                    title: {
                        display: true,
                        text: 'Gráfica de ventas/compras por mes',                    
                    },
                },
                scales: {
                    x: [{
                            barPercentage: .8,
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#F01'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(0, 148, 255, .4)"
                            }
                        }],
                    y: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#02F'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(0, 148, 255, 0.5)"
                            }
                        }]
                }

                }
        });

    }


    // Bar chart

    if ($('#mybarChart').length) {

        var ctx = document.getElementById("mybarChart");
        var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado","Domingo"],
                datasets: [
                {
                    label: 'Ventas',
                    data: [55, 70, 22, 80, 90, 60, 40],
                    borderColor: "rgba(18, 201, 0, 1)",
                    borderWidth: 3,
                    backgroundColor: "rgba(18, 201, 0, 0.3)",
                    
                },
                {
                    label: 'Compras',
                    data: [40, 50, 42, 60, 65, 45, 25],
                    borderColor: "rgba(255, 106, 0, 0.9)",
                    borderWidth: 3,
                    backgroundColor: "rgba(255, 106, 0, 0.3)",
                },
                {
                    label: 'Promedio',
                    type: 'line',
                    data: [47, 60, 31, 70, 75, 53, 33],
                    borderColor: "rgba(3, 88, 106, 0.9)",
                    borderWidth: 3,
                    backgroundColor: 'rgba(3, 88, 106, 0.2)',
                    tension: 0.4,
                    fill: true,
                }
                

                ]
            },

            options: { 
                responsive: true,
                    plugins: {
                        legend: {
                        position: 'top',
                        labels: {
                            fontColor: '#14E',
                            boxWidth: 10
                        }
                    },
                    title: {
                        display: true,
                        text: 'Gráfica de ventas/compras por semana',                    
                    },
                }               
            }
        });

    }


    // Doughnut chart

    if ($('#canvasDoughnut').length) {

        var ctx = document.getElementById("canvasDoughnut");
        var data = {
            labels: [
                "Dark Grey",
                "Purple Color",
                "Gray Color",
                "Green Color",
                "Blue Color"
            ],
            datasets: [{
                data: [120, 50, 140, 180, 100],
                backgroundColor: [
                    "#455C73",
                    "#9B59B6",
                    "#BDC3C7",
                    "#26B99A",
                    "#3498DB"
                ],
                hoverBackgroundColor: [
                    "#34495E",
                    "#B370CF",
                    "#CFD4D8",
                    "#36CAAB",
                    "#49A9EA"
                ]

            }]
        };

        var canvasDoughnut = new Chart(ctx, {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: data
        });

    }

    // Radar chart

    if ($('#canvasRadar').length) {

        var ctx = document.getElementById("canvasRadar");
        var data = {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: "rgba(3, 88, 106, 0.2)",
                borderColor: "rgba(3, 88, 106, 0.80)",
                pointBorderColor: "rgba(3, 88, 106, 0.80)",
                pointBackgroundColor: "rgba(3, 88, 106, 0.80)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                label: "My Second dataset",
                backgroundColor: "rgba(38, 185, 154, 0.2)",
                borderColor: "rgba(38, 185, 154, 0.85)",
                pointColor: "rgba(38, 185, 154, 0.85)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }]
        };

        var canvasRadar = new Chart(ctx, {
            type: 'radar',
            data: data,
        });

    }


    // Pie chart
    if ($('#pieChart').length) {

        var ctx = document.getElementById("pieChart");
        var data = {
            datasets: [{
                data: [120, 50, 140, 180, 100],
                backgroundColor: [
                    "#455C73",
                    "#9B59B6",
                    "#BDC3C7",
                    "#26B99A",
                    "#3498DB"
                ],
                label: 'My dataset' // for legend
            }],
            labels: [
                "Dark Gray",
                "Purple",
                "Gray",
                "Green",
                "Blue"
            ]
        };

        var pieChart = new Chart(ctx, {
            data: data,
            type: 'pie',
            otpions: {
                legend: false
            }
        });

    }


    // PolarArea chart

    if ($('#polarArea').length) {

        var ctx = document.getElementById("polarArea");
        var data = {
            datasets: [{
                data: [120, 50, 140, 180, 100],
                backgroundColor: [
                    "#455C73",
                    "#9B59B6",
                    "#BDC3C7",
                    "#26B99A",
                    "#3498DB"
                ],
                label: 'My dataset'
            }],
            labels: [
                "Dark Gray",
                "Purple",
                "Gray",
                "Green",
                "Blue"
            ]
        };

        var polarArea = new Chart(ctx, {
            data: data,
            type: 'polarArea',
            options: {
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        });

    }

</script>
@extends('layouts.app')
@section('title','Dashboard | Unikoop')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <!-- <form class="d-flex align-items-center mb-3">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control border" id="dash-daterange">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                    <i class="mdi mdi-autorenew"></i>
                                </a>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                    <i class="mdi mdi-filter-variant"></i>
                                </a>
                            </form> -->
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                        <i class="fa-solid fa-euro-sign font-22 avatar-title text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">&euro;<span data-plugin="counterup">{{ number_format($revenue->total, 2) }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Orders Amount</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                        <i class="fa-solid fa-money-bill-1 font-22 avatar-title text-success"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">&euro;<span data-plugin="counterup">{{ number_format($revenue->deliveredAmount, 2) }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Delivered Orders Amount</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                        <i class="fa-solid fa-money-bill-transfer font-22 avatar-title text-info"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">&euro;<span data-plugin="counterup">{{ number_format($revenue->pending, 2) }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Pending Orders Amount</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                        <i class="fe-bar-chart-line- font-22 avatar-title text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">
                                        @if($revenue->total != 0)
                                            {{ number_format($revenue->deliveredAmount * 100 / $revenue->total, 2) }}</span>%
                                        @endif
                                        </h3>
                                        <p class="text-muted mb-1 text-truncate">Conversion</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="fe-shopping-cart font-22 avatar-title text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->totalOrders }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Orders</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                        <i class="fe-truck font-22 avatar-title text-success"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->deliveredOrders }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Delivered Orders</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                        <i class="fe-clock font-22 avatar-title text-info"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->pendingOrders }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Pending Orders</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                        <i class="fe-message-square font-22 avatar-title text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">                                        
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">
                                            @if($revenue->totalOrders != 0)
                                                {{ number_format($revenue->deliveredOrders * 100 / $revenue->totalOrders, 2) }}</span>%
                                            @endif
                                        </h3>
                                        <p class="text-muted mb-1 text-truncate">Conversion</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="fe-shopping-cart font-22 avatar-title text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->dhlLabels + $revenue->dhlTodayLabels + $revenue->dpdLabels }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Labels</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                        <i class="fe-truck font-22 avatar-title text-success"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->dhlLabels ?? 0 }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Labels Fetched DHL</p>                                        
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                        <i class="fe-clock font-22 avatar-title text-info"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">                                        
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->dhlTodayLabels ?? 0 }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Labels Fetched DHL Today</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                        <i class="fe-message-square font-22 avatar-title text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="text-end">                                        
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $revenue->dpdLabels ?? 0 }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Labels Fetched DPD</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">

                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>

                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>

                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>

                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="dhl-tab" data-bs-toggle="tab" data-bs-target="#dhl" type="button" role="tab" aria-controls="home" aria-selected="true">DHL</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="dhl-today-tab" data-bs-toggle="tab" data-bs-target="#dhltoday" type="button" role="tab" aria-controls="dhltoday" aria-selected="false">DHL Today</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="dpd-tab" data-bs-toggle="tab" data-bs-target="#dpd" type="button" role="tab" aria-controls="dpd" aria-selected="false">DPD</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                  <h4 class="header-title mb-0">Total Revenue</h4>
                                <div class="tab-pane fade show active" id="dhl" style="height: 230px; min-height: 230.7px;" role="tabpanel" aria-labelledby="dhl-tab">
                                    <div id="total-revenue" class="mt-0" data-colors="#f1556c"></div></div>
                                    
                                    <div class="tab-pane fade" id="dhltoday" style="height: 230px; min-height: 230.7px;" role="tabpanel" aria-labelledby="dhl-today-tab">
                                            <div id="total-today-revenue" class="mt-0" data-colors="#f1556c"></div>
                                           </div>
                              
                                    <div class="tab-pane fade" id="dpd" style="height: 230px; min-height: 230.7px;" role="tabpanel" aria-labelledby="dpd-tab">
                                        <div id="total-dpd-revenue" class="mt-0" data-colors="#f1556c"></div>
                                      </div>
                                      <div class="widget-chart text-center" dir="ltr">
                                        <h5 class="text-muted mt-0">Total sales made today</h5>
                                        <h2>&euro;{{ $today_delivered_orders_shipping_amount->total ?? 0 }}</h2>
                                        <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading elements are designed
                                            to work best in the meat of your page content.</p>
                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Total</p>
                                                <h4><i class="fe-arrow-down text-danger me-1"></i>&euro;{{ $total_delivered_orders_shipping_amount->total ?? 0 }}</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                <h4><i class="fe-arrow-up text-success me-1"></i>&euro;{{ $last_week_delivered_orders_shipping_amount->total ?? 0 }}</h4>
                                            </div>
                                            <div class="col-4">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                                <h4><i class="fe-arrow-down text-danger me-1"></i>&euro;{{ $last_month_delivered_orders_shipping_amount->total ?? 0 }}</h4>
                                            </div>
                                        </div>
                                    </div>
                              </div>

                            
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="float-end d-none d-md-inline-block">
                                <div class="btn-group mb-2">
                                    <button type="button" class="btn btn-xs btn-light">Today</button>
                                    <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                    <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                                </div>
                            </div>
                            <h4 class="header-title mb-3">Sales Analytics</h4>
                            <div dir="ltr">
                                <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>

                            <h4 class="header-title mb-3">Latest 5 Orders</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Bestelnummer</th>
                                            <th>Profile</th>
                                            <th>Company</th>
                                            <th>Address</th>
                                            <th>Residence</th>
                                            <th>Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestOrders as $latestOrder)
                                        <tr>
                                            <td style="width: 36px;">
                                                {{ $latestOrder->bestelnummer }}
                                            </td>
                                            <td>
                                                {{ $latestOrder->voornaam_verzending }} {{ $latestOrder->achternaam_verzending }}
                                                <p class="mb-0 text-muted"><small>Fetched At {{ $latestOrder->fetched_date }}</small></p>
                                            </td>
                                            <td>
                                                {{ $latestOrder->bedrijfsnaam_verzending }}
                                            </td>
                                            <td>
                                                {{ $latestOrder->adres_verz_straat }}
                                            </td>
                                            <td>
                                                {{ $latestOrder->woonplaats_facturatie }}
                                            </td>
                                            <td>
                                                {{ $latestOrder->producttitel }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>

                            <h4 class="header-title mb-3">Revenue History</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-hover table-centered m-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Bestelnummer</th>
                                            <th>Profile</th>
                                            <th>Company</th>
                                            <th>Address</th>
                                            <th>Residence</th>
                                            <th>Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deliveredOrders as $deliveredOrder)
                                        <tr>
                                            <td style="width: 36px;">
                                                {{ $deliveredOrder->bestelnummer }}
                                            </td>

                                            <td>
                                                {{ $deliveredOrder->voornaam_verzending }} {{ $deliveredOrder->achternaam_verzending }}
                                                <p class="mb-0 text-muted"><small>Fetched At {{ $deliveredOrder->fetched_date }}</small></p>
                                            </td>

                                            <td>
                                                {{ $deliveredOrder->bedrijfsnaam_verzending }}
                                            </td>

                                            <td>
                                                {{ $deliveredOrder->adres_verz_straat }}
                                            </td>

                                            <td>
                                                {{ $deliveredOrder->woonplaats_facturatie }}
                                            </td>

                                            <td>
                                                {{ $deliveredOrder->producttitel }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div>
    <!-- End Page content -->    
    @endsection

    @section('js')
    <script>
        var colors=["#f1556c"],
        dataColors=$("#total-revenue").data("colors");
        dataColorsDpd=$("#total-dpd-revenue").data("colors");
        dataColorsToday=$("#total-today-revenue").data("colors");
        dataColors&&(colors=dataColors.split(","));
        dataColorsDpd&&(colors=dataColorsDpd.split(","));
        dataColorsToday&&(colors=dataColorsToday.split(","));
        var options={
            series:[
                    @If($revenue->deliveredOrders != 0)
                        {{ number_format($revenue->dhlLabels * 100 / $revenue->deliveredOrders, 2) }}
                      @else
                        {{0}}
                    @endif
                ],               
                chart:{
                    height:242,type:"radialBar"
                },
                plotOptions:{
                    radialBar:{
                        hollow:{
                            size:"68%"
                        }
                    }
                },
                colors:colors,
                labels:["DHL Labels"]
            };
            var optionsToday={
                    series:[
                        @If($revenue->deliveredOrders != 0)
                           {{ number_format( $revenue->dhlTodayLabels * 100 / $revenue->deliveredOrders, 2) }}
                        @else
                            {{0}}
                        @endif    
                          ],
                    chart:{
                        height:242,type:"radialBar"
                    },
                    plotOptions:{
                        radialBar:{
                            hollow:{
                                size:"68%"
                            }
                        }
                    },
                    colors:colors,
                    labels:["DHL Today Labels"]
                };
        var optionsDpd={
                series:[
                    @If($revenue->deliveredOrders != 0)
                        {{ number_format($revenue->dpdLabels * 100 / $revenue->deliveredOrders, 2) }}
                      @else
                        {{0}}
                    @endif
                ],
                chart:{
                    height:242,type:"radialBar"
                },
                plotOptions:{
                    radialBar:{
                        hollow:{
                            size:"68%"
                        }
                    }
                },
                colors:colors,
                labels:["DPD Labels"]
            },
            chart=new ApexCharts(document.querySelector("#total-revenue"),options);
            chartToday=new ApexCharts(document.querySelector("#total-today-revenue"),optionsToday);
            chartDpd=new ApexCharts(document.querySelector("#total-dpd-revenue"),optionsDpd);
            chart.render();
            chartToday.render();
            chartDpd.render();
            colors=["#1abc9c","#4a81d4"];
            (dataColors=$("#sales-analytics").data("colors"))&&(colors=dataColors.split(","));
            options={
                series:[{
                    name:"Orders",
                    type:"column",
                    data:@json($graph_data['added'])
                },
                {
                    name:"Labels Fetched",
                    type:"line",
                    data:@json($graph_data['fetched'])
                }],
                chart:{
                    height:378,
                    type:"line",
                    offsetY:10
                },
                stroke:{
                    width:[2,3]},
                    plotOptions:{bar:{
                        columnWidth:"50%"
                    }
                },
                colors:colors,
                dataLabels:{
                    enabled:!0,
                    enabledOnSeries:[1]},
                    labels:@json($graph_data['date']),
                    xaxis:{
                        type:"datetime"
                    },
                    legend:{
                        offsetY:7
                    },
                    grid:{
                        padding:{
                            bottom:20
                        }
                    },
                    fill:{
                        type:"gradient",
                        gradient:{
                            shade:"light",
                            type:"horizontal",
                            shadeIntensity:.25,
                            gradientToColors:void 0,
                            inverseColors:!0,
                            opacityFrom:.75,
                            opacityTo:.75,
                            stops:[0,0,0]
                        }
                    },
                    yaxis:[{
                        title:{
                            text:"Orders"
                        }
                    },
                    {
                        opposite:!0,
                        title:{
                            text:"Number of Labels"
                        }
                    }]
            };
                (chart=new ApexCharts(document.querySelector("#sales-analytics"),options)).render(),
                $("#dash-daterange").flatpickr({
                    altInput:!0,
                    mode:"range",
                    altFormat:"F j, y",
                    defaultDate:"today"
                });
    </script>
    @endsection
    
@extends('backend.layout.template')
@section('content')
    <div class="col-xl-12" style="display: none;">

        <!-- Marketing campaigns -->
        <div class="card">
            <div class="card-header header-elements-sm-inline">
                <h6 class="card-title">Marketing campaigns</h6>
                <div class="header-elements">
                    <span class="badge bg-success badge-pill">28 active</span>
                    <div class="list-icons ml-3">
                        <div class="list-icons-item dropdown">
                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
                                <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
                                <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div id="campaigns-donut"></div>
                    <div class="ml-3">
                        <h5 class="font-weight-semibold mb-0">38,289 <span class="text-success font-size-sm font-weight-normal"><i class="icon-arrow-up12"></i> (+16.2%)</span></h5>
                        <span class="badge badge-mark border-success mr-1"></span> <span class="text-muted">May 12, 12:30 am</span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div id="campaign-status-pie"></div>
                    <div class="ml-3">
                        <h5 class="font-weight-semibold mb-0">2,458 <span class="text-danger font-size-sm font-weight-normal"><i class="icon-arrow-down12"></i> (-4.9%)</span></h5>
                        <span class="badge badge-mark border-danger mr-1"></span> <span class="text-muted">Jun 4, 4:00 am</span>
                    </div>
                </div>

                <div>
                    <a href="#" class="btn bg-indigo-300"><i class="icon-statistics mr-2"></i> View report</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th>Campaign</th>
                        <th>Client</th>
                        <th>Changes</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-active table-border-double">
                        <td colspan="5">Today</td>
                        <td class="text-right">
                            <span class="progress-meter" id="today-progress" data-progress="30"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/brands/facebook.png')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Facebook</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-blue mr-1"></span>
                                        02:00 - 03:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Mintlime</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.43%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$5,489</h6></td>
                        <td><span class="badge bg-blue">Active</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/brands/youtube.png')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Youtube videos</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-danger mr-1"></span>
                                        13:00 - 14:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">CDsoft</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 3.12%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$2,592</h6></td>
                        <td><span class="badge bg-danger">Closed</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/brands/spotify.png')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Spotify ads</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-grey-400 mr-1"></span>
                                        10:00 - 11:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Diligence</span></td>
                        <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> - 8.02%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$1,268</h6></td>
                        <td><span class="badge bg-grey-400">On hold</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/brands/twitter.png')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Twitter ads</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-grey-400 mr-1"></span>
                                        04:00 - 05:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Deluxe</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 2.78%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$7,467</h6></td>
                        <td><span class="badge bg-grey-400">On hold</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="table-active table-border-double">
                        <td colspan="5">Yesterday</td>
                        <td class="text-right">
                            <span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/brands/bing.png')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Bing campaign</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-success mr-1"></span>
                                        15:00 - 16:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Metrics</span></td>
                        <td><span class="text-danger"><i class="icon-stats-decline2 mr-2"></i> - 5.78%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$970</h6></td>
                        <td><span class="badge bg-success-400">Pending</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/brands/amazon.png')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Amazon ads</a>
                                    <div class="text-muted font-size-sm">
                                        <span class="badge badge-mark border-danger mr-1"></span>
                                        18:00 - 19:00
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted">Blueish</span></td>
                        <td><span class="text-success-600"><i class="icon-stats-growth2 mr-2"></i> 6.79%</span></td>
                        <td><h6 class="font-weight-semibold mb-0">$1,540</h6></td>
                        <td><span class="badge bg-blue">Active</span></td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> View statement</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-text2"></i> Edit campaign</a>
                                        <a href="#" class="dropdown-item"><i class="icon-file-locked"></i> Disable campaign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /marketing campaigns -->


        <!-- Quick stats boxes -->
        <div class="row">
            <div class="col-lg-4">

                <!-- Members online -->
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">3,450</h3>
                            <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span>
                        </div>

                        <div>
                            Members online
                            <div class="font-size-sm opacity-75">489 avg</div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->

            </div>

            <div class="col-lg-4">

                <!-- Current server load -->
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">49.4%</h3>
                            <div class="list-icons ml-auto">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
                                        <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
                                        <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            Current server load
                            <div class="font-size-sm opacity-75">34.6% avg</div>
                        </div>
                    </div>

                    <div id="server-load"></div>
                </div>
                <!-- /current server load -->

            </div>

            <div class="col-lg-4">

                <!-- Today's revenue -->
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">$18,390</h3>
                            <div class="list-icons ml-auto">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div>
                        </div>

                        <div>
                            Today's revenue
                            <div class="font-size-sm opacity-75">$37,578 avg</div>
                        </div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
        </div>
        <!-- /quick stats boxes -->


        <!-- Support tickets -->
        <div class="card">
            <div class="card-header header-elements-sm-inline">
                <h6 class="card-title">Support tickets</h6>
                <div class="header-elements">
                    <a class="text-default daterange-ranges font-weight-semibold cursor-pointer dropdown-toggle">
                        <i class="icon-calendar3 mr-2"></i>
                        <span></span>
                    </a>
                </div>
            </div>

            <div class="card-body d-md-flex align-items-md-center justify-content-md-between flex-md-wrap">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <div id="tickets-status"></div>
                    <div class="ml-3">
                        <h5 class="font-weight-semibold mb-0">14,327 <span class="text-success font-size-sm font-weight-normal"><i class="icon-arrow-up12"></i> (+2.9%)</span></h5>
                        <span class="badge badge-mark border-success mr-1"></span> <span class="text-muted">Jun 16, 10:00 am</span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon">
                        <i class="icon-alarm-add"></i>
                    </a>
                    <div class="ml-3">
                        <h5 class="font-weight-semibold mb-0">1,132</h5>
                        <span class="text-muted">total tickets</span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon">
                        <i class="icon-spinner11"></i>
                    </a>
                    <div class="ml-3">
                        <h5 class="font-weight-semibold mb-0">06:25:00</h5>
                        <span class="text-muted">response time</span>
                    </div>
                </div>

                <div>
                    <a href="#" class="btn bg-teal-400"><i class="icon-statistics mr-2"></i> Report</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th style="width: 50px">Due</th>
                        <th style="width: 300px;">User</th>
                        <th>Description</th>
                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-active table-border-double">
                        <td colspan="3">Active tickets</td>
                        <td class="text-right">
                            <span class="badge bg-blue badge-pill">24</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <h6 class="mb-0">12</h6>
                            <div class="font-size-sm text-muted line-height-1">hours</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-teal-400 rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-blue mr-1"></span> Active</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div class="font-weight-semibold">[#1183] Workaround for OS X selects printing bug</div>
                                <span class="text-muted">Chrome fixed the bug several versions ago, thus rendering this...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <h6 class="mb-0">16</h6>
                            <div class="font-size-sm text-muted line-height-1">hours</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/placeholders/placeholder.jpg')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Chris Macintyre</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-blue mr-1"></span> Active</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div class="font-weight-semibold">[#1249] Vertically center carousel controls</div>
                                <span class="text-muted">Try any carousel control and reduce the screen width below...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <h6 class="mb-0">20</h6>
                            <div class="font-size-sm text-muted line-height-1">hours</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-blue rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">Robert Hauber</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-blue mr-1"></span> Active</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div class="font-weight-semibold">[#1254] Inaccurate small pagination height</div>
                                <span class="text-muted">The height of pagination elements is not consistent with...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <h6 class="mb-0">40</h6>
                            <div class="font-size-sm text-muted line-height-1">hours</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-warning-400 rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">Robert Hauber</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-blue mr-1"></span> Active</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div class="font-weight-semibold">[#1184] Round grid column gutter operations</div>
                                <span class="text-muted">Left rounds up, right rounds down. should keep everything...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-checkmark3 text-success"></i> Resolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="table-active table-border-double">
                        <td colspan="3">Resolved tickets</td>
                        <td class="text-right">
                            <span class="badge bg-success badge-pill">42</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <i class="icon-checkmark3 text-success"></i>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-success-400 rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">Alan Macedo</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-success mr-1"></span> Resolved</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div>[#1046] Avoid some unnecessary HTML string</div>
                                <span class="text-muted">Rather than building a string of HTML and then parsing it...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-plus3 text-blue"></i> Unresolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <i class="icon-checkmark3 text-success"></i>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-pink-400 rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">Brett Castellano</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-success mr-1"></span> Resolved</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div>[#1038] Update json configuration</div>
                                <span class="text-muted">The <code>files</code> property is necessary to override the files property...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-plus3 text-blue"></i> Unresolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <i class="icon-checkmark3 text-success"></i>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/placeholders/placeholder.jpg')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Roxanne Forbes</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-success mr-1"></span> Resolved</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div>[#1034] Tooltip multiple event</div>
                                <span class="text-muted">Fix behavior when using tooltips and popovers that are...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-plus3 text-blue"></i> Unresolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2 text-danger"></i> Close issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="table-active table-border-double">
                        <td colspan="3">Closed tickets</td>
                        <td class="text-right">
                            <span class="badge bg-danger badge-pill">37</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <i class="icon-cross2 text-danger-400"></i>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="{{asset('global_assets/images/placeholders/placeholder.jpg')}}" class="rounded-circle" width="32" height="32" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold">Mitchell Sitkin</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-danger mr-1"></span> Closed</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div>[#1040] Account for static form controls in form group</div>
                                <span class="text-muted">Resizes control label's font-size and account for the standard...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-plus3 text-blue"></i> Unresolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-spinner11 text-grey"></i> Reopen issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <i class="icon-cross2 text-danger"></i>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-brown-400 rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">Katleen Jensen</a>
                                    <div class="text-muted font-size-sm"><span class="badge badge-mark border-danger mr-1"></span> Closed</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-default">
                                <div>[#1038] Proper sizing of form control feedback</div>
                                <span class="text-muted">Feedback icon sizing inside a larger/smaller form-group...</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-undo"></i> Quick reply</a>
                                        <a href="#" class="dropdown-item"><i class="icon-history"></i> Full history</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-plus3 text-blue"></i> Unresolve issue</a>
                                        <a href="#" class="dropdown-item"><i class="icon-spinner11 text-grey"></i> Reopen issue</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /support tickets -->


        <!-- Latest posts -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Latest posts</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="media flex-column flex-sm-row mt-0 mb-3">
                            <div class="mr-sm-3 mb-2 mb-sm-0">
                                <div class="card-img-actions">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-fluid img-preview rounded" alt="">
                                        <span class="card-img-actions-overlay card-img"><i class="icon-play3 icon-2x"></i></span>
                                    </a>
                                </div>
                            </div>

                            <div class="media-body">
                                <h6 class="media-title"><a href="#">Up unpacked friendly</a></h6>
                                <ul class="list-inline list-inline-dotted text-muted mb-2">
                                    <li class="list-inline-item"><i class="icon-book-play mr-2"></i> Video tutorials</li>
                                </ul>
                                The him father parish looked has sooner. Attachment frequently terminated son hello...
                            </div>
                        </div>

                        <div class="media flex-column flex-sm-row mt-0 mb-3">
                            <div class="mr-sm-3 mb-2 mb-sm-0">
                                <div class="card-img-actions">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-fluid img-preview rounded" alt="">
                                        <span class="card-img-actions-overlay card-img"><i class="icon-play3 icon-2x"></i></span>
                                    </a>
                                </div>
                            </div>

                            <div class="media-body">
                                <h6 class="media-title"><a href="#">It allowance prevailed</a></h6>
                                <ul class="list-inline list-inline-dotted text-muted mb-2">
                                    <li class="list-inline-item"><i class="icon-book-play mr-2"></i> Video tutorials</li>
                                </ul>
                                Alteration literature to or an sympathize mr imprudence. Of is ferrars subject enjoyed...
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="media flex-column flex-sm-row mt-0 mb-3">
                            <div class="mr-sm-3 mb-2 mb-sm-0">
                                <div class="card-img-actions">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-fluid img-preview rounded" alt="">
                                        <span class="card-img-actions-overlay card-img"><i class="icon-play3 icon-2x"></i></span>
                                    </a>
                                </div>
                            </div>

                            <div class="media-body">
                                <h6 class="media-title"><a href="#">Case read they must</a></h6>
                                <ul class="list-inline list-inline-dotted text-muted mb-2">
                                    <li class="list-inline-item"><i class="icon-book-play mr-2"></i> Video tutorials</li>
                                </ul>
                                On it differed repeated wandered required in. Then girl neat why yet knew rose spot...
                            </div>
                        </div>

                        <div class="media flex-column flex-sm-row mt-0 mb-3">
                            <div class="mr-sm-3 mb-2 mb-sm-0">
                                <div class="card-img-actions">
                                    <a href="#">
                                        <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-fluid img-preview rounded" alt="">
                                        <span class="card-img-actions-overlay card-img"><i class="icon-play3 icon-2x"></i></span>
                                    </a>
                                </div>
                            </div>

                            <div class="media-body">
                                <h6 class="media-title"><a href="#">Too carriage attended</a></h6>
                                <ul class="list-inline list-inline-dotted text-muted mb-2">
                                    <li class="list-inline-item"><i class="icon-book-play mr-2"></i> FAQ section</li>
                                </ul>
                                Marianne or husbands if at stronger ye. Considered is as middletons uncommonly...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /latest posts -->

    </div>
@endsection

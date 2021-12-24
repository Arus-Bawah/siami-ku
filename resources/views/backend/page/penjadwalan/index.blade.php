@extends('backend.layout.template')
@section('content')
    <!-- HTML sourced data -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Daftar Penjadwalan</h5>
            <div class="header-elements" style="width: 400px;">
                <div class="row" style="width: 100%;margin-right: 0px !important;margin-left: 0px !important;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control select" data-fouc style="width: 100%">
                                <option value="">All Status</option>
                                <option value="AZ">Arizona</option>
                                <option value="CO">Colorado</option>
                                <option value="ID">Idaho</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-7" style="padding: 0px !important;">
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="text" class="form-control" placeholder="Input Your Text in Here">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table styled-table datatable-html">
            <thead>
            <tr>
                <th class="text-center" style="width: 50px !important;">No</th>
                <th>Unit</th>
                <th>Tanggal audit</th>
                <th>Siklus/Tahun</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php $n = 1; ?>
            @foreach($list as $row)
                <tr>
                    <td style="width: 50px;" class="text-center">{{$n++}}</td>
                    <td>{{$row->unit}}</td>
                    <td>{{date('d M Y',strtotime($row->audit_date))}}</td>
                    <td>{{$row->siklus_number}} / {{$row->siklus_year}}</td>
                    <td class="text-right" style="width: 300px !important;">
                        {{--                        <a href="" class="btn btn-dark btn-grey btn-custom">Audit</a>--}}
                        <a href="{{adminUrl('penjadwalan/edit')}}/{{$row->id}}?return_url={{request()->fullUrl()}}" class="btn btn-xs btn-secondary border-2 ml-1">Edit</a>
                        <a href="javascript:;" onclick="doDelete('{{adminUrl("penjadwalan/delete/".$row->id.'?return_url='.request()->fullUrl())}}')" class="btn btn-xs btn-dark border-2 ml-1">Hapus</a>
                        @if($row->status_publish === null)
                            <a href="javascript:;" onclick="doPubish('{{adminUrl("penjadwalan/publish/".$row->id.'?return_url='.request()->fullUrl())}}','pubish')" class="btn btn-xs btn-secondary border-2 ml-1">Publish</a>
                        @else
                            <a href="javascript:;" onclick="doPubish('{{adminUrl("penjadwalan/un-publish/".$row->id.'?return_url='.request()->fullUrl())}}','unpubish')" class="btn btn-xs btn-dark border-2 ml-1">Unpublish</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            @if(count($list) == 0)
                <tr>
                    <td colspan="5" class="text-center">No Data</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="p-3">
            {{ $list->links('vendors.pagination.custom') }}
        </div>
    </div>
    <!-- /HTML sourced data -->
    @push('bottom')
        <script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
        <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
        <script src="{{asset('global_assets/js/demo_pages/form_select2.js')}}"></script>
        <script>
            function doPubish(link,type) {
                let text = "Apakah anda yakin akan mempublish jadwal ?";
                if (type == 'unpublish') {
                    text = "Apakah anda yakin akan membatalkan jadwal ?";
                }
                swal({
                    title: "",
                    text: text,
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
    @endpush
@endsection

@extends('backend.layout.template')
@section('content')
    <!-- HTML sourced data -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Daftar Pelaksanaan</h5>
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
                <th class="text-center">No</th>
                <th>Status</th>
                <th>Nama Laporan</th>
                <th>Siklus/Tahun</th>
                <th>Tanggal Audit</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php $n = 1; ?>
            @foreach($list as $row)
                <tr>
                    <td style="width: 50px;" class="text-center">{{$n++}}</td>
                    <td>{{$row->status}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->siklus_number}} / {{$row->siklus_year}}</td>
                    <td>{{date('d M Y',strtotime($row->audit_date))}}</td>
                    <td class="text-right" style="width: 200px !important;">
                        @if(session()->get('users_privileges') == 'Auditor' OR session()->get('users_privileges') == 'Auditee')
                            <a href="{{adminUrl('pelaksanaan/audit')}}/{{$row->id}}?return_url={{request()->fullUrl()}}" class="btn btn-dark btn-grey btn-custom">Audit</a>
                        @else
                            <a href="{{adminUrl('pelaksanaan/edit')}}/{{$row->id}}?return_url={{request()->fullUrl()}}" class="btn btn-xs btn-secondary border-2 ml-1">Edit</a>
                            <a href="javascript:;" onclick="doDelete('{{adminUrl("pelaksanaan/delete/".$row->id.'?return_url='.request()->fullUrl())}}')" class="btn btn-xs btn-dark border-2 ml-1">Hapus</a>
                        @endif
                    </td>
                </tr>
            @endforeach
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
    @endpush
@endsection

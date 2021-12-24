@extends('backend.layout.template')
@section('content')
    <!-- HTML sourced data -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Daftar Lab</h5>
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
                <th>Nama Lab</th>
                <th class="text-right" data-orderable="false">Actions</th>
            </tr>
            </thead>

            <tbody>
                @foreach($list as $row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td class="text-right">
                            <a href="{{adminUrl('lab/edit')}}/{{$row->id}}?return_url={{request()->fullUrl()}}" class="btn btn-xs btn-secondary border-2 ml-1">Edit</a>
                            <a href="javascript:;" onclick="doDelete('{{adminUrl("lab/delete/".$row->id.'?return_url='.request()->fullUrl())}}')" class="btn btn-xs btn-dark border-2 ml-1">Hapus</a>
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

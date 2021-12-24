@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{adminUrl('privileges/save')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {!! returnUrl() !!}
                        <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama:</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lembaga" value="{{(isset($data) && $data->id?$data->name:"")}}">
                            </div>
                        </div>
                        <div class="form-group row set_as_superadmin">
                            <label class="col-lg-3 col-form-label">Superadmin:</label>
                            <div class="col-lg-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineradio1" value="1" {{($edit)?($edit->is_superadmin)?'checked':'':''}} name="is_superadmin">
                                    <label class="form-check-label" for="inlineradio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineradio1" {{($edit)?(!$edit->is_superadmin)?'checked':'':''}} value="0" name="is_superadmin">
                                    <label class="form-check-label" for="inlineradio1">No</label>
                                </div>
                            </div>
                        </div>
                        <div id="privileges_configuration">
                            <label for="">Access Menu</label>
                            <table class="table table-hover main-table table-bordered">
                                <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Menu</th>
                                    <th></th>
                                    <th class="text-center">View</th>
                                    <th class="text-center">Create</th>
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                                <tr class="info">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="text-center"><input title="Check all vertical" type="checkbox" id="is_visible"></th>
                                    <th class="text-center"><input title="Check all vertical" type="checkbox" id="is_create"></th>
                                    <th class="text-center"><input title="Check all vertical" type="checkbox" id="is_edit"></th>
                                    <th class="text-center"><input title="Check all vertical" type="checkbox" id="is_delete"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_menu as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$row->name}}</td>
                                        <td class="text-center">
                                            <input type="checkbox" title="Check All Horizontal" class="select_horizontal">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_visible" name="privileges[{{$row->id}}][view]" {{($row->can_view)?'checked':''}} value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_create" name="privileges[{{$row->id}}][add]" {{($row->can_add)?'checked':''}} value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_edit" name="privileges[{{$row->id}}][edit]" {{($row->can_edit)?'checked':''}} value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_delete" name="privileges[{{$row->id}}][delete]" {{($row->can_delete)?'checked':''}} value="1">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-primary">Simpan Data <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /basic layout -->
        </div>
    </div>
    @push('bottom')
        <script>
            $(function () {
                var is_admin = '{{($edit)?$edit->is_superadmin:0}}';
                is_admin = parseInt(is_admin);
                if (is_admin===1){
                    $('#privileges_configuration').hide();
                }
                $('.set_as_superadmin input').click(function () {
                    var n = $(this).val();
                    if (n === '1') {
                        $('#privileges_configuration').hide();
                    } else {
                        $('#privileges_configuration').show();
                    }
                })
                $("#is_visible").click(function () {
                    var is_ch = $(this).prop('checked');
                    $(".is_visible").prop("checked", is_ch);
                })
                $("#is_create").click(function () {
                    var is_ch = $(this).prop('checked');
                    $(".is_create").prop("checked", is_ch);
                })
                $("#is_edit").click(function () {
                    var is_ch = $(this).is(':checked');
                    $(".is_edit").prop("checked", is_ch);
                })
                $("#is_delete").click(function () {
                    var is_ch = $(this).is(':checked');
                    $(".is_delete").prop("checked", is_ch);
                })
                $(".select_horizontal").click(function () {
                    var p = $(this).parents('tr');
                    var is_ch = $(this).is(':checked');
                    p.find("input[type=checkbox]").prop("checked", is_ch);
                })
            })
        </script>
    @endpush
@endsection

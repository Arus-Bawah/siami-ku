@extends('backend.layout.template')
@section('content')
    <style>
        tr.title-tr {
            background: #F2F2F2 !important;
        }
        label.btn {
            margin-bottom: 0px !important;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <div>
                        <h5 class="card-title" style="font-size: 24px;">Rekomendasi perbaikan</h5>
                        <small>Step 4 of 4</small>
                    </div>
                    <div class="header-elements" style="margin-top: -20px;">
                        <a href="{{adminUrl('pelaksanaan/do-temuan/'.$data->id)}}?type=capaian&return_url={{adminUrl('pelaksanaan')}}" class="btn btn-grey btn-custom-grey btn-custom mr-2">Back</a>
                        <a href="{{adminUrl('pelaksanaan/submit-audit/'.$data->id)}}?type=capaian&return_url={{adminUrl('pelaksanaan')}}" class="btn btn-grey font-white btn-custom">Submit</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <td style="background: #F2F2F2;width: 150px;">Area</td>
                            <td style="background: #F2F2F2">Rekomendasi perbaikan</td>
                            <td style="background: #F2F2F2;width: 150px;">PIC / Penanggung jawab</td>
                            <td style="background: #F2F2F2;width: 150px;">Target pemenuhan</td>
                            <td style="background: #F2F2F2;width: 150px !important;" class="text-center">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="{{adminUrl('pelaksanaan/do-temuan/save/'.$data->id)}}" method="post" enctype="multipart/form-data" id="temuan">
                            <tr>
                                <td>
                                    {{csrf_field()}}
                                    <input type="hidden" name="is_perbaikan" value="1">
                                    <input type="text" name="area" required class="form-control">
                                </td>
                                <td style="width: 400px;">
                                    <input type="text" name="recomended" required class="form-control">
                                </td>
                                <td>
                                    <select name="pic" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Dekan">Dekan</option>
                                        <option value="Dekan/Unit terkait">Dekan/Unit terkait</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input type="text" name="target" required class="form-control">
                                </td>
                                <td class="text-center" style="width: 100px !important;">
                                    <button type="submit" class="btn btn-secondary btn-rounded w-100 save-button">Add</button>
                                </td>
                            </tr>
                        </form>
                        </tbody>
                        <tbody id="list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic modal -->
    <div id="modalUpdate" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg" style="max-width:1200px">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title"><b>Edited</b></h5>
                        <small>Silakan edit data poin terkait</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{adminUrl('pelaksanaan/do-temuan/save/'.$data->id)}}" method="post" enctype="multipart/form-data" id="temuanEdit">
                <div class="modal-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <td style="background: #F2F2F2;width: 200px;" class="font-weight-bold">Area</td>
                            <td style="background: #F2F2F2" class="font-weight-bold">Rekomendasi perbaikan</td>
                            <td style="background: #F2F2F2;width: 150px;" class="font-weight-bold">PIC / Penanggung jawab</td>
                            <td style="background: #F2F2F2;width: 150px;" class="font-weight-bold">Target pemenuhan</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 150px;vertical-align: top;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="is_perbaikan" value="1">
                                    <input type="hidden" name="edit_id" id="editId" value="">
                                    <input id="editArea" type="text" name="area" class="form-control">
                                </td>
                                <td style="width: 400px;vertical-align: top;">
                                    <input id="editRecomended" type="text" name="recomended" class="form-control">
                                </td>
                                <td style="width: 400px;vertical-align: top;">
                                    <select id="editPic" name="pic" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Dekan">Dekan</option>
                                        <option value="Dekan/Unit terkait">Dekan/Unit terkait</option>
                                    </select>
                                </td>
                                <td class="text-center" style="vertical-align: top;">
                                    <input type="text" name="target" id="editTarget" required class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-custom-white btn-custom" data-dismiss="modal" d>Batal</button>
                    <button type="submit" class="btn btn-grey font-white btn-custom">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
    @push('bottom')
        <script>
            let dataItem = [];
            $(document).ready(function () {
                doGenerate();
            })
            function doDelete(id) {
                $.getJSON( "{{adminUrl('pelaksanaan/delete-temuan')}}/"+id+'?is_perbaikan=1', function( data ) {
                    if (data.status === 1) {
                        doGenerate();
                    }
                })
            }
            function doEdit(id,i) {
                let item = dataItem[i];
                $('#editId').val(item['id']);
                $('#editArea').val(item['area']);
                $('#editRecomended').val(item['recomended']);
                $('#editPic').val(item['pic']);
                $('#editTarget').val(item['target']);
                $('#modalUpdate').modal('show');
            }
            async function doGenerate() {
                $.getJSON( "{{adminUrl('pelaksanaan/list-temuan/'.$data->id)}}?is_perbaikan=1", function( data ) {
                    let html = '';
                    let response = data.data;
                    dataItem = response;
                    $.each(response, function(i, item) {
                        html +=
                            '<tr> ' +
                            '<td style="vertical-align: top !important;"> '+response[i].area+' </td> ' +
                            '<td style="vertical-align: top !important;"> '+response[i].recomended+' </td> ' +
                            '<td style="vertical-align: top !important;"> '+response[i].pic+' </td> ' +
                            '<td class="text-center" style="vertical-align: top !important;">'+response[i].target+' </td>' +
                            '<td class="text-center" style="display: flex;flex: 1;vertical-align: top !important;width: 160px !important; "> ' +
                                '<button type="button" class="btn btn-light btn-custom-white btn-custom mr-2" onclick="doEdit('+response[i].id+','+i+')">Edit</button> ' +
                                '<button type="button" class="btn btn-secondary btn-rounded save-button" onclick="doDelete('+response[i].id+')">Remove</button> ' +
                            '</td> ' +
                            '</tr>'
                    })
                    $('#list').html(html);
                })
            }
            $('#temuanEdit').on('submit',function (e) {
                e.preventDefault();
                var form_data = new FormData($('#temuanEdit')[0]);
                var form= $("#temuanEdit");
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status === 1) {
                            doGenerate();
                        }
                    }
                });
                $('#temuan')[0].reset();
                $('#modalUpdate').modal('toggle');
            });
            $('#temuan').on('submit',function (e) {
                e.preventDefault();
                var form_data = new FormData($('#temuan')[0]);
                var form= $("#temuan");
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status === 1) {
                            doGenerate();
                        }
                    }
                });
                $('#temuan')[0].reset();
            });
        </script>
    @endpush
@endsection

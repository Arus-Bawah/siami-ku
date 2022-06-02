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
                        <h5 class="card-title" style="font-size: 24px;">Daftar temuan</h5>
                        <small>Step 3 of 4</small>
                    </div>
                    <div class="header-elements" style="margin-top: -20px;">
                        <a href="{{adminUrl('pelaksanaan/do-audit/'.$data->id)}}?type=capaian&return_url={{adminUrl('pelaksanaan')}}" class="btn btn-grey btn-custom-grey btn-custom mr-2">Back</a>
                        <a href="{{adminUrl('pelaksanaan/do-perbaikan/'.$data->id)}}?return_url={{adminUrl('pelaksanaan')}}" class="btn btn-grey font-white btn-custom">Next</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <td style="background: #F2F2F2;width: 150px;">Jenis temuan</td>
                            <td style="background: #F2F2F2">Referensi</td>
                            <td style="background: #F2F2F2">Pernyataan</td>
                            <td style="background: #F2F2F2;width: 150px;" class="text-center">Attachment</td>
                            <td style="background: #F2F2F2" class="text-center">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="{{adminUrl('pelaksanaan/do-temuan/save/'.$data->id)}}" method="post" enctype="multipart/form-data" id="temuan">
                            <tr>
                                <td>
                                    {{csrf_field()}}
                                    <select name="jenis" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Positif">Positif</option>
                                        <option value="Observasi">Observasi</option>
                                        <option value="Minor">Minor</option>
                                        <option value="Mayor">Mayor</option>
                                    </select>
                                </td>
                                <td style="width: 400px;">
                                    <input type="text" name="referensi" required class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="pernyataan" required class="form-control">
                                </td>
                                <td class="text-center">
                                    <label for="fileUpload" class="btn btn-light btn-custom-white btn-custom">
                                        Upload
                                        <input type="file" name="file" id="fileUpload" style="display: none">
                                    </label>
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
        <div class="modal-dialog modal-lg" style="max-width:1000px">
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
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold">Jenis temuan</td>
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold">Referensi</td>
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold">Pernyataan</td>
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold">Attachment</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 150px;vertical-align: top;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="edit_id" id="editId" value="">
                                    <select id="editJenis" name="jenis" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Positif">Positif</option>
                                        <option value="Observasi">Observasi</option>
                                        <option value="Minor">Minor</option>
                                        <option value="Mayor">Mayor</option>
                                    </select>
                                </td>
                                <td style="width: 400px;vertical-align: top;">
                                    <input id="editReferensi" type="text" name="referensi" class="form-control">
                                </td>
                                <td style="width: 400px;vertical-align: top;">
                                    <input id="editPernyataan" type="text" name="pernyataan" class="form-control">
                                </td>
                                <td class="text-center" style="vertical-align: top;">
                                    <label for="fileUpload" class="btn btn-light btn-custom-white btn-custom">
                                        Upload
                                        <input type="file" name="file" id="fileUpload" style="display: none">
                                    </label>
                                    <span id="checkFile">

                                    </span>
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
                $.getJSON( "{{adminUrl('pelaksanaan/delete-temuan')}}/"+id, function( data ) {
                    if (data.status === 1) {
                        doGenerate();
                    }
                })
            }
            function doEdit(id,i) {
                let item = dataItem[i];
                $('#editId').val(item['id']);
                $('#editJenis').val(item['type']);
                $('#editPernyataan').val(item['pernyataan']);
                $('#editReferensi').val(item['referensi']);
                $('#editReferensi').val(item['referensi']);
                let html = '<a href="'+item['file']+'" class="mt-1" target="_blank" style="text-decoration: underline">check file</a>';
                $('#checkFile').html(html);
                $('#modalUpdate').modal('show');
            }
            async function doGenerate() {
                $.getJSON( "{{adminUrl('pelaksanaan/list-temuan/'.$data->id)}}", function( data ) {
                    let html = '';
                    let response = data.data;
                    dataItem = response;
                    $.each(response, function(i, item) {
                        html +=
                            '<tr> ' +
                            '<td style="vertical-align: top !important;"> '+response[i].type+' </td> ' +
                            '<td style="vertical-align: top !important;"> '+response[i].referensi+' </td> ' +
                            '<td style="vertical-align: top !important;"> '+response[i].pernyataan+' </td> ' +
                            '<td class="text-center" style="vertical-align: top !important;"> ' +
                                '<label for="fileUpload" class="btn btn-light btn-custom-white btn-custom"> View </label> </td> ' +
                            '<td class="text-center" style="display: flex;flex: 1;vertical-align: top !important;"> ' +
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

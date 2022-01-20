@extends('backend.layout.template')
@section('content')
    <style>
        tr.title-tr {
            background: #F2F2F2 !important;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <div>
                        <h5 class="card-title" style="font-size: 24px;">Capaian standar</h5>
                        <small>Step 2 of 4</small>
                    </div>
                    <div class="header-elements" style="margin-top: -20px;">
                        <a href="{{adminUrl('pelaksanaan/do-audit/'.$data->id)}}?return_url={{adminUrl('pelaksanaan/audit/'.$data->id)}}" class="btn btn-grey btn-custom-grey btn-custom mr-2">Back</a>
                        <a href="{{adminUrl('pelaksanaan/do-temuan/'.$data->id)}}?return_url={{fullUrl()}}" class="btn btn-grey font-white btn-custom">Next</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-md-flex">
                        <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
                            <?php $no = 1; ?>
                            @foreach($kelengkapan as $row)
                                <?php $n = $no++?>
                                <li class="nav-item"><a href="#tab-{{$row->id}}" onclick="doActive('{{$row->id}}')" class="nav-link {{$n == 1 ? "active" : "" }}" data-toggle="tab">Indikator {{$n}}</a></li>
                            @endforeach
                        </ul>

                        <div class="tab-content" style="flex: 1">
                            <input type="hidden" id="activeNow" value="{{$category_id}}">
                            <?php $no = 1; ?>
                            @foreach($kelengkapan as $row)
                                <?php $n = $no++?>
                                <div class="tab-pane fade {{$n == 1 ? "show active" : "" }}" id="tab-{{$row->id}}">
                                    <h3 class="card-title">{{$row->main_category}}</h3>
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr class="title-tr">
                                            <th>Kriteria</th>
                                            <th>Standar</th>
                                            <th>Capaian</th>
                                            <th class="text-center">Mark</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list-question">
                                        @foreach($row->question as $q)
                                            <tr>
                                                <td>{{$q->question}}</td>
                                                <td>
                                                    {{$q->keterangan}}
                                                </td>
                                                <td>
                                                    {{$q->capaian}}
                                                </td>
                                                <td class="text-center">
                                                    <button class="{{($q->answer_keterangan?'btn btn-light btn-custom-white btn-custom':'btn btn-grey font-white btn-custom')}}" onclick="doAnswert('{{$q->id}}','{{$q->question}}','{{$q->answer_keterangan}}','{{$q->keterangan}}','{{$q->answer_action}}','{{$q->capaian}}')">{{($q->answer_keterangan?'Edited':'Edit')}}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('bottom')
        <script>
            let active = '{{$category_id}}';
            function doActive(id) {
                active = id;
                doGenerate(id);
            }
            function doGenerate(id) {
                $.getJSON( "{{adminUrl('pelaksanaan/data-audit/'.$data->id)}}?template_id={{$template_id}}&type={{g("type")}}&category_id="+id, function( data ) {
                    let html = '';
                    let response = data.data.question;
                    $.each(response, function(i, item) {
                        let keterangan = response[i].keterangan;
                        let textEdit = 'Edit';
                        let textView = 'Nope';
                        let classEdit = 'btn btn-grey font-white btn-custom';
                        let classView = 'btn btn-grey font-white btn-custom';
                        let target = '';
                        let icon ='icon-cross';
                        if (response[i].answer_keterangan) {
                            keterangan = response[i].answer_keterangan;
                            textEdit = 'Edited';
                            textView = 'View';
                            classEdit = 'btn btn-light btn-custom-white btn-custom';
                            classView = 'btn btn-light btn-custom-white btn-custom';
                        }
                        if (response[i].answer_action === 'on') {
                            icon ='icon-check';
                        }
                        html +=
                            '<tr>' +
                            '<td>'+response[i].question+'</td>' +
                            '<td>'+response[i].keterangan+'</td>' +
                            '<td>'+response[i].capaian+'</td>' +
                            '<td class="text-center"> <button class="'+classView+'" onclick="doAnswert(`'+response[i].id+'`,`'+response[i].question+'`,`'+response[i].answer_keterangan+'`,`'+response[i].keterangan+'`,`'+response[i].answer_action+'`)">'+textEdit+'</button> </td> ' +
                            '</tr>'
                    });
                    $('#list-question').html(html);
                });
            }
            $(document).ready(function () {
                doGenerate('{{$category_id}}');
            })
            var InputsCheckboxesRadios = function () {
                // Switchery
                var _componentSwitchery = function() {
                    // Initialize multiple switches
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                };
                return {
                    initComponents: function() {
                        _componentSwitchery();
                    }
                }
            }();
            // Initialize module
            // ------------------------------
            document.addEventListener('DOMContentLoaded', function() {
                InputsCheckboxesRadios.initComponents();
            });
            function doAnswert(id,quest,newAnswer,ket,action,capaian) {
                $('#idQuestion').val(id);
                $('.textInfo').html(quest);
                $('.ketLama').html(ket);
                $('.ketNew').html(newAnswer);
                $('.textCapaian').html(capaian)
                let html = '';
                let icon = '<i class="icon-cross"></i>';
                if (action == 'on') {
                    icon = '<i class="icon-check"></i>';
                    html =
                        '<div class="form-check form-check-switchery">' +
                        '<label class="form-check-label">' +
                        '<input type="checkbox" name="action" id="checkbox" class="form-check-input-switchery" checked data-fouc>' +
                        '</label> ' +
                        '</div>'
                }else{
                    html =
                        '<div class="form-check form-check-switchery">' +
                        '<label class="form-check-label">' +
                        '<input type="checkbox" name="action" id="checkbox" class="form-check-input-switchery" data-fouc>' +
                        '</label> ' +
                        '</div>'
                }
                $('.icon').html(icon);
                $('#action').html(html);
                if (newAnswer == 'null' || newAnswer == '') {
                    $('#modalAnswer').modal('show');
                }else{
                    $('#modalUpdate').modal('show');
                }
                InputsCheckboxesRadios.initComponents();
            }
        </script>
    @endpush
    <!-- Basic modal -->
    <div id="modalAnswer" class="modal fade" tabindex="-1">
        <div class="modal-dialog" style="max-width:500px">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title"><b>Edit</b></h5>
                        <small>Silakan edit data poin terkait</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                @push('bottom')
                    <script>
                        $('#formEdit').on('submit',function (event) {
                            var form_data = new FormData($('form')[0]);
                            var form= $("#formEdit");
                            event.preventDefault();
                            $.ajax({
                                type: form.attr('method'),
                                url: form.attr('action'),
                                data: form_data,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    doGenerate(active);
                                    $('#modalAnswer').modal('toggle');
                                    $('#keterangan').val('');
                                }
                            });
                        })
                    </script>
                @endpush
                <form action="{{adminUrl('pelaksanaan/save-answer')}}" method="post" enctype="multipart/form-data" id="formEdit">
                    <div class="modal-body" style="padding: 0px;">
                        {{csrf_field()}}
                        <input type="hidden" name="audit_id" value="{{$audit->id}}">
                        <input type="hidden" name="id" value="" id="idQuestion">
                        <input type="hidden" name="edit" value="" id="editId">
                        <table class="table table-borderless">
                            <tr>
                                <td class="font-weight-bold" style="vertical-align: top">Kriteria</td>
                                <td class="textInfo"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="vertical-align: top">Capaian</td>
                                <td class="textCapaian"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="vertical-align: top">Action</td>
                                <td id="action">
                                    <div class="form-check form-check-switchery">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="action" id="checkbox" class="form-check-input-switchery" checked data-fouc>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="vertical-align: top">Keterangan</td>
                                <td>
                                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-custom-white btn-custom" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-grey font-white btn-custom">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <div id="modalUpdate" class="modal fade" tabindex="-1">
        <div class="modal-dialog" style="max-width:1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title"><b>Edited</b></h5>
                        <small>Berikut adalah rincian perubahan data dari poin terkait</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <td class="font-weight-bold">Kriteria</td>
                            <td colspan="2" class="textInfo"></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Capaian</td>
                            <td colspan="2" class="textCapaian"></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold"></td>
                            <td style="background:#F2F2F2 !important;width: 40%" class="font-weight-bold;">Before</td>
                            <td style="background:#F2F2F2 !important;width: 40%" class="font-weight-bold">After</td>
                        </tr>
                        <tr>
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold">Action</td>
                            <td><i class="icon-cross"></i></td>
                            <td class="icon"></td>
                        </tr>
                        <tr>
                            <td style="background:#F2F2F2 !important;" class="font-weight-bold">Keterangan</td>
                            <td class="ketLama"></td>
                            <td class="ketNew"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-custom-white btn-custom" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-grey font-white btn-custom" onclick="doAnswer()">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
    @push('bottom')
        <script>
            function doAnswer() {
                $('#modalUpdate').modal('toggle');
                $('#modalAnswer').modal('show');
            }
        </script>
    @endpush
@endsection

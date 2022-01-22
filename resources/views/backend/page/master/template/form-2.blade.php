@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <div>
                        <h5 class="card-title">Kelengkapan dokumen</h5>
                        <small>Step 2 of 3</small>
                    </div>
                    <div class="header-elements" style="margin-top: -20px;">
                        <a href="javascript:;" class="btn btn-xs btn-secondary border-2 ml-1" id="tambah-kelengkapan">Tambah Kelengkapan dokumen</a>
                        <a href="javascript:;" class="btn btn-xs btn-primary border-2 ml-1">Step Selanjutnya</a>
                    </div>
                </div>
                <div class="card-body">
                    {{csrf_field()}}
                    {!! returnUrl() !!}
                    <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                    <div id="empty" style="width: 100%;padding: 50px;border: 2px dotted #000;text-align: center;font-size: 20px;font-weight: bold;margin-bottom: 20px;">
                        Silahkan menambahkan kriteria
                    </div>
                    <div class="w-100 bg-grey mb-3">
                        <table class="table table-borderless" id="field-kelengkapan">

                        </table>
                    </div>
                    <div class="text-right">
                        <a href="{{adminUrl('template/add/step-3')}}/{{(isset($data) && $data->id?$data->id:"")}}?return_url={{request()->fullUrl()}}" class="btn btn-primary">Step Selanjutnya</a>
                    </div>
                </div>
            </div>
            <!-- /basic layout -->
        </div>
        <!-- Basic modal -->
        <div id="modal_default" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{adminUrl('template/add/kriteria')}}" method="post" enctype="multipart/form-data" id="saveKriteria">
                        {{csrf_field()}}
                        <input type="hidden" name="master_template" class="form-control" placeholder="master_template" value="{{(isset($data) && $data->id?$data->id:"")}}">
                        <div class="modal-body">
                            <input type="text" name="kriteria" class="form-control" id="kriteria">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-primary">Tambah Kriteria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /basic modal -->
    </div>
    @push('bottom')
        <script>
            $(document).ready(function () {
                doGenerateData();
            })
            $('#tambah-kelengkapan').on('click',function (){
                $('#modal_default').modal('show');
            });
            $('#saveKriteria').on('submit',async function (event) {
                var form= $("#saveKriteria");
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (data) {
                        if (data.status == 1) {
                            $('#modal_default').modal('hide');
                        }
                    }
                });
                doGenerateData();
                $('#kriteria').val('');
                event.preventDefault();
            });
            $(document).on('click', '.save-button', function(){
                let id = $(this).attr("data-id");
                let value = $('#input-for-'+id).val();
                let keterangan = $('#keterangan-for-'+id).val();
                $.getJSON( "{{adminUrl('template/add-question')}}?id="+id+"&value="+value+"&keterangan="+keterangan, function( data ) {
                    if (data.status == 1) {
                        doGenerateData();
                    }
                })
            });
            $(document).on('change', '.input-update', function(){
                var value = $(this).val();
                if (!value) {
                    swal("Kriteria perlu diisi terlebih dahulu");
                }
                var id = $(this).attr("data-id");
                let keterangan = $('#k-'+id).val();
                $.getJSON( "{{adminUrl('template/update-question')}}?id="+id+"&value="+value+"&keterangan="+keterangan, function( data ) {
                    if (data.status == 1) {
                        doGenerateData();
                    }
                })
            });
            $(document).on('change', '.keterangan-update', function(){
                var keterangan = $(this).val();
                var id = $(this).attr("data-id");
                let value = $('#q-'+id).val();
                $.getJSON( "{{adminUrl('template/update-question')}}?id="+id+"&value="+value+"&keterangan="+keterangan, function( data ) {
                    if (data.status == 1) {
                        doGenerateData();
                    }
                })
            });
            function deleteKriteria(id) {
                $.getJSON( "{{adminUrl('template/delete-kriteria')}}?id="+id, function( data ) {
                    if (data.status === 1) {
                        doGenerateData();
                    }
                })
            }
            function deleteKriteriaWithType(id) {
                $.getJSON( "{{adminUrl('template/delete-kriteria')}}?id="+id+'&type=quest', function( data ) {
                    if (data.status === 1) {
                        doGenerateData();
                    }
                })
            }
            async function doGenerateData() {
                $('#empty').hide();
                $('#field-kelengkapan').empty();
                var html = '';
                $.getJSON( "{{adminUrl('template/list-data')}}?id={{(isset($data) && $data->id?$data->id:'')}}", function( data ) {
                    let response = data.list;
                    $.each(response, function(i, item) {
                        var a = '<tr class="table-td"> ' +
                            '<td class="border-right-1"> ' +
                            '<input type="text" class="form-control" id="input-for-'+response[i].id+'"> ' +
                            '</td> ' +
                            '<td class="border-right-1"> ' +
                            '<input type="text" class="form-control" id="keterangan-for-'+response[i].id+'"> ' +
                            '</td> ' +
                            '<td class="text-center"> ' +
                            '<button type="button" class="btn btn-secondary btn-rounded btn-sm w-100 save-button" data-id="'+response[i].id+'">Add</button> ' +
                            '</td> ' +
                            '</tr> ';
                        let qa = response[i].question;
                        $.each(qa, function(l, k) {
                            let ket = '';
                            if (qa[l].keterangan !== null) {
                                ket = qa[l].keterangan;
                            }
                            a += '<tr class="table-td"> ' +
                                '<td class="border-right-1"> ' +
                                '<input type="text" class="form-control input-update" value="'+qa[l].question+'" id="q-'+qa[l].id+'" data-id="'+qa[l].id+'"> ' +
                                '</td> ' +
                                '<td class="border-right-1"> ' +
                                '<input type="text" class="form-control keterangan-update" value="'+ket+'" id="k-'+qa[l].id+'" data-id="'+qa[l].id+'"> ' +
                                '</td> ' +
                                '<td class="text-center"> ' +
                                '<button class="btn btn-light btn-rounded btn-white btn-sm"><i class="icon-chevron-down"></i></button> ' +
                                '<button class="btn btn-light btn-rounded btn-white btn-sm"><i class="icon-chevron-up"></i></button> ' +
                                '<button class="btn btn-light btn-rounded btn-white btn-sm" onclick="deleteKriteriaWithType('+qa[l].id+')"><i class="icon-trash"></i></button> ' +
                                '</td> ' +
                                '</tr> ';
                        })

                        html +=
                            '<thead>'+
                            '<tr>' +
                            '<td class="title-doc" colspan="2">'+response[i].main_category+'</td>' +
                            '<td class="text-center" style="width: 200px;"> ' +
                            '<button class="btn btn-light btn-rounded btn-white btn-sm"><i class="icon-chevron-down"></i></button> ' +
                            '<button class="btn btn-light btn-rounded btn-white btn-sm"><i class="icon-chevron-up"></i></button> ' +
                            '<button class="btn btn-light btn-rounded btn-white btn-sm" onclick="deleteKriteria('+response[i].id+')"><i class="icon-trash"></i></button> ' +
                            '</td> ' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody> ' +
                            '<tr class="title-tr"> ' +
                            '<td>Kriteria</td> ' +
                            '<td>Keterangan</td> ' +
                            '<td class="text-center">Action</td> ' +
                            '</tr> ' + a
                            '</tbody>';
                    })
                }).done(function (){
                    $('#field-kelengkapan').html(html);
                });
            }
        </script>
    @endpush
@endsection

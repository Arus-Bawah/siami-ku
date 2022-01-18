@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{adminUrl('penjadwalan/save')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {!! returnUrl() !!}
                        <input type="hidden" name="edit" value="{{$edit}}">
                        <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Audit template:</label>
                            <div class="col-lg-9">
                                <select data-placeholder="Pilih Audit Template" required name="template_code" id="template_code" class="form-control form-control-select2" data-fouc>
                                    <option value="">Pilih Audit template</option>
                                    @foreach($template as $row)
                                        <option value="{{$row->id}}"  {{(isset($data) && $data->id && $data->template_code == $row->id ?"selected":"")}} data-unit="{{$row->unit}}" data-unit="{{$row->unit}}" data-purpose="{{$row->purpose}}" data-audit_area="{{$row->audit_area}}" data-criteria="{{$row->criteria}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Fakultas:</label>
                            <div class="col-lg-9">
                                <select data-placeholder="Pilih Fakultas" required name="fakultas_id" id="fakultas_id" class="form-control form-control-select2" data-fouc>
                                    <option value="">Pilih Fakultas</option>
                                    @foreach($fakultas as $row)
                                        <option value="{{$row->id}}"  {{(isset($data) && $data->id && $data->fakultas_id == $row->id ?"selected":"")}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Unit Lembaga:</label>
                            <div class="col-lg-9">
                                <select required name="unit" id="unit" class="form-control">
                                    <option value="">Pilih Unit</option>
                                    <option value="Fakultas" {{(isset($data) && $data->id && $data->unit == 'Fakultas' ?"selected":"")}} >Fakultas</option>
                                    <option value="Progdi" {{(isset($data) && $data->id && $data->unit == 'Progdi' ?"selected":"")}}>Progdi</option>
                                    <option value="Lembaga" {{(isset($data) && $data->id && $data->unit == 'Lembaga' ?"selected":"")}}>Lembaga</option>
                                    <option value="Biro" {{(isset($data) && $data->id && $data->unit == 'Biro' ?"selected":"")}}>Biro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Siklus:</label>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="number" required name="siklus_number" value="{{(isset($data) && $data->id?$data->siklus_number:"")}}" placeholder="Nomor" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" required name="siklus_year" value="{{(isset($data) && $data->id?$data->siklus_year:"")}}" placeholder="Tahun" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tujuan:</label>
                            <div class="col-lg-9">
                                <input type="text" name="purpose" id="purpose" value="{{(isset($data) && $data->id?$data->purpose:"")}}" required class="form-control" placeholder="Tujuan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Lingkup Audit:</label>
                            <div class="col-lg-9">
                                <input type="text" name="audit_area" id="audit_area" value="{{(isset($data) && $data->id?$data->audit_area:"")}}" required class="form-control" placeholder="Lingkup Audit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kriteria :</label>
                            <div class="col-lg-9" id="kriteria">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-10">
                                        <input type="text" name="kriteria[]" class="form-control" placeholder="Kriteria" value="" id="kriteriafield">
                                    </div>
                                    <div class="col-lg-1 col-sm-2">
                                        <button class="btn btn-xs btn-secondary" type="button" id="addkriteria"><i class="icon-plus2"></i></button>
                                    </div>
                                </div>
                                @foreach($kriteria as $key => $value)
                                    <div class="row" id="K{{$key}}">
                                        <div class="col-lg-4 col-sm-10">
                                            <p class="form-control-plaintext" style="padding-left: 15px;"><input name="kriteria[]" style="display: none" value="{{$key}}">{{$value}}</p>
                                        </div>
                                        <div class="col-lg-1 col-sm-2">
                                            <button class="btn btn-xs btn-secondary delete-button" type="button" data-id="K{{$key}}"><i class="icon-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tanggal pelaksanaan:</label>
                            <div class="col-lg-9">
                                <div class="input-group">
										<span class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar22"></i></span>
										</span>
                                    <input type="text" class="form-control flatpickr" value="{{(isset($data) && $data->id?$data->audit_date:"")}}" name="audit_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Auditee:</label>
                            <div class="col-lg-9">
                                <select name="audit_by"  required class="form-control select" data-fouc style="width: 100%">
                                    <option value="">Pilih Auditee</option>
                                    @foreach($auditee as $row)
                                        <option value="{{$row->id}}" {{(isset($data) && $data->id && $data->audit_by == $row->id ?"selected":"")}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Ketua Auditor:</label>
                            <div class="col-lg-9">
                                <select name="audit_leader" required class="form-control select" data-fouc style="width: 100%">
                                    <option value="">Pilih Auditor</option>
                                    @foreach($auditor as $row)
                                        <option value="{{$row->id}}" {{(isset($data) && $data->id && $data->audit_leader == $row->id ?"selected":"")}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-lg-3 col-form-label">Anggota Auditor:</label>
                            <div class="col-lg-9">
                                <div id="field-dynamic">
                                    @foreach($anggota as $row)
                                        <div class="entry input-group mb-3">
                                            <input class="form-control" name="anggota[]" type="text" value="{{$row->name}}" placeholder="Anggota Auditor">
                                            <span class="input-group-btn">
                                                <button class="btn btn-remove btn-danger" type="button"><span class="icon-pen-plus"></span></button>
                                            </span>
                                        </div>
                                    @endforeach
                                    <div class="entry input-group mb-3">
                                        <input class="form-control" name="anggota[]" type="text" placeholder="Anggota Auditor" />
                                        <span class="input-group-btn">
                                        <button class="btn btn-success btn-add" type="button"><span class="icon-pen-plus"></span></button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tempat/lokasi:</label>
                            <div class="col-lg-9">
                                <input type="text" name="location" id="location" value="{{(isset($data) && $data->id ? $data->location:"")}}" required class="form-control" placeholder="Lokasi">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan Data <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /basic layout -->
        </div>
    </div>
    @push('bottom')
        <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
        <script src="{{asset('global_assets/js/demo_pages/form_select2.js')}}"></script>
        <script>
            $(document).on('change', '#template_code', function(){
                let val = $(this).val();
                let unit = $('#template_code').select2().find(":selected").data("unit");
                let purpose = $('#template_code').select2().find(":selected").data("purpose");
                let audit_area = $('#template_code').select2().find(":selected").data("audit_area");
                let criteria = $('#template_code').select2().find(":selected").data("criteria");


                $("#unit").val(unit);
                $("#purpose").val(purpose);
                $("#audit_area").val(audit_area);

                let html = '';
                $.each(criteria,function(key,value){
                    let id = key;
                    html +=
                        '<div class="row" id="K-'+id+'"> ' +
                            '<div class="col-lg-4 col-sm-10"> ' +
                                '<p class="form-control-plaintext" style="padding-left: 15px;"><input name="kriteria[]" style="display: none" value="'+id+'">'+value+'</p> ' +
                            '</div> ' +
                            '<div class="col-lg-1 col-sm-2"> ' +
                                '<button class="btn btn-xs btn-secondary delete-button" type="button" data-id="K-'+id+'"><i class="icon-trash"></i></button> ' +
                            '</div> ' +
                        '</div>'
                });
                $('#kriteria').append(html);
            })
        </script>
        <script>
            $(function()
            {
                $(document).on('click', '.btn-add', function(e)
                {
                    e.preventDefault();

                    var controlForm = $('#field-dynamic:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).appendTo(controlForm);

                    newEntry.find('input').val('');
                    controlForm.find('.entry:not(:last) .btn-add')
                        .removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="icon-pen-plus"></span>');
                }).on('click', '.btn-remove', function(e)
                {
                    $(this).parents('.entry:first').remove();

                    e.preventDefault();
                    return false;
                });
            });
        </script>
        <script>
            $('#addkriteria').on('click',function () {
                var kriteria = $('#kriteriafield').val();
                if (kriteria.length == 0) {
                    swal("Kriteria perlu diisi terlebih dahulu");
                    return false;
                }
                let random = Math.floor((Math.random() * 9999) + 1);
                let html = '<div class="row" id="'+random+'">'+
                    '<div class="col-lg-4 col-sm-10">'+
                    '<p class="form-control-plaintext" style="padding-left: 15px;"><input name="kriteria[]" style="display: none" value="'+kriteria+'">'+kriteria+'</p>'+
                    '</div>'+
                    '<div class="col-lg-1 col-sm-2">'+
                    '<button class="btn btn-xs btn-secondary delete-button" type="button" data-id="'+random+'"><i class="icon-trash"></i></button>'+
                    '</div>'+
                    '</div>';
                $('#kriteria').append(html);
                $('#kriteriafield').val("");
            })
            $(document).on('click', '.delete-button', function () {
                let id = $(this).attr("data-id");
                $('#'+id).remove();
            });
        </script>
    @endpush
@endsection

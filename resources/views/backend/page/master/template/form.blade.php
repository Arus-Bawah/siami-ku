@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Identitas</h5>
                    <small>Step 1 of 3</small>
                </div>
                <div class="card-body">
                    <form action="{{adminUrl('template/save')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {!! returnUrl() !!}
                        <input type="hidden" name="return_url" value="{{request()->fullUrl()}}">
                        <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Template:</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" placeholder="Nama Template" value="{{(isset($data) && $data->id?$data->name:"")}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Unit:</label>
                            <div class="col-lg-3">
                                <select data-placeholder="Pilih Unit" required name="unit" class="form-control form-control-select2" data-fouc>
                                    <option value="">Pilih Unit</option>
                                    <option value="Fakultas" {{isset($data) && $data->unit == 'Fakultas'?'selected':''}}>Fakultas</option>
                                    <option value="Progdi" {{isset($data) && $data->unit == 'Progdi'?'selected':''}}>Progdi</option>
                                    <option value="Lembaga" {{isset($data) && $data->unit == 'Lembaga'?'selected':''}}>Lembaga</option>
                                    <option value="Biro" {{isset($data) && $data->unit == 'Biro'?'selected':''}}>Biro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tujuan :</label>
                            <div class="col-lg-3 col-sm-12">
                                <input type="text" name="purpose" class="form-control" placeholder="Tujuan" value="{{(isset($data) && $data->purpose?$data->purpose:"")}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Lingkup :</label>
                            <div class="col-lg-3 col-sm-12">
                                <input type="text" name="audit_area" class="form-control" placeholder="Tujuan" value="{{(isset($data) && $data->audit_area?$data->audit_area:"")}}">
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
                                            <p class="form-control-plaintext" style="padding-left: 15px;"><input name="kriteria[]" style="display: none" value="{{$value}}">{{$value}}</p>
                                        </div>
                                        <div class="col-lg-1 col-sm-2">
                                            <button class="btn btn-xs btn-secondary delete-button" type="button" data-id="K{{$key}}"><i class="icon-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan Template</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /basic layout -->
        </div>
    </div>
    @push('bottom')
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

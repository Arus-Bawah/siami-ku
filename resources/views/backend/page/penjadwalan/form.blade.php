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
                            <label class="col-lg-3 col-form-label">No Pelaksanaan:</label>
                            <div class="col-lg-9">
                                <input type="text" name="code" value="{{(isset($data) && $data->id?$data->name:"")}}" class="form-control" placeholder="No Pelaksanaan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Laporan:</label>
                            <div class="col-lg-9">
                                <select data-placeholder="Pilih Laporan Pelaksanaan" required name="audit_id" class="form-control form-control-select2" data-fouc>
                                    <option value="">Pilih Laporan Pelaksanaan</option>
                                    @foreach($audit as $row)
                                        <option value="{{$row->id}}" {{(isset($data) && $data->id && $data->fakultas_id == $row->id ?"selected":"")}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Unit Lembaga:</label>
                            <div class="col-lg-9">
                                <select data-placeholder="Pilih Unit Lembaga" required name="unit" class="form-control form-control-select2" data-fouc>
                                    <option value="">Pilih Unit</option>
                                    <option value="Fakultas">Fakultas</option>
                                    <option value="Progdi">Progdi</option>
                                    <option value="Lembaga">Lembaga</option>
                                    <option value="Biro">Biro</option>
                                </select>
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
    @endpush
@endsection

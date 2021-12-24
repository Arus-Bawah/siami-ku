@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{adminUrl('progdi/save')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {!! returnUrl() !!}
                        <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Fakultas:</label>
                            <div class="col-lg-9">
                                <select data-placeholder="Pilih Fakultas" name="fakultas" class="form-control form-control-select2" data-fouc>
                                    <option value="">Pilih Fakultas</option>
                                    @foreach($fakultas as $row)
                                        <option value="{{$row->id}}" {{(isset($data) && $data->fakultas_id && $data->fakultas_id == $row->id? "selected":"")}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name:</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{(isset($data) && $data->id?$data->name:"")}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jenjang:</label>
                            <div class="col-lg-9">
                                <input type="text" name="jenjang" class="form-control" placeholder="Jenjang" value="{{(isset($data) && $data->id?$data->jenjang:"")}}">
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
@endsection

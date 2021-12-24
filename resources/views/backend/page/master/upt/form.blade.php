@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{adminUrl('upt/save')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {!! returnUrl() !!}
                        <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama UPT:</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" placeholder="Nama UPT" value="{{(isset($data) && $data->id?$data->name:"")}}">
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

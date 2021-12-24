@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{adminUrl('users-admin/save-profile/')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                {{csrf_field()}}
                                {!! returnUrl() !!}
                                <input type="hidden" name="id" class="form-control" placeholder="id" value="{{(isset($data) && $data->id?$data->id:"")}}">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Name:</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{(isset($data) && $data->name?$data->name:"")}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Email:</label>
                                    <div class="col-lg-9">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{(isset($data) && $data->email?$data->email:"")}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Password:</label>
                                    <div class="col-lg-9">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Photo:</label>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                @if(isset($data) && $data->foto )
                                                    <div class="box-photo" id="photo-field" style="background-image: url('{{asset($data->foto)}}')">

                                                    </div>
                                                @else
                                                    <div class="box-photo" id="photo-field">

                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8">
                                                <label for="photo" class="browse">
                                                    Browse
                                                    <input type="file" name="photo" id="photo" class="form-control-file" placeholder="photo" style="display: none" accept="image/*">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script>
            $('#signature').on('change',function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onloadend = function () {
                    $('#signature-field').css('background-image', 'url("' + reader.result + '")');
                }
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                }
            })
            $('#photo').on('change',function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onloadend = function () {
                    $('#photo-field').css('background-image', 'url("' + reader.result + '")');
                }
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                }
            })
        </script>
    @endpush
@endsection

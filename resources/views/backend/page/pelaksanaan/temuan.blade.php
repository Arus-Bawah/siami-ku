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
                        <h5 class="card-title" style="font-size: 24px;">Daftar temuan</h5>
                        <small>Step 3 of 4</small>
                    </div>
                    <div class="header-elements" style="margin-top: -20px;">
                        <a href="{{adminUrl('pelaksanaan/do-audit/'.$data->id)}}?type=capaian&return_url={{fullUrl()}}" class="btn btn-grey font-white btn-custom">Next</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <td style="background: #F2F2F2;width: 200px;">Jenis temuan</td>
                            <td style="background: #F2F2F2">Referensi</td>
                            <td style="background: #F2F2F2">Pernyataan</td>
                            <td style="background: #F2F2F2;width: 150px;">Attachment</td>
                            <td style="background: #F2F2F2" class="text-center">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="">
                            <tr>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Positif">Positif</option>
                                        <option value="Observasi">Observasi</option>
                                        <option value="Minor">Minor</option>
                                        <option value="Mayor">Mayor</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <label for="fileUpload" class="btn btn-light btn-custom-white btn-custom">
                                        Upload
                                        <input type="file" name="" id="fileUpload" style="display: none">
                                    </label>
                                </td>
                                <td class="text-center">
                                    <button type="submit" class="btn btn-secondary btn-rounded btn-sm w-100 save-button">Add</button>
                                </td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

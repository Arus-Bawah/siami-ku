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
                    <h5 class="card-title">{{$data->name}}</h5>
                    <div class="header-elements">
                        <button class="btn btn-grey btn-custom-grey btn-custom mr-2">Download</button>
                        <a href="{{adminUrl('pelaksanaan/do-audit/'.$data->id)}}?return_url={{fullUrl()}}" class="btn btn-grey font-white btn-custom">Start audit</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Fakultas</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->fakultas}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Tujuan</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->purpose}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Lingkup audit</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->audit_area}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Auditee</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->audit_by}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Ketua auditor</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->audit_leader}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Anggota auditor</label>
                        <div class="col-lg-10">
                            @foreach($anggota as $row)
                                <p class="form-control-plaintext mb-0">{{$row->name}}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Sikut</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->siklus_number}} / {{$data->siklus_year}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /basic layout -->
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Laporan yang dikerjakan</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Tugas Pelaksanaan</th>
                            <th class="text-right">Status</th>
                        </tr>
                        <tr>
                            <td>Pengecekan kelengkapan dokumen</td>
                            <td class="text-right">Uncompleted</td>
                        </tr>
                        <tr>
                            <td>Capaian standar</td>
                            <td class="text-right">Uncompleted</td>
                        </tr>
                        <tr>
                            <td>Daftar temuan</td>
                            <td class="text-right">Uncompleted</td>
                        </tr>
                        <tr>
                            <td>Rekomendasi perbaikan</td>
                            <td class="text-right">Uncompleted</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Hasil Laporan</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Tugas Pelaksanaan</th>
                            <th colspan="2" class="text-center">Ketercapaian</th>
                        </tr>
                        <tr>
                            <td>Pengecekan kelengkapan dokumen</td>
                            <td class="text-right">75/26</td>
                            <td class="text-right">(74,26%)</td>
                        </tr>
                        <tr>
                            <td>Capaian standar</td>
                            <td class="text-right">15/20</td>
                            <td class="text-right">(75%)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                <div class="card-header">
                    <h5 class="card-title">{{$data->name}}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Unit</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->unit}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Sikut</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->siklus_number}} /{{$data->siklus_year}}</p>
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
                        <label class="col-lg-2 col-form-label mb-0">Kriteria audit</label>
                        <div class="col-lg-10">
                            @foreach($kriteria as $row)
                                <p class="form-control-plaintext mb-0">{{$row}}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-lg-2 col-form-label mb-0">Tanggal Pelaksanaan</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->audit_date}}</p>
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
                        <label class="col-lg-2 col-form-label mb-0">Tempat/lokasi</label>
                        <div class="col-lg-10">
                            <p class="form-control-plaintext mb-0">{{$data->location}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /basic layout -->
        </div>

        <div class="col-sm-12">
            <div class="card">
                <ul class="nav nav-tabs" style="background: #EAEAEA;">
                    <li class="nav-item"><a href="{{adminUrl('penjadwalan/detail/'.$data->id)}}?type=kelengkapan&return_url={{g('return_url')}}" class="nav-link custom {{(g('type') != 'capaian' ?'active':'')}}">Pengecekan kelengkapan dokumen</a></li>
                    <li class="nav-item"><a href="{{adminUrl('penjadwalan/detail/'.$data->id)}}?type=capaian&return_url={{g('return_url')}}" class="nav-link custom {{(g('type') == 'capaian' ?'active':'')}}">Capaian standar</a></li>
                </ul>
                <div class="card-body">
                    <div class="d-md-flex">
                        <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0">
                            <?php $no = 1; ?>
                            @foreach($kelengkapan as $row)
                                <?php $n = $no++?>
                                <li class="nav-item"><a href="#tab-{{$row->id}}" class="nav-link {{$n == 1 ? "active" : "" }}" data-toggle="tab">Kritria {{$n}}</a></li>
                            @endforeach
                        </ul>

                        <div class="tab-content" style="flex: 1">
                            <?php $no = 1; ?>
                            @foreach($kelengkapan as $row)
                                <?php $n = $no++?>
                                @if(g('type') == 'capaian')
                                    <div class="tab-pane fade {{$n == 1 ? "show active" : "" }}" id="tab-{{$row->id}}">
                                        <h3 class="card-title">{{$row->main_category}}</h3>
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr class="title-tr">
                                                <th>Kriteria</th>
                                                <th>Standard</th>
                                                <th>Capaian</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($row->question as $q)
                                                <tr>
                                                    <td>{{$q->question}}</td>
                                                    <td>{{$q->keterangan}}</td>
                                                    <td>{{$q->capaian}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="tab-pane fade {{$n == 1 ? "show active" : "" }}" id="tab-{{$row->id}}">
                                        <h3 class="card-title">{{$row->main_category}}</h3>
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr class="title-tr">
                                                <th>Kriteria</th>
                                                <th>Keterangan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($row->question as $q)
                                                <tr>
                                                    <td>{{$q->question}}</td>
                                                    <td>{{$q->keterangan}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('bottom')

    @endpush
@endsection

<!-- Dokumen -->
<div class="col-lg-6">
    <fieldset>
        <legend class="font-weight-semibold">
            <i class="icon-file-text mr-2"></i> Kelengkapan Dokumen
        </legend>
        <div class="card-group-control card-group-control-left" id="accordion-control">
            <div v-for="(row, i) in form.dokumen" class="card mb-0">
                <div class="card-header">
                    <h6 class="card-title">
                        <a data-toggle="collapse" class="text-default collapsed" :href="`#documentGroup${i}`">
                            Kriteria #@{{ i + 1 }}
                        </a>
                    </h6>
                </div>

                <div :id="`documentGroup${i}`" class="collapse" data-parent="#accordion-control">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <a data-toggle="collapse" class="collapsed text-default col-form-label col-lg-2" href="#dokumenGroup1">
                                Standar <span class="text-danger">*</span>
                            </a>
                            <div class="col-lg-10 d-flex">
                                <input type="text" class="form-control" placeholder="Visi Misi Tujuan dan Sasaran...">
                                <a href="javascript:void(0)" class="ml-2 btn btn-warning btn-icon btn-sm">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kriteria <span class="text-danger">*</span></th>
                                    <th>Nama Dokumen <span class="text-danger">*</span></th>
                                    <th class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-icon btn-sm">
                                            <i class="icon-plus2"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea type="text" class="form-control" required placeholder="Penyusunan Visi dan Misi.." rows="3"></textarea>
                                    </td>
                                    <td>
                                        <textarea type="text" class="form-control" required placeholder="Dokumen Visi & Misi..." rows="3"></textarea>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-warning btn-icon btn-sm">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
<!-- ./ Dokumen -->

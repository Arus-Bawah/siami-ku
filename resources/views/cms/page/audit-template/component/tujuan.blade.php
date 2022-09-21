<!-- Tujuan -->
<div class="col-lg-4 mb-3">
    <fieldset>
        <legend class="font-weight-semibold"><i class="icon-target mr-2"></i> Tujuan</legend>
        <div class="form-group mb-0">
            <label>Masukan Tujuan <span class="text-danger">*</span> :</label>
        </div>
        <div class="form-group d-flex" v-for="(tujuan, i) in form.information.tujuan">
            <input type="text" name="tujuan[]" class="form-control" required placeholder="Pengecekan Kelengkapan..." v-model="tujuan.value"
                :key="i">
            <a v-if="i === 0" href="javascript:void(0)" class="ml-2 btn btn-primary btn-icon btn-sm" @click=addTujuan>
                <i class="icon-plus2"></i>
            </a>
            <a v-if="i > 0" href="javascript:void(0)" class="ml-2 btn btn-warning btn-icon btn-sm" @click=removeTujuan(i)>
                <i class="icon-trash"></i>
            </a>
        </div>
    </fieldset>
</div><!-- ./ Tujuan -->

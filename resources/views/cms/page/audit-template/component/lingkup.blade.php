<!-- Lingkup -->
<div class="col-lg-4 mb-3">
    <fieldset>
        <legend class="font-weight-semibold"><i class="icon-list mr-2"></i> Lingkup</legend>
        <div class="form-group mb-0">
            <label>Masukan Lingkup <span class="text-danger">*</span> :</label>
        </div>
        <div class="form-group d-flex" v-for="(lingkup, i) in form.information.lingkup">
            <input type="text" name="lingkup[]" class="form-control" required placeholder="Standar Kompetensi Lulusan..." v-model="lingkup.value"
                :key="i">
            <a v-if="i === 0" href="javascript:void(0)" class="ml-2 btn btn-primary btn-icon btn-sm" @click=addLingkup>
                <i class="icon-plus2"></i>
            </a>
            <a v-if="i > 0" href="javascript:void(0)" class="ml-2 btn btn-warning btn-icon btn-sm" @click=removeLingkup(i)>
                <i class="icon-trash"></i>
            </a>
        </div>
    </fieldset>
</div><!-- ./ Lingkup -->

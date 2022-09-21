<!-- Information -->
<div class="col-lg-12 mb-3">
    <fieldset>
        <legend class="font-weight-semibold">
            <i class="icon-book mr-2"></i> Template Details
        </legend>

        <div class="form-group">
            <label>Nama Template <span class="text-danger">*</span> :</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Template Audit TI-D3 {{ date('Y') }}" required
                v-model="form.information.name">
        </div>

        <div class="form-group">
            <label>Tipe <span class="text-danger">*</span> :</label>
            <select name="tipe_id" id="tipe_id" class="form-control" required @change=changeTipe v-model="form.information.tipe_id">
                <option value="" disabled>Please select tipe</option>
                <template v-for="(tipe, i) in master.unit">
                    <option :value="tipe.id">@{{ tipe.tipe }}</option>
                </template>
            </select>
        </div>

        <!-- Handling if prodi (tipe 1 = fakultas, tipe 2 = prodi) -->
        <template v-if="form.information.tipe_id === 2">
            <div class="form-group">
                <label>Fakultas <span class="text-danger">*</span> :</label>
                <select name="fakultas_id" id="fakultas_id" class="form-control" required v-model="form.information.fakultas_id">
                    <option value="" disabled>Please select fakultas</option>
                    <template v-for="(tipe, i) in master.unit" @change=changeFakultas>
                        <template v-if="tipe.id === 1" v-for="(unit, j) in tipe.unit">
                            <option :value="unit.id">@{{ unit.unit }}</option>
                        </template>
                    </template>
                </select>
            </div>

            <div class="form-group">
                <label>Prodi <span class="text-danger">*</span> :</label>
                <select name="unit_id" id="unit_id" class="form-control" required v-model="form.information.unit_id">
                    <option value="" disabled>Please select prodi</option>
                    <template v-for="(tipe, i) in master.unit">
                        <template v-if="tipe.id === 2" v-for="(unit, j) in tipe.unit">
                            <option v-if="unit.master_unit_parent_id === form.information.fakultas_id" :value="unit.id" @change=changeUnit>
                                @{{ unit.unit }}
                            </option>
                        </template>
                    </template>
                </select>
            </div>

            <div class="form-group">
                <label>Jenjang <span class="text-danger">*</span> :</label>
                <select name="jenjang_id" id="jenjang_id" class="form-control" required v-model="form.information.jenjang_id">
                    <option value="" disabled>Please select jenjang</option>
                    <template v-for="(tipe, i) in master.unit">
                        <template v-if="tipe.id === 2" v-for="(unit, j) in tipe.master_unit">
                            <template v-if="unit.id === form.information.unit_id" v-for="(jenjang, k) in unit.jenjang">
                                <option :value="jenjang.id">
                                    @{{ jenjang.master_jenjang.jenjang }}
                                </option>
                            </template>
                        </template>
                    </template>
                </select>
            </div>
        </template>

        <template v-if="form.information.tipe_id !== 2">
            <div class="form-group">
                <label>Unit <span class="text-danger">*</span> :</label>
                <select name="unit_id" id="unit_id" class="form-control" required v-model="form.information.unit_id" @change=changeUnit>
                    <option value="" disabled>Please select unit</option>
                    <template v-for="(tipe, i) in master.unit">
                        <template v-if="tipe.id == form.information.tipe_id" v-for="(unit, j) in tipe.unit">
                            <option :value="unit.id">@{{ unit.unit }}</option>
                        </template>
                    </template>
                </select>
            </div>
        </template>
    </fieldset>
</div> <!-- ./ Information -->

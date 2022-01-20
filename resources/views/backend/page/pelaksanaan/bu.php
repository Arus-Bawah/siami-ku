<div class="row">
    <div class="col-sm-6">
        <table class="table table-responsive table-borderless">
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Kriteria</td>
                <td class="textInfo"></td>
            </tr>
            @if(session()->get('users_privileges') == 'Auditee')
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">File</td>
                <td>
                    <input type="file" name="file" class="form-control-file">
                </td>
            </tr>
            @endif
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Action</td>
                <td>
                    <div class="form-check form-check-switchery">
                        <label class="form-check-label">
                            <input type="checkbox" name="action" id="checkbox" class="form-check-input-switchery" data-fouc>
                        </label>
                    </div>
                </td>
            </tr>
            @if(session()->get('users_privileges') == 'Auditee')
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Keterangan</td>
                <td>
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
                </td>
            </tr>
            @else
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Keterangan</td>
                <td class="ketBef"></td>
            </tr>
            @endif
        </table>
    </div>
    <div class="col-sm-6">
        <table class="table table-responsive table-borderless">
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Kriteria</td>
                <td class="textInfo"></td>
            </tr>
            @if(session()->get('users_privileges') == 'Auditee')
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">File</td>
                <td>
                    <input type="file" name="file" class="form-control-file">
                </td>
            </tr>
            @endif
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Action</td>
                <td>
                    <div class="form-check form-check-switchery">
                        <label class="form-check-label">
                            <input type="checkbox" name="action" id="checkbox" class="form-check-input-switchery" data-fouc>
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold" style="vertical-align: top">Keterangan</td>
                <td>
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
                </td>
            </tr>
        </table>
    </div>
</div>

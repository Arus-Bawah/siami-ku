<div class="form-group row">
    <label class="col-lg-3 col-form-label">Name:</label>
    <div class="col-lg-9">
        <input type="text" class="form-control" placeholder="Eugene Kopyov">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 col-form-label">Password:</label>
    <div class="col-lg-9">
        <input type="password" class="form-control" placeholder="Your strong password">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 col-form-label">Your state:</label>
    <div class="col-lg-9">
        <select class="form-control form-control-select2" data-fouc>
            <optgroup label="Alaskan/Hawaiian Time Zone">
                <option value="AK">Alaska</option>
                <option value="HI">Hawaii</option>
            </optgroup>
            <optgroup label="Pacific Time Zone">
                <option value="CA">California</option>
                <option value="NV">Nevada</option>
                <option value="WA">Washington</option>
            </optgroup>
            <optgroup label="Mountain Time Zone">
                <option value="AZ">Arizona</option>
                <option value="CO">Colorado</option>
                <option value="WY">Wyoming</option>
            </optgroup>
            <optgroup label="Central Time Zone">
                <option value="AL">Alabama</option>
                <option value="AR">Arkansas</option>
                <option value="KY">Kentucky</option>
            </optgroup>
            <optgroup label="Eastern Time Zone">
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="FL">Florida</option>
            </optgroup>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 col-form-label">Gender:</label>
    <div class="col-lg-9">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-input-styled" name="gender" checked data-fouc>
                Male
            </label>
        </div>

        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-input-styled" name="gender" data-fouc>
                Female
            </label>
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 col-form-label">Your avatar:</label>
    <div class="col-lg-9">
        <input type="file" class="form-input-styled" data-fouc>
        <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 col-form-label">Tags:</label>
    <div class="col-lg-9">
        <select multiple="multiple" data-placeholder="Enter tags" class="form-control form-control-select2-icons" data-fouc>
            <optgroup label="Services">
                <option value="wordpress2" data-icon="wordpress2">Wordpress</option>
                <option value="tumblr2" data-icon="tumblr2">Tumblr</option>
                <option value="stumbleupon" data-icon="stumbleupon">Stumble upon</option>
                <option value="pinterest2" data-icon="pinterest2">Pinterest</option>
                <option value="lastfm2" data-icon="lastfm2">Lastfm</option>
            </optgroup>
            <optgroup label="File types">
                <option value="pdf" data-icon="file-pdf">PDF</option>
                <option value="word" data-icon="file-word">Word</option>
                <option value="excel" data-icon="file-excel">Excel</option>
                <option value="openoffice" data-icon="file-openoffice">Open office</option>
            </optgroup>
            <optgroup label="Browsers">
                <option value="chrome" data-icon="chrome" selected>Chrome</option>
                <option value="firefox" data-icon="firefox" selected>Firefox</option>
                <option value="safari" data-icon="safari">Safari</option>
                <option value="opera" data-icon="opera">Opera</option>
                <option value="IE" data-icon="IE">IE</option>
            </optgroup>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 col-form-label">Your message:</label>
    <div class="col-lg-9">
        <textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
    </div>
</div>

<div class="text-right">
    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
</div>

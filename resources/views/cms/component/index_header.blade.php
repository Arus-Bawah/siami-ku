<div class="card-header header-elements-inline">
    <div class="float-left">
        @if ($show['search'])
            <form method="GET" action="{{ url(request()->path()) }}">
                <div class="input-group">
                    <input type="search" name="search" class="form-control input-sm float-right" placeholder="Search"
                        value="{{ $search }}">
                    @if ($search == '')
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default ml-1">
                                <i class="icon-search4"></i>
                            </button>
                        </div>
                    @else
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary ml-1">
                                <i class="icon-search4"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <!-- Other input hidden parameter -->
                @foreach ($query as $key => $value)
                    @if ($key == 'filter')
                        @continue
                    @elseif ($key == 'page')
                        <input type="hidden" name="{{ $key }}" value="1">
                    @elseif ($key !== 'search' && $value != '')
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
        @endif
    </div>

    <div class="float-right">
        <div class="input-group">
            @if ($show['filter'])
                <div class="input-group-btn">
                    @if (count($filter) === 0 || empty(array_filter($filter)))
                        <button type="button" class="btn btn-default mr-1" data-toggle="modal"
                            data-target="#indexFilter">
                            Filter <i class="icon-filter4"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-primary mr-1" data-toggle="modal"
                            data-target="#indexFilter">
                            Filter <i class="icon-filter3"></i>
                        </button>
                    @endif
                </div>
            @endif

            @if ($show['limit'])
                <form method="get" id="formLimit" action="{{ url(request()->path()) }}">
                    <div class="input-group">
                        <select onchange="document.getElementById('formLimit').submit()" name="limit"
                            class="form-control input-sm">
                            <option {{ $limit == 5 ? 'selected' : '' }} value="5">5</option>
                            <option {{ $limit == 10 ? 'selected' : '' }} value="10">10</option>
                            <option {{ $limit == '' || $limit == 20 ? 'selected' : '' }} value="20">20</option>
                            <option {{ $limit == 25 ? 'selected' : '' }} value="25">25</option>
                            <option {{ $limit == 50 ? 'selected' : '' }} value="50">50</option>
                            <option {{ $limit == 100 ? 'selected' : '' }} value="100">100</option>
                            <option {{ $limit == 200 ? 'selected' : '' }} value="200">200</option>
                        </select>
                    </div>
                    <!-- Other input hidden parameter -->
                    @foreach ($query as $key => $value)
                        @if ($key == 'filter')
                            @continue
                        @elseif ($key == 'page')
                            <input type="hidden" name="{{ $key }}" value="1">
                        @elseif ($key !== 'limit' && $value != '')
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                </form>
            @endif
        </div>
    </div>
</div>

@if ($show['filter'])
    @include('cms.component.index_filter', [
        'filter' => $filter,
        'filter_form' => $filter_form,
    ])
@endif

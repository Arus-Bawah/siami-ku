<div class="modal fade" id="indexFilter" tabindex="-1" role="dialog" aria-labelledby="indexFilterLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formIndexFilter" class="modal-content" method="GET" enctype="multipart/form-data"
            action="{{ request()->url() }}">
            <div class="modal-header">
                <h5 class="modal-title">Filter Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($filter_form as $key => $row)
                    @if (!isset($row['label']) || !isset($row['type']))
                        @continue
                    @endif
                    @switch($row['type'])
                        @case('text')
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">{{ $row['label'] }}:</label>
                                <input type="text" name="filter[{{ $key }}]" id="filter{{ ucwords($key) }}"
                                    class="form-control" value="{{ isset($filter[$key]) ? $filter[$key] : '' }}">
                            </div>
                        @break

                        @case('select')
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">{{ $row['label'] }}:</label>
                                <select name="filter[{{ $key }}]" id="filter{{ ucwords($key) }}"
                                    class="form-control">
                                    <option value="">Please Select {{ $row['label'] }}</option>
                                    @foreach ($row['data'] as $xrow)
                                        <option value="{{ $xrow->id }}"
                                            {{ isset($filter[$key]) && $filter[$key] == $xrow->id ? 'selected' : '' }}>
                                            {{ $xrow->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @break

                        @default
                            <div class="form-group">
                                Invalid Form Type
                            </div>
                    @endswitch
                @endforeach

                @foreach ($query as $key => $value)
                    @if ($key == 'filter')
                        @continue
                    @elseif ($key == 'page')
                        <input type="hidden" name="{{ $key }}" value="1">
                    @elseif ($key !== 'limit' && $value != '')
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{ request()->url() }}" class="btn btn-info">Reset</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

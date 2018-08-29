@if ($sortBy == $column)
    @if ($direction == 'desc')
        <th>
            <a href="{{ $data->url($data->currentPage()) }}&sort_by={{ $column }}&direction=asc" class="btn btn-light">
                <i class="material-icons">
                    arrow_drop_up
                </i>
                {{ $display }}
            </a>
        </th>
    @else
        <th>
            <a href="{{ $data->url($data->currentPage()) }}&sort_by={{ $column }}&direction=desc" class="btn btn-light">
                <i class="material-icons">
                    arrow_drop_down
                </i>
                {{ $display }}
            </a>
        </th>
    @endif
@else
    <th>
        <a href="{{ $data->url($data->currentPage()) }}&sort_by={{ $column }}" class="btn btn-light">
            {{ $display }}
        </a>
    </th>
@endif

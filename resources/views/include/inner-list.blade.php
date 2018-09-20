@if (count($data) == 0)
    <thead>
        <tr>
            <td>There are no records</td>
        </tr>
    </thead>
@else
    <thead>
        <tr>
            @foreach ($columns as $key => $val)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $row)
        <tr class="row-link {{ $row->trashed() ? 'table-danger' : '' }}" data-href="{{ url($resource . '/' . $row->id) }}">
            @foreach ($columns as $key => $val)
                <td>{{ $row[$val] }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
@endif

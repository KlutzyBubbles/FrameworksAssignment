<input type="hidden" name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }} value="{{ old($name, $default) }}"/>

<select name="{{ $name }}_f" id="{{ $name }}_f" data-ref="#{{ $name }}" class="select-change custom-select form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" {{ $required ? 'required' : '' }}>
    @foreach ($data as $row)
        <option {{ old($name, $default) == $row->id ? 'selected="selected"' : '' }}value="{{ $row->id }}">{{ $row->id }} - {{ $row[$display] }}</option>
    @endforeach
</select>
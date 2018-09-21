<label for="page-size">Page Size</label>
<select id="page-size" class="size-selector custom-select">
    @if ($size != 5 && $size != 10 && $size != 25 && $size != 50)
        <option value="{{ $size }}" selected="selected">{{ $size }}</option>
    @endif
    @if ($size == 5)
        <option value="5" selected="selected">5</option>
    @else
        <option value="5">5</option>
    @endif
    @if ($size == 10)
        <option value="10" selected="selected">10</option>
    @else
        <option value="10">10</option>
    @endif
    @if ($size == 25)
        <option value="25" selected="selected">25</option>
    @else
        <option value="25">25</option>
    @endif
    @if ($size == 50)
        <option value="50" selected="selected">50</option>
    @else
        <option value="50">50</option>
    @endif
</select>

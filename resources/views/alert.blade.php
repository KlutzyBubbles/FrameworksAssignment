@if (empty($type))
    @php
        $type = 'info';
   @endphp
@endif
@if (empty($dismiss))
    @php
        $dismiss = false;
    @endphp
@endif
@if ($dismiss == true)
    <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
        {{ $slot }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@else
    <div class="alert alert-{{ $type }}" role="alert">
        {{ $slot }}
    </div>
@endif

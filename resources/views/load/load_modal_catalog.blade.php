@if ($count == 0)
    <center>Stock Belum Ada</center>
@else
    @foreach ($data as $data)
        @if ($data->qty != '0')
            <div class="col-3">
                <input type="radio" id="size_select{{ $data->id }}" name="mdl_size" data-qty="{{ $data->qty }}"
                    value="{{ $data->size }}">
                <label class="border-theme p-0 pt-2 pb-2" for="size_select{{ $data->id }}"
                    style="cursor: pointer;">{{ $data->size }}={{ $data->qty }}</label>
            </div>
        @else
            <div class="col-3">
                <input type="radio" id="size_select{{ $data->id }}" name="mdl_size" data-qty="{{ $data->qty }}"
                    value="{{ $data->size }}" disabled>
                <label class="border-default text-default p-0 pt-2 pb-2"
                    for="size_select{{ $data->id }}">{{ $data->size }}={{ $data->qty }}</label>
            </div>
        @endif
    @endforeach
@endif

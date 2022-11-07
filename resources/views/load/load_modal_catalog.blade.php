@foreach ($data as $data)
    <div class="col-3">
        <input type="radio" id="size_select{{ $data->id }}" name="mdl_size" value="{{ $data->size }}" >
        <label class="border-theme" for="size_select{{ $data->id }}">{{  $data->size }}={{  $data->qty }}</label>
    </div>
@endforeach
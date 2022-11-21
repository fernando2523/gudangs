<select class="form-select form-select-sm fw-bold text-success" required name="size">
    <option value="" disabled selected>SIZE</option>
    @foreach ($get_idpo_variation as $vars)
        <option value="">{{ $vars->size }}</option>
    @endforeach
</select>

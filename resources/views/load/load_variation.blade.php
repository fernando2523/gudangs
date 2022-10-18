<?php
include '../conn.php';
$output = '';

if (isset($_POST['variasi'])) {
    $search = mysqli_real_escape_string($conn, $_POST['variasi']);
    if ($search == 'SNEAKERS UNISEX') {
        $output .= '<table class="table table-bordered table-sm mt-4" id="variations" id="hasil_variation">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class="text-center text-dark" style="height: 10px;">Size</th>';
        $output .= '<th class="text-center text-dark" style="height: 10px;">Qty</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody id="tbody_item">';
        $i = 0;
        $size = 35;
        while ($i <= 10) {
            $i++;

            $output .= '<tr>';
            $output .= '<td style="width: 10%;">';
            $output .= '<input class="form-control text-center text-dark" type="text" name="size[]" value="' . $size . '" readonly style="width: 100%;height: 15px;">';
            $output .= '</td>';
            $output .= '<td style="width: 10%;">';
            $output .= '<input class="form-control text-center text-info" type="text" name="qty[]" value="0" onkeypress="return isNumberKey(event)" style="width: 100%;height: 15px;font-weight: bold;" autocomplete="off">';
            $output .= '</td>';
            $output .= '</tr>';
            $size = $size + 1;
        }
        $output .= '</tbody>';
        $output .= '</table>';
    } elseif ($search == 'SNEAKERS WOMAN') {
        $output .= '<table class="table table-bordered" id="variations" style="width: 100%;color:" id="hasil_variation">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class="text-center" style="width: 10%;">Size</th>';
        $output .= '<th class="text-center" style="width: 10%;">Qty</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody id="tbody_item">';
        $i = 0;
        $size = 36;
        while ($i <= 4) {
            $i++;

            $output .= '<tr>';
            $output .= '<td style="width: 10%;">';
            $output .= '<input class="form-control text-center" type="text" name="size[]" value="' . $size . '" readonly style="width: 100%;">';
            $output .= '</td>';
            $output .= '<td style="width: 10%;">';
            $output .= '<input class="form-control" type="text" name="qty[]"onkeypress="return isNumberKey(event)" style="width: 100%;">';
            $output .= '</td>';
            $output .= '</tr>';
            $size = $size + 1;
        }
        $output .= '</tbody>';
        $output .= '</table>';
    } elseif ($search == 'SNEAKERS MAN') {
        $output .= '<table class="table table-bordered" id="variations" style="width: 100%;color:" id="hasil_variation">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class="text-center" style="width: 10%;">Size</th>';
        $output .= '<th class="text-center" style="width: 10%;">Qty</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody id="tbody_item">';
        $i = 0;
        $size = 40;
        while ($i <= 4) {
            $i++;

            $output .= '<tr>';
            $output .= '<td style="width: 10%;">';
            $output .= '<input class="form-control text-center" type="text" name="size[]" value="' . $size . '" readonly style="width: 100%;">';
            $output .= '</td>';
            $output .= '<td style="width: 10%;">';
            $output .= '<input class="form-control" type="text" name="qty[]"onkeypress="return isNumberKey(event)" style="width: 100%;">';
            $output .= '</td>';
            $output .= '</tr>';
            $size = $size + 1;
        }
        $output .= '</tbody>';
        $output .= '</table>';
    } elseif ($search == 'CUSTOM') {
        $output .= '<table class="table table-bordered" id="variations" style="width: 100%;color:" id="hasil_variation">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class="text-center" style="width: 10%;">Size</th>';
        $output .= '<th class="text-center" style="width: 10%;">Qty</th>';
        $output .= '<th class="text-center" style="width: 3%;">Actions</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody id="tbody_item">';
        $output .= '<tr>';
        $output .= '<td style="width: 10%;">';
        $output .= '<input class="form-control" type="text" name="size[]" style="width: 100%;">';
        $output .= '</td>';
        $output .= '<td style="width: 10%;">';
        $output .= '<input class="form-control" type="text" name="qty[]" onkeypress="return isNumberKey(event)" style="width: 100%;" autocomplete="off">';
        $output .= '</td>';
        $output .= '<td class="text-center" style="width: 3%;">';
        $output .= '<button type="button" class="btn btn-success btn-sm" onclick="addpo()">Add</button>';
        $output .= '</td>';
        $output .= '</tr>';
        $output .= '</tbody>';
        $output .= '</table>';
    }
}
echo $output;

<?php
function formatarData($data, $formato = 'd/m/Y') {
    $dataObj = DateTime::createFromFormat('Y-m-d', $data);
    if ($dataObj) {
        return $dataObj->format($formato);
    } else {
        return '';
    }
}


function formatarParaReal($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>
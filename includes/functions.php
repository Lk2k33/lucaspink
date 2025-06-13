<?php
function calcularDesconto($original, $atual) {
    return round(100 - ($atual / $original * 100));
}

function getCorHex($cor) {
    $cores = [
        'Rosa' => '#FF69B4',
        'Preto' => '#000000',
        'Vermelho' => '#FF0000',
        // Adicione outras cores
    ];
    return $cores[$cor] ?? '#CCCCCC';
}

function getRelatedProducts($conn, $current_id, $categoria_id, $limit = 4) {
    $stmt = $conn->prepare("SELECT * FROM produtos 
                          WHERE categoria_id = ? AND id != ? 
                          ORDER BY RAND() LIMIT ?");
    $stmt->bind_param("iii", $categoria_id, $current_id, $limit);
    $stmt->execute();
    return $stmt->get_result();
}
<?php

include_once '../includes/header.php';



// Exemplo: buscar todos os produtos de perfumaria
$linha_completa_produtos = [];
$sql = "SELECT * FROM produtos WHERE categoria_id = 8 ORDER BY id DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $linha_completa_produtos[] = $row;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<title><?php echo isset($page_title) ? $page_title . ' | ' . SITE_NAME : SITE_NAME; ?></title>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



    <div class="container my-5">
        <h2 class="text-center fw-bold mb-5 queridinhos-title" style="color:#ff008c;">uma linha completa pra você</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php foreach ($linha_completa_produtos as $produto): ?>
                <div class="col d-flex">
                    <div class="card produto-card-custom h-100 w-100 d-flex flex-column align-items-center border-0 shadow-none">
                        <img src="<?php echo htmlspecialchars($produto['imagem_principal'] ?? ''); ?>"
                            class="card-img-top" alt="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>">
                        <div class="card-body d-flex flex-column flex-grow-1 align-items-start px-3 py-4 w-100">
                            <h5 class="fw-bold mb-2" style="font-size:1.25rem; color:#000; text-align:left;">
                                <?php echo htmlspecialchars($produto['nome'] ?? ''); ?>
                            </h5>
                            <p class="mb-1" style="text-align:left;">
                                <?php echo htmlspecialchars($produto['descricao'] ?? ''); ?>
                            </p>
                            <p class="preco-antigo mb-1" style="text-align:left;">
                                R$ <?php echo isset($produto['preco_antigo']) ? number_format($produto['preco_antigo'], 2, ',', '.') : '0,00'; ?>
                            </p>
                            <p class="preco-atual mb-2" style="text-align:left;">
                                R$
                                <?php
                                echo isset($produto['preco']) ? number_format($produto['preco'], 2, ',', '.') : '0,00';
                                if (
                                    isset($produto['parcela']) &&
                                    isset($produto['preco']) &&
                                    $produto['parcela'] > 0 &&
                                    $produto['preco'] > 0
                                ) {
                                    $valor_parcela = $produto['preco'] / $produto['parcela'];
                                    // Adiciona um espaço antes da parcela
                                    echo '<span class="preco-parcelado" style="margin-left:8px;">ou ' . $produto['parcela'] . 'x R$ ' . number_format($valor_parcela, 2, ',', '.') . '</span>';
                                }
                                ?>
                            </p>
                            <div class="d-flex gap-2 mt-auto w-100">
                                <button class="btn btn-qpink flex-grow-1">Comprar</button>
                                <button class="btn btn-outline-qpink d-flex align-items-center justify-content-center">
                                    <span class="fw-bold">+</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-fill ms-1" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 14H4a.5.5 0 0 1-.491-.408L1.01 2H.5a.5.5 0 0 1-.5-.5zM5 16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm7 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        /* Centraliza e aumenta os cards */
        #produtos-lista {
            justify-content: center;
        }

        .produto-card {
            display: flex;
            justify-content: center;
        }

        .produto-card-custom {
            box-shadow: 0 2px 16px 0 rgba(0, 0, 0, 0.08);
            border: 2px solid #fff;
            transition: box-shadow .2s, border-color .2s, transform .2s;
            max-width: 380px;
            min-width: 280px;
        }

        .produto-card-custom:hover {
            box-shadow: 0 6px 32px 0 rgba(255, 0, 140, 0.13);
            border-color: #ff008c;
            transform: translateY(-4px) scale(1.03);
        }

        .btn-qpink {
            background: #ff008c;
            color: #fff;
            border: 2px solid #ff008c;
            transition: background .2s, color .2s, border .2s;
        }

        .btn-qpink:hover,
        .btn-qpink:focus {
            background: #fff;
            color: #ff008c;
            border: 2px solid #ff008c;
        }

        .btn-outline-qpink {
            background: #fff;
            color: #ff008c;
            border: 2px solid #ff008c;
            transition: background .2s, color .2s, border .2s;
        }

        .btn-outline-qpink:hover,
        .btn-outline-qpink:focus {
            background: #ff008c;
            color: #fff;
            border: 2px solid #ff008c;
        }

        @media (max-width: 991.98px) {
            .produto-card-custom {
                max-width: 100%;
                min-width: 0;
            }
        }
    </style>

    
</body>


</html>
<?php
include_once '../includes/footer.php';
?>
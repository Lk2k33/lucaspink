<?php
include_once __DIR__ . '/../db/connect.php';
//conexao com o banco de dados










class Produto
{

    private int $id;
    private string $nome;
    private string $descricao;
    private float $preco_antigo;
    private float $preco_atual;
    private string $parcelas;
    private string $imagem;

    public function __construct($id, $nome, $descricao, $preco_antigo, $preco_atual, $parcelas, $imagem = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco_antigo = $preco_antigo;
        $this->preco_atual = $preco_atual;
        $this->parcelas = $parcelas;
        $this->imagem = $imagem;
    }


    public function listar_tudo($conn)
    {
        // Buscar todos os produtos
        $produtos = [];
        $sql = "SELECT * FROM produtos ORDER BY id ASC";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produtos[] = $row;
            }
        }
    }

    public function listarPorId($conn)
    {
        // Update with your actual DB connection parameters or use your connect.php logic

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();

        if ($produto) {
            return new Produto(

                $produto['nome'],
                $produto['descricao'],
                $produto['preco_antigo'],
                $produto['preco_atual'],
                $produto['parcelas'],
                $produto['imagem']
            );
        } else {
            return null;
        }
    }
    public function linhaDestaqueProdutos($conn)
    {
        //listar produtos em destaque
        $linha_completa_produtos = [];
        $sql = "SELECT * FROM produtos WHERE destaque_id = 1 ORDER BY id DESC LIMIT 4";
        $resultado = $conn->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $linha_completa_produtos[] = $row;
            }
        };
    }

    public function destaqueMes($conn)
    {
        $destaque_mes = [];
        $sql = "SELECT * FROM produtos WHERE destaque_id = 2 ORDER BY id DESC LIMIT 1";
        $resultado = $conn->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $destaque_mes[] = $row;
            }
        };
    }
    public function slideBanner($conn)
    {
        // Defina os IDs dos produtos para cada slide (4 por slide)
        $slides_ids = [
            [1, 2, 3, 4], // Slide 1: IDs dos produtos
            [5, 6, 7, 8], // Slide 2: IDs dos produtos
            // Adicione mais arrays para mais slides
        ];

        $slides_produtos = [];
        foreach ($slides_ids as $ids) {
            // Monta a string de IDs para o SQL
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $sql = "SELECT * FROM produtos WHERE id IN ($placeholders) ORDER BY FIELD(id, $placeholders)";
            $stmt = $conn->prepare($sql);
            // Duplicar os IDs para o ORDER BY FIELD
            $params = array_merge($ids, $ids);
            $types = str_repeat('i', count($params));
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            $produtos = [];
            while ($row = $result->fetch_assoc()) {
                $produtos[] = $row;
            }
            $slides_produtos[] = $produtos;
        }
    }
}

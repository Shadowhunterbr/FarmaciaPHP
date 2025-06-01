<?php

use model\Produto;

require_once __DIR__ . "/../model/Cliente.php";
require_once __DIR__ . "/../model/ClienteDao.php";
require_once __DIR__ . "/../model/CarrinhoDao.php";
require_once __DIR__ . "/../model/PedidoDao.php";
require_once __DIR__ . '/../model/ProdutoDao.php';



class ClienteController{

    

    

    public function mostrarPaginaLogin(){
        
        $dao = new clienteDao();
        $generos = $dao->generos();

        require_once __DIR__ . "/../view/logins/loginCliente.php";
    }

    public function login() {
        $email = $_POST['txtemailCliente'];
        $senha = $_POST['txtsenhaCliente'];
    
        $clienteDao = new ClienteDao();
        $cliente = $clienteDao->autentica($email, $senha);
    
        if ($cliente !== null) {
            session_start();
            $_SESSION['clienteAutenticado'] = $cliente;
            $_SESSION['codCliente'] = $cliente->getCodigoCliente(); 
           
    
            header("Location: index.php?acao=catalogoDeProdutos");
            exit();
        } else {
            header("Location: index.php?acao=loginCliente"); 
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location:  index.php?acao=loginCliente"); // podemos redirecionar para outra pagina antes do login
        exit();
    }

    public function mostrarPaginaAlterar() {
        if (isset($_GET['codCliente'])) {
            $codigo = $_GET['codCliente'];
            echo "Código recebido: " . $codigo; // Debug
            $dao = new clienteDao();
            $generos = $dao->generos();
            $cliente = $dao->buscarClientePorCodigo($codigo);
            $endereco = $dao->buscarEnderecoPorCodigo($codigo);
    
            require_once __DIR__ . "/../view/infoCliente.php";
        } else {
            echo "Código do cliente não recebido."; // Debug
        }
    }

    public function alterarEndereco(){
        $codigo = isset($_POST['codCliente']) ? $_POST['codCliente'] : $_SESSION['codCliente'];
        $codCliente = isset($_POST['codCliente']) ? $_POST['codCliente'] : $_SESSION['codCliente'];
        $rua = $_POST['txtrua'];
        $numero = $_POST['txtnumero'];
        $bairro = $_POST['txtbairro'];
        $cidade = $_POST['txtcidade'];
        $cep = $_POST['txtcep'];
        $uf = $_POST['txtuf'];
    
        $enderecoDao = new ClienteDao();
    
        $objEndereco = new EnderecoCliente($codigo, $codCliente, $rua, $numero, $bairro, $cidade, $cep, $uf);
        $enderecoDao->alterarEndereco($objEndereco);
    
        header("Location: index.php?acao=mostrarInfoCliente&codCliente=" . $_SESSION['codCliente'] );
        exit();
    }
    public function alterarCliente(){
        $codigo = isset($_POST['codCliente']) ? $_POST['codCliente'] : $_SESSION['codCliente'];
        $nome = $_POST['txtnome'];
        $email = $_POST['txtemail'];
        $senha = $_POST['txtsenha'];
        $telefone = $_POST['txttelefone'];
        $cpf = $_POST['txtcpf'];
        $codGenero = $_POST['txtcodGenero'];
        $dataNascimento = $_POST['txtdataNascimento'];
        
    
        $clienteDao = new ClienteDao();
    
        $objCliente = new Cliente($codigo, $nome, $email, $senha, $telefone, $cpf, $codGenero, $dataNascimento);
        $clienteDao->alterarCliente($objCliente);
    
        header("Location: index.php?acao=mostrarInfoCliente&codCliente=" . $_SESSION['codCliente'] );
        exit();
    }
    

    public function catalogoDeProdutos($search = null) {
        $dao = new ClienteDao();
        $generos = $dao->generos();
        $produtoDao = new ProdutoDao();
        $codCliente = $_SESSION['codCliente'] ?? null;

       
        if($search){
            $produtos = $produtoDao->buscarPorNome($search);       
        }else{
            $produtos = $produtoDao->buscarTodosProdutosAtivos();
        }
        
        $categorias = $produtoDao->buscarTodasCategorias();
        
        require_once __DIR__ . "/../view/catalogoDeProdutos.php";
   }

   public function mostrarPaginaCarrinho(){
    $dao = new ClienteDao();
    $produtoDao = new ProdutoDao();
    $carrinhoDao = new CarrinhoDao();
    $prescricao = $produtoDao->arrayPrescricao();
    require_once __DIR__ . "/../view/CarrinhoDeCompras.php";
   }
   public function mostrarPedidos(){
    $dao = new ClienteDao();
    $produtoDao = new ProdutoDao();
    $carrinhoDao = new CarrinhoDao();
    $pedidos = new PedidoDao();
    require_once __DIR__ . "/../view/pedidos.php";
   }

   

   public function cadastrarCliente(){

    $codigo = null;
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $senha = $_POST['txtsenha'];
    $telefone  = $_POST['txttelefone'];
    $cpf = $_POST['txtcpf'];
    $cod_genero = $_POST['txtgenero']; /*$_POST['']; */
    $data_nascimento = $_POST['txtdataNascimento'];

    $clienteDao = new ClienteDao();
    

    if ($clienteDao->verificarEmailExistente($email)) {
        // Redireciona para a página de erro ou exibe mensagem ao usuário
        echo "<script>alert('O e-mail já está cadastrado. Tente outro.'); window.location.href = 'index.php?acao=cadastroCliente';</script>";
        exit();
    }else if($clienteDao->verificarCpfExistente($cpf)){
        echo "<script>alert('O CPF já está cadastrado. Tente outro.'); window.location.href = 'index.php?acao=cadastroCliente';</script>";
    }else{
        $objCliente = new Cliente($codigo,$nome,$email,$senha,$telefone,$cpf,$cod_genero,$data_nascimento);
        $codigoGerado = $clienteDao->cadastrarCliente($objCliente);
        $clienteDao->criarEndereco($codigoGerado);
        echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href = 'index.php?acao=loginCliente';</script>";    
    }

    exit();
   }

   public function adicionarProduto($codCliente, $codProd, $quantidade) {
    $carrinhoDao = new CarrinhoDao();

    $carrinho =  $carrinhoDao->buscarCarrinho($codCliente);

    if (!$carrinho) {
        $codCarrinho =  $carrinhoDao->criarCarrinho($codCliente);
    } else {
        $codCarrinho = $carrinho['codigo'];
    }
    $produtoDao = new ProdutoDao();
    $produtos =  $produtoDao->buscarProdutoPorCodigo($codProd);

    if ($produtos) {
        $subtotal = $produtos['preco'] * $quantidade;
        $carrinhoDao->adicionarItem($codCarrinho, $codProd, $quantidade, $subtotal);
    }
}




public function visualizarCarrinho() {
    // Verificar se a sessão já foi iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();  // Iniciar a sessão apenas se não estiver ativa
    }
    
    $codCliente = $_SESSION['codCliente'] ?? null;

    if (!$codCliente) {
        header("Location: index.php?acao=loginCliente");
        exit();
    }

    $carrinhoDao = new CarrinhoDao();
    $carrinho = $carrinhoDao->buscarCarrinho($codCliente);
    
    // Verificar o conteúdo do carrinho retornado
   // Verifique o formato dos dados retornados

    if ($carrinho) {
        // Certifique-se de que a chave 'codigo' existe no array retornado
        if (isset($carrinho['codigo'])) {
            $produtos = $carrinhoDao->buscarItensCarrinho($carrinho['codigo']);
            $total = $carrinhoDao->calcularTotalCarrinho($carrinho['codigo']);
            $produtoDao = new ProdutoDao();
            $prescricao = $produtoDao->arrayPrescricao();

        } else {
            // Caso a chave não exista
            $produtos = [];
            $total = 0;
        }
    } else {
        $produtos = [];
        $total = 0;
    }

    require_once __DIR__ . "/../view/CarrinhoDeCompras.php";
}

public function removerProduto($codCliente, $codProd) {
    $carrinhoDao = new CarrinhoDao();

    $carrinho = $carrinhoDao->buscarCarrinho($codCliente);
    if ($carrinho) {
        $carrinhoDao->removerItem($carrinho['codigo'], $codProd);
    }
}

public function obterTotalCarrinho($codCliente) {
    $carrinhoDao = new CarrinhoDao();
    
    // Buscar o carrinho do cliente
    $carrinho = $carrinhoDao->buscarCarrinho($codCliente);

    if ($carrinho) {
        // Corrigir para passar o código do carrinho
        return $carrinhoDao->calcularTotalCarrinho($carrinho['codigo']); // 'codigo' é o campo do carrinho
    }

    return 0; // Retorna 0 se o carrinho não existir
}





public function finalizarPedido($codCliente) {
    $carrinhoDao = new CarrinhoDao();
    $carrinho = $carrinhoDao->buscarCarrinho($codCliente);

    if ($carrinho) {
        $produtos = $carrinhoDao->buscarItensCarrinho($carrinho['codigo']);
        $total = 0;
        $necessitaPrescricao = false;

        foreach ($produtos as $produto) {
            $total += $produto['subtotal'];
            if ($produto['cod_prescricao'] == 1) {
                $necessitaPrescricao = true;
            }
        }

        if ($necessitaPrescricao) {
            // Verifica se há imagem enviada
            if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] != UPLOAD_ERR_OK) {
                echo "<script>
                        alert('Um ou mais produtos exigem prescrição médica. Por favor, envie a receita antes de finalizar o pedido.');
                        window.history.back();
                      </script>";
                return;
            }

            // Valida o tipo do arquivo enviado (opcional, para aceitar apenas imagens)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['imagem']['type'], $allowedTypes)) {
                echo "<script>
                        alert('Arquivo enviado não é uma imagem válida. Por favor, envie uma imagem no formato JPEG, PNG ou GIF.');
                        window.history.back();
                      </script>";
                return;
            }
        }

        // Continua com a finalização do pedido
        $pedidoDao = new PedidoDao();
        $pedidoDao->salvarPedido($codCliente, $total, $produtos);
        $carrinhoDao->atualizarEstoque($produtos);
        $carrinhoDao->limparCarrinho($carrinho['codigo']);

        header("Location: index.php?acao=mostrarPedidos");
        exit();
    }

    header("Location: index.php?acao=visualizarCarrinho");
    exit();
}


}
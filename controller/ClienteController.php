<?php

use model\Produto;

require_once __DIR__ . "/../model/Cliente.php";
require_once __DIR__ . "/../model/ClienteDao.php";
require_once __DIR__ . "/../model/CarrinhoDao.php";




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


    public function catalogoDeProdutos($search = null) {
        $dao = new ClienteDao();
        $generos = $dao->generos();
        $produtoDao = new ProdutoDao();

       
        if($search){
            $produtos = $produtoDao->buscarPorNome($search);       
        }else{
            $produtos = $produtoDao->buscarTodosProdutos();
        }
        
        $categorias = $produtoDao->buscarTodasCategorias();
        
        require_once __DIR__ . "/../view/catalogoDeProdutos.php";
   }

   public function mostrarPaginaCarrinho(){
    $dao = new ClienteDao();
    $produtoDao = new ProdutoDao();
    $carrinhoDao = new CarrinhoDao();
    require_once __DIR__ . "/../view/CarrinhoDeCompras.php";
   }

   

   public function cadastrarCliente(){

    $codigo = null;
    $nome = $_POST['txtnome'];
    $cod_endereco = null;
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
        $objCliente = new Cliente($codigo,$nome,$cod_endereco,$email,$senha,$telefone,$cpf,$cod_genero,$data_nascimento);
        $clienteDao->cadastrarCliente($objCliente);
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
    

    // Buscar preço do produto (substitua por um ProdutoModel para isso)
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

    if ($carrinho) {
        $produtos = $carrinhoDao->buscarItensCarrinho($carrinho['codigo']);
        print_r($produtos);
    } else {
        $produtos = [];
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


}
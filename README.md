# FARMACIA PHP


![image](https://github.com/user-attachments/assets/b0c5b714-af1d-46f4-9dd5-facfa4986669)


## Índice

1. [Descrição](#descrição)
2. [Funcionalidades](#funcionalidades)
3. [Tecnologias Utilizadas](#tecnologias-utilizadas)
4. [Instalação](#instalação)

---

## Descrição

Sistema de administração e catálogo de produtos com CRUD criado em PHP com o intuito de facilitar a gestão de farmácias e otimizar o processo de compra de produtos pelos clientes. 
O sistema permite que funcionários administrem produtos, fornecedores, categorias e usuários, enquanto os clientes 
podem explorar o catálogo, adicionar itens ao carrinho e finalizar suas compras de forma prática e intuitiva.
---

## Funcionalidades

O sistema é dividido em duas seções principais: Funcionário e Cliente.

## *Funcionalidades para Funcionarios*
Funcionários com nível de cargo "Administrador" podem:
- Cadastrar, alterar e excluir produtos e categorias.
- Verificar relatórios de vendas e pedidos concluídos.

Funcionários com nível de cargo "Gerente" têm as mesmas permissões do administrador e, além disso, podem:
- Cadastrar, alterar e excluir funcionários e fornecedores.

## *Funcionalidades para Clientes*
Os clientes podem:

Navegar pelo catálogo de produtos por categorias ou barra de pesquisa.
Adicionar produtos ao carrinho e finalizar pedidos facilmente(Produtos podem necessitar de Prescrição médica, sujeito a upload da imagem).

---

## Tecnologias Utilizadas

- Linguagem de Programação: *PHP/JavaScript*
- Banco de Dados: *MySQL*
- Outros: *Git,XAMPP*

---

## Instalação

Instruções detalhadas sobre como instalar e rodar o projeto localmente. Um exemplo:

1. Clone o repositório ou instale o arquivo .ZIP do projeto:
   ```bash
   git clone https://github.com/Shadowhunterbr/FarmaciaPHP.git
   
2. Mova o projeto para a pasta *C:\xampp\htdocs*

3. Crie o banco de dados no mySQL com o arquivo *banco de dados.sql* Localizado no projeto.
    
   ![image](https://github.com/user-attachments/assets/31db64d8-3c89-4210-a59d-d64e7096d1a9)

   Certifique-se que o Login e Senha do mysql confere com a pagina *Conexao.php*.

4. Inicie o apache no *XAMPP Control Panel*

5. Entre em um navegador, Digite *Localhost/FarmaciaPHP-main*
   

<?php require('../database/conexao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./produtos.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <title>Administrar Produtos</title>
</head>
<body>
    <!-- INCLUSÃO DO COMPONENTE HEADER -->
    <?php include('../componentes/header/header.php');?>
    <div class="content">
        <section class="produtos-container">
            <!-- BOTÕES DE INSERÇÃO DE PRODUTOS E CATEGORIAS -->
            <?php 
                if(isset($_SESSION['usuarioID'])) {
            ?>
                    <header>
                        <button onclick="javascript:window.location.href ='./novo/'">Novo Produto</button>
                        <button onclick="javascript:window.location.href ='../categorias/'">Adicionar Categoria</button>
                    </header>
            <?php
                }
            ?>
            <main>
                <!-- LISTAGEM DE PRODUTOS (INICIO) -->
                <?php
                    $query = "SELECT p.*, c.descricao AS nome_categoria FROM tbl_produto p INNER JOIN tbl_categoria c ON p.categoria_id = c.id;";
                    $sqlObject = mysqli_query($conexao, $query);

                    while ($queryArray = mysqli_fetch_array($sqlObject)) {
                        $valor = $queryArray["valor"];
                        $descontoPercento = $queryArray["desconto"];
                        $valorDesconto = 0;

                        if ($descontoPercento > 0) {
                            $valorDesconto = ($descontoPercento / 100) * $valor;
                        }

                        $qtdParcelas = ($valor > 1000? 12 : 6);
                        $valorComDesconto = $valor - $valorDesconto;
                        $valorParcela = $valorComDesconto / $qtdParcelas;
                // ?>
                        <article class="card-produto">
                        <?php 
                            if(isset($_SESSION['usuarioID'])) {
                        ?>
                                <div class="acoes-produtos">
                                    <img onclick="javascript: window.location = './editar/?id=<?=$queryArray['id']?>'" src="../imgs/edit.svg" />
                                    <img onclick="deletar(<?=$queryArray['id']?>)" src="../imgs/trash.svg" />
                                </div>
                        <?php
                            }       
                        ?>  
                            <figure><img src="fotos/<?=$queryArray["imagem"]?>"/></figure>
                            <section>
                                <span class="preco">
                                    R$ <?=number_format($valorComDesconto, 2, ',', '.')?> <em> <?=$descontoPercento?> % off</em>
                                </span>
                                <span class="parcelamento">
                                    ou em<em> <?=$qtdParcelas?> x R$ <?=number_format($valorParcela, 2, ",", ".")?> sem juros</em>
                                </span>
                                <span class="descricao"><?=$queryArray["descricao"]?></span>
                                <span class="categoria">
                                    <em><?=$queryArray["nome_categoria"]?></em>
                                </span>
                            </section>
                        </article>
                <?php 
                    }
                ?>
                <!-- LISTAGEM DE PRODUTOS (FIM) -->

                <!-- FORM USADO PARA A EXCLUSÃO DE PRODUTOS -->
                <form id="formDeletar" method="POST" action="./acoes.php">
                    <input type="hidden" name="acao" value="deletar"/>
                    <input type="hidden" name="produtoId" id="produtoId"/>
                </form>
            </main>
        </section>
    </div>
    <footer>SENAI 2021 - Todos os direitos reservados</footer>

    <!-- SCRIPT QUE DISPARA O FORM DE EXCLUSÃO DE PRODUTOS -->
    <script lang="javascript">
        function deletar(produtoId) {
            if (confirm("Tem certeza que deseja deletar este produto?")) {
                document.querySelector("#produtoId").value = produtoId;
                document.querySelector("#formDeletar").submit();
            }
        }
    </script>

</body>
</html>
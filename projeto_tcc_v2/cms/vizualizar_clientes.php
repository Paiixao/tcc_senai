<?php  ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_visualizar">
                        <div class="titulo_visualizar">
                            <p>Visualizar Clientes</p>
                        </div>
                    </div>

                    <div class="apoio_pesquisa_dicas">
                        <div class="apoio_pesquisa_dicas2">
                            <form name="pesquisa" method="post" action="vizualizar_clientes.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_dica">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_dica">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_visualizar">
                        <table  class="tabela_visualizar">
                            <tr bgcolor="#CCCCCC">
                                <td><strong>ID</strong></td>
                                <td><strong>Nome</strong></td>
                                <td><strong>Valor gasto</strong></td>
                                <td><Strong>Data da ultima compra</Strong></td>

                            </tr>

                            <?php

                              $sql = "SELECT c.id_cliente, c.nome_cliente, c.email, c.telefone, c.celular, c.dt_nasc, c.CPF FROM cliente AS c";
                              $select = mysqli_query($con, $sql);

                              while (mysqli_fetch_array($select)) {
                             ?>

                            <tr>
                                <td><?php echo ($rs['id_cliente']); ?></td>
                                <td><?php echo ($rs['nome_cliente']); ?></td>
                                <td><?php echo ($rs['']); ?></td>
                                <td><?php echo ($rs['']); ?></td>

                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    
                </div>
            </div>
            
            <div class="rodape">
                <p>Desenvolvido por 3GCJ</p>
            </div>
            
        </div>

    </body>
</html>

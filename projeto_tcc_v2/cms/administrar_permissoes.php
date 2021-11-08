<?php
    session_start();
    include('include_cms/include_conexao.php');

        if (isset($_GET['modo'])) {
          $cod=$_GET['cod'];

          if($_SESSION['id_permissao']==$cod){
            ?><script>alert("Não é possivel excluir esse usuario");</script><?php

          }else{
            $sql="delete from permissao where id_permissao = ".$cod;
            mysqli_query($con, $sql);
          }
        }
 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content Type" content="text/html; charset="utf-8>
        <title>Administrar Permissões</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

        	<div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_administar_permissoes">
                        <div class="titulo_administrar_permissoes">
                            Administrar Permissões
                        </div>
                    </div>

                    <div class="apoio_administar_permissoes">
                        <a href="adicionar_permissoes.php">
                        <div class="adicionar_permissao">
                            <div class="text_addpermissao">
                                Adicionar Permissão
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="apoio_administar_permissoes">
                        <div class="apoio_pesquisa_permissoes">
                            <form name="pesquisa" method="post" action="administrar_permissoes.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_permissoes">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_permissoes">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_permissoes">
                        <table  class="tabela_permissoes">
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Nome da Permissão</strong></td>
                                <td><strong>Páginas</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php

                              $sql = "SELECT p.id_permissao, p.nome_permissao FROM permissao AS p";
                              $select = mysqli_query($con, $sql);

                              while ($rs =mysqli_fetch_array($select)) {
                             ?>
                            <tr>
                                <td><?php echo ($rs['id_permissao']); ?></td>
                                <td><?php echo ($rs['nome_permissao']); ?></td>
                                <td>XXXXXXXXXX</td>
                                <td>
                                  <a href="administrar_permissoes.php?modo=excluir&&cod=<?php echo($rs['id_dica']); ?>">Excluir</a>
                                          /
                                  <a href="adicionar_permissoes.php?modo=editar&&cod=<?php echo($rs['id_dica']); ?>">Editar</a>
                                </td>
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

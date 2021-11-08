<?php
    session_start();
    include('include_cms/include_conexao.php');

    if(isset($_GET['modo'])){
        $cod=$_GET['cod'];

        $sql="delete from nivel where id_nivel = ".$cod;
        mysqli_query($con, $sql);
    }
 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
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
                    
                    <div class="apoio_administrar_niveis">
                        <div class="titulo_administrar_niveis">
                            Administrar Niveis
                        </div>
                    </div>

                    <div class="apoio_administrar_niveis">
                        <a href="adicionar_niveis.php">
                        <div class="adicionar_nivel">
                            <div class="text_addnivel">
                                Adicionar Niveis
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="apoio_administrar_niveis">
                        <div class="apoio_pesquisa_niveis">
                            <form name="pesquisa" method="post" action="administrar_niveis.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_niveis">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_niveis">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_niveis">
                        <table  class="tabela_niveis">
                            <tr bgcolor="#CCCCCC">
                                <td><strong>ID</strong></td>
                                <td><strong>Nome do Nivel</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                     $sql = "SELECT * FROM nivel AS n";
                                     $sql.= " WHERE nome_nivel like '".$pesquisa."%'";
                                }else{
                                     $sql = "SELECT * FROM nivel AS n";
                                }
                                $select=mysqli_query($con, $sql);

                                while($rs=mysqli_fetch_array($select)){
                            ?>
                                <tr>
                                    <td><?php echo($rs['id_nivel']); ?></td>
                                    <td><?php echo($rs['nome_nivel']) ?></td>
                                    <td class="img_tabela">
                                      <a href="administrar_niveis.php?modo=excluir&&cod=<?php echo($rs['id_nivel']); ?>"><img src="imagens/delete_13221.png"/></a>
                                      <a href="administrar_niveis.php?modo=editar&&cod=<?php echo($rs['id_nivel']); ?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png"/></a>
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

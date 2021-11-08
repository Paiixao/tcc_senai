<?php
    session_start();
    include('include_cms/include_conexao.php');

      if (isset($_GET['modo'])) {
        $cod = $_GET['cod'];
          $sql="delete from fale_conosco where id_faleConosco = ".$cod;
          mysqli_query($con, $sql);
            
      }

    
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Fale Conosco</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_fale_conosco">
                        <div class="titulo_fale_conosco">
                            Administrar Fale Conosco
                        </div>
                    </div>

                    <div class="apoio_fale_conosco">
                        <div class="apoio_pesquisa_fale">
                            <form name="pesquisa" method="post" action="administrar_fale_conosco.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_fale">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_fale">
                             </form>
                        </div>
                    </div>
                    <div class="apoio_tabela_fale_conosco">
                        <table  class="tabela_fale_conosco">
                            <tr bgcolor="#CCCCCC">
                                <td><strong>ID</strong></td>
                                <td><strong>Nome</strong></td>
                                <td><strong>Tipo</strong></td>
                                <td><strong>Numero do Produto</strong></td>
                                <td><strong>Comentário</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                   $sql = "SELECT *FROM fale_conosco where nome_contato like '".$pesquisa."%';";
                                }else{
                                    $sql = "SELECT *FROM fale_conosco";
                                }
                            
                                $select = mysqli_query($con, $sql);

                                while($rs = mysqli_fetch_array($select)) {

                                    if($rs['numero_protocolo']==null) $numero_protocolo = "Não possui número de protocolo";
                                    else $numero_protocolo=$rs['numero_protocolo'];
                             ?>

                            <tr>
                                <td><?php echo ($rs['id_faleConosco']); ?></td>
                                <td><?php echo ($rs['nome_contato']); ?></td>
                                <td><?php echo ($rs['tipo_contato']); ?></td>
                                <td><?php echo ($numero_protocolo); ?></td>
                                <td><?php echo ($rs['comentario']); ?></td>

                                <td class="img_tabela">
                                  <a href="administrar_fale_conosco.php?modo=excluir&&cod=<?php echo($rs['id_faleConosco']); ?>"><img src="imagens/delete_13221.png"/></a>
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

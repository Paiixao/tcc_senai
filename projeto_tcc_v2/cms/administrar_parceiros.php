<?php
  session_start();
  include('include_cms/include_conexao.php');

  if (isset($_GET['modo'])) {
     $cod=$_GET['cod'];

     $sql="delete from parceiro where id_parceiro = ".$cod;
     mysqli_query($con, $sql);
    }

 ?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Parceiros</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_administrar_parceiros">
                        <div class="titulo_administrar_parceiros">
                            Administrar Parceiros
                        </div>
                    </div>

                    <div class="apoio_administrar_parceiros">
                        <a href="adicionar_parceiro.php">
                        <div class="adicionar_parceiro">
                            <div class="text_addparceiro">
                                Adicionar Parceiros
                            </div>
                        </div>
                        </a>
                    </div>

                     <div class="apoio_administrar_parceiros">
                        <div class="apoio_pesquisa_parceiros">
                            <form name="pesquisa" method="post" action="administrar_parceiros.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_parceiros">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_parceiros">
                             </form>
                        </div>
                    </div>
                    <div class="apoio_tabela_parceiros">
                        <table  class="tabela_parceiros">
                            <tr bgcolor="#CCCCCC">
                                <td><strong>ID</strong></td>
                                <td><strong>Nome</strong></td>
                                <td><strong>Telefone</strong></td>
                                <td><strong>E-mail</strong></td>
                                <td><strong>Site</strong></td>
                                <td><strong>Informções</strong></td>
                                <td><strong>Logo</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                    $sql = "SELECT p.id_parceiro, p.nome_parceiro, p.telefone, p.email, p.site, p.logo_parceiro, substring(p.informacao, 1, 150) as informacao ";
                                    $sql.= "FROM parceiro AS p WHERE nome_parceiro like '".$pesquisa."%';";
                                }else{
                                     $sql = "SELECT p.id_parceiro, p.nome_parceiro, p.telefone, p.email, p.site, p.logo_parceiro, substring(p.informacao, 1, 150) as informacao"; 
                                     $sql.= " FROM parceiro AS p";
                                }
                             
                              $select = mysqli_query($con, $sql);

                              while ($rs=mysqli_fetch_array($select)) {
                             ?>

                            <tr>
                                <td><?php echo ($rs['id_parceiro']); ?></td>
                                <td><?php echo ($rs['nome_parceiro']); ?></td>
                                <td><?php echo ($rs['telefone']); ?></td>
                                <td><?php echo ($rs['email']); ?></td>
                                <td><?php echo ($rs['site']); ?></td>
                                <td><?php echo ($rs['informacao']."..."); ?></td>
                                <td><img src="<?php echo ($rs['logo_parceiro']); ?>" alt="" class="coluna_img"/></td>
                                <td class="img_tabela">
                                  <a href="administrar_parceiros.php?modo=excluir&&cod=<?php echo($rs['id_parceiro']); ?>"><img src="imagens/delete_13221.png"/></a>
                                          
                                  <a href="adicionar_parceiro.php?modo=editar&&cod=<?php echo($rs['id_parceiro']); ?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png"/></a>
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

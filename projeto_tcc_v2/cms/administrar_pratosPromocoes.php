<?php
  session_start();
  include('include_cms/include_conexao.php');

  $btn = "SALVAR";

  if(isset($_GET['modo'])){
    $_SESSION['id_prato'] = $_GET['id_prato'];
    $_SESSION['id_promocao'] = $_GET['id_promocao'];

    $modo = $_GET['modo'];

    if($modo == "excluir"){
      $sql="delete from promocao_prato where id_prato = ".$_SESSION['id_prato'] . " and id_promocao = ".$_SESSION['id_promocao'];
      mysqli_query($con, $sql);
    }

  }

 if(isset($_POST['btnsalvar_categoria'])) {

    $btn = $_POST['btnsalvar_categoria'];
    $id_prato = strip_tags($_POST['sl_prato']);
    $id_promocao = strip_tags($_POST['sl_promocao']);

    if ($btn == "SALVAR") {
      $sql = "INSERT INTO promocao_prato(id_prato, id_promocao) VALUES('".$id_prato."', '".$id_promocao."')";
    }

    mysqli_query($con, $sql);
    header("location: administrar_pratosPromocoes.php");
  }

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Pratos/Promoções</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                
                    <div class="apoio_categoria">

                        <div class="titulo_categorias">
                            Administrar Promoções
                        </div>

                    </div>

                    <div class="apoio_categoria">
                      <form action="administrar_pratosPromocoes.php" method="post" name="frm_categorias">
                        <div class="categoria_produto">
                            Categoria:

                            <select name="sl_prato" class="edit_select_categoria" required>
                                <option value="0">Selecione um prato</option>
                                <?php
                                   $sql = "select * from prato;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_prato"]); ?>"><?php echo($rs["nome_prato"]); ?></option>
                                 <?php
                                     }
                                 ?>
                            </select>
                        </div>

                        <div class="subcategoria_produto">
                            Subcategoria:
                            <select name="sl_promocao" class="edit_select_categoria" required>
                                <option value="0">Selecione uma Pagina</option>
                                <?php
                                   $sql = "select * from promocao;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_promocao"]); ?>"><?php echo($rs["titulo_promocao"]); ?></option>
                                 <?php
                                     }
                                 ?>
                            </select>
                        </div>

                        <div class="botao_categoria">
                            <input type="submit" name="btnsalvar_categoria" value="<?php echo($btn) ?>" class="edit_submit">
                        </div>
                      </form>
                    </div>

                    <div class="apoio_categoria">
                        <div class="apoio_pesquisa_categoria">
                            <form name="pesquisa" method="post" action="administrar_nivelPagina.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_categoria">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_categoria">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_categorias">
                        <table  class="tabela_categorias">
                            <tr>
                                <td><strong>ID do prato</strong></td>
                                <td><strong>Nome da prato</strong></td>
                                <td><strong>ID da promoção</strong></td>
                                <td><strong>Nome da promoção</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                              if(isset($_POST['botao_pesquisar'])){
                                  $pesquisa=$_POST['text_pesquisar'];
                                    $sql= "SELECT * FROM promocao_prato as pm INNER JOIN prato as p on(p.id_prato=pm.id_prato)";
                                   $sql.=" inner join promocao as pr on(pr.id_promocao=pm.id_promocao) where p.nome_prato like '".$pesquisa."%'";
                                   $sql.=" or pr.titulo_promocao like  '".$pesquisa."%'";
                                }else{
                                   $sql= "SELECT * FROM promocao_prato as pm INNER JOIN prato as p on(p.id_prato=pm.id_prato)";
                                   $sql.=" inner join promocao as pr on(pr.id_promocao=pm.id_promocao)";
                              }
                             
                              $select = mysqli_query($con, $sql);

                              while($rs=mysqli_fetch_array($select)){
                             ?>
                             <tr>
                                  <td><strong><?php echo ($rs['id_prato']); ?></strong></td>
                                  <td><strong><?php echo ($rs['nome_prato']); ?></strong></td>
                                  <td><strong><?php echo ($rs['id_promocao']); ?></strong></td>
                                  <td><strong><?php echo ($rs['titulo_promocao']); ?></strong></td>
                                  <td class="img_tabela">
                                    <a href="administrar_pratosPromocoes.php?modo=excluir&&id_prato=<?php echo($rs['id_prato']);?>&&id_promocao=<?php echo($rs['id_promocao']);?>">
                                      <img src="imagens/delete_13221.png"/>
                                    </a>
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

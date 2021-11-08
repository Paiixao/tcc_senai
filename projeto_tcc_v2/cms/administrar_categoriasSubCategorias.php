<?php
  session_start();
  include('include_cms/include_conexao.php');

  $btn = "SALVAR";

  if(isset($_GET['modo'])){
    $_SESSION['id_categoria'] = $_GET['id_categoria'];
    $_SESSION['id_subCategoria'] = $_GET['id_subCategoria'];

    $modo = $_GET['modo'];

    if($modo == "excluir"){
      $sql="delete from categoria_subCategoria where id_categoria = ".$_SESSION['id_categoria'] . " and id_subCategoria = ".$_SESSION['id_subCategoria'];
      mysqli_query($con, $sql);
    }

  }

 if (isset($_POST['btnsalvar_categoria'])) {

    $btn = $_POST['btnsalvar_categoria'];
    $id_categoria = strip_tags($_POST['sl_categoria']);
    $id_subCategoria = strip_tags($_POST['sl_subCategoria']);

    if ($btn == "SALVAR") {
      $sql = "INSERT INTO categoria_subCategoria(id_categoria, id_subCategoria) VALUES('".$id_categoria."', '".$id_subCategoria."')";
    }

    mysqli_query($con, $sql);
    header("location: administrar_categoriasSubCategorias.php");
  }

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Categorias/Sub-categorias</title>
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
                            Administrar Categoria
                        </div>

                    </div>

                    <div class="apoio_categoria">
                      <form action="administrar_categoriasSubCategorias.php" method="post" name="frm_categorias" required>
                        <div class="categoria_produto">
                            Categoria:

                            <select name="sl_categoria" class="edit_select_categoria">
                                <option value="0">Selecione uma Categoria</option>
                                <?php
                                   $sql = "select * from categoria;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_categoria"]); ?>"><?php echo($rs["nome_categoria"]); ?></option>
                                 <?php
                                     }
                                 ?>
                            </select>
                        </div>

                        <div class="subcategoria_produto">
                            Subcategoria:
                            <select name="sl_subCategoria" class="edit_select_categoria" required>
                                <option value="0">Selecione uma Categoria</option>
                                <?php
                                   $sql = "select * from sub_categoria;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_subCategoria"]); ?>"><?php echo($rs["nome_subCategoria"]); ?></option>
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
                            <form name="pesquisa" method="post" action="administrar_categoriasSubCategorias.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_categoria">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_categoria">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_categorias">
                        <table  class="tabela_categorias">
                            <tr>
                                <td><strong>ID da categoria</strong></td>
                                <td><strong>Nome da Categoria</strong></td>
                                <td><strong>ID da sub-categoria</strong></td>
                                <td><strong>Nome da sub-categoria</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                              if(isset($_POST['botao_pesquisar'])){
                                  $pesquisa=$_POST['text_pesquisar'];
                                    $sql= "SELECT * FROM categoria_subCategoria as sc INNER JOIN categoria as c on(c.id_categoria=sc.id_categoria)";
                                    $sql.=" inner join sub_categoria as s on(s.id_subCategoria=sc.id_subCategoria)";
                                    $sql.=" where c.nome_categoria like '".$pesquisa."%' or s.nome_subCategoria like '".$pesquisa."'";
                                }else{
                                   $sql= "SELECT * FROM categoria_subCategoria as sc INNER JOIN categoria as c on(c.id_categoria=sc.id_categoria)";
                                   $sql.=" inner join sub_categoria as s on(s.id_subCategoria=sc.id_subCategoria)";
                              }
                             
                              $select = mysqli_query($con, $sql);

                              while($rs=mysqli_fetch_array($select)){
                             ?>
                             <tr>
                                  <td><strong><?php echo ($rs['id_categoria']); ?></strong></td>
                                  <td><strong><?php echo ($rs['nome_categoria']); ?></strong></td>
                                  <td><strong><?php echo ($rs['id_subCategoria']); ?></strong></td>
                                  <td><strong><?php echo ($rs['nome_subCategoria']); ?></strong></td>
                                  <td class="img_tabela">
                                    <a href="administrar_categoriasSubCategorias.php?modo=excluir&&id_categoria=<?php echo($rs['id_categoria']);?>
                                      &&id_subCategoria=<?php echo($rs['id_subCategoria']);?>"><img src="imagens/delete_13221.png"/></a>
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

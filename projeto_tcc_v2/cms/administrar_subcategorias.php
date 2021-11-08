<?php
  session_start();
  include('include_cms/include_conexao.php');

  $nome_subCategoria = "";
  $btn ="SALVAR";

  if (isset($_GET['modo'])) {
    $_SESSION['cod'] = $_GET['cod'];
    $modo=$_GET['modo'];
  
    if($modo=="editar"){
      $sql = "SELECT * FROM sub_categoria where id_subCategoria = ".$_SESSION['cod'];
      $select = mysqli_query($con, $sql);
      $rs = mysqli_fetch_array($select);
    
      $nome_subCategoria = $rs['nome_subCategoria'];
      $btn = "EDITAR";
  
    }else if($modo=="excluir"){
      $sql="delete from sub_categoria where id_subCategoria = ".$_SESSION['cod'];
      mysqli_query($con, $sql);
    }
  
  }

  if (isset($_POST['btnsalvar_subcategoria'])) {

    $nome_subCategoria = strip_tags($_POST['txtsubcategoria']);
    $btn = $_POST['btnsalvar_subcategoria'];

    if ($btn == "SALVAR") {
      $sql = "INSERT INTO sub_categoria (nome_subCategoria) VALUES('".$nome_subCategoria."')";
    }elseif ($btn == "EDITAR") {
      $sql = "UPDATE sub_categoria SET nome_subCategoria = '".$nome_subCategoria."' where id_subCategoria=".$_SESSION['cod'];
    }

    mysqli_query($con, $sql);
    
    header("location:administrar_subcategorias.php");
  }
 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Subcategorias</title>
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
                    
                    <div class="apoio_subcategoria">

                        <div class="titulo_subcategorias">
                            Administrar Subcategoria
                        </div>

                    </div>

                    <form name="frm_subCategoria" method="post" action="administrar_subcategorias.php">
                        <div class="apoio_subcategoria">

                            <div class="nome_subcategoria">
                                Nome da Subcategoria: <input type="text" name="txtsubcategoria" value="<?php echo($nome_subCategoria); ?>" required class="edit_txtbox_subcategoria">
                            </div>

                        </div>

                        <div class="apoio_subcategoria">
                            <div class="botao_subcategoria">
                                <input type="submit" name="btnsalvar_subcategoria" value="<?php echo($btn); ?>" class="edit_submit">
                            </div>
                        </div>
                    </form>

                    <div class="apoio_subcategoria">
                        <div class="apoio_pesquisa_subcategoria">
                            <form name="pesquisa" method="post" action="administrar_subcategorias.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_categoria">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_subcategoria">
                             </form>
                        </div>
                    </div>
                
                    <div class="apoio_tabela_subcategorias">
                        <table  class="tabela_subcategorias">
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Nome da Subcategoria</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>
    
                            <?php
                              if(isset($_POST['botao_pesquisar'])){
                                  $pesquisa=$_POST['text_pesquisar'];
                                   $sql = "SELECT * FROM sub_categoria where nome_subCategoria like '".$pesquisa."%'";
                                }else{
                                  $sql = "SELECT * FROM sub_categoria;";
                              }
                             
                              $select = mysqli_query($con, $sql);
    
                              while($rs=mysqli_fetch_array($select)){
                             ?>
                             <tr >
                                 <td><strong><?php echo ($rs['id_subCategoria']); ?></strong></td>
                                 <td><strong><?php echo ($rs['nome_subCategoria']); ?></strong></td>
                                 <td class="img_tabela">
                                    <a href="administrar_subcategorias.php?modo=excluir&cod=<?php echo($rs['id_subCategoria']);?>"><img src="imagens/delete_13221.png"/></a> 
                                    <a href="administrar_subcategorias.php?modo=editar&cod=<?php echo($rs['id_subCategoria']);?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png
                                    "/>
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

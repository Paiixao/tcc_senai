<?php
  session_start();
  include('include_cms/include_conexao.php');

  $nome_categoria = "";
  $btn = "SALVAR";

  if(isset($_GET['modo'])){
    $_SESSION['cod'] = $_GET['cod'];
    $modo = $_GET['modo'];

    if($modo == "excluir"){
      $sql="delete from categoria where id_categoria = ".$_SESSION['cod'];
      mysqli_query($con, $sql);
    }else{
      $sql = "SELECT * FROM categoria WHERE id_categoria = ".$_SESSION['cod'];
      $select = mysqli_query($con, $sql);

      $rs = mysqli_fetch_array($select);

      $nome_categoria = $rs['nome_categoria'];
      $btn = "EDITAR";
    }
  }

 if (isset($_POST['btnsalvar_categoria'])) {

    $nome_categoria = strip_tags($_POST['txtcategoria']);
    $btn = $_POST['btnsalvar_categoria'];

    if ($btn == "SALVAR") {

      $sql = "INSERT INTO categoria (nome_categoria) VALUES('".$nome_categoria."')";

    }elseif ($btn == "EDITAR") {

      $sql = "UPDATE categoria SET nome_categoria = '".$nome_categoria."' WHERE id_categoria = ".$_SESSION['cod'];

    }

    mysqli_query($con, $sql);
    header("location: administrar_categorias.php");
}

if (isset($_GET['modo'])) {
  
}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Categorias</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
                      <form action="administrar_categorias.php" method="post" name="frm_categorias">
                        <div class="nome_categoria">
                            Nome da Categoria: <input type="text" name="txtcategoria" value="<?php echo($nome_categoria); ?>" required class="edit_txtbox_categoria">
                        </div>

                        <div class="botao_categoria">
                            <input type="submit" name="btnsalvar_categoria" value="<?php echo($btn) ?>" class="edit_submit">
                        </div>
                      </form>
                    </div>

                    <div class="apoio_categoria">
                        <div class="apoio_pesquisa_categoria">
                            <form name="pesquisa" method="post" action="administrar_categorias.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_categoria">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_categoria">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_categorias">
                        <table  class="tabela_categorias">
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Nome da Categoria</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                              if(isset($_POST['botao_pesquisar'])){
                                  $pesquisa=$_POST['text_pesquisar'];
                                    $sql= "SELECT c.id_categoria, c.nome_categoria FROM categoria as c WHERE nome_categoria LIKE '".$pesquisa."%';";
                                }else{
                                   $sql= "SELECT c.id_categoria, c.nome_categoria FROM categoria as c";
                              }
                             
                              $select = mysqli_query($con, $sql);

                              while($rs=mysqli_fetch_array($select)){
                             ?>
                             <tr>
                                  <td><strong><?php echo ($rs['id_categoria']); ?></strong></td>
                                  <td><strong><?php echo ($rs['nome_categoria']); ?></strong></td>
                                  <td class="img_tabela">
                                    <a href="administrar_categorias.php?modo=excluir&&cod=<?php echo($rs['id_categoria']); ?>"><img src="imagens/delete_13221.png"/></a>
                                    <a href="administrar_categorias.php?modo=editar&&cod=<?php echo($rs['id_categoria']); ?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png"></a>
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

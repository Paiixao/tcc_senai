<?php
    session_start();
    include('include_cms/include_conexao.php');

    $nome_nivel = "";   
    $btn = "SALVAR";

    if (isset($_GET['modo'])) {
      $_SESSION['cod'] = $_GET['cod'];

      $sql="SELECT * FROM nivel WHERE id_nivel = ".$_SESSION['cod'];
      $select=mysqli_query($con, $sql);

      $rs=mysqli_fetch_array($select);

      $nome_nivel = $rs['nome_permissao'];
      $btn="EDITAR";

    }

    if(isset($_POST['btnsalvar'])) {

      $nome_nivel = strip_tags($_POST['txtnivel']);
      $btn = $_POST['btnsalvar'];

      if($btn=="SALVAR"){
        $sql="INSERT INTO nivel(nome_nivel) VALUES ('".$nome_nivel."')";

      }elseif($btn=="EDITAR"){
        $sql="UPDATE nivel SET nome_nivel = '".$nome_nivel."' where id_nivel = ".$_SESSION['cod'];
      }

      mysqli_query($con, $sql);
      header("location:administrar_niveis.php");
    }

 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content Type" content="text/html" charset="utf-8">
        <title>Adicionar Niveis</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    <form method="post"  name="fmr_nivel" action="adicionar_niveis.php">
                        <div class="apoio_titulo">
                            <div class="botao_voltar">
                                <a href="administrar_niveis.php"><img src="imagens/voltar.png"></a>
                            </div>
                            <div class="titulo_addnivel">
                                <p>Adicionar Nivel</p>
                            </div>
                        </div>

                        <div class="frm_nivel">
                            <div class="nome_addnivel">
                                Nome do Nível: <input type="text" name="txtnivel" value="<?php echo($nome_nivel); ?>" required class="edit_txtbox_nivel">
                            </div>
                        </div>
                        <div class="frm_nivel">

                            <div class="botao_addnivel">
                                <input type="submit" name="btncancelar" value="CANCELAR" class="edit_submit">
                                <input type="submit" name="btnsalvar" value="<?php echo($btn); ?>" class="edit_submit">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="rodape">
                <p>Desenvolvido por 3GCJ</p>
            </div>
        </div>

    </body>
</html>

<?php
    session_start();
    include('include_cms/include_conexao.php');

    $nome_permissao = "";
    $administra_prato = "";
    $btn = "SALVAR";

    if (isset($_GET['modo'])) {
      $_SESSION['cod'] = $_GET['cod'];

      $sql = "SELECT * FROM permissao WHERE id_permissao = ".$_SESSION['cod'];
      $select = mysqli_query($con, $sql);

      $rs = mysqli_fetch_array($select);

      $nome_permissao = $rs['nome_permissao'];
      $administra_prato = $rs[''];
      $btn = "EDITAR";

    }

    if (isset($_POST['btnsalvar'])) {

      $nome_permissao = $_POST['txtprato'];
      $administra_prato = $_POST['rdoopcao'];
      $btn = $_POST['btnsalvar'];

      if ($btn == "SALVAR") {

        $sql = "INSERT INTO permissao (nome_permissao, nome do outro campar que nao sei como ta) VALUES ('".$nome_permissao."', '".$administra_prato."')";

      }elseif ($btn == "EDITAR") {

        $sql = "UPDATE permissao SET nome_permissao = '".$nome_permissao."', nome do outro campar que nao sei como ta = '".$administra_prato."'   ";

      }

      mysqli_query($con, $sql);
      header("location:adicionar_permissoes.php");
    }

 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content Type" content="text/html" charset="utf-8">
        <title>Adicionar Pratos</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    <form method="post"  name="fmr_permissao" action="adicionar_permissoes.php">
                        <div class="apoio_titulo">
                            <div class="botao_voltar">
                                <a href="administrar_permissoes.php"><img src="imagens/voltar.png"></a>
                            </div>
                            <div class="titulo_addpermissao">
                                <p>Adicionar Permissão</p>
                            </div>
                        </div>

                        <div class="frm_permissao">
                            <div class="nome_addpermissao">
                                Nome da Permissão: <input type="text" name="txtprato" value="" required class="edit_txtbox_addpermissao">
                            </div>
                        </div>

                        <div class="apoio_tabela_addpermissao">

                            <table class="tabela_addpermissao">

                                <tr>
                                    <td><strong>Página</strong></td>
                                    <td><strong>Permissão</strong></td>
                                </tr>

                                <tr>
                                    <td>Administrar Pratos</td>
                                    <td><div class="edit_radio_permissao">
                                            <input type="radio" name="rdoopcao" value="m" maxlength="20px"> Tem permissão para acessar
                                            <input type="radio" name="rdoopcao" value="d" required> Não tem permissão para acessar
                                        </div>
                                    </td>
                                </tr>

                            </table>

                        </div>

                        <div class="frm_permissao">

                            <div class="botao_addpermissao">
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

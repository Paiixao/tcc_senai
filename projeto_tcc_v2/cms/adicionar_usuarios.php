<?php
    session_start();  
    include('include_cms/include_conexao.php');
    include('validar.php');

  $nome_completo = "";
  $email = "";
  $nome_usuario = "";
  $senha_usuario = "";
  $confirm_senha = "";
  $id_funcionario = "";
  $id_permissao = "";
  $btn = "SALVAR";

  if(isset($_GET['modo'])) {
    $_SESSION['cod'] = $_GET['cod'];

    $sql = "SELECT * FROM usuario WHERE id_usuario = ".$_SESSION['cod'];
    $select = mysqli_query($con, $sql);

    $rs = mysqli_fetch_array($select);

    $nome_completo = $rs['nome_completo'];
    $email = $rs['email'];
    $nome_usuario = $rs['nome_usuario'];
    $senha_usuario = $rs['senha'];
    $confirm_senha = $rs['senha'];
    $id_funcionario = $rs['id_funcionario'];
    $id_permissao = $rs['id_nivel'];
    $btn = "EDITAR";

  }

  if (isset($_POST['btnsalvar'])) {

    $nome_completo = strip_tags($_POST['txt_nome_completo']);
    $email = strip_tags($_POST['txtemail']);
    $nome_usuario = strip_tags($_POST['txtusuario']);
    $senha_usuario = strip_tags($_POST['txtsenha']);
    $confirm_senha = strip_tags($_POST['txt_confirm_senha']);
    $id_funcionario = strip_tags($_POST['funcionario']);
    $id_permissao = strip_tags($_POST['nivel']);
    $btn = strip_tags($_POST['btnsalvar']);

    if ($senha_usuario != $confirm_senha) {
      ?> <script type="text/javascript"> alert("As senhas não coincidem!");</script><?php
    }else{

        if(!validar_email($email)){
            ?><script type="text/javascript">alert("Preencha os campos corretamente!");</script><?php
        }else{

          if($btn=="SALVAR"){
            $sql = "INSERT INTO usuario (id_funcionario, id_nivel, nome_completo, email, nome_usuario, senha) VALUES('".$id_funcionario."', '".$id_permissao."',";
            $sql.=" '".$nome_completo."', '".$email."', '".$nome_usuario."', SHA1('".$senha_usuario."')";

          }elseif($btn=="EDITAR"){
            $sql = "UPDATE usuario SET id_funcionario = '".$id_funcionario."', id_nivel = '".$id_permissao."', nome_completo = '".$nome_completo."',";
            $sql.=" email = '".$email."', nome_usuario = '".$nome_usuario."', senha = SHA1('".$senha."')";
          }

          mysqli_query($con, $sql);
          header("location: administrar_usuarios.php");
        }
    }
  }
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Adicionar Usuário</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_titulo">
                        <div class="botao_voltar">
                            <a href="administrar_usuarios.php"><img src="imagens/voltar.png"></a>
                        </div>
                        <div class="titulo_adicionar_usuarios">
                            <p>Adicionar Usuários</p>
                        </div>
                    </div>

                    <div class="frm_usuarios">
                      <form action="adicionar_usuarios.php" method="post" name="frm_usuarios">
                        <div class="nome_completo_usuario">
                            Nome Completo:  <input type="text" name="txt_nome_completo" value="<?php echo($nome_completo); ?>" required class="edit_nome_completo">
                        </div>

                        <div class="email_usuario">
                            Email:  <input type="email" name="txtemail" value="<?php echo($email); ?>" required class="edit_email_usuario">
                        </div>

                        <div class="nome_usuario">
                            Nome do Usuário:  <input type="text" name="txtusuario" value="<?php echo($nome_usuario); ?>" required class="edit_txtbox_usuario">
                        </div>

                        <div class="senha_usuario">
                            Senha do Usuário: <input type="password" name="txtsenha" value="<?php echo($senha_usuario); ?>" required class="edit_senha_usuario">
                        </div>

                        <div class="confirm_senha">
                            Confirmar Senha: <input type="password" name="txt_confirm_senha" value="<?php echo($confirm_senha); ?>" required class="edit_confirm_senha">
                        </div>

                        <div class="id_funcionario">
                            Funcionario:
                            <select name="funcionario" class="edit_select_id" required>
                                <option value="0">Selecione um funcionário</option>
                                <?php 
                                    $sql="select * from funcionario;";
                                    $select=mysqli_query($con, $sql);

                                    while($rs=mysqli_fetch_array($select)){

                                 ?>
                                    <option value="<?php echo($rs['id_funcionario']); ?>"><?php echo($rs['nome_funcionario']); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="permissao_usuario">
                            Funcionario:
                            <select name="nivel" class="edit_select_id" required>
                                <option value="0">Selecione um nivel</option>
                                <?php 
                                    $sql="select * from nivel;";
                                    $select=mysqli_query($con, $sql);

                                    while($rs=mysqli_fetch_array($select)){

                                 ?>
                                    <option value="<?php echo($rs['id_nivel']); ?>"><?php echo($rs['nome_nivel']); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="botao_addusuario">
                            <input type="submit" name="btncancelar" value="CANCELAR" class="edit_submit">
                            <input type="submit" name="btnsalvar" value="<?php echo($btn); ?>" class="edit_submit">
                        </div>
                      </form>
                    </div>
                    
                </div>
            </div>
            <div class="rodape">
                <p>Desenvolvido por 3GCJ</p>
            </div>
        </div>

    </body>
</html>

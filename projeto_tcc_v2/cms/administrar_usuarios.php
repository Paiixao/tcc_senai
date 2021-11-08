<?php
  session_start();
  include('include_cms/include_conexao.php');

  if(isset($_GET['modo'])) {
    $cod=$_GET['cod'];

		$sql="delete from usuario where id_usuario = ".$cod;
		mysqli_query($con, $sql);
    header("location: administrar_usuarios.php");
  }
 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Usuários</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_administrar_usuarios">
                        <div class="titulo_administrar_usuarios">
                            Administrar Usuários
                        </div>
                    </div>

                    <div class="apoio_administrar_usuarios">
                        <a href="adicionar_usuarios.php">
                        <div class="adicionar_usuarios">
                            <div class="text_addusuarios">
                                Adicionar Usuários
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="apoio_administrar_usuarios">
                        <div class="apoio_pesquisa_usuarios">
                            <form name="pesquisa" method="post" action="administrar_usuarios.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_usuarios">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_usuarios">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_usuarios">
                        <table  class="tabela_usuarios">
                            <tr bgcolor="#CCCCCC">
                                <td><strong>ID</strong></td>
                                <td><strong>Nome</strong></td>
                                <td><strong>E-mail</strong></td>
                                <td><strong>Nome de usuário</strong></td>
                                <!-- <td><strong>Telefone</strong></td> -->
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                     $sql = "SELECT u.id_usuario, f.nome_funcionario, n.nome_nivel, u.nome_completo, u.email, u.nome_usuario, u.senha FROM usuario AS u ";
                                     $sql.= "INNER JOIN funcionario AS f ON(u.id_funcionario = f.id_funcionario) INNER JOIN nivel AS n ON(u.id_nivel = n.id_nivel)";
                                     $sql.= " WHERE nome_completo like '".$pesquisa."%';";
                                }else{
                                     $sql = "SELECT u.id_usuario, f.nome_funcionario, n.nome_nivel, u.nome_completo, u.email, u.nome_usuario, u.senha FROM usuario AS u ";
                                     $sql.= "INNER JOIN funcionario AS f ON(u.id_funcionario = f.id_funcionario) INNER JOIN nivel AS n ON(u.id_nivel = n.id_nivel)";
                                }

                           
                            $select = mysqli_query($con, $sql);
                            while($rs=mysqli_fetch_array($select)){
                                      ?>


                            <tr>
                              <td><?php echo ($rs['id_usuario']); ?></td>
                              <td><?php echo ($rs['nome_completo']); ?></td>
                              <td><?php echo ($rs['email']); ?></td>
                              <td><?php echo ($rs['nome_usuario']); ?></td>
                              <!-- <td><?php echo ($rs['telefone']); ?></td> -->
                              <td class="img_tabela">
                                <a href="administrar_usuarios.php?modo=excluir&&cod=<?php echo($rs['id_usuario']);?>"><img src="imagens/delete_13221.png"/></a>
                                <a href="adicionar_usuarios.php?modo=editar&&cod=<?php echo($rs['id_usuario']); ?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png"/></a>
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
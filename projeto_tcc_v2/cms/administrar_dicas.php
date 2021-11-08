<?php
    session_start();
    include('include_cms/include_conexao.php');

    $tipo="";

    if(isset($_GET['modo'])){
      $cod=$_GET['cod'];
        
        $sql="delete from dica where id_dica = ".$cod;
        mysqli_query($con, $sql);     
    }
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Dicas</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_administrar_dicas">
                        <div class="titulo_administrar_dicas">
                            Administrar Dicas
                        </div>
                    </div>

                    <div class="apoio_administrar_dicas">
                        <a href="adicionar_dica.php">
                        <div class="adicionar_dica">
                            <div class="text_adddica">
                                Adicionar Dicas
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="apoio_administar_dicas">
                        <div class="apoio_pesquisa_dicas">
                            <form name="pesquisa" method="post" action="administrar_dicas.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_dicas">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_dicas">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_dicas">
                        <table  class="tabela_dicas">
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Titulo</strong></td>
                                <td><strong>Conteudo</strong></td>
                                <td><strong>Imagem</strong></td>
                                <td><strong>Tipo</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                    $sql = "SELECT d.id_dica, d.titulo, substring(d.conteudo, 1, 150) as conteudo, d.img_dica, d.tipo_dica FROM dica AS d";
                                    $sql.= " WHERE titulo like '".$pesquisa."%';";
                                  }else{
                                    $sql = "SELECT d.id_dica, d.titulo, substring(d.conteudo, 1, 150) as conteudo, d.img_dica, d.tipo_dica FROM dica AS d";
                                }
  
                                $select = mysqli_query($con, $sql);

                              while($rs=mysqli_fetch_array($select)){
                                
                                  if($rs['tipo_dica']==0){
                                      $tipo="Dica do mes";
                                  }
                                  
                                  elseif($rs['tipo_dica']==1){
                                      $tipo="Dica do Dia a Dia";
                                  }
                             ?>

                            <tr>
                              <td><?php echo ($rs['id_dica']); ?></td>
                              <td><?php echo ($rs['titulo']); ?></td>
                              <td><?php echo ($rs['conteudo']."..."); ?></td>
                              <td class="coluna_img"><img src="<?php echo ("imagens/".$rs['img_dica']); ?>" alt=""/> </td>
                              <td><?php echo ($tipo); ?> </td>

                                <td class="img_tabela">
                                  <a href="administrar_dicas.php?modo=excluir&&cod=<?php echo($rs['id_dica']); ?>"><img src="imagens/delete_13221.png"/></a>
                                          
                                  <a href="adicionar_dica.php?modo=editar&&cod=<?php echo($rs['id_dica']); ?>"><div class="imagem_editar_item"><img src="imagens/ic_mode_edit_black_24dp_2x.png"/></div></a>
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
<?php
  session_start();
  include('include_cms/include_conexao.php');

  $btn = "SALVAR";

  if(isset($_GET['modo'])){
    $_SESSION['id_nivel'] = $_GET['id_nivel'];
    $_SESSION['id_pagina'] = $_GET['id_pagina'];

    $modo = $_GET['modo'];

    if($modo == "excluir"){
      $sql="delete from nivel_pagina where id_nivel = ".$_SESSION['id_nivel'] . " and id_pagina = ".$_SESSION['id_pagina'];
      mysqli_query($con, $sql);
    }

  }

 if (isset($_POST['btnsalvar_categoria'])) {

    $btn = $_POST['btnsalvar_categoria'];
    $id_nivel = strip_tags($_POST['sl_nivel']);
    $id_pagina =strip_tags( $_POST['sl_pagina']);

    if ($btn == "SALVAR") {
      $sql = "INSERT INTO nivel_pagina(id_nivel, id_pagina) VALUES('".$id_nivel."', '".$id_pagina."')";
    }

    mysqli_query($con, $sql);
    header("location: administrar_nivelPagina.php");
  }

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Nivel/Pagina</title>
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
                      <form action="administrar_nivelPagina.php" method="post" name="frm_categorias">
                        <div class="categoria_produto">
                            Categoria:

                            <select name="sl_nivel" class="edit_select_categoria" required>
                                <option value="0">Selecione uma Nivel</option>
                                <?php
                                   $sql = "select * from nivel;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_nivel"]); ?>"><?php echo($rs["nome_nivel"]); ?></option>
                                 <?php
                                     }
                                 ?>
                            </select>
                        </div>

                        <div class="subcategoria_produto">
                            Subcategoria:
                            <select name="sl_pagina" class="edit_select_categoria" required>
                                <option value="0">Selecione uma Pagina</option>
                                <?php
                                   $sql = "select * from pagina;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_pagina"]); ?>"><?php echo($rs["nome_pagina"]); ?></option>
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
                                <td><strong>ID do nivel</strong></td>
                                <td><strong>Nome da nivel</strong></td>
                                <td><strong>ID da pagina</strong></td>
                                <td><strong>Nome da pagina</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                              if(isset($_POST['botao_pesquisar'])){
                                  $pesquisa=$_POST['text_pesquisar'];
                                   $sql= "SELECT * FROM nivel_pagina as np INNER JOIN nivel as n on(n.id_nivel=np.id_nivel)";
                                   $sql.=" inner join pagina as p on(p.id_pagina=np.id_pagina) where n.nome_nivel like '".$pesquisa."%'";
                                   $sql.=" or p.nome_pagina like  '".$pesquisa."%'";
                                }else{
                                   $sql= "SELECT * FROM nivel_pagina as np INNER JOIN nivel as n on(n.id_nivel=np.id_nivel)";
                                   $sql.=" inner join pagina as p on(p.id_pagina=np.id_pagina)";
                              }
                             
                              $select = mysqli_query($con, $sql);

                              while($rs=mysqli_fetch_array($select)){
                             ?>
                             <tr>
                                  <td><strong><?php echo ($rs['id_nivel']); ?></strong></td>
                                  <td><strong><?php echo ($rs['nome_nivel']); ?></strong></td>
                                  <td><strong><?php echo ($rs['id_pagina']); ?></strong></td>
                                  <td><strong><?php echo ($rs['nome_pagina']); ?></strong></td>
                                  <td class="img_tabela">
                                    <a href="administrar_nivelPagina.php?modo=excluir&&id_nivel=<?php echo($rs['id_nivel']);?>&&id_pagina=<?php echo($rs['id_pagina']);?>">
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

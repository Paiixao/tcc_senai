<?php
    session_start();
    include('include_cms/include_conexao.php');

    if(isset($_GET['modo'])){
      $modo=$_GET['modo'];

      if($modo=="excluir"){
          $id= $_GET['id'];
          $sql="delete from prato where id_prato='".$id."';";
          echo $sql;
        
      }elseif($modo=="ativar"){
        $ativo = $_GET['status'];
        $id= $_GET['id'];
        $sql="update prato set status = '".$ativo."' where id_prato = ".$id;
      }

      mysqli_query($con, $sql);  
      // header("location:administrar_pratos.php");  
  }

  header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title>Administrar Pratos</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
    </head>
    <body>
        <div class="principal">

        	<div class="cabecalho">
            	<?php include('include_cms/include_cabecalho_cms.php') ?>
          </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_administar_produtos">
                        <div class="titulo_administrar_produtos">
                            Administrar Pratos
                        </div>
                    </div>

                    <div class="apoio_administar_produtos">
                        <a href="adicionar_pratos.php">
                        <div class="adicionar_prato">
                            <div class="text_addprato">
                                Adicionar Prato
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="apoio_administar_produtos">
                        <div class="apoio_pesquisa_produtos">
                            <form name="pesquisa" method="post" action="administrar_pratos.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_produtos">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_produtos">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_produtos">
                        <table  class="tabela_produtos">
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Nome do prato</strong></td>
                                <td><strong>Ingredientes</strong></td>
                                <td><strong>Preço</strong></td>
                                <td><strong>Tempo</strong></td>
                                <td><strong>Calorias</strong></td>
                                <td><strong>Foto do Produto</strong></td>
                                <td><strong>Status</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                              if(isset($_POST['botao_pesquisar'])){
                                $pesquisa=$_POST['text_pesquisar'];
                                $sql="select * from prato where nome_prato like '".$pesquisa."%';";
                              }else{
                                $sql = "select * from prato as p inner join imagem_prato as ip on(ip.id_prato=p.id_prato) ";
                                $sql .= " where ip.img_principal = 1 group by p.id_prato;";
                              }

                              $select=mysqli_query($con, $sql);
                              $cont = 0;

                              while($rs= mysqli_fetch_array($select)){
                                if($rs['status']==1){
                                  $status = "Ativo";
                                  $ativo = 0;
                                }else{
                                 $status = "Inativo";
                                 $ativo = 1;
                               }
                               if(strlen($rs['descricao']) > 10){
                                  $rs['descricao'] = substr($rs['descricao'], 0, 60)."...";
                                }
                            ?>

                            <tr>
                              <td><?php echo($rs["id_prato"]); ?></td>
                              <td><?php echo($rs["nome_prato"]); ?></td>
                              <td><?php echo($rs["descricao"]); ?></td>
                              <td><?php echo($rs["preco"]); ?></td>
                              <td><?php echo($rs["duracao"]); ?></td>
                              <td><?php echo($rs["qtd_calorias"]); ?></td>
                              <td class="img_parceiro"><img src="<?php echo("imagens/".$rs["imagem"]); ?>" alt=""/></td>
                              <td><a href="administrar_pratos.php?modo=ativar&id=<?php echo($rs["id_prato"]); ?>&status=<?php echo($ativo); ?>"><?php echo($status); ?></a></td>
                              <td class="img_tabela">
                                <a href="administrar_pratos.php?modo=excluir&id=<?php echo($rs["id_prato"]); ?>"><img src="imagens/delete_13221.png"/></a>
                                <a href="adicionar_pratos.php?modo=editar&id=<?php echo($rs["id_prato"]); ?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png"/></a>
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

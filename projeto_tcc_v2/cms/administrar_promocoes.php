<?php
  session_start();
  include('include_cms/include_conexao.php');

  if (isset($_GET['modo'])) {
    $cod=$_GET['cod'];
    $modo=$_GET['modo'];

    if($modo=="excluir"){
        $sql="delete from promocao where id_promocao = ".$cod;
    
    }elseif($modo=="ativar"){
        $ativo = $_GET['status'];
        $sql="update promocao set status = '".$ativo."' where id_promocao = ".$cod;
    }
    // ECHO $sql;
    mysqli_query($con, $sql);
    header("location: administrar_promocoes.php");
  }

function desativar_data($rs){
    include('include_cms/include_conexao.php');
    date_default_timezone_set("America/Sao_Paulo");
    $hoje = new DateTime (date("Y-m-d"));
    $dt_final = new DateTime($rs['dt_final']);

    if($hoje == $dt_final){
        $sql = "update promocao set status = 0 where id_promocao =".$rs['id_promocao'];
        mysqli_query($con, $sql);  
    } 
}

 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Promoções</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

            	<?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    
                    <div class="apoio_administar_promocoes">
                        <div class="titulo_administrar_promocoes">
                            Administrar Promoções
                        </div>
                    </div>

                    <div class="apoio_administar_promocoes">
                        <a href="adicionar_promocao.php">
                        <div class="adicionar_promocao">
                            <div class="text_addpromocao">
                                Adicionar Promoção
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="apoio_administar_promocoes">
                        <div class="apoio_pesquisa_promocoes">
                            <form name="pesquisa" method="post" action="administrar_promocoes.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_promocoes">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_promocoes">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_promocoes">
                        <table  class="tabela_promocoes">
                            <tr>
                                <td><strong>ID</strong></td>
                                <td><strong>Nome da promoção</strong></td>
                                <td><strong>Desconto</strong></td>
                                <td><strong>Pratos</strong></td>
                                <td><strong>Duração</strong></td>
                                <td><strong>Status</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                    $sql = "SELECT * FROM promocao AS P WHERE titulo_promocao LIKE '".$pesquisa."%' AND status = 1;";
                                  }else{
                                    $sql = "SELECT *, DATE_FORMAT(dt_inicio, '%d-%m-%Y') as dt_inicio, DATE_FORMAT(dt_final, '%d-%m-%Y') as dt_final";
                                    $sql .= " FROM promocao AS P left join promocao_prato as pp on(pp.id_promocao=p.id_promocao) WHERE p.status = 1";
                                  }
                                    $select = mysqli_query($con, $sql);
                                  while ($rs=mysqli_fetch_array($select)) {
                                    desativar_data($rs);

                                    if($rs['status']==1){
                                      $status = "Ativo";
                                      $ativo = 0;
                                    }else{
                                     $status = "Inativo";
                                     $ativo = 1;
                                   }
                             ?>

                            <tr>
                                <td><?php echo ($rs['id_promocao']); ?></td>
                                <td><?php echo ($rs['titulo_promocao']); ?></td>
                                <td><?php echo ($rs['desconto']); ?></td>
                                <td>
                                <?php
                                    if($rs['id_prato']!=null){ 
                                        $sql_pratos = "select * from promocao_prato as pp inner join prato as p on(pp.id_prato=p.id_prato)";
                                        $sql_pratos.= "  where pp.id_promocao = ".$rs['id_promocao'];
                                        $select_prato = mysqli_query($con, $sql_pratos);

                                         while($rs_prato=mysqli_fetch_array($select_prato)) {
                                            echo($rs_prato['nome_prato']."/");
                                         }
                                    }else{
                                        echo("Esse pedido não possue pratos ainda!");
                                    }

                                 ?>
                                </td>
                                <td><?php echo ($rs['dt_inicio']); ?> / <?php echo ($rs['dt_final']); ?></td>
                                <td>
                                    <a href="administrar_promocoes.php?modo=ativar&cod=<?php echo($rs["id_promocao"]); ?>&status=<?php echo($ativo); ?>">
                                        <?php echo($status); ?>    
                                    </a>
                                </td>
                                <td class="img_tabela">
                                  <a href="administrar_promocoes.php?modo=excluir&&cod=<?php echo($rs['id_promocao']); ?>"><img src="imagens/delete_13221.png"/></a>
                                          
                                  <a href="adicionar_promocao.php?modo=editar&&cod=<?php echo($rs['id_promocao']); ?>"><img src="imagens/ic_mode_edit_black_24dp_2x.png"/></a>
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

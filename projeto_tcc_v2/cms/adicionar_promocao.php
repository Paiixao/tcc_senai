<?php
    session_start();
    include('include_cms/include_conexao.php');

    $uploaddir="imagens/";
    $botao="SALVAR";
    $nome="";
    $conteudo="";
    $desconto="";
    $inico="";
    $fim="";

    //TODO: Fazer o select com o id vindo da url e preencher as variaveis usadas no insert
    //Declarar variaveis vazias fora dos if's
    if(isset($_GET['modo'])){
         $_SESSION['id']=$_GET['cod'];

        $sql = "select * from promocao where id_promocao=".$_SESSION['id'].";";
        $select=mysqli_query($con, $sql);
        $rs= mysqli_fetch_array($select);

        $botao="EDITAR";
        $nome= $rs["titulo_promocao"];
        $desconto=$rs["desconto"];
        $inico=$rs["dt_inicio"];
        $fim=$rs["dt_final"];
    }


    if(isset($_POST['btnsalvar'])){

        $nome=strip_tags($_POST['titulo_promocao']);
        $desconto=strip_tags($_POST['desconto_promo']);
        $inico=strip_tags($_POST['inicio_promo']);
        $fim=strip_tags($_POST['fim_promo']);
        $botao=strip_tags($_POST['btnsalvar']);

        $dt_inicio = new DateTime($inico);
        $dt_final = new DateTime($fim);
      
            if($dt_inicio < $dt_final){
                if($botao=="SALVAR"){
                    $sql="insert into promocao (titulo_promocao, desconto, dt_inicio, dt_final)
                    values('".$nome."','".$desconto."','".$inico."','".$fim."');";
                }elseif($botao=="EDITAR"){
                    $sql="update promocao set titulo_promocao='".$nome."', desconto='".$desconto."',dt_inicio='".$inico."', dt_final='".$fim."' where id_promocao=".$_SESSION['id'].";";
                }

                    mysqli_query($con, $sql);
                    header("location: administrar_promocoes.php");
            }else{
                ?><script type="text/javascript">alert("Datas incorretas!");</script><?php
            }
    }

?>
<!DOCTYPE html>
<html>

    <head>
        <title>Adicionar Promoções</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../js/validar.js"></script>
        
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
                            <a href="administrar_promocoes.php"><img src="imagens/voltar.png"></a>
                        </div>
                        <div class="titulo_promocao">
                            <p>Adicionar Promoção</p>
                        </div>
                    </div>

                    <div class="frm_promocao">
                      <form action="adicionar_promocao.php" method="post" name="fmr_promocao" id="form">
                        <div class="nome_promocao">
                            Nome da Promoção: <input type="text" name="titulo_promocao" value="<?php echo($nome); ?>" required class="edit_txtbox_promo">
                        </div>

                        <div class="desconto_promocao">
                            Desconto: 

                            <select name="desconto_promo" class="edit_number_promo" required>
                                <?php 
                                    for($i=1; $i<=90; $i++){
                                        if($desconto==$i){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }
                                 ?>
                                <option value="<?php echo($i); ?>" <?php echo($selected); ?>><?php echo($i); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="inicio_promocao" required>
                            Inicio da Promoção: <input type="date" name="inicio_promo" class="edit_date_inicio" value="<?php echo($inico); ?>">
                        </div>

                        <div class="fim_promocao" required>
                            Fim da Promoção: <input type="date" name="fim_promo" class="edit_date_fim" value="<?php echo($fim); ?>">
                        </div>

                        <div class="botao_addpromocao">
                            <input type="submit" name="btncancelar" value="CANCELAR" class="edit_submit">
                            <input type="submit" name="btnsalvar" value="<?php echo($botao); ?>" class="edit_submit btn">
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

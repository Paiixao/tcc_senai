<?php
    session_start();
    include('include_cms/include_conexao.php');
    include("validar.php");

    $uploaddir="imagens/";
    $botao="SALVAR";
    $nome="";
    $ingrediente="";
    $preco="";
    $duracao="";
    $calorias="";
    $preparo="";
    $descricao="";
    $sub_categoria="";
    $nome_arquivo="";

    if(isset($_GET['modo'])){
        $_SESSION['cod']=$_GET['id'];

        $sql = "select * from prato where id_prato=".$_SESSION['cod'];
        $select=mysqli_query($con, $sql);
        $rs= mysqli_fetch_array($select);

        $botao="EDITAR";
        $nome= $rs["nome_prato"];
        $ingrediente=$rs["ingredientes"];
        $preco=$rs["preco"];
        $duracao=$rs["duracao"];
        $calorias=$rs["qtd_calorias"];
        $preparo=$rs["modo_preparo"];
        $descricao=$rs["descricao"];
    }


    if(isset($_POST['btnsalvar'])){

        $nome=strip_tags($_POST['txtprato']);
        $ingrediente=strip_tags($_POST['txtingrediente']);
        $preco=strip_tags($_POST['txtpreco']);
        $duracao=strip_tags($_POST['tempo']);
        $calorias=strip_tags($_POST['caloria']);
        $botao=strip_tags($_POST['btnsalvar']);
        $preparo=strip_tags($_POST['txtpreparo']);
        $descricao=strip_tags($_POST['txtdescricao']);
        $sub_categoria=strip_tags($_POST['select_subcategoria']);

        $img_1 = basename($_FILES["img_1"]["name"]);
        $img_2 = basename($_FILES["img_2"]["name"]);
        $img_3 = basename($_FILES["img_3"]["name"]);
        $img_4 = basename($_FILES["img_4"]["name"]);
        $img_5 = basename($_FILES["img_5"]["name"]);

        $uploadfile_1 = $uploaddir . $img_1;
        $uploadfile_2 = $uploaddir . $img_2;
        $uploadfile_3 = $uploaddir . $img_3;
        $uploadfile_4 = $uploaddir . $img_4;
        $uploadfile_5 = $uploaddir . $img_5;

        $movido_1=move_uploaded_file($_FILES["img_1"]["tmp_name"], $uploadfile_1);
        $movido_2=move_uploaded_file($_FILES["img_2"]["tmp_name"], $uploadfile_2);
        $movido_3=move_uploaded_file($_FILES["img_3"]["tmp_name"], $uploadfile_3);
        $movido_4=move_uploaded_file($_FILES["img_4"]["tmp_name"], $uploadfile_4);
        $movido_5=move_uploaded_file($_FILES["img_5"]["tmp_name"], $uploadfile_5);

        $preco = str_replace(",", ".", $preco);
        if(validar_numero($preco) || validar_numero($calorias)){
            ?><script type="text/javascript">alert("Preencha os campos corretamente!");</script><?php
        }else{
            if(strstr($img_1, '.jpg')|| strstr($img_1, '.png')){
                //vai pegar o arquivo que esta na maquina e copiar para o servidor
                if($movido_1 && $movido_2 && $movido_3 && $movido_4 && $movido_5){

                  $ingrediente = str_replace(",", ";", $ingrediente);

                  if($botao=="SALVAR"){
                      $sql="insert into prato (nome_prato, ingredientes, preco, duracao, qtd_calorias, modo_preparo, descricao, id_subCategoria)";
                      $sql.="values('".$nome."','".$ingrediente."','".$preco."','".$duracao."','".$calorias."','".$preparo."', '".$descricao."', ";
                      $sql.="'".$sub_categoria."');";
                      $sql_id="select * from prato order by id_prato desc;";
                  }elseif($botao=="EDITAR"){
                    $sql="update prato set nome_prato='".$nome."', ingredientes = '".$ingrediente."', descricao='".$descricao."',preco='".$preco."', ";
                    $sql.="duracao='".$duracao."',    qtd_calorias='".$calorias."', id_subCategoria='".$sub_categoria."' where id_prato=".$_SESSION['cod'].";";
                    $sql_delete="delete from imagem_prato where id_prato = ".$_SESSION['cod'];
                    mysqli_query($con, $sql_delete);
                    $sql_id="select * from prato where id_prato = '".$_SESSION['cod']."';";
                  }
                    
                    // echo $sql;
                    mysqli_query($con, $sql);
                    $select = mysqli_query($con, $sql_id);
                    $rs=mysqli_fetch_array($select);

                    $_SESSION['cod']=$rs['id_prato'];
                    $sql="insert into imagem_prato(imagem, id_prato, img_principal) values('".$img_1."', '".$_SESSION['cod']."', 1);";
                    $sql.="insert into imagem_prato(imagem, id_prato) values('".$img_2."', '".$_SESSION['cod']."');";
                    $sql.="insert into imagem_prato(imagem, id_prato) values('".$img_3."', '".$_SESSION['cod']."');";
                    $sql.="insert into imagem_prato(imagem, id_prato) values('".$img_4."', '".$_SESSION['cod']."');";
                    $sql.="insert into imagem_prato(imagem, id_prato) values('".$img_5."', '".$_SESSION['cod']."');";
                    mysqli_multi_query($con, $sql);
                    header("location: administrar_pratos.php");
            }else{
                echo("ARQUIVO NÃO MOVIDO");
            }
          }else{
                echo("ARQUIVO INCOMPATIVEL");
          }
        }
    }

?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content Type" content="text/html" charset="utf-8">
        <title>Adicionar Pratos</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="../js/files_preview.js"></script>
        <script src="../js/validar.js"></script>
        <script src="../js/select_categoria.js"></script>
        <script type="text/javascript">
            $(function(){
                $(".decimal").keyup(function(){$(this).val(mascara_decimal($(this).val()));});
                $("#time").keyup(function(){$(this).val(mascara_tempo($(this).val()));});
            });
        </script>
    </head>
    <body>
        <div class="principal">

            <div class="cabecalho">

                <?php include('include_cms/include_cabecalho_cms.php') ?>

            </div>

            <div class="conteudo">
                <div class="apoio_conteudo">
                    <form action="adicionar_pratos.php" method="post" name="frm_pratos" enctype="multipart/form-data">
                    <div class="apoio_titulo">
                        <div class="botao_voltar">
                            <a href="administrar_pratos.php"><img src="imagens/voltar.png"></a>
                        </div>
                        <div class="titulo_conteudo">
                            <p>Adicionar Pratos</p>
                        </div>
                    </div>

                    <div class="frm_conteudo">

                        <div class="nome_produto">
                            Nome do Prato: <input type="text" name="txtprato" value="<?php echo($nome); ?>" required class="edit_txtbox">
                        </div>

                        <div class="ingredientes_produto">

                            <div class="apoio22">Ingredientes:</div>

                            <textarea  name="txtingrediente" required class="edit_ingrediente_prato"><?php echo($ingrediente); ?></textarea>

                        </div>

                        <div class="tempo_produto">
                            <p>Tempo até a</p>
                            próxima refeição: <input type="text" id="time" name="tempo" class="edit_number" value="<?php echo($duracao); ?>" required>
                        </div>

                        <div class="calorias_produto">
                            Calorias do Prato: <input type="text" maxlength="7" name="caloria" class="edit_number decimal" value="<?php echo($calorias); ?>" required>
                        </div>

                        <div class="categoria_produto">
                            Categoria:

                            <select name="select_categoria" class="edit_select_categoria" required>
                                <option value="0">Selecione uma Categoria</option>
                                <?php
                                   $sql = "select * from categoria as c inner join categoria_subcategoria as cs on(cs.id_categoria=c.id_categoria);";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                 ?>
                                     <option value="<?php echo($rs["id_categoria"]); ?>"><?php echo($rs["nome_categoria"]); ?></option>
                                 <?php
                                     }
                                 ?>
                            </select>
                        </div>

                        <div class="subcategoria_produto">
                            Subcategoria:
                            <select name="select_subcategoria" class="edit_select_subcategoria" required>
                                <option value="0">Selecione uma subcategoria:</option>
                            </select>
                        </div>

                        <div class="preco_produto">
                            Preço do Prato: <input maxlength="7" type="text" name="txtpreco" value="<?php echo($preco); ?>" required class="edit_txtbox decimal">
                        </div>

                        <div class="preparo_produto">
                            Modo de Preparo: 
                            <textarea name="txtpreparo" cols="30" rows="3" required class="edit_modo_preparo_pratos" ><?php echo ($preparo); ?></textarea>
                        </div>

                        <div class="descricao_produto">
                            Descrição: 
                            <textarea name="txtdescricao" cols="30" rows="3" class="edit_textarea_descricao" required><?php echo ($descricao); ?></textarea>
                        </div>

                        <table id="tbl_img">
                            <tr class="foto_dica">
                                <td>Imagem Principal:</td>
                                <td><input type="file" name="img_1" id="img_file" required></td>
                            </tr class="foto_dica">
                            
                            <tr class="foto_dica">
                                <td>Imagem 2:</td>
                                <td><input type="file" name="img_2" id="img_file" required></td>
                            </tr>

                            <tr class="foto_dica">
                                <td>Imagem 3:</td>
                                <td><input type="file" name="img_3" id="img_file" required></td>
                            </tr>
                            
                            <tr class="foto_dica">
                                <td>Imagem 4:</td>
                                <td><input type="file" name="img_4" id="img_file" required></td>
                            </tr>

                            <tr class="foto_dica">
                                <td>Imagem 5:</td>
                                <td><input type="file" name="img_5" id="img_file" required></td>
                            </tr>   
                        </table>

                        <div class="botao_addproduto">
                            <input type="reset" name="btncancelar" value="CANCELAR" class="edit_submit">
                            <input type="submit" name="btnsalvar" value="<?php echo($botao); ?>" class="edit_submit">
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

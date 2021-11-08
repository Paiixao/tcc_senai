<?php
  session_start();
  include('include_cms/include_conexao.php');


  $upload_dir = "imagens/";

  $titulo_dica="";
	$conteudo_dica="";
	$img_dica="";
  $tipo_dica="";
  $prato="";
	$btn="SALVAR";

  if(isset($_GET['modo'])){

    $_SESSION['cod'] = $_GET['cod'];

    $sql = "SELECT * FROM dica AS d LEFT JOIN dica_prato AS dp ON(dp.id_dica=d.id_dica) WHERE d.id_dica =".$_SESSION['cod'];
    $select = mysqli_query($con ,$sql);

    $rs = mysqli_fetch_array($select);

    $titulo_dica = $rs['titulo'];
    $conteudo_dica = $rs['conteudo'];
    $img_dica = $rs['img_dica'];
    $tipo_dica=$rs['tipo_dica'];
    $prato=$rs['id_prato'];
    $_SESSION['id_prato']=$rs['id_prato'];
    $btn = "EDITAR";
  }


 if (isset($_POST['btnsalvar'])) {

    $titulo_dica = strip_tags($_POST['txtnomedica']);
    $conteudo_dica = strip_tags($_POST['txtdica']);
    $img_dica = basename($_FILES['img_dica']['name']);
    $tipo_dica=strip_tags($_POST['rdoopcao']);
    $btn = strip_tags($_POST['btnsalvar']);
    $prato = strip_tags($_POST['sl_prato']);


    $path_upload=$upload_dir.$img_dica;

    if (strstr($img_dica, ".jpg") || strstr($img_dica, ".png")) {
          if (move_uploaded_file($_FILES['img_dica']['tmp_name'], $path_upload)) {
            if ($btn == "SALVAR") {
                $sql = "INSERT INTO dica (titulo, conteudo, img_dica, tipo_dica) VALUES('".$titulo_dica."','".$conteudo_dica."','".$img_dica."','".$tipo_dica."')";

            }elseif ($btn == "EDITAR") {
              $sql = "UPDATE dica SET titulo = '".$titulo_dica."', conteudo = '".$conteudo_dica."', img_dica = '".$img_dica."',tipo_dica='".$tipo_dica."' 
              WHERE id_dica = ".$_SESSION['cod'];

              if($_SESSION['id_prato']!=$prato){
                   $sql_rel="delete from dica_prato where id_dica = '".$_SESSION['cod']."' and id_prato = '".$_SESSION['id_prato']."';";
                   $sql_rel.="insert into dica_prato(id_dica, id_prato) values('".$_SESSION['cod']."', '".$prato."');";
                   mysqli_multi_query($con, $sql_rel);    
              }  
        }
      }
    }
    
    if(mysqli_query($con, $sql) && $btn=="SALVAR"){
        $sql_rel = "select last_insert_id() as id;";
        $select = mysqli_query($con, $sql_rel);
        $rs=mysqli_fetch_array($select);

        $sql_rel="insert into dica_prato(id_dica, id_prato) values('".$rs['id']."', '".$prato."');";
        mysqli_query($con, $sql_rel);    
    }    
    header("location:administrar_dicas.php");
  }
 ?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content Type" content="text/html;" charset="utf-8">
        <title>Adicionar Dica</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="../js/files_preview.js"></script>
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
                            <a href="administrar_dicas.php"><img src="imagens/voltar.png"></a>
                        </div>
                        <div class="titulo_dica">
                            <p>Adicionar Dicas</p>
                        </div>
                    </div>

                    <div class="frm_dica">
                      <form method="post" name="form_dica" action="adicionar_dica.php" enctype="multipart/form-data">
                        <div class="edit_radio_dicas">
                             <input type="radio" name="rdoopcao" value="0" required> Dica do Mês
                             <input type="radio" name="rdoopcao" value="1" > Dica do Dia a Dia
                        </div>

                        <div class="nome_dica">
                            Nome da Dica: <input type="text" name="txtnomedica" value="<?php echo($titulo_dica); ?>" required class="edit_txtbox_dicas">
                        </div>

                        <div class="texto_dica">
                            Texto da Dica: <textarea required name="txtdica" cols="30" rows="3" class="edit_textarea_dicas"><?php echo ($conteudo_dica); ?></textarea>
                        </div>

                        <div class="foto_dica">
                            Foto: <input type="file" name="img_dica" class="edit_img_dica" id="img_file" required>
                            <div class="dica_img">
                              <img src="<?php echo ("cms/imagens/".$img_dica); ?>" id="img_preview"/>
                            </div>
                        </div>

                         <div class="categoria_produto">
                            Prato:

                            <select name="sl_prato" class="edit_select_categoria" required>
                                <option value="0">Selecione um prato</option>
                                <?php
                                   $sql = "select * from prato;";

                                   $select=mysqli_query($con, $sql);

                                   while($rs= mysqli_fetch_array($select)){
                                        if($rs['id_prato']==$prato){
                                            $sl="selected";
                                        }else{
                                            $sl="";
                                        }
                                 ?>
                                     <option <?php echo($sl); ?> value="<?php echo($rs["id_prato"]); ?>"><?php echo($rs["nome_prato"]); ?></option>
                                 <?php
                                     }
                                 ?>
                            </select>
                        </div>

                        <div class="botao_add_dica">
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

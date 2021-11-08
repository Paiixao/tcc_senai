<?php
    session_start();
    include('include_cms/include_conexao.php');

    $uploaddir="imagens/";
    $botao="SALVAR";

     if(isset($_GET['modo'])){
        $modo=$_GET['modo'];

        if($modo="excluir"){

            $id= $_GET['id'];
            $sql1="delete from slide where id_slide='".$id."';";
            mysqli_query($con, $sql1);
        }
    }

    if(isset($_POST['btnsalvar'])){
        $botao=$_POST['btnsalvar'];

		$nome_arquivo = basename($_FILES["img"]["name"]);
        $uploadfile = $uploaddir . $nome_arquivo;

        if(strstr($nome_arquivo, '.jpg')|| strstr($nome_arquivo, '.png')){
			//vai pegar o arquivo que esta na maquina e copiar para o servidor
			if(move_uploaded_file($_FILES["img"]["tmp_name"], $uploadfile)){
				  $sql="insert into slide (img_slide) values('".$uploadfile."');";

                mysqli_query($con, $sql);
                header("location: administrar_slides.php");
			}else{
				echo("ARQUIVO INCOMPATIVEL");
			}
        }
    }
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Administrar Slides</title>
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
                    <div class="apoio_administrar_slides">
                        <div class="titulo_slides">
                            Administar Slides
                        </div>
                    </div>

                    <div class="apoio_administrar_slides">
                        <div class="adicionar_slides">
                            <form name="frm_slides" method="post" action="administrar_slides.php" enctype="multipart/form-data">
                            Imagem do Slide: <input type="file" name="img" class="" id="img_file">
                            <div class="imagem_slide">
                                <img src="" id="img_preview" />
                            </div>
                            <input type="submit" name="btnsalvar" value="<?php echo($botao) ?>" class="edit_submit">
                        </form>
                        </div>
                    </div>

                    <div class="apoio_administrar_slides">
                        <div class="apoio_pesquisa_slides">
                            <form name="pesquisa" method="post" action="administrar_slides.php">
                                 <input type="text" name="text_pesquisar" value="" class="text_pesquisa_slides">
                                <input type="submit" name="botao_pesquisar" value="Pesquisar" class="botao_pesquisa_slides">
                             </form>
                        </div>
                    </div>

                    <div class="apoio_tabela_slides">
                        <table  class="tabela_slides">
                            <tr bgcolor="#CCCCCC">
                                <td><strong>ID</strong></td>
                                <td><strong>Caminho da imagem</strong></td>
                                <td><strong>imagem</strong></td>
                                <td><Strong>Opções</Strong></td>
                            </tr>

                            <?php
                                if(isset($_POST['botao_pesquisar'])){
                                    $pesquisa=$_POST['text_pesquisar'];
                                    $sql = "select * from slide where img_slide like '".$pesquisa."%';";
                                  }else{
                                    $sql = "select * from slide;";
                                }

                                $select=mysqli_query($con, $sql);
                                $cont = 0;

                                while($rs= mysqli_fetch_array($select)){

                                    if($cont%2==0){
                                        $style = "#FFFFFF";
                                        }else{
                                        $style = "#CCCCCC";
                                        }
                            ?>


                            <tr>
                              <td><?php echo($rs["id_slide"]); ?></td>
                              <td> <?php echo($rs["img_slide"]); ?></td>
                              <td class="coluna_img"><img src="<?php echo($rs["img_slide"]); ?>" alt=""/></td>
                              <td class="img_tabela">
                                <a href="administrar_slides.php?modo=excluir&id=<?php echo($rs["id_slide"]); ?>"><img src="imagens/delete_13221.png"/></a>
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

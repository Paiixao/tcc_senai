<?php
    session_start();
    include('include_cms/include_conexao.php');
    include('validar.php');

    $uploaddir="imagens/";
    $botao="SALVAR";
    $nome="";
    $email="";
    $telefone="";
    $site="";
    $texto="";

    //TODO: Fazer o select com o id vindo da url e preencher as variaveis usadas no insert
    //Declarar variaveis vazias fora dos if's
    if(isset($_GET['modo'])){
       $_SESSION['id']=$_GET['cod'];

        $sql = "select * from parceiro where id_parceiro=".$_SESSION['id'].";";
        $select=mysqli_query($con, $sql);
        $rs= mysqli_fetch_array($select);

        $botao="EDITAR";
        $nome= $rs["nome_parceiro"];
        $email=$rs["email"];
        $telefone=$rs["telefone"];
        $site=$rs["site"];
        $texto=$rs["informacao"];
    }


    if(isset($_POST['btnsalvar'])){

        $nome=strip_tags($_POST['txt_nome_parceiro']);
        $email=strip_tags($_POST['txt_email_parceiro']);
        $telefone=strip_tags($_POST['txt_telefone_parceiro']);
        $site=strip_tags($_POST['txt_site_parceiro']);
        $texto=strip_tags($_POST['txtinfo']);
        $botao=strip_tags($_POST['btnsalvar']);


        if(!validar_tel($telefone) && !validar_email($email)){
            ?><script type="text/javascript">alert("Preencha os campos corretamente!");</script><?php
        }else{
            $nome_arquivo = basename($_FILES["imgparceiro"]["name"]);
            $uploadfile = $uploaddir . $nome_arquivo;

            if(strstr($nome_arquivo, '.jpg')|| strstr($nome_arquivo, '.png')){
                //vai pegar o arquivo que esta na maquina e copiar para o servidor
                if(move_uploaded_file($_FILES["imgparceiro"]["tmp_name"], $uploadfile)){

                    if($botao=="SALVAR"){
                      $sql="insert into parceiro (nome_parceiro, telefone, email, site, logo_parceiro, informacao)
                        values('".$nome."','".$telefone."','".$email."','".$site."','".$uploadfile."','".$texto."');";
                    }
                    elseif($botao=="EDITAR"){
                         $sql="update parceiro set nome_parceiro='".$nome."', email='".$email."',telefone='".$telefone."', site='".$site."', informacao='".$texto."'"; 
                         $sql .= " where id_parceiro=".$_SESSION['id'];
                    }
                    
                    // echo $sql;
                    mysqli_query($con, $sql);
                    header("location: administrar_parceiros.php");
                }else{
                    echo("ARQUIVO INCOMPATIVEL");
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Adicionar Parceiro</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script src="../js/files_preview.js"></script>
        <script src="../js/validar.js"></script>
        <script type="text/javascript">
            $(function(){
                $("#tel").keyup(function(){$(this).val(mascara_tel($(this).val()));});
            })
        </script>
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
                            <a href="administrar_parceiros.php"><img src="imagens/voltar.png"></a>
                        </div>
                        <div class="titulo_adicionar_parceiros">
                            <p>Adicionar Parceiros</p>
                        </div>
                    </div>

                    <form name="frm_parceiros" method="post" action="adicionar_parceiro.php" enctype="multipart/form-data">

                        <div class="frm_parceiros">

                            <div class="nome_parceiro">
                                Nome do Parceiro: <input type="text" name="txt_nome_parceiro" value="<?php echo($nome); ?>" required class="edit_txtbox_parceiros">
                            </div>

                            <div class="nome_parceiro">
                                Email: <input type="email" name="txt_email_parceiro" value="<?php echo($email); ?>" required class="edit_email_parceiros">
                            </div>

                            <div class="nome_parceiro">
                                Telefone: <input type="text" id="tel" name="txt_telefone_parceiro" value="<?php echo($telefone); ?>"
                                 required class="edit_tel_parceiros">
                            </div>

                            <div class="nome_parceiro">
                                Site: <input type="text" name="txt_site_parceiro" value="<?php echo($site); ?>" required class="edit_site_parceiros">
                            </div>

                            <div class="logo_parceiro">
                                Logo: <input type="file" name="imgparceiro" class="edit_img_parceiro" id="img_file" required>
                                <div class="parceiro_img">
                                    <img src="" id="img_preview" />
                                </div>
                            </div>

                            <div class="info_parceiro">
                                Informações: <textarea name="txtinfo" required cols="30" rows="3" class="edit_textarea_parceiro"><?php echo($texto); ?></textarea>
                            </div>

                            <div class="botao_addparceiro">
                                <input type="submit" name="btncancelar" value="CANCELAR" class="edit_submit">
                                <input type="submit" name="btnsalvar" value="<?php echo($botao) ?>" class="edit_submit">
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

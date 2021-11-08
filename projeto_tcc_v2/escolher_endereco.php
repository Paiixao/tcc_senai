<!DOCTYPE html>
<html>
<!-- http://ideiasdefimdesemana.com/wp-content/uploads/2010/06/lentilha.jpg

http://www.downloadswallpapers.com/wallpapers/2012/fevereiro/uva-verdes-no-prato-732.jpg
-->
    <head>
       <!--  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon"> -->
        <title>Escolher endereço</title>
        <?php include('include/include_script_css.php'); ?>
    </head>

    <body>
        

        <div id="principal">
            <!-- CABEÇALHO-->
            <div id="cabecalho">
                <!-- CONTEUDO DO CABEÇALHO -->
                <?php include('include/include_cabecalho.php') ?>
            </div>
            <!-- FIM_CABEÇALHO-->


            <!-- CONTEUDO-->
            <div class="conteudo">
                               
                <!--DIV DO bloco_produto_categoria-->
               <div class="bloco_meu_carrinho">
                    <div class="titulo_meu_perfil">
                        Escolha o endereço de entrega
                    </div>
                   
                   <?php
                        include("cms/include_cms/include_conexao.php");

                        if(isset($_SESSION['cliente'])){
                            $sql="select * from endereco as e inner join cliente_endereco as ce on(e.id_endereco=ce.id_endereco) ";
                            $sql.="inner join cidade as c on(c.id_cidade=e.id_cidade) inner join estado as es on(es.id_estado=c.id_estado) ";
                            $sql.="where ce.id_cliente=".$_SESSION['cliente']['id_cliente'];

                            $select=mysqli_query($con, $sql);
                            while($rs=mysqli_fetch_array($select)){ 
                    ?>
                    <script type="text/javascript">
                        $(function(){
                            $(".propriedades_endereco").each(function(){
                                $(this).click(function(){
                                    var id = $(this).attr("id");
                                    $.ajax({
                                        url: "json/inserir_pedido.php",
                                        data: {id_endereco: id}
                                    }).done(function(res){
                                        console.log(res);
                                        window.location="escolhe_forma_pagamento.php";
                                    });
                                });
                            });
                        });
                    </script>
                    <style type="text/css">
                        
                    </style>
                    <div class="propriedades_endereco" id="<?php echo($rs['id_endereco']); ?>">
                        <div class="conteudo_endereco">
                            <p>Longradouro:<?php echo($rs['logradouro']); ?></p>
                            <p>Bairro:  <?php echo($rs['bairro']); ?></p>
                            <p>Cidade:  <?php echo($rs['nome_cidade']); ?></p>
                            <p>Estado:  <?php echo($rs['nome_estado']); ?></p>
                            <p>Número:  <?php echo($rs['num_endereco']); ?></p>
                            <p>Complemento: <?php echo($rs['complemento']); ?></p>
                        </div>
                    </div>
                   <?php }?>
                   <hr>
                    <a href="editar_endereco.php?compra=true" class="add_endereco"><span>Adicionar um endereço</span></a>
                   <?php } ?>
                </div>

                <!--DIV DO bloco_produto_categoria-->


            </div>
            <!-- FIM_CONTEUDO-->

            <div class="parceiros">
                <?php include('include/include_parceiro.php'); ?>
            </div>

            <div class="rodape">
                <div class="dados_rodape">
                    <?php include('include/include_dados_rodape.php'); ?>
                </div>

                <div class="aviso_rodape">
                    <?php include('include/include_aviso.php'); ?>
                </div>
            </div>
        </div>
    </body>
</html>

<?php session_start(); include("include_cms/include_conexao.php"); ?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="../js/validar.js"></script>

        <style type="text/css">
            #grafico{
                width: 95%;
                height: 90%;   
                margin: auto;
                margin-top: 20px;   
                padding: 20px;
            }

            #nome_prato{
                font-size: 24px;
                font-weight: bold;
                display: block;
                margin-bottom: 15px;
                float: left;
                width: 200px;
            }

            #qtd_click{
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 15px;
                width: 280px;
                margin-left: 20px;
                float: right;
            }

            #barra{
                float: left;
                margin-left: 50px;
            }

            #item{
                width: 100%;
                height: 50px;
                display: block;
            }

            #titulo{
                font-size: 30px;
                width: 100%;
                text-align: center;
                margin-bottom: 50px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="principal">
            
            <div class="cabecalho">
      
            	<?php include('include_cms/include_cabecalho_cms.php') ?>
                      
            </div>
            
            <div class="conteudo">
                <div class="apoio_conteudo">
                    <div id="grafico">
                        <div id="titulo">Produtos mais acessados</div>
                        <?php 
                            $sql="select * from prato order by click desc limit 10;";
                            $select=mysqli_query($con, $sql);

                            $cont=111;

                            $linhas=mysqli_num_rows($select);

                            while($rs=mysqli_fetch_array($select)){
                                $click=$rs['click']/$linhas;
                                $click=$click."%";

                                if(strlen($rs['nome_prato']) > 10){
                                    $rs['nome_prato']=substr($rs['nome_prato'], 0, 10)."...";
                                }
                         ?>
                          <div id="item">
                            <span id="nome_prato"><?php echo($rs['nome_prato']); ?></span>  
                            <div id="barra" style="width: <?php echo($click); ?>; height: 25px;background-color: <?php echo("#".$cont) ?>"></div>    
                            <span id="qtd_click"><?php echo($rs['click']); ?> visita(s) à esse produto</span>  
                          </div>                          
                         <?php $cont=$cont+4; } ?>                        
                    </div>
                </div>
            </div>
            
            <div class="rodape">
                <p>Desenvolvido por 3GCJ</p>
            </div>
        </div>
        
    </body>
</html>
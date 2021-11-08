<?php
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }

     if(!isset($_SESSION['cliente'])){
        $logado="0";
      }else{
        $logado="1";
      }
?>
<div class="suporte_cabecalho">
    <div class="logo_cabecalho">
        <img src="img_logos/logo_final.png" alt=""/>
    </div>

    <div class="menu">
        <ul class="lst_menu">
            <a href="index.php"><li>Inicio</li></a>
            <a href="promocoes.php"><li>Promoções</li></a>
            <a href="dicas.php"><li>Dicas</li></a>
            <a href="quem_somos.php"><li>Quem Somos</li></a>
            <a href="parceiros.php"><li>Parceiros</li></a>
            <a href="contato.php"><li>Contato</li></a>
        </ul>
    </div>
    <div class="pesquisa">
        <form name="frm_pesquisa" method="post" action="index.php">
            <input type="text" name="txt_pesquisa" class="txt_pesquisa" placeholder="Pesquisar....">
            <button name="btn_pesquisar" class="icone_pesquisa"></button>
        </form>
    </div>

    <div class="redes_sociais_topo">
        <div class="redes_sociais_div_contraste">
            <div class="icon_redes_topo">
                <img src="img_redes/icon-face-branco.png" alt="" />
            </div>
            <div class="nome_redes_topo">
                <a href="https://www.facebook.com/Frozen-fitness-gourmet-1101789296600972/?fref=ts"><p>Frozen Gourmet</p></a>
            </div>
        </div>

         <div class="redes_sociais_div_contraste">
            <div class="icon_redes_topo">
                <img src="img_redes/icon-instagram-branco.png" alt="" />
            </div>
            <div class="nome_redes_topo">
                <p>@frozen_fgourmet</p>
            </div>
        </div>

         <div class="redes_sociais_div_contraste">
            <div class="icon_redes_topo">
                <img src="img_redes/icon-twitter-branco.png" alt="" />
            </div>
            <div class="nome_redes_topo">
                <p>@frozen_fgourmet</p>
            </div>
        </div>
    </div>

    <div class="faixa_cabecalho"></div>

    <div class="faixa_cabecalho"></div>

    <div class="usuario_carrinho" id="<?php echo($logado); ?>">
        <div class="segurar_login_cad_bem">
            
            <?php 
                if(!isset($_SESSION['cliente'])){
            ?>
            
            <div class="bem_vindo">
                <p>Olá, Seja bem-vindo(a)</p>
            </div>
            
            
            <div class="login_cadastro">
                <div class="background_login"></div>
                <div class="caixa_login">
                        <div class="close"><img src="img_icones/close.png" alt=""></div>
                    <div class="div_login">

                        <form name="login" method="post" action="json/login.php">
                            <div class="titulo_login">
                                Login
                            </div>
                            <p><input type="text" name="txtUsuario" placeholder="Insira seu usuario, email ou cpf" required class="txtLogin"></p>
                            <p><input type="password" name="txtSenha" placeholder="Insira sua senha" required class="txtLogin"></p>
                            <p><input type="submit" name="btnLogin" value="Entrar" class="btnLogin"></p>
                            <p class="link_esq_cad"><a href="esqueci_senha.php">Esqueci minha senha</a> / <a href="cadastrar.php">Cadastrar-se</a></p>
                        </form>

                    </div>
                </div>

                <p><b><a href="#" class="login">Fazer login</a></b> ou <b><a href="cadastrar.php">Cadastre-se</a></b></p>
            </div>
            
            <?php } ?>
            
            <div class="apoio_sub_menu_perfil">
                <ul class="menu_desktop">
                    <?php 
                        include("json/logout.php");
                        if(isset($_SESSION['cliente'])){
                            if(strlen($_SESSION['cliente']['nome_completo']) > 18){
                              $nome = substr($_SESSION['cliente']['nome_completo'], 0, 18);
                            }else{
                                $nome=$_SESSION['cliente']['nome_completo'];
                            }
                     ?>
                       <li>Bem vindo(a): <b><?php echo($nome); ?></b>
                            <ul class="submenu_desktop">
                                <a href="perfil.php"><li>Meu Perfil</li></a>
                                <a href="trocar_senha.php"><li>Trocar Senha</li></a>
                                <a href="pedidos_andamento.php"><li>Produtos em andamento</li></a>
                                <a href="pedidos_entregues.php"><li>Produtos entregues</li></a>
                                <a href="index.php?logout=1"><li>Sair</li></a>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <div class="carrinho_compras">
            <div class="icon_carrinho">
                <a href="meu_carrinho.php"><img src="img_icones/icone_compras_branco.png" alt="" /></a>
            </div>
            <div class="item_carrinho">
                <p class="qtd">0</p>
                <p>Item</p>
            </div>
        </div>
    </div>
</div>
<?php include("notificacao.html"); ?>
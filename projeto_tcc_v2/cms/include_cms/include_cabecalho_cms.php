<?php 
    include('json/restricao_perfil.php');

    if(isset($_POST['botao_sair'])){
        header('location:../index.php');
        session_destroy();
    }
?>

<div class="logo">
	<img src="imagens/logo_final.png" alt=""/>
</div>
                
<div class="titulo_cms">
	<p>CMS</p>
</div>
                
<div class="apoio_cabecalho">
	<div class="bem_vindo">
    	<p>Seja Bem-vindo <?php echo $_SESSION['usuario_cms']['nome_completo'] ?></p>
    </div>
                    
    <div class="imagem_perfil">
        <img src="imagens/user_icon.png">
    </div>
                    
    <div class="sair">
        <form name="logout" method="post" action="#">
			<input type="submit" name="botao_sair" value="Sair" class="botao_logout">		
   		</form>
    </div>
                    
</div>
                    
<div class="apoio_menu">
	<ul class="menu_desktop">
    	<li><b>Administrar Produtos</b>
            <ul class="submenu_desktop">
                <a href="administrar_pratos.php"><li>Pratos</li></a>
                <a href="administrar_promocoes.php"><li>Promoções</li></a>
                <a href="administrar_categorias.php"><li>Categorias</li></a>
                <a href="administrar_subcategorias.php"><li>Subcategorias</li></a>
                <a href="administrar_categoriasSubCategorias.php"><li>Categ/Sub-Categorias</li></a>
                <a href="administrar_pratosPromocoes.php"><li>Promoção/Prato</li></a>
            </ul>
        </li>
        <li><b>Administrar Conteudo</b>
        	<ul class="submenu_desktop">
            	<a href="administrar_dicas.php"><li>Dicas</li></a>
                <a href="administrar_parceiros.php"><li>Parceiros</li></a>
                <a href="administrar_slides.php"><li>Slides</li></a>
            </ul>
       	</li>
        <li><a href="administrar_fale_conosco.php"><b>Administrar Fale Conosco</b></a></li>
        <li><b>Administrar Usuários</b>
            <ul class="submenu_desktop">
            	<a href="administrar_usuarios.php"><li>Usuários</li></a>
                <a href="administrar_niveis.php"><li>Niveis</li></a>
                <a href="administrar_nivelPagina.php"><li>Niveis/Pagina</li></a>
            </ul>
        </li>
  	</ul>
</div>

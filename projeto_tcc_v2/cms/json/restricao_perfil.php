<?php 
  include("include_cms/include_conexao.php");

	if(isset($_SESSION['usuario_cms'])){

    $sql="select * from usuario as u inner join nivel as n on(n.id_nivel=u.id_nivel) ";
    $sql.="inner join nivel_pagina as np on(np.id_nivel=n.id_nivel) inner join pagina as p on(p.id_pagina=np.id_pagina)";
    $select = mysqli_query($con, $sql);

    $lst_paginas = [];

    while($rs=mysqli_fetch_array($select)){
      $lst_paginas[] = $rs['nome_pagina'];
    } 

    $pagina_atual = basename($_SERVER['REQUEST_URI']);

    $pagina_atual = substr($pagina_atual, 0, strpos($pagina_atual, "php")+3);
    if(!in_array($pagina_atual, $lst_paginas)){
        ?>
        <script type="text/javascript">
          alert("Acesso negado");
          window.history.go(-1);
        </script>
        <?php
    }

  }else{
    header("location: ../index.php");
  }
?>
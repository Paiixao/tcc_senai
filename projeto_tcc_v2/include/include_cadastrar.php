<?php       
    include("cms/include_cms/include_conexao.php");

    $nome="";
    $email="";
    $telefone="";
    $celular="";
    $data="";
    $rg="";
    $cpf="";
    $senha="";
    $senha_confirmar="";
    $aceito="";
    $bairro="";
    $numero_casa="";
    $complemento="";
    $cep="";
    $rua="";
    $cidade="";
    $tipo="";
    $uf="";

   if (isset($_POST['btnCadastrar'])){

        $nome = $_POST['txtNome_cliente'];
        $email = $_POST['txEmail_cliente'];
        $telefone = $_POST['txtTelefone_cliente'];
        $celular = $_POST['txtCelular_cliente'];
        $data = $_POST['dt_nascimento'];
        $rg = $_POST['txtRg_cliente'];
        $cpf = $_POST['txCpf_cliente'];
        $senha = $_POST['txtSenha'];
        $senha_confirmar = $_POST['txtSenha_confirmar'];
        $aceito = $_POST['checkAceito']; 
        
        $bairro = $_POST['txtBairro_cliente'];
        $numero_casa = $_POST['txtNumeroCasa_cliente'];
        $complemento = $_POST['txtComplemento_cliente'];
        $cep = $_POST['txtCep_cliente'];
        $rua = $_POST['txtRua_cliente'];
        $cidade = $_POST['slc_cidade'];
        $tipo= $_POST['slc_tipoEndereco'];
        $uf = $_POST['txtUf'];
        
        if($complemento=="") $complemento= "null";
       
            $sql="insert into cliente(nome_completo, email, telefone, celular, dt_nasc, cpf, rg, senha_cliente) 
                values('".$nome."', '".$email."', '".$telefone."', '".$celular."', '".$data."' ,'".$cpf."', '".$rg."', SHA1('".$senha."'));";

            $sql_3="insert into endereco(cep, logradouro, bairro, num_endereco, complemento, id_cidade, id_tipoEndereco) 
                values('".$cep."', '".$rua."', '".$bairro."', '".$numero_casa."', '".$complemento."', '".$cidade."', '".$tipo."');";
       
        if($senha == $senha_confirmar){
                mysqli_query($con, $sql);
                mysqli_query($con, $sql_3);

                $sql_buscacliente= "select id_cliente from cliente where cpf = " .$cpf;
                $select_buscacliente= mysqli_query($con, $sql_buscacliente);
                $rs_buscacliente=mysqli_fetch_array($select_buscacliente); 

                $sql2="insert into cliente_endereco(id_cliente, id_endereco) values ('".$rs_buscacliente['id_cliente']  ."', last_insert_id());";
                mysqli_query($con, $sql2);
            
                ?>
                    <script> 
                        alert('Cadastro realizado com sucesso');
                        window.setTimeout(function(){window.location="cadastrar.php";}, 500)
                        
                    </script>
                 <?php    
        }else{
            ?><script> alert('Senhas incompativeis'); </script><?php
        }
       
    }
?>
<?php include('js/jscep.js') ?>

<script type="text/javascript">
    $(function(){
        window.scrollTo(0, 900);
        $("input[name='txtNome_cliente']").focus();
    });
</script>

<div class="titulo_cadastro">
    Cadastro
</div>

<div class="conteudo_cadastrar">
    <form name="cadastro_cliente" method="post" action="index.php">
        
        <legend><p>Dados pessoais</p></legend>
        <hr>
        <p> <input type="text" name="txtNome_cliente" placeholder="Nome completo" required class="txtCadastro"></p>
        
        <p><input type="text" name="txEmail_cliente" placeholder="Email de cadastro" required class="txtCadastro"></p>
        
        <p><input type="text" id="tel" maxlength="14" name="txtTelefone_cliente" placeholder="Telefone para contato" required class="txtNumeroTelefone">
            <input type="text" id="cel" maxlength="15" name="txtCelular_cliente" placeholder="Celular para contato" required class="txtNumeroCelular"></p>
        
        <div class="dt_nasc">
            <p>Data de nascimento: <input type="date" name="dt_nascimento" placeholder="Registro geral" required></p>
        </div>
        
        <p><input type="text" id="rg" maxlength="12" name="txtRg_cliente" placeholder="Registro geral" required class="txtNumeroTelefone">
            <input type="text" id="cpf" maxlength="14" name="txCpf_cliente" placeholder="CPF" required class="txtNumeroCelular"></p>
                
        <legend><p>Endereço</p></legend>
        <hr> 
        
        <p><input type="text" name="txtCep_cliente" maxlength="9" placeholder="CEP" value="" required class="txtCep" onblur="pesquisacep(this.value)";>
        <input type="text" name="txtRua_cliente" placeholder="Logradouro" readonly required class="txtRua"></p>
            
        <p><input type="text" name="txtBairro_cliente" placeholder="Bairro" readonly required class="txtBairro">
            <input type="text" name="txtNumeroCasa_cliente" placeholder="Número"  required class="txtNumCom">
            <input type="text" name="txtComplemento_cliente" placeholder="Complemento" required class="txtNumCom"></p>
        
        <p>
                <select name="sl_cidade" disabled class="select_city">
                    <option value="0">Cidade</option>
                    
                    <?php
                        $sql="select * from cidade";
                        $select=mysqli_query($con, $sql);

                        while($rs=mysqli_fetch_array($select)){
                    ?>
                    <option class="opcao" value="<?php echo($rs['id_cidade']); ?>"> <?php echo($rs['nome_cidade']); ?> </option>    
                             
                    <?php }?>
                </select>
            <input type="text" name="txtUf" placeholder="UF" required readonly class="txtUf">         
            
         <legend><p>Senha</p></legend>
        <hr>
        
        <p>
            <input type="password" name="txtSenha" placeholder="Insira uma senha" required class="txtSenha">
            <input type="password" name="txtSenha_confirmar" placeholder="Confirmar senha" id="confimar" required class="txtConfirmarSenha">
            <style type="text/css">#certo{width: 20px; height:20px; float:left; outline:solid 1px #000;</style>
            <div id="certo"></div>
        </p>

        
        <div class="checkbox_aceito">
            <p><input type="checkbox" name="checkAceito" value="1" required class="checkAceito"> Li e aceito os termos e condições de uso</p>
        </div>
        
        <p><input type="reset" name="btnLimpar_cad" value="Cancelar" class="btnCancelar">
            <input type="submit" name="btnCadastrar" value="Cadastrar" class="btnCadastrar" disabled="disabled"></p>
    </form>
</div>
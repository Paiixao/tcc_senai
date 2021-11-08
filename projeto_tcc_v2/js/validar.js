function mascara_tel(tel){
	if(tel.length >= 14){
	    tel = tel.substring(0, 14);
	}else{
	    tel=tel.replace(/\D/g,"");
	    tel=tel.replace(/^(\d{2})(\d)/g,"($1) $2");
	    tel=tel.replace(/(\d{4})(\d)/,"$1-$2"); 
	}

	return tel;
}

function mascara_cel(cel){
	if(cel.length >= 15){
	    cel = cel.substring(0, 15);
	}else{
	    cel=cel.replace(/\D/g,"");
	    cel=cel.replace(/^(\d{2})(\d)/g,"($1) $2");
	    cel=cel.replace(/(\d{5})(\d)/,"$1-$2");  
	}

	return cel;
}

function mascara_rg(rg){
	if(rg.length >= 12){
	    rg = rg.substring(0, 12);
	}else{
	    rg=rg.replace(/\D/g,"");
	    rg=rg.replace(/^(\d{2})(\d)/g,"$1.$2");
	    rg=rg.replace(/(\d{3})(\d)/,"$1.$2");  
	    rg=rg.replace(/(\d{3})(\d)/,"$1-$2");  
	}

	return rg;
}

function mascara_cpf(cpf){
	if(cpf.length >= 14){
	    cpf = cpf.substring(0, 14);
	}else{
	    cpf=cpf.replace(/\D/g,"");
	    cpf=cpf.replace(/^(\d{3})(\d)/g,"$1.$2");
	    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2"); 
	    cpf=cpf.replace(/(\d{3})(\d)/,"$1-$2"); 
	}

	return cpf;
}

function mascara_decimal(num){
	if(num.length >= 7){
	    num = num.substring(0, 7);
	}else{
	    num = num.replace(/\D/g,"");
      	num = num.replace(/(\d)(\d)$/, "$1,$2");
    }

	return num;
}

function mascara_tempo(time){
	if(time.length >= 8){
	    time = time.substring(0, 8);
	}else{
	    time = time.replace(/\D/g,"");
      	time = time.replace(/(\d{2})(\d)/, "$1:$2");
      	time = time.replace(/(\d{2})(\d)/, "$1:$2");
    }

	return time;
}
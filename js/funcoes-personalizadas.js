function formataCPF(cpf){
  //retira os caracteres indesejados...
  cpf = cpf.replace(/[^\d]/g, "");

  //realizar a formatação...
	return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

function formatCnpjCpf(value)
{
  const cnpjCpf = value.replace(/\D/g, '');
  
  if (cnpjCpf.length === 11) {
	return cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
  } 
  
  return cnpjCpf.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
}


function elementoMostrar(id)
{
	if(typeof(id) == "string")//Verificar se foi passado "this".
	{
		if(document.getElementById(id))
		{
			document.getElementById(id).style.display = 'block';
		}
	}else{
		id.style.display = 'none';
	}
}

function elementoOcultar(id)
{
	if(typeof(id) == "string")//Verificar se foi passado "this".
	{
		if(document.getElementById(id))
		{
			document.getElementById(id).style.display = 'none';
		}
	}else{
		id.style.display = 'none';
	}
}
							

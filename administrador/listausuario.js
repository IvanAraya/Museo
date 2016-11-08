var f = new RemoteObject('Usuarios');

function listausuario_onload()
{
	
}

function editarUsuario(rut)
{
	//alert("editate");

	var datos = new FormData();
	datos.append('rut',rut);
	f.callMethod("enviarInfo", datos, function(respuesta){

		document.getElementById("Erut").value = rut+"-"+respuesta[0];
		document.getElementById("Erut").disabled= true;
		document.getElementById("Enombre").value = respuesta[1];
		document.getElementById("Eapellido").value = respuesta[2];
		document.getElementById("Epass").value = respuesta[3];
		document.getElementById("Email").value =respuesta[4];
		
		if(respuesta[5] == 1)
			document.getElementById("AS").checked= true;
		else
			document.getElementById("AS").checked= false;

		if(respuesta[6] == 1)
			document.getElementById("EC").checked= true;
		else
			document.getElementById("EC").checked= false;

		if(respuesta[7] == 1)
			document.getElementById("EAR").checked= true;
		else
			document.getElementById("EAR").checked= false;

		if(respuesta[8] == 1)
			document.getElementById("ER").checked= true;
		else
			document.getElementById("ER").checked= false;
		
	});
}

function eliminarUsuario(rut)
{
	//alert("eliminate");
	var datos = new FormData();
	datos.append('rut',rut);
	f.callMethod("eliminarUsuario", datos, function(respuesta){
		document.getElementById(rut).remove();
	});
}

function agregarUsuario()
{
	rut_c=document.getElementById("Erut").value;
	nombre=document.getElementById("Enombre").value;
	apellido=document.getElementById("Eapellido").value;
	pass=document.getElementById("Epass").value;
	email=document.getElementById("Email").value;

	rut = rut_c.split("-")[0];
	div = rut_c.split("-")[1];

	if(document.getElementById("AS").checked == true)
		as = 1;
	else
		as = 0;

	if(document.getElementById("EC").checked == true)
		ec = 1;
	else
		ec = 0;

	if(document.getElementById("EAR").checked == true)
		ear = 1;
	else
		ear = 0;

	if(document.getElementById("ER").checked == true)
		er = 1;
	else
		er = 0;

	var arr =[];

	arr[0] = rut;
	arr[1] = div;

	arr[2] = nombre;
	arr[3] = apellido;
	arr[4] = pass;
	arr[5] = email;

	arr[6] = as;
	arr[7] = ec;
	arr[8] = ear;
	arr[9] = er;

	var jsonarr = JSON.stringify(arr);
	
	var arg = new FormData();
	arg.append('datos',jsonarr);

	f.callMethod("agregarUsuario", arg, function(respuesta){
		alert("agrego");
	});


}

var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        if (!/^[0-9]+-[0-9kK]{1}$/.test( rutCompleto ))
            return false;
        var tmp     = rutCompleto.split('-');
        var digv    = tmp[1]; 
        var rut     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;
        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    }
}

function validando()
{
    rutValido = false;
    mailValido = false;

    compRut = document.getElementById("Erut").value;
    if(Fn.validaRut(compRut) == true)
    {
        rutValido = true;
    }
    else
    {
        alert("Rut invalidado: "+compRut);
    }

    compMail= document.getElementById("Email").value;
    if(validarEmail(compMail) == true)
    {
        mailValido = true;
    }
    else
    {
        alert("Mail invalidado: "+compMail);
    }

 	if(rutValido==true && mailValido==true)
 	{
 		agregarUsuario();
 	}   

}

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
        return false;
    return true;
}



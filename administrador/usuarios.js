
var f = new RemoteObject('usuarios');
var nuevoUsuario ;

function usuarios_onload(){

	if(arguments[0])
	{
		//editar usuario
		nuevoUsuario = false;
		editarUsuario(arguments[0]);
		document.getElementById("eliminar").disabled= false;
	}
	else
	{
		//nuevo usuario
		nuevoUsuario = true;
		document.getElementById("eliminar").disabled= true;
		document.getElementById("guardar").disabled= true;
	}
	
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
		//document.getElementById("Epass").value = respuesta[3];
		document.getElementById("Email").value =respuesta[3];
		
		if(respuesta[4] == 1)
			document.getElementById("AS").checked= true;
		else
			document.getElementById("AS").checked= false;

		if(respuesta[5] == 1)
			document.getElementById("EC").checked= true;
		else
			document.getElementById("EC").checked= false;

		if(respuesta[6] == 1)
			document.getElementById("EAR").checked= true;
		else
			document.getElementById("EAR").checked= false;

		if(respuesta[7] == 1)
			document.getElementById("ER").checked= true;
		else
			document.getElementById("ER").checked= false;
		
	});
}

function eliminarUsuario()
{
	//alert("eliminate");
	if(confirm('¿Desea eliminar a este usuario?')){
		var rut = document.getElementById('Erut').value.split('-')[0];
		var datos = new FormData();
		datos.append('rut',rut);
		f.callMethod("eliminarUsuario", datos, function(respuesta){
			if(respuesta){
				alert('Usuario eliminado con exito');
				load('listausuarios');
			}else
				alert('No se pudo eliminar el usuario');
			//document.getElementById(rut).remove();
		});
	}
}

function agregarUsuario()
{
	rut_c=document.getElementById("Erut").value;
	nombre=document.getElementById("Enombre").value;
	apellido=document.getElementById("Eapellido").value;
	//pass=document.getElementById("Epass").value;
	email=document.getElementById("Email").value;

	pass = rut_c.substring(0, 5);

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
	var metodo;
	if(nuevoUsuario)
		metodo  = "agregarUsuario";
	else
		metodo  = "editarUsuario";
	
	f.callMethod(metodo, arg, function(respuesta){
		if(respuesta)
		{
			alert("Usuario guardado con exito");
			load('listausuarios');
		}
		else
			alert("No se pudo guardar el usuario");
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
    nombreValido = false;
    apellidoValido = false;

    compRut = document.getElementById("Erut").value;
    if(Fn.validaRut(compRut) == true)
    {
        rutValido = true;
    }
    else
    {
    	//document.getElementById("alertas").style.visibility = "hidden";
        alert("Rut invalidado: "+compRut);
    }

    compMail= document.getElementById("Email");
    if(validarEmail(compMail.value) == true)
    {
        mailValido = true;
    }
    else
    {
        alert("Mail invalidado: "+compMail.value);
        compMail.focus();
        compMail.select();
    }

    if(document.getElementById("Enombre").value.length==0)
    {
    	alert("Ingrese el nombre del usuario");
    	document.getElementById("Enombre").focus();
    }
    else
    {
    	nombreValido = true;
    }


    if(document.getElementById("Eapellido").value.length==0)
    {
    	alert("Ingrese el apellido del usuario");
    	document.getElementById("Eapellido").focus();
    }
    else
    {
    	apellidoValido = true;
    }
    	

 	if(rutValido==true && mailValido==true && nombreValido==true && apellidoValido == true)
 	{
 		agregarUsuario();
 	}   

}

function validar_rut(input)
{
	if(Fn.validaRut(input.value))
	{
		input.style.color = "black"; 
		input.style.borderColor = "black";
		document.getElementById("guardar").disabled= false;

	}
	else
	{
		input.style.color = "red"; 
		input.style.borderColor = "red";
		document.getElementById("guardar").disabled= true;
	}
}

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
        return false;
    return true;
}

function cancelar(){
	
	if(confirm('¿Desea cancelar?'))	
		load('listausuarios');
}


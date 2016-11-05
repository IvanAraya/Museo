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
            compRut = document.getElementById("Erut").value;
            if(Fn.validaRut(compRut) == true)
            {
                //alert("Rut validado: "+compRut);
            }
            else
            {
                alert("Rut invalidado: "+compRut);
            }

            compMail= document.getElementById("Email").value;
            if(validarEmail(compMail) == true)
            {

            }
            else
            {
                alert("Mail invalidado: "+compMail);
            }

        }

        function validarEmail( email ) {
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if ( !expr.test(email) )
                return false;
            return true;
        }
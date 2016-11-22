var obj = new RemoteObject('catalogo');
var rutaImagenesCatalogo = 'img/catalogo/' ;
var sinInfo = 'nodisponible.png' ;

function listacatalogo_onload(){
	
	obj.callMethod('llenarCombos', null, function(combos){		
		setOptions('cmbVitrinas',combos.vitrinas);
		setOptions('cmbColecciones',combos.colecciones);
		setOptions('cmbPais',combos.paises);
		resetCombo('cmbRegion','Pais / Continente');
		resetCombo('cmbUbicacion','Region');
	});
	obj.callMethod('listarMuestras',null, mostrarResultados);
}
//-----------------------------------------------------------
function buscar(pagina){
	var datos = new FormData(document.getElementById('busqueda'));
	datos.append('pagina',pagina) ;
	obj.callMethod('listarMuestras',datos, mostrarResultados);
}
//-----------------------------------------------------------
function mostrarResultados(respuesta){
	
	var columnas = 4;
	var divNumResultados = document.getElementById('divNumResultados');
	divNumResultados.innerHTML = '&#91;'+respuesta.paginas.totalResultados.toString() +' resultados&#93;  P&aacute;gina '+ respuesta.paginas.paginaActual + ' de ' + respuesta.paginas.totalPaginas ;
	
	ClearOptionsFast('paginador');
	var paginador = document.getElementById('paginador');	
	for(var p = 0 ; p < respuesta.paginas.totalPaginas ; p++){
		var li = document.createElement('li');
		var a = document.createElement('a');
		a.innerHTML = p+1;
		a.href = "javascript:buscar("+(p+1)+")";
		li.appendChild(a);
		paginador.appendChild(li);
		if((p+1) == respuesta.paginas.paginaActual)
			a.className = "w3-orange";
	}
	
	ClearOptionsFast('divResultados');
	var divResultados = document.getElementById('divResultados');
	
	var i = 0;
	for(var ii=0; ii < respuesta.resultados.length; ii = ii+columnas){
		var fila = document.createElement('div');
		fila.className = 'w3-row-padding w3-margin-top';
		for(var c=0; c < columnas && i < respuesta.resultados.length ;c++){
			
			var col = document.createElement('div');
			var card = document.createElement('div');
			var panelImg = document.createElement('div');
			var panelDesc = document.createElement('div');
			var img = document.createElement('img');
			var desc = document.createElement('h6');
			col.className = 'w3-quarter';
			card.className = 'w3-card-2';
			panelImg.className = 'contenedor-imagen' ;
			panelImg.style.width = '100%';
			panelImg.style.cursor = 'pointer';
			panelDesc.className = 'w3-container';			
			if(respuesta.resultados[i].imagen != sinInfo)
				panelImg.style.backgroundColor = '#999';
			img.src = rutaImagenesCatalogo+respuesta.resultados[i].imagen;
			img.id = respuesta.resultados[i].id
			img.onclick = function(){
				verDetalle(this.id, this.src);
			}		
			desc.appendChild(document.createTextNode(respuesta.resultados[i].descripcion));
			col.appendChild(card);
			card.appendChild(panelImg);
			card.appendChild(panelDesc);
			panelImg.appendChild(img);
			panelDesc.appendChild(desc);
			fila.appendChild(col);
			i++;
		}
		divResultados.appendChild(fila);		
	}
	
}
//-----------------------------------------------------------
function verDetalle(id, src){
	
	var datos = new FormData();
	datos.append('id',id);
	obj.callMethod('detalleMuestra', datos, function(muestra){
		
		document.getElementById('lblnMuestra').innerHTML = muestra.numeroMuestra;
		document.getElementById('lblDescripcion').innerHTML = muestra.descripcion ;
		document.getElementById('lblFormula').innerHTML = muestra.formula;
		document.getElementById('lblTipo').innerHTML = muestra.tipoMuestra;
		document.getElementById('lblCaracteristica').innerHTML = muestra.caracteristicaTipoMuestra;
		document.getElementById('lblPais').innerHTML = muestra.pais;
		document.getElementById('lblRegion').innerHTML = muestra.region;
		document.getElementById('lblUbicacion').innerHTML = muestra.ubicacion;
		document.getElementById('lblColeccion').innerHTML = muestra.coleccion;
		document.getElementById('lblAdquisicion').innerHTML = muestra.adquisicion;
		document.getElementById('lblVitrina').innerHTML = muestra.vitrina;
		document.getElementById('modalWindow').style.display = 'block';
		document.getElementById('modalImage').src = src ;
	});
}
//-----------------------------------------------------------
function llenarRegion(){
	resetCombo('cmbRegion','Pais / Continente');
	resetCombo('cmbUbicacion','Region');
	var datos = new FormData();
	datos.append('id',document.getElementById('cmbPais').value);
	obj.callMethod('llenarRegion', datos, function(regiones){
		ClearOptionsFast('cmbRegion');
		setOptions('cmbRegion',regiones);
	});
}
//-----------------------------------------------------------
function llenarUbicacion(){
	resetCombo('cmbUbicacion','Region');
	var datos = new FormData();
	datos.append('id',document.getElementById('cmbRegion').value);
	obj.callMethod('llenarUbicacion', datos, function(ubicaciones){
		ClearOptionsFast('cmbUbicacion');
		setOptions('cmbUbicacion',ubicaciones);
	});
}
//-----------------------------------------------------------
function setOptions(comboBoxId, opciones){
	var cmb = document.getElementById(comboBoxId);
	for(var i=0; i < opciones.length; i++){			
		var opt = document.createElement('option');
		opt.value = opciones[i].id ;
		opt.appendChild(document.createTextNode(opciones[i].texto));
		cmb.appendChild(opt);
	}
}
//-----------------------------------------------------------
function resetCombo(idCombo, predecesor){
	ClearOptionsFast(idCombo);
	var cmb = document.getElementById(idCombo);
	var opt = document.createElement('option');
	opt.value = '-1' ;
	opt.appendChild(document.createTextNode('Seleccione '+predecesor));
	cmb.appendChild(opt);
}
//-----------------------------------------------------------
function ClearOptionsFast(id){
	var selectObj = document.getElementById(id);
	var selectParentNode = selectObj.parentNode;
	var newSelectObj = selectObj.cloneNode(false); // Make a shallow copy
	selectParentNode.replaceChild(newSelectObj, selectObj);
}
//-----------------------------------------------------------
function acordion(id) {
    var x = document.getElementById(id);
	 var btn = document.getElementById(id+'-btn');
    if (x.className.indexOf('w3-show') == -1) {
        x.className += ' w3-show';
		  btn.innerHTML = 'expand_less' ;
    } else { 
        x.className = x.className.replace(' w3-show', '');
		  btn.innerHTML = 'expand_more' ;
    }
}
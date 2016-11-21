var obj = new RemoteObject('catalogo');
var rutaImagenesCatalogo = '../img/catalogo/' ;

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
function mostrarResultados(respuesta){
	
	var columnas = 4;
	var divNumResultados = document.getElementById('divNumResultados');
	divNumResultados.innerHTML = respuesta.paginas.totalResultados.toString() +' resultados.'
	
	var divResultados = document.getElementById('divResultados');
	var i = 0;
	for(var ii=0; ii < respuesta.resultados.length; ii = ii+columnas){
		var fila = document.createElement('div');
		fila.className = 'w3-row-padding w3-margin-top';
		for(var c=0; c < columnas ;c++){
			
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
			panelDesc.className = 'w3-container';
			
			img.src = rutaImagenesCatalogo+respuesta.resultados[i].imagen;
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
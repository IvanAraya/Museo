var obj = new RemoteObject('catalogo');
var rutaImagenesCatalogo = '../img/catalogo/' ;

function catalogo_onload(){
	
	var datos = new FormData();
	datos.append('editar',true);
	obj.callMethod('llenarCombos', datos, function(combos){		
		setOptions('cmbTipomuestra',combos.tipoMuestra);
		setOptions('cmbVitrinas',combos.vitrinas);
		setOptions('cmbColecciones',combos.colecciones);
		setOptions('cmbPais',combos.paises);
		setOptions('cmbAdquisicion',combos.adquisicion);
		resetCombo('cmbCarTipoMuestra','Tipo Muestra');
		resetCombo('cmbRegion','Pais / Continente');
		resetCombo('cmbUbicacion','Region');
	});
	
	var id = null;
	if(arguments[0]){
		id = arguments[0] ;
		cargar(id)
	}

	var myNicEditor = new nicEditor({iconsPath : 'js/nicEdit/nicEditorIcons.gif', buttonList : ['subscript','superscript']});
   myNicEditor.panelInstance('txtFormula');
}
//-----------------------------------------------------------
function cargar(id){
	
	var datos = new FormData();
	datos.append('id',id);
	obj.callMethod('detalleMuestraEditor',datos,function(muestra){
		//alert(muestra.tipoMuestra)
		
		document.getElementById('txtNmuestra').value = muestra.numeroMuestra;
		document.getElementById('txtDescripcion').value = muestra.descripcion ;
		nicEditors.findEditor('txtFormula').setContent( muestra.formula );
		document.getElementById('cmbTipomuestra').value = muestra.tipoMuestra;
		llenarCaracteristica();
		//document.getElementById('cmbCarTipoMuestra').value = muestra.caracteristicaTipoMuestra;
		document.getElementById('cmbPais').value = muestra.pais;
		llenarRegion();
		//document.getElementById('lblRegion').innerHTML = muestra.region;
		//document.getElementById('lblUbicacion').innerHTML = muestra.ubicacion;
		document.getElementById('cmbColecciones').value = muestra.coleccion;
		document.getElementById('cmbAdquisicion').value = muestra.adquisicion;
		document.getElementById('cmbVitrinas').value = muestra.vitrina;
		document.getElementById('imgFoto').src = rutaImagenesCatalogo + muestra.imagen ;
	})
}
//-----------------------------------------------------------
function photoPreview(file){
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById('foto').files[0]);
	oFReader.onload = function (oFREvent) {
		document.getElementById('imgFoto').src = oFREvent.target.result;
	};
}
//-----------------------------------------------------------
function llenarCaracteristica(){
	resetCombo('cmbCarTipoMuestra','Tipo Muestra');
	var datos = new FormData();
	datos.append('id',document.getElementById('cmbTipomuestra').value);
	obj.callMethod('llenarCaracteristica', datos, function(caracteristica){
		ClearOptionsFast('cmbCarTipoMuestra');
		setOptions('cmbCarTipoMuestra',caracteristica);
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
function cancelar(){
	load('listacatalogo');
}
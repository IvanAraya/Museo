var obj = new RemoteObject('catalogo');

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
		document.getElementById('b_eliminar').disabled = false;
	}

	var myNicEditor = new nicEditor({iconsPath : 'js/nicEdit/nicEditorIcons.gif', buttonList : ['subscript','superscript']});
   myNicEditor.panelInstance('txtFormula');
}
//-----------------------------------------------------------
function cargar(id){
	
	var datos = new FormData();
	datos.append('id',id);
	obj.callMethod('detalleMuestraEditor',datos,function(muestra){
		document.getElementById('idMuestra').value = muestra.idMuestra;
		document.getElementById('txtNmuestra').value = muestra.numeroMuestra;
		document.getElementById('txtDescripcion').value = muestra.descripcion ;
		document.getElementById('cmbTipomuestra').value = muestra.tipoMuestra;
		document.getElementById('cmbPais').value = muestra.pais;		
		document.getElementById('cmbColecciones').value = muestra.coleccion;
		document.getElementById('cmbAdquisicion').value = muestra.adquisicion;
		document.getElementById('cmbVitrinas').value = muestra.vitrina;
		document.getElementById('imgFoto').src = muestra.imagen ;
		nicEditors.findEditor('txtFormula').setContent( muestra.formula );
		llenarCaracteristica(muestra.caracteristicaTipoMuestra);
		llenarRegion(muestra.region, muestra.ubicacion);
	});
}
//-----------------------------------------------------------
function guardar(){
	
	if(!validarForm()){
		alert('Por favor complete todos los campos necesarios. Verifique que la muestra disponga de una descripcion y en los campos en los que no disponga de informacion seleccione la opcion \'Sin Informacion\'.')
		return false;
	}		
	
	if(confirm('¿Desea guardar esta muestra?')){
		var datos = new FormData( document.getElementById('frmMuestra') );
		var nicE = new nicEditors.findEditor('txtFormula');
		datos.append('formula',nicE.getContent());

		obj.callMethod('guardar',datos, function(respuesta){
			if(respuesta.resultado)
				alert('Los datos de la muestra se guardaron exitosamente');
			else
				alert(respuesta.mensaje);
		});
	}
}
//-----------------------------------------------------------
function eliminar(){
	if(confirm('¿Desea eliminar esta muestra?')){
		var datos = new FormData( document.getElementById('frmMuestra') );
		obj.callMethod('eliminarMuestra',datos, function(respuesta){
			if(respuesta.resultado){
				alert('La muestra fue eliminada exitosamente');
				load('listacatalogo');
			}else
				alert(respuesta.mensaje);
		});
	}
}
//-----------------------------------------------------------
function validarForm(){

	if(document.getElementById('txtDescripcion').value == '') return false;
	if(document.getElementById('cmbTipomuestra').value < 0 ) return false;
	if(document.getElementById('cmbUbicacion').value < 0 ) return false;	
	if(document.getElementById('cmbColecciones').value < 0 ) return false;
	if(document.getElementById('cmbAdquisicion').value < 0 ) return false;
	if(document.getElementById('cmbVitrinas').value < 0 ) return false;
	return true;
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
	if(arguments[0])
		datos.append('seleccion', arguments[0]);
	obj.callMethod('llenarCaracteristica', datos, function(respuesta){
		ClearOptionsFast('cmbCarTipoMuestra');
		setOptions('cmbCarTipoMuestra', respuesta.caracteristicas);		
		if(respuesta.seleccion)
			document.getElementById('cmbCarTipoMuestra').value = respuesta.seleccion ;
		
	});
}
//-----------------------------------------------------------
function llenarRegion(){	
	resetCombo('cmbRegion','Pais / Continente');
	resetCombo('cmbUbicacion','Region');
	var datos = new FormData();
	datos.append('id',document.getElementById('cmbPais').value);
	if(arguments[0]){
		datos.append('region', arguments[0]);
		datos.append('ubicacion', arguments[1]);
	}		
	obj.callMethod('llenarRegion', datos, function(respuesta){
		ClearOptionsFast('cmbRegion');
		setOptions('cmbRegion',respuesta.regiones);
		if(respuesta.region){
			document.getElementById('cmbRegion').value = respuesta.region ;
			llenarUbicacion(respuesta.ubicacion);
		}
			
	});
}
//-----------------------------------------------------------
function llenarUbicacion(){
	resetCombo('cmbUbicacion','Region');
	var datos = new FormData();
	datos.append('id',document.getElementById('cmbRegion').value);
	if(arguments[0])
		datos.append('seleccion', arguments[0]);
	obj.callMethod('llenarUbicacion', datos, function(respuesta){
		ClearOptionsFast('cmbUbicacion');
		setOptions('cmbUbicacion',respuesta.ubicaciones);
		if(respuesta.seleccion)
			document.getElementById('cmbUbicacion').value = respuesta.seleccion ;
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
//-----------------------------------------------------------

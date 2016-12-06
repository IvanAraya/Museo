var obj = new RemoteObject('catalogo');
var mantenedor = new RemoteObject('mantenedor');	

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
function cerrarModal(){
	var modal = document.getElementById('modalWindow') ;
	modal.style.display='none'
}
//-----------------------------------------------------------
function abrirMantenedor(entidad){
	
	datos = new FormData();
	datos.append('entidad',entidad);
	document.getElementById('idAntecesor').value = '' ;
	document.getElementById('idRegistro').value = '';
	document.getElementById('valorRegistro').value = '' ;
	document.getElementById('entidad').value = entidad ;
	if(arguments[1]){
		predecesor = document.getElementById(arguments[1]).value;
		document.getElementById('idAntecesor').value = predecesor;
		datos.append('predecesor',predecesor);		
	}

	
	mantenedor.callMethod('recuperarDatos',datos, function(lista){
		ClearFast('tablaLista');
		var tabla = document.getElementById('tablaLista');		
		for(f=0;f<lista.length;f++){			
			var fila = document.createElement('tr');			
			for(c=1;c<lista[f].length;c++){
				var columna = document.createElement('td'); 
				columna.innerHTML = lista[f][c];
				fila.appendChild(columna);
			}
			var editar = document.createElement('td');
			var eliminar = document.createElement('td');
			editar.innerHTML = '<span class="material-icons" style="cursor:pointer" onclick="editarRegistroMantenedor(\''+lista[f][0]+'\',\''+lista[f][1]+'\')">edit</span>';
			eliminar.innerHTML = '<span class="material-icons" style="cursor:pointer" onclick="eliminarRegistroMantenedo(\''+lista[f][0]+'\')">delete</span>';
			fila.appendChild(editar);
			fila.appendChild(eliminar);
			tabla.appendChild(fila);
		}
		document.getElementById('lblTituloMantenedor').innerHTML = entidad.toUpperCase() ;
		document.getElementById('modalWindow').style.display = 'block';
	});

}
//-----------------------------------------------------------
function editarRegistroMantenedor(id, valor){
	document.getElementById('idRegistro').value = id;
	document.getElementById('valorRegistro').value = valor;
}
//-----------------------------------------------------------
function guardarRegistroMantenedor(){
	if(!confirm('¿Desea guardar este registro?'))
		return false;
	datos = new FormData();
	datos.append('id',document.getElementById('idRegistro').value);
	datos.append('valor',document.getElementById('valorRegistro').value);
	datos.append('predecesor',document.getElementById('idAntecesor').value);
	datos.append('entidad',document.getElementById('entidad').value);
	
	mantenedor.callMethod('guardarRegistro',datos, function(resp){
		if(resp.resultado){
			alert('Registro guardado con exito');
			//refrescarCombos(document.getElementById('entidad').value);
			
		}else
			alert(resp.mensaje);
	});
}
//----------------------------------------------------------
function refrescarCombos(entidad){
	abrirMantenedor(entidad);
}
//-----------------------------------------------------------
function eliminarRegistroMantenedo(id){
	if(!confirm('¿Desea eliminar este registro?'))
		return false;
	
	datos = new FormData();
	datos.append('id',id);
	datos.append('entidad',document.getElementById('entidad').value);
	mantenedor.callMethod('eliminarRegistro',datos, function(resp){
		if(resp.resultado){
			alert('Registro eliminado con exito');
			//refrescarCombos(entidad);
		}			
		else
			alert(resp.mensaje);
	});
}
//-----------------------------------------------------------
function ClearFast(id){
	var selectObj = document.getElementById(id);
	var selectParentNode = selectObj.parentNode;
	var newSelectObj = selectObj.cloneNode(false); // Make a shallow copy
	selectParentNode.replaceChild(newSelectObj, selectObj);
}
//-----------------------------------------------------------

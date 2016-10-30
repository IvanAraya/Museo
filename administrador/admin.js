var r = new RemoteObject('admin');

function main(){
	
	r.callMethod('getMenu', null, function(m){	
		var menu = document.getElementById('menu-principal');
		for(i=0;i<m.length;i++){
			var li = document.createElement('li');
			var a = document.createElement('a');
			a.href = '#';
			a.className = 'w3-hide-smal';
			a.innerHTML = m[i];
			li.appendChild(a);
			menu.appendChild(li);
		}
	});
}
<?php?>
<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <script src="perfil.js"></script>
  </head>
  <body onload="main()">
    <div class="frame">
      <form id="formPerfil"> 
			<span class="control" style="top: 100px; left: 200px;">Rut </span>
			<span class="control" style="top: 100px; left: 400px;" id="rut"  >{Rut}</span> 
			<span class="control" style="top: 150px; left: 200px;">Nombre </span>
			<span class="control" style="top: 150px; left: 400px;" id="nombre">{Nombre}</span> 
			<span class="control" style="top: 200px; left: 200px;">Contrase&ntilde;a</span>
			<input class="control" style="top: 200px; left: 400px;" name="password" type="password"> 
			<span class="control" style="top: 250px; left: 200px;">Email</span>
			<input class="control" style="top: 250px; left: 400px;" name="mail" type="email"> 
			<input class="control" style="top: 350px; left: 300px;" name="ok" value="ok"  type="button">
		</form>
	</div>
</body></html>
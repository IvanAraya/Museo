<?php ?>
<!DOCTYPE html>
<html>
	<body>
		<div style="height:16px"></div>
		<div class="w3-container">
			<div class="w3-content w3-display-container" style="max-width:100%">
				<img class="mySlides w3-animate-top" src="img/slide1.jpg" style="width:100%; height:300px;">
				<img class="mySlides w3-animate-top" src="img/slide2.jpg" style="width:100%; height:300px;">
				<img class="mySlides w3-animate-top" src="img/slide3.jpg" style="width:100%; height:300px;">
				<div class="w3-center w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
					<div class="w3-left w3-padding-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
					<div class="w3-right w3-padding-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
					<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
					<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
					<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
				</div>
			</div>
		</div>
		<br>
		<div class="w3-container">
			<h3>Actividad Reciente</h3>
			 <hr>
		</div>
		<div id="divNoticias" class="w3-container">
		</div>
		<br>
	</body>
</html>
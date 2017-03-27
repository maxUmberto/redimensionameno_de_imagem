<html>
<head>
	<title>Redimensionamento de imagem</title>
</head>

<body>
	<?php
		include 'redimensiona.php';
	?>
	<form method="post" enctype="multipart/form-data">
		<label>Arquivo:</label><br>
		<input type="file" name="foto"><br><br>

		<input type="submit" name="enviar" value="Enviar">
	</form>
</body>
</html>
<?php
if(isset($_POST['enviar']) && $_FILES['foto']['error'] == 0){
	//Armazenando as informações da foto na variável foto
	$photo = $_FILES['foto'];

	//print_r($photo);

	//Abaixo são atribuídas a altura e largura máxima que a
	//foto terá
	$width = 150;
	$height = 150;

	//getimage size pega as dimensões da imagem e armazena nas variáveis
	//da lista
	list($original_width, $original_height) = getimagesize($photo['tmp_name']);

	//ratio descobre a proporção da imagem, para redimensionar a imagem sem perda
	//de qualidade
	$ratio = $original_width / $original_height;

	//Abaixo é um bagulho aritmético pra redimensionar a imagem. É um negócio que
	//altera a largura e a altura da imagem de um modo satânico que eu não sei
	//explicar como funciona, só sei que funciona
	if($width / $height > $ratio){
		$width = $height * $ratio;
	}else{
		$height = $width / $ratio;
	}

	//aqui se cria uma nova imagem com a largura e altura especificadas no começo
	//do código. Basicamente, o imagecreatetruecolor funciona como se você criasse
	//uma imagem no paint e salvasse, sem fazer nada.
	$final_image = imagecreatetruecolor($width, $height);

	//De acordo com o tipo da imagem eu crio uma cópia da imagem original
	if($photo['type'] == 'image/jpeg'){
		$original_image = imagecreatefromjpeg($photo['name']);
	}
	if($photo['type'] == 'image/png'){
		$original_image = imagecreatefrompng($photo['name']);
	}

	//Aqui é onde a mágica(ou bruxaria) acontece. Vamos por parte pra ng se perder
	//Como o próprio nome já diz, essa função copia uma imagem de um lugar e cola
	//em outro
	imagecopyresampled($final_image, $original_image,//Primeiro se passa o destino final, depois a origem da foto
						0, 0, //Aqui eu digo a partir de onde será colada a imagem, ou seja, a partir do ponto 0 de altura e largura
						0, 0, //Aqui eu digo a partir de onde vou copiar a imagem
						$width, $height, //Especifico a altura e largura na nova imagem
						$original_width, $original_height); //Passo a largura e a altura da imagem original

	//Salvo a imagem e em seguida exibo ela
	if($photo['type'] == 'image/jpeg'){
		//header("Content-Type: image/jpeg");
		imagejpeg($final_image, 'mini_imagem.jpeg', 100);
		echo '<img src="mini_imagem.jpeg">';
	}
	if($photo['type'] == 'image/png'){
		//header("Content-Type: image/png");
		imagepng($final_image, 'mini_imagem.png');
		echo '<img src="mini_imagem.png">';
	}
}else{
	echo 'Nenhuma foto selecionada';
}
?>
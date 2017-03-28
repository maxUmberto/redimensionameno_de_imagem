<?php
	//De modo estático, eu pego o nome das duas imagens
	//sendo a primeira a imagem original e a segunda a 
	//imagem que vai ser usada como marca d'água
	$image = "imagem.jpg"; 
	$marca_dagua = "mini_imagem.jpeg";

	//Usando o list para atribuir em uma única linha a 
	//largura e altura de cada uma das imagens nas respectivas
	//variáveis
	list($original_width, $original_height) = getimagesize($image);
	list($mini_width, $mini_height) = getimagesize($marca_dagua);

	//Cria uma imagem "em branco" com as dimensões(largura x altura)
	//da imagem original
	$final_image = imagecreatetruecolor($original_width, $original_height);

	//copia a imagem original para a variável
	$original_image = imagecreatefromjpeg($image); 

	//copia a imagem que será usada como marca d'água para
	//a variável
	$mini_image = imagecreatefromjpeg($marca_dagua);
	//$mini_image = imagecreatefrompng("mini_imagem.png");

	//Copia a imagem original para a imagem final
	//A imagem original será copiada a partir de X = 0
	//e Y = 0 e será colada na imagem final a partir de
	//X = 0 e Y = 0;
	imagecopy($final_image, $original_image,
		0, 0, 0, 0, 
		$original_width, $original_height);

	//Copia a marca d'água para a imagem final
	//A marca d'água será copiada a partir de X = 0
	//e Y = 0 e será colada na imagem final a partir de
	//X = 100 e Y = 200;
	imagecopy($final_image, $mini_image, 
		300, 200, 0, 0, 
		$mini_width, $mini_height);

	imagecopy($final_image, $mini_image, 
		800, 200, 0, 0, 
		$mini_width, $mini_height);

	//header("Content-Type: image/jpeg");
	imagejpeg($final_image, 'imagem_marca_dagua.jpeg', 100);

	echo 'Imagem criada com sucesso';
?>
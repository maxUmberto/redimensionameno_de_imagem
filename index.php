<?php

//A variável filename recebe o nome da imagem
$filename = 'imagem.jpg';

//Largura e altura máxima da imagem quando for
//redimencionada
//OBS: não são os valores finais da imagem, mas os
//tamanhos máximos que a imagem poderá ter
$width = 200;
$height = 200;

//A função getimagesize retorna um array com dois valores
//(largura e altura), e ao criar uma list já é atribuído
//automaticamente, e respectivamente, largura e altura as
//variáveis
list($original_width, $original_height) = getimagesize($filename);

//O ratio é a proporção entre a largura e a altura da imagem,
//por isso é dividida a largura pela altura
//Geralmente o valor dessa variável é 1.algumaCoisa
$ratio = $original_width / $original_height;

//imprimindo o valor de ratio
//echo $ratio;
//nesse exemplo o resultado foi 1.777...

//Se o ratio da imagem final for maior do que o ratio
//da imagem orignal, então vou mudar a largura da imagem,
//caso contrário, eu vou mudar a altura
if($width / $height > $ratio){
    $width = $height * $ratio;
}else{
    $height = $width / $ratio;
}

//Imprimindo a largura e altura originais e modificadas para 
//comparação
//echo "L ORIGINAL: ".$original_width." - A ORIGINAL: ".$original_height."<br>";
//echo "LARGURA: ".$width." - ALTURA: ".$height;

//Cria uma imagem sem nada dentro. É como criar uma imagem no paint
//sem colocar nada. São passados dois parâmetros, a largura e a 
//altura dessa nova imagem
$final_image = imagecreatetruecolor($width, $height);

//carregando a imagem original para uma variável
//caso o formato da imagem seja png, se usa
//a linha abaixo
//$original_image = imagecreatefrompng($filename)
$original_image = imagecreatefromjpeg($filename);

//copia a imagem original para a imagem final, redimensionando a
//imagem original
//são passados muitos parâmetros nessa função
//  1 - se passa a imagem final
//  2 - se passa a imagem original
//  3 - posição no eixo X na nova imagem onde será colocada a imagem original
//  4 - posição no eixo Y na nova imagem onde será colocada a imagem original
//  5 - Diz a partir de onde no eixo X será copiada a imagem original para a nova
//  6 - Diz a partir de onde no eixo Y será copiada a imagem original para a nova
//  7 - Largura final da imagem
//  8 - Altura final da imagem
//  9 - Largura Original da imagem
//  10 - Altura original da imagem
imagecopyresampled($final_image, $original_image, 
                   0, 0, 0, 0,
                  $width, $height, $original_width, $original_height);
//Resampled diminui a proporção e ajusta os pixels

//Resize é um outro jeito de copiar, mas o resize somente pega a 
//imagem e diminui, meio que forçando os pixels a ficarem mais juntos
//imagecopyresize();

//transforma o arquivo PHP em um arquivo de imagem, desse jeito o navegador
//entende que se quer exibir uma imagem e não um bando de caracteres loucos
header("Content-Type: image/jpeg");

//Caso vc opte por salvar a imagem, não precisa alterar o cabeçalho
//para o navegador entender que é uma imagem, basta vc imprimir ela
//com o comando html depois
//Em outras palavras, não precisa da linha 77

//Essa função serve para exibir a imagem na tela
//São passados dois (ou três dependendo do formato) parâmetros
//O primeiroa é a imagem final e o segundo é o diretório onde
//se deseja salvar a imagem, caso não queira salvar a imagem, basta
//deixar o segundo parâmetro como null
//Esse 100 é a qualidade da foto, sendo 100 a melhor qualidade
imagejpeg($final_image, null, 100);
//imagepng($final_image, null);

//Caso queira salvar a imagem, o código é esse
//imagejpeg($final_image, "mini_imagem.jpeg", 100);













?>
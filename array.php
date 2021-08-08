<?php
echo "<pre>";

// 1) Crie um array
$array = array();

// 2) Popule este array com 7 números
for ($i=0; $i < 7; $i++) { 
    $array[] = random_int(0, 1000);
}
var_dump($array);
echo "<br />";
// 3) Imprima o número da posição 3 do array
// Entendi que era para imprimir a posição 3 e não a terceira que no caso seria [2]
echo $array[3];
echo "<br />";

// 4) Crie uma variável com todas as posições do array no formato de string separado por vírgula
$arrayStr = implode(',',$array);
echo $arrayStr;
echo "<br />";

// 5) Crie um novo array a partir da variável no formato de string que foi criada e destrua o array anterior
$newArray = explode(',',$arrayStr);
unset($array);

// 6) Crie uma condição para verificar se existe o valor 14 no array
echo in_array(14, $newArray) ? "O valor 14 existe na array" : "O valor 14 NÃO existe na array";

// 7) Faça uma busca em cada posição. Se o número da posição atual for menor que o
// da posição anterior (valor anterior que não foi excluído do array ainda), exclua esta posição
//Começando no 1 pois no index 0 n tem valor para comparar
for ($i=1; $i < count($newArray) ; $i++) { 
    if ( $newArray[$i] < $newArray[$i-1] ) array_splice($newArray, $i-1,1);
}
echo "<br />";
var_dump($newArray);

// 8) Remova a última posição deste array
array_pop($newArray);

//9) Conte quantos elementos tem neste array
$count = count($newArray);

//10) Inverta as posições deste array
$arrayInvertido = array_reverse($newArray);
echo "<br />";
var_dump($arrayInvertido);
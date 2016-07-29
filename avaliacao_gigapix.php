<?php 
// atribuição de varo para o compo do formulário.
$valorCampo = "";
// inicialização do variavel de resultado impresso na tela.
$resultadoProcessamento = "";


// Verificando se a requisição post foi enviada.
if($_POST['entreda_sequencia']){

	// pegando o valor do campo do formulario;
	$string = strip_tags($_POST["entreda_sequencia"]);

	// atribuindo o valor digitado a variavel valor Campo para ser repopulada.
	$valorCampo = $string;

	// Mostrando o que o cliente Digitou para ser processado;
	$resultadoProcessamento .= "Sequência Avaliada: " .$string;

	// convertendo a string em array.
	$sequenciaN = explode(',', $string);


	// verificando se existe 3 elementos ou mais.
	if(count($sequenciaN)<3){
		// se for verdadeiro retorna a mensagem de erro.
		$resultadoProcessamento .= "<br>Sequência inválida ­- tamanho insuficiente";
	}else{

		// percorrendo o arrey com o s elemento para verificar se são todos numericos.
		$teste = 0;
		foreach ($sequenciaN as $key => $value) {
			if(!is_numeric($value)){
				$teste = 1;
				break;
			}
		}

		if ($teste==1) {
			// retornando a mensagem um deles não for numerico.
			$resultadoProcessamento .= "<br>Sequência inválida ­- elementos não numéricos detectados ";
		}else{
			// chamando as funções para processar a sequência maior e menor , com o array como paramentro.
			$resultadoProcessamento .= processamentoSequenciaMaiorSoma($sequenciaN);

			$resultadoProcessamento .=	processamentoSequenciaMenorSoma($sequenciaN);	

		}
	}
}


// Função para processar a sequência maior
function processamentoSequenciaMaiorSoma($sequenciaN)
{
	// Inicializando as variaveis;
	$soma = 0;
	$somaMaior = 0;
	$posicaoInicial = 0;
	$posicaofinal = 0;

	$resultados = array();

	// percorrendo cada elemento da array.
	for($i=0; $i<count($sequenciaN)-1;$i++){

		$soma = 0;	

		$posicaoInicial = $i;
		// verificando se é o primeiro elemento da array.
		if($posicaoInicial==0){
			// definindo a quantidade de repetição.
			$qtde_lacos = count($sequenciaN)-1;

			// definindo a soma maior para o primeiro elemento.
			$somaMaior = $sequenciaN[$posicaoInicial];
			// entrado no repetição ;
			for ($j= $posicaoInicial; $j< $qtde_lacos ; $j++) { 
				// atribuindo para somo o soma + os outros elementos;
				$soma += $sequenciaN[$j];
				// se soma for maior que somaMaior então somaMaior recebe soma e posicaoFinal é atualizado.
				if($soma > $somaMaior){
					$somaMaior = $soma;
					$posicaofinal = $j;
				}

			}
		// se não for o primeiro elemento da array.
		}else{
			// definindo a quantidade de repetição.
			$qtde_lacos = count($sequenciaN);

			$somaMaior = $sequenciaN[$posicaoInicial];

			for ($j= $posicaoInicial; $j< $qtde_lacos ; $j++) { 
				

				$soma += $sequenciaN[$j];

				if($soma > $somaMaior){
					$somaMaior = $soma;
					$posicaofinal = $j;
				}

			}

		}

		// Gardando o resultado de cada elemento do array e sua posições.
		$resultados[] = array("posicaoInicial"=>$posicaoInicial,"posicaofinal"=>$posicaofinal,"somaMaior"=>$somaMaior);

	}


	// Verificando qual dos resultados foi o maior
	$resultadoMaior = 0;
	$posicaoResultado = 0;
	for($i=0;$i<count($resultados);$i++){

		if($i==0){
			$resultadoMaior = $resultados[$i]['somaMaior'];
			$posicaoResultado = $i;
		}


		if($resultados[$i]['somaMaior']>$resultadoMaior){
			$resultadoMaior = $resultados[$i][somaMaior];
			$posicaoResultado = $i;
		}

	}


	// Definindo o texto que será impresso na tela.
	$texto = "";
	$texto .= "<br>Sequência de maior soma ­- Posição :".$resultados[$posicaoResultado]["posicaoInicial"]."..".$resultados[$posicaoResultado]["posicaofinal"];

	$texto .= "<br>Soma: ".$resultados[$posicaoResultado]["somaMaior"];

	// retornando o texto em forma de string;
	return $texto;
}

// Função para processar a sequência menor
function processamentoSequenciaMenorSoma($sequenciaN)
{
	// inicializando as variaveis.
	$somaMenor = 0;
	$posicaoInicial = 0;
	$posicaofinal = 0;
	$resultados = array();

	// Repetição para percorrer todos os elementos a array
	for($i=0; $i<count($sequenciaN)-1;$i++){


		$soma = 0;	
		$posicaoInicial = $i;

		// Verificando se o elemento é o primeiro.
		if($posicaoInicial==0){
			// definindo a quantidade de repetiçõa.
			$qtde_lacos = count($sequenciaN)-1;

			$soma = $sequenciaN[$posicaoInicial];

			// avanção para o proximo elemento.
			$x = $posicaoInicial +1;
			// somando os dois primeiro elemento;
			$somaMenor = $soma + $sequenciaN[$x];
			// atualizando a posição final.
			$posicaofinal = $x;

			// percorrendo os elemento.
			for ($j= $x; $j< $qtde_lacos ; $j++) { 

				$soma += $sequenciaN[$j];
				// verificando se a soma é menor que a somaMenor e atualizando a posição final.
				if($soma < $somaMenor){
					$somaMenor = $soma;
					$posicaofinal = $j;
				}

			}


		}else{
			// definindo a quantidade de repetição.
			$qtde_lacos = count($sequenciaN);
			// atribuirdo o valor de soma
			$soma = $sequenciaN[$posicaoInicial];
			// avançando para o proximo elemento.
			$x = $posicaoInicial+1 ;
			// somano os dois primeiro elemantos
			$somaMenor = $soma + $sequenciaN[$x];
			// atualizando a posição final.
			$posicaofinal = $x;

			// percorrendo os outros elementos 
			for ($j= $x; $j< $qtde_lacos ; $j++) { 
				
				$soma += $sequenciaN[$j];
				// verificando se a sama é menor que a somaMenor se for somaMenor recebe soma e atualiza posição final.
				if($soma < $somaMenor){
					$somaMenor = $soma;
					$posicaofinal = $j;
				}

			}

		}

		// Guardando o resultado das somas de todos os elementoe e suas posições.
		$resultados[] = array("posicaoInicial"=>$posicaoInicial,"posicaofinal"=>$posicaofinal,"somaMenor"=>$somaMenor);

	}

	// Verificando qual dos resultados é o menor.
	$resultadoMenor = 0;
	$posicaoResultado = 0;
	for($i=0;$i<count($resultados);$i++){

		if($i==0){
			$resultadoMenor = $resultados[$i]['somaMenor'];
			$posicaoResultado = $i;
		}

		if($resultados[$i]['somaMenor']<$resultadoMenor){
			$resultadoMenor = $resultados[$i]['somaMenor'];
			$posicaoResultado = $i;
		}

	}

	// Resultado impresso na tela.
	$texto = "";
	$texto .= "<br>Sequência de menor soma ­- Posição :".$resultados[$posicaoResultado]["posicaoInicial"]."..".$resultados[$posicaoResultado]["posicaofinal"];
	
	$texto .= "<br>Soma: ".$resultados[$posicaoResultado]["somaMenor"];
	// retornando uma string.
	return $texto;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>​Avaliação para desenvolvedores Back­End</title>
	<meta charset="utf-8">

	<style type="text/css">
		
		body{
			font-family: arial;
			color: #3f3f3f;
			text-align: center;
		}

		input {
			margin:10px;
		}

	</style>
</head>
<body>

	<h1>Avaliação para Desenvolvedores BackEnd - GigaPIX</h1>

	<form action="avaliacao_gigapix.php" method="post">
		<div>

			<label>Informe uma sequencia numerica separada por virgulas e com <br> 
			3 elementos ou mais. Exemplo: 1,2,3,4,5</label>
			<br>
			<input type="text" size="50px" autofocus="true" style="padding:5px; font-size: 16px" name="entreda_sequencia" placeholder="1,2,3,4" required="true" value="<?php echo $valorCampo ?>">

			<button type="submit" style="padding:5px; font-size: 16px"> Resolver </button>
		</div>
	</form>


	<div style="font-size:18px; margin-top: 20px; padding:20px;border:1px solid #ccc;">
		<?php echo $resultadoProcessamento ?>
	</div>

</body>
</html>
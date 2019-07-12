<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
abc[1d20]
abc[1d20[
abc]1d20]
abc]1d20[

[d1]-[d2]-[d3]-[d4]-[d5]-[d6]-[d7]-[d8]-[d9]-[d10]-[d11]-[d12]-[d15]-[d20]-[d30]-[d50]-[d100]-[d120]-[d150]-[d1000]
 */
function tratar_jogada($jogada){

	$i = 0;
	$j = 0;
	$k = 0;
	$a = 0;
	$b = 0;

	$flagTexto = true;
	$flagJogada = true;

	//Cria arrays que guardarão individualmente cada texto e cada jogada 
	$texto = array();			//Guarda as substrings de texto, p recriar a string principal
	$rolagem = array();			//Guarda as substrings de jogada, p recriar a string principal
	$controle = array();		//Guarda a ordem das substrings de texto e jogada, p recriar a string principal na ordem certa "T = texto" "J = jogada" 

	$nova_frase = "";
	$nova_jogada = "";
	$jogadaTratada = "";
	$resultado = 0;

	//echo "Quantidade de caracteres: ".strlen($jogada);
	//echo "<br />";

	$i = 0; $j = 0;

	while($i < strlen($jogada)){

		//Captura o texto ate chegar em uma jogada
		if($jogada[$i] != "[" && $flagTexto && $i < strlen($jogada)){
			$nova_frase = $nova_frase.$jogada[$i];

			//Testa para ver se é fim de cadeia
			if($i == (strlen($jogada) -1)){
				//Captura uma frase identificada e habilita a capura de uma jogada
				array_push($texto, $nova_frase);
				array_push($controle, "T");
			}
		}
		else{

			if($flagTexto){
				if($nova_frase != ""){
					//Captura uma frase identificada e habilita a capura de uma jogada
					array_push($texto, $nova_frase);
					array_push($controle, "T");	
				}					
				
				//Guarda o ponto de leitura da entrada a partir do aractere "["
				$j = $i;

				//Muda o controle para ler rolagens
				$flagTexto = false;
				$flagJogada = true;
				

				// Verifica se o abre colchete é o ultimo caratere, se não for, pega ele
				if($j != (strlen($jogada) -1)){
					//Captura o abre colchete atual
					$nova_jogada = $nova_jogada.$jogada[$j];
				}								

				//Guarda o ultimo abre colchete como texto
				if($j == (strlen($jogada) -1)){
					//Texto detectado

					//limpa a variavel
					$nova_frase = "";
					
					$nova_frase = $nova_frase.$jogada[$i];

					array_push($texto, $nova_frase);
					array_push($controle, "T");

					//Muda o controle para ler rolagens
					$flagTexto = false;
					$flagJogada = true;
				}

				$j++;

				//prepara a variavel para pegar novo texto
				$nova_frase = "";
			}

			//Le a substring que pode representar uma jogada
			while($flagJogada && $j < strlen($jogada)){

				if($jogada[$j] != "]"){				

					//Se ler outro "[" sai do while e continua lendo texto
					if($jogada[$j] == "["){
						//Texto detectado
						$nova_frase = $nova_jogada;
						array_push($texto, $nova_frase);
						array_push($controle, "T");

						//Muda o controle para ler rolagens e sai do while para continuar lendo texto
						$flagTexto = true;
						$flagJogada = false;

						// limpa a variável
						$nova_jogada = "";
						$nova_frase = "";

						//Corrige o indice
						$j--;
					}
					else{
						//Armazena a nova jogada a medida que os caracteres sao lidos
						$nova_jogada = $nova_jogada.$jogada[$j];
					}
				}
				else{
					//Armazena o "]"
					$nova_jogada = $nova_jogada.$jogada[$j];

					//Muda o controle para ler rolagens e sai do while para continuar lendo texto
					$flagTexto = true;
					$flagJogada = false;
				}

				$j++;
			}


			//Armazena a nova jogada a medida que os caracteres sao lidos
			if($nova_jogada != ""){

				//Captura uma jogada completa e salva
				array_push($rolagem, $nova_jogada);
				array_push($controle, "J");

				//Avança na leitura da cadeia de entrada
				$i = $j - 1;

				// limpa a variável
				$nova_jogada = "";	
			}
			else{
				//Avança na leitura da cadeia de entrada
				$i = $j - 1;
			}
		}

		$i++;
		
	}

	// ################################# INICIO - echo apenas para verificação. Não apagar!!! #################################
	$i = 0;
	while($i < count($texto)){
		echo "Texto: " . $i . ": " . $texto[$i] . "<br/>";
		$i++;
	}

	$i = 0;
	while($i < count($rolagem)){
		echo "Rolagem: " . $i. ": "  . $rolagem[$i] . "<br/>";
		$i++;
	}

	//Trata as rolagens de dados
	$b = 0; 
	while($b < count($rolagem)){
		//echo "Resultado da rolagem Antes: " . $rolagem[$b] . "<br/>";
		$rolagem[$b] = calcula_resultado_jogada($rolagem[$b]);

		//echo "Resultado da rolagem Depois: " . $rolagem[$b] . "<br/>";
		$b++;
	}

	// ################################# FIM - echo apenas para verificação. Não apagar!!! #################################

	//Reconstroi a entrada com o tratamento das jogadas
	$a = 0; $b = 0; $k = 0;
	while($k < count($controle)){
		if($controle[$k] == "T"){
			$jogadaTratada = $jogadaTratada.$texto[$a];
			$a++;
		}

		if($controle[$k] == "J"){

			$temp = $rolagem[$b];
			//Verifica se o resultado da jogada é um numero
			if($temp[0] != "["){
				//Se for número, coloca-o entre colchetes
				$jogadaTratada = $jogadaTratada."[ ";
				$jogadaTratada = $jogadaTratada.$rolagem[$b];
				$jogadaTratada = $jogadaTratada." ]";

			}
			else{
				//Se não for número, o texto já está entre colchetes
				$jogadaTratada = $jogadaTratada.$rolagem[$b];
			}
			
			$b++;
		}
		$k++;
	}
	return $jogadaTratada;
}

//Verifica se a jogada está no padrão certo, retorna o valor do resultado caso esteja correto, ou falso
//Ainda não trata acertos criticos
//padrao aceitavel até o momento:
//[d20+2]
//[1d20+3]
function calcula_resultado_jogada($entrada){

	/*O caracter de separacao de uma jogada p a margem de ameaça será uma virgula
	Ex: //[1d20+3 , 19-20x2] */
	
	//numeros ASCI II vão de 48 (zero) a 57 (nove)
	$jogada = "";
	$i = 1;					//indice i
	$j = 0;					//indice j
	$qtdeDados = "";		//Guarda a quantidade de dados a serem rolados
	$qtdDadosInt = 0;		//Guarda a quantidade de dados a serem rolados
	$codDado = "";			//Guarda o codigo do dado
	$codDadoInt = 0;		//Guarda o codigo do dado a ser rolado
	$codMod = "";			//Guarda o codigo do modificador numerico
	$codModInt = 0; 		//Valor que modifica o resultado da jogada de dados
	$operacao = "";			//Guarda a operacao a ser feita na jogada dos dados


	//Remove espacos em branco de uma jogada
	$jogada = remove_espacos_jogada($entrada);
	echo "Rolagem sem tratar: " . $entrada."<br/>";
	echo "Rolagem  tratada: " . $jogada."<br/>";


	//Verifica a quantidade de dados que serao rolados.
	while(((ord($jogada[$i]) >= 48 && ord($jogada[$i]) <= 57))  && $i < strlen($jogada)){
		//Acumula caracteres numericos e de espaço
		$qtdeDados = $qtdeDados.$jogada[$i];
		$i++;
	}

	//Se houver numeros antes do codigo do dado
	if($qtdeDados != ""){
		//Converte a string numerica p inteiro
		$qtdDadosInt = intval($qtdeDados);
		echo "Quantidade de dados a rolar: " . $qtdDadosInt."<br/>";

		//Limpa as variaveis
		$qtdeDados = "";
	}
	else{
		$qtdDadosInt = 1;
		echo "Quantidade de dados a rolar2: " . $qtdDadosInt."<br/>";
	}


	//Descobre o codigo do dado
	if($jogada[$i] ==  "d" || $jogada[$i] ==  "D" ){
		$i++;

		//Verifica se o codigo da jogada começa com zero
		if($jogada[$i] == "0"){
			return $entrada;
		}

		//le os caracteres que vao definir o dado. Tem que ir de 0 a 9!
		while(((ord($jogada[$i]) >= 48 && ord($jogada[$i]) <= 57) || $jogada[$i] == " ")  && $i < strlen($jogada)){
			//Acumula caracteres numericos e de espaço
			$codDado = $codDado.$jogada[$i];
			$i++;
		}
		

		//Verifica se existe um codigo numerico de dado(2, 3, 4, 6, 8, 10, 12, 20, etc)
		if($codDado == ""){
			return $entrada;
		}
		else{
			//Converte a string numerica p inteiro
			$codDadoInt = intval($codDado);
			echo "Codigo do dado: " . $codDadoInt . "<br/>";
			$codDado = "";
		}
	
		if(($jogada[$i] == "+") || ($jogada[$i] == "-") || ($jogada[$i] == "*") || ($jogada[$i] == "/")){

			$operacao = $jogada[$i];
			echo "Operacao: " . $operacao . "<br/>";
			//Pula o caractere de operacao
			$i++;
			//le os caracteres que vao definir o valor do modificador
			while(((ord($jogada[$i]) >= 48 && ord($jogada[$i]) <= 57) || $jogada[$i] == " ")  && $i < strlen($jogada)){
				//Acumula caracteres numericos e de espaço
				$codMod = $codMod.$jogada[$i];
				$i++;
			}

			//Verifica se existe um codigo numerico de dado(2, 3, 4, 6, 8, 10, 12, 20, etc)
			if($codMod != ""){	
				//Converte a string numerica p inteiro
				$codModInt = intval($codMod);
				echo "Modificador: " . $codModInt . "<br/>";
			}
			else{
				//Se o proximo caractere não corresponder a um codigo de dado, retorna falso
				return $entrada;
			}
		}else{
			//Verifica se a jpgada não possui modificadores
			if($i == (strlen($jogada)-1)){
				echo "Resultado: " . rola_dado_simples($qtdDadosInt, $codDadoInt) . "<br/>";
				//OK, aceito a jogada de um dado sem modificador. Ex: [1d20] ou [3d20] 
				return rola_dado_simples($qtdDadosInt, $codDadoInt);
			}
			else{
				//Se chegou no final da cadeia e ainda tem caracteres p serem lidos, que nao é o fecha colchete é pq tem erro
				return $entrada;
			}
		}
		//Retorna o resultado da jogada
		return rola_dado_completo($qtdDadosInt, $codDadoInt, $operacao, $codModInt);
	}
	else{
		//Sai da avaliação se o codigo do dado nao for válido
		return $entrada;
	}
}

//Faz uma rolagem com modificadores de resultado e sem avaliar sucesso decisivo
function rola_dado_completo($qtd, $codDado, $operacao, $modificador){
	$resultado = 0;

	$i = 0; $j = 1;

	echo "Em rola_dado_completo(): <br/>";
	echo "qtd: " . $qtd . "<br/>";
	echo "codDado: " . $codDado . "<br/>";
	echo "operacao: " . $operacao . "<br/>";
	echo "modificador: " . $modificador . "<br/>";

	$populacao = array();
	$limite = $codDado * 10;

	if($codDado == 1){
		//Adiciona o modificador na rolagem
		if($operacao == "+"){
			$resultado = 1 + $modificador;
		}
		
		if($operacao == "-"){
			$resultado1 - $modificador;
		}

		if($operacao == "*"){
			$resultado = $modificador;
		}

		if($operacao == "/"){
			$resultado = 1 / $modificador;
		}

		return $resultado;
	}

	//Funcao que espalha os numeros do intervalo a ser rolado em um array
	while($i < $limite){

		if($j > $codDado){
			$j = 1;
		}
		array_push($populacao, $j);

		$j++;
		$i++;
	}

	$i = 0;
	$pos1 = 0;
	$pos2 = 0;
	$temp = 0;

	//Embaralha os numeros da população e acumula o resultado das rolagens
	while($i < $limite){
		$max = $limite -1;

		//Gera um pequeno delay (p ver se aumenta a aleatoriedade)
		$delay = rand(1, 1000);
		for($k = 0; $k < $delay; $k++);
		$pos1 = rand(0, $max);

		//Gera um pequeno delay (p ver se aumenta a aleatoriedade)
		for($k = 0; $k < $delay; $k++);
		$pos2 = rand(0, $max);

		$temp = $populacao[$pos1];

		//troca os valores de lugar
		$populacao[$pos1] = $populacao[$pos2];
		$populacao[$pos2] = $temp;

		$i++;
	}

	//Acumula o resultado das rolagens
	$i = 0;
	while($i < $qtd){
		$max = $limite -1;
		$resultado += $populacao[rand(0, $max)];
		$i++;
	}

	// echo "Resultado da rolagem dos dados:" . $resultado ."<br/>";

	//Adiciona o modificador na rolagem
	if($operacao == "+"){
		$resultado += $modificador;
	}
	
	if($operacao == "-"){
		$resultado -= $modificador;
	}

	if($operacao == "*"){
		$resultado *= $modificador;
	}

	if($operacao == "/"){
		$resultado /= $modificador;
	}

	return $resultado;
}

//Faz uma rolagem sem modificadores de resultado e sem avaliar sucesso decisivo
function rola_dado_simples($qtd, $codDado){
	$i = 0; $j = 1;
	$resultado = 0;

	$populacao = array();
	$limite = $codDado * 10;

	//Funcao que espalha os numeros do intervalo a ser rolado em um array
	while($i < $limite){

		if($j > $codDado){
			$j = 1;
		}

		array_push($populacao, $j);

		$j++;
		$i++;
	}

	$i = 0;
	$pos1 = 0;
	$pos2 = 0;
	$temp = 0;

	//Embaralha os numeros da população e acumula o resultado das rolagens
	while($i < $limite){

		//Gera um pequeno delay (p ver se aumenta a aleatoriedade)
		$delay = rand(1, 1000);

		//Gera um pequeno delay (p ver se aumenta a aleatoriedade)
		for($k = 0; $k < $delay; $k++);
		$pos1 = rand(0, ($limite-1));

		//Gera um pequeno delay (p ver se aumenta a aleatoriedade)
		for($k = 0; $k < $delay; $k++);
		$pos2 = rand(0, ($limite-1));

		$temp = $populacao[$pos1];

		//troca os valores de lugar
		$populacao[$pos1] = $populacao[$pos2];
		$populacao[$pos2] = $temp;

		$i++;
	}

	//Acumula o resultado das rolagens
	$i = 0;
	while($i < $qtd){
		$resultado += $populacao[rand(1, $codDado)];
		$i++;
	}

	return $resultado;
}

//Remove espaços entre os caracteres de uma jogada
function remove_espacos_jogada($jogada){

	$i = 0;
	$resultado = "";
	// Remove espaços entre os caracteres da jogada
	while($i < strlen($jogada)){
		if($jogada[$i] == " "){
			$i++;	
		}
		else{
			$resultado = $resultado.$jogada[$i];
			$i++;
		}		
	}
	return $resultado;
}

//Retorna o codigo numérico das strings conforme a tabela ASCII (ou UTF-8) do PHP
function tabela_ascii_php(){
	$palavraNumero = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	for ($k = 0; $k < strlen($palavraNumero); $k++){
		echo $palavraNumero[$k] . "-------------" . ord($palavraNumero[$k])."<br/>"; 
	}
	return 1;
}
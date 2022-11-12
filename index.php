<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		
		<title> Busca CEP </title>

		<style>
		.card-login {
			padding: 30px 0 0 0;
			width: 500px;
			margin: 0 auto;
		}

		.button {
			margin-top: 10%;
		}

		.resp {
			text-align: center;
		}
		</style>
	</head>
	<body> 
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Busca Cep</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-link active" aria-current="page" href="#">Pagina Principal</a>
					</div>
				</div>
			</div>
		</nav>
		<div class="container">    
			<div class="row">
				<div class="card-login">
					<div class="card">
						<div class="card-header">
							<h1> Bem vindo ao busca Cep! </h1>
						</div>
						<div class="card-body">
							<form class="resp" action="index.php" method="post">
								<div class="form-group">
									<label>CEP: </label>
									<input class="form-control-md is-valid" type="text" name="cep" placeholder="Digite um cep!">
								</div>
								<button type="submit" value="Enviar" class="btn btn-primary  btn-info btn-block mb-3 button">Enviar</button>
							</form>
							<div class="resp">
								<?php
									//condicional que verifica se a variavel não é vazia
									if(!empty($_POST['cep'])){
										
										//variavel cep recebe o valor do cep digitado
										$cep = $_POST['cep'];

										//instanciando o objeto (atribuindo a classe Address a variavel address)
										$address = new Address();

										//executando o metodo get_address passando o cep digitado como parametro
										$address -> get_address($cep);

										//formatando o cep, substintuindo o caracter '-' por vazio
										$cep = preg_replace("/[^0-9]/", "", $cep);

										//exibindo as informações adquiridas a partir da chamada da funcao get_address
										echo "CEP Informado: $cep<br>";
										echo "Rua: $address->logradouro<br>";
										echo "Bairro: $address->bairro<br>";
										echo "Estado: $address->uf<br>";
									}else{
										echo "Por favor, digite um cep!";
									}

									class Address {
										//atributos
										public $logradouro;
										public $bairro;
										public $uf;

										//método recebendo o cep informado pelo usuario
										function get_address($cep){

											//formatando o cep, substintuindo o caracter '-' por vazio
											$cep = preg_replace("/[^0-9]/", "", $cep);

											//a partir desse ponto do codigo passa a ocorrer alguns warnings, caso o cep informado não exista, deveria ser implementado um tratamento para infromar o erro ao usuario
										
											//atribuindo um endereço eletronico na variavel url e passando o valor do cep
											$url = "http://viacep.com.br/ws/$cep/xml/";

											// carrega o conteudo do parametro url dentro de um objeto
											$xml = simplexml_load_file($url);

											//atribiu dados do xml recebido para os respectivos atributos
											$this->logradouro = $xml->logradouro;
											$this->bairro = $xml->bairro;
											$this->uf = $xml->uf;
											return $xml;
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
    	</div>
	</body>
</html>
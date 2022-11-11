<html>
	<head>
		<title> MEU CEP </title>
	</head>
	<body> 
		<form action="index.php" method="post">
			<label> Insira o CEP: </label>
			<input type="text" name="cep">
			<input type="submit" value="Enviar">
		</form>

		<?php
			if(!empty($_POST['cep'])){
				
				$cep = $_POST['cep'];

				$address = new Address();
				$address -> get_address($cep);

				$cep = preg_replace("/[^0-9]/", "", $cep);
				echo "<br><br>CEP Informado: $cep<br>";
				echo "Rua: $address->logradouro<br>";
				echo "Bairro: $address->bairro<br>";
				echo "Estado: $address->uf<br>";
			}

			class Address {
				public $logradouro;
				public $bairro;
				public $uf;

				function get_address($cep){
					$cep = preg_replace("/[^0-9]/", "", $cep);
					$url = "http://viacep.com.br/ws/$cep/xml/";
					$xml = simplexml_load_file($url);
					$this->logradouro = $xml->logradouro;
					$this->bairro = $xml->bairro;
					$this->uf = $xml->uf;
					return $xml;
				}
			}
		?>
	</body>
</html>
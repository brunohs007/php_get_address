<html>
    <!--O title não está dentro de uma tag head -->
	<title> MEU CEP </title>
	<body> 
		<!--Action está enviando os dados para o arquivo idex.php, quando na verdade seria index.php -->
        <!--A tag form não esta sendo fechada -->
		<!--<form action="idex.php" method="post">-->
        <form action="index.php" method="post">
            <label> Insira o CEP: </label>
            <input type="text" name="cep">
            <input type="submit" value="Enviar">
        </form>
	</body>
</html>

<?php
    if(!empty($_POST['cep'])){
        
        $cep = $_POST['cep'];

        // erro $address = (get_address($cp)), erro de sintaxe do parâmetro da função get_address;
        $address = (get_address($cep));
        
        echo "<br><br>CEP Informado: $cep<br>";

        //erros de sintaxe na chamada da variavel address e do atributo logradouro ;
        //echo "Rua: $addres->logradoro<br>";
        echo "Rua: $address->logradouro<br>";

        echo "Bairro: $address->bairro<br>";

        //erro de sintaxe na chamada da variavel address
        //echo "Estado: $adress->uf<br>";
        echo "Estado: $address->uf<br>";
    }
    
    function get_address($cep){

            $cep = preg_replace("/[^0-9]/", "", $cep);

            // erro de sintaxe na url, faltou uma barra
            //$url = "http://viacep.com.br/ws$cep/xml/";
            $url = "http://viacep.com.br/ws/$cep/xml/";

            $xml = simplexml_load_file($url);
            return $xml;
    }
?>
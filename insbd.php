<!-- Inserção de dados no Banco de Dados -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

		function import_files($conn, $filename1, $filename2)
		{
			$file = fopen($filename1, 'r');
			$i = 0;
			$mes_ano = "";
			while (!feof($file)) {
				$content = fgets($file);
				if ($i == 0) {
					$mes_ano = explode(":", $content)[1];
					$query = "INSERT INTO Mes_ano (Mes_ano) VALUES ('$mes_ano');";
					$conn->query($query);
					$i++;
				}
				else {
					$query = "INSERT INTO Plantonista (Matricula, Mes_ano_FK) VALUES ($content, '$mes_ano');";
					$conn->query($query);
					$i++;
				}
			}
			fclose($file);

			$file = fopen($filename2, 'r');
			$i = 0;
			while (!feof($file)) {
				$content = fgets($file);
				if ($i == 0) {
					$i++;
				}
				else {
					$content = explode(";", $content);
					$query = "INSERT INTO Plantao (Numero, Mes_ano_FK, Plantonista_Matricula_FK) VALUES ($content[0], '$mes_ano', $content[1]);";
					$conn->query($query);
					$i++;
				}
			}				
			fclose($file);
		}

		// $conn = new mysqli('127.0.0.1','root','mypassword','cederj',3306);
		$conn = new mysqli('localhost','root','', 'apx2');
		import_files($conn, "Arquivo1.txt", "Arquivo2.txt");
		$conn->close();
		
	?>
</body>
</html>
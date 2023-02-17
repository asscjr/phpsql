<!-- Criação do Banco de Dados -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

		function criarBD($conn)
		{
			$query = 
"
CREATE SCHEMA apx2 DEFAULT CHARACTER SET utf8;
USE apx2 ;

CREATE TABLE Mes_ano (
  Mes_ano VARCHAR(20) PRIMARY KEY NOT NULL
);

CREATE TABLE Plantonista (
  Matricula VARCHAR(20) PRIMARY KEY NOT NULL,
  Mes_ano_FK VARCHAR(20) NOT NULL REFERENCES Mes_ano (Mes_ano)
);

CREATE TABLE Plantao (
  Numero INT NOT NULL,
  Mes_ano_FK VARCHAR(20) NOT NULL REFERENCES Mes_ano (Mes_ano),
  Plantonista_Matricula_FK VARCHAR(20) NOT NULL REFERENCES Plantonista (Matricula),
  PRIMARY KEY (Numero, Mes_ano_FK, Plantonista_Matricula_FK)
);
";

			if ($conn->multi_query($query)) {
				echo "Novo banco de dado criado com sucesso!";
			}
			else {
				echo "Não foi possível criar novo banco de dado \n Erro: " . $conn->error;
			}
		}

		// $conn = new mysqli('127.0.0.1','root','mypassword','cederj',3306);
		$conn = new mysqli('localhost','root','');
		criarBD($conn);
		$conn->close();

	?>
</body>
</html>
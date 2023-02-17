<!-- Consulta ao Banco de Dados para saber se um plantonista possui dois plantões consecutivos -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

		function audita_plantoes($conn, $mes_ano)
		{
			$resultado = [];
			$query = 
"
SELECT
  p1.Numero AS plantao_numero,
  p1.Plantonista_Matricula_FK AS matricula
FROM
  Plantao p1,
  Plantao p2
WHERE
  p1.Plantonista_Matricula_FK = p2.Plantonista_Matricula_FK
  AND p1.Numero = p2.Numero - 1
";
			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()){
					$resultado[] = $row;
				}
			}
			return $resultado;
		}

		// $conn = new mysqli('127.0.0.1','root','mypassword','cederj',3306);
		$conn = new mysqli('localhost','root','', 'apx2');
		$resultado = audita_plantoes($conn, "07/2021");
		print_r($resultado);
		$conn->close();
		
	?>
</body>
</html>
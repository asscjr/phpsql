<!-- Consulta ao Banco de Dados para obter uma tabela relacionando os plantonistas com seus plantões -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

		function contabiliza_plantoes($conn, $mes_ano)
		{
			$html = 
"
<table border='1px'>
	<tr>
		<th>Matrícula</th>
		<th>Quantidade de Plantões</th>
	</tr>

";
			$query = 
"
SELECT
  Matricula,
  COUNT(Plantonista_Matricula_FK) AS QuantidadePlantoes
FROM
  Plantao
RIGHT JOIN
  Plantonista ON Matricula = Plantonista_Matricula_FK
GROUP BY
  Matricula
";
			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()){
					$html .= 
"
	<tr>
		<td>$row[Matricula]</td>
		<td>$row[QuantidadePlantoes]</td>
	</tr>

";
				}
			}

			$html .= "</table>";
			echo $html;
		}

		// $conn = new mysqli('127.0.0.1','root','mypassword','cederj',3306);
		$conn = new mysqli('localhost','root','', 'apx2');
		contabiliza_plantoes($conn, "07/2021");
		$conn->close();
		
	?>
</body>
</html>
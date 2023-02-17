<!-- Consulta ao Banco de Dados para obter os plantões de um plantonista -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
		if (empty($_POST['matricula_plantonista'])) {
			$html =
"
<form action='q5.php' method='POST'>
		<input type='text' name='matricula_plantonista' placeholder='Matrícula do plantonista'>
		<input type='submit' value='Enivar'>
</form>
";
			echo $html;
		}
		else {
			$html = 
"
<table border='1px'>
	<tr>
		<th>Número do Plantão</th>
		<th>Mês e Ano</th>
	</tr>

";
			// $conn = new mysqli('127.0.0.1','root','mypassword','cederj',3306);
			$conn = new mysqli('localhost','root','', 'apx2');
			$matricula_plantonista = $_POST['matricula_plantonista'];
			$query =
"
SELECT
  Numero,
  Mes_ano_FK
FROM
  Plantao
WHERE
  Plantonista_Matricula_FK = '$matricula_plantonista'
";
			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()){
					$html .= 
"
	<tr>
		<td>$row[Numero]</td>
		<td>$row[Mes_ano_FK]</td>
	</tr>

";
				}
			}

			$html .= "</table>";
			echo $html;
			$conn->close();
		}

	?>
</body>
</html>
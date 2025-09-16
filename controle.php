<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Controle</title>
<style>
body { font-family: Arial; }
table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
th, td { border: 1px solid #000; padding: 8px; text-align: center; }
th { background: purple; color: white; }
h2 { background: teal; color: white; padding: 10px; }
.box { border: 1px solid #ccc; padding: 10px; margin: 10px; }
button { padding: 8px; background: green; color: white; border: none; cursor: pointer; }
</style>
</head>
<body>

<h2>Medicamentos</h2>
<table>
<tr><th>Medicamento</th><th>Dosagem</th><th>Paciente</th></tr>
<?php
$res = $conn->query("SELECT m.Medicamento, m.Dose_med, p.Nome_PC 
                     FROM medicamentos m 
                     JOIN paciente p ON m.Paciente = p.ID_PC");
while ($row = $res->fetch_assoc()) {
    echo "<tr>
            <td>{$row['Medicamento']}</td>
            <td>{$row['Dose_med']}</td>
            <td>{$row['Nome_PC']}</td>
          </tr>";
}
?>
</table>

<h2>Pacientes</h2>
<table>
<tr><th>Nome</th><th>Idade</th><th>Peso</th><th>Sexo</th><th>Naft</th></tr>
<?php
$res = $conn->query("SELECT * FROM paciente");
while ($row = $res->fetch_assoc()) {
    echo "<tr>
            <td>{$row['Nome_PC']}</td>
            <td>{$row['Idade']}</td>
            <td>{$row['Peso']}</td>
            <td>{$row['Sexo']}</td>
            <td>" . ($row['Naft'] ? 'Sim' : 'Não') . "</td>
          </tr>";
}
?>
</table>

<div class="box">
<h2>IMC</h2>
<form method="POST">
<input type="text" name="nomePaciente" placeholder="Nome do Paciente" required>
<button type="submit" name="calcularIMC">Calcular IMC</button>
</form>

<?php
if (isset($_POST['calcularIMC'])) {
    $nome = $_POST['nomePaciente'];
    $res = $conn->query("SELECT * FROM paciente WHERE Nome_PC='$nome' LIMIT 1");

    if ($res->num_rows > 0) {
        $pac = $res->fetch_assoc();
        $peso = $pac['Peso'];
        $altura_m = 1.70; // valor padrão, pois a tabela não tem altura
        $imc = $peso / ($altura_m * $altura_m);
        echo "<p>IMC de $nome (altura padrão 1.70m): " . number_format($imc, 2) . "</p>";
    } else {
        echo "<p>Paciente não encontrado!</p>";
    }
}
?>
</div>

<h2 style="background:green;">Controle de Diabetes</h2>
<a href="glicemia.php"><button>Registrar Glicemia</button></a>

</body>
</html>

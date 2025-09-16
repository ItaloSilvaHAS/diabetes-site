<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<style>
body { font-family: Arial; text-align: center; }
.form-box { width: 50%; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
h2 { background: #007bff; color: #fff; padding: 10px; }
input, select { width: 90%; padding: 8px; margin: 5px 0; }
button { background: green; color: white; padding: 10px; border: none; cursor: pointer; }
.topo { margin-top: 10px; }
</style>
</head>
<body>
<a href="controle.php"><button class="topo">Voltar para Controle</button></a>

<div class="form-box">
<h2>INFORME SEUS DADOS</h2>
<form method="POST">
<input type="text" name="nome" placeholder="Nome" required><br>
<input type="number" name="idade" placeholder="Idade" required><br>
<input type="number" step="0.01" name="peso" placeholder="Peso" required><br>
<select name="sexo" required>
<option value="">Selecione</option>
<option value="M">Masculino</option>
<option value="F">Feminino</option>
</select><br>
<select name="naft" required>
<option value="1">Faz uso de Naft</option>
<option value="0">Não faz uso</option>
</select><br>
<button type="submit" name="registrarPaciente">Registrar Paciente</button>
</form>
</div>

<div class="form-box">
<h2>INFORME SEUS MEDICAMENTOS</h2>
<form method="POST">
<input type="text" name="nome_medicamento" placeholder="Nome do Medicamento" required><br>
<input type="text" name="dosagem" placeholder="Dosagem (ex: 500mg)" required><br>
<select name="paciente" required>
    <option value="">Selecione o Paciente</option>
    <?php
    $res = $conn->query("SELECT ID_PC, Nome_PC FROM paciente");
    while ($row = $res->fetch_assoc()) {
        echo "<option value='{$row['ID_PC']}'>{$row['Nome_PC']}</option>";
    }
    ?>
</select><br>
<button type="submit" name="registrarMedicamento">Registrar Medicamento</button>
</form>
</div>

<?php
// Cadastro de paciente
if (isset($_POST['registrarPaciente'])) {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $peso = $_POST['peso'];
    $sexo = $_POST['sexo'];
    $naft = $_POST['naft'];

    // Gerar ID automático simples
    $novo_id = null;
    $res = $conn->query("SELECT MAX(ID_PC) AS max_id FROM paciente");
    if ($res) {
        $row = $res->fetch_assoc();
        $novo_id = $row['max_id'] + 1;
    } else {
        $novo_id = 1;
    }

    $sql = "INSERT INTO paciente (ID_PC, Nome_PC, Idade, Peso, Sexo, Naft) 
            VALUES ('$novo_id', '$nome', '$idade', '$peso', '$sexo', '$naft')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>✅ Paciente registrado com sucesso!</p>";
    } else {
        echo "<p>❌ Erro ao registrar paciente: " . $conn->error . "</p>";
    }
}

// Cadastro de medicamento
if (isset($_POST['registrarMedicamento'])) {
    $nome_med = $_POST['nome_medicamento'];
    $dosagem = $_POST['dosagem'];
    $paciente_id = $_POST['paciente'];

    // Gerar ID automático simples
    $novo_id = null;
    $res = $conn->query("SELECT MAX(ID_MED) AS max_id FROM medicamentos");
    if ($res) {
        $row = $res->fetch_assoc();
        $novo_id = $row['max_id'] + 1;
    } else {
        $novo_id = 1;
    }

    $sql = "INSERT INTO medicamentos (ID_MED, Medicamento, Dose_med, Paciente)
            VALUES ('$novo_id', '$nome_med', '$dosagem', '$paciente_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>✅ Medicamento registrado com sucesso!</p>";
    } else {
        echo "<p>❌ Erro ao registrar medicamento: " . $conn->error . "</p>";
    }
}
?>
</body>
</html>

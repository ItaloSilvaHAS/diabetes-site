<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Registrar Glicemia</title>
<style>
body { font-family: Arial; text-align: center; }
.form-box { width: 50%; margin: 30px auto; padding: 20px; border: 1px solid #ccc; }
h2 { background: #007bff; color: white; padding: 10px; }
input, select { width: 90%; padding: 8px; margin: 5px 0; }
button { background: green; color: white; padding: 10px; border: none; cursor: pointer; }
</style>
</head>
<body>
<a href="controle.php"><button>Voltar ao Controle</button></a>
<div class="form-box">
<h2>Informe a Glicemia</h2>
<form method="POST">
<input type="number" name="valor" placeholder="Valor Glicemia" required><br>
<input type="date" name="data_medicao" required><br>
<input type="time" name="hora_medicao" required><br>

<select name="id_paciente" required>
    <option value="">Selecione o paciente</option>
    <?php
    $res = $conn->query("SELECT ID_PC, Nome_PC FROM paciente ORDER BY Nome_PC");
    while ($row = $res->fetch_assoc()) {
        echo "<option value='{$row['ID_PC']}'>{$row['Nome_PC']}</option>";
    }
    ?>
</select><br>

<button type="submit" name="registrarGlicemia">Registrar</button>
</form>
</div>
<?php
if (isset($_POST['registrarGlicemia'])) {
    $valor = $_POST['valor'];
    $data = $_POST['data_medicao'];
    $hora = $_POST['hora_medicao'];
    $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;

    if (empty($id_paciente)) {
        echo "<p style='color:red;'>Erro: Você deve selecionar um paciente!</p>";
    } else {
        // Evitar SQL Injection usando prepared statements (melhor prática)
        $stmt = $conn->prepare("INSERT INTO glicemia (Glicose, Data, Hora, ID_PC) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $valor, $data, $hora, $id_paciente);

        if ($stmt->execute()) {
            echo "<p>Glicemia registrada com sucesso!</p>";
        } else {
            echo "<p>Erro: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}
?>
</body>
</html>

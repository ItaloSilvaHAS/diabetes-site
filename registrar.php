<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-box {
            background-color: #ffffff;
            padding: 30px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border-radius: 6px 6px 0 0;
            font-size: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .topo {
            background-color: #007bff;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        .topo:hover {
            background-color: #0056b3;
        }

        .mensagem {
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="controle.php" class="topo">Voltar para Controle</a>

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
        $novo_id = 1;
        $res = $conn->query("SELECT MAX(ID_PC) AS max_id FROM paciente");
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $novo_id = $row['max_id'] + 1;
        }

        $sql = "INSERT INTO paciente (ID_PC, Nome_PC, Idade, Peso, Sexo, Naft) 
                VALUES ('$novo_id', '$nome', '$idade', '$peso', '$sexo', '$naft')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='mensagem sucesso'>✅ Paciente registrado com sucesso!</p>";
        } else {
            echo "<p class='mensagem erro'>❌ Erro ao registrar paciente: " . $conn->error . "</p>";
        }
    }

    // Cadastro de medicamento
    if (isset($_POST['registrarMedicamento'])) {
        $nome_med = $_POST['nome_medicamento'];
        $dosagem = $_POST['dosagem'];
        $paciente_id = $_POST['paciente'];

        // Gerar ID automático simples
        $novo_id = 1;
        $res = $conn->query("SELECT MAX(ID_MED) AS max_id FROM medicamentos");
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $novo_id = $row['max_id'] + 1;
        }

        $sql = "INSERT INTO medicamentos (ID_MED, Medicamento, Dose_med, Paciente)
                VALUES ('$novo_id', '$nome_med', '$dosagem', '$paciente_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='mensagem sucesso'>✅ Medicamento registrado com sucesso!</p>";
        } else {
            echo "<p class='mensagem erro'>❌ Erro ao registrar medicamento: " . $conn->error . "</p>";
        }
    }
    ?>
</div>
</body>
</html>

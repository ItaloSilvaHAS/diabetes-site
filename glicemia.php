<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Glicemia</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
            text-align: center;
        }

        .form-box {
            background-color: white;
            width: 50%;
            margin: 30px auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            margin: -25px -25px 20px -25px;
            font-size: 20px;
        }

        input, select {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: green;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
        }

        button:hover {
            background-color: darkgreen;
        }

        .mensagem {
            margin-top: 15px;
            font-size: 16px;
        }

        .erro {
            color: red;
        }

        .sucesso {
            color: green;
        }

        .voltar {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="voltar">
        <a href="controle.php">
            <button>⏪ Voltar ao Controle</button>
        </a>
    </div>

    <div class="form-box">
        <h2>📊 Informe a Glicemia</h2>
        <form method="POST">
            <input type="number" step="0.01" name="valor" placeholder="Valor da Glicemia (mg/dL)" required><br>
            <input type="date" name="data_medicao" required><br>
            <input type="time" name="hora_medicao" required><br>

            <select name="id_paciente" required>
                <option value="">👤 Selecione o Paciente</option>
                <?php
                $res = $conn->query("SELECT ID_PC, Nome_PC FROM paciente ORDER BY Nome_PC");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['ID_PC']}'>{$row['Nome_PC']}</option>";
                }
                ?>
            </select><br>

            <button type="submit" name="registrarGlicemia">Registrar</button>
        </form>

        <?php
        if (isset($_POST['registrarGlicemia'])) {
            $valor = $_POST['valor'];
            $data = $_POST['data_medicao'];
            $hora = $_POST['hora_medicao'];
            $id_paciente = $_POST['id_paciente'] ?? null;

            echo "<div class='mensagem'>";
            if (empty($id_paciente)) {
                echo "<p class='erro'>❌ Você deve selecionar um paciente!</p>";
            } else {
                // Inserção usando prepared statement
                $stmt = $conn->prepare("INSERT INTO glicemia (Glicose, Dt, Hora, ID_PC) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("dssi", $valor, $data, $hora, $id_paciente);

                if ($stmt->execute()) {
                    echo "<p class='sucesso'>✅ Glicemia registrada com sucesso!</p>";
                } else {
                    echo "<p class='erro'>❌ Erro ao registrar: " . $stmt->error . "</p>";
                }

                $stmt->close();
            }
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>

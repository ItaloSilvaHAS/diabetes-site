<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle de Pacientes</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 30px;
        }

        h2 {
            background-color: #17a2b8;
            color: white;
            padding: 15px;
            margin-top: 40px;
            border-radius: 6px 6px 0 0;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: white;
            border-radius: 0 0 6px 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #6f42c1;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        form input[type="text"] {
            width: 60%;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 10px 18px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }

        .resultado {
            margin-top: 15px;
            font-size: 16px;
        }

        .btn-link {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }

        .btn-link:hover {
            background-color: #0056b3;
        }

        .section-header {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <h2 class="section-header">💊 Medicamentos</h2>
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

    <h2>👨‍⚕️ Pacientes</h2>
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
        <h2>📏 Cálculo de IMC</h2>
        <form method="POST">
            <input type="text" name="nomePaciente" placeholder="Nome do Paciente" required>
            <button type="submit" name="calcularIMC">Calcular IMC</button>
        </form>

        <?php
        if (isset($_POST['calcularIMC'])) {
            $nome = $_POST['nomePaciente'];
            $res = $conn->query("SELECT * FROM paciente WHERE Nome_PC='$nome' LIMIT 1");

            echo '<div class="resultado">';
            if ($res->num_rows > 0) {
                $pac = $res->fetch_assoc();
                $peso = $pac['Peso'];
                $altura_m = 1.70; // valor padrão
                $imc = $peso / ($altura_m * $altura_m);
                echo "✅ IMC de <strong>$nome</strong> (altura padrão 1.70m): <strong>" . number_format($imc, 2) . "</strong>";
            } else {
                echo "❌ Paciente <strong>$nome</strong> não encontrado.";
            }
            echo '</div>';
        }
        ?>
    </div>

    <h2 style="background-color: #28a745;">📊 Controle de Glicemia</h2>
    <a href="glicemia.php" class="btn-link">Registrar Glicemia</a>

</body>
</html>

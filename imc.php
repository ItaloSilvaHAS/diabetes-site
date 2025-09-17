<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC</title>
</head>
<body>
    <h2>Calculadora de IMC</h2>
    <form method="post">
        <label>Peso (kg):</label>
        <input type="number" name="peso" step="0.01" required><br><br>

        <label>Altura (m):</label>
        <input type="number" name="altura" step="0.01" required><br><br>

        <input type="submit" value="Calcular IMC">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $peso = floatval($_POST["peso"]);
        $altura = floatval($_POST["altura"]);

        if ($peso > 0 && $altura > 0) {
            $imc = $peso / ($altura * $altura);
            $imcFormatado = number_format($imc, 2, ',', '.');

            echo "<h3>Seu IMC é: $imcFormatado</h3>";

            if ($imc < 18.5) {
                echo "<p><strong>Classificação:</strong> Abaixo do peso</p>";
                echo "<p><strong>Recomendação:</strong> Consulte um nutricionista. Pode ser necessário aumentar sua ingestão calórica.</p>";
            } elseif ($imc < 25) {
                echo "<p><strong>Classificação:</strong> Peso normal</p>";
                echo "<p><strong>Recomendação:</strong> Continue com uma alimentação equilibrada e pratique atividades físicas regularmente.</p>";
            } elseif ($imc < 30) {
                echo "<p><strong>Classificação:</strong> Sobrepeso</p>";
                echo "<p><strong>Recomendação:</strong> Considere ajustar sua alimentação e aumentar a atividade física.</p>";
            } elseif ($imc < 35) {
                echo "<p><strong>Classificação:</strong> Obesidade Grau I</p>";
                echo "<p><strong>Recomendação:</strong> Busque orientação médica e nutricional para prevenir complicações.</p>";
            } elseif ($imc < 40) {
                echo "<p><strong>Classificação:</strong> Obesidade Grau II</p>";
                echo "<p><strong>Recomendação:</strong> Procure ajuda especializada o quanto antes.</p>";
            } else {
                echo "<p><strong>Classificação:</strong> Obesidade Grau III (mórbida)</p>";
                echo "<p><strong>Recomendação:</strong> Risco grave à saúde. Procure atendimento médico urgente.</p>";
            }
        } else {
            echo "<p>Por favor, insira valores válidos.</p>";
        }
    }
    ?>
</body>
</html>

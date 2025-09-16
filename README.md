# 📱 Sistema de Controle de Diabetes

Sistema web simples para monitoramento de diabetes, desenvolvido com PHP e MySQL. Permite registrar pacientes, medicamentos e medições de glicemia, além de calcular o IMC básico.

---

## 📋 Funcionalidades

- Cadastro de pacientes com dados pessoais (nome, idade, peso, sexo e uso de Naft)
- Registro e visualização de medicamentos associados a cada paciente
- Registro de medições de glicemia com data e hora
- Visualização de dados em tabelas organizadas
- Cálculo simples de IMC baseado no peso e altura padrão (1,70m)
- Interface simples e responsiva para facilitar o uso

---

## 🛠️ Tecnologias

- PHP
- MySQL
- HTML5 e CSS3

---

## 🚀 Como executar

### 1. Preparar o banco de dados

- Importe o arquivo `diabetes.sql` no seu servidor MySQL (ex: phpMyAdmin ou linha de comando)
- Caso não tenha banco, crie um chamado `diabetes`

### 2. Configurar a conexão

- Verifique o arquivo `conexao.php` e ajuste as credenciais para acessar o banco:

```php
<?php
$servername = "localhost";
$username = "root";
$password = ""; // sua senha, se tiver
$database = "diabetes";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
```
---

### 3. Rodar o projeto

- Coloque os arquivos no seu servidor web local (ex: XAMPP em htdocs)

- Acesse pelo navegador o arquivo controle.php para usar o sistema

---

## 📁 Estrutura do projeto

```
/Diabetes
│
├── conexao.php         # Conexão com o banco de dados
├── controle.php        # Página principal de controle e visualização
├── glicemia.php        # Registro de medições de glicemia
├── registrar.php       # Cadastro de pacientes e medicamentos
├── diabetes.sql        # Script SQL para criação do banco e dados iniciais
└── README.md           # Documentação do projeto
```


## 🧩 Como usar

- Para cadastrar um paciente ou medicamento, acesse `registrar.php`
- Para registrar glicemia, use `glicemia.php`
- Para visualizar dados e calcular IMC, abra `controle.php`

## 💡 Observações importantes

- O cálculo do IMC considera altura fixa de 1,70m, pois não há campo de altura no banco
- IDs são gerados automaticamente no código PHP, garantindo unicidade simples
- Recomenda-se uso de prepared statements para evitar SQL Injection (já usado no registro de glicemia)
- A interface usa CSS simples para melhor visualização e usabilidade

## 🤝 Contribuição

Contribuições são bem-vindas! Faça um fork, crie sua branch, envie um Pull Request.

## 📫 Contato

- Ítalo S.  
- Email: italo.ss2007@gmail.com  

---

Obrigado por usar este sistema de controle de diabetes! 🎉



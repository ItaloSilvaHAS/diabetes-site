-- Criar banco de dados CASO não existir
CREATE DATABASE IF NOT EXISTS diabetes;

-- Usar o banco de dados
USE diabetes;

-- Criar tabela paciente
CREATE TABLE IF NOT EXISTS paciente (
    ID_PC INT PRIMARY KEY NOT NULL,
    Nome_PC VARCHAR(50),
    Idade INT,
    Peso FLOAT,
    Sexo VARCHAR(2),
    Naft INT
);

-- Criar tabela controle_dt
CREATE TABLE IF NOT EXISTS controle_dt (
    ID_DT INT PRIMARY KEY NOT NULL,
    Glicose FLOAT,
    Gord_fig FLOAT,
    Dt DATE,
    Hora DATETIME,
    ID_PC INT,
    FOREIGN KEY (ID_PC) REFERENCES paciente(ID_PC)
);

-- Criar tabela medicamentos
CREATE TABLE IF NOT EXISTS medicamentos (
    ID_MED INT PRIMARY KEY NOT NULL,
    Medicamento VARCHAR(45),
    Dose_med VARCHAR(45),
    Paciente INT,
    FOREIGN KEY (Paciente) REFERENCES paciente(ID_PC)
);

-- Inserir pacientes
INSERT INTO paciente (ID_PC, Nome_PC, Idade, Peso, Sexo, Naft)
VALUES 
(1, 'João Silva', 35, 70.5, 'M', 1),
(2, 'Maria Santos', 28, 55.2, 'F', 0),
(3, 'Pedro Oliveira', 42, 80.1, 'M', 1);

-- Inserir controle_dt
INSERT INTO controle_dt (ID_DT, Glicose, Gord_fig, Dt, Hora, ID_PC)
VALUES 
(1, 120.0, 30.5, '2022-01-01', NOW(), 1),
(2, 100.0, 25.1, '2022-01-02', NOW(), 2),
(3, 140.0, 35.2, '2022-01-03', NOW(), 3);

-- Inserir medicamentos
INSERT INTO medicamentos (ID_MED, Medicamento, Dose_med, Paciente)
VALUES 
(1, 'Metformina', '500mg', 1),
(2, 'Insulina', '10 UI', 2),
(3, 'Glimepirida', '2mg', 3);

-- Consultas
SELECT * FROM paciente;
SELECT * FROM controle_dt;
SELECT * FROM medicamentos;

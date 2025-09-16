-- Criar banco de dados CASO n�o existir com if

IF NOT EXISTS (SELECT name FROM sys.databases WHERE name = 'diabetes')
BEGIN
    CREATE DATABASE diabetes;
END;
GO

-- Usar o banco de dados
USE diabetes;
GO

-- Criar tabela paciente
CREATE TABLE paciente (
    ID_PC INT PRIMARY KEY NOT NULL,
    Nome_PC VARCHAR(50),
    Idade INT,
    Peso FLOAT,
    Sexo VARCHAR(2),
    Naft INT
);
GO

-- Criar tabela controle_dt
CREATE TABLE controle_dt (
    ID_DT INT PRIMARY KEY NOT NULL,
    Glicose FLOAT,
    Gord_fig FLOAT,
    Dt DATE,
    Hora DATETIME,
    ID_PC INT,
    FOREIGN KEY (ID_PC) REFERENCES paciente(ID_PC)
);
GO

-- Criar tabela medicamentos
CREATE TABLE medicamentos (
    ID_MED INT PRIMARY KEY NOT NULL,
    Medicamento VARCHAR(45),
    Dose_med VARCHAR(45),
    Paciente INT,
    FOREIGN KEY (Paciente) REFERENCES paciente(ID_PC)
);
GO

-- Inserir pacientes
INSERT INTO paciente (ID_PC, Nome_PC, Idade, Peso, Sexo, Naft)
VALUES 
(1, 'Jo�o Silva', 35, 70.5, 'M', 1),
(2, 'Maria Santos', 28, 55.2, 'F', 0),
(3, 'Pedro Oliveira', 42, 80.1, 'M', 1);
GO

-- Inserir controle_dt
INSERT INTO controle_dt (ID_DT, Glicose, Gord_fig, Dt, Hora, ID_PC)
VALUES 
(1, 120.0, 30.5, '2022-01-01', GETDATE(), 1),
(2, 100.0, 25.1, '2022-01-02', GETDATE(), 2),
(3, 140.0, 35.2, '2022-01-03', GETDATE(), 3);
GO

-- Inserir medicamentos
INSERT INTO medicamentos (ID_MED, Medicamento, Dose_med, Paciente)
VALUES 
(1, 'Metformina', '500mg', 1),
(2, 'Insulina', '10 UI', 2),
(3, 'Glimepirida', '2mg', 3);
GO

-- Consultas
SELECT * FROM paciente;
SELECT * FROM controle_dt;
SELECT * FROM medicamentos;

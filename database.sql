CREATE TABLE paciente(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    endereco VARCHAR(50),
    telefone VARCHAR(11),
    CPF VARCHAR(11),    
);

CREATE TABLE medico(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    CPF VARCHAR(11),
    RG VARCHAR(11),
    CRM VARCHAR(100) UNIQUE,  
    telefone VARCHAR(11),
    endereco VARCHAR(50),
    sexo CHAR(1),
    senha_acesso VARCHAR(255)
);

CREATE TABLE consulta(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    data_consulta DATE,
    horario TIME,
    CRM VARCHAR(100),
    CPF VARCHAR(11),
    FOREIGN KEY (CRM) REFERENCES medico(CRM),
    FOREIGN KEY (CPF) REFERENCES paciente(CPF)
);

CREATE TABLE paciente(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    endereco VARCHAR(50),
    telefone VARCHAR(11),
	nascimento DATE,
    CPF VARCHAR(11),
);

CREATE TABLE consultas(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    data_consulta DATE,
    horario TIME,
    CRM VARCHAR(100),
    CPF VARCHAR(11),
    FOREIGN KEY (CRM) REFERENCES medico(CRM),
    FOREIGN KEY (CPF) REFERENCES paciente(CPF)
);

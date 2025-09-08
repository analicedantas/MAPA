CREATE TABLE paciente(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome_paciente VARCHAR(100),
    telefone_paciente VARCHAR(11),
    endereco_paciente VARCHAR(50),
    nascimento_paciente DATE,
    CPF_paciente VARCHAR(11) UNIQUE 
);

CREATE TABLE medico(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome_medico VARCHAR(100),
    especialidade_medico VARCHAR(100),
    CPF_medico VARCHAR(11) UNIQUE,
    CRM_medico VARCHAR(100) UNIQUE, 
    telefone_medico VARCHAR(11),
    endereco_medico VARCHAR(50)
);

CREATE TABLE consultas(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    data_consulta DATE,
    horario TIME,
    CPF_paciente VARCHAR(11),         
    CRM_medico VARCHAR(100),          
    FOREIGN KEY (CPF_paciente) REFERENCES paciente(CPF_paciente),
    FOREIGN KEY (CRM_medico) REFERENCES medico(CRM_medico)        
);









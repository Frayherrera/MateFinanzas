
create database mateFinanzas;


create table rol(
    id int primary key auto_increment,
    nombre varchar(50),
    permiso tinyint
);

create table usuario(
    id int primary key auto_increment,
    nombre varchar(50),
    apellido varchar(50),
    documento bigint,
    telefono bigint,
    correo varchar(250) UNIQUE,
    clave varchar(250),
    idRol int,
    estado tinyint default 1,
    fechaCreacion datetime default current_timestamp,
    fechaActualizacion datetime default current_timestamp on update current_timestamp,
    foreign key(idRol) references rol(id)
);

create table tema(
    id int primary key auto_increment,
    titulo varchar(250),
    descripcion text,
    estado tinyint default 1
);

create table modulo(
    id int primary key auto_increment,
    titulo varchar(250),
    descripcion text,
    video text,
    idTema int,
    estado tinyint default 1,
    foreign key(idTema) references tema(id)
);


create table pregunta(
    id int primary key auto_increment,
    titulo varchar(250),
    descripcion text,
    idTema int,
    foreign key(idTema) references tema(id)
);

create table opcion(
    id int primary key auto_increment,
    descripcion text,
    idPregunta int,
    correcta tinyint,
    foreign key(idPregunta) references pregunta(id)
);

create table respuesta(
    idUsuario int,
    idPregunta int,
    idTema int,
    idOpcion int,
    fechaCreacion datetime default current_timestamp,
    foreign key(idUsuario) references usuario(id),
    foreign key(idOpcion) references opcion(id),
    foreign key(idPregunta) references pregunta(id),
    foreign key(idTema) references tema(id),
    primary key(idUsuario, idPregunta, idTema)
);

INSERT INTO tema (id, descripcion, titulo) VALUES(1, 'Este tema explora cómo el valor del dinero cambia con el tiempo debido a factores como la inflación y los intereses. Es fundamental para entender conceptos financieros básicos y avanzados.', 'Valor del Dinero en el Tiempo');
INSERT INTO tema (id, descripcion, titulo) VALUES(2, 'Este tema se enfoca en las herramientas y métodos utilizados para evaluar y comparar inversiones, asegurando la mejor toma de decisiones financieras.', 'Análisis de Inversiones');
INSERT INTO tema (id, descripcion, titulo) VALUES(3, 'Estudio de cómo se estructuran los pagos de préstamos a lo largo del tiempo, incluyendo el pago de intereses y principal.', 'Amortización de Préstamos');
INSERT INTO tema (id, descripcion, titulo) VALUES(4, 'Introducción a los instrumentos financieros que derivan su valor de otros activos subyacentes, como opciones, futuros y swaps.', 'Instrumentos Financieros Derivados');
INSERT INTO tema (id, descripcion, titulo) VALUES(5, 'Métodos y técnicas para identificar, medir y gestionar los riesgos financieros asociados con inversiones y operaciones financieras.', 'Evaluación de Riesgo Financiero');

INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(1, '¿Qué es el Valor Presente (VP)?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(2, '¿Qué es el Valor Futuro (VF)?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(3, '¿Cuál es la fórmula del Valor Futuro (VF) en interés compuesto?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(4, '¿Qué representa la tasa de descuento en el cálculo del Valor Presente?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(5, '¿Cuál de las siguientes afirmaciones es verdadera sobre el Valor del Dinero en el Tiempo?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(6, '¿Qué significa el término "interés compuesto"?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(7, '¿Cuál es el efecto del interés compuesto en una inversión a largo plazo?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(8, '¿Cuál es la fórmula del Valor Presente (VP) en interés compuesto?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(9, '¿Qué es una anualidad?', NULL, 1);
INSERT INTO pregunta (id, titulo, descripcion, idTema) VALUES(10, '¿Cuál de las siguientes opciones es un ejemplo de uso del Valor del Dinero en el Tiempo?', NULL, 1);

INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(1, 'El valor actual de una cantidad de dinero que se recibirá en el futuro descontado a una tasa de interés específica.', 1, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(2, 'La cantidad de dinero que se espera recibir en el futuro sin descuento.', 1, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(3, 'La tasa de interés aplicable a una inversión.', 1, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(4, 'La cantidad de dinero invertida en un proyecto.', 1, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(5, 'La cantidad de dinero que se espera recibir en el futuro.', 2, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(6, 'El valor actual de una cantidad de dinero descontada a una tasa de interés.', 2, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(7, 'El valor de una inversión después de ganar interés a lo largo del tiempo.', 2, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(8, 'La tasa de interés aplicable a una inversión.', 2, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(9, 'VF = VP / (1 + i)^n', 3, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(10, 'VF = VP * (1 + i)^n', 3, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(11, 'VF = VP * (1 + n)^i', 3, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(12, 'VF = VP * (1 - i)^n', 3, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(13, 'La tasa a la cual el dinero se presta.', 4, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(15, 'La tasa de inflación.', 4, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(16, 'La tasa de interés que se utiliza para descontar los flujos de efectivo futuros.', 4, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(14, 'La tasa de rendimiento de una inversión.', 4, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(17, 'El dinero recibido hoy vale menos que el dinero recibido en el futuro.', 5, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(18, 'El dinero recibido hoy vale más que el dinero recibido en el futuro.', 5, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(19, 'El dinero recibido hoy y en el futuro tiene el mismo valor.', 5, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(20, 'El valor del dinero no cambia con el tiempo.', 5, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(21, 'El interés calculado sobre el capital inicial únicamente.', 6, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(22, 'El interés calculado sobre el capital inicial y sobre los intereses acumulados de periodos anteriores.', 6, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(23, 'El interés calculado una vez al año.', 6, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(24, 'El interés calculado sobre los pagos mensuales de una hipoteca.', 6, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(25, 'Aumenta el valor futuro de la inversión más rápidamente que el interés simple.', 7, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(26, 'Disminuye el valor futuro de la inversión.', 7, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(27, 'No tiene efecto en el valor futuro de la inversión.', 7, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(28, 'Es igual que el interés simple a largo plazo.', 7, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(29, 'VP = VF / (1 + i)^n', 8, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(30, 'VP = VF * (1 + i)^n', 8, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(31, 'VP = VF * (1 - i)^n', 8, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(32, 'VP = VF / (1 - i)^n', 8, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(33, 'Una suma de dinero pagada o recibida una sola vez en el futuro.', 9, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(34, 'Una serie de pagos iguales realizados a intervalos regulares.', 9, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(35, 'Una tasa de interés aplicada a una inversión.', 9, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(36, 'Un préstamo que se paga en cuotas desiguales.', 9, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(37, 'Calcular el valor presente de una inversión futura.', 10, 1);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(38, 'Determinar la tasa de interés de una hipoteca.', 10, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(39, 'Evaluar el rendimiento pasado de una acción.', 10, 0);
INSERT INTO opcion (id, descripcion, idPregunta, correcta) VALUES(40, 'Comparar los costos de dos productos diferentes.', 10, 0);
-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jun-2019 às 19:39
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atena`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assuntos`
--

CREATE TABLE `assuntos` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `fk_materias_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `assuntos`
--

INSERT INTO `assuntos` (`cod`, `nome`, `fk_materias_cod`) VALUES
(7, 'Funções orgânicas', 3),
(8, 'Reações químicas', 3),
(9, 'Eletroquímica', 3),
(10, 'Estequiometria', 3),
(11, 'Termoquímica', 3),
(12, 'Problemas ambientais', 3),
(13, 'Introdução à química orgânica', 3),
(14, 'Ligações químicas', 3),
(16, 'Estrutura molecular', 3),
(19, 'Seno, cosseno e tangente', 2),
(20, 'Probabilidade', 2),
(21, 'Análise combinatória', 2),
(22, 'Progressão aritmética e geométrica', 2),
(23, 'Brasil Colônia', 7),
(24, 'Segunda Guerra Mundial', 7),
(25, 'Idade Média', 7),
(26, 'Escravidão', 7),
(27, 'Militarismo no Brasil', 7),
(28, 'Revolução Industrial', 7),
(29, 'Guerra Fria', 7),
(30, 'Liberalismo', 7),
(35, 'Questões ambientais', 6),
(36, 'Agropecuária', 6),
(37, 'Fases do capitalismo', 6),
(38, 'Urbanização', 6),
(39, 'Indústria', 6),
(40, 'Migrações', 6),
(41, 'Comércio', 6),
(42, 'Mecânica', 4),
(43, 'Eletricidade e energia', 4),
(44, 'Ondulatória', 4),
(45, 'Termodinâmica', 4),
(46, 'Óptica', 4),
(47, 'Citologia', 5),
(48, 'Ecologia', 5),
(49, 'Genética', 5),
(50, 'Evolução', 5),
(51, 'Fisiologia', 5),
(52, 'Botânica', 5),
(53, 'Ética Justiça', 8),
(54, 'Natureza do conhecimento', 8),
(55, 'Democracia e Cidadania', 8),
(56, 'Filosofia contemporânea', 8),
(57, 'Filosofia Moderna', 8),
(58, 'Sociologia Temática', 9),
(59, 'Diversidade Cultural e Estratificação Social', 9),
(60, 'Teorias Sociológicas', 9),
(61, 'Trabalho e Produção', 9),
(62, 'Poder, Estado e Política', 9),
(63, 'Movimentos Sociais', 9),
(64, 'Práticas corporais e autonomia', 11),
(65, 'Padrão estético contemporâneo', 11),
(66, 'Esportes', 11),
(67, 'Exercício físico e saúde', 11),
(68, 'Corpo e expressão artística/cultural', 11),
(69, 'Danças', 11),
(70, 'Condicionamentos e esforços físicos', 11),
(71, 'Lutas', 11),
(72, 'Arte Contemporânea', 10),
(73, 'Arte Brasileira pós 1970', 10),
(74, 'Modernismo Europeu', 10),
(75, 'Modernismo no Brasil', 10),
(76, 'Arquitetura Moderna no Brasil', 10),
(77, 'Modernismo no Brasil pós Semana de 22', 10),
(78, 'Interpretação de texto', 12),
(103, 'Figuras de linguagem', 1),
(104, 'Denotação e conotação', 1),
(105, 'Funções da linguagem', 1),
(106, 'Gêneros Textuais', 1),
(107, 'Funções', 2),
(108, 'área, volume e perímetro', 2),
(109, 'Interpretação de Texto', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE `materias` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`cod`, `nome`) VALUES
(1, 'Português\r\n'),
(2, 'Matemática\r\n'),
(3, 'Química\r\n'),
(4, 'Física\r\n'),
(5, 'Biologia\r\n'),
(6, 'Geografia\r\n'),
(7, 'Historia\r\n'),
(8, 'Filosofia\r\n'),
(9, 'Sociologia\r\n'),
(10, 'Artes\r\n'),
(11, 'Educação Física\r\n'),
(12, 'Inglês\r\n'),
(13, 'Espanhol');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

CREATE TABLE `prova` (
  `nome` varchar(200) NOT NULL DEFAULT 'sem titulo',
  `data` varchar(10) DEFAULT NULL,
  `cod` int(11) NOT NULL,
  `fk_user_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prova`
--

INSERT INTO `prova` (`nome`, `data`, `cod`, `fk_user_cod`) VALUES
('Funções Orgânicas - Prova 1', '16/06/2019', 1, 2),
('Funções Orgânicas - Prova 1', '16/06/2019', 26, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `cod` int(11) NOT NULL,
  `corpo` varchar(3000) DEFAULT NULL,
  `comando` varchar(200) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `fk_assunto_cod` int(11) NOT NULL,
  `item_a` varchar(500) NOT NULL,
  `item_b` varchar(500) NOT NULL,
  `item_c` varchar(500) NOT NULL,
  `item_d` varchar(500) NOT NULL,
  `item_e` varchar(500) NOT NULL,
  `item_correto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`cod`, `corpo`, `comando`, `imagem`, `fk_assunto_cod`, `item_a`, `item_b`, `item_c`, `item_d`, `item_e`, `item_correto`) VALUES
(1, '(PUC-RJ 2015) A seguir está representada a estrutura da dihidrocapsaicina, uma substância comumente encontrada em pimentas e pimentões', 'Na dihidrocapsaicina, está presente, entre outras, a função orgânica:', 'img_q/274f7b82cbc663969f0e34621fd4c903b44c3427.png', 7, 'amina.', 'amida.', 'éster.', 'aldeído.', 'álcool.', ''),
(2, '(UEPA(Adaptada) 2015) A imensa flora das Américas deu significativas contribuições a terapêutica, como a descoberta da Iobelina (figura abaixo), molécula polifuncionalizada isolada da planta Lobelianicotinaefolia e usada por tribos indígenas que fumavam suas folhas secas para aliviar os sintomas da asma.', 'Sobre a estrutura química da Iobelina, é correto afirmar que:', 'img_q/9fe895e59cb4832f311d372c63e9e92588a33876.png', 7, 'possui um aldeído', 'possui três carbonos primários', 'possui uma amida', 'possui um fenol', 'possui uma amina terciária', ''),
(4, '(IBMEC-RJ 2013)A sacarose (C12H22O11), também conhecida como açúcar de mesa, é um tipo de glicídio formado por uma molécula de glicose e uma de uma frutose produzida pela planta ao realizar o processo de fotossíntese.', 'De acordo com a sua fórmula estrutural, indique as funções na molécula de sacarose:', 'img_q/a749074c6b96cbcd7b13c9821d7b20ddfe7fb648.png', 7, 'álcool e fenol', 'álcool e éter', 'álcool e cetona', 'cetona e álcool', 'éter e cetona', ''),
(5, '(PUC-RJ 2014)', 'Nas estruturas de ambas as substâncias I e II, está presente a função orgânica:', 'img_q/eafec00f185b0904c33ffaff598f7afd6a4fe2c0.png', 7, 'álcool.', 'aldeído.', 'cetona.', 'éster.', 'éter.', ''),
(6, '(ENEM 2014)O principal processo industrial utilizado na produção de fenol é a oxidação do cumeno (isopropilbenzeno). A equação mostra que esse processo envolve a formação do hidroperóxido de cumila, que em seguida é decomposto em fenol e acetona, ambos usados na indústria química como precursores de moléculas mais complexas. Após o processo de síntese, esses dois insumos devem ser separados para comercialização individual.', 'Considerando as características físico-químicas dos dois insumos formados, o método utilizado para a separação da mistura, em escala industrial, é a', 'img_q/74f3f6ec4208358917aa33f23dc1b9a80b003137.png', 7, 'filtração.', 'ventilação.', 'decantação.', 'evaporação.', 'destilação fracionada', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes_prova`
--

CREATE TABLE `questoes_prova` (
  `fk_prova_cod` int(11) DEFAULT NULL,
  `cod` int(11) NOT NULL,
  `fk_questoes_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questoes_prova`
--

INSERT INTO `questoes_prova` (`fk_prova_cod`, `cod`, `fk_questoes_cod`) VALUES
(1, 146, 5),
(1, 147, 4),
(1, 148, 6),
(1, 149, 1),
(1, 150, 2),
(26, 221, 5),
(26, 222, 4),
(26, 223, 6),
(26, 224, 1),
(26, 225, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `passwd` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nivel_acesso` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `user`, `passwd`, `email`, `nivel_acesso`) VALUES
(2, 'Lucas865', 'f88721b39587a450edeb7d4b8e4a63a1fd59fbd4', '', 0),
(3, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assuntos`
--
ALTER TABLE `assuntos`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `FK_Assuntos_2` (`fk_materias_cod`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `prova`
--
ALTER TABLE `prova`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `FK_Prova` (`fk_user_cod`);

--
-- Indexes for table `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `FK_Questoes_2` (`fk_assunto_cod`);

--
-- Indexes for table `questoes_prova`
--
ALTER TABLE `questoes_prova`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `FK_questoes_prova_1` (`fk_prova_cod`),
  ADD KEY `fk_questoes_prova_2` (`fk_questoes_cod`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assuntos`
--
ALTER TABLE `assuntos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `prova`
--
ALTER TABLE `prova`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `questoes`
--
ALTER TABLE `questoes`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questoes_prova`
--
ALTER TABLE `questoes_prova`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `assuntos`
--
ALTER TABLE `assuntos`
  ADD CONSTRAINT `FK_Assuntos_2` FOREIGN KEY (`fk_materias_cod`) REFERENCES `materias` (`cod`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `prova`
--
ALTER TABLE `prova`
  ADD CONSTRAINT `FK_Prova` FOREIGN KEY (`fk_user_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `questoes`
--
ALTER TABLE `questoes`
  ADD CONSTRAINT `FK_Questoes_2` FOREIGN KEY (`fk_assunto_cod`) REFERENCES `assuntos` (`cod`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `questoes_prova`
--
ALTER TABLE `questoes_prova`
  ADD CONSTRAINT `FK_questoes_prova_1` FOREIGN KEY (`fk_prova_cod`) REFERENCES `prova` (`cod`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_questoes_prova_2` FOREIGN KEY (`fk_questoes_cod`) REFERENCES `questoes` (`cod`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

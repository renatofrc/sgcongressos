-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Out-2017 às 19:33
-- Versão do servidor: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgcongressos`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_delete` (`piduser` INT)  BEGIN
	
    DECLARE vidperson INT;
    
	SELECT idperson INTO vidperson
    FROM tb_users
    WHERE iduser = piduser;
    
    DELETE FROM tb_users WHERE iduser = piduser;
    DELETE FROM tb_persons WHERE idperson = vidperson;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (`pdesperson` VARCHAR(64), `pdeslogin` VARCHAR(64), `pdespassword` VARCHAR(256), `pdesemail` VARCHAR(128), `pnrphone` BIGINT, `pinadmin` TINYINT)  BEGIN
 
    DECLARE vidperson INT;
    
 INSERT INTO tb_persons (desperson, desemail, nrphone)
    VALUES(pdesperson, pdesemail, pnrphone);
    
    SET vidperson = LAST_INSERT_ID();
    
    INSERT INTO tb_users (idperson, deslogin, despassword, inadmin)
    VALUES(vidperson, pdeslogin, pdespassword, pinadmin);
    
    SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = LAST_INSERT_ID();
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_event`
--

CREATE TABLE `tb_event` (
  `idevent` int(11) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `site` varchar(20) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_user_id` int(11) NOT NULL,
  `initial_date` varchar(12) NOT NULL,
  `end_date` varchar(12) NOT NULL,
  `regs_start` varchar(12) DEFAULT NULL,
  `regs_end` varchar(12) DEFAULT NULL,
  `vacancies` int(11) DEFAULT '0',
  `subscribes` int(11) DEFAULT '0',
  `background_image` varchar(30) DEFAULT NULL,
  `local` varchar(40) NOT NULL,
  `address` varchar(150) NOT NULL,
  `cep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_event`
--

INSERT INTO `tb_event` (`idevent`, `event_name`, `description`, `site`, `dtregister`, `create_user_id`, `initial_date`, `end_date`, `regs_start`, `regs_end`, `vacancies`, `subscribes`, `background_image`, `local`, `address`, `cep`) VALUES
(104, 'Novo Teste', 'Novo teste com descrição teste', 'novoteste', '2017-10-10 14:26:20', 17, '01/11/2017', '04/11/2017', NULL, NULL, 50, 0, NULL, 'UEMG', 'Rua', 9081383);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lecture`
--

CREATE TABLE `tb_lecture` (
  `idlecture` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `initial_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `vacancies` int(11) NOT NULL,
  `dt_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idevent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_participants`
--

CREATE TABLE `tb_participants` (
  `idparticipant` int(11) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` int(11) DEFAULT '0',
  `image_file` varchar(30) DEFAULT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_participants_events`
--

CREATE TABLE `tb_participants_events` (
  `id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_participants_lectures`
--

CREATE TABLE `tb_participants_lectures` (
  `id` int(11) NOT NULL,
  `id_participants` int(11) NOT NULL,
  `id_lectures` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_participants_scourses`
--

CREATE TABLE `tb_participants_scourses` (
  `id` int(11) NOT NULL,
  `id_participants` int(11) NOT NULL,
  `id_scourses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_persons`
--

CREATE TABLE `tb_persons` (
  `idperson` int(11) NOT NULL,
  `desperson` varchar(64) NOT NULL,
  `desemail` varchar(128) DEFAULT NULL,
  `nrphone` bigint(20) DEFAULT NULL,
  `image_file` varchar(30) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_persons`
--

INSERT INTO `tb_persons` (`idperson`, `desperson`, `desemail`, `nrphone`, `image_file`, `dtregister`) VALUES
(4, 'Renato Franco', 'rasfdeveloper@gmail.com', 34996630818, NULL, '2017-09-04 01:43:11'),
(5, 'Teste', 'teste@teste.com', 3499999999, NULL, '2017-09-04 19:40:46'),
(6, 'admin', 'admin@admin.com', 34343434, NULL, '2017-09-09 18:55:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_scourses`
--

CREATE TABLE `tb_scourses` (
  `idscourses` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `initial_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `vacancies` int(11) NOT NULL,
  `idevent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `iduser` int(11) NOT NULL,
  `desname` varchar(64) NOT NULL,
  `desemail` varchar(128) NOT NULL,
  `nrphone` bigint(20) DEFAULT NULL,
  `profimage` varchar(255) DEFAULT NULL,
  `deslogin` varchar(64) NOT NULL,
  `despassword` varchar(256) NOT NULL,
  `isadmin` tinyint(4) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `desname`, `desemail`, `nrphone`, `profimage`, `deslogin`, `despassword`, `isadmin`, `dtregister`) VALUES
(17, 'Administrador', 'admin@admin.com', 34994949494, NULL, 'admin', '$2y$12$NvgUbRDyU/r8CUWRsmnBJukbDA3oEgjc0BoQCHVAZEyNjaxYz2TG6', 1, '2017-09-19 13:06:47'),
(39, 'Renato Franco', 'renato@admin.com', 3499999999, NULL, 'renatofrc', '$2y$12$qYhI/3l.gD3zr/Ko4gwKouMS14VvPZRQxQ5h4bjRWcJntBil8VBxu', 0, '2017-10-08 00:11:04'),
(40, 'RFTeste', 'teste@teste.com', 349, NULL, 'testerf', '$2y$12$Dq.osfqcxcLwNse9LkGVk.UBrIPQj1aAxsMpgl6vp7GtikE6vwkZC', 0, '2017-10-09 22:32:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userslogs`
--

CREATE TABLE `tb_userslogs` (
  `idlog` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `deslog` varchar(128) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `desuseragent` varchar(128) NOT NULL,
  `dessessionid` varchar(64) NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userspasswordsrecoveries`
--

CREATE TABLE `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`idevent`),
  ADD KEY `fk_tb_event_tb_users1_idx` (`create_user_id`);

--
-- Indexes for table `tb_lecture`
--
ALTER TABLE `tb_lecture`
  ADD PRIMARY KEY (`idlecture`),
  ADD KEY `fk_tb_lecture_tb_event1_idx` (`idevent`);

--
-- Indexes for table `tb_participants`
--
ALTER TABLE `tb_participants`
  ADD PRIMARY KEY (`idparticipant`);

--
-- Indexes for table `tb_participants_events`
--
ALTER TABLE `tb_participants_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_participants_lectures`
--
ALTER TABLE `tb_participants_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_lecture_idx` (`id_lectures`),
  ADD KEY `FK_participants_lecture` (`id_participants`) USING BTREE;

--
-- Indexes for table `tb_participants_scourses`
--
ALTER TABLE `tb_participants_scourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_scourses_idx` (`id_scourses`),
  ADD KEY `FK_participants_scourses` (`id_participants`) USING BTREE;

--
-- Indexes for table `tb_persons`
--
ALTER TABLE `tb_persons`
  ADD PRIMARY KEY (`idperson`);

--
-- Indexes for table `tb_scourses`
--
ALTER TABLE `tb_scourses`
  ADD PRIMARY KEY (`idscourses`),
  ADD KEY `fk_tb_scourses_tb_event1_idx` (`idevent`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `tb_userslogs`
--
ALTER TABLE `tb_userslogs`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_userslogs_users_idx` (`iduser`);

--
-- Indexes for table `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD PRIMARY KEY (`idrecovery`),
  ADD KEY `fk_userspasswordsrecoveries_users_idx` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `tb_lecture`
--
ALTER TABLE `tb_lecture`
  MODIFY `idlecture` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_participants`
--
ALTER TABLE `tb_participants`
  MODIFY `idparticipant` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_participants_events`
--
ALTER TABLE `tb_participants_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_participants_lectures`
--
ALTER TABLE `tb_participants_lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_participants_scourses`
--
ALTER TABLE `tb_participants_scourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_persons`
--
ALTER TABLE `tb_persons`
  MODIFY `idperson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_scourses`
--
ALTER TABLE `tb_scourses`
  MODIFY `idscourses` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tb_userslogs`
--
ALTER TABLE `tb_userslogs`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  MODIFY `idrecovery` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_event`
--
ALTER TABLE `tb_event`
  ADD CONSTRAINT `fk_tb_event_tb_users1` FOREIGN KEY (`create_user_id`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_lecture`
--
ALTER TABLE `tb_lecture`
  ADD CONSTRAINT `fk_tb_lecture_tb_event1` FOREIGN KEY (`idevent`) REFERENCES `tb_event` (`idevent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_participants_lectures`
--
ALTER TABLE `tb_participants_lectures`
  ADD CONSTRAINT `FK_lecture` FOREIGN KEY (`id_lectures`) REFERENCES `tb_lecture` (`idlecture`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_participants_lectures` FOREIGN KEY (`id_participants`) REFERENCES `tb_participants` (`idparticipant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_participants_scourses`
--
ALTER TABLE `tb_participants_scourses`
  ADD CONSTRAINT `FK_participants_courses` FOREIGN KEY (`id_participants`) REFERENCES `tb_participants` (`idparticipant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_scourses` FOREIGN KEY (`id_scourses`) REFERENCES `tb_scourses` (`idscourses`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_scourses`
--
ALTER TABLE `tb_scourses`
  ADD CONSTRAINT `fk_tb_scourses_tb_event1` FOREIGN KEY (`idevent`) REFERENCES `tb_event` (`idevent`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_userslogs`
--
ALTER TABLE `tb_userslogs`
  ADD CONSTRAINT `fk_userslogs_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD CONSTRAINT `fk_userspasswordsrecoveries_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

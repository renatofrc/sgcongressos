-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Nov-2017 às 17:09
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
-- Database: `sgeventos`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_activities_save` (`pactivity_name` VARCHAR(64), `pdescription` VARCHAR(255), `pactivity_type` VARCHAR(64), `pdata_activity` VARCHAR(20), `pinitial_hour` VARCHAR(20), `pend_hour` VARCHAR(20), `pvacancies` INT(11), `pevent_id` INT(11))  BEGIN
     
 	INSERT INTO tb_activities (activity_name, description, activity_type,
		 data_activity, initial_hour, end_hour, vacancies, event_id) 
    	VALUES(pactivity_name, pdescription, pactivity_type, pdata_activity, pinitial_hour, pend_hour, 
    	pvacancies, pevent_id);
	
     IF (EXISTS(SELECT * FROM tb_activities WHERE event_id = pevent_id)) THEN 
    
		UPDATE tb_event SET activities = activities + 1 WHERE idevent = pevent_id;
	    
	END IF;

   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_event_delete` (`pidevent` INT(11), `piduser` INT(11))  BEGIN

    DELETE FROM tb_event WHERE idevent = pidevent AND create_user_id = piduser;
    
    DELETE FROM tb_activities WHERE event_id = pidevent;
    DELETE FROM tb_participants WHERE event_id = pidevent;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_participants_save` (`ppname` VARCHAR(150), `pcpf` VARCHAR(20), `pphone` BIGINT, `pemail` VARCHAR(40), `plogin` VARCHAR(64), `ppassword` VARCHAR(256), `pevent_id` INT(11), `pcategory` VARCHAR(50), `pidevent` INT(11))  BEGIN
 
   
    
 INSERT INTO tb_participants (pname, cpf, phone,
		 email, login, password, event_id, category) 
    VALUES(ppname, pcpf, pphone, pemail, plogin, ppassword, pevent_id, pcategory);
    
    
    UPDATE tb_event SET subscribes = subscribes + 1 WHERE idevent = pidevent;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_payment_approved` (`pidparticipant` INT(11))  BEGIN 

	UPDATE tb_payment SET status = 'approved' WHERE create_user_id = pidparticipant;

	UPDATE tb_participants SET status = 1 WHERE idparticipant = pidparticipant;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userspasswordsrecoveries_create` (`piduser` INT, `pip` VARCHAR(45))  BEGIN
	
	INSERT INTO tb_userspasswordsrecoveries (iduser, ip)
    VALUES(piduser, pip);
    
    SELECT * FROM tb_userspasswordsrecoveries
    WHERE idrecovery = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_delete` (`piduser` INT)  BEGIN
	
    DECLARE vidperson INT;
    
	SELECT idperson INTO vidperson
    FROM tb_users
    WHERE iduser = piduser;
    
    DELETE FROM tb_users WHERE iduser = piduser;
    DELETE FROM tb_persons WHERE idperson = vidperson;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_activities`
--

CREATE TABLE `tb_activities` (
  `idactivity` int(11) NOT NULL,
  `activity_name` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `activity_type` varchar(64) NOT NULL,
  `data_activity` varchar(20) NOT NULL,
  `initial_hour` varchar(50) NOT NULL,
  `end_hour` varchar(50) NOT NULL,
  `subscribes` int(11) DEFAULT NULL,
  `vacancies` int(11) DEFAULT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_activities`
--

INSERT INTO `tb_activities` (`idactivity`, `activity_name`, `description`, `activity_type`, `data_activity`, `initial_hour`, `end_hour`, `subscribes`, `vacancies`, `event_id`) VALUES
(11, 'Curso Excel', 'Curso de excel de duas horas', 'Oficina', '18/10/2017', '03:00 PM', '05:00 PM', NULL, 50, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bank`
--

CREATE TABLE `tb_bank` (
  `idbank` int(11) NOT NULL,
  `bank_name` varchar(60) NOT NULL,
  `agency` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `cpf_cnpj` int(11) NOT NULL,
  `holder_name` varchar(60) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `activities` int(11) NOT NULL,
  `local` varchar(40) NOT NULL,
  `address` varchar(150) NOT NULL,
  `cep` int(11) NOT NULL,
  `price` double NOT NULL,
  `fb_id` varchar(40) DEFAULT NULL,
  `instagram_id` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_event`
--

INSERT INTO `tb_event` (`idevent`, `event_name`, `description`, `site`, `dtregister`, `create_user_id`, `initial_date`, `end_date`, `regs_start`, `regs_end`, `vacancies`, `subscribes`, `activities`, `local`, `address`, `cep`, `price`, `fb_id`, `instagram_id`) VALUES
(112, 'Evento teste Final', 'Breve descrição sobre o evento', 'final', '2017-10-17 17:11:33', 17, '23/10/2017', '26/10/2017', '10/10/2017', '13/10/2017', 50, 3, 1, 'uemg', 'Rua Dep Daniel de Freitas Barros, Bairro Universitario', 38300400, 2, 'rasfdeveloper', 'rasfdeveloper'),
(114, 'Teste evento', 'teste', 'teste', '2017-10-20 21:32:48', 39, '24/10/2017', '26/10/2017', NULL, NULL, 50, 0, 0, 'UEMG', 'Rua', 38300400, 0, '', ''),
(115, 'Evento Franco', 'Franco', 'franco', '2017-10-20 21:45:56', 42, '22/10/2017', '24/10/2017', NULL, NULL, 50, 0, 0, 'uemg', 'RUa', 38300400, 0, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_participants`
--

CREATE TABLE `tb_participants` (
  `idparticipant` int(11) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `event_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_participants`
--

INSERT INTO `tb_participants` (`idparticipant`, `pname`, `cpf`, `phone`, `email`, `status`, `login`, `password`, `event_id`, `category`, `dtregister`) VALUES
(11, 'Renato Antonio Silva Franco', '10832563609', 34996630818, 'renatofr95@gmail.com', 1, 'renatofrc', '$2y$12$KUfvvrSziHnlLdyPESMv4uNxah6GqIgEJVlYDhYFeqC5vcg0Is/cW', 112, 'Estudante', '2017-10-18 12:04:56'),
(12, 'Teste SG', '100200300400', 3493939393, 'testesgeventos@gmail.com', 1, 'testesg', '$2y$12$2AJd/yGvfwzC1KYl6MaV8OiPTmhh5ezW1Opx4EK20lwkH.daP2UXG', 112, 'Professor', '2017-10-25 23:12:38'),
(13, 'Renato teste', '100200400300', 34996630818, 'samara.florinndo@gmail.com', 1, 'renato', '$2y$12$ojI2d0v2ECiidDQkJCKovO48NjRzSjKQPLsTy/7jrxfKWxGvzeHeW', 112, 'Estudante', '2017-10-27 16:56:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_payment`
--

CREATE TABLE `tb_payment` (
  `id` int(11) NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_payment`
--

INSERT INTO `tb_payment` (`id`, `payment_id`, `total_amount`, `date_created`, `expiration`, `payment_method`, `status`, `create_user_id`, `event_id`) VALUES
(9, 3091983434, '2', '2017-10-27 14:53:29', '2017-10-30T23:53:23.000-04:00', 'ticket', 'approved', 11, 112),
(10, 3091987772, '2', '2017-10-27 14:59:02', '2017-10-30T23:58:58.000-04:00', 'ticket', 'pending', 13, 112),
(12, 8172561, '2', '2017-10-30 03:33:42', NULL, 'credit_card', 'approved', 12, 112),
(13, 8193959, '2', '2017-10-31 08:58:28', NULL, 'credit_card', 'approved', 13, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_request_deposit`
--

CREATE TABLE `tb_request_deposit` (
  `id` int(11) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `event_id` int(11) NOT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(40, 'RFTeste', 'teste@teste.com', 349, NULL, 'testerf', '$2y$12$Dq.osfqcxcLwNse9LkGVk.UBrIPQj1aAxsMpgl6vp7GtikE6vwkZC', 0, '2017-10-09 22:32:05'),
(41, 'Teste Participante', 'teste@teste.com', 3499999999, NULL, 'login', '$2y$12$OEaXf9b7/P48ma.dRs.ce.deh5cuSrxn2onNYal6eu3KPjA7QdwgC', 0, '2017-10-14 03:44:56'),
(42, 'Franco', 'franco@franco.com', 3499999999, NULL, 'franco', '$2y$12$Y.jNFfn.XrBqAM0B8/aGkel5MA3dcqCjzL70Zyd/L1unAqGdMKE6q', 0, '2017-10-20 21:45:28'),
(43, 'ADM', 'adm@admm.com', 3499992222, NULL, 'adm', '$2y$12$vy1abvbphugUqtHJA.S62Op0i.BJFRfdN0AjAEZ/MijhA.vLuc.3O', 0, '2017-10-30 00:24:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userspasswordsrecoveries`
--

CREATE TABLE `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_activities`
--
ALTER TABLE `tb_activities`
  ADD PRIMARY KEY (`idactivity`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`idbank`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`idevent`),
  ADD KEY `fk_tb_event_tb_users1_idx` (`create_user_id`);

--
-- Indexes for table `tb_participants`
--
ALTER TABLE `tb_participants`
  ADD PRIMARY KEY (`idparticipant`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_request_deposit`
--
ALTER TABLE `tb_request_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`iduser`);

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
-- AUTO_INCREMENT for table `tb_activities`
--
ALTER TABLE `tb_activities`
  MODIFY `idactivity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `idbank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `tb_participants`
--
ALTER TABLE `tb_participants`
  MODIFY `idparticipant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_request_deposit`
--
ALTER TABLE `tb_request_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
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
-- Limitadores para a tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD CONSTRAINT `fk_userspasswordsrecoveries_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

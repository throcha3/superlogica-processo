SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE DATABASE superlogica;
use superlogica;

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `ano_nascimento` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `info` (`id`, `cpf`, `genero`, `ano_nascimento`) VALUES
(1, '16798125050', 'M', '1976'),
(2, '59875804045', 'M', '1960'),
(3, '04707649025', 'F', '1988'),
(4, '21142450040', 'M', '1954'),
(5, '83257946074', 'F', '1970'),
(6, '07583509025', 'M', '1972');

/* Essa é a tabela utilizada no cadastro do exercicio 2 */
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `login` varchar(30) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuario` (`id`, `cpf`, `nome`) VALUES
(1, '16798125050', 'Luke Skywalker'),
(2, '59875804045', 'Bruce Wayne'),
(3, '04707649025', 'Diane Prince'),
(4, '21142450040', 'Bruce Banner'),
(5, '83257946074', 'Harley Quinn'),
(6, '07583509025', 'Peter Parker');


ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


/* Query final do exercicio 3 */
set @ano = DATE_FORMAT(CURRENT_DATE, "%Y"); 
SELECT CONCAT(usuario.nome," - ", info.genero) as usuario, IF((@ano-info.ano_nascimento >= 50), "SIM", "NÃO") as maior_50_anos FROM usuario INNER JOIN info ON usuario.cpf = info.cpf 
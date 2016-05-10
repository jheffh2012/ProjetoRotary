-- mysql workbench forward engineering

set @old_unique_checks=@@unique_checks, unique_checks=0;
set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0;
set @old_sql_mode=@@sql_mode, sql_mode='traditional,allow_invalid_dates';

-- -----------------------------------------------------
-- schema rotary
-- -----------------------------------------------------

-- -----------------------------------------------------
-- schema rotary
-- -----------------------------------------------------
create schema if not exists `rotary` default character set utf8 ;
use `rotary` ;

-- -----------------------------------------------------
-- table `rotary`.`distritos`
-- -----------------------------------------------------
create table if not exists `rotary`.`distritos` (
  `iddistritos` int not null,
  `descricao` varchar(120) null,
  primary key (`iddistritos`))
engine = innodb;


-- -----------------------------------------------------
-- table `rotary`.`pais`
-- -----------------------------------------------------
create table if not exists `rotary`.`pais` (
  `id` int not null,
  `nome` varchar(120) null,
  `sigla` varchar(3) null,
  primary key (`id`))
engine = innodb;


-- -----------------------------------------------------
-- table `rotary`.`estados`
-- -----------------------------------------------------
create table if not exists `rotary`.`estados` (
  `idestados` int not null auto_increment,
  `sigla` varchar(3) null,
  `estado` varchar(100) null,
  `pais_id` int not null,
  primary key (`idestados`, `pais_id`),
  index `fk_estados_pais1_idx` (`pais_id` asc),
  constraint `fk_estados_pais1`
    foreign key (`pais_id`)
    references `rotary`.`pais` (`id`)
    on delete no action
    on update no action)
engine = innodb;


-- -----------------------------------------------------
-- table `rotary`.`cidades`
-- -----------------------------------------------------
create table if not exists `rotary`.`cidades` (
  `idcidades` int not null,
  `descricao` varchar(120) not null,
  `estados_idestados` int not null,
  `populacao` int null,
  primary key (`idcidades`, `estados_idestados`),
  index `fk_cidades_estados1_idx` (`estados_idestados` asc),
  constraint `fk_cidades_estados1`
    foreign key (`estados_idestados`)
    references `rotary`.`estados` (`idestados`)
    on delete no action
    on update no action)
engine = innodb;


-- -----------------------------------------------------
-- table `rotary`.`clubes`
-- -----------------------------------------------------
create table if not exists `rotary`.`clubes` (
  `idclubes` int not null,
  `descricao` varchar(60) null,
  `codigo_cidade` int not null,
  `associados` int not null,
  primary key (`idclubes`),
  index `fk_clubes_cidades1_idx` (`codigo_cidade` asc),
  constraint `fk_clubes_cidades1`
    foreign key (`codigo_cidade`)
    references `rotary`.`cidades` (`idcidades`)
    on delete no action
    on update no action)
engine = innodb;


-- -----------------------------------------------------
-- table `rotary`.`pessoa`
-- -----------------------------------------------------
create table if not exists `rotary`.`pessoa` (
  `idpessoa` int not null,
  `nomerazao` varchar(120) null,
  `apelidofantasia` varchar(120) null,
  `cpfcnpj` varchar(18) null,
  `rgie` varchar(20) null,
  `codigo_distrito` int not null,
  `codigo_cidades` int not null,
  primary key (`idpessoa`),
  index `fk_pessoa_distritos1_idx` (`codigo_distrito` asc),
  index `fk_pessoa_cidades1_idx` (`codigo_cidades` asc),
  constraint `fk_pessoa_distritos1`
    foreign key (`codigo_distrito`)
    references `rotary`.`distritos` (`iddistritos`)
    on delete no action
    on update no action,
  constraint `fk_pessoa_cidades1`
    foreign key (`codigo_cidades`)
    references `rotary`.`cidades` (`idcidades`)
    on delete no action
    on update no action)
engine = innodb;


-- -----------------------------------------------------
-- table `rotary`.`distrito_cidades`
-- -----------------------------------------------------
create table if not exists `rotary`.`distrito_cidades` (
  `iddistritocidades` int not null,
  `codigo_distrito` int not null,
  `codigo_cidades` int not null,
  primary key (`iddistritocidades`),
  index `fk_distrito_cidades_distritos1_idx` (`codigo_distrito` asc),
  index `fk_distrito_cidades_cidades1_idx` (`codigo_cidades` asc),
  constraint `fk_distrito_cidades_distritos1`
    foreign key (`codigo_distrito`)
    references `rotary`.`distritos` (`iddistritos`)
    on delete no action
    on update no action,
  constraint `fk_distrito_cidades_cidades1`
    foreign key (`codigo_cidades`)
    references `rotary`.`cidades` (`idcidades`)
    on delete no action
    on update no action)
engine = innodb;


set sql_mode=@old_sql_mode;
set foreign_key_checks=@old_foreign_key_checks;
set unique_checks=@old_unique_checks;

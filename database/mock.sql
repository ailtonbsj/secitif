-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.25a
-- Versão do PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `secitif_demo`
--

DELIMITER $$
--
-- Funções
--
CREATE FUNCTION `Func_Remove_Acentos`(Texto VARCHAR(150)) RETURNS varchar(150) CHARSET utf8
BEGIN
DECLARE Acentos, SemAcentos, Resultado VARCHAR(150);
DECLARE Cont INT;

SET Acentos = 'ÀÂÊÔÎÛÃÕÁÉÍÓÚÇÜ';
SET SemAcentos = 'AAEOIUAOAEIOUCU';
SET Cont = CHAR_LENGTH(Texto);
SET Resultado = UPPER(Texto);

WHILE Cont > 0 DO
SET Resultado = REPLACE(Resultado, SUBSTRING(Acentos, Cont, 1), SUBSTRING(SemAcentos, Cont, 1));
SET Cont = Cont - 1;
END WHILE;

RETURN LOWER(Resultado);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigos`
--

CREATE TABLE IF NOT EXISTS `artigos` (
  `email` varchar(35) DEFAULT NULL,
  `titulo` varchar(300) DEFAULT NULL,
  `resumo` varchar(2300) DEFAULT NULL,
  `chaves` varchar(200) DEFAULT NULL,
  `nomeurl` char(12) NOT NULL DEFAULT '',
  `data_envio` date DEFAULT NULL,
  `cod_mod` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL,
  `ultima_alteracao` date DEFAULT NULL,
  `nota1` double DEFAULT NULL,
  `prof_avaliador` varchar(50) DEFAULT NULL,
  `nota2` double DEFAULT NULL,
  PRIMARY KEY (`nomeurl`),
  KEY `fk_email` (`email`),
  KEY `fk_cod` (`cod_mod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `artigos`
--

INSERT INTO `artigos` (`email`, `titulo`, `resumo`, `chaves`, `nomeurl`, `data_envio`, `cod_mod`, `situacao`, `ultima_alteracao`, `nota1`, `prof_avaliador`, `nota2`) VALUES
('demo@local', 'Conservacao de Energia, QEE e Energia Solar', 'De fato, nunca se falou tanto de energia e de como conservá-la como agora, seja como decorrência da crise energética brasileira de 2001 ou das preocupações ambientais e geopolí­ticas mundial relacionadas aos combustÃ­veis fósseis e seus prováveis substitutivos. Assim, o surgimento de um quadro de dificuldades para o atendimento do mercado de energia elétrica a partir de maio de 2001, impondo diversas ações governamentais e de toda a sociedade restituÃ­ram ao tema energia a verdadeira dimensão que lhe foi subtraída desde que os efeitos dos choques do petróleo dos anos setenta foram diluÃ­dos ao longo das décadas seguintes', 'Enegia Solar, QEE, Eficiencia', '011112050811', '2012-11-01', 8, 'V', '2012-12-29', 6.1, 'maria', 9),
('demo@local', 'O e-kanban como interface entre o setor de manufatura e o administrativo', 'Este artigo tem como objetivo apresentar uma nova técnica de gerenciamento da produção, o e-kanban. Mostrar como ela pode ser utilizada para melhorar a produção e o gerenciamento de informações entre o setor administrativo e o de manufatura. Além disso, tem o objetivo de descrever o que é o sistema kanban', 'e-kanban, Administração, PCP', '011112051432', '2012-11-01', 8, 'V', '2012-12-29', 6.2, 'joao', 7),
('demo4@local', 'programação web 2', 'A Internet é um dos meios de comunicação mais usados hoje em dia, nela você pode enviar mensagens, buscar informações, ler noticias, procurar emprego, fazer compras, jogar, estudar, enfim, fazer uma gama de coisa sem precisar sair de casa. A internet surgiu no perÃ­odo da Guerra Fria, na disputa militar entre os Estados Unidos e a União Soviética e até chegar os dias atuais houve grandes revoluções. Ela nada mais é do que o um grupo de computadores interconectados e trocando informações', 'Web, Programação', '011112052816', '2012-11-01', 3, 'V', '2012-12-29', 6.5, 'thiago', 8.1),
('demo5@local', 'Modelamento de Projetos', 'A edificação do Estabelecimento de Ensino Particular será concretizada com base em estudo para melhor aproveitamento da área ocupada, levando em consideração a segurança, a distribuição das salas de aulas e a administração numa disposição harmoniosa e coerente com o fluxo de alunos e funcionários', 'modelagem', '011112054135', '2012-11-01', 10, 'V', '2012-12-29', 7, 'kaka', 7),
('demo5@local', 'A Análise de Fourier utilizando o software Proteus Isis: Um estudo de caso sobre as harmônicas', 'Neste artigo apresenta-se a técnica de análise de Fourier utilizando o software Proteus Isis para simulação de sinais harmônicos em um sistema elétrico de potência. Para tanto, faz-se um introdutório sobre sistemas elétricos de potência, harmônicos, séries e transformada de Fourier', 'Análise de Fourier, Proteus Isis, Harmônicas, Sistema Elétrico de Potência', '011112054447', '2012-11-01', 9, 'V', '2012-12-29', 8.7, 'Popkin', 9),
('demo3@local', 'Seleção de Controladores de Motores de Passo para Melhor Desempenho', 'Através da rotação e um incremento angular discreto, os motores de passo provem uma solução com maior precisão no controle de movimento e medida de aplicações, especialmente quando usa-se uma tecnologia de controle apropriada. Além disso, as funções de avanço, reversão, travagem e controle de velocidade, em motores de passo, tem a capacidade de executar o controle de movimento muito fino em incrementos com alta precisão', 'Motor de Passo, ROM', '011112054828', '2012-11-01', 9, 'V', '2012-12-29', 9.3, 'ghie', 9),
('demo3@local', 'Sistema de Contagem de Pessoas em Sala', 'Esse é um sistema microcontrolado onde através de sensores de presença ópticos detecta-se a passagem de pessoas em uma porta indicando o sentido do mesmo e mostrando a quantidade de pessoas atual em um display e no computador', 'Contador, Sensor Optico, PIC', '011112060118', '2012-11-01', 10, 'V', '2012-12-29', 8.6, 'thiy', 7),
('demo3@local', 'Plano de Trabalho de Projeto Social', 'Tendo em vista a variedade de opções disponíveis para execução do projeto, foi escolhido um projeto para mostrar aos alunos a importância do curso de mecatrônica e ao mesmo tempo capacitar os alunos na atualização de robô elétrico desenvolvido por eles mesmo', 'Projeto Social, RoboCar', '011112061429', '2012-11-01', 10, 'V', '2012-12-29', 0, '10', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores`
--

CREATE TABLE IF NOT EXISTS `autores` (
  `cod_artigo` char(12) DEFAULT NULL,
  `nome_autor` varchar(35) DEFAULT NULL,
  `apres` char(1) NOT NULL,
  KEY `fk_url` (`cod_artigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `autores`
--

INSERT INTO `autores` (`cod_artigo`, `nome_autor`, `apres`) VALUES
('011112050811', 'Demo José da Silva', ''),
('011112050811', 'Cristiano Neves Pereira', ''),
('011112050811', 'Daucileide Neves Pereira', ''),
('011112051432', 'Demo José da Silva', ''),
('011112051432', 'Rômulo Euzébio Ferreira', ''),
('011112051432', 'Jarbas Rocha Martins', ''),
('011112052816', 'Paulivan Carmo', ''),
('011112052816', 'Demo José da Silva', ''),
('011112054135', 'Oziel Pereira', ''),
('011112054447', 'Oziel Pereira', ''),
('011112054447', 'Demo José da Silva', ''),
('011112054447', 'Renan Nunes Pinheiro', ''),
('011112054828', 'Hermesson Douglas', ''),
('011112054828', 'Demo José da Silva', ''),
('011112054828', 'Renan Nunes Pinheiro', ''),
('011112060118', 'Hermesson Douglas', ''),
('011112060118', 'Demo José da Silva', ''),
('011112061429', 'Hermesson Douglas', ''),
('011112061429', 'Demo José da Silva', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `datas`
--

CREATE TABLE IF NOT EXISTS `datas` (
  `id_datas` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `cod_local` int(11) NOT NULL,
  `cod_curso` varchar(12) NOT NULL,
  PRIMARY KEY (`id_datas`),
  KEY `fk_datas_Local1_idx` (`cod_local`),
  KEY `fk_datas_minicursos1_idx` (`cod_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- Extraindo dados da tabela `datas`
--

INSERT INTO `datas` (`id_datas`, `dia`, `hora_inicio`, `hora_fim`, `cod_local`, `cod_curso`) VALUES
(14, 5, '13:30:00', '17:30:00', 7, '291012211714'),
(13, 3, '13:30:00', '17:30:00', 6, '291012210517'),
(12, 2, '13:30:00', '17:30:00', 6, '291012210517'),
(15, 6, '13:30:00', '17:30:00', 7, '291012211714'),
(16, 5, '08:00:00', '12:00:00', 8, '291012212255'),
(17, 6, '08:00:00', '12:00:00', 8, '291012212255'),
(18, 5, '08:00:00', '12:00:00', 9, '291012212952'),
(19, 6, '08:00:00', '12:00:00', 9, '291012212952'),
(20, 3, '13:30:00', '17:30:00', 10, '291012214253'),
(21, 5, '08:00:00', '12:00:00', 11, '291012214708'),
(22, 5, '13:30:00', '17:30:00', 11, '291012214708'),
(23, 6, '08:00:00', '12:00:00', 11, '291012214708'),
(24, 6, '13:30:00', '17:30:00', 11, '291012214708'),
(25, 2, '13:30:00', '17:30:00', 10, '291012215915'),
(26, 3, '08:00:00', '12:00:00', 10, '291012215915'),
(27, 4, '13:30:00', '17:30:00', 6, '291012221353'),
(28, 5, '13:30:00', '17:30:00', 6, '291012221353'),
(29, 2, '13:30:00', '17:30:00', 12, '291012222044'),
(30, 5, '13:30:00', '17:30:00', 12, '291012222500'),
(31, 4, '08:00:00', '12:00:00', 12, '291012222840'),
(32, 3, '08:00:00', '12:00:00', 13, '291012223421'),
(33, 3, '13:30:00', '17:30:00', 11, '291012223843'),
(34, 4, '13:30:00', '17:30:00', 14, '291012224129'),
(35, 5, '13:30:00', '17:30:00', 14, '291012224129'),
(36, 3, '13:30:00', '17:30:00', 15, '291012224632'),
(37, 4, '13:30:00', '17:30:00', 15, '291012224632'),
(38, 5, '08:00:00', '12:00:00', 10, '291012224903'),
(39, 4, '08:00:00', '12:00:00', 7, '291012225621'),
(40, 5, '08:00:00', '12:00:00', 7, '291012225621'),
(41, 5, '13:30:00', '17:30:00', 16, '291012225908'),
(42, 4, '13:30:00', '17:30:00', 12, '301012144831'),
(88, 3, '13:30:00', '17:30:00', 12, '301012144831'),
(87, 5, '08:00:00', '12:00:00', 13, '301012145428'),
(45, 4, '13:30:00', '17:30:00', 18, '301012150131'),
(46, 3, '13:30:00', '17:30:00', 8, '301012150837'),
(47, 4, '13:30:00', '17:30:00', 8, '301012151346'),
(48, 5, '13:30:00', '17:30:00', 8, '301012151346'),
(49, 2, '13:30:00', '17:30:00', 11, '301012152151'),
(50, 3, '08:00:00', '12:00:00', 11, '301012152151'),
(51, 3, '13:30:00', '17:30:00', 9, '301012152806'),
(52, 4, '13:30:00', '17:30:00', 9, '301012152806'),
(53, 6, '08:00:00', '12:00:00', 10, '301012154905'),
(54, 4, '08:00:00', '12:00:00', 19, '301012160035'),
(55, 5, '08:00:00', '12:00:00', 19, '301012160035'),
(56, 6, '08:00:00', '12:00:00', 19, '301012160035'),
(57, 3, '08:00:00', '12:00:00', 16, '301012160354'),
(85, 3, '13:30:00', '17:30:00', 25, '301012160354'),
(59, 4, '08:00:00', '12:00:00', 16, '301012160710'),
(86, 4, '13:30:00', '17:30:00', 25, '301012160710'),
(61, 4, '08:00:00', '12:00:00', 20, '301012161005'),
(62, 4, '13:30:00', '17:30:00', 20, '301012164023'),
(63, 6, '08:00:00', '12:00:00', 21, '301012180308'),
(64, 6, '13:30:00', '17:30:00', 21, '301012180308'),
(65, 5, '08:00:00', '12:00:00', 12, '301012180912'),
(66, 6, '08:00:00', '12:00:00', 13, '301012181429'),
(67, 6, '13:30:00', '17:30:00', 13, '301012181429'),
(68, 5, '08:00:00', '12:00:00', 24, '301012181941'),
(69, 5, '13:30:00', '17:30:00', 24, '301012181941'),
(70, 5, '08:00:00', '12:00:00', 20, '301012190225'),
(71, 5, '13:30:00', '17:30:00', 20, '301012190225'),
(72, 5, '08:00:00', '12:00:00', 21, '301012191201'),
(73, 5, '13:30:00', '17:30:00', 21, '301012191201'),
(77, 6, '13:30:00', '17:30:00', 10, '301012191838'),
(76, 5, '13:30:00', '17:30:00', 10, '301012191838'),
(78, 4, '08:00:00', '12:00:00', 24, '301012192956'),
(79, 4, '13:30:00', '17:30:00', 24, '301012192956'),
(80, 6, '13:30:00', '17:30:00', 12, '301012194426'),
(81, 6, '08:00:00', '12:00:00', 20, '301012194754'),
(82, 6, '13:30:00', '17:30:00', 20, '301012194754'),
(83, 4, '13:30:00', '17:30:00', 13, '301012195237'),
(84, 5, '13:30:00', '17:30:00', 13, '301012195237'),
(89, 3, '08:00:00', '09:00:00', 23, '011112202321');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipes`
--

CREATE TABLE IF NOT EXISTS `equipes` (
  `cod_equipe` char(12) NOT NULL,
  `nome_equipe` varchar(35) NOT NULL,
  `compet` char(4) NOT NULL,
  `pago` char(1) NOT NULL DEFAULT 'F',
  `liberador` varchar(50) DEFAULT NULL,
  `data_lib` datetime DEFAULT NULL,
  PRIMARY KEY (`cod_equipe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipes`
--

INSERT INTO `equipes` (`cod_equipe`, `nome_equipe`, `compet`, `pago`, `liberador`, `data_lib`) VALUES
('141112135128', 'Bux', 'elet', 'F', 'demo2@local', '2012-11-14 13:58:04'),
('141112135054', 'Kags', 'prog', 'T', 'demo@local', '2012-11-14 20:49:57'),
('141112135156', 'Rock', 'prog', 'F', 'demo2@local', '2012-11-14 13:58:00'),
('141112135313', 'ASD', 'corr', 'T', 'demo@local', '2012-11-14 20:52:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipes_usuarios`
--

CREATE TABLE IF NOT EXISTS `equipes_usuarios` (
  `cod_equipe` varchar(12) NOT NULL,
  `email_usu` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`cod_equipe`,`email_usu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipes_usuarios`
--

INSERT INTO `equipes_usuarios` (`cod_equipe`, `email_usu`, `status`) VALUES
('141112135313', 'demo3@local', 'L'),
('141112135156', 'demo5@local', 'A'),
('141112135156', 'demo6@local', 'L'),
('141112135054', 'demo@local', 'L'),
('141112135054', 'demo3@local', 'M'),
('141112135128', 'demo6@local', 'L'),
('141112135128', 'demo3@local', 'M');

-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `hora_curso`
--
CREATE TABLE IF NOT EXISTS `hora_curso` (
`dia` int(11)
,`hora_inicio` time
,`hora_fim` time
,`cod_curso` varchar(12)
);
-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `hora_user`
--
CREATE TABLE IF NOT EXISTS `hora_user` (
`dia` int(11)
,`hora_inicio` time
,`hora_fim` time
,`cod_curso` varchar(12)
);
-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `cod_local` int(11) NOT NULL AUTO_INCREMENT,
  `nome_local` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cod_local`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`cod_local`, `nome_local`) VALUES
(6, 'Lab. de Automação e Robótica'),
(7, 'Lab. de Comandos Elétricos'),
(8, 'Lab. de Info. da Matemática'),
(9, 'Lab. de Info. CID'),
(10, 'Lab. de Info. da Mecatrônica'),
(11, 'Lab. de Info. Geral'),
(12, 'Bloco E Sala 11 (Inferior)'),
(13, 'Bloco E Sala 10 (Inferior)'),
(14, 'Lab. de Eletrônica Digital'),
(15, 'Lab. de Instalações Elétricas'),
(16, 'Lab. de Metrologia'),
(17, 'Bloco F Sala 7 (superior)'),
(18, 'Lab. de Eletrônica Analógica'),
(19, 'Lab. de Soldagem'),
(20, 'Bloco E Sala 13'),
(21, 'Bloco E Sala 12'),
(22, 'CLIF'),
(23, 'Salão de Atos'),
(24, 'Lab. de Matemática'),
(25, 'Galpão de Usinagem');

-- --------------------------------------------------------

--
-- Estrutura da tabela `minicursos`
--

CREATE TABLE IF NOT EXISTS `minicursos` (
  `cod_curso` varchar(12) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `total_vagas` int(11) DEFAULT NULL,
  `vagas_disponiveis` int(11) DEFAULT NULL,
  `descricao` text,
  `evento` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `minicursos`
--

INSERT INTO `minicursos` (`cod_curso`, `titulo`, `total_vagas`, `vagas_disponiveis`, `descricao`, `evento`) VALUES
('291012210517', 'Acionamento de Manipuladores Usando o Cyrus', 12, 12, 'O acionamento de robôs manipuladores permite facilitar o uso dos programas devido à interface mais amigável, além de agilizar o processo de aprendizado', 'F'),
('291012211714', 'Acionamento de Motores', 10, 5, 'Apresentar neste material uma série de experiência práticas que visam enriquecer os conhecimentos voltados à operação com a eletricidade. Objetivo deste minicurso é oportunizar informações sobre chaves de partidas estáticos através de chaves soft-start e inversor de frequência', 'F'),
('291012212255', 'Análise de Circuitos no MATLAB', 20, 20, 'O Matlab (MATrixLABoratory) é um software destinado a realizar cálculos com matrizes e não linguagem de programação como comumente se classifica. O seu uso é bastante abrangente, sendo utilizado em vários meios industriais e acadêmicos, por permitir a realização de aplicações ao nível da análise numérica e processamento de sinais, abordando uma banda larga de problemas de engenharia. Neste contexto, o objetivo deste minicurso é apresentar as funcionalidades do Matlab na análise de Circuitos Elétricos, visando diminuir a complexibilidade de resolução que apresentam certos problemas, no ambiente da Engenharia Elétrica moderna', 'F'),
('291012212952', 'Astronomia: Passo a Passo', 25, 24, 'Introdução à astronomia, introdução à astrofísica. Despertar questionamento sobre os mitos e as verdades do Cosmos, assim como compreender como é feita a medição e localização espacial. Observando a falta de conhecimentos em relação à astronomia, o minicurso vem para mostrar as vertentes da astronomia e suas aplicações no dia-a-dia', 'F'),
('291012214253', 'AutoCAD Básico', 21, 20, 'Este minicurso tem por objetivo transmitir ao publico as noções básicas para desenvolver projetos no software AutoCAD, visto que no que se diz respeito às tecnologias CAD, o auto CAD e um do software mais utilizado no mercado', 'F'),
('291012214708', 'Banco de Dados e SQL', 18, 17, 'O minicurso abordará uma introdução as noções de banco de dados e a linguagem SQL. Utilizando como exemplo o software SGBD MySQL', 'F'),
('291012215915', 'Introdução ao Desenvolvimento de Aplicação para Android', 22, 21, 'Apresentação da plataforma Android, seu ambiente e a realização de práticas de desenvolvimento de aplicações. Por ser uma linguagem mordena há a exigência de demanda de trabalho, também não foge da FEMECI, pois é uma área de aprendizado de baixo custo (código livre)', 'F'),
('291012221353', 'Células de manufatura e montagem robótica FESTO', 12, 12, 'O objetivo deste mini-curso é mostrar como de fato acontecem os processos de produção nas indústrias. Ao termino deste minicurso iremos adquirir um prévio conhecimento sobre programação e robótica', 'F'),
('291012222044', 'Elaboração de Trabalhos Monográficos', 12, 12, 'Auxiliar a elaboração de trabalhos monográficos. Necessidade de uma melhoria da qualidade dos trabalhos de final de curso através da normalização estabilizada', 'F'),
('291012222500', 'Empreendedorismo de Base Tecnológica e Inovação', 22, 22, 'Conhecimento, eficiência e rapidez no processo de inovação passam a ser os elementos decisivos para a competitividade das economias. Neste contexto o objetivo é contribuir para a consolidação de uma cultura empreendedora na região; Prever arranjos inovativos, otimizando as sinergias de diferentes fatores (locais e externos). Viabilizar a transformação do conhecimento em produtos, processos e serviços', 'F'),
('291012222840', 'Evolução Através da Eletricidade', 20, 20, 'Não informado!', 'F'),
('291012223421', 'Fontes de Energia Renovaveis', 20, 19, 'Com crescimento populacional e industrial houve um aumento no consumo de energia elétrica, e ainda uma preocupação com impactos ambientais. As fontes de energias renováveis são a principal solução para essa problemática de forma sustentável e sem causar grandes impactos ambientais', 'F'),
('291012223843', 'Hibernate com Java Persistence API', 20, 19, 'Não Informado!', 'F'),
('291012224129', 'Instalação de Sistema Solar Fotovoltaico', 15, 15, 'O sistema solar fotovoltaico vem ganhando uma importância exponencial no âmbito de energia renovável, tal que, se faz uso de uma fonte de energia limpa e inesgotável, a radiação solar. Nesta síntese, o objetivo desses minicurso, é apresentar as melhores técnicas de instalação e manutenção de painéis solares, visando contribuir na sustentabilidade de modo geral.  Ao final do minicurso, o aluno será capaz de dimensionar, instalar e manusear de maneira eficiente equipamentos que compõe o sistema solar fotovoltaico, tais como: inversores de frequência, controladores de tensão e acumuladores de carga', 'F'),
('291012224632', 'Instalações Elétricas de Baixa Tensão', 15, 15, 'Práticas de instalações elétricas tais como: Instalação de lâmpada simples com interruptor simples, Interruptor de duas seções entre outras práticas, a fim de aperfeiçoar os conhecimentos', 'F'),
('291012224903', 'Introdução à plataforma Arduino', 22, 22, 'Arduino é uma plataforma de computação física baseada em uma placa de entrada/saída microcontrolada e desenvolvida sobre a biblioteca Wiring- que simplifica a escrita da programação C/C++. Essa plataforma pode ser usada para desenvolver stand-alone ou conectadas ao computador através de Java, Python, C++, Delphi e outros. Conteúdo programático do curso: Conceitos básicos de eletricidade; Conceitos básicos da eletrônica; Plataforma Arduino; Sinais analógicos e digitais; Sensores e atuadores; comunicação geral', 'F'),
('291012225621', 'Inversores de frequencia e chaves Estáticas', 20, 20, 'Nao informado!', 'F'),
('291012225908', 'Medição por coordenadas em Máquina de medir por coordenadas', 15, 15, 'O objetivo do minicurso é demonstrar aos alunos o princípio de funcionamento da máquina e a exatidão das medidas pela máquina, tendo em vista que há mesma pouco é usada no IFCE Campus Cedro', 'F'),
('301012144831', 'Montagem e Manutenção de Computadores', 20, 20, 'Conceitos básicos necessários para montagem de um computador ( placa mãe, processador, memória RAM, etc;)Diagnósticos de defeitos e correção dos mesmos; Restauração de sistema operacional(Xp e Windows) e formatação', 'F'),
('301012145428', 'Negócios Digitais', 22, 22, 'Quanto mais alto o nível e quanto melhor a qualidade da informação, mais as pessoas compreendem o mundo que as cerca. Nesse contexto houve um aumento na utilização da internet como meio eficaz de “ganha dinheiro”. Assim o minicurso proporcionará uma Explanação sobre telecomunicação: avanços; internet: troca de informações transforma os negócios e as informações: visão melhor do mundo; viabilizar e aperfeiçoa o pensamento, estimulando a ingressa neste mundo de oportunidades', 'F'),
('301012150131', 'Introdução básica a Eletrônica Industrial e Osciloscópio', 10, 10, 'Introdução a montagem de circuitos eletrônicos e a utilização do osciloscópio para verificação de seu funcionamento', 'F'),
('301012150837', 'POO com Java', 20, 20, 'Nao informado!', 'F'),
('301012151346', 'Programação WEB', 18, 18, 'Esse minicurso visa especificar os requisitos para desenvolvimento de páginas web, com intuito de adquirir um olhar mais amplo frente às maravilhas que hoje em dia, a internet oferece, como também, conhecer as linguagens de programação atuais, entre outras metodologias', 'F'),
('301012152151', 'Rails', 20, 20, 'Nao informado!', 'F'),
('301012152806', 'Robótica Educacional', 22, 22, 'Este minicurso abordará software e Kit robótico que podem ser utilizados no ensino das disciplinas de ciências da natureza do ensino médio e fundamental', 'F'),
('301012154905', 'Simulação de Circuitos Usando o Proteus', 20, 20, 'Nao informado!', 'F'),
('301012160035', 'Soldagem de Eletrodo Revestido', 15, 15, 'Introdução à soldagem, segurança na soldagem, classificação da soldagem, soldagem eletrodo revestido, aulas práticas', 'F'),
('301012160354', 'Tornearia Mecânica - Turma I', 6, 6, 'O referido minicurso se presta ao ensino teórico- prático de um instrumento indispensável na mecânica – o torno mecânico. No final desse minicurso o aluno estará apto a desenvolver de forma didática o uso do torno', 'F'),
('301012160710', 'Tornearia Mecânica - Turma II', 6, 6, 'O referido minicurso se presta ao ensino teórico- prático de um instrumento indispensável na mecânica – o torno mecânico. No final desse minicurso o aluno estará apto a desenvolver de forma didática o uso do torno', 'F'),
('301012161005', 'Motores de Combustão Interna', 20, 20, 'Os motores de combustão interna são largamente utilizados na industria e em processos locomotrizes diversos. Esta oficina visa apontar os principais componentes de um motor de combustão interna e suas respectivas funções, conceituar o ciclo de trabalho do motor ciclo Otto e Diesel (2 tempos e 4 tempos), bem como argumentar seu processo de combustão. Oferecendo, desta forma os fundamentos necessários para a compreensão das anomalias que interferem no processo de combustão', 'F'),
('301012164023', 'Injeção Eletrônica', 20, 20, 'A injeção eletrônica é uma técnica que é largamente utilizada no acionamento de motores de combustão para melhorar seu rendimento e a utilização de combustível. Esta oficina tem o objetivo de conceituar as finalidades de um sistema de injeção eletrôncia apontando os principais sensores e atuadores do sistema com suas respectivas funções para que o participante tenha a compreenção das principais estratégias de controle de um sistema  com estas características', 'F'),
('301012180308', 'Algoritmo da Multiplicação: Será que existe outra forma de Multiplicar dois Números Naturais?', 30, 30, 'Para muitos discentes do curso de licenciatura em matemática, o algoritmo da multiplicação de números naturais é a única forma existente de multiplicar tais números. Alguns afirmam que o algoritmo ensinado nas escolas foi e sempre será a forma utilizada pelo homem para obter os resultados ao operar com a multiplicação. Compreendemos, então, que o conhecimento das técnicas de multiplicação utilizadas no passado, valoriza a matemática enquanto conhecimento social e proporciona ao aluno a comparação com o método tradicional, seja identificando diferenças e semelhanças, seja observando as vantagens e desvantagens de cada um dos dispositivos de calculo. O conhecimento de tais técnicas se dá através do uso da história da matemática em sala de aula, uma vez que tal metodologia é um campo de investigação das origens, descobertas, métodos e notações matemáticas desenvolvidas na antiguidade. O objetivo desta oficina é divulgar e investigar os processos de multiplicação das antigas civilizações. Tais processos podem ser utilizados pelos docentes como alternativa aos algoritmos tradicionais para alunos que tenham alguma dificuldade ou mesmo como motivação ou curiosidade para uma aula de matemática', 'M'),
('301012180912', 'Cálculo Variacional e a Equação De Euler-Lagrange', 30, 30, 'O cálculo variacional, a grosso modo, é uma espécie de cálculo diferencial, mas não de funções, e sim, de funcionais. Assim, enquanto o cálculo diferencial trata de calcular, por exemplo, os pontos máximos e mínimos de uma função, o cálculo variacional calcula os pontos máximos e mínimos(melhor dizendo, estacionários) de um dado funcional. O presente trabalho se preocupa em apresentar uma introdução sobre o cálculo variacional e em seguida deduzir a chamada equação de Euler para funcionais. No nosso caso, vamos tratar de funcionais definidos por uma integral de uma função definida no espaço de funções vetoriais que é bem comportada matematicamente. A motivação para isso é que a maioria dos funcionais de interesse físicos são funcionais desse tipo pelo fato de os mesmos representarem uma quantidade física que  chamamos de Ação. Nesse intuito Lagrange tentou dar um significado físico às equações de Euler, e com isso, deduziu as chamadas Equações de Euler-Lagrange, que é a base do formalismo Lagrangiano e Hamiltoniano da mecânica Clássica. Para chegar a tais equações usamos o princípio de Hamilton para a Ação de um sistema físico. Uma aplicação clássica de tais formalismos e da equação de Euler-Lagrange está na resolução do Problema da Braquistócrona (que será feita durante o curso)', 'M'),
('301012181429', 'Ciclo Trigonometrico', 30, 30, 'A palavra trigonometria tem origem grega e significa “medida de triângulos” sendoformada pelos radicais tri = três, gonos = ângulo, metron =medir.A trigonometria começou como uma Matemática prática, para determinardistâncias que não podiam ser medidas diretamente. Serviu à navegação, àagrimensura e à astronomia.Existe a trigonometria plana que lida com figuras geométricas pertencentes aum único plano, e a trigonometria esférica trata dos triângulos que são secções dasuperfície de uma esfera.Ao lidar com a determinação de pontos e distâncias em três dimensões, atrigonometria esférica ampliou sua aplicação à Física, à Química e a quase todos osramos da Engenharia, em especial no estudo de fenômenos periódicos como avibração do som e o fluxo de corrente alternada. Esta oficina visa então demosntrar a utilização do ciclo trigronométrico para soluções de problemas diversos', 'M'),
('301012181941', 'Contando e calculando: O aprendizado da matemática através de jogos', 30, 30, 'O uso de jogos educativos na metodologia de ensino da matemática auxilia o professor a complementar suas aulas, fazendo com que os alunos se interessem pelas mesmas, pois o jogo estimula o raciocínio lógico matemático, capacita o aluno na elaboração de novas estratégias de jogos e de resolução de problemas, ajuda no desenvolvimento da agilidade, e proporciona a ele uma forma divertida e prazerosa de aprender matemática', 'M'),
('301012190225', 'Descomplicando a matemática', 30, 30, 'A matemática sempre é conceituada como uma área de conhecimento complicada, repleta de detalhes e dificuldades que acabam por afastar o interesse das pessoas por ela. Esta oficina objetiva demonstrar através de práticas de raciocínio lógico rápido de aritmética e expressões matemáticas como é possível descomplicá-la e tornar este “tabu acadêmico” em um fácil objeto de aprendizado e utilização no dia a dia. Destinado especialmente para alunos do ensino fundamental e médio', 'M'),
('301012191201', 'Construindo os Poliedros de Platão com Materiais Reaproveitáveis', 30, 30, 'O objetivo desta oficina é construir através de canudos de refrigerantes e palitos para churrascos os sólidos geométricos - cubo, tetraedro, octaedro, dodecaedro e o icosaedro, e compreender suas propriedades e o significado das três dimensões: comprimento, largura e altura. A escolha do tema surgiu a partir da experiência enquanto professor da disciplina de geometria espacial e pela dificuldade  que os alunos tem de não absorver as idéias dos elementos geométricos. Vendo a possibilidade de confeccionar sólidos geométricos para o ensino dessa disciplina envolvendo material reciclável, podemos assim, tornar o ensino da geometria espacial mais prazeirosa', 'M'),
('301012191838', 'Introdução ao LaTeX', 30, 29, 'A primeira pergunta que alguém fará, ao se deparar com o LaTeX, é sobre a vantagem de usá-lo, ao invés de utilizar o microsoft Word. Quando se digita um texto matemático no Word, sente-se uma certa dificuldade de colocar alguns símbolos e equações matemáticas, já que este programa é bastante limitado nesse sentido. Se  as fórmulas e expressões matemáticas forem complexas não ficam escritas de forma elegante e às vezes nem é possível escrevê-las. Nesse sentido, para escrever textos científicos e matemáticos, o mais recomendado é a utilização do LATEX que possui algortimo avançado, permitindo criar documentos de aparencia verdadeiramente proffisionais e a edição de fórmulas matemática é robusta e sua apresentação visualmente agradável. Além disso, este programa encoraja as pessoas a concentrar suas atenções no conteúdo e na distribuição lógica das idéias, e não na aparência, resultando em textos bem estruturados. Nesse sentido existem muitas vantagens em se trabalhar com o LATEX na produção de textos matemáticos e científicos. Por outro lado, a aprendizagem é mais difícil que em programas comuns, pois embora a estrutura lógica do documento seja intuitiva, os comandos LATEX, não o são. Assim é importante para os principiantes uma orientação de como utilizar este programa', 'M'),
('301012192956', 'Jogos Matemáticos: Brincando se aprende Matemática', 30, 29, 'O objetivo desta oficina é refletir a relevância dos jogos no processo de ensino aprendizagem; analisar sua utilização como instrumentos didáticos; estimular a "capacitação" do atual e futuro professor na área de matemática e incentivar a aplicação dos conhecimentos construídos em futuras experiências de sala de aula. A escolha do tema se deu pelo fato de percebermos que alguns conteúdos matemáticos se tornam prazeirosos quando são trabalhados usando jogos e quebra-cabeças', 'M'),
('301012194426', 'Derivadas', 30, 30, 'Nao informado!', 'M'),
('301012194754', 'Temas e Problemas Elementares: Resolução e Discussão de Problemas', 30, 30, 'Nao informado!', 'M'),
('301012195237', 'Os Primórdios da Teoria Quântica', 30, 30, 'Durante o início do século XX alguns fenômenos físicos começaram a entrar em desacordo com a descrição prevista pela Teoria Clássica, então os físicos precisavam de uma nova formulação/teoria que explicasse esses fenômenos. Dessa necessidade de explicar fenômenos que não poderiam ser explicados pela Teoria Clássica, surge a ideia que revoluciona a nossa maneira de enxergar o mundo em escala microscópica: A Teoria Quântica.  Este minicurso tem como objetivo discutir dois dos  fenômenos mais  importantes que deram origem a Teoria Quântica, são: Radiação do Corpo Negro e o Efeito  Fotoelétrico. Esses fenômenos não poderiam ser descritos com precisão pela Teoria Clássica, até que Planck lançou uma proposta que serviu como base para a formação de uma nova teoria, tal ideia se fundamentava na quantização  na troca de energia entre sistemas microscópicos oscilantes. Assim, Planck conseguiu resolver o problema da radiação do corpo negro. E mais, partindo das ideias de Planck, Albert Einstein  formulou a sua Teoria Quântica, que explica os fenômenos apresentados pelo Efeito Fotoelétrico. Discutiremos também a proposta da Dualidade Onda-Partícula desenvolvida por Louis De Broglie e a sua importância na formulação matemática da Equação de Schrödinger para a Mecânica Quântica. Em últimos instantes mostraremos métodos de resolver a equação de Schrödinger (equação diferencial parcial de segunda ordem) para alguns casos particulares  que são de fácil compreensão matemática e física', 'M'),
('011112202321', 'Arquitetura e Plataformas de aplicações móveis Nativa e Hibridas, Web Mobile', 350, 350, 'Nao Informado!', 'P');

-- --------------------------------------------------------

--
-- Estrutura da tabela `minicursos_professores`
--

CREATE TABLE IF NOT EXISTS `minicursos_professores` (
  `cod_curso` varchar(12) NOT NULL,
  `email_professor` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_curso`,`email_professor`),
  KEY `fk_minicursos_has_professores_professores1_idx` (`email_professor`),
  KEY `fk_minicursos_has_professores_minicursos_idx` (`cod_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `minicursos_professores`
--

INSERT INTO `minicursos_professores` (`cod_curso`, `email_professor`) VALUES
('011112202321', 'iuryteixeira@secitif.com.br'),
('291012210517', 'vanierandrade@secitif.com.br'),
('291012211714', 'daniloalves@secitif.com.br'),
('291012212255', 'eltonbrasil@secitif.com.br'),
('291012212952', 'raimundobezerra@secitif.com.br'),
('291012214253', 'wironprocopio@secitif.com.br'),
('291012214708', 'ailton.ifce@gmail.com'),
('291012215915', 'derigalmeida@yahoo.com.br'),
('291012215915', 'ro.nildooliveira@hotmail.com'),
('291012221353', 'raeidechristina@secitif.com.br'),
('291012221353', 'williamsouza@secitif.com.br'),
('291012222044', 'jarbas.rocha@ifce.edu.br'),
('291012222500', 'josecarlosso@secitif.com.br'),
('291012222840', 'raimundobezerra@secitif.com.br'),
('291012223421', 'jorgehenrique@secitif.com.br'),
('291012223843', 'yrineufelipe@secitif.com.br'),
('291012224129', 'eltonbrasil@secitif.com.br'),
('291012224632', 'daniloalves@secitif.com.br'),
('291012224903', 'madsonluiz@secitif.com.br'),
('291012225621', 'joseneves@secitif.com.br'),
('291012225908', 'francildooliveira@secitif.com.br'),
('301012144831', 'franciscobatistaalves@secitif.com.br'),
('301012145428', 'josecarlosso@secitif.com.br'),
('301012150131', 'diandra.cat@hotmail.com'),
('301012150131', 'natalia.fracisca@secitif.com.br'),
('301012150131', 'williancaldas@secitif.com.br'),
('301012150837', 'iuryteixeira@secitif.com.br'),
('301012151346', 'antoniorodrigues@secitif.com.br'),
('301012152151', 'samuelrodrigues@secitif.com.br'),
('301012152806', 'renatateixeira@secitif.com.br'),
('301012152806', 'thiagopereira@secitif.com.br'),
('301012154905', 'pedrofelipe@secitif.com.br'),
('301012160035', 'antonioguedes@secitif.com.br'),
('301012160354', 'josesalesnilson@secitif.com.br'),
('301012160710', 'josesalesnilson@secitif.com.br'),
('301012161005', 'antonioventura@secitif.com.br'),
('301012164023', 'antonioventura@secitif.com.br'),
('301012180308', 'jeannedarc@secitif.com.br'),
('301012180912', 'alancosta@secitif.com.br'),
('301012181429', 'josenunesaquino@secitif.com.br'),
('301012181941', 'joseluciano@secitif.com.br'),
('301012190225', 'ciceroiran@secitif.com.br'),
('301012190225', 'sebastiaowesley@secitif.com.br'),
('301012191201', 'delioarruda@secitif.com.br'),
('301012191201', 'josefirmino@secitif.com.br'),
('301012191838', 'wanderlandia@secitif.com.br'),
('301012192956', 'andrepereira@secitif.com.br'),
('301012194426', 'gutemberg@secitif.com.br'),
('301012194754', 'alexdesouza@secitif.com.br'),
('301012194754', 'roneromarcio@secitif.com.br'),
('301012195237', 'alancosta@secitif.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `minicursos_usuarios`
--

CREATE TABLE IF NOT EXISTS `minicursos_usuarios` (
  `cod_curso` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_curso`,`email`),
  KEY `fk_minicursos_has_usuarios_usuarios1_idx` (`email`),
  KEY `fk_minicursos_has_usuarios_minicursos1_idx` (`cod_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `minicursos_usuarios`
--

INSERT INTO `minicursos_usuarios` (`cod_curso`, `email`) VALUES
('291012211714', 'demo@local'),
('291012212255', 'demo2@local'),
('291012212952', 'demo@local'),
('291012214253', 'demo@local'),
('291012214708', 'demo3@local'),
('291012215915', 'demo3@local'),
('291012223421', 'demo5@local'),
('291012223843', 'demo5@local'),
('301012191838', 'demo5@local'),
('301012192956', 'demo@local');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidade`
--

CREATE TABLE IF NOT EXISTS `modalidade` (
  `cod` int(11) NOT NULL,
  `nome_mod` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modalidade`
--

INSERT INTO `modalidade` (`cod`, `nome_mod`) VALUES
(1, 'Matematica'),
(2, 'Probabilidade e estatistica'),
(3, 'Ciencias da Computacao'),
(4, 'Fisica'),
(5, 'Quimica'),
(6, 'Biologia Geral'),
(7, 'Engenharia Mecanica'),
(8, 'Engenharia de Producao'),
(9, 'Engenharia Eletrica'),
(10, 'Engenharia Mecatronica'),
(11, 'Historia'),
(12, 'Geografia'),
(13, 'Educacao'),
(14, 'Linguistica'),
(15, 'Letras');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE IF NOT EXISTS `professores` (
  `email_professor` varchar(50) NOT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `minicv` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`email_professor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`email_professor`, `nome`, `minicv`) VALUES
('vanierandrade@secitif.com.br', 'Francisco Vanier Andrade', 'Prof. Msc. do IFCE Campus Cedro'),
('daniloalves@secitif.com.br', 'Danilo Alves de Lima', 'Aluno do IFCE Campus Cedro'),
('eltonbrasil@secitif.com.br', 'Elton Brasil da Costa', ''),
('raimundobezerra@secitif.com.br', 'Raimundo Bezerra da Silva Neto', ''),
('wironprocopio@secitif.com.br', 'Wiron Procópio', 'Prof. do IFCE Campus Cedro'),
('ailton.ifce@gmail.com', 'Demo José da Silva', 'Graduando no curso de Tecnologia em Mecatrônica Industrial. Web Developer com conhecimento das linguagens: XHTML, CSS, JavaScript, PHP, SQL, Ajax, jQuery, C++, ActionScript e Java. Desenvolvedor do site da 1ª SECITIF-Cedro'),
('derigalmeida@yahoo.com.br', 'Derig Almeida Vidal', 'Mestre em Computação Aplicada a Redes de Computadores (UECE/IFCE), engenheiro de Produção (URCA) e tecnólogo em Automática (CEFET-CE). Atualmente é professor em diversas instituições de ensino nas áreas de computação e eletrônica. Programa em diversas linguagens e plataformas, dentre elas, o Android'),
('ro.nildooliveira@hotmail.com', 'Ronildo Oliveira da Silva', 'Cursando o sétimo semestre do curso Integrado Informática IFCE Campus Cedro. Atuando no programa de monitoria de Programação Estruturada no IFCE Campus Cedro. Programador de aplicações móveis'),
('williamsouza@secitif.com.br', 'William Souza', 'Monitor do Projeto VITAE e Aluno do IFCE Campus Cedro'),
('raeidechristina@secitif.com.br', 'Raeide Christina', 'Monitor do Projeto VITAE e Aluno do IFCE Campus Cedro'),
('jarbas.rocha@ifce.edu.br', 'Jarbas Rocha Martins', 'Eng. de Produção Mecânica e Prof. do IFCE Campus Cedro'),
('josecarlosso@secitif.com.br', 'José Carlos Soares Ferreira', ''),
('jorgehenrique@secitif.com.br', 'Jorge Henrique', ''),
('yrineufelipe@secitif.com.br', 'Yrineu Felipe', 'Cursando Sistemas de Informação (FJN). Desenvolvedor Web na Nooclix. Professor de treinamentos Nooclix. Membro do CaJUG. Monitor de Projeto preparatório para Certificação de Programador Java'),
('madsonluiz@secitif.com.br', 'Madson Luiz Dantas', ''),
('joseneves@secitif.com.br', 'José Neves Cruz', 'Professor'),
('francildooliveira@secitif.com.br', 'Francildo Oliveira da Silva', 'Prof. do IFCE Campus Cedro'),
('franciscobatistaalves@secitif.com.br', 'Francisco Batista Alves Sobrinho', ''),
('diandra.cat@hotmail.com', 'Francisca Diandra de Almeida Bezerra', 'Aluna do IFCE Campus Cedro'),
('williancaldas@secitif.com.br', 'Willian Caldas', 'Aluno do IFCE Campus Cedro'),
('iuryteixeira@secitif.com.br', 'Yuri Teixeira', 'Cursando Mestrado em Engenharia de Software (C.E.S.A.R), Especialista em Desenvolvimento Web com a plataforma Java EE (FJN), Bacharel em Sistemas de Informação (FJN). Professor na Faculdade de Juazeiro do Norte. Proprietário da Nooclix - Fábrica de Software e Treinamentos. Certificações: SCJP6, CSM.'),
('antoniorodrigues@secitif.com.br', 'Antônio Rodrigues Xavier', 'Aluno do IFCE Campus Cedro'),
('samuelrodrigues@secitif.com.br', 'Samuel Rodrigues', 'Tecnólogo em Eletromecânica, Especialista em Engenharia de Software, Discente do Mestrado Profissional em Engenharia de Software. Professor da Faculdade de Juazeiro do Norte do curso de Sistemas de Informação e da Faculdade de Tecnologia CENTEC do Curso de Manutenção Industrial'),
('thiagopereira@secitif.com.br', 'Thiago Pereira', 'Prof. do IFCE Campus Cedro'),
('renatateixeira@secitif.com.br', 'Renata Teixeira', 'Prof. do IFCE Campus Cedro'),
('pedrofelipe@secitif.com.br', 'Pedro Felipe', ''),
('antonioguedes@secitif.com.br', 'Antônio Guedes', 'Prof. do IFCE Campus Cedro'),
('josesalesnilson@secitif.com.br', 'José Sales Nilson Moraes', 'Prof. do IFCE Campus Cedro'),
('antonioventura@secitif.com.br', 'Antônio Ventura', ''),
('jeannedarc@secitif.com.br', 'Jeanne Darc de oliveira Passos', 'Prof. Msc. UECE/FECLI'),
('alancosta@secitif.com.br', 'Alan Costa', 'Aluno da URCA'),
('josenunesaquino@secitif.com.br', 'José Nunes Aquino', 'Prof. do IFCE Campus Cedro'),
('joseluciano@secitif.com.br', 'José Luciano Cézar Candido', 'Prof. do IFCE Campus Juazeiro'),
('sebastiaowesley@secitif.com.br', 'Sebastião Wesley Freitas da Silva', 'Aluno do IFCE Campus Cedro'),
('ciceroiran@secitif.com.br', 'Cicero Iran Bezerra', 'Aluno do IFCE Campus Cedro'),
('delioarruda@secitif.com.br', 'Délio de Arruda Almeida', 'Aluno IFPB Campus Cajazeiras'),
('josefirmino@secitif.com.br', 'José Firmino de Melo Junior', 'Aluno IFPB Campus Cajazeiras'),
('wanderlandia@secitif.com.br', 'Maria Wanderlândia de Lavor Coriolano', 'Prof. Msc. do IFCE Campus Cedro'),
('andrepereira@secitif.com.br', 'André Pereira da Costa', 'Aluno IFPB Campus Cajazeiras'),
('gutemberg@secitif.com.br', 'Gutemberg', ''),
('alexdesouza@secitif.com.br', 'Alex de Souza Magalhães', 'Aluno do IF Sertão Pernambucano'),
('roneromarcio@secitif.com.br', 'Ronero Marcio Cordeiro Domingos', 'Aluno do IF Sertão Pernambucano'),
('almirpaixao@secitif.com.br', 'Almir', 'Prof. do IFCE Campus Cedro'),
('vilmar@secitif.com.br', 'Vilmar', 'Prof. Dsc. do IFCE Campus Juazeiro'),
('ric248@gmail.com', 'Ricardo Oliveira da Silva', 'Palestrante contratado pelo governo do estado do Ceará e está cursando, atualmente, o ensino médio na escola E.E.F.M Professora Maria Afonsina Diniz Macedo. Possui experiencia na área de competições olímpicas de matemática, física e português, tendo conquistados várias medalhas nessas competições ci'),
('natalia.fracisca@secitif.com.br', 'Natália Francisca dos Santo', 'Aluno do IFCE Campus Cedro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `semana`
--

CREATE TABLE IF NOT EXISTS `semana` (
  `cod_dia` int(11) NOT NULL,
  `nome_dia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cod_dia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `semana`
--

INSERT INTO `semana` (`cod_dia`, `nome_dia`) VALUES
(2, 'segunda-feira'),
(3, 'terca-feira'),
(4, 'quarta-feira'),
(5, 'quinta-feira'),
(6, 'sexta-feira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `email` varchar(35) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `sobrenome` varchar(25) NOT NULL,
  `endereco` varchar(35) NOT NULL,
  `bairro` varchar(35) NOT NULL,
  `cidade` varchar(35) NOT NULL,
  `uf` char(2) NOT NULL,
  `celular` char(11) NOT NULL,
  `telefone` char(11) NOT NULL,
  `d_nascimento` date NOT NULL,
  `d_inscricao` date NOT NULL,
  `ativo` char(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`email`, `senha`, `nome`, `sobrenome`, `endereco`, `bairro`, `cidade`, `uf`, `celular`, `telefone`, `d_nascimento`, `d_inscricao`, `ativo`) VALUES
('demo@local', 'demo', 'DEMO JOSÉ', 'DA SILVA', 'RUA IRISMAR, 100', 'CENTRO', 'ICO', 'CE', '09999999991', '', '1990-01-01', '2012-10-28', 'T'),
('demo3@local', 'demo', 'HERMESSON DOUGLAS', 'MOTA', 'RUA GERALDO, 67', 'CENTRO', 'ICO', 'CE', '77777777777', '', '1992-10-25', '2012-10-28', 'T'),
('demo2@local', 'demo', 'ICARO', 'ALVES', 'RUA F, 34', 'NOVO CENTRO', 'ICO', 'CE', '55555555555', '', '1991-01-01', '2012-10-28', 'T'),
('demo6@local', 'demo', 'JONAS', 'ALVES VIANA', 'RUA B, 56', 'CONJ GAMA', 'ICO', 'CE', '88888888888', '', '1990-03-09', '2012-10-28', 'T'),
('demo5@local', 'demo', 'OZIEL', 'BATISTA LIMA', 'RUA LARGO TEBEGE, 562', 'CENTRO', 'ICO', 'CE', '00000000000', '', '1993-05-06', '2012-10-28', 'T'),
('demo4@local', 'demo', 'PAULIVAN', 'DOCARMO', 'RUA GERALDO, 34', 'CENTRO', 'ICO', 'CE', '09999999999', '', '1991-10-10', '2012-10-28', 'F');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_pagos`
--

CREATE TABLE IF NOT EXISTS `usuarios_pagos` (
  `email` varchar(50) NOT NULL,
  `liberador` varchar(50) NOT NULL,
  `p_acesso` char(1) NOT NULL,
  `data_lib` datetime NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_pagos`
--

INSERT INTO `usuarios_pagos` (`email`, `liberador`, `p_acesso`, `data_lib`) VALUES
('demo@local', 'demo@local', 'F', '2012-12-05 00:00:00'),
('demo5@local', 'demo@local', 'T', '2012-12-29 04:29:29'),
('demo3@local', 'demo@local', 'F', '2012-12-29 04:16:46'),
('demo2@local', 'demo@local', 'T', '2012-12-29 04:20:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_pagos_admin`
--

CREATE TABLE IF NOT EXISTS `usuarios_pagos_admin` (
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_pagos_admin`
--

INSERT INTO `usuarios_pagos_admin` (`email`) VALUES
('demo@local'),
('demo2@local');

-- --------------------------------------------------------

--
-- Estrutura para visualizar `hora_curso`
--
DROP TABLE IF EXISTS `hora_curso`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `hora_curso` AS select `datas`.`dia` AS `dia`,`datas`.`hora_inicio` AS `hora_inicio`,`datas`.`hora_fim` AS `hora_fim`,`datas`.`cod_curso` AS `cod_curso` from `datas` where (`datas`.`cod_curso` = '301012191838');

-- --------------------------------------------------------

--
-- Estrutura para visualizar `hora_user`
--
DROP TABLE IF EXISTS `hora_user`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `hora_user` AS select `datas`.`dia` AS `dia`,`datas`.`hora_inicio` AS `hora_inicio`,`datas`.`hora_fim` AS `hora_fim`,`datas`.`cod_curso` AS `cod_curso` from (`minicursos_usuarios` join `datas`) where ((`datas`.`cod_curso` = `minicursos_usuarios`.`cod_curso`) and (`minicursos_usuarios`.`email` = 'demo5@local'));

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `artigos`
--
ALTER TABLE `artigos`
  ADD CONSTRAINT `fk_cod` FOREIGN KEY (`cod_mod`) REFERENCES `modalidade` (`cod`),
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`);

--
-- Restrições para a tabela `autores`
--
ALTER TABLE `autores`
  ADD CONSTRAINT `fk_url` FOREIGN KEY (`cod_artigo`) REFERENCES `artigos` (`nomeurl`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

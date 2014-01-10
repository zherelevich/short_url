-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 10 2014 г., 11:50
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cutter`
--

-- --------------------------------------------------------

--
-- Структура таблицы `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(11) DEFAULT NULL,
  `original` text NOT NULL,
  `short` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `link`
--

INSERT INTO `link` (`id`, `original`, `short`) VALUES
(NULL, 'http://www.andrey-vasiliev.com/php/prakticheskaya-realizaciya-patterna-singleton-na-php/', 'Nmp3pS'),
(NULL, 'http://www.andrey-vasiliev.com/php/prakticheskaya-realizaciya-patterna-singleton-na-php/', 'MRaTBZ'),
(NULL, 'http://www.andrey-vasiliev.com/php/prakticheskaya-realizaciya-patterna-singleton-na-php/', 'tAruQe'),
(NULL, 'http://www.andrey-vasiliev.com/php/prakticheskaya-realizaciya-patterna-singleton-na-php/', 'pWMIcT'),
(NULL, 'http://ru.wikipedia.org/wiki/Английский_алфавит', 'aRU3ZX'),
(NULL, 'http://php.net/manual/ru/function.header.php', 'b2fppO'),
(NULL, 'http://php.net/manual/ru/function.header.php/', '717eDQ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

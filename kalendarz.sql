-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Mar 2019, 14:43
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kalendarz`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_date_dimension` (IN `startdate` DATE, IN `stopdate` DATE)  BEGIN
    DECLARE currentdate DATE;
    SET currentdate = startdate;
    WHILE currentdate < stopdate DO
        INSERT INTO time_dimension VALUES (
                        YEAR(currentdate)*10000+MONTH(currentdate)*100 + DAY(currentdate),
                        currentdate,
                        YEAR(currentdate),
                        MONTH(currentdate),
                        DAY(currentdate),
                        QUARTER(currentdate),
                        WEEKOFYEAR(currentdate),
                        DATE_FORMAT(currentdate,'%W'),
                        DATE_FORMAT(currentdate,'%M'),
                        'f',
                        CASE DAYOFWEEK(currentdate) WHEN 1 THEN 't' WHEN 7 then 't' ELSE 'f' END,
                        NULL);
        SET currentdate = ADDDATE(currentdate,INTERVAL 1 DAY);
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `daty`
--

CREATE TABLE `daty` (
  `id` int(255) NOT NULL,
  `id_wydarzenia` int(255) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `daty`
--

INSERT INTO `daty` (`id`, `id_wydarzenia`, `data`) VALUES
(1, 1, '2019-03-01'),
(2, 1, '2019-03-02'),
(3, 1, '2019-03-03'),
(4, 1, '2019-03-04'),
(5, 1, '2019-03-05'),
(6, 1, '2019-03-06'),
(7, 1, '2019-03-07'),
(8, 1, '2019-03-08'),
(9, 1, '2019-03-09'),
(10, 1, '2019-03-10'),
(11, 1, '2019-03-11'),
(12, 1, '2019-03-12'),
(13, 1, '2019-03-13'),
(14, 1, '2019-03-14'),
(15, 1, '2019-03-15'),
(16, 1, '2019-03-16'),
(17, 1, '2019-03-17'),
(18, 1, '2019-03-18'),
(19, 1, '2019-03-19'),
(20, 1, '2019-03-20'),
(21, 1, '2019-03-21'),
(22, 1, '2019-03-22'),
(23, 1, '2019-03-23'),
(24, 1, '2019-03-24'),
(25, 1, '2019-03-25'),
(26, 1, '2019-03-26'),
(27, 1, '2019-03-27'),
(28, 1, '2019-03-28'),
(29, 1, '2019-03-29'),
(30, 1, '2019-03-30'),
(31, 1, '2019-03-31'),
(32, 1, '0000-00-00'),
(33, 2, '2019-03-15'),
(34, 2, '2019-03-16'),
(35, 2, '2019-03-17'),
(36, 2, '2019-03-30'),
(37, 2, '2019-03-31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydarzenia`
--

CREATE TABLE `wydarzenia` (
  `id` int(255) NOT NULL,
  `nazwa_wydarzenia` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `data_rozpoczecia` date NOT NULL,
  `data_zakonczenia` date NOT NULL,
  `daty_dodatkowe` mediumtext COLLATE utf8_polish_ci NOT NULL,
  `daty_przerw` mediumtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wydarzenia`
--

INSERT INTO `wydarzenia` (`id`, `nazwa_wydarzenia`, `data_rozpoczecia`, `data_zakonczenia`, `daty_dodatkowe`, `daty_przerw`) VALUES
(1, 'Nowy event', '2019-03-01', '2019-03-31', '', ''),
(2, 'Drugi event', '2019-03-15', '2019-03-17', '2019-03-30, 2019-03-31', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `daty`
--
ALTER TABLE `daty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `daty`
--
ALTER TABLE `daty`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

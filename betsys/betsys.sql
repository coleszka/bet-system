-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Lut 2017, 13:53
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `betsys`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bets`
--

CREATE TABLE `bets` (
  `id` int(11) NOT NULL,
  `sport` text COLLATE utf8_polish_ci NOT NULL,
  `player1` text COLLATE utf8_polish_ci NOT NULL,
  `player2` text COLLATE utf8_polish_ci NOT NULL,
  `start_time` time NOT NULL,
  `date` date NOT NULL,
  `odd_1` text COLLATE utf8_polish_ci NOT NULL,
  `odd_x` double NOT NULL,
  `odd_2` double NOT NULL,
  `result` char(1) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `bets`
--

INSERT INTO `bets` (`id`, `sport`, `player1`, `player2`, `start_time`, `date`, `odd_1`, `odd_x`, `odd_2`, `result`) VALUES
(1, 'Piłka Nożna', 'Legia Warszawa', 'Korona Kielce', '20:00:00', '2016-12-15', '1.22', 3.4, 8.66, '1'),
(2, 'Piłka Nożna', 'Real Madryt', 'FC Barcelona', '16:00:00', '2016-12-15', '2.2', 3.6, 1.9, '1'),
(3, 'Piłka Nożna', 'Arsenal Londyn', 'Chelsea Londyn', '19:00:00', '2016-12-15', '1.88', 2.6, 3.2, '2'),
(4, 'Piłka Nożna', 'Celtic Glasgow', 'Liverpool CF', '15:30:00', '2016-12-15', '5.61', 3.88, 1.54, '1'),
(5, 'Piłka Nożna', 'Manchester United', 'West Ham United', '12:15:00', '2016-12-15', '1.6', 2.94, 5.6, '2'),
(6, 'Piłka Nożna', 'Real Madryt', 'FC Barcelona', '16:00:00', '2016-12-18', '2.2', 3.6, 1.9, '2'),
(7, 'asdf', 'asdq', 'sdaq', '12:00:00', '1980-01-01', '2', 2, 2, '1'),
(8, '1234', 'asdq', 'asdz', '12:00:00', '1980-01-01', '2', 3, 4, '2'),
(9, 'asdasd', 'asdasd', 'asdasd', '12:00:00', '1980-01-01', '2', 4, 5, '1'),
(10, 'asd', 'asdasd', 'asdasd', '12:00:00', '1980-01-01', '2', 3, 4, 'x'),
(11, 'asd', 'asd', 'asd', '12:00:00', '1980-01-01', '2', 3, 4, '1'),
(12, 'asd', 'asd', 'asd', '12:00:00', '1980-01-01', '2', 3, 4, 'x'),
(13, 'asdad', 'asdasd', 'asdasd', '12:00:00', '1980-01-01', '2', 3, 4, '2'),
(14, 'asd', 'asd', 'asd', '12:00:00', '1980-01-01', '2', 2, 2, 'x'),
(2425, 'Piłka Nożna', 'Manchester United', 'West Ham United', '12:15:00', '2016-12-15', '1.6', 2.94, 5.6, ''),
(2426, 'PiÅ‚ka noÅ¼na', 'Korona Kielce', 'Arka Gdynia', '17:30:00', '0000-00-00', '2.3', 3.3, 1.9, ''),
(2427, 'Hokej', 'Dodgers Radom', 'Scyzoryki Kielce', '14:00:00', '2017-02-14', '1.5', 2.5, 4.1, ''),
(2428, 'Pilka reczna', 'THW Kiel', 'Vive Kielce', '19:00:00', '2017-03-01', '2.2', 5.1, 2.5, ''),
(2429, 'testDyscyplina', 'testGospodarz', 'testGosc', '12:00:00', '1980-01-01', '1.01', 2.01, 3.01, 'x');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id_koszyk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bet` int(11) NOT NULL,
  `1x2` text COLLATE utf8_polish_ci NOT NULL,
  `numer_kupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id_koszyk`, `id_user`, `id_bet`, `1x2`, `numer_kupon`) VALUES
(1, 1, 2425, '1', 94559),
(2, 1, 3, '1', 94559),
(3, 1, 1, '2', 94559),
(4, 1, 2, 'x', 94559),
(5, 1, 3, '1', 94559),
(6, 1, 4, 'x', 94559),
(7, 1, 5, '2', 94559),
(8, 1, 2425, 'x', 94559),
(9, 1, 2425, 'x', 94559),
(10, 1, 2425, 'x', 94559),
(11, 1, 2425, 'x', 94559),
(12, 1, 2425, 'x', 94559),
(13, 1, 2425, 'x', 94559),
(14, 1, 1, '1', 94559),
(15, 1, 1, 'x', 94559),
(16, 1, 1, '2', 94559),
(17, 1, 3, 'x', 94559),
(18, 1, 1, 'x', 94559),
(19, 1, 1, 'x', 94559),
(20, 1, 2, 'x', 9827),
(21, 1, 3, '2', 9827),
(22, 1, 5, 'x', 9827),
(23, 1, 2, '1', 27530),
(24, 1, 2, 'x', 27530),
(25, 1, 2, 'x', 27530),
(26, 1, 2, 'x', 27530),
(27, 1, 2, 'x', 27530),
(28, 1, 4, 'x', 27530),
(29, 1, 4, 'x', 27530),
(30, 1, 2425, '2', 27530),
(31, 1, 2425, '2', 27530),
(32, 1, 2425, '2', 27530),
(33, 1, 2425, '2', 27530),
(34, 1, 2425, '2', 27530),
(35, 1, 2425, '2', 27530),
(36, 1, 2425, '2', 27530),
(37, 1, 2425, '2', 27530),
(38, 1, 2425, '2', 27530),
(39, 1, 2425, '2', 27530),
(40, 1, 2425, '2', 27530),
(41, 1, 2425, '2', 27530),
(42, 1, 2425, '2', 27530),
(43, 1, 2425, '2', 27530),
(44, 1, 2425, '2', 27530),
(45, 1, 2425, '2', 27530),
(46, 1, 2425, '2', 27530),
(47, 1, 2425, '2', 27530),
(48, 1, 2425, '2', 27530),
(49, 1, 2425, '2', 27530),
(50, 1, 2425, '2', 27530),
(51, 1, 2425, '2', 27530),
(52, 1, 2425, '2', 27530),
(53, 1, 2425, '2', 27530),
(54, 1, 2425, '2', 27530),
(55, 1, 2425, '2', 27530),
(56, 1, 2425, '2', 27530),
(57, 1, 2425, '2', 27530),
(58, 1, 2425, '2', 27530),
(59, 1, 2425, '2', 27530),
(60, 1, 2425, '2', 27530),
(61, 1, 2425, '2', 27530),
(62, 1, 2425, '2', 27530),
(63, 1, 2425, '2', 27530),
(64, 1, 2425, '2', 27530),
(65, 1, 2425, '2', 27530),
(66, 1, 2425, '2', 27530),
(67, 1, 2425, '2', 27530),
(77, 1, 3, '2', 94800),
(84, 1, 2, '2', 94800),
(87, 1, 2, '2', 34873),
(88, 1, 3, '2', 34873),
(94, 1, 4, 'x', 18082),
(95, 1, 6, 'x', 18082),
(96, 1, 2, '1', 81028),
(97, 1, 2, '2', 21204),
(98, 1, 2, '2', 42618),
(99, 1, 3, '2', 95780),
(100, 1, 3, '2', 1069),
(101, 1, 4, '2', 1069),
(102, 1, 2, '2', 1069),
(103, 1, 5, '2', 56504),
(104, 1, 6, '2', 56504),
(105, 1, 1, '2', 10807),
(106, 1, 2, '2', 10807),
(107, 1, 2, 'x', 78794),
(108, 1, 3, '2', 78794),
(109, 1, 3, '2', 71460),
(110, 1, 4, '2', 71460),
(111, 1, 3, '2', 66828),
(112, 1, 4, '2', 66828),
(113, 1, 4, '1', 31235),
(114, 1, 5, '1', 31235),
(115, 1, 3, '2', 37574),
(116, 1, 1, '2', 39310),
(117, 1, 1, '2', 39310),
(118, 1, 3, '2', 39310),
(124, 1, 6, '2', 73505),
(125, 1, 6, '2', 73505),
(126, 1, 4, '1', 73505),
(127, 1, 3, '2', 95658),
(128, 1, 2, '1', 56907),
(129, 1, 4, '1', 42005),
(130, 1, 3, 'x', 58368),
(131, 1, 3, 'x', 58368),
(132, 1, 1, '2', 43079),
(133, 1, 3, '2', 43079),
(134, 1, 4, '2', 43079),
(135, 1, 1, '1', 72077),
(136, 1, 1, '2', 15879),
(137, 1, 1, 'x', 9284),
(138, 1, 1, '1', 21445),
(139, 1, 2, '2', 70731),
(140, 1, 1, '2', 70731),
(141, 1, 2, '1', 82959),
(142, 1, 1, '1', 95746),
(143, 1, 1, '2', 27097),
(144, 1, 1, '2', 39219),
(145, 1, 1, '2', 3266),
(146, 1, 1, 'x', 94813),
(147, 1, 1, '1', 78434),
(148, 1, 1, '2', 20264),
(149, 1, 1, '2', 20264),
(150, 1, 4, '2', 20264),
(151, 1, 4, '1', 71415),
(152, 1, 6, '1', 20258),
(153, 1, 1, '1', 20258),
(154, 1, 4, '2', 20258),
(155, 1, 1, '1', 48874),
(156, 1, 1, 'x', 78992),
(157, 1, 2, '2', 54020),
(158, 1, 1, '2', 54020),
(159, 1, 1, '2', 54020),
(160, 1, 1, '2', 54020),
(161, 1, 4, '2', 54020),
(162, 1, 1, '2', 63547),
(163, 1, 1, '2', 65833),
(164, 1, 2, '2', 65833),
(165, 1, 3, '2', 65833),
(166, 1, 1, '2', 41584),
(167, 1, 2, '2', 4624),
(168, 1, 1, '2', 76468),
(169, 1, 2, '2', 76468),
(170, 1, 3, '2', 1969),
(171, 1, 4, '2', 1969),
(172, 1, 4, '2', 56916),
(173, 1, 5, 'x', 56916),
(174, 1, 6, '1', 56916),
(175, 1, 5, '2', 25815),
(176, 1, 6, 'x', 25815),
(177, 1, 5, '1', 25815),
(178, 1, 2425, 'x', 19257),
(179, 1, 1, '1', 19257),
(180, 1, 1, '1', 52268),
(181, 1, 3, 'x', 60468),
(182, 1, 4, '1', 60468),
(183, 1, 4, '1', 38538),
(184, 1, 6, 'x', 38538),
(185, 1, 2425, '1', 38538),
(186, 1, 1, '1', 18714),
(187, 1, 2, '1', 18714),
(188, 1, 3, '1', 18714),
(189, 1, 1, '1', 97843),
(190, 1, 2, '1', 97843),
(191, 1, 3, '1', 97843),
(192, 1, 4, '1', 97843),
(193, 1, 3, '2', 19684),
(194, 1, 4, '2', 19684),
(195, 1, 5, '2', 19684),
(196, 1, 1, '1', 30088),
(197, 1, 2, '1', 30088),
(198, 1, 3, '1', 30088),
(199, 1, 1, '1', 1),
(200, 1, 2, '1', 1),
(201, 1, 3, '1', 1),
(202, 1, 1, '1', 17573),
(203, 1, 2, '1', 17573),
(204, 1, 3, '1', 17573),
(205, 1, 1, '1', 31150),
(206, 1, 2, '1', 31150),
(207, 1, 3, '1', 31150),
(208, 1, 1, '1', 17936),
(209, 1, 2, '1', 17936),
(210, 1, 3, '1', 17936),
(211, 1, 1, '1', 22297),
(212, 1, 2, '1', 22297),
(213, 1, 3, '1', 22297),
(214, 1, 1, '1', 77329),
(215, 1, 2, '1', 77329),
(216, 1, 3, '1', 77329),
(217, 1, 1, '1', 61792),
(218, 1, 2, '1', 61792),
(219, 1, 3, '1', 61792),
(220, 1, 1, '1', 35502),
(221, 1, 2, '1', 35502),
(222, 1, 3, '1', 35502),
(223, 1, 1, '1', 93232),
(224, 1, 2, '1', 93232),
(225, 1, 3, '1', 93232),
(226, 1, 1, '2', 40500),
(227, 1, 1, '2', 40500),
(228, 1, 2, '2', 40500),
(229, 1, 1, '1', 53724),
(230, 1, 2, '1', 53724),
(231, 1, 3, '1', 53724),
(232, 1, 1, '1', 37247),
(233, 1, 2, '1', 37247),
(234, 1, 3, '1', 37247),
(235, 1, 1, '1', 39753),
(236, 1, 2, '1', 39753),
(237, 1, 3, '1', 39753),
(238, 1, 1, '1', 42539),
(239, 1, 2, '1', 42539),
(240, 1, 3, '1', 42539),
(241, 1, 1, '1', 82178),
(242, 1, 2, '1', 82178),
(243, 1, 3, '1', 82178),
(244, 1, 1, '1', 36469),
(245, 1, 2, '1', 36469),
(246, 1, 3, '1', 36469),
(247, 1, 1, 'x', 81141),
(248, 1, 3, 'x', 81141),
(249, 1, 5, 'x', 81141),
(250, 1, 1, '2', 6037),
(251, 1, 2, '2', 6037),
(252, 1, 4, '2', 6037),
(253, 1, 1, '1', 79316),
(254, 1, 2, '1', 79316),
(255, 1, 4, '1', 79316),
(256, 1, 6, '1', 79316);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postawione_kupony`
--

CREATE TABLE `postawione_kupony` (
  `id_postawione_kupony` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `numer_kuponu` int(11) NOT NULL,
  `kurs` double NOT NULL,
  `stawka` double NOT NULL,
  `wygrana` double NOT NULL,
  `wynik` text COLLATE utf8_polish_ci NOT NULL,
  `data_dodania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `postawione_kupony`
--

INSERT INTO `postawione_kupony` (`id_postawione_kupony`, `id_user`, `numer_kuponu`, `kurs`, `stawka`, `wygrana`, `wynik`, `data_dodania`) VALUES
(114, 1, 70267, 1.22, 3, 5003.66, 'W', '0000-00-00'),
(115, 1, 28263, 3.4, 3, 10.2, 'L', '0000-00-00'),
(116, 1, 33884, 5.61, 4, 5022.44, 'W', '0000-00-00'),
(117, 1, 72031, 1.22, 3, 3.66, 'L', '0000-00-00'),
(118, 1, 95307, 3.4, 4, 13.6, '0', '2017-02-07'),
(119, 1, 61329, 1.9, 1000, 1900, '0', '2017-02-13'),
(120, 1, 93885, 8.66, 666, 5767.56, '0', '2017-02-18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postawione_zaklady`
--

CREATE TABLE `postawione_zaklady` (
  `id_postawione_zaklady` int(11) NOT NULL,
  `numer_kuponu` int(11) NOT NULL,
  `id_bets` int(11) NOT NULL,
  `1x2` text COLLATE utf8_polish_ci NOT NULL,
  `pz_result` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `postawione_zaklady`
--

INSERT INTO `postawione_zaklady` (`id_postawione_zaklady`, `numer_kuponu`, `id_bets`, `1x2`, `pz_result`) VALUES
(10, 70267, 1, '1', 'W'),
(11, 70267, 2, '1', 'W'),
(14, 70267, 5, '2', 'W'),
(15, 70267, 6, '2', 'W'),
(16, 28263, 1, 'x', 'L'),
(17, 28263, 2, '1', 'W'),
(18, 28263, 3, '2', 'W'),
(19, 33884, 4, '1', 'W'),
(20, 72031, 1, '1', 'W'),
(21, 72031, 4, 'x', 'L'),
(22, 95307, 1, 'x', ''),
(23, 95307, 3, '2', ''),
(24, 61329, 2, '2', ''),
(25, 93885, 1, '2', ''),
(26, 93885, 2, '2', ''),
(27, 93885, 4, 'x', ''),
(28, 93885, 4, 'x', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `points` double NOT NULL,
  `perm` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `points`, `perm`) VALUES
(1, 'adam', '$2y$10$P/Zp.dZ79sD6osGnySDn3upkLOxtaMFELZ/jQAPQVYG9D226r4NVm', 'adam@gmail.com', 30093.42, 0),
(2, 'marek', 'asdfg', 'marek@gmail.com', 10022.44, 0),
(3, 'anna', 'zxcvb', 'anna@gmail.com', 10022.44, 0),
(4, 'andrzej', 'asdfg', 'andrzej@gmail.com', 10022.44, 0),
(5, 'justyna', 'yuiop', 'justyna@gmail.com', 10022.44, 0),
(6, 'kasia', 'hjkkl', 'kasia@gmail.com', 10022.44, 0),
(7, 'beata', 'fgthj', 'beata@gmail.com', 10022.44, 0),
(8, 'jakub', 'ertyu', 'jakub@gmail.com', 10322.44, 0),
(9, 'janusz', 'cvbnm', 'janusz@gmail.com', 1022.44, 0),
(10, 'roman', 'dfghj', 'roman@gmail.com', 10022.44, 0),
(11, 'test1', '$2y$10$.RzwEq44pOz5xx4N1v2p2uXzPQtNACyNbMvMz6AcxufVItnh6IFwq', 'test1@gmail.com', 22.44, 0),
(12, 'test2', '$2y$10$ecyYo0CpMNkd9DwbxX.nh.ixyBvR6IClQyH2kFEzLvx3rbshO1Thm', 'tesst2@ga.pl', 12022.44, 0),
(13, 'test3', '$2y$10$euD0meFCio/7SdP4iX3yZ.R5Ki0u0kUUcf1a2sRQNXBcSy7kxIw4K', 'test@ga.pl', 10022.44, 0),
(14, 'admin', '$2y$10$RNunjzEdoL.bQ0fCWQBTy.AY7nlKhH6tYPK/98ZnZglJCSM1vxJMG', 'admin@admin.pl', 10022.44, 1),
(15, 'SzymonBielecki', '$2y$10$veiotSWt80si7v9NkmSuZu1vCjfOvMtPMThbKz9uWY28XTMuC6CRW', 'szymon@szymon.pl', 5000, 0),
(16, 'testbielecki', '$2y$10$XohUEEEmz68IIEXclqtMJOg5dgMiM3ZPA0eKedQLb30aJv9R4NK4u', 'testbielecki@test.pl', 5000, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id_koszyk`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_bet` (`id_bet`);

--
-- Indexes for table `postawione_kupony`
--
ALTER TABLE `postawione_kupony`
  ADD PRIMARY KEY (`id_postawione_kupony`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `postawione_zaklady`
--
ALTER TABLE `postawione_zaklady`
  ADD PRIMARY KEY (`id_postawione_zaklady`),
  ADD KEY `id_bets` (`id_bets`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2430;
--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id_koszyk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT dla tabeli `postawione_kupony`
--
ALTER TABLE `postawione_kupony`
  MODIFY `id_postawione_kupony` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT dla tabeli `postawione_zaklady`
--
ALTER TABLE `postawione_zaklady`
  MODIFY `id_postawione_zaklady` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

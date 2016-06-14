-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Cze 2016, 15:53
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `farmaceuta`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `stan` varchar(255) NOT NULL,
  `marka` varchar(255) NOT NULL,
  `promo_date` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `subject`, `description`, `thumb`, `stan`, `marka`, `promo_date`, `price`) VALUES
(39, 12, 'Apteka pod temidą', 'Apteka pod temidą Apteka pod temidą Apteka pod temidą', 'apteka.png', 'Nowy', 'Warszawa', '', '200'),
(40, 12, 'Super Apteka', 'Apteka bardzo super', '808ae536744fa948aae5081c92e58f50_big.jpg', 'Używany', 'Poznań', '4102444800', '300');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ads_cats`
--

CREATE TABLE `ads_cats` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ads_cats`
--

INSERT INTO `ads_cats` (`id`, `ad_id`, `cat_id`) VALUES
(25, 32, 6),
(26, 33, 6),
(28, 35, 13),
(29, 36, 14),
(30, 37, 14),
(31, 38, 13),
(32, 39, 19),
(33, 40, 19);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ad_categories`
--

CREATE TABLE `ad_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ad_categories`
--

INSERT INTO `ad_categories` (`id`, `name`, `alias`, `parent_id`) VALUES
(6, 'Ogólnodostępne', 'ogolnodostepne', 2),
(7, 'Szpitalne', 'szpitalne', 2),
(17, 'Zakładowe', 'zakladowe', 2),
(18, 'Wszystkie ogłoszenia', 'wszystkie-ogloszenia', 0),
(19, 'Apteki zakładowe', 'apteki-zakladowe', 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `name`, `alias`) VALUES
(1, 'Admin', 'admin'),
(2, 'User', 'user'),
(3, 'Moderator', 'moderator'),
(4, 'Aptekarz', 'aptekarz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `remember_code` varchar(255) NOT NULL,
  `reset_password_code` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_time`, `activation_code`, `active`, `remember_code`, `reset_password_code`, `address`, `zip_code`, `city`, `country`, `phone`) VALUES
(12, 'Admin', 'admin@admin.pl', '$2y$10$C0YSMCNo4zDyuTUj.OQ9A.5AsU5SGNcdgmGc.wrRTChTBawPbPhlC', '1420923434', '4be49a4fa2d9c58c746e8fc1092ab292', 1, 'f61bec37fc805163049d4b7f2a30c5d6', '', 'Nowy adres 1/2', '00-000', 'Miasto', 'Polska', '123456789'),
(13, 'Arkadiusz', 'kotecki.arkadiusz@gmail.com', '$2y$10$7vDMFvRZ4u3n7A6kB86qge3kFediiuBtdd4Uv6/3Y20Ec3XqAtu1C', '1464774056', '500b94f5b9ba9b7e366a1c8bc8a9fe0d', 1, '', '', '', '', '', '', '51155'),
(14, 'Mikołaj', 'kontakt@grafik.turek.pl', '$2y$10$0VIIPJqTTzCSnoXfpRgsX.dfizH7skcwjetYlmMXPAsba8AnVWrNq', '1464781687', 'b49c150f1fd6cf2ac31147b9b42138b6', 0, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(14, 12, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads_cats`
--
ALTER TABLE `ads_cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_categories`
--
ALTER TABLE `ad_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT dla tabeli `ads_cats`
--
ALTER TABLE `ads_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT dla tabeli `ad_categories`
--
ALTER TABLE `ad_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

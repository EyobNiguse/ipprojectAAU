-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2021 at 08:38 AM
-- Server version: 8.0.20
-- PHP Version: 7.3.15-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musika`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Email`, `Password`) VALUES
('EyobNiguse@gmail.com', '$2y$10$ghAnRTjQTzprvh8q0N2ee.NkdBd5345HQhxyHD3b/ZsgfaaWm/B1G');

-- --------------------------------------------------------

--
-- Table structure for table `Albums`
--

CREATE TABLE `Albums` (
  `CoverArt` varchar(255) DEFAULT NULL,
  `SongsId` longtext,
  `Name` varchar(255) NOT NULL,
  `Artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Albums`
--

INSERT INTO `Albums` (`CoverArt`, `SongsId`, `Name`, `Artist`) VALUES
('-2147483648_-217521.jpg', ',34,35,36,37', 'Eyob', 'Eyob Niguse');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `Email` varchar(255) DEFAULT NULL,
  `Name` varchar(255) NOT NULL,
  `Id` int NOT NULL,
  `SongsId` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`Email`, `Name`, `Id`, `SongsId`) VALUES
('bellacs@gmail.com', 'nn', 28, NULL),
('bellacs@gmail.com', 'Coding', 29, ',37,34,36'),
('bellacs@gmail.com', 'mubarek', 30, ',35');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `Id` int NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`Id`, `Title`, `Location`, `Artist`) VALUES
(33, 'ፍርሓት_ከሞት_በላይ_የቁም_ስቃይ_ነው_WGY_podcast', 'Songs/ፍርሓት_ከሞት_በላይ_የቁም_ስቃይ_ነው_WGY_podcast.mp3', 'Eyob Niguse'),
(34, 'ዶ_ር_ደረጄ_ከበደ_ሰላም_አለኝ_Dereje_kebede_with_Lyrics', 'Songs/ዶ_ር_ደረጄ_ከበደ_ሰላም_አለኝ_Dereje_kebede_with_Lyrics.m4a', 'Eyob Niguse'),
(35, 'የጨረቃው ልጅ (Prod', 'Songs/የጨረቃው ልጅ (Prod. YONZIMA).mp3', 'Eyob Niguse'),
(36, 'የገነት ሙዚቃ - ye genete muziqa (Prod', 'Songs/የገነት ሙዚቃ - ye genete muziqa (Prod. YONZIMA).mp3', 'Eyob Niguse'),
(37, 'የዘላለም_እንቅልፍ_ye_zelalem_enkelfe_Prod_YONZIMA', 'Songs/የዘላለም_እንቅልፍ_ye_zelalem_enkelfe_Prod_YONZIMA.mp3', 'Eyob Niguse');

-- --------------------------------------------------------

--
-- Table structure for table `upcomingAlbum`
--

CREATE TABLE `upcomingAlbum` (
  `AlbumArt` varchar(255) DEFAULT NULL,
  `Id` int NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `SongsId` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Email` varchar(255) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Email`, `UserName`, `Password`) VALUES
('bellacs@gmail.com', 'Bella', '$2y$10$W8C75414QU5S5iTHe5V.i.aEChMwbZQTohHE8tZeIu044eQN923t2'),
('eyobnigusework@gmail.com', 'Eyob Niguse', '$2y$10$pcgso22ZZYs7YN8xc2EMzeuKBbXec6DR2M8MCr4GCg32ehFZN3N5i'),
('hildanafikadu@gmail.com', 'Hildana', '$2y$10$5zpC3pT3mhat7SkEkhxd4.ZYcp9gHdXBTJYnePItTCB0pAzaTwioi'),
('new@gmail.com', 'Eyob', '$2y$10$MA9jqUkPWnBvNjCzcLZ6a.GIjsS9zDiT.5G9n8z3/twtl8sIhDVS2'),
('new12@gmail.com', 'Eyob', '$2y$10$Lv0tsQG/ESIMe7dijKdO6uy6UvfjzfL7sLQuUlPRzGFLC5SEOkGuq'),
('newMail@gmail.com', 'Eyob', '$2y$10$g7HD6Bx6XGlElDybX2U7A.MMWYoEEdTwZmDgdYm2tPWTimam8rZBy'),
('newuser@gmail.com', 'Eyob Niguse', '$2y$10$Mn3LpZMmpUAio7El15uaTeb1aTLv3oMHZU6TbsnPBpqJZrKjRgPW6'),
('user1@gmail.com', 'Eyob', '$2y$10$pLLTWxrdJxzsn6aLPydeO.c3uIDZvVALNIClHPjWHArWgK1u39sWe'),
('user2@gmail.com', 'Eyob', '$2y$10$XXu1g7rJggsskp0d5704Wev6MT.IoI4iwMenwXT5zreO1tUjZeuTC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `Albums`
--
ALTER TABLE `Albums`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `upcomingAlbum`
--
ALTER TABLE `upcomingAlbum`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `upcomingAlbum`
--
ALTER TABLE `upcomingAlbum`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `users` (`Email`) ON DELETE CASCADE;

--
-- Constraints for table `upcomingAlbum`
--
ALTER TABLE `upcomingAlbum`
  ADD CONSTRAINT `upcomingAlbum_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `users` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

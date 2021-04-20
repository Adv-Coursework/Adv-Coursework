SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `5114asst1`

CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `album`

INSERT INTO `album` (`idalbum`, `title`, `imageurl`, `iduser`) VALUES
(1, 'album69', NULL, 1),
(2, 'Album420', NULL, 2),
(4, 'album112', NULL, 2),
(5, 'album1121', NULL, 2),
(6, 'album123', NULL, 3),
(7, 'album69', NULL, 3),
(11, 'Alb1', NULL, 4),
(12, 'Alb2', NULL, 4),
(13, 'Alb3', NULL, 4);


-- Table structure for table `album_photo`

CREATE TABLE `album_photo` (
  `idalbum_photo` int(11) NOT NULL,
  `idphoto` int(11) NOT NULL,
  `idalbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `album_photo`

INSERT INTO `album_photo` (`idalbum_photo`, `idphoto`, `idalbum`) VALUES
(2, 15, 6),
(3, 17, 7),
(4, 19, 6),
(5, 19, 7);

-- --------------------------------------------------------

-- Table structure for table `photo`

CREATE TABLE `photo` (
  `idphoto` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `comment` varchar(140) DEFAULT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `photo`

INSERT INTO `photo` (`idphoto`, `title`, `imageurl`, `comment`, `iduser`) VALUES
(15, 'S2', 'uploads/1618829890.jpg', 's1', 2),
(16, '1615432375', 'uploads/1618830014.jpg', '123', 2),
(17, '1615432390', 'uploads/1618830021.jpg', '321', 2),
(18, '1615350222', 'uploads/1618830046.jpg', 'plplp', 2),
(19, '1615432400', 'uploads/1618830112.jpg', '321', 3);

-- --------------------------------------------------------
-- Table structure for table `users`

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`

INSERT INTO `users` (`iduser`, `username`, `password`, `created_at`, `email`, `gender`, `nickname`) VALUES
(1, 'hoohoo0721', '$2y$10$zkt4ONKQ7wL7UfPsktxfjeG6qL45Yr7VjEu6P55E7HQoKscnsielm', '2021-04-18 13:16:55', NULL, NULL, NULL),
(2, 'user123', '$2y$10$TqM2Wz8C89e2V2U.F7FNvOI0G8FIE5LNyzGoVTx1w1Cv9DHXSL9Gu', '2021-04-18 16:50:57', NULL, NULL, NULL),
(3, 'user223', '$2y$10$C8NRjviM8SGr/01RJvRsdOyusLCSjML1qFP8DXdztkLcGwYpeH9jG', '2021-04-19 19:01:35', NULL, NULL, NULL),
(4, '123asd', '$2y$10$EWofn.V60hsQ0gfnYPbKVeKXzpXx9I2LZTI1AULGZapZ3/L32HQ7u', '2021-04-19 19:09:25', NULL, NULL, NULL);

--
-- Indexes for dumped tables
-- none

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`),
  ADD KEY `FK_album_user` (`iduser`);

--
-- Indexes for table `album_photo`
--
ALTER TABLE `album_photo`
  ADD PRIMARY KEY (`idalbum_photo`),
  ADD KEY `FK_albumphoto_photo` (`idphoto`),
  ADD KEY `FK_albumphoto_album` (`idalbum`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `FK_photo_user` (`iduser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `idalbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `album_photo`
--
ALTER TABLE `album_photo`
  MODIFY `idalbum_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `album_photo`
--
ALTER TABLE `album_photo`
  ADD CONSTRAINT `album_photo_ibfk_1` FOREIGN KEY (`idphoto`) REFERENCES `photo` (`idphoto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_photo_ibfk_2` FOREIGN KEY (`idalbum`) REFERENCES `album` (`idalbum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

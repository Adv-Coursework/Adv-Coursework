SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

use 5114asst1;

-- Table structure for table `album`
CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `album` (`idalbum`, `title`, `imageurl`, `iduser`) VALUES
(36, 'Album 1 w/ custom thumbnail', 'uploads/1618992720.jpg', 19),
(37, 'Album 2 w/ default thumbnail', 'uploads/default-thumbnail.jpg', 19),
(38, 'Album 3', 'uploads/default-thumbnail.jpg', 19),
(39, 'Album 1', 'uploads/1618995088.jpg', 20);

-- Table structure for table `album_photo`
CREATE TABLE `album_photo` (
  `idalbum_photo` int(11) NOT NULL,
  `idphoto` int(11) NOT NULL,
  `idalbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `album_photo` (`idalbum_photo`, `idphoto`, `idalbum`) VALUES
(19, 38, 37),
(20, 33, 39),
(21, 38, 39),
(22, 39, 39),
(23, 33, 36);


-- Table structure for table `creator`
CREATE TABLE `creator` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `creator` (`iduser`, `username`, `password`, `created_at`, `email`, `gender`, `nickname`) VALUES
(1, 'hoohoo0721', '$2y$10$zkt4ONKQ7wL7UfPsktxfjeG6qL45Yr7VjEu6P55E7HQoKscnsielm', '2021-04-18 13:16:55', NULL, NULL, NULL),
(19, 'admin1', '$2y$10$AzmtzNMRxBAXa/vBW4f.9eaVderD8H7kLN.rLFVqUgl7tWzW1pcoO', '2021-04-21 16:11:13', NULL, NULL, NULL),
(20, 'admin2', '$2y$10$Twoe7bvl86S2ace16ZdpZeccbTsHYt9axm84Fyb4gBXYZr2aQt.YS', '2021-04-21 16:22:35', NULL, NULL, NULL);

-- Table structure for table `photo`
CREATE TABLE `photo` (
  `idphoto` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `comment` varchar(140) DEFAULT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `photo` (`idphoto`, `title`, `imageurl`, `comment`, `iduser`) VALUES
(33, 'Art1', 'uploads/1618992686.jpg', 'This is art 1', 19),
(38, 'Art 2', 'uploads/1618993305.jpg', 'This is art 2', 19),
(39, 'Art 3', 'uploads/1618993377.jpg', 'This is art 3', 20);

-- Indexes for table `album`
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`),
  ADD KEY `FK_album_user` (`iduser`);

-- Indexes for table `album_photo`
ALTER TABLE `album_photo`
  ADD PRIMARY KEY (`idalbum_photo`),
  ADD KEY `FK_albumphoto_photo` (`idphoto`),
  ADD KEY `FK_albumphoto_album` (`idalbum`);

-- Indexes for table `creator`
ALTER TABLE `creator`
  ADD PRIMARY KEY (`iduser`);

-- Indexes for table `photo`
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `FK_photo_user` (`iduser`);


-- AUTO_INCREMENT for table `album`
ALTER TABLE `album`
  MODIFY `idalbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

-- AUTO_INCREMENT for table `album_photo`
ALTER TABLE `album_photo`
  MODIFY `idalbum_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

-- AUTO_INCREMENT for table `creator`
ALTER TABLE `creator`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

-- AUTO_INCREMENT for table `photo`
ALTER TABLE `photo`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

-- Constraints for table `album`
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `creator` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Constraints for table `album_photo`
ALTER TABLE `album_photo`
  ADD CONSTRAINT `album_photo_ibfk_1` FOREIGN KEY (`idphoto`) REFERENCES `photo` (`idphoto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_photo_ibfk_2` FOREIGN KEY (`idalbum`) REFERENCES `album` (`idalbum`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Constraints for table `photo`
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `creator` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

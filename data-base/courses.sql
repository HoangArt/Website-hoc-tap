-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 09:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `age_group` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `lesson_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `subject_id`, `age_group`, `image`, `tittle`, `description`, `file_path`, `lesson_link`, `created_at`) VALUES
(1, 1, '6 tuổi (Lớp 1)', 'https://www.bootdey.com/image/400x300/FF8C00', 'Toán và vì sao nó khó', 'Toán rất khó', '0', '', '2024-12-18 08:37:37'),
(2, 2, '7 tuổi (Lớp 2)', 'https://www.bootdey.com/image/400x300/5F9EA0', 'Hello', 'Tiếng Việt là ngôn ngữ được sử dụng ở Việt Nam', '0', '', '2024-12-18 08:37:37'),
(3, 3, '8 tuổi (Lớp 3)', 'https://www.bootdey.com/image/400x300', 'Good morning', 'Tiếng em', '0', '', '2024-12-18 08:37:37'),
(4, 4, '9 tuổi (Lớp 4)', 'https://www.bootdey.com/image/400x300/8A2BE2', 'Yay', 'Khoa học tự nhiên', '0', '', '2024-12-18 08:37:37'),
(5, 5, '10 tuổi (Lớp 5)', 'https://www.bootdey.com/image/400x300', 'Hámkdl', 'Cách để trở nên siêu văn vở', '0', '', '2024-12-18 08:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(4, 'Khoa học tự nhiên'),
(5, 'Khoa học xã hội'),
(6, 'Môn năng khiếu'),
(3, 'Tiếng Anh'),
(2, 'Tiếng Việt'),
(1, 'Toán học');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

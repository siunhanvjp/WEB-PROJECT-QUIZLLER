-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 09, 2022 at 03:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'nimda');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_id`, `course_name`, `teacher_id`) VALUES
(17, 'CS101', 'Computer Science 101', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `optionA` varchar(255) NOT NULL,
  `optionB` varchar(255) NOT NULL,
  `optionC` varchar(255) NOT NULL,
  `optionD` varchar(255) NOT NULL,
  `correctAns` varchar(255) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `optionA`, `optionB`, `optionC`, `optionD`, `correctAns`, `level`, `teacher_id`, `course_id`) VALUES
(171, 'While running DOS on a PC, which command would be used to duplicate the entire diskette?', 'TYPE', 'COPY', 'DISKCOPY', 'CHKDSK', 'a', 2, 2, 17),
(172, 'Only ___ program(s) become(s) active even though we can open many programs at a time.', 'One', 'Two', 'Three', 'Four', 'b', 2, 2, 17),
(173, 'To prepare a presentation/slide show which application is commonly used?', 'Photoshop', 'Power Point', 'Outlook Express', 'Internet Explorer', 'c', 2, 2, 17),
(174, 'The printing speed is around ___ characters per second in dot matrix printer.', '330', '30', '300', '3000', 'd', 2, 2, 17),
(175, 'Personal computers designed specifically around a visual operating system include', 'The TRS-80 Model I', 'The Apple Macintosh', ' All of these', 'The IBM PC/AT', 'd', 2, 2, 17),
(176, 'Which of the following is related to register?', 'Combinational circuit', 'Arithmetic circuit', 'Sequential circuit', 'Digital circuit', 'd', 2, 2, 17),
(177, 'From which of the following the CPU chip is partially made?', 'Gold', 'Iron', 'Copper', 'Silica', 'a', 2, 2, 17),
(178, 'Dedicated computer means', 'Doesn’t have OS', 'Used by single person', 'Assigned to one and only one task', 'All of above', 'a', 2, 2, 17),
(179, 'Everything computer does it controlled by its?', 'Storage devices', 'CPU', 'ROM', 'RAM', 'a', 2, 2, 17),
(180, 'Mechanism to protect network from outside attack is', 'Anti-virus', 'Firewall', 'Formatting', 'Digital signature', 'a', 2, 2, 17),
(181, 'Objects are represented by', 'Tables', 'Columns', 'Rows', 'None of these', 'a', 2, 2, 17),
(182, 'Generally to copy date from a remote computer/internet to local computer is called _____', 'Download', 'Editing', 'Upload', 'E-mail', 'a', 2, 2, 17),
(183, 'We can enter text to the computer by', 'Router', 'Printer', 'Keyboard', 'Scanner', 'a', 2, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'hoa12345', '0b8e26c2fe07fb0ebc81141d19e5e1e4d4d893d84e186187266e6ba54f5d18ef');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_question` (`teacher_id`),
  ADD KEY `course_question` (`course_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `course_question` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_question` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

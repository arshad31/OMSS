-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 11:02 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omss`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `meeting_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `guest_id` varchar(50) NOT NULL,
  `attendance_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`meeting_id`, `user_id`, `guest_id`, `attendance_status`) VALUES
('C-01', 'ARC-1001', '', 0),
('C-01', 'CSE-1001', '', 1),
('C-01', 'CSE-1002', '', 1),
('C-01', 'CSE-1003', '', 1),
('C-02', 'ARC-1001', '', 1),
('C-02', 'CSE-1001', '', 1),
('C-02', 'CSE-1003', '', 1),
('C-02', 'PHM-1002', '', 1),
('C-03', 'ARC-1001', '', 0),
('C-03', 'CSE-1001', '', 1),
('C-03', 'CSE-1003', '', 1),
('C-03', 'PHM-1002', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `committee_id` varchar(50) NOT NULL,
  `committee_name` varchar(100) NOT NULL,
  `committee_admin` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `office` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`committee_id`, `committee_name`, `committee_admin`, `email`, `phone`, `office`, `is_active`) VALUES
('BBA-01', 'Business Club', 'BBA-1006', 'zh@omss.com', '0123456789', 'BBA', 0),
('CSE-01', 'Programming Contest', 'CSE-1001', 'mt@omss.com', '0123456789', 'CSE', 1),
('CSE-02', 'CSE Fest', 'CSE-1001', 'mr@omss.com', '123456789', 'CSE', 1),
('CSE-03', 'Question Moderation', 'CSE-1001', 'mt@omss.com', '0123456789', 'CSE', 1),
('CSE-04', 'Syllabus', 'CSE-1001', 'mt@omss.com', '0123456789', 'CSE', 1),
('LAW-01', 'Debate', 'LAW-1002', 'sa@omss.com', '123456789', 'LAW', 1),
('PHA-02', 'Pharma FEST', 'PHM-1001', 'mar@omss.com', '01211147852', 'Pharmacy', 0),
('PHA-04', 'Question Moderation ', 'PHA-1007', 'ln@oms.com', '01211258963', 'Pharmacy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `committee_users`
--

CREATE TABLE `committee_users` (
  `c_user_id` varchar(50) NOT NULL,
  `committee_id` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `committee_users`
--

INSERT INTO `committee_users` (`c_user_id`, `committee_id`, `is_active`) VALUES
('ARC-1001', 'CSE-04', 1),
('CSE-1001', 'CSE-04', 1),
('CSE-1002', 'CSE-04', 1),
('CSE-1003', 'CSE-04', 1),
('CSE-1001', 'CSE-01', 1),
('CSE-1002', 'CSE-01', 1),
('CSE-1003', 'CSE-01', 1),
('ARC-1001', 'CSE-03', 1),
('CSE-1001', 'CSE-03', 1),
('CSE-1003', 'CSE-03', 1),
('CSE-1001', 'CSE-02', 1),
('CSE-1002', 'CSE-02', 1),
('CSE-1003', 'CSE-02', 1),
('CSE-1004', 'CSE-02', 1),
('PHM-1002', 'CSE-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(4) NOT NULL,
  `meeting_id` varchar(50) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `office` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `meeting_id`, `guest_name`, `email`, `office`, `designation`) VALUES
(15, 'C-07', 'Dipu Moni', 'dipu@omss.com', 'Ministry of Education', 'Minister of Education');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` varchar(50) NOT NULL,
  `committee_id` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time_start` time(6) NOT NULL,
  `meeting_time_end` time(6) NOT NULL,
  `description` text NOT NULL,
  `meeting_admin_id` varchar(50) NOT NULL,
  `m_action` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `committee_id`, `office`, `meeting_date`, `meeting_time_start`, `meeting_time_end`, `description`, `meeting_admin_id`, `m_action`) VALUES
('C-01', 'CSE-04', 'CSE', '2021-08-02', '10:00:00.000000', '11:30:00.000000', ' It is generally an overview or summary of the curriculum. A syllabus may be set out by an examination board or prepared by the tutor or instructor who teaches or controls the course. The word is also used more generally for an abstract or programme of knowledge', 'CSE-1001', 2),
('C-02', 'CSE-03', 'CSE', '2021-09-08', '14:00:00.000000', '16:00:00.000000', 'Questions that are incoherent, contain inappropriate language, or contain spelling or grammatical errors donâ€™t always need to be dismissed. If the questions can still add value to the discussion, you can simply edit the question so that it is better understood and suits the tone you are trying to set for your event.', 'CSE-1001', 2),
('C-03', 'CSE-03', 'CSE', '2021-09-06', '11:30:00.000000', '12:30:00.000000', 'There are different levels of moderation you may wish to exercise. Not only does it help you maintain a certain standard of content, but it also helps prevent inappropriate and irrelevant questions for entering the discussion', 'CSE-1001', 2),
('C-04', 'CSE-01', 'CSE', '2021-10-09', '10:30:00.000000', '12:30:00.000000', 'The aim of competitive programming is to write source code of computer programs which are able to solve given problems. A vast majority of problems appearing in programming contests are mathematical or logical in nature.', 'CSE-1001', 4),
('C-05', 'CSE-02', 'CSE', '2021-09-18', '09:00:00.000000', '16:00:00.000000', 'To celebrate Bangladeshâ€™s glorious Golden Jubilee of Independence, Dept of CSE, SUB is arranging the â€œSUB Inter-University ICT Innovation Fest. The objective of this event is to facilitate a platform where young and talented minds from around the nation can share their innovative ideas, projects, and prototypes that leverage ICT to solve the problems we face as a nation today. ', 'CSE-1001', 4),
('C-07', 'CSE-02', 'CSE', '2021-10-30', '10:00:00.000000', '17:00:00.000000', 'The Department of Computer Science and Engineering (CSE) of State University of Bangladesh (SUB) is going to arrange a three day long â€˜CSE Fest 2021â€™. This event will be organized by CSE Computing Club and the current students of the Department of Computer Science and Engineering\r\n\r\n', 'CSE-1001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_agenda`
--

CREATE TABLE `meeting_agenda` (
  `agenda_id` int(6) NOT NULL,
  `meeting_id` varchar(50) NOT NULL,
  `agenda` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_agenda`
--

INSERT INTO `meeting_agenda` (`agenda_id`, `meeting_id`, `agenda`) VALUES
(290, 'C-01', 'Eliminate the venue altogether by having the competition be entirely online and letting people'),
(291, 'C-01', 'Having everyone together in one location can add to the energy and excitement. '),
(292, 'C-01', 'Consider whether you want to use a computer lab'),
(293, 'C-02', 'Question Filtering will allow you to dismiss the irrelevant submissions.'),
(294, 'C-02', 'The audienceâ€™s submitted responses will await admin approval before it shows up on all the panels. '),
(295, 'C-03', 'Moderating discussions can make all the difference in the quality of dialogue at your event.'),
(305, 'C-04', 'The judging is done automatically by host machines'),
(306, 'C-04', 'Every solution submitted by a contestant is run on the judge against a set of (usually secret) test cases'),
(307, 'C-05', 'The event website and problem statements for all event segments were unveiled'),
(310, 'C-07', 'Problem setter panel of the CSE Fest'),
(311, 'C-07', 'Who will have in the event management team'),
(312, 'C-07', 'Guests of the prize giving ceremony');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_decision`
--

CREATE TABLE `meeting_decision` (
  `agenda_id` int(6) NOT NULL,
  `meeting_id` varchar(50) NOT NULL,
  `decision` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_decision`
--

INSERT INTO `meeting_decision` (`agenda_id`, `meeting_id`, `decision`) VALUES
(290, 'C-01', 'The guiding document for the committeeâ€™s work is the course syllabus template of the Faculty of Social Sciences. Those involved in working on course syllabi can use the template for support and guidance.'),
(291, 'C-01', 'Course and programme syllabi can be sent to the committee for review and support before they are to be approved or revised. It is strongly recommended to use the faculty-wide Course Syllabus Committee before new course syllabi are to be approved or undergo major revisions.'),
(292, 'C-01', 'To get courses on the agenda, contact the Programme Coordinator at the Faculty Office at the latest one week before a forthcoming meeting. The course syllabi need to be accessible in Lubas. After the committee has reviewed the course syllabi you will get written feedback.'),
(293, 'C-02', 'Respond to questions that are irrelevant to the topic at hand, but are still valid questions. Examples of such questions are enquiries about navigating the app, asking for directions, or complaints about the environment at the event.'),
(294, 'C-02', 'When a question is dismissed, it never appears to the audience, but the attendee will be informed that their question was dismissed. With Admin Replies, you can explain to them that their question goes against the rules of engagement.'),
(295, 'C-03', 'Once a question has been answered, you have the additional option to archive a question by clicking on the eye icon to the right within your Q&A.');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` varchar(50) NOT NULL,
  `office_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`) VALUES
('ARC-001', 'Architecture'),
('BBA-001', 'BBA'),
('CSE-001', 'CSE'),
('ENG-001', 'English'),
('LAW-001', 'LAW'),
('PH-001', 'Public Health'),
('PHM-001', 'Pharmacy');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_admin_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_admin_id`, `first_name`, `last_name`, `email`, `phone`, `organization`, `designation`, `password`) VALUES
('SAD-1001', 'Super', 'Admin', 'suad@omss.com', '01211412563', 'SUB', 'Super Admin', '8fdf1666a000bd24d5c08fc5f85a99f4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `office` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `office`, `designation`, `password`, `is_active`) VALUES
('ARC-1001', 'Shamsul', 'Wares', 'sw@omss.com', '123456789', 'Architecture', 'Professor', '2197144288126b7dc84719bd6a9ee6db', 1),
('BBA-1002', 'MA', 'Baten', 'mb@omss.com', '123456789', 'BBA', 'Lecturer', '2f3f9697faf87fd0738b9cd262075876', 2),
('BBA-1006', 'Zakir ', 'Hossain', 'zh@omss.com', '01745825254', 'BBA', 'Assistant Professor', '063708547e5cd57aec58af95a7dc87da', 1),
('BBA-1007', 'Mahzabeen', 'Faruque', 'mf@omss.com', '01211123456', 'BBA', 'Lecturer', '438e9197b10c44cd7b402003657a963d', 0),
('CSE-1001', 'Masud', 'Tarek', 'mt@omss.com', '0123456789', 'CSE', 'Head', '04ff8a52a970445ce5e0a1ef3745fac8', 1),
('CSE-1002', 'Muntasir', 'Hasan', 'mh@omss.com', '123456789', 'CSE', 'Lecturer', 'c6f44a7b265c3664f092535e21465cbf', 1),
('CSE-1003', 'Mamoon', 'Rasheed', 'mr@omss.com', '123456789', 'CSE', 'Assistant Professor', '2a149812ea3acb43f33d04eed5f0e9d1', 1),
('CSE-1004', 'Amina', 'Rahman', 'ar@omss.com', '123456789', 'CSE', 'Lecturer', '92df1f5299e3ebc7e041ca82cc44d37a', 2),
('CSE-1006', 'Sifat', 'Munim', 'sm@omss.com', '01211852147', 'CSE', 'Lecturer', '5b7ccf0f897e51cab1dc8faf617bd79c', 0),
('ENG-1001', 'Adiba', 'Tasnim', 'ata@omss.com', '012114789654', 'English', 'Lecturer', 'ac27d1abcea7a0ae8fbc37739dad74ae', 2),
('JMC-1001', 'Sumaita', 'Anjum', 'sat@omss.com', '01478963025', 'Public Health', 'L', '21a709142f8a77e10f5d73a7e10c3664', 1),
('LAW-1002', 'Sazzad', 'Alam', 'sa@omss.com', '0123456789', 'LAW', 'Lecturer', '6037acc6da44686e344385233e8208b7', 0),
('PHM-1001', 'M A', 'Rashid', 'mar@omss.com', '01211852369', 'Pharmacy', 'Advisor', 'fb2440a35e7ca184d9b85b586556f7dd', 1),
('PHM-1002', 'Anwar UL', 'Islam', 'ai@omss.com', '01211456987', 'Pharmacy', 'Professor', 'd4f46962f149faf7acedd6cb67cb1fcb', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`committee_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_agenda`
--
ALTER TABLE `meeting_agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `meeting_agenda`
--
ALTER TABLE `meeting_agenda`
  MODIFY `agenda_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2024 at 01:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tamtech_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Superadmin','Admin','Viewers','IT') NOT NULL,
  `token` varchar(255) NOT NULL,
  `approve_token` varchar(255) NOT NULL,
  `verify_otp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `firstname`, `lastname`, `profile_image`, `username`, `email`, `password`, `role`, `token`, `approve_token`, `verify_otp`) VALUES
(1, 'Carlos', 'Bernales', '', 'carlosbernales', 'carlosbernales24@gmail.com', '$2y$10$KAjPHZf.TTHMKaJhJqil1uwZ4pd0KQN/F7YjnxDaCsxvz4w7EAf52', 'Superadmin', '978f1fb2118b2455d9b546252e2a4f8710ae8e9b9b78e904055688a3acd5bf7b', 'xEYgdAiD8T5C1NaeRr9csJLyHwK7FoWfnvqpBIbtQ6ZkOGUSmjVPz4lMXuh023', '997901'),
(2, 'Ocean', 'Temblique', '', 'IT Ocean', 'ocean.tamtech@gmail.com', '$2y$10$88GaZeDeuzIxwDpTMX9OAuwVjUeA.3AyudJ9wobpmSkZwxR.9nzCa', 'Superadmin', '', '60Yus2gvG8UERKTlOLanJrN1BxDP3Q5fcHbemjoI4Ctypwiz7kV9FqMZhXASdW', '');

-- --------------------------------------------------------

--
-- Table structure for table `agent_documents`
--

CREATE TABLE `agent_documents` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL,
  `upload_files` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agent_documents`
--

INSERT INTO `agent_documents` (`id`, `agent_fk_id`, `upload_files`) VALUES
(262, 39, 'Training Contract.jpg'),
(263, 39, 'Curriculum Vitae.jpg'),
(264, 39, 'Probationary Employee Contract.pdf'),
(265, 7, 'Probationary Employee Contract.pdf'),
(266, 7, 'Curriculum Vitae.pdf'),
(267, 7, 'Regularization Contract.jpg.jpg'),
(268, 32, 'Curriculum Vitae.jpg'),
(269, 32, 'SSS.pdf'),
(270, 32, 'Probationary Employee Contract.pdf'),
(273, 32, 'Training Contract.jpg'),
(274, 32, 'Agent Score Card.jpg'),
(275, 21, 'Employee Justification Form.jpg'),
(276, 21, 'Curriculum Vitae.jpg'),
(277, 21, 'Regularization Contract.jpg.jpg'),
(278, 21, 'Evaluation Form.jpg'),
(279, 21, 'Training Contract.jpg'),
(280, 21, 'Probationary Employee Contract.pdf'),
(281, 37, 'Curriculum Vitae.pdf'),
(283, 37, 'Training Contract.jpg'),
(284, 37, 'Probationary Employee Contract.pdf'),
(285, 29, 'Evaluation Form.jpg'),
(286, 29, 'Probationary Employee Contract.pdf'),
(287, 29, 'Curriculum Vitae.pdf'),
(288, 29, 'Training Contract.jpg'),
(289, 29, 'Regularization Contract.jpg.jpg'),
(290, 19, 'Probationary Employee Contract.pdf'),
(291, 19, 'Training Contract.jpg'),
(292, 19, 'Employee Leave Application Form.jpg'),
(293, 19, 'Curriculum Vitae.pdf'),
(294, 19, 'Regularization Contract.jpg.jpg'),
(295, 18, 'Training Contract.jpg'),
(296, 18, 'Curriculum Vitae.pdf'),
(297, 18, 'Regularization Contract.jpg.jpg'),
(298, 18, 'Incident Report.pdf'),
(300, 18, 'Probationary Employee Contract.pdf'),
(301, 18, 'Employee Leave Application Form.jpg'),
(302, 34, 'Training Contract.jpg'),
(303, 34, 'Curriculum Vitae.pdf'),
(304, 34, 'SSS.pdf'),
(305, 34, 'Probationary Employee Contract.pdf'),
(306, 36, 'Training Contract.jpg'),
(307, 36, 'Curriculum Vitae.pdf'),
(308, 36, 'Probationary Employee Contract.pdf'),
(309, 5, 'Regularization Contract.pdf.pdf'),
(310, 5, 'Probationary Employee Contract.pdf'),
(311, 5, 'Promotion Letter.pdf'),
(312, 5, 'SSS.pdf'),
(314, 8, 'Payroll Deduction.pdf'),
(315, 8, 'Evaluation Form.pdf'),
(316, 8, 'Regularization Contract.pdf.pdf'),
(317, 8, 'Curriculum Vitae.pdf'),
(318, 8, 'Probationary Employee Contract.pdf'),
(319, 2, 'Probationary Employee Contract.pdf'),
(320, 2, 'Curriculum Vitae.pdf'),
(321, 2, 'Incident Report.pdf'),
(322, 2, 'Incident Report.pdf'),
(323, 2, 'Probationary Employee Contract.pdf'),
(324, 2, 'Probation Successful .pdf'),
(325, 2, 'Training Contract.pdf'),
(326, 2, 'Training Contract.pdf'),
(329, 45, 'Probationary Employee Contract.pdf'),
(330, 45, 'Regularization Contract .pdf'),
(331, 45, 'Regularization Contract .pdf'),
(332, 45, 'Curriculum Vitae.pdf'),
(333, 45, 'Regularization Contract .pdf'),
(334, 35, 'Probationary Employee Contract.pdf'),
(335, 35, 'Curriculum Vitae.pdf'),
(336, 35, 'Training Contract.pdf'),
(337, 52, 'Training Contract.pdf'),
(338, 52, 'Curriculum Vitae.pdf'),
(339, 52, 'Probationary Employee Contract.pdf'),
(340, 53, 'Probationary Employee Contract.pdf'),
(341, 53, 'Training Contract.pdf'),
(342, 53, 'Curriculum Vitae.pdf'),
(343, 51, 'Training Contract.pdf'),
(344, 51, 'Curriculum Vitae.pdf'),
(345, 51, 'Probationary Employee Contract.pdf'),
(346, 5, 'Curriculum Vitae.pdf'),
(347, 47, 'Regularization Contract .pdf'),
(348, 47, 'Probationary Employee Contract.pdf'),
(349, 47, 'CamScanner 04-15-2024 13.37.pdf'),
(350, 44, 'Probationary Employee Contract.pdf'),
(351, 44, 'Training Contract.pdf'),
(352, 44, 'Incident Report.pdf'),
(353, 44, 'Probation Successful .pdf'),
(354, 44, 'Sedula.pdf'),
(355, 44, 'Curriculum Vitae.pdf'),
(356, 48, 'Probationary Employee Contract.pdf'),
(357, 48, 'Probationary Employee Contract.pdf'),
(358, 48, 'Member Data Form.pdf'),
(359, 48, 'Regularization Contract.pdf.pdf'),
(360, 48, 'Training Contract.pdf'),
(361, 48, 'Curriculum Vitae.pdf'),
(362, 48, 'Probationary Employee Contract.pdf'),
(363, 50, 'Curriculum Vitae.pdf'),
(364, 50, 'Regularization Contract .pdf'),
(365, 50, 'Training Contract.pdf'),
(366, 49, 'Probationary Employee Contract.pdf'),
(367, 49, 'Training Contract.pdf'),
(368, 49, 'Curriculum Vitae.pdf'),
(369, 46, 'Probationary Employee Contract.pdf'),
(370, 46, 'Regularization Contract .pdf'),
(371, 6, 'Training Contract.jpg'),
(372, 6, 'Regularization Contract .jpg'),
(373, 6, 'CamScanner 04-15-2024 08.56_05.jpg'),
(374, 6, 'Probationary Employee Contract.pdf'),
(375, 6, 'Incident Report.pdf'),
(394, 41, 'Probationary Employee Contract.pdf'),
(395, 41, 'Curriculum Vitae.pdf'),
(397, 41, 'IMG_20240415_094033.jpg'),
(398, 41, 'Training Contract.jpg'),
(399, 31, 'Evaluation Form.jpg'),
(400, 31, 'Curriculum Vitae.jpg'),
(401, 31, 'CamScanner 04-15-2024 09.04_03.jpg'),
(402, 31, 'SSS.pdf'),
(403, 31, 'TIN Number.pdf'),
(404, 31, 'Training Contract.jpg'),
(405, 31, 'Probationary Employee Contract.pdf'),
(406, 38, 'Curriculum Vitae.jpg'),
(407, 38, 'Probationary Employee Contract.pdf'),
(408, 38, 'Training Contract.jpg'),
(409, 33, 'TIN Number.pdf'),
(410, 33, 'Member Data Form.pdf'),
(411, 33, 'Probationary Employee Contract.pdf'),
(412, 33, 'Training Contract.jpg'),
(413, 33, 'Curriculum Vitae.pdf'),
(414, 30, 'Evaluation Form.jpg'),
(415, 30, 'Curriculum Vitae.pdf'),
(417, 30, 'Probationary Employee Contract.pdf'),
(419, 30, 'Regularization Contract .jpg'),
(420, 30, 'Training Contract.jpg'),
(421, 13, 'Probationary Employee Contract.pdf'),
(422, 13, 'Employee Leave Application Form.pdf'),
(423, 13, 'Curriculum Vitae.pdf'),
(424, 13, 'Regularization Contract .pdf'),
(425, 28, 'Employee Leave Application Form.pdf'),
(426, 28, 'Curriculum Vitae.pdf'),
(427, 28, 'Medical Certificate.pdf'),
(428, 28, 'Evaluation Form.pdf'),
(429, 28, 'Training Contract.pdf'),
(430, 28, 'Probationary Employee Contract.pdf'),
(431, 28, 'Regularization Contract .pdf'),
(432, 28, 'Evaluation Form.pdf'),
(433, 22, 'Employee Leave Application Form.pdf'),
(434, 22, 'Incident Report.pdf'),
(435, 22, 'Curriculum Vitae.pdf'),
(436, 22, 'Regularization Contract .pdf'),
(437, 22, 'Training Contract.pdf'),
(438, 22, 'Probationary Employee Contract.pdf'),
(439, 16, 'Incident Report.pdf'),
(440, 16, 'Incident Report.pdf'),
(441, 16, 'Probationary Employee Contract.pdf'),
(442, 16, 'Training Contract.pdf'),
(443, 16, 'Curriculum Vitae.pdf'),
(444, 16, 'Incident Report.pdf'),
(445, 16, 'Incident Report.pdf'),
(446, 16, 'Incident Report.pdf'),
(447, 16, 'Regularization Contract .pdf'),
(448, 16, 'Evaluation Form.pdf'),
(449, 16, 'Incident Report.pdf'),
(450, 16, 'Incident Report.pdf'),
(451, 10, 'Employee Leave Application Form.pdf'),
(452, 10, 'Employee Leave Application Form.pdf'),
(453, 10, 'Probationary Employee Contract.pdf'),
(454, 10, 'Regularization Contract .pdf'),
(455, 10, 'Letter.pdf'),
(456, 10, 'Incident Report.pdf'),
(457, 10, 'Incident Report.pdf'),
(458, 10, 'Curriculum Vitae.pdf'),
(459, 4, 'Curriculum Vitae.pdf'),
(460, 4, 'Regularization Contract .pdf'),
(461, 4, 'Probationary Employee Contract.pdf'),
(462, 25, 'Regularization Contract .pdf'),
(463, 25, 'Regularization Contract .pdf'),
(464, 25, 'Evaluation Form.pdf'),
(465, 25, 'Evaluation Form.pdf'),
(466, 25, 'Evaluation Form.pdf'),
(467, 25, 'Incident Report.pdf'),
(468, 25, 'Curriculum Vitae.pdf'),
(469, 25, 'Incident Report.pdf'),
(470, 25, 'Training Contract.pdf'),
(471, 25, 'Incident Report.pdf'),
(472, 25, 'Probationary Employee Contract.pdf'),
(473, 25, 'Employee Justification Form.pdf'),
(474, 27, 'Evaluation Form.pdf'),
(475, 27, 'Probationary Employee Contract.pdf'),
(476, 27, 'Evaluation Form.pdf'),
(477, 27, 'Curriculum Vitae.pdf'),
(478, 27, 'Training Contract.pdf'),
(479, 43, 'Probationary Employee Contract.pdf'),
(480, 43, 'Curriculum Vitae.pdf'),
(481, 43, 'Training Contract.pdf'),
(482, 11, 'Curriculum Vitae.pdf'),
(483, 11, 'Regularization Contract .pdf'),
(484, 11, 'Probationary Employee Contract.pdf'),
(485, 11, 'Incident Report.pdf'),
(486, 11, 'Incident Report.pdf'),
(487, 11, 'Payroll Deduction Authorization .pdf'),
(488, 11, 'Incident Report.pdf'),
(489, 11, 'Incident Report.pdf'),
(490, 11, 'Incident Report.pdf'),
(491, 11, 'Incident Report.pdf'),
(493, 11, 'Incident Report.pdf'),
(494, 11, 'Incident Report.pdf'),
(495, 11, 'Incident Report.pdf'),
(496, 11, 'Incident Report.pdf'),
(497, 11, 'Incident Report.pdf'),
(498, 17, 'Employee Leave Application Form.pdf'),
(499, 17, 'Evaluation Form.pdf'),
(500, 17, 'Regularization Contract .pdf'),
(501, 17, 'Incident Report.pdf'),
(502, 17, 'Training Contract.pdf'),
(503, 17, 'Incident Report.pdf'),
(504, 17, 'Probationary Employee Contract.pdf'),
(505, 23, 'Evaluation Form.pdf'),
(506, 23, 'Regularization Contract .pdf'),
(507, 23, 'Probationary Employee Contract.pdf'),
(508, 23, 'Training Contract.pdf'),
(509, 23, 'Curriculum Vitae.pdf'),
(510, 24, 'Evaluation Form.pdf'),
(511, 24, 'Regularization Contract .pdf'),
(512, 24, 'Probationary Employee Contract.pdf'),
(513, 24, 'Letter Of Resignation.pdf'),
(514, 24, 'Incident Report.pdf'),
(515, 24, 'Letter.pdf'),
(516, 24, 'Probationary Employee Contract.pdf'),
(517, 24, 'Employee Exit Form.pdf'),
(518, 24, 'Incident Report.pdf'),
(519, 24, 'Incident Report.pdf'),
(520, 24, 'Curriculum Vitae.pdf'),
(521, 24, 'Regularization Contract .pdf'),
(522, 12, 'Employee Leave Application Form.pdf'),
(523, 12, 'Probationary Employee Contract.pdf'),
(524, 12, 'Curriculum Vitae.pdf'),
(525, 12, 'Regularization Contract .pdf'),
(526, 9, 'Incident Report.pdf'),
(527, 9, 'Incident Report.pdf'),
(528, 9, 'Incident Report.pdf'),
(529, 9, 'Incident Report.pdf'),
(530, 9, 'Regularization Contract .pdf'),
(531, 9, 'Probationary Employee Contract.pdf'),
(532, 9, 'Incident Report.pdf'),
(533, 9, 'Incident Report.pdf'),
(534, 9, 'Incident Report.pdf'),
(535, 9, 'Incident Report.pdf'),
(536, 9, 'Incident Report.pdf'),
(537, 9, 'Incident Report.pdf'),
(538, 9, 'Incident Report.pdf'),
(539, 9, 'Incident Report.pdf'),
(540, 9, 'Curriculum Vitae.pdf'),
(541, 42, 'Curriculum Vitae.pdf'),
(542, 42, 'Probationary Employee Contract.pdf'),
(543, 42, 'Training Contract.pdf'),
(544, 14, 'Incident Report.pdf'),
(545, 14, 'Training Contract.pdf'),
(546, 14, 'Exam.pdf'),
(547, 14, 'Regularization Contract .pdf'),
(548, 14, 'Probationary Employee Contract.pdf'),
(549, 14, 'Incident Report.pdf'),
(550, 14, 'Incident Report.pdf'),
(551, 40, 'Probationary Employee Contract.pdf'),
(552, 40, 'Training Contract.pdf'),
(553, 40, 'Curriculum Vitae.pdf'),
(554, 3, 'Incident Report.pdf'),
(555, 3, 'Employee Leave Application Form.pdf'),
(556, 3, 'Regularization Contract .pdf'),
(557, 3, 'Member Data Record.pdf'),
(558, 3, 'TIN Number.pdf'),
(559, 3, 'SSS.pdf'),
(560, 3, 'SSS.pdf'),
(561, 3, 'Member Data Form.pdf'),
(562, 3, 'Probationary Employee Contract.pdf'),
(563, 3, 'Curriculum Vitae.pdf'),
(564, 20, 'Incident Report.pdf'),
(565, 20, 'Incident Report.pdf'),
(566, 20, 'Probationary Employee Contract.pdf'),
(567, 20, 'Curriculum Vitae.pdf'),
(568, 20, 'Training Contract.pdf'),
(569, 20, 'Regularization Contract .pdf'),
(570, 20, 'Evaluation Form.pdf'),
(571, 26, 'Training Contract.pdf'),
(572, 26, 'Evaluation Form.pdf'),
(573, 26, 'Curriculum Vitae.pdf'),
(574, 26, 'Agent Score Card.pdf'),
(575, 26, 'Regularization Contract .pdf'),
(576, 26, 'Probationary Employee Contract.pdf'),
(577, 26, 'Employee Leave Application Form.pdf'),
(578, 15, 'Regularization Contract .pdf'),
(579, 15, 'Employee Leave Application Form.pdf'),
(580, 15, 'Employee Leave Application Form.pdf'),
(581, 15, 'Training Contract.pdf'),
(582, 15, 'Curriculum Vitae.pdf'),
(583, 15, 'Evaluation Form.pdf'),
(584, 15, 'Probationary Employee Contract.pdf'),
(585, 15, 'CamScanner 04-15-2024 16.48.pdf'),
(586, 53, 'Confidentiality and Non-Disclosure Agreement.pdf.pdf'),
(587, 32, 'Regularization Contract .pdf'),
(588, 21, 'Incident Report.pdf'),
(589, 13, 'Confidentiality and Non-disclosure Agreemnt.pdf'),
(590, 54, 'Curriculum Vitae.pdf'),
(591, 13, 'Employee Exit Form.pdf'),
(592, 13, 'Employee Exit Interview Form.pdf'),
(593, 54, 'Probationary Employee Contract.pdf'),
(594, 54, 'Training Contract.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `agent_leave`
--

CREATE TABLE `agent_leave` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_of_leave` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `required_work` time NOT NULL,
  `daily_salary` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agent_leave`
--

INSERT INTO `agent_leave` (`id`, `agent_fk_id`, `agent_id`, `comment`, `status`, `date_of_leave`, `start_date`, `end_date`, `required_work`, `daily_salary`) VALUES
(1, 2, 'TAM009', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(2, 2, 'TAM009', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(3, 2, 'TAM009', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(4, 2, 'TAM009', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(5, 2, 'TAM009', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(6, 3, 'TAM069', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(7, 3, 'TAM069', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(8, 3, 'TAM069', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(9, 3, 'TAM069', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(10, 3, 'TAM069', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(11, 4, 'TAM072', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(12, 4, 'TAM072', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(13, 4, 'TAM072', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(14, 4, 'TAM072', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(15, 4, 'TAM072', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(16, 5, 'TAM075', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(17, 5, 'TAM075', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(18, 5, 'TAM075', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(19, 5, 'TAM075', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(20, 5, 'TAM075', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(21, 6, 'TAM081', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(22, 6, 'TAM081', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(23, 6, 'TAM081', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(24, 6, 'TAM081', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(25, 6, 'TAM081', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(26, 7, 'TAM076', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(27, 7, 'TAM076', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(28, 7, 'TAM076', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(29, 7, 'TAM076', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(30, 7, 'TAM076', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(31, 8, 'TAM085', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(32, 8, 'TAM085', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(33, 8, 'TAM085', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(34, 8, 'TAM085', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(35, 8, 'TAM085', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(36, 9, 'TAM098', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(37, 9, 'TAM098', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(38, 9, 'TAM098', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(39, 9, 'TAM098', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(40, 9, 'TAM098', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(41, 10, 'TAM115', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(42, 10, 'TAM115', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(43, 10, 'TAM115', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(44, 10, 'TAM115', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(45, 10, 'TAM115', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(46, 11, 'TAM116', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(47, 11, 'TAM116', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(48, 11, 'TAM116', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(49, 11, 'TAM116', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(50, 11, 'TAM116', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(51, 12, 'TAM122', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(52, 12, 'TAM122', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(53, 12, 'TAM122', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(54, 12, 'TAM122', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(55, 12, 'TAM122', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(56, 13, 'TAM123', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(57, 13, 'TAM123', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(58, 13, 'TAM123', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(59, 13, 'TAM123', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(60, 13, 'TAM123', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(61, 14, 'TAM141', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(62, 14, 'TAM141', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(63, 14, 'TAM141', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(64, 14, 'TAM141', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(65, 14, 'TAM141', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(66, 15, 'TAM146', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(67, 15, 'TAM146', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(68, 15, 'TAM146', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(69, 15, 'TAM146', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(70, 15, 'TAM146', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(71, 16, 'TAM147', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(72, 16, 'TAM147', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(73, 16, 'TAM147', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(74, 16, 'TAM147', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(75, 16, 'TAM147', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(76, 17, 'TAM149', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(77, 17, 'TAM149', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(78, 17, 'TAM149', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(79, 17, 'TAM149', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(80, 17, 'TAM149', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(81, 18, 'TAM150', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(82, 18, 'TAM150', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(83, 18, 'TAM150', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(84, 18, 'TAM150', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(85, 18, 'TAM150', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(86, 19, 'TAM152', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(87, 19, 'TAM152', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(88, 19, 'TAM152', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(89, 19, 'TAM152', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(90, 19, 'TAM152', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(91, 20, 'TAM158', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(92, 20, 'TAM158', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(93, 20, 'TAM158', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(94, 20, 'TAM158', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(95, 20, 'TAM158', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(96, 21, 'TAM160', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(97, 21, 'TAM160', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(98, 21, 'TAM160', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(99, 21, 'TAM160', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(100, 21, 'TAM160', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(101, 22, 'TAM164', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(102, 22, 'TAM164', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(103, 22, 'TAM164', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(104, 22, 'TAM164', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(105, 22, 'TAM164', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(106, 23, 'TAM166', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(107, 23, 'TAM166', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(108, 23, 'TAM166', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(109, 23, 'TAM166', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(110, 23, 'TAM166', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(111, 24, 'TAM127', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(112, 24, 'TAM127', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(113, 24, 'TAM127', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(114, 24, 'TAM127', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(115, 24, 'TAM127', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(116, 25, 'TAM167', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(117, 25, 'TAM167', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(118, 25, 'TAM167', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(119, 25, 'TAM167', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(120, 25, 'TAM167', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(121, 26, 'TAM168', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(122, 26, 'TAM168', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(123, 26, 'TAM168', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(124, 26, 'TAM168', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(125, 26, 'TAM168', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(126, 27, 'TAM170', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(127, 27, 'TAM170', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(128, 27, 'TAM170', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(129, 27, 'TAM170', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(130, 27, 'TAM170', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(131, 28, 'TAM171', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(132, 28, 'TAM171', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(133, 28, 'TAM171', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(134, 28, 'TAM171', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(135, 28, 'TAM171', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(136, 29, 'TAM175', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(137, 29, 'TAM175', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(138, 29, 'TAM175', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(139, 29, 'TAM175', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(140, 29, 'TAM175', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(141, 30, 'TAM177', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(142, 30, 'TAM177', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(143, 30, 'TAM177', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(144, 30, 'TAM177', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(145, 30, 'TAM177', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(146, 31, 'TAM181', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(147, 31, 'TAM181', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(148, 31, 'TAM181', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(149, 31, 'TAM181', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(150, 31, 'TAM181', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(151, 32, 'TAM182', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(152, 32, 'TAM182', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(153, 32, 'TAM182', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(154, 32, 'TAM182', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(155, 32, 'TAM182', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(156, 33, 'TAM188', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(157, 33, 'TAM188', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(158, 33, 'TAM188', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(159, 33, 'TAM188', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(160, 33, 'TAM188', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(161, 34, 'TAM189', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(162, 34, 'TAM189', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(163, 34, 'TAM189', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(164, 34, 'TAM189', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(165, 34, 'TAM189', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(166, 35, 'TAM190', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(167, 35, 'TAM190', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(168, 35, 'TAM190', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(169, 35, 'TAM190', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(170, 35, 'TAM190', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(171, 36, 'TAM191', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(172, 36, 'TAM191', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(173, 36, 'TAM191', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(174, 36, 'TAM191', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(175, 36, 'TAM191', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(176, 37, 'TAM192', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(177, 37, 'TAM192', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(178, 37, 'TAM192', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(179, 37, 'TAM192', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(180, 37, 'TAM192', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(181, 38, 'TAM193', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(182, 38, 'TAM193', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(183, 38, 'TAM193', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(184, 38, 'TAM193', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(185, 38, 'TAM193', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(186, 39, 'TAM194', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(187, 39, 'TAM194', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(188, 39, 'TAM194', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(189, 39, 'TAM194', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(190, 39, 'TAM194', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(191, 40, 'TAM195', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(192, 40, 'TAM195', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(193, 40, 'TAM195', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(194, 40, 'TAM195', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(195, 40, 'TAM195', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(196, 41, 'TAM196', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(197, 41, 'TAM196', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(198, 41, 'TAM196', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(199, 41, 'TAM196', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(200, 41, 'TAM196', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(201, 42, 'TAM197', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(202, 42, 'TAM197', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(203, 42, 'TAM197', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(204, 42, 'TAM197', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(205, 42, 'TAM197', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(206, 43, 'TAM200', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(207, 43, 'TAM200', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(208, 43, 'TAM200', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(209, 43, 'TAM200', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(210, 43, 'TAM200', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(211, 44, 'TAM043', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(212, 44, 'TAM043', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(213, 44, 'TAM043', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(214, 44, 'TAM043', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(215, 44, 'TAM043', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(216, 45, 'EITB007', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(217, 45, 'EITB007', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(218, 45, 'EITB007', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(219, 45, 'EITB007', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(220, 45, 'EITB007', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(221, 46, 'EITB010', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(222, 46, 'EITB010', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(223, 46, 'EITB010', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(224, 46, 'EITB010', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(225, 46, 'EITB010', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(226, 47, 'EITB012', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(227, 47, 'EITB012', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(228, 47, 'EITB012', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(229, 47, 'EITB012', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(230, 47, 'EITB012', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(231, 48, 'EITB006', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(232, 48, 'EITB006', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(233, 48, 'EITB006', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(234, 48, 'EITB006', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(235, 48, 'EITB006', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(236, 49, 'EITB013', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(237, 49, 'EITB013', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(238, 49, 'EITB013', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(239, 49, 'EITB013', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(240, 49, 'EITB013', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(241, 50, 'EITB014', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(242, 50, 'EITB014', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(243, 50, 'EITB014', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(244, 50, 'EITB014', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(245, 50, 'EITB014', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(246, 51, 'EITB015', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(247, 51, 'EITB015', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(248, 51, 'EITB015', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(249, 51, 'EITB015', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(250, 51, 'EITB015', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(251, 52, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(252, 52, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(253, 52, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(254, 52, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(255, 52, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(256, 53, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(257, 53, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(258, 53, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(259, 53, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(260, 53, 'None', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(261, 54, 'TAM201', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(262, 54, 'TAM201', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(263, 54, 'TAM201', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(264, 54, 'TAM201', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(265, 54, 'TAM201', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(266, 55, 'EITB016', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(267, 55, 'EITB016', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(268, 55, 'EITB016', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(269, 55, 'EITB016', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(270, 55, 'EITB016', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(271, 63, 'TAM202', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(272, 63, 'TAM202', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(273, 63, 'TAM202', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(274, 63, 'TAM202', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(275, 63, 'TAM202', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '08:00:00', 0.00),
(276, 71, 'dsdddsd', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(277, 71, 'dsdddsd', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(278, 71, 'dsdddsd', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(279, 71, 'dsdddsd', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00),
(280, 71, 'dsdddsd', 'None', 'Unused', '0000-00-00', '2024-01-01', '2024-12-31', '00:00:00', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `agent_list`
--

CREATE TABLE `agent_list` (
  `id` int NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_id` varchar(255) NOT NULL DEFAULT 'None',
  `campaign` varchar(255) NOT NULL DEFAULT 'None',
  `status` enum('Active','Resigned','Terminated') NOT NULL,
  `start_date` date DEFAULT NULL,
  `SSS` double(10,2) NOT NULL,
  `pag_ibig` double(10,2) NOT NULL,
  `philhealth` double(10,2) NOT NULL,
  `daily_salary` double(10,2) NOT NULL,
  `required_work` time NOT NULL,
  `house_rent` double(10,2) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agent_list`
--

INSERT INTO `agent_list` (`id`, `agent_name`, `agent_id`, `campaign`, `status`, `start_date`, `SSS`, `pag_ibig`, `philhealth`, `daily_salary`, `required_work`, `house_rent`, `user_email`, `comment`) VALUES
(2, 'Ezekiel Telmo', 'TAM009', 'BDM', 'Active', '2017-03-05', 0.00, 200.00, 0.00, 550.00, '08:00:00', 0.00, 'ezekiel.telmo@tamtechhub.com', ''),
(3, 'Reynato Froisland', 'TAM069', 'DCS', 'Active', '2019-02-04', 0.00, 200.00, 0.00, 120.00, '08:00:00', 0.00, 'reynato.tamtech@gmail.com', ''),
(4, 'Jaynelle Bumacod', 'TAM072', 'DCS', 'Active', '2019-04-08', 0.00, 200.00, 0.00, 400.00, '08:00:00', 0.00, 'jaynelle.tamtech@gmail.com', ''),
(5, 'Carl Lorenz Villaluna', 'TAM075', 'Energy Makeovers (Calls)', 'Active', '2019-05-08', 100.00, 200.00, 50.00, 400.00, '08:00:00', 500.00, 'carl.tamtech@gmail.com', ''),
(6, 'Wendell Lozano', 'TAM081', 'Cold Calls/ CM', 'Active', '2019-07-01', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'ariancuenca28@gmail.com', ''),
(7, 'Ro Anne Sarmiento', 'TAM076', 'CHR ', 'Active', '2019-08-19', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'roann.tamtech@gmail.com', ''),
(8, 'Diana Lyn Lim', 'TAM085', 'Rush Buyers/ CHR', 'Active', '2020-02-18', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'diana.tamtech@gmail.com', ''),
(9, 'Fitz Gerald  Geraldizo ', 'TAM098', 'Energy Makeovers (VA)', 'Active', '2021-01-25', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'fitz.tamtech@gmail.com', ''),
(10, 'Ivan  Vincent Alfred Neil Agleron', 'TAM115', 'DCS / EM Calls', 'Active', '2021-03-13', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'ivan.tamtech@gmail.com', ''),
(11, 'Marlean Batas', 'TAM116', 'Cold Calls/ DCS', 'Active', '2021-03-13', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'marlean.tamtech@gmail.com', ''),
(12, 'Sheila Laine Cayas', 'TAM122', 'Energy Makeovers', 'Active', '2021-04-17', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'shiela.tamtech@gmail.com', ''),
(13, 'Charybeth  Dalisay', 'TAM123', 'Energy Makeovers', 'Active', '2021-08-16', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, '', ''),
(14, 'Manuel Ray Ferrer', 'TAM141', 'EM (VA)/ PPP', 'Active', '2022-06-01', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'manuel.tamtech@gmail.com', ''),
(15, 'Khanyawtay Gorospe', 'TAM146', 'Energy (Calls)', 'Active', '2022-08-29', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'khanyawtay.tamtech@gmail.com', ''),
(16, 'Francis Calayag II', 'TAM147', 'Cold Calls/ IAG', 'Active', '2022-09-12', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'francis.tamtechhub@gmail.com', ''),
(17, 'Matthew Del Rosario', 'TAM149', 'LAC', 'Active', '2022-09-21', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'matthew.tamtech@gmail.com', ''),
(18, 'Ocean Mark Temblique', 'TAM150', 'IT', 'Active', '2022-09-22', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'ocean.tamtech@gmail.com', ''),
(19, 'Kristine  Tejida', 'TAM152', 'CHR Admin/ HR', 'Active', '2022-09-27', 0.00, 200.00, 100.00, 395.00, '08:00:00', 0.00, 'kristine.tamtechhub@gmail.com', ''),
(20, 'Cathreen Joyce Jimenez', 'TAM158', 'IAG/ EM Calls', 'Active', '2023-01-02', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'cathreen.tamtech@gmail.com', ''),
(21, 'Irene Rose Sega', 'TAM160', 'SUUT', 'Active', '2023-01-16', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'irene.tamtech@gmail.com', ''),
(22, 'Dhenniel Nivar Enrile', 'TAM164', 'SUUT/ CHR', 'Active', '2023-02-06', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'dhenniel.tamtech@gmail.com', ''),
(23, 'Melanie Basaka', 'TAM166', 'CAG/EM Calls', 'Active', '2023-02-07', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'melanie.tamtechhub@gmail.com', ''),
(24, 'Nic Orlyn Mercado', 'TAM127', 'BFT/ Paramount', 'Active', '2023-02-08', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'nic.tamtech@gmail.com', ''),
(25, 'Joel  Catague Jr. ', 'TAM167', 'DCS', 'Active', '2023-02-15', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'joel.tamtech@gmail.com', ''),
(26, 'Christian Ralph Ilagan', 'TAM168', 'CHR', 'Active', '2023-02-25', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'christianralph.tamtech@gmail.com', ''),
(27, 'John Mark  Castro', 'TAM170', 'CHR', 'Active', '2023-03-08', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'johnmark.tamtech@gmail.com', ''),
(28, 'Christian  Delos Reyes', 'TAM171', 'Investors Adv. Grp', 'Active', '2023-03-10', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'carlosbernales24@gmail.com', ''),
(29, 'Kathy Silvano', 'TAM175', 'Cold Calls/EM Calls', 'Active', '2023-03-21', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'kathysilvano.tamtech@gmail.com', ''),
(30, 'Maria Cristina Montoya', 'TAM177', 'Cold Calls/ CHR', 'Active', '2023-04-01', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'mariachristina.tamtech@gmail.com', ''),
(31, 'Jhon Jhon Maranan', 'TAM181', 'Cold Calls', 'Active', '2023-07-24', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'jhonjhon.tamtech@gmail.com', ''),
(32, 'Lovey Doren Sega', 'TAM182', 'CHR AF', 'Active', '2023-09-04', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'lovelydoren.tamtech@gmail.com', ''),
(33, 'Lovely Maranan', 'TAM188', 'Cold Calls', 'Active', '2023-10-02', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'lovelymaranan.tamtech@gmail.com', ''),
(34, 'Mary Grace Tisuela', 'TAM189', 'CHR Admin', 'Active', '2023-12-04', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'marygrace.tamtech@gmail.com', ''),
(35, 'Marc Richard Villaluna', 'TAM190', 'CHR Admin', 'Active', '2024-01-17', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'richard.tamtech@gmail.com', ''),
(36, 'Donna Mae Umali', 'TAM191', 'Cold Calls', 'Active', '2024-01-22', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'donnamae.tamtech@gmail.com', ''),
(37, 'Charlene Sierra', 'TAM192', 'Cold Calls', 'Active', '2024-01-22', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'charlene.tamtech@gmail.com', ''),
(38, 'John Mark Logmao', 'TAM193', 'Cold Calls', 'Active', '2024-01-22', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'johnmarklogmao.tamtech@gmail.com', ''),
(39, 'Christine Rago', 'TAM194', 'Data Entry', 'Active', '2024-01-31', 100.00, 200.00, 0.00, 395.00, '08:00:00', 500.00, 'christine.tamtechhub@gmail.com', ''),
(40, 'Mary Joy Gara', 'TAM195', 'EM Compliance', 'Active', '2024-02-19', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'maryjoygara.tamtech@gmail.com', ''),
(41, 'Ian John Mari Namuco', 'TAM196', 'Data Entry', 'Active', '2024-02-22', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'ian.tamtechhub.com@gmail.com', ''),
(42, 'Freeda Alexis Enriquez', 'TAM197', 'Cold Calls', 'Active', '2024-02-26', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'freeda.tamtech@gmail.com', ''),
(43, 'Keren Ada', 'TAM200', 'Cold Calls', 'Active', '2024-02-24', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'keren.tamtech@gmail.com ', ''),
(44, 'Dianna Rose Matudio', 'TAM043', 'Elephant', 'Active', '2018-03-23', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'dianna@elephantintheboardroom.com.au', ''),
(45, 'Jayzel Ara Mae Dicdican', 'EITB007', 'Elephant', 'Active', '2021-02-01', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'jayzel@elephantintheboardroom.ph', ''),
(46, 'Myca Lovelle Ponce', 'EITB010', 'Elephant ', 'Active', '2022-09-05', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'myca@elephantintheboardroom.ph', ''),
(47, 'Andrei Ivan De Guzman', 'EITB012', 'Elephant ', 'Active', '2022-09-26', 100.00, 200.00, 500.00, 400.00, '08:00:00', 500.00, 'andrei@elephantintheboardroom.ph', ''),
(48, 'Jan Ivan Reña', 'EITB006', 'Elephant ', 'Active', '2023-01-03', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'ivan@elephantintheboardroom.ph', ''),
(49, 'Krysha Aimee Grace Madriaga', 'EITB013', 'Elephant ', 'Active', '2023-03-06', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'krysha@elephantintheboardroom.ph', ''),
(50, 'Kai Yue Cheong', 'EITB014', 'Elephant ', 'Active', '2023-08-09', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'kai@elephantintheboardroom.ph', ''),
(51, 'Shiela Rogene Carena', 'EITB015', 'Elephant ', 'Active', '2024-01-15', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'shiela@elephantintheoardroom.in', ''),
(52, 'Redney Panopio', 'None', 'None', 'Active', NULL, 0.00, 0.00, 0.00, 0.00, '00:00:00', 0.00, '', ''),
(53, 'Rosenie Villanueva', 'None', 'Nones', 'Active', NULL, 0.00, 0.00, 0.00, 0.00, '00:00:00', 0.00, '', ''),
(54, 'Leniel Mampusti ', 'TAM201', 'Cold Calls', 'Active', '2024-04-15', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'leniel.tamtech@gmail.com', ''),
(55, 'Roel Paulo Telmo', 'EITB016', 'Elephant ', 'Active', '2024-04-02', 0.00, 200.00, 0.00, 395.00, '08:00:00', 0.00, 'roel@elephantintheboardroom.co.in', ''),
(63, 'Princess Joy Roncali', 'TAM202', 'Cold Calls', 'Active', '2024-04-29', 0.00, 0.00, 0.00, 395.00, '08:00:00', 0.00, 'princess.tamtech@gmail.com', ''),
(71, 'sd', 'dsdddsd', 'sd', 'Active', '0000-00-00', 0.00, 0.00, 0.00, 0.00, '00:00:00', 0.00, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `agent_monitor`
--

CREATE TABLE `agent_monitor` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL,
  `agent` varchar(255) NOT NULL,
  `monitor_one` varchar(255) NOT NULL,
  `monitor_one_fk` int NOT NULL,
  `monitor_two` varchar(255) NOT NULL,
  `monitor_two_fk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agent_monitor`
--

INSERT INTO `agent_monitor` (`id`, `agent_fk_id`, `agent`, `monitor_one`, `monitor_one_fk`, `monitor_two`, `monitor_two_fk`) VALUES
(7, 5, 'Carl Lorenz Villaluna', 'MTR05-Tamtech', 8, 'MTR06-Tamtech', 9),
(8, 21, 'Irene Rose Sega', 'MTR02-Tamtech', 2, 'None', 0),
(9, 37, 'Charlene Sierra', 'MTR22-Tamtech', 28, 'None', 0),
(10, 24, 'Nic Orlyn Mercado', 'MTR22-Tamtech', 29, 'None', 0),
(11, 20, 'Cathreen Joyce Jimenez', 'MTR63-Tamtech', 36, 'None', 0),
(12, 3, 'Reynato Froisland', 'MTR64-Tamtech', 37, 'None', 0),
(13, 51, 'Shiela Rogene Carena', 'MTR15-Tamtech', 18, 'None', 0),
(14, 9, 'Fitz Gerald  Geraldizo ', 'MTR07-Tamech', 10, 'MTR08-Tamtech', 11),
(15, 31, 'Jhon Jhon Maranan', 'MTR04-Tamtech', 7, 'MTR11-Tamtech', 14),
(16, 42, 'Freeda Alexis Enriquez', 'MNT33-Tamtech', 38, 'MNT34-Tamtech', 39),
(17, 10, 'Ivan  Vincent Alfred Neil Agleron', 'MNT65-Tamtech', 40, 'MTR01-Tamtech', 1),
(18, 45, 'Jayzel Ara Mae Dicdican', 'MTR16-Tamtech', 19, 'None', 0),
(19, 49, 'Krysha Aimee Grace Madriaga', 'MTR14-Tamtech', 17, 'None', 0),
(20, 46, 'Myca Lovelle Ponce', 'MTR67-Tamtech', 41, 'None', 0),
(21, 47, 'Andrei Ivan De Guzman', 'MTR17-Tamtech', 20, 'None', 0),
(22, 50, 'Kai Yue Cheong', 'MTR18-Tamtech', 21, 'None', 0),
(23, 55, 'Roel Paulo Telmo', 'MTR19-Tamtech', 22, 'None', 0),
(24, 48, 'Jan Ivan Reña', 'MTR20-Tamtech', 23, 'None', 0),
(25, 35, 'Marc Richard Villaluna', 'MTR24-Tamtech', 26, 'None', 0),
(26, 27, 'John Mark  Castro', 'MTR40-Tamtech', 44, 'MTR41-Tamtech', 45),
(27, 34, 'Mary Grace Tisuela', 'MTR42-Tamtech', 46, 'MTR43-Tamtech', 47),
(28, 7, 'Ro Anne Sarmiento', 'MTR55-Tamtech', 48, 'MTR56-Tamtech', 49),
(29, 26, 'Christian Ralph Ilagan', 'MTR35-Tamtech', 51, 'MTR36-Tamtech', 50),
(30, 54, 'Leniel Mampusti ', 'MTR02-Tamtech', 52, 'None', 0),
(31, 39, 'Christine Rago', 'MTR23-Tamtech', 25, 'None', 0),
(32, 38, 'John Mark Logmao', 'MTR25-Tamtech', 31, 'MTR26-Tamtech', 32),
(33, 17, 'Matthew Del Rosario', 'MTR27-Tamtech', 33, 'MTR28-Tamtech', 34),
(34, 43, 'Keren Ada', 'MTR27-Tamtech', 53, 'MTR28-Tamtech', 54),
(35, 63, 'Princess Joy Roncali', 'MTR29-Tamtech', 35, 'MTR30-Tamtech', 55),
(36, 25, 'Joel  Catague Jr. ', 'MTR31-Tamtech', 56, 'MTR32-Tamtech', 57),
(37, 36, 'Donna Mae Umali', 'MTR37-Tamtech', 58, 'None', 0);

-- --------------------------------------------------------

--
-- Table structure for table `agent_payslips`
--

CREATE TABLE `agent_payslips` (
  `id` int NOT NULL,
  `attendance_bonus` double(10,2) NOT NULL,
  `spiff_incentive` double(10,2) NOT NULL,
  `overtime_pay` double(10,2) NOT NULL,
  `nd_pay` double(10,2) NOT NULL,
  `ndOt_pay` double(10,2) NOT NULL,
  `other_add` double(10,2) NOT NULL,
  `gross_pay` double(10,2) NOT NULL,
  `late_deduction` double(10,2) NOT NULL,
  `undertime_deduction` double(10,2) NOT NULL,
  `sss_deduction` double(10,2) NOT NULL,
  `pag_ibig_deduction` double(10,2) NOT NULL,
  `philhealth_deduction` double(10,2) NOT NULL,
  `sss_loan` double(10,2) NOT NULL,
  `house_rent` double(10,2) NOT NULL,
  `other_deduction` double(10,2) NOT NULL,
  `total_deduction` double(10,2) NOT NULL,
  `total_net_pay` double(10,2) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `end_date` date NOT NULL,
  `startDate` date NOT NULL,
  `payslip_no` varchar(255) NOT NULL,
  `base_pay` double(10,2) NOT NULL,
  `pag_ibig_loan` double(10,2) NOT NULL,
  `others_add_comment` text NOT NULL,
  `others_deduc_comment` text NOT NULL,
  `cash_advance` double(10,2) NOT NULL,
  `camp_allowance` double(10,2) NOT NULL,
  `other_addPay_one` double(10,2) NOT NULL,
  `otherAddComment_one` text NOT NULL,
  `Otherdeduc_one` double(10,2) NOT NULL,
  `DeducComment_one` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `daily_salary` double(10,2) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_in` text NOT NULL,
  `time_out` text NOT NULL,
  `late_count` time NOT NULL,
  `early_out` time NOT NULL,
  `night_diff` time NOT NULL,
  `ovetime` time NOT NULL,
  `nd_overtime` time NOT NULL,
  `actual_work` time NOT NULL,
  `required_work` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `day_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `agent_name`, `daily_salary`, `agent_id`, `date`, `time_in`, `time_out`, `late_count`, `early_out`, `night_diff`, `ovetime`, `nd_overtime`, `actual_work`, `required_work`, `status`, `day_status`) VALUES
(1, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-04', '8:54 AM', '12:08 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(2, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-05', '4:03 PM', 'None', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '08:00:00', 'OFF/Holiday', 'OFF/Holiday'),
(3, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-06', 'None', 'None', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(4, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-07', 'None', 'None', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '08:00:00', 'Absent', 'REG/Holiday'),
(5, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-08', '7:59 AM', '5:02 PM', '00:02:00', '01:05:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(6, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-09', '7:34 PM', 'None', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '08:00:00', 'Holiday Leave', 'Holiday Leave'),
(7, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-10', '7:02 AM', '5:15 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(8, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-11', '8:33 AM, 7:53 PM', '2:03 PM, 11:59 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(9, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-12', '9:17 AM', '5:39 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(10, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-13', 'None', 'None', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '08:00:00', 'OFF', 'Normal day'),
(11, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-14', 'None', 'None', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '08:00:00', 'OFF', 'Normal day'),
(12, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-15', '8:17 AM, 5:32 PM', '12:15 PM, 8:33 PM', '00:05:00', '01:12:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(13, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-20', '8:17 AM, 5:32 PM', '12:15 PM, 8:33 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(14, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-21', '8:17 AM, 5:32 PM', '12:15 PM, 8:33 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day'),
(15, 'Christian  Delos Reyes', 395.00, 'TAM171', '2024-04-22', '8:17 AM, 5:32 PM', '12:15 PM, 8:33 PM', '00:00:00', '00:00:00', '07:00:00', '05:00:00', '02:00:00', '08:00:00', '08:00:00', 'Present', 'Normal day');

-- --------------------------------------------------------

--
-- Table structure for table `headset`
--

CREATE TABLE `headset` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `agent` varchar(255) NOT NULL DEFAULT 'None',
  `equip_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `model` varchar(255) NOT NULL DEFAULT 'No Model',
  `condition` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `headset`
--

INSERT INTO `headset` (`id`, `agent_fk_id`, `agent`, `equip_id`, `status`, `brand`, `model`, `condition`, `comment`) VALUES
(3, 0, 'None', 'HST02-Tamtech', 'Unassigned', 'Plantronics', 'Plantronics Black Wire 325.1', 'Frequently Used', 'First Owner'),
(4, 31, 'Jhon Jhon Maranan', 'HST03-Tamtech', 'Assigned', 'Plantronics', 'Plantronics C520M', 'Frequently Used', 'No Comment'),
(5, 5, 'Carl Lorenz Villaluna', 'HST04-Tamtech', 'Assigned', 'Inplay', 'Inplay HN620', 'Frequently Used', 'No Foam'),
(7, 9, 'Fitz Gerald  Geraldizo ', 'HST05-Tamtech', 'Assigned', 'Inplay', 'Inplay HN620', 'Frequently Used', 'No Foam'),
(8, 23, 'Melanie Basaka', 'HST06-Tamtech', 'Assigned', 'Plantronics', 'Plantronics Black Wire 325.1', 'Frequently Used', 'No Comment'),
(9, 20, 'Cathreen Joyce Jimenez', 'HST07-Tamtech', 'Assigned', 'Plantronics', '3-Plantronics DA80', 'Frequently Used', 'Wire has tape'),
(10, 39, 'Christine Rago', 'HST23-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'Frequently Used', 'Wire has tape'),
(12, 35, 'Marc Richard Villaluna', 'HST24-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA70', 'Frequently Used', 'Wire has tape'),
(14, 0, 'None', 'HST22-Tamtech', 'Unassigned', 'Jabra', 'BIZ 2400 II', 'New', 'No Comment'),
(15, 24, 'Nic Orlyn Mercado', 'HST22-Tamtech', 'Assigned', 'Jabra', 'BIZ 2400 II', 'Reassigned', 'No Comment'),
(16, 33, 'Lovely Maranan', 'HST21-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'New', 'Wire has tape'),
(17, 38, 'John Mark Logmao', 'HST25-Tamtech', 'Assigned', 'Dell', 'UC150', 'New', 'No Comment'),
(18, 17, 'Matthew Del Rosario', 'HST26-Tamtech', 'Assigned', 'Jabra', 'BIZ 2300', 'Frequently Used', 'No Comment'),
(19, 63, 'Princess Joy Roncali', 'HST27-Tamtech', 'Assigned', 'Logitech', 'Logitech', 'Frequently Used', 'No Comment'),
(20, 25, 'Joel  Catague Jr. ', 'HST28-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'New', 'No Comment'),
(21, 14, 'Manuel Ray Ferrer', 'HST43-Tamtech', 'Assigned', 'Jabra', 'BIZ 2400 II', 'New', 'No Comment'),
(22, 12, 'Sheila Laine Cayas', 'HST09-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'Frequently Used', 'No Comment'),
(23, 13, 'Charybeth  Dalisay', 'HST10-Tamtech', 'Assigned', 'Plantronics', 'Plantronics Black Wire 325.1', 'Frequently Used', 'No Comment'),
(24, 36, 'Donna Mae Umali', 'HST36-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'Frequently Used', 'No Comment'),
(25, 0, 'NULL', 'HST30-Tamtech', 'Unserviceable', 'Logitech', 'Logitech', 'Frequently Used', 'No Audio Input'),
(26, 0, 'None', 'HST44-Tamtech', 'Unassigned', 'Jabra', 'BIZ 2300', 'New', 'No Comment'),
(27, 27, 'John Mark  Castro', 'HST33-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'Frequently Used', 'Wire has tape'),
(28, 34, 'Mary Grace Tisuela', 'HST34-Tamtech', 'Assigned', 'Plantronics', 'Plantronics Black Wire 325.1', 'Frequently Used', 'No Comment'),
(29, 42, 'Freeda Alexis Enriquez', 'HST29-Tamtech', 'Assigned', 'Jabra', 'BIZ 2400 II', 'New', 'No Comment'),
(30, 51, 'Shiela Rogene Carena', 'HST15-Tamtech', 'Assigned', 'Plantronics', 'DA80', 'New', 'No Comment'),
(31, 37, 'Charlene Sierra', 'HST11-Tamtech', 'Assigned', 'Plantronics', 'DA80', 'Frequently Used', 'No Comment'),
(32, 10, 'Ivan  Vincent Alfred Neil Agleron', 'HST45-Tamtech', 'Assigned', 'Plantronics', 'Blackwire 325.1', 'New', 'No Comment'),
(33, 45, 'Jayzel Ara Mae Dicdican', 'HST16-Tamtech', 'Assigned', 'Plantronics', 'DA70', 'Frequently Used', 'No Comment'),
(34, 49, 'Krysha Aimee Grace Madriaga', 'HST14-Tamtech', 'Assigned', 'Inplay', 'HN620', 'Frequently Used', 'No Comment'),
(35, 46, 'Myca Lovelle Ponce', 'HST13-Tamtech', 'Assigned', 'Inplay', 'HN620', 'Frequently Used', 'No Comment'),
(36, 47, 'Andrei Ivan De Guzman', 'HST17-Tamtech', 'Assigned', 'Logitech', 'Logitech', 'Frequently Used', 'No Comment'),
(37, 50, 'Kai Yue Cheong', 'HST18-Tamtech', 'Assigned', 'Plantronics', 'DA70', 'Frequently Used', 'No Comment'),
(38, 55, 'Roel Paulo Telmo', 'HST19-Tamtech', 'Assigned', 'Logitech', 'Logitech', 'Frequently Used', 'No Comment'),
(39, 48, 'Jan Ivan Reña', 'HST20-Tamtech', 'Assigned', 'Inplay', 'HN620', 'Frequently Used', 'No Comment'),
(40, 7, 'Ro Anne Sarmiento', 'HST41-Tamtech', 'Assigned', 'Logitech', 'Logitech', 'Frequently Used', 'No Comment'),
(41, 26, 'Christian Ralph Ilagan', 'HST40-Tamtech', 'Assigned', 'Plantonics', 'Blackwire 325.1', 'Frequently Used', 'No Comment'),
(43, 21, 'Irene Rose Sega', 'HST01-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'Frequently Used', 'Wire has tape'),
(44, 54, 'Leniel Mampusti ', 'HST01-Tamtech', 'Assigned', 'Plantronics', 'Plantronics DA80', 'Frequently Used', 'Wire has tape'),
(45, 43, 'Keren Ada', 'HST26-Tamtech', 'Assigned', 'Jabra', 'Biz 2300', 'Frequently Used', 'No Comment'),
(46, 22, 'Dhenniel Nivar Enrile', 'HST35-Tamtech', 'Assigned', 'Logitech', 'Logitech', 'Frequently Used', 'No Comment');

-- --------------------------------------------------------

--
-- Table structure for table `keyboard`
--

CREATE TABLE `keyboard` (
  `id` int NOT NULL,
  `agent` varchar(255) NOT NULL DEFAULT 'None',
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `keyboard_equip_id` varchar(255) NOT NULL,
  `keyboard_status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `keyboard_brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `keyboard_model` varchar(255) NOT NULL DEFAULT 'No Model',
  `keyboard_condition` varchar(255) NOT NULL,
  `keyboard_comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keyboard`
--

INSERT INTO `keyboard` (`id`, `agent`, `agent_fk_id`, `keyboard_equip_id`, `keyboard_status`, `keyboard_brand`, `keyboard_model`, `keyboard_condition`, `keyboard_comment`) VALUES
(1, 'Charlene Sierra', 37, 'KBD01-Tamtech', 'Assigned', 'Rapoo', 'NK17000', 'Frequently Used', 'No Comment'),
(3, 'Irene Rose Sega', 21, 'KBD02-Tamtech', 'Assigned', 'Rapoo', 'NK17000', 'Frequently Used', 'No Comment'),
(4, 'Roel Paulo Telmo', 55, 'KBD03-Tamtech', 'Assigned', 'Rapoo', 'NK17000', 'Frequently Used', 'No Comment'),
(5, 'Jhon Jhon Maranan', 31, 'KBD04-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(6, 'Carl Lorenz Villaluna', 5, 'KBD05-Tamtech', 'Assigned', 'Rapoo', 'NK17000', 'Frequently Used', 'No Comment'),
(7, 'Fitz Gerald  Geraldizo ', 9, 'KBD06-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(8, 'Melanie Basaka', 23, 'KBD07-Tamech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(9, 'Cathreen Joyce Jimenez', 20, 'KBD08-Tamtech', 'Assigned', 'HP	', 'KM100', 'Frequently Used', 'No Comment'),
(10, 'None', 0, 'KBD21-Tamtech', 'Unassigned', 'HP	', 'KM100', 'Frequently Used', 'No Comment'),
(11, 'Nic Orlyn Mercado', 24, 'KBD21-Tamtech', 'Assigned', 'HP	', 'KM100', 'Reassigned', 'No Comment'),
(12, 'Lovely Maranan', 33, 'KBD20-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(13, 'John Mark Logmao', 38, 'KBD24-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(14, 'Matthew Del Rosario', 17, 'KBD25-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(15, 'Princess Joy Roncali', 63, 'KBD26-Tamtech', 'Assigned', 'HP	', 'KM100', 'Frequently Used', 'No Comment'),
(16, 'Joel  Catague Jr. ', 25, 'KBD27-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(17, 'Manuel Ray Ferrer', 14, 'KBD44-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(18, 'Sheila Laine Cayas', 12, 'KBD09-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(19, 'Charybeth  Dalisay', 13, 'KBD10-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(20, 'Donna Mae Umali', 36, 'KBD32-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(21, 'Ivan  Vincent Alfred Neil Agleron', 10, 'KBD31-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(22, 'None', 0, 'KBD30-Tamtech', 'Unassigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(23, 'None', 0, 'KBD33-Tamtech', 'Unassigned', 'HP	', 'KM100', 'Frequently Used', 'No Comment'),
(24, 'John Mark  Castro', 27, 'KBD29-Tamtech', 'Assigned', 'HP	', 'KM100', 'Frequently Used', 'No Comment'),
(25, 'Mary Grace Tisuela', 34, 'KBD34-Tamtech', 'Assigned', 'HP	', 'KM100', 'Frequently Used', 'No Comment'),
(26, 'Freeda Alexis Enriquez', 42, 'KBD28-Tamtech', 'Assigned', 'Rapoo	', 'NK17000', 'Frequently Used', 'No Comment'),
(27, 'Reynato Froisland', 3, 'KBD12-Tamtech', 'Assigned', 'Rapoo', 'NK1700', 'New', 'No Comment'),
(28, 'Shiela Rogene Carena', 51, 'KBD15-Tamtech', 'Assigned', 'HP', 'KM100', 'New', 'No Comment'),
(29, 'None', 0, 'KBD11-Tamtech', 'Unassigned', 'Rapoo', 'NK1700', 'Frequently Used', 'No Comment'),
(30, 'Jayzel Ara Mae Dicdican', 45, 'KBD16-Tamtech', 'Assigned', 'HP', 'KM100', 'New', 'No Comment'),
(31, 'Krysha Aimee Grace Madriaga', 49, 'KBD14-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(32, 'Myca Lovelle Ponce', 46, 'KBD13-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(33, 'Andrei Ivan De Guzman', 47, 'KBD17-Tamtech', 'Assigned', 'Rapoo', 'NK1700', 'Frequently Used', 'No Comment'),
(34, 'Kai Yue Cheong', 50, 'KBD18-Tamtech', 'Assigned', 'Rapoo', 'NK1700', 'Frequently Used', 'No Comment'),
(35, 'Jan Ivan Reña', 48, 'KBD19-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(36, 'Ro Anne Sarmiento', 7, 'KBD43-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(37, 'Christian Ralph Ilagan', 26, 'KBD45-Tamtech', 'Assigned', 'HP', 'SK-2025', 'Frequently Used', 'No Comment'),
(38, 'Leniel Mampusti ', 54, 'KBD02-Tamtech', 'Assigned', 'Rapoo', 'NK17000', 'Frequently Used', 'No Comment'),
(39, 'Christine Rago', 39, 'KBD22-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(40, 'Marc Richard Villaluna', 35, 'KBD23-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(41, 'Keren Ada', 43, 'KBD25-Tamtech', 'Assigned', 'Rapoo', 'NK1700', 'Frequently Used', 'No Comment'),
(42, 'None', 0, 'KBD37-Tamtech', 'Unassigned', 'Rapoo', 'NK1700', 'Frequently Used', 'No Comment');

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE `laptop` (
  `id` int NOT NULL,
  `laptop_agent` varchar(255) NOT NULL DEFAULT 'None',
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `laptop_equip_id` varchar(255) NOT NULL,
  `laptop_status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `laptop_model` varchar(255) NOT NULL DEFAULT 'No Model',
  `laptop_brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `laptop_ram` varchar(255) NOT NULL,
  `laptop_processor` varchar(255) NOT NULL,
  `laptop_storage` varchar(255) NOT NULL,
  `laptop_condition` varchar(255) NOT NULL,
  `laptop_comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`id`, `laptop_agent`, `agent_fk_id`, `laptop_equip_id`, `laptop_status`, `laptop_model`, `laptop_brand`, `laptop_ram`, `laptop_processor`, `laptop_storage`, `laptop_condition`, `laptop_comment`) VALUES
(1, 'None', 0, 'LPT01-Tamtech', 'Unassigned', 'Thinkpad T490s', 'Lenovo', '8GB', 'Core i5', 'SSD', 'New', 'Without Charger'),
(2, 'None', 0, 'LPT02-Tamtech', 'Unassigned', 'Thinkpad T470s', 'Lenovo', '8GB', 'Core i5', 'SSD', 'New', 'With charger'),
(3, 'NULL', 0, 'LPT03-Tamtech', 'Unserviceable', 'Thinkpad X201i', 'Lenovo', '8GB', 'Core i5', 'SSD', 'Frequently Used', 'Blue screen '),
(4, 'Dianna Rose Matudio', 44, 'LPT04-Tamtech', 'Assigned', 'Thinkpad T470s', 'Lenovo', '8GB', 'Core i5', 'SSD', 'New', 'With charger'),
(5, 'Ezekiel Telmo', 2, 'LPT05-Tamtech', 'Assigned', 'Thinkpad T460s', 'Lenovo', '8GB', 'Core i5', 'SSD', 'New', 'With charger'),
(6, 'Ro Anne Sarmiento', 7, 'LPT06-Tamtech', 'Assigned', 'Thinkpad T490s', 'Lenovo', '8GB', 'Core i5', 'SSD', 'New', 'Without Charger'),
(7, 'Ocean Mark Temblique', 18, 'LPT07-Tamtech', 'Assigned', 'None', 'No Brand', 'None', 'None', 'None', 'None', 'No Comment'),
(8, 'Wendell Lozano', 6, 'LPT08-Tamtech', 'Assigned', 'Thinkpad X201i', 'Lenovo', '4GB', 'Core i3', 'SSD', 'Frequently Used', 'Old Model');

-- --------------------------------------------------------

--
-- Table structure for table `locker`
--

CREATE TABLE `locker` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `locker_no` varchar(255) NOT NULL,
  `locker_agent` varchar(255) NOT NULL DEFAULT 'None',
  `locker_tool_id` varchar(255) NOT NULL,
  `locker_status` varchar(255) NOT NULL DEFAULT 'Non-Occupied',
  `locker_condition` varchar(255) NOT NULL,
  `locker_comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locker`
--

INSERT INTO `locker` (`id`, `agent_fk_id`, `locker_no`, `locker_agent`, `locker_tool_id`, `locker_status`, `locker_condition`, `locker_comment`) VALUES
(1, 42, '4FL-01', 'Freeda Alexis Enriquez', 'LCK-01-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(2, 52, '4FL-02', 'Redney Panopio', 'LCK-02-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(3, 0, '4FL-03', 'None', 'LCK-03-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(4, 18, '4FL-04', 'Ocean Mark Temblique', 'LCK-04-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(5, 53, '4FL-05', 'Rosenie Villanueva', 'LCK-05-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(6, 0, '4FL-06', 'None', 'LCK-06-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(7, 30, '4FL-07', 'Maria Cristina Montoya', 'LCK-07-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(8, 31, '4FL-08', 'Jhon Jhon Maranan', 'LCK-08-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(9, 32, '4FL-09', 'Lovey Doren Sega', 'LCK-09-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(10, 33, '4FL-10', 'Lovely Maranan', 'LCK-10-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(11, 50, '4FL-11', 'Kai Yue Cheong', 'LCK-11-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(12, 51, '4FL-12', 'Shiela Rogene Carena', 'LCK-12-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(13, 34, '4FL-13', 'Mary Grace Tisuela', 'LCK-13-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(14, 0, '4FL-14', 'None', 'LCK-14-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(15, 35, '4FL-15', 'Marc Richard Villaluna', 'LCK-15-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(16, 5, '4FL-16', 'Carl Lorenz Villaluna', 'LCK-16-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(17, 43, '4FL-17', 'KEREN ADA', 'LCK-17-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(18, 0, '4FL-18', 'None', 'LCK-18-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(19, 36, '4FL-19', 'Donna Mae Umali', 'LCK-19-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(20, 37, '4FL-20', 'Charlene Sierra', 'LCK-20-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(21, 38, '4FL-21', 'John Mark Logmao', 'LCK-21-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(22, 39, '4FL-22', 'Christine Rago', 'LCK-22-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(23, 40, '4FL-23', 'Mary Joy Gara', 'LCK-23-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(24, 41, '4FL-24', 'Ian John Mari Namuco', 'LCK-24-TAMTECH', 'Occupied', 'Good', 'No Comment'),
(25, 0, '4FL-25', 'None', 'LCK-25-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(26, 0, '4FL-26', 'None', 'LCK-26-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(27, 0, '4FL-27', 'None', 'LCK-27-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(28, 0, '4FL-28', 'None', 'LCK-28-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(29, 0, '4FL-29', 'None', 'LCK-29-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(30, 0, '4FL-30', 'None', 'LCK-30-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(31, 0, '4FL-31', 'None', 'LCK-31-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(32, 0, '4FL-32', 'None', 'LCK-32-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(33, 0, '4FL-33', 'None', 'LCK-33-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(34, 0, '4FL-34', 'None', 'LCK-34-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(35, 0, '4FL-35', 'None', 'LCK-35-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(36, 0, '4FL-36', 'None', 'LCK-36-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(37, 0, '4FL-37', 'None', 'LCK-37-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(38, 0, '4FL-38', 'None', 'LCK-38-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(39, 0, '4FL-39', 'None', 'LCK-39-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(40, 0, '4FL-40', 'None', 'LCK-40-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(41, 0, '4FL-41', 'None', 'LCK-41-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(42, 0, '4FL-42', 'None', 'LCK-42-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(43, 0, '4FL-43', 'None', 'LCK-43-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(44, 0, '4FL-44', 'None', 'LCK-44-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(45, 0, '4FL-45', 'None', 'LCK-45-TAMTECH', 'Non-Occupied', 'Good', 'No Comment'),
(46, 2, '5FL-01', 'Ezekiel Telmo', 'LCK-46-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(47, 3, '5FL-02', 'Reynato Froisland', 'LCK-47-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(48, 4, '5FL-03', 'Jaynelle Bumacod', 'LCK-48-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(49, 0, '4FL-49', 'None', 'LCK-49-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(50, 6, '5FL-05', 'Wendell Lozano', 'LCK-50-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(51, 7, '5FL-06', 'Ro Anne Sarmiento', 'LCK-51-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(52, 8, '5FL-07', 'Diana Lyn Lim', 'LCK-52-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(53, 9, '5FL-08', 'Fitz Gerald  Geraldizo ', 'LCK-53TAMTECH', 'Occupied', 'Great', 'No Comment'),
(54, 10, '5FL-09', 'Ivan  Vincent Alfred Neil Agleron', 'LCK-54-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(55, 11, '5FL -10', 'Marlean Batas', 'LCK-55-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(56, 12, '5FL-11', 'Sheila Laine Cayas', 'LCK-56-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(57, 13, '5FL-12', 'Charybeth  Dalisay', 'LCK-57-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(58, 14, '5FL-13', 'Manuel Ray Ferrer', 'LCK-58-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(59, 15, '5FL-14', 'Khanyawtay Gorospe', 'LCK-59-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(60, 16, '5FL-15', 'Francis Calayag II', 'LCK-60-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(61, 17, '5FL-16', 'Matthew Del Rosario', 'LCK-61-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(62, 0, '5FL-17', 'None', 'LCK-62-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(63, 19, '5FL-18', 'Kristine  Tejida', 'LCK-63-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(64, 20, '5FL-19', 'Cathreen Joyce Jimenez', 'LCK-64-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(65, 21, '5FL-20', 'Irene Rose Sega', 'LCK-65-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(66, 22, '5FL-21', 'Dhenniel Nivar Enrile', 'LCK-66-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(67, 23, '5FL-22', 'Melanie Basaka', 'LCK-67-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(68, 24, '5FL-23', 'Nic Orlyn Mercado', 'LCK-68-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(69, 25, '5FL-24', 'Joel  Catague Jr. ', 'LCK-69-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(70, 26, '5FL-25', 'Christian Ralph Ilagan', 'LCK-70-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(71, 27, '5FL-26', 'John Mark  Castro', 'LCK-71-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(72, 28, '5FL-27', 'Christian  Delos Reyes', 'LCK-72-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(73, 29, '5FL-28', 'Kathy Silvano', 'LCK-73-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(74, 44, '5FL-29', 'Dianna Rose Matudio', 'LCK-74-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(75, 45, '5FL-30', 'Jayzel Ara Mae Dicdican', 'LCK-75-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(76, 46, '5FL-31', 'Myca Lovelle Ponce', 'LCK-76-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(77, 47, '5FL-32', 'Andrei Ivan De Guzman', 'LCK-77-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(78, 48, '5FL-33', 'Jan Ivan Reña', 'LCK-78-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(79, 49, '5FL-34', 'Krysha Aimee Grace Madriaga', 'LCK-79-TAMTECH', 'Occupied', 'Great', 'No Comment'),
(80, 0, '5FL-35', 'None', 'LCK-80-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(81, 0, '5FL-36', 'None', 'LCK-81-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(82, 0, '5FL-37', 'None', 'LCK-82-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(83, 0, '5FL-38', 'None', 'LCK-83-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(84, 0, '5FL-39', 'None', 'LCK-84-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(85, 0, '5FL-40', 'None', 'LCK-85-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(86, 0, '5FL-41', 'None', 'LCK-86-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(87, 0, '5FL-42', 'None', 'LCK-87-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(88, 0, '5FL-43', 'None', 'LCK-88-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(89, 0, '5FL-44', 'None', 'LCK-89-TAMTECH', 'Non-Occupied', 'Great', 'No Comment'),
(90, 0, '5FL-45', 'None', 'LCK-90-TAMTECH', 'Non-Occupied', 'Great', 'No Comment');

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `station_no` varchar(255) NOT NULL DEFAULT 'None',
  `static_ip` varchar(255) NOT NULL DEFAULT 'None',
  `agent` varchar(255) NOT NULL DEFAULT 'None',
  `equip_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `model` varchar(255) NOT NULL DEFAULT 'No Model',
  `ram_size` varchar(255) NOT NULL DEFAULT 'No RAM',
  `processor` varchar(255) NOT NULL DEFAULT 'No Processor',
  `storage_type` varchar(255) NOT NULL DEFAULT 'No Storage',
  `conditions` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `agent_fk_id`, `station_no`, `static_ip`, `agent`, `equip_id`, `status`, `brand`, `model`, `ram_size`, `processor`, `storage_type`, `conditions`, `comment`) VALUES
(1, 37, '5thFloor - 024', '172.16.2.166', 'Charlene Sierra', 'CPU01-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '4GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(2, 54, '5thFloor - 002', '172.16.2.167', 'Leniel Mampusti ', 'CPU02-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(3, 14, '5thFloor - 003', '172.16.2.168', 'Manuel Ray Ferrer', 'CPU43-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '4GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(4, 15, '', 'No Static IP', 'Khanyawtay Gorospe', 'CPU04-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '4GB', 'Core i3', 'SSD', 'Old Model', 'WFH'),
(5, 5, '5thFloor - 005', '172.16.2.170', 'Carl Lorenz Villaluna', 'CPU05-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '8GB', 'Core i5', 'SSD', 'New Model', 'No Comment'),
(6, 9, '5thFloor - 006', '172.16.2.171', 'Fitz Gerald  Geraldizo ', 'CPU06-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '12GB', 'Core i5', 'SSD', 'New Model', 'No Comment'),
(8, 20, '5thFloor - 008', '172.16.2.173', 'Cathreen Joyce Jimenez', 'CPU08-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(9, 31, '5thFloor - 004', '172.16.2.169', 'Jhon Jhon Maranan', 'CPU09-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(10, 12, '5thFloor - 009', '172.16.2.174', 'Sheila Laine Cayas', 'CPU44-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(11, 23, '5thFloor - 010', '172.16.2.175', 'Melanie Basaka', 'CPU45-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(12, 40, '5thFloor - 011', '172.16.2.176', 'Mary Joy Gara', 'CPU10-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '4GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(13, 3, '5thFloor - 012', '172.16.2.177', 'Reynato Froisland', 'CPU11-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '4GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(14, 45, '5thFloor - 013', '172.16.2.178', 'Jayzel Ara Mae Dicdican', 'CPU14-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '12GB', 'Core i3', 'SSD and HDD', 'New Model', 'No Comment'),
(15, 51, '5thFloor - 014', '172.16.2.179', 'Shiela Rogene Carena', 'CPU42-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '8GB', 'Core i5', 'SSD', 'New Model', 'No Comment'),
(16, 49, '5thFloor - 015', '172.16.2.180', 'Krysha Aimee Grace Madriaga', 'CPU13-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(17, 46, '5thFloor - 016', '172.16.2.181', 'Myca Lovelle Ponce', 'CPU12-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(18, 47, '5thFloor - 017', '172.16.2.182', 'Andrei Ivan De Guzman', 'CPU15-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(19, 50, '5thFloor - 018', '172.16.2.184', 'Kai Yue Cheong', 'CPU16-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 600', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(20, 55, '5thFloor - 019', '172.16.2.184', 'Roel Paulo Telmo', 'CPU03-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(21, 48, '5thFloor - 020', '172.16.2.185', 'Jan Ivan Reña', 'CPU17-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Pro Desk 705', '8GB', 'AMD Ryzen', 'SSD', 'New Model', 'No Comment'),
(22, 35, '5thFloor - 021', '172.16.2.186', 'Marc Richard Villaluna', 'CPU21-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(27, 38, '5thFloor - 025', '172.16.2.190', 'John Mark Logmao', 'CPU25-Tamtech', 'Assigned', 'Lenovo', '10ancto1ww', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(28, 17, '5thFloor - 026', '172.16.2.191', 'Matthew Del Rosario', 'CPU24-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(29, 63, '5thFloor - 027', '172.16.2.192', 'Princess Joy Roncali', 'CPU23-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(30, 25, '5thFloor - 028', '172.16.2.193', 'Joel  Catague Jr. ', 'CPU22-Tamtech', 'Assigned', 'Lenovo', '10ancto1ww', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(32, 36, '5thFloor - 029', '172.16.2.194', 'Donna Mae Umali', 'CPU29-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '12GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(34, 0, '5thFloor - 031', '172.16.2.196', 'None', 'CPU27-Tamtech', 'Unassigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '4GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(35, 0, '5thFloor - 033', '172.16.2.197', 'None', 'CPU30-Tamtech', 'Unassigned', 'Hewlett Packard', 'HP Elite Desk 800', '12GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(36, 27, '5thFloor - 034', '172.16.2.198', 'John Mark  Castro', 'CPU31-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(37, 34, '5thFloor - 035', '172.16.2.199', 'Mary Grace Tisuela', 'CPU32-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(38, 42, '5thFloor - 032', '172.16.2.200', 'Freeda Alexis Enriquez', 'CPU26-Tamtech', 'Assigned', 'Hewlett Packard', 'HP Elite Desk 800', '8GB', 'Core i5', 'SSD', 'New Model', 'No Comment'),
(39, 0, '5thFloor - 007', '172.16.2.201', 'None', 'CPU46-Tamtech', 'Unassigned', 'LENOVO', '10ANCTOWW', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(40, 33, '5thFloor - 001', '172.16.2.189', 'Lovely Maranan', 'CPU18-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '12GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(41, 10, '5thFloor - 030', '172.16.2.202', 'Ivan  Vincent Alfred Neil Agleron', 'CPU47-Tamtech', 'Assigned', 'Lenovo', '10ANCTO1WW', '4GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(42, 7, '5thFloor-036', '172.16.2.203', 'Ro Anne Sarmiento', 'CPU41-Tamtech', 'Assigned', 'HP', 'EliteDesk 800 G1 SFF', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(43, 26, '5thFloor - 038', '172.16.2.204', 'Christian Ralph Ilagan', 'CPU39-Tamtech', 'Assigned', 'HP', 'EliteDesk 800 G1 SFF', '12GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(44, 21, '5thFloor - 002', '172.16.2.167', 'Irene Rose Sega', 'CPU02-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2 Gigabyte', '8GB', 'Core i3', 'SSD', 'New Model', 'No Comment'),
(45, 24, '5thFloor - 023', '172.16.2.188', 'Nic Orlyn Mercado', 'CPU19-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2', '4GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(46, 39, '5thFloor - 022', '172.16.2.187', 'Christine Rago', 'CPU28-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(47, 43, '5thFloor - 026', '172.16.2.191', 'Keren Ada', 'CPU24-Tamtech', 'Assigned', 'Gigabyte', 'H81M-DS2', '8GB', 'Core i3', 'SSD', 'Old Model', 'No Comment'),
(48, 0, '5thFloor - 039', '172.16.2.205', 'None', 'CPU35-Tamtech', 'Unassigned', 'HP', 'Prodesk 600 G1 SFF', '8GB', 'Core i5', 'SSD', 'New Model', 'No Comment'),
(49, 22, '5thFloor - 040', '172.16.2.206', 'Dhenniel Nivar Enrile', 'CPU34-Tamtech', 'Assigned', 'HP', 'Prodesk 600 G1 SFF', '4GB', 'Core i5', 'SSD', 'New Model', 'No Comment');

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

CREATE TABLE `monitor` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `monitor_equip_id` varchar(255) NOT NULL,
  `monitor_status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `monitor_brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `monitor_model` varchar(255) NOT NULL DEFAULT 'No Model',
  `monitor_condition` varchar(255) NOT NULL,
  `monitor_comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `monitor`
--

INSERT INTO `monitor` (`id`, `agent_fk_id`, `monitor_equip_id`, `monitor_status`, `monitor_brand`, `monitor_model`, `monitor_condition`, `monitor_comment`) VALUES
(1, 10, 'MTR01-Tamtech', 'Assigned', 'HP', 'LV1911', 'Frequently Used', 'No Comment'),
(2, 21, 'MTR02-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(3, 0, 'MTR03-Tamtech', 'Unassigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(7, 31, 'MTR04-Tamtech', 'Assigned', 'HP', 'LV1911', 'Frequently Used', 'No Comment'),
(8, 5, 'MTR05-Tamtech', 'Assigned', 'HP', 'ProDisplay P191', 'Frequently Used', 'No Comment'),
(9, 5, 'MTR06-Tamtech', 'Assigned', 'HP', 'LV1911', 'Frequently Used', 'No Comment'),
(10, 9, 'MTR07-Tamech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(11, 9, 'MTR08-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(12, 0, 'MTR09-Tamtech', 'Unassigned', 'HP', 'LV1911', 'Frequently Used', 'No Comment'),
(13, 0, 'MTR10-Tamtech', 'Unassigned', 'Lenovo', '2580-AF1', 'Frequently Used', 'No Comment'),
(14, 31, 'MTR11-Tamtech', 'Assigned', '', '', 'New', 'No Comment'),
(15, 0, 'MTR12-Tamtech', 'Unassigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'WFH'),
(16, 0, 'MTR13-Tamtech', 'Unassigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(17, 49, 'MTR14-Tamtech', 'Assigned', 'HP', 'ProDisplay P201', 'New', 'No Comment'),
(18, 51, 'MTR15-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(19, 45, 'MTR16-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(20, 47, 'MTR17-Tamtech', 'Assigned', 'HP', 'Elite Display E221c', 'New', '24\" with Camera'),
(21, 50, 'MTR18-Tamtech', 'Assigned', 'HP', 'Elite Display E221c', 'New', '24\" with Camera'),
(22, 55, 'MTR19-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(23, 48, 'MTR20-Tamtech', 'Assigned', 'HP', 'ProDisplay P201', 'New', 'No Comment'),
(24, 0, 'MTR23-Tamtech', 'Unassigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(25, 39, 'MTR23-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(26, 35, 'MTR24-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(27, 0, 'MTR24-Tamtech', 'Unassigned', 'HP', 'ProDisplay P221', 'New', 'No Comment'),
(28, 37, 'MTR22-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(29, 24, 'MTR22-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(30, 0, 'MTR21-Tamtech', 'Unassigned', 'HP', 'ProDisplay P221', 'New', '24\"'),
(31, 38, 'MTR25-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'Line in the screen'),
(32, 38, 'MTR26-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(33, 17, 'MTR27-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(34, 17, 'MTR28-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(35, 63, 'MTR29-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'Line in the screen'),
(36, 20, 'MTR63-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', 'No Comment'),
(37, 3, 'MTR64-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', 'No Comment'),
(38, 42, 'MNT33-Tamtech', 'Assigned', 'Lenovo', 'LS1922wA', 'Frequently Used', 'No Comment'),
(39, 42, 'MNT34-Tamtech', 'Assigned', 'Lenovo', 'LS1922wA', 'Frequently Used', 'No Comment'),
(40, 10, 'MNT65-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(41, 46, 'MTR67-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', 'No Comment'),
(42, 0, 'MTR38-Tamtech', 'Unassigned', 'HP', 'ProDisplay P191', 'Frequently Used', 'No Comment'),
(43, 0, 'MTR39-Tamtech', 'Unassigned', 'HP', 'ProDisplay P191', 'Frequently Used', 'No Comment'),
(44, 27, 'MTR40-Tamtech', 'Assigned', 'HP', 'Compaq LE1902x', 'Frequently Used', 'No Comment'),
(45, 27, 'MTR41-Tamtech', 'Assigned', 'HP', 'LV1911', 'Frequently Used', 'No Comment'),
(46, 34, 'MTR42-Tamtech', 'Assigned', 'HP', 'ProDisplay P191 ', 'Frequently Used', 'No Comment'),
(47, 34, 'MTR43-Tamtech', 'Assigned', 'HP', 'Compaq LE1902x', 'Frequently Used', 'No Comment'),
(48, 7, 'MTR55-Tamtech', 'Assigned', 'HP', 'ProDisplay P191', 'Frequently Used', 'No Comment'),
(49, 7, 'MTR56-Tamtech', 'Assigned', 'HP', 'Compaq LE1902x', 'Frequently Used', 'No Comment'),
(50, 26, 'MTR36-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(51, 26, 'MTR35-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(52, 54, 'MTR02-Tamtech', 'Assigned', 'HP', 'ProDisplay P221', 'New', 'No Comment'),
(53, 43, 'MTR27-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(54, 43, 'MTR28-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(55, 63, 'MTR30-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(56, 25, 'MTR31-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(57, 25, 'MTR32-Tamtech', 'Assigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(58, 36, 'MTR37-Tamtech', 'Assigned', 'HP', 'Compaq LE1902x', 'Frequently Used', 'No Comment'),
(59, 0, 'MNT46-Tamtech', 'Unassigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment'),
(60, 0, 'MTR47-Tamtech', 'Unassigned', 'AOC', 'E970S-WNL', 'Frequently Used', 'No Comment');

-- --------------------------------------------------------

--
-- Table structure for table `mouse`
--

CREATE TABLE `mouse` (
  `id` int NOT NULL,
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `agent` varchar(255) NOT NULL DEFAULT 'None',
  `equip_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `model` varchar(255) NOT NULL DEFAULT 'No Model',
  `mouse_condition` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mouse`
--

INSERT INTO `mouse` (`id`, `agent_fk_id`, `agent`, `equip_id`, `status`, `brand`, `model`, `mouse_condition`, `comment`) VALUES
(1, 21, 'Irene Rose Sega', 'MSE01-Tamtech', 'Assigned', '3D Optical Mouse', 'RTM 019', 'Frequently Used', 'No Comment'),
(3, 10, 'Ivan  Vincent Alfred Neil Agleron', 'MSE02-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(4, 55, 'Roel Paulo Telmo', 'MSE03-Tamtech', 'Assigned', 'Rapoo', 'N1700', 'Frequently Used', 'No Comment'),
(5, 31, 'Jhon Jhon Maranan', 'MSE04-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(6, 5, 'Carl Lorenz Villaluna', 'MSE05-Tamtech', 'Assigned', 'Rapoo', 'N1700', 'Frequently Used', 'No Comment'),
(7, 9, 'Fitz Gerald  Geraldizo ', 'MSE06-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(8, 23, 'Melanie Basaka', 'MSE07-Tamech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(9, 20, 'Cathreen Joyce Jimenez', 'MSE08-Tamtech', 'Assigned', 'Rapoo', 'N1700', 'Frequently Used', 'No Comment'),
(10, 37, 'Charlene Sierra', 'MSE21-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(11, 24, 'Nic Orlyn Mercado', 'MSE21-Tamtech', 'Assigned', 'HP', 'KM100', 'Reassigned', 'No Comment'),
(12, 33, 'Lovely Maranan', 'MSE20-Tamtech', 'Assigned', 'HP', 'M100', 'Frequently Used', 'No Comment'),
(13, 38, 'John Mark Logmao', 'MSE24-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(14, 17, 'Matthew Del Rosario', 'MSE25-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(15, 63, 'Princess Joy Roncali', 'MSE26-Tamtech', 'Assigned', 'Dell', 'MS11611', 'Frequently Used', 'No Comment'),
(16, 25, 'Joel  Catague Jr. ', 'MSE27-Tamtech', 'Assigned', 'HP', 'M-U0034-O', 'Frequently Used', 'No Comment'),
(17, 14, 'Manuel Ray Ferrer', 'MSE43-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(18, 12, 'Sheila Laine Cayas', 'MSE09-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(19, 13, 'Charybeth  Dalisay', 'MSE10-Tamtech', 'Assigned', 'Rapoo', 'N1700', 'Frequently Used', 'No Comment'),
(20, 36, 'Donna Mae Umali', 'MSE31-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(21, 0, 'None', 'MSE30-Tamtech', 'Unassigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(22, 0, 'None', 'MSE29-Tamtech', 'Unassigned', 'HP', 'M-U0034-O', 'Frequently Used', 'No Comment'),
(23, 0, 'None', 'MSE32-Tamtech', 'Unassigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(24, 27, 'John Mark  Castro', 'MSE33-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(25, 34, 'Mary Grace Tisuela', 'MSE34-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(26, 42, 'Freeda Alexis Enriquez', 'MSE28-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(27, 3, 'Reynato Froisland', 'MSE12-Tamtech', 'Assigned', 'Rapoo', 'N1700', 'New', 'No Comment'),
(28, 51, 'Shiela Rogene Carena', 'MSE15-Tamtech', 'Assigned', 'HP', 'MOFYUO', 'New', 'No Comment'),
(29, 0, 'None', 'MSE11-Tamtech', 'Unassigned', 'No Brand', 'No Model', 'Frequently Used', 'No Comment'),
(30, 45, 'Jayzel Ara Mae Dicdican', 'MSE16-Tamtech', 'Assigned', 'HP', 'MOFYUO', 'New', 'No Comment'),
(31, 49, 'Krysha Aimee Grace Madriaga', 'MSE14-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(32, 46, 'Myca Lovelle Ponce', 'MSE13-Tamtech', 'Assigned', 'Logitech', 'B100', 'Frequently Used', 'No Comment'),
(33, 47, 'Andrei Ivan De Guzman', 'MSE44-Tamtech', 'Assigned', 'HP', 'MOFYUO', 'Frequently Used', 'No Comment'),
(34, 50, 'Kai Yue Cheong', 'MSE18-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(35, 48, 'Jan Ivan Reña', 'MSE19-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(36, 7, 'Ro Anne Sarmiento', 'MSE42-Tamtech', 'Assigned', 'HP', 'KM100', 'Frequently Used', 'No Comment'),
(37, 26, 'Christian Ralph Ilagan', 'MSE45-Tamtech', 'Assigned', 'HP', 'MOUFYO', 'Frequently Used', 'No Comment'),
(38, 54, 'Leniel Mampusti ', 'MSE01-Tamtech', 'Assigned', '3D Optical Mouse', 'RTM 019', 'Frequently Used', 'No Comment'),
(39, 39, 'Christine Rago', 'MSE22-Tamtech', 'Assigned', 'HP', 'MOFYUO', 'Frequently Used', 'No Comment'),
(40, 35, 'Marc Richard Villaluna', 'MSE23-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(41, 43, 'Keren Ada', 'MSE25-Tamtech', 'Assigned', 'Rapoo', 'N200', 'Frequently Used', 'No Comment'),
(42, 0, 'None', 'MSE36-Tamtech', 'Unassigned', 'Acer', 'Acer', 'Frequently Used', 'No Comment'),
(43, 0, 'None', 'MSE35-Tamtech', 'Unassigned', 'HP', 'KM100', 'Frequently Used', 'No Comment');

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `id` int NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `payslip_no` varchar(255) NOT NULL,
  `status` enum('send','not_send') NOT NULL,
  `startDate` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `id` int NOT NULL,
  `phone_agent_name` varchar(255) NOT NULL DEFAULT 'None',
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `phone_equip_id` varchar(255) NOT NULL,
  `phone_status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `phone_brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `phone_model` varchar(255) NOT NULL DEFAULT 'No Model',
  `phone_condition` varchar(255) NOT NULL,
  `phone_comment` varchar(255) NOT NULL DEFAULT 'No Comment',
  `phone_number_one` varchar(255) NOT NULL DEFAULT 'None',
  `whatsapp_acc_one` varchar(255) NOT NULL DEFAULT 'None',
  `whatsapp_acc_one_cond` varchar(255) NOT NULL DEFAULT 'None',
  `phone_number_two` varchar(255) NOT NULL DEFAULT 'None',
  `whatsapp_acc_two` varchar(255) NOT NULL DEFAULT 'None',
  `whatsapp_acc_two_cond` varchar(255) NOT NULL DEFAULT 'None',
  `phone_number_three` varchar(255) NOT NULL DEFAULT 'None',
  `whatsapp_acc_three` varchar(255) NOT NULL DEFAULT 'None',
  `whatsapp_acc_three_cond` varchar(255) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`id`, `phone_agent_name`, `agent_fk_id`, `phone_equip_id`, `phone_status`, `phone_brand`, `phone_model`, `phone_condition`, `phone_comment`, `phone_number_one`, `whatsapp_acc_one`, `whatsapp_acc_one_cond`, `phone_number_two`, `whatsapp_acc_two`, `whatsapp_acc_two_cond`, `phone_number_three`, `whatsapp_acc_three`, `whatsapp_acc_three_cond`) VALUES
(1, 'None', 0, 'PHN01-Tamtech', 'Unassigned', 'Nokia ', 'C12', 'Working', 'New purchased', '9641746078', 'Freeda / 2in1 VA', 'Use in current campaign', '9288912489', 'Christine / Secondz Project', 'Use in current campaign', 'None', 'None', 'Free to use'),
(2, 'None', 0, 'PHN02-Tamtech', 'Unassigned', 'Nokia ', 'C12', 'Working', 'New purchased', '9288912381', 'Ivan / Kazehi', 'Use in current campaign', '0928-891-2449', 'Alvie / Kazehi', 'Use in current campaign', 'None', 'None', 'Free to use'),
(3, 'None', 0, 'PHN03-Tamtech', 'Unassigned', 'Redmi', 'A2+', 'Working', 'Singapore Sim', '0928-891-2521', 'Rey / MJ Solar', 'Use in current campaign', '0928-891-2509', 'Jhon Jhon / Nakunj Outbound ', 'Use in current campaign', 'None', 'None', 'Free to use'),
(4, 'Kathy Silvano', 30, 'PHN04-Tamtech', 'Assigned', 'Redmi', 'A2+', 'Working', 'Singapore Sim', '88963015', 'Kathy / LTM', 'Use in current campaign', 'None', 'None', 'Free to use', 'None', 'None', 'Free to use'),
(5, 'None', 0, 'PHN05-Tamtech', 'Unassigned', 'Nokia ', 'C10', 'Working', 'Singapore Sim', '89481044', 'LTM / Joel', 'Use in current campaign', '88570607', 'LTM / Matthew', 'Use in current campaign', 'None', 'None', 'Free to use'),
(6, 'None', 0, 'PHN06-Tamtech', 'Unassigned', 'Samsung ', 'Galaxy A12', 'Working', 'No Comment', '0928-891-2455', 'Yumi / 2in1 VA', 'Use in current campaign', '0967-233-6068', 'Cathreen / MJ Solar ', 'Use in current campaign', '0928-891-2488', 'None', 'Free to use'),
(7, 'None', 0, 'PHN07-Tamtech', 'Unassigned', 'Samsung ', 'Galaxy A10', 'Working', 'No Comment', '0956-467-9433', 'Manuel / PPP', 'Use in current campaign', '0995-883-0129', 'Lovely', 'Use in current campaign', '0928-891-2453', 'Lean', 'Free to use'),
(8, 'NULL', 0, 'PHN08-Tamtech', 'Unserviceable', 'Xiaomi', 'No Model', 'Non working', 'Bloated battery', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None'),
(9, 'NULL', 0, 'PHN09-Tamtech', 'Unserviceable', 'Oppo', 'No Model', 'Non working', 'Deadboot ', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None'),
(10, 'Joel  Catague Jr. ', 25, 'PHN10-Tamtech', 'Assigned', 'Nokia ', 'C10', 'Working', 'Singapore Sim', 'None', 'None', 'Free to use', 'None', 'None', 'Free to use', 'None', 'None', 'Free to use'),
(11, 'None', 0, 'PHN11-Tamtech', 'Unassigned', 'Oppo', 'F3 Plus', 'Working', 'Singapore Sim', '0928-891-2388', 'Redney ', 'Use in current campaign', '88398264', 'Back Up LTM', 'Use in current campaign', 'None', 'None', 'None'),
(12, 'Matthew Del Rosario', 17, 'PHN12-Tamtech', 'Assigned', 'Samsung ', 'A03s', 'Working', 'Singapore Sim', '80179239', 'Matthew / LTM', 'Use in current campaign', 'None', 'None', 'None', 'None', 'None', 'None'),
(13, 'None', 0, 'PHN13-Tamtech', 'Unassigned', 'Nokia ', 'C10', 'Working', 'Singapore Sim', '89040127', 'Back Up LTM', 'Use in current campaign', 'None', 'None', 'Free to use', 'None', 'None', 'None'),
(14, 'None', 0, 'PHN14-Tamtech', 'Unassigned', 'Iphone ', '7 plus', 'Working', 'No Comment', '80655196', 'Back Up LTM', 'Use in current campaign', '0928-891-2457', 'Ian John / Secondz Project', 'Use in current campaign', 'None', 'None', 'None'),
(15, 'Kristine  Tejida', 19, 'PHN15-Tamtech', 'Assigned', 'Nokia ', 'C10', 'Working', 'No Comment', '0928-891-2522', 'Kristine / Secondz Project', 'Use in current campaign', 'None', 'None', 'None', 'None', 'None', 'None'),
(16, 'Francis Calayag II', 16, 'PHN16-Tamtech', 'Assigned', 'Samsung ', 'Galaxy A12', 'Working', 'No Comment', '0977-012-7798', 'Francis / Biz Dev', 'Use in current campaign', 'None', 'None', 'None', 'None', 'None', 'None'),
(17, 'Christian  Delos Reyes', 29, 'PHN17-Tamtech', 'Assigned', 'Redmi', 'A2+', 'Working', 'No Comment', '0917-624-2610 ', 'Christian / Biz Dev', 'Use in current campaign', 'None', 'None', 'None', 'None', 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `resigned_details`
--

CREATE TABLE `resigned_details` (
  `id` int NOT NULL,
  `agent_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sgsimcard`
--

CREATE TABLE `sgsimcard` (
  `id` int NOT NULL,
  `number` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL DEFAULT 'None',
  `agent` varchar(255) NOT NULL,
  `agent_fk_id` int NOT NULL,
  `used_in` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `phone_serial_no` varchar(255) NOT NULL,
  `phone_fk_id` int NOT NULL,
  `load_expired` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sgsimcard`
--

INSERT INTO `sgsimcard` (`id`, `number`, `serial_no`, `agent`, `agent_fk_id`, `used_in`, `remarks`, `phone_serial_no`, `phone_fk_id`, `load_expired`) VALUES
(1, '88372673', '3942', 'Joel  Catague Jr. ', 25, 'Simba Voice Only', 'Permanently Banned in Whats App', 'PHN10-Tamtech', 10, 'Every 20th of Month'),
(2, '89481044', '4950', 'Joel  Catague Jr. ', 25, 'WhatsApp Only', 'New SG Sim', 'PHN05-Tamtech', 5, 'Every 18th of Month'),
(3, '80179239', 'None', 'Matthew Del Rosario', 17, 'WhatsApp and Simba Voice', 'Getting blocked in whatsapp', 'PHN12-Tamtech', 12, 'Every 20th of Month'),
(4, '88570607', '4968', 'Matthew Del Rosario', 17, 'WhatsApp Only', 'New SG Sim', 'PHN05-Tamtech', 5, 'Every 18th of Month'),
(5, '88963015', '3967', 'Kathy Silvano', 29, 'WhatsApp and Simba Voice', 'Getting blocked in whatsapp', 'PHN04-Tamtech', 4, 'Every 20th of Month'),
(6, '88398264', '3959', '', 0, 'WhatsApp and Simba Voice', 'Need to recover in WhatsApp', 'PHN11-Tamtech', 11, 'Every 20th of Month'),
(7, '80662179', '3934', '', 0, 'Simba Voice Only', 'Permanently Banned in Whats App', 'PHN03-Tamtech', 3, 'Every 20th of Month'),
(8, '89040127', '5650', '', 0, 'WhatsApp Only', 'New SG Sim', 'PHN13-Tamtech', 13, 'Every 18th of Month'),
(9, '88536700', '5924', '', 0, 'WhatsApp Only', 'New SG Sim', 'PHN04-Tamtech', 4, 'Every 18th of Month'),
(10, '88534770', '5668', '', 0, 'WhatsApp Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(11, '88351656', '0994', 'Ezekiel Telmo', 2, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(12, '80332793', '0986', 'Kristine  Tejida', 19, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(13, '80133608', '0978', 'Francis Calayag II', 16, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(14, '80164110', '0960', 'Christian  Delos Reyes', 28, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(15, '88027246', '0952', 'Wendell Lozano', 6, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(16, '80740790', '0945', 'Boss', 0, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(17, '80655196', '0937', 'Ocean Mark Temblique', 18, 'Simba Voice Only', 'New SG Sim', '', 0, 'Every 18th of Month'),
(18, '89339763', '0929', '', 0, 'Never Use', 'New SG Sim', '', 0, 'Every 18th of Month'),
(19, '88248442', '0911', '', 0, 'Never Use', 'New SG Sim', '', 0, 'Every 18th of Month'),
(20, '80344610', '0903', '', 0, 'Never Use', 'New SG Sim', '', 0, 'Every 18th of Month'),
(21, '89044631', '0887', '', 0, 'Never Use', 'New SG Sim		', '', 0, 'Every 18th of Month'),
(22, '88109177	', '0861', '', 0, 'Never Use', 'New SG Sim		', '', 0, 'Every 18th of Month'),
(23, '80722143	', '0879', '', 0, 'WhatsApp and Simba Voice', 'New SG Sim		', '', 0, 'Every 18th of Month'),
(24, '89273529	', '0895', '', 0, 'Never Use', 'New SG Sim		', '', 0, 'Every 18th of Month');

-- --------------------------------------------------------

--
-- Table structure for table `webcam`
--

CREATE TABLE `webcam` (
  `id` int NOT NULL,
  `webcam_agent` varchar(255) NOT NULL DEFAULT 'None',
  `agent_fk_id` int NOT NULL DEFAULT '0',
  `webcam_equip_id` varchar(255) NOT NULL,
  `webcam_status` varchar(255) NOT NULL DEFAULT 'Unassigned',
  `webcam_brand` varchar(255) NOT NULL DEFAULT 'No Brand',
  `webcam_model` varchar(255) NOT NULL DEFAULT 'No Model',
  `webcam_condition` varchar(255) NOT NULL,
  `webcam_comment` varchar(255) NOT NULL DEFAULT 'No Comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `webcam`
--

INSERT INTO `webcam` (`id`, `webcam_agent`, `agent_fk_id`, `webcam_equip_id`, `webcam_status`, `webcam_brand`, `webcam_model`, `webcam_condition`, `webcam_comment`) VALUES
(1, 'None', 0, 'WBC01-Tamtech', 'Unassigned', 'Samsung Galaxy A12', 'Galaxy A12', 'Working', 'No Comment'),
(3, 'None', 0, 'WBC02-Tamtech', 'Unassigned', 'Samsung Galaxy A13	', 'Galaxy A13', 'Working', 'No Comment'),
(4, 'None', 0, 'WBC03-Tamtech', 'Unassigned', 'Samsung Galaxy A14	', 'Galaxy A14', 'Working', 'No Comment'),
(5, 'None', 0, 'WBC04-Tamtech', 'Unassigned', 'Samsung Galaxy A15	', 'Galaxy A15', 'Working', 'No Comment'),
(6, 'None', 0, 'WBC04-Tamtech', 'Unassigned', 'Samsung Galaxy A16	', 'Galaxy A16', 'Working', 'No Comment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_documents`
--
ALTER TABLE `agent_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_leave`
--
ALTER TABLE `agent_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_list`
--
ALTER TABLE `agent_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_monitor`
--
ALTER TABLE `agent_monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_payslips`
--
ALTER TABLE `agent_payslips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headset`
--
ALTER TABLE `headset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyboard`
--
ALTER TABLE `keyboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mouse`
--
ALTER TABLE `mouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resigned_details`
--
ALTER TABLE `resigned_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sgsimcard`
--
ALTER TABLE `sgsimcard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webcam`
--
ALTER TABLE `webcam`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agent_documents`
--
ALTER TABLE `agent_documents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=658;

--
-- AUTO_INCREMENT for table `agent_leave`
--
ALTER TABLE `agent_leave`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `agent_list`
--
ALTER TABLE `agent_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `agent_monitor`
--
ALTER TABLE `agent_monitor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `agent_payslips`
--
ALTER TABLE `agent_payslips`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `headset`
--
ALTER TABLE `headset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `keyboard`
--
ALTER TABLE `keyboard`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `locker`
--
ALTER TABLE `locker`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `mouse`
--
ALTER TABLE `mouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `resigned_details`
--
ALTER TABLE `resigned_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sgsimcard`
--
ALTER TABLE `sgsimcard`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `webcam`
--
ALTER TABLE `webcam`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

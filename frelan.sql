-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2023 at 08:04 PM
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
-- Database: `frelan`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorId` int UNSIGNED NOT NULL,
  `jobId` int UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `authorId`, `jobId`, `isActive`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 'dsfafsd', 1, 2, 1, 0, '2023-11-13 00:34:21', '2023-11-13 00:34:21'),
(2, 'đâsd', 1, 2, 1, 0, '2023-11-13 00:34:59', '2023-11-13 00:34:59'),
(3, 'ádasdasd', 1, 2, 1, 0, '2023-11-13 00:35:59', '2023-11-13 00:35:59'),
(4, 'ádasdasd', 1, 2, 1, 0, '2023-11-13 00:36:06', '2023-11-13 00:36:06'),
(5, 'sdasdasd', 1, 2, 1, 0, '2023-11-13 00:40:27', '2023-11-13 00:40:27'),
(6, 'áddád', 1, 2, 1, 0, '2023-11-13 00:40:28', '2023-11-13 00:40:28'),
(7, 'jvh', 1, 3, 1, 0, '2023-11-15 04:13:47', '2023-11-15 04:13:47'),
(8, 'ss', 1, 3, 1, 0, '2023-11-15 11:10:06', '2023-11-15 11:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `slug`, `logo`, `url`, `industry`, `twitter`, `bio`, `created_at`, `updated_at`, `isArchived`, `isActive`) VALUES
(1, 'coinmaket', 'coinmaket', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1699819550/nzvye6ztxnmo7hh98pe8.ico', 'coinmaket', 'Web Development', 'coinmaket', 'dâsdsda', '2023-11-12 13:05:52', '2023-11-12 13:05:52', 0, 1),
(2, 'Zalo', 'Zalo', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1699861612/dvb42cegg3lq3nyt1tj7.png', 'Zalo', 'Web Development', 'zalo', 'zalo', '2023-11-13 00:46:52', '2023-11-13 00:46:52', 0, 1),
(3, 'STARFRUIT VINA', 'STARFRUITVINA', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1700038693/js59yh3srqsv66ymwa0m.png', 'http://frelan.com', 'Web Development, Mobile App Development', 'STARFRUIT', 'asdasdasd', '2023-11-15 01:58:17', '2023-11-15 01:58:17', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `deadline` datetime DEFAULT NULL,
  `eligibility` json DEFAULT NULL,
  `references` json DEFAULT NULL,
  `status` enum('OPEN','REVIEW','CLOSED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'OPEN',
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rewardAmount` int DEFAULT NULL,
  `rewards` json DEFAULT NULL,
  `companyId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pocId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` enum('NATIVE','IMPORT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NATIVE',
  `sourceDetails` json DEFAULT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `applicationLink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicationType` enum('rolling','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `skills` json DEFAULT NULL,
  `totalWinnersSelected` int NOT NULL DEFAULT '0',
  `totalPaymentsMade` int NOT NULL DEFAULT '0',
  `isWinnersAnnounced` tinyint(1) NOT NULL DEFAULT '0',
  `templateId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('permissioned','open') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `pocSocials` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeToComplete` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hackathonprize` tinyint(1) NOT NULL DEFAULT '0',
  `winners` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `slug`, `description`, `requirements`, `deadline`, `eligibility`, `references`, `status`, `token`, `rewardAmount`, `rewards`, `companyId`, `region`, `pocId`, `source`, `sourceDetails`, `isPublished`, `isFeatured`, `isActive`, `isArchived`, `created_at`, `updated_at`, `applicationLink`, `applicationType`, `skills`, `totalWinnersSelected`, `totalPaymentsMade`, `isWinnersAnnounced`, `templateId`, `type`, `pocSocials`, `timeToComplete`, `hackathonprize`, `winners`) VALUES
(1, 'Senior Front-End Developer (ReactJS/VueJS/AngularJS/JS)', 'senior-front-end-developer-reactjsvuejsangularjsjs', '<h2><strong>Your role &amp; responsibilities</strong></h2><ul><li><p><span>Responsible for the development, architecture design and experience optimization of overseas web game platforms;</span></p></li><li><p><span>Participate in the construction of the team\'s front-end engineering system and gradually improve R&amp;D efficiency and R&amp;D quality;</span></p></li><li><p><span>Work with product managers, designers, and back-end engineers to improve the user experience of the product and create excellent Internet products;</span></p></li><li><p><span>Pay attention to the development of front-end cutting-edge technologies, be able to transfer new knowledge to the team, and transform it into potential projects.</span></p></li></ul><h2><strong>Your skills &amp; qualifications</strong></h2><p><span><strong>Skills:</strong></span></p><ul><li><p><span>Solid basic computer knowledge, familiar with commonly used data structures, algorithms and design patterns, and able to use them flexibly in daily research and development;</span></p></li><li><p><span>Understand Web front-end development technology, including HTML/ CSS/ JavaScript, etc., master at least one mainstream front-end framework (React/Vue/Angular, etc.), TypeScript experience is preferred;</span></p></li><li><p><span>Have rich experience in optimizing front-end performance and solving mobile terminal adaptation;</span></p></li><li><p><span>Have good service awareness, sense of responsibility, strong learning ability, and excellent team communication and collaboration skills.</span></p></li></ul><p><span><strong>Work Experience</strong></span></p><ul><li><p><span>More than 5 years of Front-end and game development experience</span></p></li></ul><p>&nbsp;</p><h2><strong>Benefits for you</strong></h2><ul><li><p>Salary: 35,000,000 – 50,000,000 VND + Allowances</p></li><li><p>Social insurance + 13rd-15th salary bonus + Holidays bonus</p></li><li><p>After trial period, employee can work hybrid with 3 days on-site at office and 3 days off-site</p></li><li><p>Working time: 1PM - 9PM, 30-minute break between sessions, Monday to Saturday</p></li></ul>', NULL, '2023-12-03 23:06:00', '[]', '[]', 'CLOSED', 'USD', 3000, NULL, '1', 'GLOBAL', '1', 'NATIVE', NULL, 1, 0, 1, 0, '2023-11-12 13:06:50', '2023-11-15 12:47:16', NULL, 'fixed', '[{\"skills\": \"Frontend\", \"subskills\": [\"React\"]}]', 0, 0, 1, NULL, 'open', 'àdasdádasdasdas', NULL, 0, NULL),
(2, 'Fresher/Junior - Senior C++ Developer', 'fresherjunior-senior-c-developer', '<h2><strong>Trách nhiệm công việc</strong></h2><ul><li><p><span>Tham gia từ giai đoạn thiết kế đến triển khai sản phẩm của siêu dự án phát triển phần mềm CAD cho khách hàng Nhật Bản. Dự án phần mềm kiến trúc, xây dựng cho khách hàng Nhật Bản là dự án lớn của tập đoàn DTS Japan (top 10 tập đoàn CNTT tại Nhật Bản), với nhiều modules phần mềm khác nhau, từ Windows App, Web App, iOS App…</span></p></li><li><p><span>Phát triển Plugin cho revit và các ứng dụng CAD khác theo đơn đặt hàng của khách hàng Nhật.</span></p></li><li><p><span>Được đào tạo: chuyên sâu về C#, C/C++ và các kiến thức, kỹ năng cần thiết cho phát triển các sản phẩm cho CAD</span></p></li><li><p><span>Làm việc trong môi trường chuyên nghiệp, tuân thủ quy trình phát triển phần mềm chuẩn PMS của DTS Japan;</span></p></li><li><p><span>Hợp tác làm việc với các Leaders, Project Manager xuất sắc với hàng chục năm kinh nghiệm tại các công ty phần mềm lớn nhất ở Nhật Bản và Việt Nam với các quy trình quản lý dự án bài bản, chuyên nghiệp.</span></p></li></ul><h2><strong>Kỹ năng &amp; Chuyên môn</strong></h2><ul><li><p><span>Ứng viên có kinh nghiệm từ 1 năm trở lên về ngôn ngữ C++, chấp nhận ứng viên mới ra trường đã có kinh nghiệm, chấp nhận ứng viên trái ngành (điện, điện tử, tự động hóa) nắm vững kiến thức và kinh nghiệm về lập trình.</span></p></li><li><p><span>Ưu tiên ứng viên biết tiếng Nhật và có kinh nghiệm làm việc cho công ty/ dự án Nhật.</span></p></li></ul><h2><strong>Phúc lợi dành cho bạn</strong></h2><ul><li><p>Lương thỏa thuận theo năng lực thực tế của ứng viên.</p></li><li><p>Trợ cấp đi lại, trợ cấp ăn trưa, trợ cấp năng lực tiếng Nhật, trợ cấp học tiếng Nhật trợ cấp onsite khi tham gia dự án bên khách hàng....</p></li><li><p>Thưởng lễ tết, thưởng tháng lương thứ 13, thưởng nhân viên xuất sắc quý, năm, nhân viên tiêu biểu đi du lịch Nhật Bản.</p></li><li><p>Nghỉ theo lịch công ty, nghỉ theo lịch khách hàng Nhật, ngoài các ngày nghỉ theo quy định, 1 năm có thêm 2 đợt nghỉ dài.</p></li><li><p>Nghỉ tham gia Ngày hội khai giảng cùng con cho các phụ huynh</p></li><li><p>Chế độ chăm sóc phụ nữ: Nghỉ sinh lý phụ nữ: 8h/ tháng; Nghỉ sau sinh cho nhân viên nữ có con dưới 1 tuổi: 1h/ngày.</p></li><li><p>Bảo hiểm y tế, bảo hiểm xã hội, bảo hiểm thất nghiệp theo quy định của Luật lao động.</p></li><li><p>Bảo hiểm sức khỏe cao cấp cho toàn bộ nhân viên.</p></li><li><p>Khám sức khỏe định kỳ hàng năm tại các bệnh viện uy tín (Bệnh viện Thu Cúc, bệnh viện Medlatec…).</p></li><li><p>Miễn phí trà, coffee tại khu vực ăn uống của công ty.</p></li><li><p>Máy pha coffee, máy bán hàng tự động tiện ích ngay tại văn phòng.</p></li><li><p>Hoạt động team building kết nối đội nhóm hàng quý.</p></li><li><p>Các CLB thể thao: bóng đá, bi lắc, bóng bàn, cờ, leo núi...</p></li><li><p>Hoạt động du lịch thường niên và các sự kiện lớn trong công ty.</p></li><li><p>Thời gian làm việc: Thứ 2 đến thứ 6, từ 08:00 đến 17:00</p></li></ul>', 'có laptop', '2023-12-31 20:27:00', '[]', '[]', 'OPEN', 'USD', 2000, NULL, '1', 'GLOBAL', '1', 'NATIVE', NULL, 1, 0, 1, 0, '2023-11-12 20:28:13', '2023-11-15 12:29:02', NULL, 'fixed', '[{\"skills\": \"Backend\", \"subskills\": [\"C++\"]}]', 0, 0, 1, NULL, 'open', 'tiendung0325@gmail.com', NULL, 0, NULL),
(3, 'fdgfgdsg', 'fdgfgdsg', '<p>dfgdsfg</p>', 'dfgdsg', '2023-12-06 06:33:00', '[]', '[]', 'OPEN', 'USD', 4000, NULL, '1', 'GLOBAL', '1', 'NATIVE', NULL, 1, 0, 1, 0, '2023-11-12 23:33:36', '2023-11-15 12:37:19', NULL, 'fixed', '[{\"skills\": \"Blockchain\", \"subskills\": [\"Rust\"]}]', 0, 0, 0, NULL, 'open', 'dfgdsg', NULL, 0, NULL),
(4, 'sadsad', 'sadsad', '<p>gfhjhgjghfj</p>', 'rtjyghj', '2023-11-29 06:49:00', '[]', '[]', 'OPEN', 'USD', 4000, NULL, '1', 'GLOBAL', '1', 'NATIVE', NULL, 1, 0, 1, 0, '2023-11-12 23:49:17', '2023-11-15 12:44:08', NULL, 'fixed', '[{\"skills\": \"Backend\", \"subskills\": [\"Python\"]}]', 0, 0, 1, NULL, 'open', 'ádasd', NULL, 0, NULL),
(5, 'job 1', 'job-1', '<p></p><p>tuyển dụng zalo</p><h2> tuyển dụng zalo</h2><p><em> tuyển dụng zalo </em></p>', 'có laptop', '2023-12-10 07:47:00', '[]', '[]', 'OPEN', 'USD', 12345, NULL, '2', 'GLOBAL', '4', 'NATIVE', NULL, 1, 0, 1, 0, '2023-11-13 00:47:59', '2023-11-13 00:47:59', NULL, 'fixed', '[{\"skills\": \"Frontend\", \"subskills\": [\"React\"]}]', 0, 0, 0, NULL, 'open', 'zalo', NULL, 0, NULL),
(6, 'Freelance Designer', 'freelance-designer', '<h2>Who We Are</h2><p><em>A short paragraph (3-5 sentences) should be plenty here. Make sure to clearly communicate what the overall mission is, along with any evidence of your traction. The goal should be to make your company feel like a rocket ship that applicants would be lucky to work with.</em></p><p>&nbsp;</p><h2>You&rsquo;ll Be Responsible for...</h2><p><em>Bullet point list of the scope of the role. What will they own? What kind of projects will they work on? More detail is better here to give applicants a clear sense of what they&rsquo;ll work on so they can envision their day-to-day.</em></p><p>&nbsp;</p><p>&nbsp;</p><h2>You&rsquo;re a Good Fit If...</h2><p><em>Include a bullet point list of requirements for the role (e.g. timezone, experience, tech stack, etc). Aim for ~5 requirements. More than that will turn off potential applicants</em></p><p>&nbsp;</p><p>&nbsp;</p><h2>You&rsquo;re a Perfect Fit if you have</h2><p><em>For &ldquo;optional&rdquo; or &ldquo;nice to have&rdquo; criteria, use this area. Again, try to limit ~5 or fewer requirements here.</em></p>', NULL, '2023-11-28 10:23:00', '[]', '[]', 'OPEN', 'USD', 1234, NULL, '3', 'GLOBAL', '5', 'NATIVE', NULL, 1, 0, 1, 0, '2023-11-15 03:23:57', '2023-11-15 03:23:57', NULL, 'fixed', '[{\"skills\": \"Design\", \"subskills\": [\"UI/UX Design\"]}]', 0, 0, 0, '6', 'open', 'ádsadasd', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members_companies`
--

CREATE TABLE `members_companies` (
  `id` bigint UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `companyId` int UNSIGNED NOT NULL,
  `role` enum('ADMIN','MEMBER') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MEMBER',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members_companies`
--

INSERT INTO `members_companies` (`id`, `userId`, `companyId`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ADMIN', '2023-11-12 13:05:53', '2023-11-12 13:05:53'),
(2, 4, 2, 'ADMIN', '2023-11-13 00:46:52', '2023-11-13 00:46:52'),
(3, 5, 3, 'ADMIN', '2023-11-15 01:58:17', '2023-11-15 01:58:17'),
(4, 6, 1, 'MEMBER', '2023-11-15 12:31:24', '2023-11-15 12:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `members_invites`
--

CREATE TABLE `members_invites` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senderId` int UNSIGNED NOT NULL,
  `companyId` int UNSIGNED NOT NULL,
  `memberType` enum('ADMIN','MEMBER') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MEMBER',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members_invites`
--

INSERT INTO `members_invites` (`id`, `email`, `senderId`, `companyId`, `memberType`, `created_at`, `updated_at`) VALUES
(1, 'tiendung0325@gmail.com', 1, 1, 'MEMBER', '2023-11-12 23:48:29', '2023-11-12 23:48:29'),
(2, 'tiendung0325@gmail.com', 1, 1, 'MEMBER', '2023-11-12 23:58:10', '2023-11-12 23:58:10'),
(3, 'dung@gmail.com', 1, 1, 'MEMBER', '2023-11-12 23:59:33', '2023-11-12 23:59:33'),
(4, 'dung@gmail.com', 1, 1, 'MEMBER', '2023-11-12 23:59:43', '2023-11-12 23:59:43'),
(5, 'tiendung0325@gmail.com', 1, 1, 'MEMBER', '2023-11-13 00:01:52', '2023-11-13 00:01:52'),
(6, 'tdung@gmail.com', 1, 1, 'MEMBER', '2023-11-15 12:30:39', '2023-11-15 12:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(74, '2023_11_06_092525_create_submissions_table', 1),
(95, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(96, '2023_11_06_091712_create_users_table', 2),
(97, '2023_11_06_092036_create_companies_table', 2),
(98, '2023_11_06_092312_create_members_companies_table', 2),
(99, '2023_11_06_092442_create_members_invites_table', 2),
(100, '2023_11_06_092453_create_pows_table', 2),
(101, '2023_11_06_092509_create_recruitments_table', 2),
(102, '2023_11_06_092537_create_subscribejobs_table', 2),
(103, '2023_11_06_092612_create_comments_table', 2),
(104, '2023_11_06_092639_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pows`
--

CREATE TABLE `pows` (
  `id` bigint UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` json DEFAULT NULL,
  `subSkills` json DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pows`
--

INSERT INTO `pows` (`id`, `userId`, `title`, `description`, `skills`, `subSkills`, `link`, `created_at`, `updated_at`) VALUES
(1, 5, 'clone facebook', 'fasdadsfased', '[\"Backend\"]', '[\"Javascript\"]', 'https://www.facebook.com', '2023-11-15 01:57:11', '2023-11-15 01:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `recruitments`
--

CREATE TABLE `recruitments` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subskills` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` enum('NATIVE','IMPORT') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NATIVE',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobType` enum('parttime','fulltime','internship') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fulltime',
  `maxSalary` double DEFAULT NULL,
  `minSalary` double DEFAULT NULL,
  `maxEq` double DEFAULT NULL,
  `minEq` double DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyId` int UNSIGNED NOT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sourceDetails` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tweet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otherInfo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eligibilityAnswers` json DEFAULT NULL,
  `userId` int UNSIGNED NOT NULL,
  `jobId` int UNSIGNED NOT NULL,
  `isWinner` tinyint(1) NOT NULL DEFAULT '0',
  `winnerPosition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT '0',
  `paymentDetails` json DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  `like` json DEFAULT NULL,
  `likes` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribejobs`
--

CREATE TABLE `subscribejobs` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otherInfo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userId` int UNSIGNED NOT NULL,
  `jobId` int UNSIGNED NOT NULL,
  `isChosen` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribejobs`
--

INSERT INTO `subscribejobs` (`id`, `email`, `phoneNumber`, `otherInfo`, `userId`, `jobId`, `isChosen`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'phungdung25322@gmail.com', '0365503654', 'adasdasd', 1, 1, 0, 1, '2023-11-12 13:19:25', '2023-11-12 13:20:36'),
(2, 'phungdung25322@gmail.com', '0365503654', NULL, 2, 1, 1, 1, '2023-11-12 17:29:51', '2023-11-15 12:47:16'),
(3, 'phungdung25322123@gmail.com', '0365503654', NULL, 3, 1, 0, 1, '2023-11-12 17:31:07', '2023-11-12 17:31:07'),
(4, 'admin@tdung.tech', '0365503654', 'adasdasd', 1, 2, 0, 1, '2023-11-13 00:24:21', '2023-11-15 12:29:02'),
(5, 'phungdung25322@gmail.com', '0365503654', 'https://chat.openai.com/', 1, 4, 0, 1, '2023-11-15 11:15:49', '2023-11-15 12:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `publicKey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('GOD','USER') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USER',
  `totalEarned` int NOT NULL DEFAULT '0',
  `isTalentFilled` tinyint(1) NOT NULL DEFAULT '0',
  `interests` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discord` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workPrefernce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currentEmployer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifications` json DEFAULT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `skills` json DEFAULT NULL,
  `currentCompanyId` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `publicKey`, `email`, `username`, `password`, `photo`, `firstname`, `lastname`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `isVerified`, `role`, `totalEarned`, `isTalentFilled`, `interests`, `bio`, `twitter`, `discord`, `github`, `linkedin`, `website`, `telegram`, `experience`, `level`, `location`, `workPrefernce`, `currentEmployer`, `notifications`, `private`, `skills`, `currentCompanyId`) VALUES
(1, NULL, 'phungdung25322@gmail.com', 'tidvn', '$2y$10$M9tCXDXasZPlgfz93EAB6u.pJsFjTJ7DIAyqtZiuDm01gUk4jp.Le', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1699819513/pzplbp4brj6c20gakkex.jpg', 'Phung', 'Tien Dung', NULL, NULL, '2023-11-12 13:03:55', '2023-11-12 13:05:53', 1, 'USER', 0, 1, '\"[\\\"Web Development\\\"]\"', 'dsfdafs', NULL, 'tidvn', 'https://github.com/tidvn', NULL, NULL, NULL, '<2 Years', NULL, 'An Giang', 'Freelance', 'ưqdqd', NULL, 0, '[{\"skills\": \"Backend\", \"subskills\": [\"PHP\"]}]', 1),
(2, NULL, 'phungdung253222@gmail.com', 'tidvn2', '$2y$10$omGeIpzMwAZSVavKgyqqgOBI01aHGyciFEREBJa4VArYDgSxmjGqu', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1699834869/tzszz925uzjobons74zn.png', 'Phung', 'Tien Dung', NULL, NULL, '2023-11-12 17:20:22', '2023-11-12 17:21:29', 1, 'USER', 0, 1, '\"[\\\"Mobile App Development\\\"]\"', 'asdasdas', NULL, 'tidvn', 'https://github.com/tidvn', NULL, NULL, NULL, '<2 Years', NULL, 'Bình Định', 'Freelance', 'ưqdqd', NULL, 0, '[{\"skills\": \"Frontend\", \"subskills\": [\"React\"]}]', 0),
(3, NULL, 'phungdung25322@gmail.com3', 'tidvn4', '$2y$10$LW8ZoxyTFgtVWbZxIVpo.e.md91ACewsD5yV.qk9ogX62LHP15N1G', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1699835431/v0q3wkr8sixvoatekkvk.png', 'Phung', 'Tien Dung', NULL, NULL, '2023-11-12 17:30:17', '2023-11-12 17:30:49', 1, 'USER', 0, 1, '\"[\\\"Web Development\\\",\\\"Mobile App Development\\\"]\"', 'asdasdasd', NULL, 'tidvn', 'https://www.facebook.com/', NULL, NULL, NULL, '2 to 5 Years', NULL, 'Bắc Ninh', 'Freelance', 'ưqdqd', NULL, 0, '[{\"skills\": \"Frontend\", \"subskills\": [\"Vue\", \"Angular\"]}, {\"skills\": \"Blockchain\", \"subskills\": []}]', 0),
(4, NULL, 'phungdung25322123@gmail.com', 'tidvntidvn', '$2y$10$cSJVUqHHQPf8m8t5y5RZLOuy0DCUXQFiNiE3vtKkv395xl/pHtekW', NULL, 'Phung', 'Tien Dung', NULL, NULL, '2023-11-13 00:46:20', '2023-11-13 00:46:52', 1, 'USER', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2),
(5, NULL, 'phungdung333@gmail.com', 'tidvn333', '$2y$10$G9shhd7L04MQxpi1q9WZRuy3w.erf0qho7cG0vz3e.4NMcH2oqQn2', 'https://res.cloudinary.com/dgvnuwspr/image/upload/v1700038600/n70k5n5ehqsaeriu7ftc.jpg', 'Phung', 'Tien Dung', NULL, NULL, '2023-11-15 01:56:12', '2023-11-15 01:58:17', 1, 'USER', 0, 1, '\"[\\\"Web Development\\\"]\"', 'dung', NULL, 'tidvn', 'https://github.com/tidvn', NULL, NULL, NULL, '5 to 9 Years', NULL, 'Hà Nội', 'Freelance', 'dev', NULL, 0, '[{\"skills\": \"Frontend\", \"subskills\": [\"Vue\", \"React\"]}, {\"skills\": \"Blockchain\", \"subskills\": []}]', 3),
(6, NULL, 'tdung@gmail.com', 'tdung', '$2y$10$9C4Q4oQxQHAL6ElSTpJJvONJWGl7zatByPNgdumdYegLivOvxfeaa', NULL, 'Phung', 'Tien Dung', NULL, NULL, '2023-11-15 12:30:56', '2023-11-15 12:31:27', 1, 'USER', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_slug_unique` (`slug`),
  ADD UNIQUE KEY `companies_url_unique` (`url`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_companies`
--
ALTER TABLE `members_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_invites`
--
ALTER TABLE `members_invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pows`
--
ALTER TABLE `pows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recruitments_slug_unique` (`slug`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribejobs`
--
ALTER TABLE `subscribejobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members_companies`
--
ALTER TABLE `members_companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members_invites`
--
ALTER TABLE `members_invites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pows`
--
ALTER TABLE `pows`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recruitments`
--
ALTER TABLE `recruitments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribejobs`
--
ALTER TABLE `subscribejobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 06 2016 г., 15:44
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test8`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(250) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `date_added` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `is_active`, `vendor`, `date_added`, `date_modified`) VALUES
(1, 'risperidone', 'Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus. Phasellus in felis. Donec semper sapien a libero.', 174.67, '', 1, 'Lake Erie Medical DBA Quality Care Products LLC', '2016-03-30', '2016-03-30'),
(2, 'Cetirizine hydrochloride', 'Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo.', 405.06, '', 1, 'Perrigo New York Inc', '2016-03-30', '2016-03-30'),
(3, 'OCTINOXATE and TITANIUM DIOXIDE', 'Fusce consequat. Nulla nisl. Nunc nisl. Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa.', 781.09, '', 0, 'SHISEIDO AMERICA INC.', '2016-03-30', '2016-03-30'),
(4, 'Levomefolate Calcium, Pyridoxal 5-Phosphate, and M', 'In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet. Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.', 485.79, '', 0, 'Virtus Pharmaceuticals', '2016-03-30', '2016-03-30'),
(5, 'Menthol and Pectin', 'Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', 830.43, '', 1, 'Insight Pharmaceuticals', '2016-03-30', '2016-03-30'),
(6, 'Quinapril', 'Integer non velit. Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitud', 713.13, '', 0, 'Lupin Pharmaceuticals, Inc.', '2016-03-30', '2016-03-30'),
(7, 'Pseudoephedrine hydrochloride', 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec', 524.89, '', 1, 'Ohm Laboratories Inc.', '2016-03-30', '2016-03-30'),
(8, 'Fosinopril Sodium and Hydrochlorothiazide', 'Maecenas pulvinar lobortis est. Phasellus sit amet erat. Nulla tempus.', 565.88, '', 0, 'Ranbaxy Pharmaceuticals Inc.', '2016-03-30', '2016-03-30'),
(9, 'rabeprazole', 'Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', 459.93, '', 0, 'Proficient Rx LP', '2016-03-30', '2016-03-30'),
(10, 'AZITHROMYCIN', 'Aliquam erat volutpat. In congue. Etiam justo. Etiam pretium iaculis justo. In hac habitasse platea dictumst.', 606.83, '', 1, 'WOCKHARDT USA LLC.', '2016-03-30', '2016-03-30'),
(11, 'Ibuprofen', 'Etiam pretium iaculis justo. In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus. Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', 217.73, '', 1, 'Major Pharmaceuticals', '2016-03-30', '2016-03-30'),
(12, 'Octinoxate and Titanium dioxide', 'Nunc rhoncus dui vel sem. Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci.', 623.49, '', 1, 'SHISEIDO CO., LTD.', '2016-03-30', '2016-03-30'),
(13, 'Heparin Sodium', 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum. In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat ferme', 484.33, '', 1, 'McKesson Packaging Services Business Unit of McKes', '2016-03-30', '2016-03-30'),
(14, 'Fluvoxamine Maleate', 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus. Phasellus in felis.', 838.39, '', 1, 'NCS HealthCare of KY, Inc dba Vangard Labs', '2016-03-30', '2016-03-30'),
(15, 'LAGERSTROEMIA INDICA WHOLE', 'Phasellus in felis. Donec semper sapien a libero. Nam dui.', 618.13, '', 1, 'Yein Trading & Global Co., Ltd', '2016-03-30', '2016-03-30'),
(16, 'Minocycline hydrochloride', 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec', 531.26, '', 1, 'REMEDYREPACK INC.', '2016-03-30', '2016-03-30'),
(17, 'Chlophedianol Hydrochloride, Guaifenesin, Phenylep', 'In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate', 668.42, '', 1, 'Portal Pharmaceutical', '2016-03-30', '2016-03-30'),
(18, 'alcohol', 'Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris. Morbi non lectus.', 592.11, '', 1, 'Advanced Beauty Systems, Inc.', '2016-03-30', '2016-03-30'),
(19, 'risperidone', 'Vivamus tortor. Duis mattis egestas metus. Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ', 118.34, '', 0, 'REMEDYREPACK INC.', '2016-03-30', '2016-03-30'),
(20, 'CAMPHOR, CAPSAICIN AND MENTHOL', 'Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem. Sed sagittis.', 781.51, '', 1, 'GUILIN TIANHE PHARMACEUTICAL CO LTD', '2016-03-30', '2016-03-30'),
(21, 'Carbon Dioxide', 'Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.', 113.56, '', 1, 'Nordan Smith Welding Supply', '2016-03-30', '2016-03-30'),
(22, 'Chinese Elm', 'Sed ante. Vivamus tortor. Duis mattis egestas metus.', 612.88, '', 1, 'Nelco Laboratories, Inc.', '2016-03-30', '2016-03-30'),
(23, 'ENALAPRIL MALEATE', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam vel augue. Vestibulum rutrum rutrum neque.', 402.5, '', 0, 'State of Florida DOH Central Pharmacy', '2016-03-30', '2016-03-30'),
(24, 'Acetaminophen', 'Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.', 710.52, '', 0, 'Amneal Pharmaceuticals', '2016-03-30', '2016-03-30'),
(25, 'LOVASTATIN', 'Suspendisse potenti. In eleifend quam a odio.', 157.7, '', 0, 'International Labs, Inc.', '2016-03-30', '2016-03-30'),
(26, 'BENZETHONIUM CHLORIDE', 'Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim.', 595.47, '', 1, 'On The Job, LLC', '2016-03-30', '2016-03-30'),
(27, 'HAMAMELIS VIRGINIANA ROOT BARK/STEM BARK', 'Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem. Sed sagittis.', 583.25, '', 1, 'BrandStorm HBC', '2016-03-30', '2016-03-30'),
(28, 'CARBAMAZEPINE', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.', 199.29, '', 1, 'Clinical Solutions Wholesale', '2016-03-30', '2016-03-30'),
(29, 'erlotinib hydrochloride', 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat.', 167.54, '', 0, 'Genentech, Inc.', '2016-03-30', '2016-03-30'),
(30, 'CHLOROXYLENOL', 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus. Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus', 153.55, '', 0, 'GOJO Industries, Inc.', '2016-03-30', '2016-03-30'),
(31, 'FOLIC ACID, FERROUS FUMARATE, ASCORBIC ACID, CHOLE', 'Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat.', 337.93, '', 1, 'JayMac Pharmaceuticals LLC', '2016-03-30', '2016-03-30'),
(32, 'Menthol', 'Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit. Donec diam neque, vestibulum eget, vulpu', 235.92, '', 1, 'Chattem, Inc.', '2016-03-30', '2016-03-30'),
(33, 'IODINE, SODIUM IODIDE, ALCOHOL', 'Nam dui. Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.', 421.16, '', 1, 'McKesson', '2016-03-30', '2016-03-30'),
(34, 'PROTHROMBIN, COAGULATION FACTOR VII HUMAN, COAGULA', 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis. Duis consequat dui nec nisi volutpat eleifend', 857.85, '', 1, 'CSL Behring GmbH', '2016-03-30', '2016-03-30'),
(35, 'White Pine', 'Vivamus in felis eu sapien cursus vestibulum. Proin eu mi.', 479.98, '', 1, 'Nelco Laboratories, Inc.', '2016-03-30', '2016-03-30'),
(36, 'Glycerin', 'Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat.', 290.34, '', 0, 'Ningbo Correway Cosmetics Co., Ltd.', '2016-03-30', '2016-03-30'),
(37, 'diphenhydramine hydrochloride', 'Nam dui. Proin leo odio, porttitor id, consequat in, consequat ut, nulla.', 587.37, '', 0, 'Rebel Distributors Corp', '2016-03-30', '2016-03-30'),
(38, 'Gabapentin', 'Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem. Duis aliquam convallis nunc.', 430.04, '', 0, 'McKesson Contract Packaging', '2016-03-30', '2016-03-30'),
(39, 'bromfenac', 'Vestibulum sed magna at nunc commodo placerat. Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus.', 487.45, '', 1, 'Apotex Corp', '2016-03-30', '2016-03-30'),
(40, 'indomethacin', 'Sed ante. Vivamus tortor.', 852.92, '', 0, 'Mylan Pharmaceuticals Inc.', '2016-03-30', '2016-03-30'),
(41, 'TETRACYCLINE HYDROCHLORIDE', 'Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est. Phasellus sit amet erat.', 782.9, '', 1, 'Phillips Company', '2016-03-30', '2016-03-30'),
(42, 'irbesartan', 'Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, inter', 759.26, '', 1, 'sanofi-aventis U.S. LLC', '2016-03-30', '2016-03-30'),
(43, 'tapentadol hydrochloride', 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat.', 585.04, '', 1, 'Lake Erie Medical DBA Quality Care Products LLC', '2016-03-30', '2016-03-30'),
(44, 'clindamycin hydrochloride', 'In eleifend quam a odio. In hac habitasse platea dictumst. Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.', 585.71, '', 0, 'Pharmacia and Upjohn Company', '2016-03-30', '2016-03-30'),
(45, 'methylprednisolone acetate', 'Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus.', 751.21, '', 1, 'Cardinal Health', '2016-03-30', '2016-03-30'),
(46, 'Loperamide Hydrochloride', 'Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla.', 228.73, '', 0, 'Sam''s West Inc', '2016-03-30', '2016-03-30'),
(47, 'Acetaminophen, Phenylephrine HCl and Dextromethorp', 'Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat. Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.', 835.3, '', 1, 'Target Corporation', '2016-03-30', '2016-03-30'),
(48, 'Agrimony', 'Suspendisse potenti. Cras in purus eu magna vulputate luctus.', 304.95, '', 0, 'BioActive Nutritional, Inc.', '2016-03-30', '2016-03-30'),
(49, 'TITANIUM DIOXIDE, ZINC OXIDE', 'Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat c', 110.14, '', 0, 'SCIENCE OF SKINCARE LLC', '2016-03-30', '2016-03-30'),
(50, 'Verapamil Hydrochloride', 'Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem. Fusce consequat. Nulla nisl. Nunc nisl.', 527.51, '', 0, 'Cardinal Health2', '2016-03-30', '2016-03-30'),
(51, 'qwerty', 'sdfg dfg dfg dfg dfg dfgdf sdfg fg dfsв', 423, 'SELECT * FROM students', 0, 'sfgdfg sdfg sdfg ', '2016-03-30', '2016-04-06');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role`, `login`, `password`, `salt`) VALUES
(1, 'admin', 'admin', '2e3798a5769eab2d70fef31b4687e4c7', 'AmRsUVHcT5Bwde2y8a'),
(2, 'guest', 'guest', '50828851ae01dade716c4a9e0da9763a', 'RkfSy2kIdZJXXojzlXq1'),
(3, 'user', 'max', '0699c40af4726aed1c52b4636a383c95', 'VTh0Z4PWnOCVOr8');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2019 г., 11:53
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bytrack_start`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, 1555586262),
('admin', 2, 1546300800);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Администратор', NULL, NULL, 1555072531, 1555072531),
('canAdmin', 2, 'Право на вход в админ.часть', NULL, NULL, 1555072531, 1555072531),
('manager', 1, 'Начальник отдела', NULL, NULL, 1555072531, 1555072531),
('qa', 1, 'Сотрудник-тестировщик', NULL, NULL, NULL, NULL),
('updateOwnReport', 2, 'Право на редактирование своих репортов', 'isReporter', NULL, 1555072531, 1555072531),
('updateReport', 2, 'Право на редактирование репортов', NULL, NULL, 1555072531, 1555072531),
('worker', 1, 'Сотрудник-программист', NULL, NULL, 1555072531, 1555072531);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'canAdmin'),
('admin', 'manager'),
('admin', 'worker'),
('manager', 'updateReport'),
('manager', 'worker'),
('updateOwnReport', 'updateReport'),
('worker', 'updateOwnReport');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isReporter', 0x4f3a32353a22636f6d6d6f6e5c72756c65735c5265706f7274657252756c65223a333a7b733a343a226e616d65223b733a31303a2269735265706f72746572223b733a393a22637265617465644174223b693a313535353037323533313b733a393a22757064617465644174223b693a313535353037323533313b7d, 1555072531, 1555072531);

-- --------------------------------------------------------

--
-- Структура таблицы `bug_report`
--

CREATE TABLE `bug_report` (
  `bug_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT 0,
  `title` varchar(60) NOT NULL,
  `description` text DEFAULT NULL,
  `playback_steps` text DEFAULT NULL,
  `severity` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `reporter_id` int(11) DEFAULT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `bug_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `filename` text DEFAULT NULL,
  `filepath` text DEFAULT NULL,
  `created` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `file_in_report`
--

CREATE TABLE `file_in_report` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `bug_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1554713259),
('m130524_201442_init', 1554713262),
('m140506_102106_rbac_init', 1554812783),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1554812783),
('m180523_151638_rbac_updates_indexes_without_prefix', 1554812783),
('m190124_110200_add_verification_token_column_to_user_table', 1554713262),
('m190408_085318_create_bug_report_table', 1554718782),
('m190408_100729_add_first_name_and_last_name_to_user_table', 1554718782);

-- --------------------------------------------------------

--
-- Структура таблицы `priority_name`
--

CREATE TABLE `priority_name` (
  `priority_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `priority_name`
--

INSERT INTO `priority_name` (`priority_id`, `name`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `project_participants`
--

CREATE TABLE `project_participants` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(64) NOT NULL DEFAULT 'worker',
  `last_update` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `severity_name`
--

CREATE TABLE `severity_name` (
  `severity_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `severity_name`
--

INSERT INTO `severity_name` (`severity_id`, `name`) VALUES
(1, 'Blocker'),
(2, 'Critical'),
(3, 'Major'),
(4, 'Minor'),
(5, 'Trivial');

-- --------------------------------------------------------

--
-- Структура таблицы `status_name`
--

CREATE TABLE `status_name` (
  `status_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status_name`
--

INSERT INTO `status_name` (`status_id`, `name`) VALUES
(1, 'Open'),
(2, 'Closed'),
(3, 'In Progress'),
(4, 'Resolved'),
(5, 'Reopened'),
(6, 'In QA');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `gender`, `avatar`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'byback', 'Alexander', 'Vanin', '0', '6218ab5b125c7e930af99f0f85e79b13.jpg', 'Q-pBgdyHfxk8IVicB2_7Ryrn1uiX28iH', '$2y$13$iMJfDRQbqjoj8vcdKjuERePcfbUJZbvWyK7q6721.eKorFMDLjPgS', NULL, 'av.chezz@gmail.com', 10, 1554713423, 1556544136, '0CM2bdO0OUpUv-eceouPQiKnhjofdFYm_1554713423'),
(2, 'admin', 'Admin', 'Admin', 'Male', NULL, 'HAMP8VmIqTBeHpsul692KAisrFVxKrvl', '$2y$13$6CGGTW4Tv6NS7D7UdbkNd.eupTa5TGrcWhfQyJjwTWXE4O.wsFmAm', NULL, 'admin@example.com', 10, 1546300800, 1546300800, 'JdrT606FM3eLfNg-G6C8wFoG0XGu_uoq_1560847746');

-- --------------------------------------------------------

--
-- Структура таблицы `work_log`
--

CREATE TABLE `work_log` (
  `id` int(11) NOT NULL,
  `bug_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_time` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `bug_report`
--
ALTER TABLE `bug_report`
  ADD PRIMARY KEY (`bug_id`),
  ADD KEY `IDX_reporter_id` (`reporter_id`),
  ADD KEY `IDX_destination_id` (`destination_id`),
  ADD KEY `FK_status_report` (`status`),
  ADD KEY `FK_severity_report` (`severity`),
  ADD KEY `FK_priority_report` (`priority`),
  ADD KEY `FK_project_user` (`project_id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_bug_comment` (`bug_id`),
  ADD KEY `FK_author_comment` (`author_id`);

--
-- Индексы таблицы `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `file_in_report`
--
ALTER TABLE `file_in_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_to_file` (`file_id`),
  ADD KEY `FK_to_bug` (`bug_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `priority_name`
--
ALTER TABLE `priority_name`
  ADD PRIMARY KEY (`priority_id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `project_participants`
--
ALTER TABLE `project_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_project_id` (`project_id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- Индексы таблицы `severity_name`
--
ALTER TABLE `severity_name`
  ADD PRIMARY KEY (`severity_id`);

--
-- Индексы таблицы `status_name`
--
ALTER TABLE `status_name`
  ADD PRIMARY KEY (`status_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `work_log`
--
ALTER TABLE `work_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_bug_time` (`bug_id`),
  ADD KEY `FK_user_time` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bug_report`
--
ALTER TABLE `bug_report`
  MODIFY `bug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `file_in_report`
--
ALTER TABLE `file_in_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `project_participants`
--
ALTER TABLE `project_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `severity_name`
--
ALTER TABLE `severity_name`
  MODIFY `severity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `work_log`
--
ALTER TABLE `work_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `FK_user_assignment` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `bug_report`
--
ALTER TABLE `bug_report`
  ADD CONSTRAINT `FK_destination_user` FOREIGN KEY (`destination_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_priority_report` FOREIGN KEY (`priority`) REFERENCES `priority_name` (`priority_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_project_user` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reporter_user` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_severity_report` FOREIGN KEY (`severity`) REFERENCES `severity_name` (`severity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_status_report` FOREIGN KEY (`status`) REFERENCES `status_name` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_author_comment` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bug_comment` FOREIGN KEY (`bug_id`) REFERENCES `bug_report` (`bug_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `file_in_report`
--
ALTER TABLE `file_in_report`
  ADD CONSTRAINT `FK_to_bug` FOREIGN KEY (`bug_id`) REFERENCES `bug_report` (`bug_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_to_file` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `project_participants`
--
ALTER TABLE `project_participants`
  ADD CONSTRAINT `FK_project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `work_log`
--
ALTER TABLE `work_log`
  ADD CONSTRAINT `FK_bug_time` FOREIGN KEY (`bug_id`) REFERENCES `bug_report` (`bug_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_time` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

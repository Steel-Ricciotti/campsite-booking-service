CREATE TABLE `booking` (
 `booking_id` int(11) NOT NULL AUTO_INCREMENT,
 `campsite_id` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 `checkin` date NOT NULL,
 `checkout` date NOT NULL,
 `tent_rental` tinyint(1) DEFAULT NULL,
 `camping_gear` tinyint(1) DEFAULT NULL,
 PRIMARY KEY (`booking_id`),
 KEY `campsite_id` (`campsite_id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`campsite_id`) REFERENCES `campsites` (`campsite_id`) ON DELETE CASCADE,
 CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `campsites` (
 `campsite_id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) DEFAULT NULL,
 `type` varchar(50) DEFAULT NULL,
 `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
 `price` decimal(10,2) DEFAULT NULL,
 `availability` text DEFAULT NULL,
 `image_url` text NOT NULL,
 `featured` tinyint(1) NOT NULL,
 PRIMARY KEY (`campsite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

	CREATE TABLE `users` (
 `user_id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) DEFAULT NULL,
 `password_hash` varchar(255) DEFAULT NULL,
 `email` varchar(100) DEFAULT NULL,
 `role` enum('user','admin') DEFAULT 'user',
 `profile_info` text DEFAULT NULL,
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
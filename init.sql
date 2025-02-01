CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `task` varchar(250) NOT NULL,
  `status` varchar(30) NOT NULL
);

INSERT INTO `task` VALUES
(1, 'Read an article on React.js', 'Done'),
(2, 'Organize a meeting', 'Pending');

-- Reset the auto-increment to continue from our last insert
ALTER TABLE `task` AUTO_INCREMENT=3;
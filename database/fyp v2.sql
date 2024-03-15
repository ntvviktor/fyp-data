-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 08:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--
CREATE DATABASE IF NOT EXISTS `fyp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fyp`;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `rating` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `author`, `rating`) VALUES
(1, 'The Woke Salaryman Crash Course on Capitalism & Money: Lessons from the World\'s Most Expensive City', 26.30, 'The Woke Salaryman', '4.6'),
(2, 'Thinking, Fast and Slow', 11.90, 'Daniel Kahneman', '4.6'),
(3, 'The Psychology of Money: Timeless lessons on wealth, greed, and happiness', 0.00, 'Morgan Housel', '4.7'),
(4, 'Never Split the Difference: Negotiating as if Your Life Depended on It', 13.40, 'Chris Voss', '4.7'),
(5, 'Hidden Potential: The Science of Achieving Greater Things', 15.20, 'Adam Grant', '4.7'),
(6, 'Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones', 16.20, 'James Clear', '4.8'),
(7, 'The Almanack of Naval Ravikant: A Guide to Wealth and Happiness', 14.98, 'Eric Jorgenson', '4.7'),
(8, 'Die With Zero: Getting All You Can from Your Money and Your Life', 18.00, 'Bill Perkins', '4.5'),
(9, 'The First 90 Days: Proven Strategies for Getting Up to Speed Faster and Smarter, Updated and Expanded', 25.40, 'Michael D. Watkins', '4.6'),
(10, 'The 48 Laws of Power', 23.13, 'Robert Greene', '4.7'),
(11, 'The Intelligent Investor', 28.24, 'Benjamin Graham', '4.6'),
(12, 'The Diary of a CEO: The 33 Laws of Business and Life', 40.13, 'Steven Bartlett', '4.7'),
(13, 'Dead in the Water: A True Story of Hijacking, Murder, and a Global Maritime Conspiracy', 30.68, 'Matthew Campbell', '4.6'),
(14, 'Your Complete Guide to Factor-Based Investing: The Way Smart Money Invests Today', 23.37, 'Andrew L Berkin', '4.5'),
(15, 'Unreasonable Hospitality: The Remarkable Power of Giving People More Than They Expect', 17.25, 'Will Guidara', '4.8'),
(16, 'Sharon Sim', 27.14, 'Sharon Sim', 'NULL'),
(17, 'The Daily Stoic: 366 Meditations on Wisdom, Perseverance, and the Art of Living', 17.84, 'Ryan Holiday', '4.8'),
(18, 'Mastery', 22.84, 'Robert Greene', '4.7'),
(19, 'How to Win Friends and Influence People', 12.85, 'Dale Carnegie', '4.7'),
(20, 'Hacking Growth: How Today\'s Fastest-Growing Companies Drive Breakout Success', 31.99, 'Sean Ellis', '4.6'),
(21, '(ISC)2 CISSP Certified Information Systems Security Professional Official Study Guide & Practice Tests Bundle', 82.84, 'Mike Chapple', '4.8'),
(22, 'The World for Sale: Money, Power, and the Traders Who Barter the Earth\'s Resources', 28.89, 'Chief Energy Correspondent Javier Blas', '4.7'),
(23, 'Million Dollar Weekend: The Surprisingly Simple Way to Launch a 7-Figure Business in 48 Hours', 37.37, 'Noah Kagan', '4.9'),
(24, 'The Five Dysfunctions of a Team: A Leadership Fable: A Leadership Fable, 20th Anniversary Edition', 29.62, 'Patrick Lencioni', '4.6'),
(25, 'Start with Why: How Great Leaders Inspire Everyone to Take Action', 17.94, 'Simon Sinek', '4.6'),
(26, 'Can\'t Hurt Me: Master Your Mind and Defy the Odds', 32.41, 'David Goggins', '4.8'),
(27, 'End Times: Elites, Counter-Elites and the Path of Political Disintegration', 21.00, 'Peter Turchin', '4.4'),
(28, 'Mastering Uncertainty: How great founders, entrepreneurs and business leaders thrive in an unpredictable world', 8.85, 'Matt Watkinson', '3.6'),
(29, 'Nudge: The Final Edition', 22.74, 'Richard H. Thaler', '4.6'),
(30, 'Flying Blind: The 737 MAX Tragedy and the Fall of Boeing', 22.04, 'Peter Robison', '4.5'),
(31, 'Dare to Lead: Brave Work. Tough Conversations. Whole Hearts.', 20.00, 'Bren? Brown', '4.7'),
(32, 'Iwoz: Computer Geek to Cult Icon', 27.50, 'Steve Wozniak', '4.5'),
(33, 'Just for Fun: The Story of an Accidental Revolutionary', 23.63, 'Linus Torvalds', '4.7'),
(34, 'Iacocca: An Autobiography', 33.64, 'Lee Iacocca', '4.6'),
(35, 'Same as Ever: A Guide to What Never Changes', 22.87, 'Morgan Housel', '4.5'),
(36, 'Trading: Technical Analysis Masterclass: Master the financial markets', 16.33, 'Rolf Schlotmann', '4.4'),
(37, 'Same as Ever: Timeless Lessons on Risk, Opportunity and Living a Good Life', 17.83, 'Morgan Housel', '4.5'),
(38, 'The Bed of Procrustes: Philosophical and Practical Aphorisms: 4', 34.94, 'Nassim Nicholas Taleb', '4.4'),
(39, '12 Rules for Life: An Antidote to Chaos', 10.90, 'Jordan B. Peterson', '4.7'),
(40, 'Never Split the Difference: Negotiating As If Your Life Depended On It', 15.96, 'Chris Voss', '4.7'),
(41, 'Hacking Growth: How Today\'s Fastest-Growing Companies Drive Breakout Success', 27.00, 'Morgan Brown', '4.6'),
(42, 'Profit First: Transform Your Business from a Cash-Eating Monster to a Money-Making Machine', 20.00, 'Mike Michalowicz', '4.8'),
(43, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not!', 10.10, 'Robert T. Kiyosaki', '4.7'),
(44, 'The Laws of Human Nature', 20.28, 'Robert Greene', '4.8'),
(45, 'Think Faster, Talk Smarter: How to Speak Successfully When You\'re Put on the Spot', 20.88, 'Matt Abrahams', '4.6'),
(46, 'Leaders Eat Last: Why Some Teams Pull Together and Others Don\'t', 22.95, 'Simon Sinek', '4.7'),
(47, 'No Rules Rules: Netflix and the Culture of Reinvention', 25.00, 'Reed Hastings', '4.7'),
(48, 'Traction: Get a Grip on Your Business', 24.87, 'Gino Wickman', '4.6'),
(49, 'The Subtle Art of Not Giving a Fuck: A Counterintuitive Approach to Living a Good Life', 17.40, 'Mark Manson', '4.6'),
(50, 'The Daily Stoic: 366 Meditations on Wisdom, Perseverance, and the Art of Living', 17.84, 'NULL', '4.8'),
(51, 'Powerful Leadership Through Coaching: Principles, Practices, and Tools for Leaders and Managers at Every Level', 33.66, 'NULL', '4.7'),
(52, 'Mastering Bitcoin: Programming the Open Blockchain', 76.24, 'NULL', '4.7'),
(53, 'S Vasoo', 48.60, 'NULL', 'NULL'),
(54, 'Sharon Sim', 27.14, 'NULL', 'NULL'),
(55, 'Any Happy Returns: Structural Changes and Super Cycles in Markets', 44.85, 'NULL', '5'),
(56, 'The Business Case for AI: A Leader\'s Guide to AI Strategies, Best Practices & Real-World Applications', 23.27, 'NULL', '4.4'),
(57, 'Paris to the Moon', 26.15, 'NULL', '4.4'),
(58, 'The Diary of a CEO: The 33 Laws of Business and Life', 40.13, 'NULL', '4.7'),
(59, 'Dead in the Water: A True Story of Hijacking, Murder, and a Global Maritime Conspiracy', 30.68, 'NULL', '4.6'),
(60, 'Mastery', 22.84, 'NULL', '4.7'),
(61, 'DisneyWar', 29.06, 'NULL', '4.6'),
(62, 'Nicolas Stephan', 65.88, 'NULL', 'NULL'),
(63, 'Nudge: The Final Edition', 34.98, 'NULL', '4.6'),
(64, 'Think Again: The Power of Knowing What You Don\'t Know', 24.18, 'NULL', '4.7'),
(65, 'Your Complete Guide to Factor-Based Investing: The Way Smart Money Invests Today', 23.37, 'NULL', '4.5'),
(66, 'Leading: Lessons in leadership from the legendary Manchester United manager', 25.34, 'NULL', '4.6'),
(67, 'Drunk Tank Pink: And Other Unexpected Forces That Shape How We Think, Feel, and Behave', 30.00, 'NULL', '4.4'),
(68, 'Unreasonable Hospitality: The Remarkable Power of Giving People More Than They Expect', 17.25, 'NULL', '4.8'),
(69, 'Principle-Centered Leadership', 24.83, 'NULL', '4.6'),
(70, 'The Enneagram Development Guide', 60.91, 'NULL', '4.7'),
(71, 'Nothing But Net: 10 Timeless Stock-Picking Lessons from One of Wall Street?s Top Tech Analysts', 41.01, 'NULL', '4.3'),
(72, 'A Sun Tzu\'s Art of War for Women: Strategies for Winning without Conflict - Revised with a New Introduction', 22.47, 'NULL', '4.5'),
(73, 'A New Way to Think: Your Guide to Superior Management Effectiveness', 32.00, 'NULL', '4.7'),
(74, '(ISC)2 CISSP Certified Information Systems Security Professional Official Study Guide & Practice Tests Bundle', 82.62, 'NULL', '4.8'),
(75, 'Million Dollar Weekend: The Surprisingly Simple Way to Launch a 7-Figure Business in 48 Hours', 37.37, 'NULL', '4.9'),
(76, 'Hacking Growth: How Today\'s Fastest-Growing Companies Drive Breakout Success', 31.99, 'NULL', '4.6'),
(77, 'The Five Dysfunctions of a Team: A Leadership Fable: A Leadership Fable, 20th Anniversary Edition', 29.62, 'NULL', '4.6'),
(78, 'Can\'t Hurt Me: Master Your Mind and Defy the Odds', 32.41, 'NULL', '4.8'),
(79, 'The World for Sale: Money, Power, and the Traders Who Barter the Earth\'s Resources', 28.89, 'NULL', '4.7'),
(80, 'Dare to Lead: Brave Work. Tough Conversations. Whole Hearts.', 20.00, 'NULL', '4.7'),
(81, 'End Times: Elites, Counter-Elites and the Path of Political Disintegration', 21.00, 'NULL', '4.4'),
(82, 'Same as Ever: A Guide to What Never Changes', 22.87, 'NULL', '4.5'),
(83, 'Never Split the Difference: Negotiating As If Your Life Depended On It', 15.96, 'NULL', '4.7'),
(84, 'The Laws of Human Nature', 20.28, 'NULL', '4.8'),
(85, 'Mastering Uncertainty: How great founders, entrepreneurs and business leaders thrive in an unpredictable world', 8.85, 'NULL', '3.6'),
(86, '12 Rules for Life: An Antidote to Chaos', 10.90, 'NULL', '4.7'),
(87, 'Flying Blind: The 737 MAX Tragedy and the Fall of Boeing', 22.04, 'NULL', '4.5'),
(88, 'Think Faster, Talk Smarter: How to Speak Successfully When You\'re Put on the Spot', 20.88, 'NULL', '4.6'),
(89, 'Iwoz: Computer Geek to Cult Icon', 27.50, 'NULL', '4.5'),
(90, 'Just for Fun: The Story of an Accidental Revolutionary', 23.63, 'NULL', '4.7'),
(91, 'Iacocca: An Autobiography', 33.64, 'NULL', '4.6'),
(92, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not!', 10.10, 'NULL', '4.7'),
(93, 'Feel-Good Productivity: How to Achieve More of the Things That Matter', 20.05, 'NULL', '4.7'),
(94, 'Same as Ever: Timeless Lessons on Risk, Opportunity and Living a Good Life', 17.83, 'NULL', '4.5'),
(95, 'Trading: Technical Analysis Masterclass: Master the financial markets', 16.33, 'NULL', '4.4'),
(96, 'Hacking Growth: How Today\'s Fastest-Growing Companies Drive Breakout Success', 27.00, 'NULL', '4.6'),
(97, 'No Rules Rules: Netflix and the Culture of Reinvention', 25.00, 'NULL', '4.7'),
(98, 'Profit First: Transform Your Business from a Cash-Eating Monster to a Money-Making Machine', 20.00, 'NULL', '4.8'),
(99, 'The Bed of Procrustes: Philosophical and Practical Aphorisms: 4', 34.94, 'NULL', '4.4');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `full_name`) VALUES
(1, 'wj', '$2y$10$7cAyvKlbAtOoFE6BMP1p0e2JMlord3UG8h7N6fsd5a2Ad86rckunK', 'weijie@gmail.com', 'Wei Jie'),
(16, 'jr', '$2y$10$pu6IgztxeRt7hi.Bwn19yezjb8EF8fjJyScyhKPXGpzOj0mUc/2XK', 'jr@gmail.com', 'Jun Ren');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `genre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `username`, `age`, `gender`, `occupation`, `genre`) VALUES
(2, 'jr', 18, 'male', 'doctor', 'Romance'),
(3, 'wj', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

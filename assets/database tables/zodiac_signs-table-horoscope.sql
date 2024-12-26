-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 02:03 PM
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
-- Database: `horoscope_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `zodiac_signs`
--

CREATE TABLE `zodiac_signs` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `zodiac_name` varchar(255) NOT NULL,
  `zodiac_date_range` varchar(255) NOT NULL,
  `zodiac_desc` text,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `zodiac_signs`
--

INSERT INTO `zodiac_signs` (`id`,`zodiac_name`, `zodiac_date_range`, `zodiac_desc`, `created_at`) VALUES
(0, 'Aquarius', 'January 20 - February 18', 'Aquarius is the eleventh sign of the zodiac, and Aquarians are the perfect representatives for the Age of Aquarius. Those born under this horoscope sign have the social conscience needed to carry us into the new millennium. These folks are humanitarian, philanthropic and keenly interested in making the world a better place.', current_timestamp(6)),
(1, 'Pisces', 'February 19 - March 20', 'Pisces is the twelfth sign of the zodiac, and it is also the final sign in the zodiacal cycle. Hence, this sign brings together many of the characteristics of the eleven signs that have come before it. Pisces, however, are happiest keeping many of these qualities under wraps. These folks are selfless, spiritual and very focused on their inner journey.', current_timestamp(6)),
(2, 'Aries', 'March 21 - April 19', 'Aries is the first sign of the zodiac, and that’s pretty much how those born under this sign see themselves: first. Aries are the leaders of the pack, first in line to get things going. Whether or not everything gets done is another question altogether, for an Aries prefers to initiate rather than to complete.', current_timestamp(6)),
(3, 'Taurus', 'April 20 - May 20', 'Taurus is the second sign of the zodiac, and it is all about reward. Taurus loves the rewards of the game, whether it’s material possessions or a well-deserved pat on the back. Taurus is an earth sign known for its values, as well as its determination.', current_timestamp(6)),
(4, 'Gemini', 'May 21 - June 20', 'Gemini is the third sign of the zodiac, and those born under this sign will be quick to tell you all about it. That’s because they love to talk! It’s not just idle chatter with these folks, either. The driving force behind a Gemini’s conversation is their mind.', current_timestamp(6)),
(5, 'Cancer', 'June 21 - July 22', 'Cancer is the fourth sign of the zodiac, and it’s all about home. Those born under this horoscope sign are ‘roots’ kinds of people, and take great pleasure in the comforts of home and family. Cancers are very loyal and empathetic.', current_timestamp(6)),
(6, 'Leo', 'July 23 - August 22', 'Leo is the fifth sign of the zodiac. These folks are impossible to miss, since they love being center stage. Making an impression is Job One for Leos, and when you consider their personal magnetism, you see the job is quite easy.', current_timestamp(6)),
(7, 'Virgo', 'August 23 - September 22', 'Virgo is the sixth sign of the zodiac, and Virgos are all about details. Those born under this horoscope sign are forever the butt of jokes for being so picky and critical (and they can be), but their ‘attention to detail’ is for a reason: to help others.', current_timestamp(6)),
(8, 'Libra', 'September 23 - October 22', 'Libra is the seventh sign of the zodiac. Libras are first and foremost focused on others and how they relate to them. We can call this the sign of partnership with a capital ‘P’ because these folks do not want to be alone.', current_timestamp(6)),
(9, 'Scorpio', 'October 23 - November 21', 'Scorpio is the eighth sign of the zodiac. It’s the sign of sex and death, and those born under this sign are known for their intensity. Scorpios are determined, forceful, emotional, intuitive, powerful, passionate, exciting, and magnetic.', current_timestamp(6)),
(10, 'Sagittarius', 'November 22 - December 21', 'Sagittarius is the ninth sign of the zodiac. These folks are the travelers of the zodiac. It’s not a mindless ramble for them, either. Sagittarians are truth-seekers, and the best way for them to do this is to hit the road, talk to others, and get some answers.', current_timestamp(6)),
(11, 'Capricorn', 'December 22 - January 19', 'Capricorn is the tenth sign of the zodiac, and the last and most serious of the earth signs. The Capricorn-born are more than happy to put in a full day at the office, realizing that it will likely take a lot of those days to get to the top.', current_timestamp(6));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zodiac_signs`
--
ALTER TABLE `users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
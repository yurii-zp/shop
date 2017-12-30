-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 03:23 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `10632shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` int(11) NOT NULL,
  `item` varchar(64) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `pricein` decimal(7,2) DEFAULT NULL,
  `pricesale` decimal(7,2) DEFAULT NULL,
  `datesale` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `item`, `itemid`, `pricein`, `pricesale`, `datesale`) VALUES
(3, 'Bose - SoundSport In-Ear Headphones (iOS)', 17, '87.25', '99.99', '2017-11-15 20:54:02'),
(2, 'Samsung Galaxy S8', 2, '670.00', '750.00', '2017-11-14 20:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `orderid` varchar(32) DEFAULT NULL,
  `datein` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `itemid`, `price`, `username`, `orderid`, `datein`) VALUES
(1, 13, '29.99', 'Test', '5a09600b2b51c', '2017-12-14 18:02:18'),
(2, 7, '549.99', 'Test', '5a09600b2b51c', '2017-11-14 17:51:27'),
(3, 16, '3.99', NULL, '5a0b2c0886cd6', '2017-11-14 19:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Mobile Phones'),
(2, 'Cases'),
(3, 'Headphones');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `comment` text,
  `rating` int(11) DEFAULT NULL,
  `curdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `itemid`, `title`, `comment`, `rating`, `curdate`) VALUES
(1, 'Test', 18, 'These are some of the best sounding earbuds!', 'These are some of the best sounding earbuds that I have ever owned. They are better than others that I have paid even more for and have more features. This is the third pair that I own because they are so good.', 5, '2017-11-14 19:00:56'),
(2, 'New', 17, 'Incredible', 'I have had these for not so long, but these help me to hear music in a different way. They are without a doubt the best earbuds i\'ve ever used!', 5, '2017-11-14 19:33:48'),
(3, 'Test', 17, 'Right ear no sound after 3 months of use', 'Cost me $100 but the right ear was no sound for some reason, the whole thing has no physical damage, it seems something happened inside the rubber cover, but it still looks new from the outside.', 1, '2017-11-14 19:34:45'),
(4, 'New', 12, 'Great with flaws', 'This is short and just my concerns with the device.\r\n\r\n1. I live in Michigan and it’s freezing here a lot, the screen will lock up very badly in cold. \r\n2. Batter life is subpar even compared to iPhone 8\r\n3. Optimization for apps (which will eventually be fixed)', 3, '2017-11-14 19:40:16'),
(5, 'Raw', 2, 'So far I\'m loving this phone', 'Sooooo, I\'ve only had the phone for a week and coming off of using LG phones the last was a V10(chronic overheating to point of getting screen burn in images to Bluetooth that wouldn\'t stay connected, etc). I\'m still getting used to it. Things i don\'t like or have not figured out is on the LG I could add screens as well as control how to swipe between them i want a continual loop which means instead of when I get to the last screen I could get to the first screen without swiping backwards. I had a lot of memos from my LG but fo not know how to move them. The clock/alarm do my alarms have to be on the screen as a widget. I was able to connect my phone to my Bluetooth headphones but not to the car Bluetooth. Not crazy about he volume buttons but it maybe the case its in, I have RA so they can be a pain when I\'m in pain. The battery seems to be great have not had any overheating (yaaaay).This phone has the most amazing camera. I love the Samsung health app, it is pretty accurate comparing it to pulse taken by a fitbit and a blood pressure cuff. Ultimately im still learning. Hopefully I can figure out the quirky things. Technology is great when it works however it is not without its flaws because it is designed by people which aren\'t prefect.', 4, '2017-11-14 20:05:35'),
(6, 'Asa', 2, 'To infinity and beyond!', 'Recently had to retire my Samsung Galaxy S5, and I was very happy with that phone performance wise (I\'m going to really miss that removable battery), but since I\'m a photography nut, I needed a lower F-stop (f1.7) for low light shooting and optical image stabilization, two things the S5 lacked. Enter the Galaxy S8!\r\nThey literally did take the screen to infinity! The large, 5.8-inch curved screen is a joy to look at and definitely a step up from my S5\'s 5.1" screen, which wasn\'t terrible or anything, but it is easier on the eyes; to surf the web, read text, watch YouTube vids, Hulu and Netflix. Less eye strain. Even though the screen is bigger, the S8 feels way lighter than my old S5, thanks to the smaller bezel. And one hand operation is a breeze!\r\nThe 12MP rear-camera is a very good, high-resolution camera with tremendous manual control - if you want it. The rear camera takes way better pics than the S5 did. I no longer have to stand completely still for 10 seconds just to take a low-light pic. The 8MP selfie camera on the front is also a HUGE upgrade to the 2MP front camera I had on my Galaxy S5.\r\nThis is also the first smartphone camera with built-in selfie lens effects. That’s right, if you can’t wait to open Snapchat or Instagram Stories, the Galaxy S8 lets you apply animated stickers to your face on your selfies, stills and video, IF you\'re into that sort of thing. You can then share them on whatever app you want.', 5, '2017-11-14 20:10:14'),
(7, 'Raw', 17, 'Great', 'I would like to give 5 stars but I don\'t know if it\'s my phone but they keep disconnecting. I have to turn them on constantly other than that the are great.', 4, '2017-11-15 21:06:30'),
(8, 'Raw', 12, 'The Best Phone', 'I have just received this phone for about 2 hours now and it is amazing. I have already gotten used to the controls and it is sooo easy to navigate', 5, '2017-12-15 17:05:05'),
(9, 'Test', 3, 'Former iPhone User', 'Just switched to Galaxy S8 plus and couldn\'t be happier. Much larger and much higher resolution screen, great camera, and absolutely loaded with useful features. I cannot ever see myself going back to an Apple product.', 5, '2017-12-15 18:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `imagepath` varchar(256) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `imagepath`, `itemid`, `catid`) VALUES
(1, '../images/content/1/1/1-samsung-galaxy-j3prime-1.jpg', 1, 1),
(2, '../images/content/1/1/1-samsung-galaxy-j3prime-2.jpg', 1, 1),
(3, '../images/content/1/1/1-samsung-galaxy-j3prime-3.jpg', 1, 1),
(4, '../images/content/1/1/1-samsung-galaxy-j3prime-4.jpg', 1, 1),
(5, '../images/content/1/2/2-samsung-galaxy-s8-1.jpg', 2, 1),
(6, '../images/content/1/2/2-samsung-galaxy-s8-2.jpg', 2, 1),
(7, '../images/content/1/2/2-samsung-galaxy-s8-3.jpg', 2, 1),
(8, '../images/content/1/2/2-samsung-galaxy-s8-4.jpg', 2, 1),
(9, '../images/content/1/3/3-samsung-galaxy-s8plus-1.jpg', 3, 1),
(10, '../images/content/1/3/3-samsung-galaxy-s8plus-2.jpg', 3, 1),
(11, '../images/content/1/3/3-samsung-galaxy-s8plus-3.jpg', 3, 1),
(12, '../images/content/1/3/3-samsung-galaxy-s8plus-4.jpg', 3, 1),
(13, '../images/content/1/4/4-samsung-galaxy-note8-1.jpg', 4, 1),
(14, '../images/content/1/4/4-samsung-galaxy-note8-2.jpg', 4, 1),
(15, '../images/content/1/4/4-samsung-galaxy-note8-3.jpg', 4, 1),
(16, '../images/content/1/4/4-samsung-galaxy-note8-4.jpg', 4, 1),
(17, '../images/content/1/5/5-apple-iphone-se-1.jpg', 5, 1),
(18, '../images/content/1/5/5-apple-iphone-se-2.jpg', 5, 1),
(19, '../images/content/1/5/5-apple-iphone-se-3.jpg', 5, 1),
(20, '../images/content/1/5/5-apple-iphone-se-4.jpg', 5, 1),
(21, '../images/content/1/6/6-apple-iphone-6s-1.jpg', 6, 1),
(22, '../images/content/1/6/6-apple-iphone-6s-2.jpg', 6, 1),
(23, '../images/content/1/6/6-apple-iphone-6s-3.jpg', 6, 1),
(24, '../images/content/1/7/7-apple-iphone-6splus-1.jpg', 7, 1),
(25, '../images/content/1/7/7-apple-iphone-6splus-2.jpg', 7, 1),
(26, '../images/content/1/7/7-apple-iphone-6splus-3.jpg', 7, 1),
(27, '../images/content/1/8/8-apple-iphone-7-1.jpg', 8, 1),
(28, '../images/content/1/8/8-apple-iphone-7-2.jpg', 8, 1),
(29, '../images/content/1/8/8-apple-iphone-7-3.jpg', 8, 1),
(30, '../images/content/1/9/9-apple-iphone-7plus-1.jpg', 9, 1),
(31, '../images/content/1/9/9-apple-iphone-7plus-2.jpg', 9, 1),
(32, '../images/content/1/9/9-apple-iphone-7plus-3.jpg', 9, 1),
(33, '../images/content/1/10/10-apple-iphone-8-1.jpg', 10, 1),
(34, '../images/content/1/10/10-apple-iphone-8-2.jpg', 10, 1),
(35, '../images/content/1/10/10-apple-iphone-8-3.jpg', 10, 1),
(36, '../images/content/1/11/11-apple-iphone-8plus-1.jpg', 11, 1),
(37, '../images/content/1/11/11-apple-iphone-8plus-2.jpg', 11, 1),
(38, '../images/content/1/11/11-apple-iphone-8plus-3.jpg', 11, 1),
(39, '../images/content/1/12/12-apple-iphone-X-1.jpg', 12, 1),
(40, '../images/content/1/12/12-apple-iphone-X-2.jpg', 12, 1),
(41, '../images/content/1/12/12-apple-iphone-X-3.jpg', 12, 1),
(42, '../images/content/2/13/13-case-apple-iphone-7-1.jpg', 13, 2),
(43, '../images/content/2/13/13-case-apple-iphone-7-2.jpg', 13, 2),
(44, '../images/content/2/13/13-case-apple-iphone-7-3.jpg', 13, 2),
(45, '../images/content/2/14/14-case-apple-iphone-7plus-1.jpg', 14, 2),
(46, '../images/content/2/14/14-case-apple-iphone-7plus-2.jpg', 14, 2),
(47, '../images/content/2/14/14-case-apple-iphone-7plus-3.jpg', 14, 2),
(48, '../images/content/2/15/15-case-apple-iphone-8plus-1.jpg', 15, 2),
(49, '../images/content/2/15/15-case-apple-iphone-8plus-2.jpg', 15, 2),
(50, '../images/content/2/15/15-case-apple-iphone-8plus-3.jpg', 15, 2),
(51, '../images/content/3/16/16-insignia-headphones-1.jpg', 16, 3),
(52, '../images/content/3/16/16-insignia-headphones-2.jpg', 16, 3),
(53, '../images/content/3/17/17-bose-headphones-1.jpg', 17, 3),
(54, '../images/content/3/17/17-bose-headphones-2.jpg', 17, 3),
(55, '../images/content/3/17/17-bose-headphones-3.jpg', 17, 3),
(56, '../images/content/3/18/18-apple-headphones-1.jpg', 18, 3),
(57, '../images/content/3/18/18-apple-headphones-2.jpg', 18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item` varchar(64) NOT NULL,
  `catid` int(11) DEFAULT NULL,
  `pricein` decimal(7,2) NOT NULL,
  `pricesale` decimal(7,2) NOT NULL,
  `info` text,
  `count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item`, `catid`, `pricein`, `pricesale`, `info`, `count`) VALUES
(1, 'Samsung Galaxy J3 Prime', 1, '123.00', '150.00', '<p>The smartphone that does everything you love and still fits your budget. Enjoy all your photos and videos on a vibrant 5.0" HD display and get to everything quickly with the streamlined layout of Easy Mode. The Samsung Galaxy J3 Prime has everything you need to do exactly what you want. Stay connected with a great device, amazing display, and a brand you trust, all at an affordable price.</p><ul><li>Large 5” HD display for an easy viewing experience with sharper text and more detail.</li><li>5 MP rear facing camera with auto focus &amp; LED flash &amp; 2MP front facing.</li><li>Multi-task &amp; enjoy fast 4G LTE speeds on T-Mobile’s nationwide network.</li></ul><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 3),
(2, 'Samsung Galaxy S8', 1, '670.00', '750.00', '<p>Unbox your phone. Infinitely amazing. Infinitely brilliant. A screen without limits.</p><p>Introducing the new Samsung Galaxy S8 featuring:</p><ul><li>Brilliant 5.8” QHD display on the world’s first Infinity Screen. The expansive display stretches from edge to edge, giving you the most amount of screen in the least amount of space.</li><li>12MP rear-facing camera. Take brilliant photos in any light with the dual-pixel technology &amp; more detailed selfies with Samsung’s best camera yet.</li><li>Now security is personal. With facial recognition, the Samsung Galaxy S8 easily unlocks with a look.</li><li>With an IP68 water resistant rating, the Samsung Galaxy S8 can resist a splash or accidental dunk.</li></ul><p>The new Galaxy S8 frees you to live every part of your life anywhere.</p><p>Now, featuring DIGITS™—only from T-Mobile. With DIGITS, you can access up to 5 numbers on one device. Or, use one number across multiple devices.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 0),
(3, 'Samsung Galaxy S8 plus', 1, '760.00', '850.00', '<p>Unbox your phone. Infinitely amazing. Infinitely brilliant. A screen without limits.</p><p>Introducing the new Samsung Galaxy S8+ featuring:</p><ul><li>Larger, brilliant 6.2” QHD display on the world’s first Infinity Screen. The expansive display stretches from edge to edge, giving you the most amount of screen in the least amount of space.</li><li>12MP rear-facing camera. Take brilliant photos in any light with the dual-pixel technology &amp; more detailed selfies with Samsung’s best camera yet.</li><li>Now security is personal. With facial recognition, the Samsung Galaxy S8+ easily unlocks with a look.</li><li>With an IP68 water resistant rating, the Samsung Galaxy S8+ can resist a splash or accidental dunk.</li></ul><p>The new Galaxy S8+ frees you to live every part of your life anywhere.</p><p>Now, featuring DIGITS™—only from T-Mobile. With DIGITS, you can access up to 5 numbers on one device. Or, use one number across multiple devices.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 2),
(4, 'Samsung Galaxy Note8', 1, '840.00', '950.00', '<p>Do bigger things. Introducing the new Samsung Galaxy Note8 featuring:</p><ul><li>The smartest S Pen yet. Take notes without unlocking your screen, handwrite messages and make GIFs. With the feel more like a real pen, you have control over everything on your phone. And now the S Pen is water resistant.</li><li>Dual rear 12 MP cameras with an 8 MP front camera allows you to take professional quality photos. Shoot in the dark or from a distance and photos are clear with Optical Image Stabilization on both lenses.</li><li>A bigger view in a slimmer phone, with an 83% screen-to-body ratio, the Galaxy Note8 gives you more screen to work with and less phone to hold.</li></ul><p>Now, featuring DIGITS™ - only from T-Mobile. Access your numbers seamlessly with DIGITS and Samsung.</p><p>With DIGITS™, you can access up to 5 numbers on one device. Or, use one number across multiple devices.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 4),
(5, 'Apple iPhone SE', 1, '270.00', '349.99', '<p>iPhone SE features a 12MP camera with 4K video at 30 fps. A 4-inch Retina display. A9 chip. Long battery life. Compatible with iOS 11, which sets a new standard for the world’s most advanced mobile operating system.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 6),
(6, 'Apple iPhone 6s', 1, '380.50', '449.99', '<p>iPhone 6s features a 12MP camera with 4K video at 30 fps. A 4.7-inch Retina HD display with 3D Touch. A9 chip. Long battery life. Compatible with iOS 11, which sets a new standard for the world’s most advanced mobile operating system.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 5),
(7, 'Apple iPhone 6s Plus', 1, '455.50', '549.99', '<p>With 3D Touch, A9 chip, 12MP camera with Live Photos and optical image stabilization for stills and video, 5.5-inch Retina HD display, and so much more, you’ll see how - with iPhone 6s Plus - the only thing that’s changed is everything. (Screen images shown reflect iOS 10).</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 4),
(8, 'Apple iPhone 7', 1, '560.00', '649.99', '<p>iPhone 7 features a 12MP camera with 4K video and optical image stabilization, a 4.7‑inch Retina HD display with wide color gamut and 3D Touch, A10 Fusion chip for high performance, and great battery life. It’s water and dust resistant, and is compatible with iOS 11—a giant step for iPhone, and a new standard for the world’s most advanced mobile operating system.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 4),
(9, 'Apple iPhone 7 Plus', 1, '601.00', '699.99', '<p>iPhone 7 Plus features 12MP dual cameras with 4K video, optical image stabilization, and Portrait mode. A 5.5-inch Retina HD display with wide color gamut and 3D Touch. A10 Fusion chip for high performance. Great battery life. It’s water and dust resistant, and is compatible with iOS 11—a giant step for iPhone, and a new standard for the world’s most advanced mobile operating system.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 8),
(10, 'Apple iPhone 8', 1, '619.50', '729.99', '<p>iPhone 8 is a new generation of iPhone. Designed with the most durable glass ever in a smartphone and a stronger aerospace grade aluminum band. Charges wirelessly. Resists water and dust. 4.7-inch Retina HD display with True Tone. 12MP camera with new sensor and advanced image signal processor. Powered by A11 Bionic, the most powerful and smartest chip ever in a smartphone. Supports augmented reality experiences in games and apps. With iPhone 8, intelligence has never looked better.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 7),
(11, 'Apple iPhone 8 Plus', 1, '723.00', '799.99', '<p>iPhone 8 Plus is a new generation of iPhone. Designed with the most durable glass ever in a smartphone and a stronger aerospace grade aluminum band. Charges wirelessly. Resists water and dust. 5.5-inch Retina&nbsp;HD display with True Tone. 12MP dual cameras offer improved Portrait mode and new Portrait Lighting. Powered by A11 Bionic, the most powerful and smartest chip ever in a smartphone. Supports augmented reality experiences in games and apps. With iPhone 8 Plus, intelligence has never looked better.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 8),
(12, 'Apple iPhone X', 1, '920.25', '999.99', '<p>iPhone X features an all-screen design with a 5.8-inch Super Retina HD display with HDR and True Tone. Designed with the most durable glass ever in a smartphone and a surgical grade stainless steel band. Charges wirelessly. Resists water and dust. 12MP dual cameras with dual optical image stabilization for great low-light photos. TrueDepth camera with Portrait selfies and new Portrait Lighting. Face ID lets you unlock and use Apple Pay with just a glance. Powered by A11 Bionic, the most powerful and smartest chip ever in a smartphone. Supports augmented reality experiences in games and apps. With iPhone X, the next era of iPhone has begun.</p><p>Device purchase requires a SIM Starter Kit which will be added to your order automatically.</p>', 4),
(13, 'Matrix Case for Apple iPhone 7/6s/6', 2, '17.33', '29.99', '<p>Transport your iPhone 7 safely with this purple Skech Matrix case. It\'s made from polycarbonate to protect against drops from up to 6 feet, and it\'s resistant to yellowing, soits color lasts as long as you keep it.</p><p>This Skech Matrix case protects the phone\'s buttons without restricting functionality or access.</p>', 13),
(14, 'Fre Protective Waterproof Case for Apple iPhone 7 Plus', 2, '41.00', '52.99', '<p>Hit the trails or the waves with your iPhone in hand and safely protected with this LifeProof fre case. Waterproof to 6.6 feet, this case features military-grade protection for your cellphone, and the built-in screen protection resists scratches without getting in the way of capability.</p><p>This LifeProof fre case offers a lot of protection without adding a lot of bulk.</p>', 4),
(15, 'Survivor Extreme Case for Apple iPhone 8 Plus', 2, '29.99', '39.99', '<p>Protect your iPhone 8 Plus with this rugged Griffin Extreme case. It’s durability-tested to withstand drops up to 10 feet, and it\'s water-resistant for use in wet weather conditions.</p><p>This Griffin Extreme case has a hard exterior shell to safeguard against damage from impacts and an inner silicone layer that absorbs shock.</p>', 7),
(16, 'Insignia - Stereo Earbud Headphones - Purple', 3, '1.99', '3.99', '<p>Work out or relax while listening to your favorite music with these Insignia™ NS-CAHEB01-PU stereo earbud headphones, which are designed to deliver crystal-clear audio.</p><p>The 3.5mm connector allows use with a variety of MP3 players and other devices.</p>', 11),
(17, 'Bose - SoundSport In-Ear Headphones (iOS)', 3, '87.25', '99.99', '<p>These Bose SoundSport in-ear headphones provide crisp, clear high notes and natural-sounding low tones with TriPort technology.</p><p>The sweat- and weather-resistant design keeps up with your active lifestyle.</p>', 0),
(18, 'Apple - EarPods with Lightning Connector - White', 3, '23.25', '29.99', '<p>Unlike traditional, circular earbuds, the design of the EarPods is defined by the geometry of the ear.</p><p>Which makes them more comfortable for more people than any other earbud-style headphones.</p><p>The speakers inside the EarPods have been engineered to maximize sound output and minimize sound loss, which means you get high-quality audio.</p><p>The EarPods with Lightning Connector also include a built-in remote that lets you adjust the volume, control the playback of music and video, and answer or end calls with a pinch of the cord.</p>', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `orderid` varchar(32) DEFAULT NULL,
  `datein` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `itemid`, `price`, `username`, `orderid`, `datein`) VALUES
(1, 18, '29.69', 'Test', '5a09600b2b51c', '2017-11-14 13:50:13'),
(2, 17, '98.99', 'New', '5a0b265c9c378', '2017-11-14 19:25:58'),
(3, 12, '989.99', 'New', '5a0b265c9c378', '2017-11-14 19:26:02'),
(4, 2, '742.50', 'Raw', '5a0b2f102423d', '2017-11-14 20:00:15'),
(5, 2, '742.50', 'Asa', '5a0b319a768c7', '2017-11-14 20:10:52'),
(6, 17, '98.99', 'Raw', '5a0b2f102423d', '2017-11-15 20:54:02'),
(7, 12, '989.99', 'Raw', '5a0b2f102423d', '2017-12-14 22:01:33'),
(8, 3, '841.50', 'Test', '5a09600b2b51c', '2017-12-15 17:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `roleid` int(11) DEFAULT '1',
  `avatar` mediumblob,
  `discount` int(11) DEFAULT '1',
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `roleid`, `avatar`, `discount`, `rating`) VALUES
(1, 'Test', '81dc9bdb52d04dc20036dbd8313ed055', 'test@gmail.com', 2, 0xffd8ffe1001845786966000049492a00080000000000000000000000ffec00114475636b79000100040000003c0000ffe10319687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f003c3f787061636b657420626567696e3d22efbbbf222069643d2257354d304d7043656869487a7265537a4e54637a6b633964223f3e203c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d2241646f626520584d5020436f726520352e332d633031312036362e3134353636312c20323031322f30322f30362d31343a35363a32372020202020202020223e203c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e203c7264663a4465736372697074696f6e207264663a61626f75743d222220786d6c6e733a786d704d4d3d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f6d6d2f2220786d6c6e733a73745265663d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f73547970652f5265736f75726365526566232220786d6c6e733a786d703d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f2220786d704d4d3a446f63756d656e7449443d22786d702e6469643a42364138413533463731313031314536413546434131383238314231464235432220786d704d4d3a496e7374616e636549443d22786d702e6969643a42364138413533453731313031314536413546434131383238314231464235432220786d703a43726561746f72546f6f6c3d2241646f62652050686f746f73686f70204353362057696e646f7773223e203c786d704d4d3a4465726976656446726f6d2073745265663a696e7374616e636549443d224445413241414237463230354342323138313030464331314633354443363443222073745265663a646f63756d656e7449443d224445413241414237463230354342323138313030464331314633354443363443222f3e203c2f7264663a4465736372697074696f6e3e203c2f7264663a5244463e203c2f783a786d706d6574613e203c3f787061636b657420656e643d2272223f3effed004850686f746f73686f7020332e30003842494d040400000000000f1c015a00031b25471c020000020002003842494d0425000000000010fce11f89c8b7c9782f346234075877ebffee000e41646f62650064c000000001ffdb0084000604040405040605050609060506090b080606080b0c0a0a0b0a0a0c100c0c0c0c0c0c100c0e0f100f0e0c1313141413131c1b1b1b1c1f1f1f1f1f1f1f1f1f1f010707070d0c0d181010181a1511151a1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1f1fffc00011080064007303011100021101031101ffc4008b000002030101010101000000000000000007080005060403020109010101010100000000000000000000000000010203100001030302040403060502050500000002010304110506001221311307412214085161327142522315168191a162334317b1e172a22453344425181101010101010100020301000000000000000111022131711241619103ffda000c03010002110311003f006a7402bf7219bde310ede24fb3ca28570913588e3241115c06caa4e2b6255052da14a170d061fb25ee3bf5890163c8e411b8b408d2646f7e63ab4a71089141aa7dab5f8aea829e67db685717c323b0225b72eb734476d90d51b69e705b506db94df0431da4a08abc410969a4a2d706cce26516d74d1b58d7480e2c5bbdbcf8391e48fd6daa7354ad769722e695d2c174573861721b71b8832cd957db05e1b804904953fe9554afdba8386265765997bb9d9e33c8e48b303457334a74d937d14c1b5255e27b0772a2724a579e83c727cd2c38ec68ee4c7bab267486e1dba0b1437e4497a9d369b1af8d6aaab4444e2aba0b609b14e52c34741660023aec7124230125a229227245545a579d3515e579bc5b2cd6c9374ba48089062364ebefba48222208a4bcfc78704d064ed17ecab2abe46976c656d7843201206e0e88faab9992210832d9a2ab5192be6324dc7f7683c7416b2717c36dac4fba5c22b6f099392a64a9aab2151568a545754f60d0505046894444d0da19c4f7238ab5995af08c72c272db992198b1e4475f4ec00bc545246dc69b2f2254968945fc5a698386aa2534134023f74d181fece5d373adb6ad3ac3a9d4715b52d8e22ed044e064bf857fe29a0507b7f93c2b35d1a7a5a3115a62a6b3c1a927329ffa6d7a691137117f79a0a278f86ac29daecde5f6cc9f1b09b6d6e6b71153f2d6583282742512243655cf36e15dc266a49c2bcd2aa466fbe563b8e36d39dc9c5d2485c6213437f8910b60c98428a26f39ceae30283b0e8bb5116a8a354d2016c089ddbef8a94f6ae8c5b19b236efe9771069c8c52db90e202b4e0812edf3c3a97822fc5341acc1bdbae4f705bc5fb38bd4db6df2fee3af3ccda252b0ac9bc862e2394ea34ea121d113c07c78f083b07da9c32b2b62f64128f2689302442c837b8ae0b42a88a0a064428bd344a5392a271a2aa6a2b173fb07dceb2c0be7a0c9254b97779fd17583ab51e5450407dd9739f23fca0e048b45555fa52bbd681d780da73dee0e7f1f1fee6929daacf1bf58661122b633901c48f1cd5b2a2f486a6b45145aaad53e1434a88823414a0a27044f827826a2178ef07b83ba58dc72d6d5a9eb6cf8923f3589c0eb6d5c21126d70a23fb5b5de3bd3eef05e22a54a29581f6ad8accca3b993334982211acc8669d301003972414113688a0250088d76d38d340e3eaa2682683e1e6197da365e0175a71144db34421245f0545d0231df4ede61565c95070e94ad94935576caf955050c51c69e88e2d7a8cb82aa94aaa8926df826ae03bf60bb1572c2d235fe65e2424a94cff00e559da77742553445473f2d444d513955169f1d407175a69e68d97805c69c15071b344212124a28aa2f05454d0564591618173fd1a336dc4923141f068011b05605c56d36d283e432a2a7f727c7416ba0f0872524c747538798c0913c08094093f98e83ea43f19904f52e0360e10b63d454442235a08f1e6abf0d0565952c1747bf73dbda171f98ca456e790aa11c665c3514052e3d3232224a7d5c17e1a0c277f739998d63811602cc2ba5d50d9b7b56d61c724a9a226e24751763489b938a81afe14f1429558bda8ee8ddee31ae9974698cb2e922752ea92254d79138f4d98604b31d5fb10453ef10e81d9edf63765b06331625a6cc3638ee08ba50b68a3db8853cd21454eaefe2f315395742b49a22682682a72cbc3566c7675d1d94109b88dabab25d1536c76afdf44515da5cb82a2fc38eac092e3f61c8fba1dc9937b63aac0248090c4ad8120415b3426d7a05e98dd69762a974dbaa2af9939ea8766ef739968c7ce73709251c4677bd198246d680352e90b9b11694e02a43a800713ba3dccba4e3978b33757aca6e0f59461b771460957ce8da6fea1b4bc17a66e03a1c51155289aa3b71dec7f742e990c2bde59991ceb7b20670c62ab8d96d471b911c4c1c00510270048c178f968aba9a0f378bbc2b3db5db84e3e9c66513a86bc9149768d5579549512aba803ddb8f7018d5d24df2080bce8b573706d4223f9924a7cb358ed368aa9e62dcabfda22445444d06fbba382166b89bb6a09270e736a922dcf36e10235303fc4e12871240aaf0ff96802b1739ee2f65e32d972ab8c1bf42605a66d31db492721b86c2120ff00899e906e151a23ae5683f0e3a2e3751b38b4f727b6b3ccef116c97271a528b245c7632c5254a2388f39d3709116a24e0808d6b4ae8172ece4aca6c9df5890a4cf6a6ce578d898f1be92db921b5490da754b69d528605b935087b07720a6e5a9538af2aeaa3f741341340ba7bb6cb6e0c059712b73ad11de45df56c740dd7c4148400c080aa9baa49b50157e7ad44ade765fb471b09b0b64fcb98fcb7450c987243aac35f7976302a2da2aaafe1d4aab4ccaf7dabb9dba4db6f97f876fea7ff0021258447c0c7889b6e2a8d48153e7f054d3d83478a582d365b3b31ad844eb0628e7a8325709cdfe6ddb955682b5a88a794790a226a0f9ba6638e5b1f93166cd0626c66564fa572a2eb8da7de640a8af71f2fe5d78f0e7a60c17743b8164ba763721bddb49b9b065447e0998af5001d73f2685b7c148bca5f3155e0ba0533b057b8f67eec63d26437d5037fa01e3b5c7c55a47105799221aa0fcd740ee671dc0b462d2acd1e7dc22dbd6e2f175165712561a4f38b62242aa6466028bc512aaabc13455db53ec77c86e31165b131a7da5de2d382e2ec3a8d57615538f8d74192edc6037cc516eac3afc12852de536ba6d3a4f3abc95d7cdc716954e02da296d4e64ab5d00b6f1dad8af7b8a8a71e143b6c7006ee50c23814271de9120bc60a0bd090a04bb8d1369d0b8f2aac5864b5594d04d0455a2574024c2a7c1cb7bb376c86310473b347480715d691e78db35550745e56841912542f2b6e9eef1a273e97c98ccbb5a8ee1e7b8b63b6f77d75ec2db7214a4504ea386ae1536a2b2d89a9a2ad3eeeb3cb4c3da3058b8dd9a6e7f98426f21cbdedd210da6b736db674567ff19d269a056f991702feed3ed019cf7dd5770ae06706d42dd88d8778bd1891e2f2551369126da122f98484bf86881763b94406e6b8e64967772a42e1061bb324476da75c2a9908b1c554938220d28be0bcb515b7c718b8d87b7fdc770c1cfd15e8f1edcdc33527062cb98e0be82f529e769b046c8e9fe4a22e8287dbf3119eef2e2a3229d3196a6354afe603464dff00de89a82ebbeb3cc7be9740cc9b953ecf0a422b101978193f46608e360d9aa18821a954b86efb17415167ee4649854b4c8306276c168b9ba4016390eacd61ce8000b8e55c11de1b8b6897d49c53770d0337dacf7418865ef41b3dd5b72d391c9dad236a04719e79512bd231dfb5096b443fe6ba60d3f7b67fe9b8c3774e9bec3b6d786542bcc66464942900a882aeb44a0bd278089b32dc89c685445ae922b698fcf9770b446972db169f74048d037202aaa73143442145f82ff35e6aa8b0d04d07e125455382d5392f2d02f5845932d99ee2721f513d92b34069a7ae71adc8ac45df4518719d06cbcce02291921a97cfc29d2df1982dde313b25da7317cbcbfebd8b599488314cd1b86db8154ea1f1a1a8ff0072ed4f86b3fd34597dc1f7c665d2e8f586c3255a88ca2b330da3892a33a8bcd1b711b334f9ed3a6afc674be511359577da2ef7fb7ba6d59a6498af4d4160c221981bb55a085016a4aaabc1340d0da704b8d8fda8e431ae165e85da5b2e4d9422624f3ad8b82eb6f394e22ad07302e29b57e3a8d177ed55e56cddc4b0dc11ef4e2dcb0175f4a545b73c8e6d55e02a40aa3b97e9ad755078f76f80ce5b959b3db1b224ae2045940c3244f2bc086fb6f9d0550851b1545dc9c29a8a5a2ed78ba5de614db949395249107a86bc847e91144a088a7808a222688f18925f8925a931cc9a7d83171a70088084856a8a842a248bf62e81dfc5bbb16ebf76882e7953d16ca0e36310e5bc4e4d8ee2a8ed45753fccda92a7fa8b5af1122d688e5ed7f723b9b2e7258131c5c82c71491b89968f56d91ca3a7d35194d213aa03e5a8279b9f1e7a941c12b4e3cf504d04d02f5dfac5aed638eaee1033e0bd78903eaad76694fa24a32a23ae2c169831dca29e63ea88af8d575b952c0a73dee27736f76b8d69b459af164b240058e6824f3aaf74115094dc6db69b4a6de28df93c135bfd92c67e07b79ef04d809745c66494671378b44fc76249578d55a74b7a57e635d73b57198bb61b7bb44a48777c76eb6e91cff300f9569b93f26843ff004ae81b3ecbfb71c57198916f9776d2eb7b79b1707ae9b996378f1106fe955a2f1dc8b45d4aa30df2dc972b24fb6d0693233b1e87c068e82871a22f0e3a83f9e5dacb6daddeeae3b6ebc3ad3709bb9b63289c21e92f44f720a92f97699020ff001d51fd11b95ba1dcedf2add35b47a1cc68d890d17226dc15121fe28ba8142ef9f606cd8815be5d9225ca4da0c3a2a10d9178db30e24e4978c954cdd23f2d004511289a2bc7b57eda216716a72e92e4dd6c9191c56e3a48619dceece045c5455110b8725d541f7b77d8a8f8430512165175976b71549fb4c8f4a70cc8bea5e91b27b77538ed24d3411e0db2dd6f69598115a88d2ad7a6c00b63fc851135074e82683c66cc8d0a2bb2a49284764773a68245414e6b41455d593466709ee9e0f9ac89d1b1fb82499100d45e64c49a35145a75004d10882bc2bfcf57ae2c66752be6067d05cee05c706b830b12e4cb4dcdb42aa2a84b86a03bdc12e486dbc862a3f04afc74cf15aed6543ceef767ed9dc1b5a09cb7e0dd23092c394c99aa22d3802b6a62d6d25fab857e7ab28cdf63ae37dc51eff6d73179966eb19b57ec6df545e37e26e5523577725577aaa086c45444f1d5a2f7be57790c596d963665041fdc325d86b25f7158608822baf331de787ccd8487801b254e6354f1d48179665dae6ca7bb5f2c31e62e16a2078f2a27dc48127a0a0ebeced551683736440a9b76a6d5da88b45168603dbc64657bc1e60b4f1cab5daeeb36df6494ea9138e5bd93428dbc8bcc4a2db88155f044d419bcb300bb777335951eff001245ab15c6a4fa78ed9bceb4e4c2e66fb22ac20a366341ddb97e4babaa31e3f8f5a31fb5316bb54718f0e38a03602888b44e09b9511372fcd78ea231bde8bc5e635a6c763b417424e51778b6972622a89b0c39b9d78dba7dfd8d2a26ac143df5ce32f0976bc0b02470b29bd2a3b265c7e250a209a0f50891151b432ad4d790a2f8aa6a0ddda6f965b1ac2c66f393b13b2456c10d253ac3529f3244445164365372fd22895fb79e8ad3688c56779667d6290cad830f2c860250a4beccb6db7507ef08b249bd4be14aa6b7cce6fdacf56ff0125e60e2176cad334c01e9d66ee7b0a2f48c55c88ea2bce12a03a9298511e9818950dd43d8bcf9eb7967e13eb47de2bdfecfbae279f5d6542fd6acef3b0a4daa322f526429b41749aea16f1565077a22a2a57ef71d664ff16dc16317caac394d958bd58e584cb7c84f2b83c14493ea0315e2263e22bac598b2ead7515cd2ed96d98e34ecb88cc871824360dd6c0c80916a840a48bb553e29a0a6cff04b16738bcac76f425e964509b79b544759743883adaaa2a6e1fea954f1d002cbd91e3cadb623944c4342aba4b19a5120fc223b936afcd557ecd01e709c36c986e330b1db301041862a8846a84e3864aa46e38488952225aaff004e1a0bdd07342b9c19cd3cec5751c69875c61c713e94719250746abf80c5457e69a055338f7276593ddeb64efd37f55c4f1937c228a2a6f7a51a6c59ada1797f2f6d1aaf8556a8abc3589a27de9c8b0f0991dd0c05f7ad2e5da24372e0da456a755817577c878137b9d58ed3ce11aa38bf4d09386a62b8307cafdb6d809cbd317f8f3efefaabd36fb72175c9eeba7f51229b69b2bf85b144a6a61a307ee7b2edddd5729e93f50ff03dff00b7aeddff00473afdcfabe5ab8077dcfee0778b1bb91318f61cdde6dcf0a7a49ec2bd2484b928bccb68042bfd3e7ae92718c757ad55e212339b564769cbbba325b627df446c766b4c2000f4c525ceb6d9423553af4916bbcba7e3cf82496590dcfa06fb92c7f201ee24fbbca7224e4989bd02d68ebbe9a33288db3eaea346ccc538f9b8d17c34b7c67f5f5c7edff3ecdb1acd615aac910e744bf3cdb126deea18b4a8a489ea04911762b435552a536f3d4b75a92c367dbaee1c1c9da95b47a6a53ae6dc2aff00ab1e0bed8757e5bbd40d3e5acf51ad6df5954d04d07e6833ddc2c9a5e2f85ddb208917d748b6b0af8c4e29bd01514f971f285497ecd2002e2d7bcd331f6e7766b0c7d0b275b8cb5bd4305abc6ccd7cdf7023a9126cde0f7957c68489e6d6a81b583daaf782e6f3292a047b3c674772c89721b2d89e08ad32aeb9bbe54d4d306acae2651db5edcdbe358f18699b55ba63337221812d644690ca70900e0c80f51b1d5daa544a0a73a8d75a98956180d9bdbf771ae9fba2d767602fcc28bf32dce2936a0e55151d28c25d171377df41545f1e3ac5e49d0d7a2bc27c87e3c471d618592fa511a64569b8895046a5f746abe65f04e3ad7125bedc4eae40461f66f3acbf3e1c8bb9d2633b68b7992c0b1c6709c64bf022250505be4a55f31d38f0d75eff00e924ce5cb9e2dbbd0df16143891c634561b8f181282cb4020089f0411444d71b6dfaecafc91c8b1ed0f949dc10d0141d165155e704b8741914e3b9dfa529c78f0e3c52f3f52946bde657cedfe6990bb29d32913ed7312dd1011162c79b7194dfa96d9db4446d8e8ab7bbef1b7c38535a674d076bfb830b3bc71ebd426d5b8adcc7e235baa8442caa6d3545e5b90ab4d62b51afd454d072dcee0c5badd2a7bf5566232e3ee20a54945a0532414f15a0e807fdd3bb59efb813c567bfc7b7dcc4235d2c5703711b694d0d1593532f2745daab4645e54dd42f86ac816bed15b7b856fcaddbdd86e76db5cb392e317cb32c98f14da123af9a2bf46cd9a96e0e912d13e954d6a3274ad0770382d1ce75975e3145538e2a20b54f045377fa16b15a7598098a81a210122a10aa5515179a2a6829adb84e216b90b26d966890242baafabb15906495c545155556d05551517972d5d175a826826826839a5fa7dedeed9eaa87e97752bbf6f1d95f1a7f4d58029dc7ff0069ff00657ff6f4ebfa06396df57d0d9c366ee1bbadcebfea73f1d75f58f1a3f6d9fb7ffdaa83fa1eee875e47a8ea537f57a9c37d386ee96cad3c75cab5050d454e3a0ca774ebfb0af1d3f53eafa07e8bd1edebf5f6aecdbbfc9b7f1eef2ecad74812f6ff0048ff0064a17eabeb7d67ea4f7e93e96be8fa7e5ddeabadf975dfbb6f47cfb7eae14d017fb61ffe7dfddd17d353f73787a2ea7a1ddb077f4ff8fe0e14f9eed6bf01998fd0e887a7dbd1a793672a7f0d647a682682683fffd9, 1, 0),
(2, 'New', '93279e3308bdbbeed946fc965017f67a', 'new@gmail.com', 1, NULL, 3, 20),
(3, 'Raw', 'e10adc3949ba59abbe56e057f20f883e', 'test2@gmail.com', 1, 0x89504e470d0a1a0a0000000d494844520000006400000064080600000070e29554000000097048597300000ec400000ec401952b0e1b0000200049444154789cedbdd98fa7d979dff739ebbbfc96daab97e99ea53933e40c77520b295932954448a24430e00476905cc8d08d73977f21c8456e0224817311385010c6612cc182cc90b4655ba2285122c565cc992187b3f7f43ad36badbfe5ddce968bf39b26254a568c70aa5ab21ea051e84275d7ef7dbeef39cffe7dc4579e7febabfcb53c34a2819f3fed0ff1174bfa33be2756df1727fc59de5b91a7fd01de951fa835fdd0578f9491940652f23ff85991402484c83f2752c0bb257f36707fb9449ff6077857de55a5402044e2ea2bdfe2cdd75fe3607f9fde45eabae2439ffc14efffe0c74849665012b4c7f7f9dddffea728a3f90f7ff9efa2ed981552fc653c3de22bcfbff550bc560fde7612b7afbf821692d17493cb6fbccad77efff758362d0978e4c2237ceae73fc3a5a79ee59d6baff3c6abdfe7ad37dfe0a9673ec4999d5d9cf38428b8fdce553ef6139f66e7fc2594b60821ff529c9f87e684646d455e7df1ebfcf1577f9fc57289f709a5245dd7d3b62dce7b9aa665b198f3f4fb2fd33573de79e71dd6d737b1ca70e3fa35eebc739b83c303e6b3194787477ce4e33fc1d02fa947131e7bdffb29c73b807868c139f513f2ae698e7ec9177fe3b3bcf2d22b186be89d23c6c4e01dd147528aa41841405dd5586b397bfe2cb3e3235cd71193200941d70e9022524a2052d51593e998b5f575d636267cf8639fe2fc63ef47290308e24386cca902f22e18a4c4977ee37fe395975f220541d70f747d4f08890424026551428a841030466394466b85f39e10022966434f1208632894613c1de19d0321d0c65057251beb13ce3c72814f7fe63fc1946352fe003c2cf6e6a1b8b26e5c7999efbdf802dde0715dcfe00324412481104829e9ba8ea2288829d1751d4e0a524c191c6b49128410193029901286aecfa72f42df0d34f325776edde6adb7aeb2bdb3c3b39ff80532100f0718708a6eefbb2ae8db197ff4e57fce7cb1248448521a29152889520aa9142965ef2bc480921225242178bc77586b515aa1b44069812d344a2974a1f1c133f43d7dd7e1422086880b89fdfd635efeee4babd3f170c9a9c621210e7cfd77bfc0e537de44294ddf3bdab6630891b6eb59340d0209529048a418d05aa1b5c21a4b5dd714a5258444f091e022294222b29c2f68964d3e4daea3ef5ae68b39317846f58817bef33c37afbe4a4af9527c58e4d4aeaca15bf2dc1ffe4bfef5b79fc30d9110132924b4362b830cde83b506ef1d46699ceb097e58ddf81204cc6673624a0825d152d174032278048a9812a44844f2ae9d103e11538f528aef7cebeb5c78e21982f708a91efcded3945303c41415fb7bf7e95d405b0b2ee2757e5327a39a65db11b4446b81100a0d2cfb0e9245294522d0770e2105c628e29058fa1e9f024649648a28ad91da4092c4957d892920a2446bc92b2fbd80e61f524f3779df073ec685c72ea1f4e99ad553f9ed02b8fac6f778fdb53730a640ca00d2538a44d7b62412464baaa2247a47f09e65dbe29d4320092aa2a4228400311162400ac93074686d2026a48614233e0594d2240f464b9250c41869972d7e087cf31bdf667b679b1b37aef3f3fffe2ff1e8a5a7514a23c4e918fa130744002f3fff757eebd73f4bdf27ca51955dd6e0515a0281f9ec80b2284942d2f71d6dd3326f96586389b127c4c830b42865188f2ab4521c1f1f2194442943221143021156a709a4022124c3300002632d007dd771effe7d96cb256fbcf2226d3be77d4f7d98b21e9db46ab27e4e320e11c01bdf7f8ecffdefff2bf345c33078c6d329a3aaca6f7b8acc8e8f59360da5d50fdcd8b66b7021606d49df77c41891425255055551d1f51dc3e028eb0a25b21babb54648815272e5a5297cf0841811422285c468434c0184c01405d66a4a5bf05ffcbdbfcf134f7f90d370874fc88a259ac5115ffddd2ff14f3ef75916cb8ec9649da22809cee3fa8e141cc3d0d1364bfcd0e3bca31f7afabe2384889292e80604899422da2894d6b45d4bd7b6282589311063c27b97af312d113203e48601ef3cc13986aec30547889eae1f70de1363a41f1c070707fcd6e77e8dc3fbb74e25c1722257d6ed1b6ff2c5dffa0d6edfb947749194044a0ac6e311de0d745d87368ac57c4e4a89a17728a348291256ca325213524024813506ad1443dbe1bd070131457cdfa1a5a22c4aa410b86e2086880f1e50199c9448020a631102a480e023de39b4b5185bb0b7779fefbff81c3fff8b7feb24d4f327e4044e48e2f5d75ee5d6dbb74809ac2d98acad313847650d5280d69276b9c40d0383eb1132e19c432481541229152925a490a4141140f43948345aa39584101111a4c80164df75cc6733babec37b47db2ee9ba96183cc6164429f0c1339a4eb0d6e46c73847a344608c35bafbf762ae1c9c918f5e08931301e8d592e97f9ad7703cbe8116295d34a91982229418c111102c218549408993d29484829d102b4066b14214a86c1e1880f3ca310027ddf2395ca002790ca521883940a3f0c90a02a6b5c33644b1105c24a82f74c26234274a7925139114016c707482970ce119ca3ef5aa414a414f2bd1f02424a880229b26d1031d7461202a9f2151782472a41a915e35189529265d3e34542c9d5b5e51d887cf0a58028045a69a496f8109144ac2e314ae2868e9422ca181030f4035a6994b69c7fe4e2a9c4efef31208983bb37b97af94db452b48b39526605bba1472441c413bc470a8956821073255028010994960417082960958414314662b4a42c2c29786250348307211052d2f70e80ae1b4808828ce898bd366baaec5ea788521a290d21269451391be01da28bdcbd7593f9d13e93f52d4ef2a8bca780a418f9ce1fff1e4dd30110a3a7ef1c4aab1fbc7d0978b79a27054a0944144422d17b9434abecada658e5b1b402a3042679b6c70584c4e0022141f001912208458ad9061963483151584b221243405a494c811420927001b49048298921525635cbd9c10a909393f714102925da14f981fb1c902105c107201b681f025208a2cfc65a4b892e0ba414a81429b4a2b492c9a8c69008312295607763cac40852f06c58c35512b3d6d1f94492921013462b12021f0246299c7318ad111a648208a49488316706bcf39455811b065ef8cef3fcd2dffeaf386943f29e02125c475916a49415194360088e141246697c0c39018820ae725093aa60bd2a1915929131ac179a496599941621053281ad0a36c61565a91129707c34e3dcd870fdb063af19389c2f39ea026e0578f43084885dd90a81c8452bb90a1e93647003da968895e5f2aec7d8f2bd54cf9f29ef2920c65a9a6593df3111f10444484801dee7ab4ba1f1ce5119c5d6a4e6d98b3b3cbebbc9b890ac15f95e2faa92d1a844ab7c6501984267a7200476971b9cd9d9e0f15b87dc3a5cf0f6c1316fde3be67eeb59b6d9b80b29905210e32add1e13bd6b49287c70f890281148a91042b2bdb5453d5a034ed6fb7d4f0119fa8ef1a406024551104240d848d70d68ad0931424c8cace6d18d099f7cf202972eec3019d74cc715d6289494d8b24608d046934890b2fb9b6220b881b2aea92723266b13ce1d373c76778fb542f0dcf54382cfa753ab555d4524bcf378e7915aa1b4641802522962f410b3273759df004e3e14794f015176c44ffcdc2fd12e967ce5cb5f665cd71c1d1f414c78372084a6d092a7ceacf1534f5fe483cf3ec9dafa1a6561d12a7b5812b18a2f04420ad22ae7851090427610a2c11405da5a8a51c5745a3199d618758dafbf75979993c40491c810a0f7096b2d3105c2e011422185444905028273dcbc7625bbd9dabc972afa1179cfe310652aa69b3bd475c9f9f38fb0b3b3cdb56bd770ce13895cda5ee76f7ee2199e7edfa3ac6f6c501405d61aa404417c90bb4a31209521ad22c91cb12ba4d2ab58228090486d902aa7497ec6284a2d78f1ed39f796035df4241770c9e33cc8b8ca040b89140a62a26d5a82ef288ce1f68d3779e4d2b3efb58afe849c4860b8b6bec6c6e61a555570e6ec39ae5ebd4a8a914955f2f31f7d8aa79f7c8cc9da1ac65ab435395df2ae73936bb208a172b24fe45e15416efbc9f9a9ec2d49ad5129628a92320436b6e1a73ef63467b7eef1e6fd2557f68eb973d470d80cb81049316580a560183a1212a5257a55a43a73e1899350cf9f901301e489f77f9c4fdcbbc5ed9b3779edd557482961ac65776383271e3d4b558f502a1b6b622289482402d91526ad9ccf55fd5b88151829ae4e4b4e1a0a04a4dca5a2b52595890982274cc1786dc67a5df292b84fef67cc7abf2af14292f9ff2c0a83928a84474bc5ecf01e9b671e3b09153d901301449a8a0fffd47fc0e0bfcc0bdffd2e4a2a8ac270f1ec1ae3d1e8412d5b480942e4fa85cc6d56d9aaae4e02b9d527a5b03a15643756881ff4f30a1052234d40a5888a895248b684444845ef1d07ada38d1d2e784204ef23520586c1a155623c2a102251d5d549a8e74feaeaa47e51319a72f98d37383e3a461b85d18a33ebe39cb712022924e2c19f3fd52b250448bd52ba40488390f2416212f2bf7ff7ab1002a90c4269a4326863a9aa92c9a4e691ed095b634369156265c485c83d5ede79c42a921fd515f568fda4d4f3404eac84db2d0ed8bb7f176d0c921cc5af4d47d95922d728a45228639022214582b83a09f0a0d094152857b6251f93142349aea272a190a92302422a84f41025426b94968cc62336d64698fd16a92422e64051a91c2426723ff1c6e676ce739d94825672628054936d2e3df52c87fb7bab6ec288922b975680b2165d56686bb2f14e0119573dbd2966e5a6953111f207d5bc55b75b8c8128244a1a909ad82e4038843288e4493e20a5424bc1b4548414591920106255165608f2097bf2fdcfbc6bc14e544eb411e997fef67f892d2c21c45cc30831bfb9b6c4d61384365909422284224991af1d6d904a23b479f077a1344229845220b37d50a6449735ba9aa0ca11da562865412862ca751229607b6459b39ac1f5482541448c1120124a410c919ffcd95f3849d53c9013ed3a29ea09171f7d9ceb57df228644db7b8234f42852372052831139296894205f42112973bc912b86b98331c6408a9118b3fb1a8184240a054241314626894c0a1921d1e3433e15a3b264736cb976d810532e6c85981029db131f02ebdbe7fe2ad6437e541ebbf47edeb97e151f066e1fcc79fee5cb746ea069070e8f67680d4f5edc65777dc2f9cd29d3718db51a2973241d6380082e048e1673aebf738ffd83398d1b50cab03d1de7da8a2d30c670667b135b4d488b061f214989128242098c90f431a2b521fa84b50a414ee1efddbbcb99474ed6e5855300e4d3bff01ff3adaffe2b942dd83b9871e5fadb1c2d96b46d87f339f6f8fab7151be3928f3d79869ffbd80728146c6e6dac3a4b225dd773e3ce015ff9c6f7b87af788d9c2d13b074a5018cd99cd35d646255bd30956499e78ec02bb1b13fa951fa08cce630eab382404875ca5ec63c89d2a575e7fe9df0d40aaf11acf7ce8a3dc78f3151e3db3c1918189917456d17603cbaea3eb3b9633c7cd9bf05a5df0f8f92d142089b8be67316f78ebea6dbad91ced07cad8531a8547a0626276704437836176ccb99d2dae5fbdc2fddb05ebd3319352636cb14246609422a60864efcd189d7bc19ac549ab0638a556d28f7ef253dcbefe061777b7d8d0919bbee7fe3ce4f6d15145a3046dd72182a76f72a9d7588b20a1b4a26f5bd6b460a7b028ef5910b23d22a2b54229cddaa462676b9d496531327b6561f0a8ba4008c3b8c8d7939220b4c50d4376a113186b20fa1f0c149da09c0a20973ef80936ffe04bec6c4ce9f7eed2b50d763ae668bea4695a5cefa8ada16f7a8eef1fa09ebac8f6f98b18ad88d19142c4dcb88388032a78c6c650d8022f254219d08698068e0f8f18c90d36d6c798aa44588b9202290ca35185d18b3ce0a3e4cab640ec7b2a5571fec2c5d350cde900521f5ee5fcb8ccfd506ec0c4c8531f7a3f4d94dcb87a95a3fbf72895a08e1123157ef0185b62adc50f2dc6180aaba994a05e9b326b3a1a25d8b8f8386fdeb885d12537ded9636bad46debbc7d969456534b2c811be52b9915b88849060b561e81c3b55cd7ff693cff0e95ff80c626b87b97810e69c989c0a20076fbec2b95149692d979e7e8a471f7f8ce803c77de03839aadaf2e885f3a4b6a53492f17892f35a3e107b87518ac978c463e77659cc5bd62723d61ebdc8c68547b975f94d5cdbf0b14b173833a968668728efa80a83a92b42ca9981713d2286840482f35821f83b3ff514972e9de5bbbff72f288de1f1fffcbfa6dff82b985cfcd3b271ee1cf31b2fb3369d102b4b7b74447b7c8c76819f7edf457c087837204705ebdb9bec9c399beb150972a529b1b9b186919ae97ab6336ae8e96f5ee5977feed34821f16e60e896ac3f719ead333ba0243e25daae67181c3b1bb963b1691b54507ce6e9336c548ae5de1e6b7505cee1afbd04ff2e00528cc79cbf700ead04a618536a8995899643a4cf331caa9850941593ed2dcad1082114b94f246781ebf1185bd634c74bfc2890de6db0168e2424c90aceed5e60fdcc36aa2c71ced3751d3ee43ede7159322e0c7dabf9c98b5b7cf4e2165ac2c5f73d467370888a915129383a61dd9c0a20c18eb0e3294a4a8aa244d8026b2dd3f50d5cdb104240db92623c26a684d2b90534f726249039533bdd5a67b2be4edf740812424adce030d6528e27d87a044a116322a4f6410a5fca5c885a1bd74c8de2e38fae33aa2c3bbbdb146501a332f70cd77fc5ba4efe3c595667998cd7d1c6ae522222f76699826aba91f34b084288f4ddaa6b4569924f441f57a55a8b509a7a3a61b4294831907cee5ed4b67a90f38a31e1dc8054ee416937893c3762b5e4a9b35be01dfd7c49da5a87e8514661ab8261bc7be2ba399d13a22bc2781ba5fc6a7c4ce6c4614ad9f78f81183dce3b88095516b96601f93a5ab136b01af6cc5d29ea079961a1f3152704c93b58b5f748956b2a21c1a2eb11c9f1c9679fc23633fac323e2d0e53e2d63d155cdfef4af6809f7cf92544e11fe70e586eaacdc94d3ee310c0c6de63a4931618a2a8326f3f5e35d404841b76cf3e9928a623441aa725522c97512ef1c31041089183cbeef7183a7f791ebf78f29b4627773cc68779d763a46248f940aa5a15f7b0c6fc627ae975303c4eb0ae2d1eaad4ec81448c1e1da05ddf101495aa22ab0f5285f35a46c47840429d1658942e07acffcde2dc2c636e56463552554abab0d620ab8bea7eb1a96cb258df3eccd965cbd7597671ed945c788d49a7232c2584b8c60aa31fb9bcf9c8a5e4e0f103321b637892241f4d9a31d7a86a6210a43b1b18beb3a4c5190fc404839d51e7c8f34967ab2899092613967b1779b1073ffb02e6c1e2f409262c20d3d7ddbd0350dcbaee7a8e9b87b78cc72083cb23e2185403f3bc25635e5c616c37c49b3fbc153391d70aa27648c0b0efc808af9ba72cee19ca7ef1d8b3bb74924daa340a11543d7d1b70db7dfb949108ac9641f19529e33711d210686c1a3adc2189ded0512e73c6d3bb058362cba9ee365c7d1bca1908aed89250c3dd3f367494231bb778fd1f947393805dbf1ae9cde94bc10b46a4a9cdd42c544f21e1f02210486def1fd17bfc7e1d18cddb33b5c3cb34dd7361ceceff19def5de6e8b8653a328c8a82271f3fcfa5a79fc0b981b04ce84132c89c164c1142922cfa81a379c37c08f821d02c5b9e3ab3456d05d3ad7586ae2386c4f8cc398ecf7c3c37549c929c2a6d4167b789cbb710311283cf3c57da128564fbb127509b0bbcf7dcb877407b709fbbfbc7549309d3ad2d8ad2b03919b3b1bd4944107dc00f2d68859612113d31042292c6459ac1d1759ed2163cf6c8593e787e9ded8bbb99521089d025edf4227d7df2aeee0fcba902e2c7670843c02f6784d5184052819804d7efed7170788cf38eb66970cd92de7b20b151166821e885e0c807bae3058a80f73d688396024342844048826580c6e5d4ba359ab571cdf6f63ad57403ef1cde79ba7a8766e7c3a7a90ee0b4f9b284c24fceb27ff33a3d8ae530204d89508a453b30f8c8bce9981dcfd122525983731e94c20bc9901287c733aaaa2445c77c3e27a5dca23a56a048f8249905491292f17482f30ea935f3f98c18416e3d46dc7d1cbff5e4a9aae25d397d02b3e92e9d1b386c07664dcfc6c626236578726b03b93565399b11b7a768ad325b83c90dd749248624882937480f21305bf6dc3f3ae2d1b33bd84a5359835f4df58e2735756959f401a935df7af9061ff84f7f95dd4ba77f2a7e584e1d10b97e1e54aede155a521505b554142494877a3445adad2104a8948831e0879e28153e4602d0f9c0b2ef095d879c8c91c1331aad61ada26f1c32044aabf3b4af9278e7d8d8dce2bb2f7d9f5ffc6b40fea488624cbdfb38ce5f41f43d2f3df71d36b736d81d8db12462d7a3645ab12df428295046d3f53d5def702e70d034dc9f2dd8dd9cf281272f525786a2b2c418f1de53688d9092d679bcd0944a72d8f73cfa91a74efbf17f444e1d1080f2e2b3b0b8c77a65d99aae7134eba8b6266c6d4e290bcb646713d7b5ecdfbdc3eef947e8160bf66ebcc3fce018b71cd042f3f1679e66e7910d941579143a040e0f8f71c1539715c10796ed80b2309e4cf8d047ff1693f7fdc4693ffa8fc843014875e60986cb7f8c55828ded6da63347681ceb4c189b8a3254445bb27e7684d596412a74d1b036d67476c03c728ecd736b089d8829d303366dcfbc7148612041d7760c2e312e25d65846674f2ff8fb37c94301882a4688edc7097b97410ac69b639c0df8de919446c406c38af7bae9680f0f716d8b90b07e669d726a51468102df3634cb86a6f334bd436b4d8a390e19a2a23026e7bceacdd37eec3f531e0a4000d4f6e31cdc7c155b388a42214a688781706fc6acefd02a772d8614f029906a8daa2cd83ce0831004ef0929d1749ee3454b4ab9689580453f80b6ec4c6ae478f3d418e3fe2279680019ef3ec65df4838adfd16cc63bb7efa145428788122052ca849732a17c622d566c971b20232124fabee7e068c1c1aca173e101dffb61db72b8e8f8c0c50dc6a5414e774efb71ff5c79680091baa0dcbe00c33e29c1645c312e3487f3054dd773389b13bd8724d8ac34e7b6a68cea4d94cc4dd23125fac1b17f78ccfebca51f029b6b539ac1b17fb8a4927071678cb18a608ad37edc3f571e1a400046e79ea4bd72c04829ac513c7af13c9b4747dcdf3f64bd3468a0d492edf531656928cbcc73154938efe90647ef3c6d37109260d10fec1f1d5109c1279e7a8c519d198452bdb66a9778f8e4a102647aee49aebdf60dd61094d6608da1ae2b46d3c98ae64fa052623c2ed03acfa9a7187247898fcc3bcfc17260d167f6d2ae3f622c221f7c6c97ad8d0945690829f2c26fff53369ffd392e7ef8a3a7fdc83f22a7cf1cfc43a24dc1dac567395a34b43e12a4a2f191201483f7b47d8f17923e2986084392b441b0375b72777fc6adfb87ec1f772cdb81e3c5922a0c3cf3e8363b6736a9c6355aab3c42777cc8777eed7fe1d637bf71da8ffc23f2509d1080f54b1fe7b5cb2fe09cc72849b39cd3360dde0da410734ba884b2b468a5e9da8ee572c9a269b9bd77ccfee182182297366a3e70718beded35469311dac83c531812c1f5ecc882f6f7bf4afae94f3d541ed7430788292a1efda95fe68ddffbdc8af5adc739c77cd1d0743dd351c9a8d284f992e4235d3be0bde3e870c6dee18c426bdeb75573e9cc1adbdb6b8c2723b45168a35643a0119a967152b8c34386d7dfa0f8c0fb4ffbb11fc8430708c0da994739f791cff0ea573f4f0c011f22ce0716cb9eaef728495e6dd1f778e768964ba2f39cdf98f0beed31bbeb35db5b13c6d31a5318b43599f15a6ac2a263b8bb6484c5f73d075ffb1ae7fe1a90bf582e7ce867d8b8f0145ffbf5ff917b77eeb06cdb1c6b784f221142240e038ac8ce74c485b39b6c569a336b151b9b2326d3114559604afba0f12126c9ddcb6f5375804c4c2acbfc955799deb8c9e8d1d3193ff8d3a27ee5efff37ffed697f883f4f6c39e2d296458596a6e988ce11fafcd510d91c592e6d8d786ca3666b3a626b5ab2b15e331e5554a31a5b9798aa42db02a914f3a319977ff775e490305a13235863b873e50ad5684471f6ec693ff2c37b42008edfbe46ba7b8bc72e9cc5c68e7b3703f31a06173052b25e174c6b4d5d158ceb92bad4d495a51a5514a3125b1528a391461182e7ad6fbdc9307794b6444a450c91663943771db7ffd1e738fae36f71e1577f05599e7c4fefbbf250b9bd3f2cfd72c917fea7ff9eab57ae329d4e591f8f581b156c8f0b2e6ed63c7e66c2f9ed313b1b23b6d66a26b5a12e0dd5a8c4d616535a943548ad4024eebfb3c7cd17dec14a45748ee40662c89d8a5649e6cd82d9ebaff2ce3ffc35162f7d7fb5e8e5e4e5a13d21dffcf5ff933bb7ef307ecbf0c98f3fc3fafa1aa2df6159288c92145651188d960225a1282c655d622b83292dd2e8150547a25b34bcfe7baf31159956b62c4a42ca5d8d52688c56dc3e3e64776d8378f532e1d7ef72bcb3c3e4673fcde8231f469de089792801e9f6f778fd0fbf022971f7ce0129458ad2b2b5bdc1a45488e81112b422779818832d730a5e5b8d3236b79d92883172ed9b6f317f7bc65458aaaa62d6749465454a0221e1f672862e2b7a2243db219542dfbc41fae21eed1f7d1df5ec0718ffe42729b7dffba4e44309c8e5dff96d0637d00f0365d7e3fa162505b62cb06a8c482113328b8494a0a4ccb4b25aa14d91e93644de5178ebf26d6e7eeb3a1b458d5f753196a5a51f3a84b604efb9315f7266bc868e01a115f36543511896c7033b21c0d7efd37ffb39f4850b8c3ef529c6cf7ee087d6bbfe78e5a10324a5c4de0bdf618864be4525096e408ab822e62f10296650445a91d0c47c2a54eee71532111374f396b7befc3a321a5c3f646a5a025deb10abf5173762422218499b81ea3b8482a11d104ab2b75ca205d8c2515dbf4e73f52af3336718fff44f33fae4c791ef12affd98e4a103e4f8fbdf677f7f0f6224a498f753859469667d8f14092513444792022953a6dc08b9d50e234948fce078ed5fbc08c781ca68061770de23744ebd18adb943e2e6c1111f5e3b4fa10c2281d59610328b6a8c11e1038314c4c1d3fa39420adc9d5bccbff005ec57fe80ad4f7f9ad1a77e1259d81fcbf33f1480a418397efd4dda175fe0e0bb2f64f61e1f88229174e65224f84cf39af2cc084966f2999410d123a52533674a624c5cffd757686eb4794b9bcff146d73b7081c26aeec4c837efdfe552b9c9d8ac06824244c85c5b31d2206d768de3e0482117c8dc3070bfeb298c41f71dee777f87eadbcf3179e619ca0f3f837df4e2ffafdcd8e90decf840f7e615f65f7c89fef25bf4f37d0e8f0fd8188d285703fe3e04aaca20a5c0084d72dd7c562200000c79494441547e3590231e540f9522bff54aae2a8482e6b861efb93ba418b152d17b8f740e636ca67c4a8237da055bb2e2c9cdb3799c2eacc8fc9128a132c14dbf1a8313a056fcf1d6684a014d187021b0ec7acaa665767488fcc637194fa74c3ef221463ffbd3e8e9f4df5a2fa702c8fcf9ef72ef77be42f29e6e3627f54b66c39294128d1f3042a01184e8397f6607a5742ee18a407479e7ad481a4142ab3cc02957fc5921c1f5dfbf42ea33497322516a4d33380a63914272183dcbe3964fec5ccc73ea3120560ca76eb56927adf65c051f30dae006474c09ad3468cd58d78898680b285264b19c23500c7d87fbe6b7695e7e95f167fe06939ff8c4bf956e4e1490e43d77bef0cf387efe65a414f4dd82d4cd19bca7560a94c069097dc49406a50c97ce6faf620d49594d70cd62c5141bf3925b41f6ae8a82942277be7d83f9dbc799bebc28334b5084693dc27b8f579ac3def3c468cac49684184922ef29c98b5fd4038e93bca80c86be7fb093570a993be6536e0e2f3c80c4468d308a65dfe342a0ea3a969fff12cbe79e67e33ffa458a27febfcdbb9f182071d970ff37ff1f96d76ee08696b2ac5031cf0a4691d029d2a748541a8580e439bf3ee6fcd674a584483d1a3188487840149329fff48aeff7e0ed3dee3cff36ae1df26ea918a8ea0a37788610a88c41484d7374cc4635454a81109210c38315ac52eb6c37525c5d81efd2904762882415494110de1d3a1582e03c424ab4d0ac19854f8ec139861048376fd2ffa3ff9bc9fb9f66fceffd4deceebf3996391140ba3b7739fccd2f32bb7b377f2309628a14d508d7386cc8c0d4b6a291d9db29b5e491739b68952738b42eb05585d192a159129ccff38942a08b92300cdcf983b7e8db016bf3faee3e0608600b8b960aef1cb3a1474641a52bfcaa935e2a494c09b932c669c53a14bdcf9bab591148c440e80375599356ebf782cf6bf75288b8b6a7aa6b0802ef7a4491b75ccb04fb2f7d9ff9f5ab8cfec6cfb2fdb33ff3e7eaea3d07a4bb7d977bbffe9b34fb79c033469faf18a9514a223777607148027a21f1cb1695121b8565777d8408e4cd6b55851402610d428c083e1056f7ba9486cb7ff00a47b7e7d4c64212781f1899823e7a8cd0745dcf643ce2edbd03d6aa2949485079b56b623527ef03d1c7bc98d20fa418560cda120908a5515a677ac1903085c20d21af54323a73c7a7ec351a5d716b39231502b1e8d93586a37689fae2973878f30d1effbb7f075bd53fa2aff734b9d8debec3dbffc73fa63b98675ec418e8db3eafac93025596f87ee0f2ad3bbc7ef36d9c5478ef883150db92495d53d535755d61ac460a8dd205b69c505413743942e8929b2fdce0fa0b579152d0398f96126b0dda1882100c21a0cb82790c344633dede5cf16a65d759c28af134a75a628ca410914aaf0648012132fb76ccb3905249ba654bf06eb563371262a41f7a528c04019ba311a3046a31c72d178cbc67d20fc8efbeccb5ffe11fd05ebe72728084b663ff0bff8ab06c71439ff775b43d00aa304412716889b343ce8e478cab8a30045208992a5c49cab2a21e5594559137e30895892aa542c812301cbe7dcc95afbdc1c678caa2e9b1c6d238871492657074ce71dbb77cebe615be7be72e5a29448ac8ca200a83908a24f2e60421c83b464278701d659689bca82c83a430c6d2f53dfdb07a1e95af3791f2b6eb214606df13138c06cfd9b262a7a8180b41ad15c23bf4e11eaffd83ff99377ef337f32cfd4adeb32bebf80fbf4173fd6d8494ab9446f656c66b131c91d0cea9494412c658d468cc71d732c400ce6346652617ad2bb47997cb174012573b41ba65cf0b5ffe2e7f74ed2d666dc7d9d188e9b0641dc971df71147bf68fe65cb415977676f27a23a391d6c01032f9fffa94fe68815ff644123ec4bc81da9acc4ae457abfc5cfe79e71d43d7b36c1b46a3d18a1a3de6d323a0e9bbbcd6c9f56c111892472b4d54999fd8458f528265bb4068c5f39fff2734c7877cf4effd2a42ebf70610df341c3dff2291845cd1b02e9b19b63018a1e0e888711cd0d690b4461496501684d98ccbf3033eb2799628f220a8b6161099a357e6f51229e67bfeca0b57f9ca73cf737331c7a4c4e1fc182114ef2b4b6a21385b963cbeb9cd13db3b1c370d6555119b39d607fc788d202dfdd11c69146b17ce71f8ce6d0801650c214404794198d21abde2628c21d2ba1e6d0d90978ea5151160eb0790824204acc8cd17a3aa62e83a3a9728b46118321f983296903c5bb6e41bfff29fa14cc1877fe557de1b400e5efe3ea16d31455e9a521405478b23eaa2a22e24a96d734d5c69a2f304ef98efefa185e283ebbb146b53e6cd01470773fcd0934623f29eaabcb6220ac1f2f098af7df9eb1cb50d3b4a51ad1473ae9cb06b2de3d212626277738be5a2657bba46b36c29ada51f5a6c03cbc51cbdbe01ca7274eb3e93dd6dfcb2c70f032942ef86d5a59eb74f471f18dcc0b26ff342e51810c2e0bda367402a890a82e43b828291b12c160bcab224c6c8b26d988cc7f4c3808801ab141bda5229cd0b5ffee75cfcc4277efc3624a5c4e11ffd31d5640446a28cc6a588b092a812aa6f08cea1a442c8952175036dd3f0fcb5cb1c2de7f43130dedc66ff784eb75c12437c40cd1462a05bb67cedf35fe1f2cdebac11d92e2cb5145c1c4db8381ab13eaad142b23d59a399354c6c49db3b46e3113ebebb2626b26d1472ff1e627e48bd31a63b5a208d66bcbb8d2a0b9454795198522491e843cfe1fc300f522b8d2e0cde7b8212f8e859b473c622b053576899b7c28dab92d972494a91b2c84de483f7082570de51da822d5372b058f0c2e73efbe33f21fdb56bf8fbf7589613bc1f2004e6f76fe1da86e9740a458d14996da1901a1702a5522c86868a481d1c77af5da11b95ecee56344dcb7a4ab01a2bf89dcf7e9e17bef512f78e17f4bd67a23563a1085ab2652aa6a39ae07c5eabea1cd3f1881003a1f7b46d42284155560801f3be633a1ed3740dcdf131f6cc3984942cefed63d7a63946d112a5358b8303faa14528b1aac70782f379c671de60eb8a7525716dc32c58941268a399370bd646256d3740d2247227ff62b9a42c2bbc0b5c2c475c5b1ef3f63b6ffff80119da168460081de9e080ae6b70bea72a2ca52d08215296054ae65575a5b1344347ad14e7c663c6d6b0a56abe71fb06dbe21c877bc76c5f70e8b2e695afbdc8737ff42207cb06dcc0b62ea80a43749e736b9b6cd635be73d455450c9eca16f4de115c603a1ee7add11296cb06ab0ce3a2e470768c311aa51371ef1d9aa050bbe7097d8fef7a82f758a30922d2abb8dae226b0d62285a00f9ea8a06d666c1a4b55da55bd46b1ec7a7c4a0c83438848dbb794c6e2fcc0a8aae842c018458c8a755b30ebdb1fff95a5ac25367344b340468794ac5c4290e4cd6aacae1e21e56a8fad240c0393c2303616a33567ada58a89bd6b77e9fb9e2bdf7b9dcf7ff6f31c2f1b640cd4c622011560776d935a4a4482695d43088cca1a62a4eb1dd351cd72d91062e4e878c1a8aa914ab1ec3a26558d5b110c90046ba5c4dfba02f7dfc1f7334a15a9b7260caec50f0393ed4d0a63325de96ae3744a814ae42d703e460ebb81dbcb0382ef08c973d43579d9580c282d7083039118fa1eef3dca5a76aa31f3be7f0fe21021f05d8ff60ee77a0aa588c1511736676645de4290526e76f311164dc37a5d313296aa28f1de33b116a314eddd25cdbce32bfff89fa3fb8eb1568c8b82b1549cad6b76261326c6322e0a644ad9600a898f8166706c8d472c9b8ea234f4ddc0a4aee99b96e0036555d24787f70e9d728cb16c3a6a6b1919413ada231ddda3b8778bf6f808ad0ded6c86ae4b420c344dce50c7e0d122a265c200f3ee9845b340cb04316224f4c340088145dba28da26d5aca95e736f42d1736b77365f4c78d875a9b92446686534a11a2675ad618695031ad18aac58a6e2f3b015555d1bb40a50abc77a4108808c6ba6498f57ce9fffa22fb37ef52494d291513a578646d4a652d636d98989c102c6d89519aaa28197ac7a82ce982a7b09aa173ac4d27b861201983d19a6e700cbda75ab9b92946c645811b3c2165b7b72e4beeef1fb077b407aec3a7c47832c58ec778129e4045625a96b810d95b1c316b1b141299049d1b188fc739d297d0bad5e264e728ac0591f0c111ddc023d37534f0dffd380129b7b632e382b68490504ab1e8e76caf6f125c00934928079757659312c7b3196b45b5221c83edf54d6e2f0ef1de1313cc6fdce1fc684ceb1c3a254646135364524fb1643264a5f32a579504c7ed92426a46e309fbfb7b94754dd289bda3438c51e81411cad0cde76c8c6bf69b169920054fe3214a41612c459d53227bcb236aa0880328cbfeddbb8c3637284623c47c4e8a0e9f1cb5d11c77119912f3aec3d5918424058ff30346e5554b4aaf769ea8bc48462845f08e9d7accff0b1e94a8fcd33646940000000049454e44ae426082, 3, 20),
(4, 'Asa', 'c8837b23ff8aaa8a2dde915473ce0991', 'asa@gmail.com', 1, 0xffd8ffe000104a46494600010101006000600000fffe003e43524541544f523a2067642d6a7065672076312e3020287573696e6720494a47204a50454720763830292c2064656661756c74207175616c6974790affdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc00011080064006403012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00bbe28b55bd33f88344825fb1200d35d38d89230206514f2de87a0a8b45b5b5bfbb86fe48a37d8a0c40e72a7ae4fae2b7ef2f22b9d266b57c88654c4cb9c06c73f85731e0b9375fcd6e395dcdb7f3a8524d687455a6e2db7d4e8f50b78e29236e013562de1dca2b5b51d027bab68e48e32d81d075aceb6827b56c3292be86afa1cf62716c40ce281110dc6411d0d69db849578ebe94e7b61e952332ae2da3ba8bcbb804a8e8727009f6e95cd5fe812dab1961f993b62b57c4fe22b5f0ddb86957cd9dfee440e33ee7d05706df137521b82db5b053d8827fad524dea49d359ea525bb08e51c7bd7436f7292a868dabcae2f1b99d9fedb6aa4939568b8c7b62ba1d375986621ad670e3a95e847d455599277dba39d3cb9d432ff2a8de17b7e73e645fdeee3eb59769a9a4ca01386abe97a63ea722813346d7061c8f5a2996ad6ed116562b96e8a78a280b1e412deeabafc421b787cab76eaecf927f1e00aec7e17e8d9d45e6604c7182149e8c73827f3cd794e99addc585e473860db5b3b08f97f2aefadbe217f645ba0d1d21134e373ee4e21009f940e849eb54a0ada16e727b9f40040acb8c0c291fcaabdce9f6f7392c8031ee2b94f0a7c42b1d742417605ade118e4fc8e7d8f6fa576d50d34339abbd21edcef8bf4ac4d5f5d4d1f4c9ee2e57e745f907f79bb0aefc804608c8af34f8a16893416b696ec3cd773238feea818c9a16bb81e2f7f35ff8875496e6672f231c927a28ec05675d584b69f78647ad75d0adadab7d9572ac7f89bf88d32fad59d7690181ace555a9791d11a09c7cce2075f7abfa75d358dd24e832cbdaaf3681232b3c5ce3b566bc66172ac0861d456aa69ec612a6e3b9e9767baf34a87508036d6186e3a11d6ac5aea6cd20864fa554f875a81fb15c69f2a8788b6f00f6ec6b7ef743486e9678fee3722937626c6a58427ece793f7bfa0a2a7d36366b5c8e9ba8a093e6d8adae18e7cb6cfa1e2afc504c872f1b291cf231547cd607a9ab315dc8083b8e477cd6ca282e745a5dd189d7922be86f045d5cddf87a392e6477c70a5bae3eb5f34db5f9dffbc25c7b9e6bd4bc19f10d749b45b7beb8927873854c0cc63db27a7b5128dd68099ec577731d9da4b712e7646a58e2bcabc497ada84f24cfd5c720761e95a9e32f1ad94f616d6da7dc07f3d833e3fbb8cff51f9571573a9ab12a586eae79e88e9a314ddd9cfdf69a5e5ca6e1c8db8e00f7fad59494dbc68b7631b8e0391c568698e9a8dfc76f23088b3800b30c1cd49e2ed37ed170b0db0ca84d814740c38ac64dbdcec8c52f84d1d174b8ee70ebb5d7d8d71ff106cadec3598e38800ec9b99476aeabc276b378720beba9b798e084970785276e411ef9e2b9dd1b43bcf19eb6d2dcb36647dd24a46768f415a538a5a9cf5a6dab3367e18d9af937334840270157b9aee351388067a0ae7bc29611cad6f7f690b431c0b25b346df79fe6c824f7f4fc2ba6d62d253a2dccc582f971b374cf6ab96ace533ac750716f88a53b413d1a8ae1b4796e05a3fef7fe5a1ef8ec28a4163cba46da4fb52249819a82ea5dd2ed5eb46ec00076ae86f5332f473e0f5ad1b395a7b98a156c33b05c9ed9ac257c0ab9a7cadf6863939114878ff70d26ec8695cda9b54325e34a8c719f973d876fd2b556ee391915a631c8ea0abe7863e86b8af3ff002abf6fa80f2f64881d474f6aca6ae74519a8bd4f41d2bcb49d45f44164723cbc8c86e7ef2fd0d75567a79bbc64e4ab93b8fd6bcbedbc4acb244c62ca41ca0ea735a771e33b95b0f9a478226e04708c48ff00563f747bf27dbae30f672933a9d78ad8ee3c65abd95ae822c21cca24956390c647ccc39db9fc39f4e2bb8b1d3f4ff0ef866ce63025b4a608fcd038cb9519ebdf35e37e01b5b9f1978b2c60b93fe87640ccc83ee850413f8b1c03ff00d6aeafe2478a5a6d49ad21626380ec441fc6feb5b5acac72b7cecd71ab9468ac74e4492e8ae49e8a83bbb7a0f73535dcd1c1e11d4d9ae5ae25954e6439dadc7f0e792bcf5c0f6cf5af3dd3a1be93518ed52e4a21569af6466c07d8a58afbaae00f4cfe1592359beb9beb857b862260de621391c904e3d3a0fc850ad622717737f4883fd0c9c756fe828abba6854b5da7d7fa0a2a447844592d93c935283939a8a33c1a907a57424663cb76156b4f277dc49c048a072c4fb8da3f56154fb55dd3be75bb800399add80c7aa90fff00b263f1a1a04551d79a950e0d3e0b55f245c5d4862809217032cffee8fea78fa9e2b5adb54f0fdadae3fb127baba208dd7178446be842a2a93ff7d54d8a1967b2080dddc2ee8c1c221ff968de9f41dc8f6f5a58ddf5179164c648ce40002919c01f9d65cd772dcca0b6381b5540c0519ce00ec393566dae5a170571d724d690b5f5264fb1ee3f0c134fd17c352a452a49abde395940ff00966838183e9ce723d7dab84d6d24bbf12c69049f310d3ef5e9b8e5b23db3d3da8d02e85c2b2c72c91bb2900abe0f3dff00c9addd23c2b7f78d757fe6c60451b451ab649e083fc81a75a8f2ae65b134aade5cacb9e17d392ff519ecde13362c5e248d5b69666c639edc0639ae1ece02758640a422394e4e49c1ea4f7af55f06451e9fa3ebfafc8df3c0b24719f4dab938fc715e6ba1fef6e3cd3cf539fc6b8a2d6abb1d551de5736e5bb304a6353d3ad159c1fcfbbbc6ecb36d1f82ad1569686679545f7053f3cd4511f929fc66ba0c89320d6c7878db5adc49a95eee315a2ee8e35ff96b29fb887db824fb03eb5474dd3e5d4ae8411144014bc9239c2468064b31f403fc0649a9353bcb7764b5b2dff62832232e30d213d5c81d09c74ec001938cd032adcdc4b753192672cf803d0003a003b01e829a63748d1ca3047ced62386a8f39a50fb475e3d334982265217eb8a9620cec36fe9505a4325e5c2c312966635dfe89e0937014cb7288dfdd09b852f6914fde6350935748c8d237c122b365573dc57a9697abcb691a2c790f798b727b063fc7f80c9fc3154adfc1371690197cb12c407ccf11e40f523ffadf8d45a8e9acba24b0a4ab179644d1b741b97ff413fa66bb972ca8bb3b9c536d5549ab1d8fc44fecff000e7c347b2d314451dd4aa8a37649c9dcc727e9fad797e85179566cec7181c9a835ff0010dcf88ac34f82ea601ecd76e09e2504f2dfef6001efed56277fb1787643d199768fa9e2bcb9ab1df17a6a1a183736b3cc7fe5a4ecdf9e28a4d08caba7958c0c07e7eb8145033ca53826a4cd14574199d0a8fb2781bce84957bdbd68673fde48d51957e9b9f27d4aafa560668a28010d46ec738a28a4c0eabc1b0a33cd211f3642e7dabd4f47f95d40a28af3eaff0010eea7fc33d23c3ce4edae33e285a436ba7ea91c0bb15e1593000f94e79c7e5faf14515df867bfa1c1885aaf53c2ee18e5573c6715a525f5c496f0dabc85a20d900f518a28ace45a3d4be1f69b6b77e1e9a59a3dcff6a719f60168a28a813dcfffd9, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item` (`item`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `roleid` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

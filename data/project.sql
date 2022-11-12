-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 09:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

DROP DATABASE IF EXISTS `project`;
CREATE DATABASE `project`;
USE `project`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoryID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `imageID` int(11) DEFAULT NULL,
  `displayed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `title`, `location`, `content`, `created`, `categoryID`, `memberID`, `imageID`, `displayed`) VALUES
(1, 'Garibaldi Lake Trail', 'Garibaldi Provincial park', 'The Garibaldi Lake Trail is in a very good condition and well-maintained, which makes this trail really pretty in every season. The trek through the first two lakes, Barrier Lake and Lesser Garibaldi Lake, are such nice little treats for a break before continuing and getting ready for the main lake. The first 5km are through switchbacks that zigzag back and forth and are tiring but not super steep. Garibaldi Lake is the crown jewel and a fabulous lake, with an amazing colour and breathtaking views and landscape.', '2021-01-26 20:21:03', 1, 2, 1, 1),
(2, 'Joffre Lakes Trail', 'Joffre lakes Provincial Park', 'The Joffre Lakes Trail is both a day hike and a multi-day hike offering views of picturesque lakes in British Columbian mountains. As one of the most popular routes in the area, this trail is a great hike for the whole family, new users, or experienced hikers alike. The trail is very well marked, and for the most part, the infamous incline is gradual but quite long. From the parking lot to the first lake, users will get a quick and easy taste of this adventure with a mere five minute downhill wander through the forest, which is often the busiest section with many young families just venturing to this first lake. Then from first lake to second, this is the longest stretch of trail but attainable if users maintain a steady pace, and then from second or middle lake to the third lake it is only a short distance of ten to fifteen minutes if not taking breaks. There are lots of varied views on the entire hike featuring meadows, lakes, waterfalls, and glaciers - allowing users to enjoy something for everyone.', '2021-01-29 03:44:03', 1, 2, 3, 1),
(3, 'Grouse Grind', ' The Grouse Mountain Park', 'The Grouse Grind is one of Vancouver’s most iconic trails which takes users up the face of Grouse Mountain, sometimes referred to as Mother Nature\'s Stairmaster. This trail is very challenging, and users should come prepared to struggle. On average, it takes up to an hour and a half to complete the ascent. For novice hikers, more than two hours is recommended.', '2021-02-02 17:45:52', 1, 1, 4, 1),
(4, 'Stawamus Chief Trail', 'Stawamus Chief Park', 'The Stawamus Chief Trail, known locally as \"The Chief\" is a route that every passionate hiker should have on their bucket list. At just under six kilometres, hiking Peak One and Peak Two together definitely gives hikers the most substantial views in the shortest distance. But despite being relatively short, this is not an easy hike as it requires conquering large stairway steps up the whole way - similar to the iconic Grouse Grind but with even higher steps. It is also very technical with a series of chains and ladders higher into this hike, and the route from first peak to second peak as shown is actually a climbing route. Only hikers with climbing experience should attempt the full adventure.', '2021-02-12 19:05:35', 1, 3, 6, 1),
(5, 'Cypress Mountain', 'North Shore Mountains', 'Cypress Mountain is Vancouver\'s Spectacular Mountain Playground with 52 Downhill winter skiing and riding runs accessed by 6 chair lifts (2 high speed), plus a magic carpet surface lift in our kids camp area. We also offer 19 kms of track set Cross Country Skiing trails, a Snowtubing park with a tube tow lift, our amazingly popular snowshoeing tours around the historic Hollyburn Lodge built in 1926 and Vancouver\'s BEST Sunsets.', '2021-02-26 23:31:16', 2, 3, 7, 1),
(6, 'Grouse Mountain Resort', '6400 Nancy Greene Way North Vancouver, BC', 'Grouse Mountain is Vancouver’s most visited year-round attraction located just 15 minutes from downtown. Enjoy panoramic views as you travel to the alpine aboard the iconic Skyride.  Visitors can take part in a wide variety of thrilling outdoor adventures, cultural activities and educational experiences available year-round. In summer, choose from an incredible variety of activities including our World Famous Lumberjack Show, Birds in Motion demonstration, incredible views in the Eye of the Wind, visits with our resident Grizzly bears, dining, shopping and more.  In winter, enjoy world class skiing and snowboarding, the stunning light installations on the Light Walk, the slopes at the Sliding Zone, our outdoor skating pond, snowshoeing and more.  Grouse Mountain is the “must-see attraction” in Vancouver.', '2021-03-03 05:02:47', 2, 1, 8, 1),
(7, 'Mt Seymour Resort', '1700 Mount Seymour Road North Vancouver, BC', 'Mt Seymour is Vancouver’s only family owned and operated ski area delivering a relaxed West Coast feel only 30 minutes drive from downtown Vancouver. Mt Seymour is an extended family of passionate skiers and snowboarders who want to share their excitement for winter recreation with families and individuals across the Lower Mainland.  Famous as a place to learn and a place to shred terrain parks, Mt Seymour continues to create new skiers and snowboarders who share lifelong winter memories.', '2021-03-06 18:16:22', 2, 1, 2, 1),
(8, 'Whistler Blackcomb Mountain', '329-2055 Lake Placid Road Whistler, BC', 'Whistler and Blackcomb are two side-by-side mountains which combined offer over 200 marked runs, 8,171 acres of terrain, 16 alpine bowls, three glaciers, and receives on average over 1,164 centimetres (458 inches) of snow annually. A world class resort for all seasons, Whistler Blackcomb has one of the longest ski and ride seasons in North America, as well as lift accessed mountain biking and alpine hiking in the spring, summer and fall.', '2021-03-12 22:45:49', 2, 2, 9, 1),
(9, 'Desolation Sound', 'Salish Sea and of the Sunshine Coast,BC', 'One of the more popular ocean boating spots in BC because of its many shallow inlets and coves surrounding the islands of Cortes, Quadra and Sonora. Being that the water is shallow, its temperature is much warmer than in other areas around BC. The town of Comox on Vancouver Island is a frequented port where sail and powerboats can be chartered.', '2021-03-13 01:09:40', 3, 1, 10, 1),
(10, 'Atlin lake', 'North of the border in the Yukon Territory', 'The Atlin Lakes are recreation marine destinations located in the community of Atlin, BC. The village of Atlin rests on the southeastern shore of the Atlin Lake. The lake stretches south to north with the northern tip of the lake connecting with the smaller Little Atlin Lake near the British ColumbiaYukon Border. Little Atlin Lake is actually located north of the border in the Yukon Territory.\r\nAtlin Lake is said to be the headwater to the Yukon River. Both, Atlin and Little Atlin, are part of a chain of lakes which dominate the northwestern landscape of British Columbia and the Southern Lakes region of the Yukon Territory. During the summer months Atlin Lake attracts many activities to the region including canoeing, fishing, wilderness camping and boating.\r\n', '2021-03-16 21:14:40', 3, 1, 11, 1),
(11, 'Harrison Lake', ' Harrison Lake, BC', 'Accessed from Harrison Hot Springs, Harrison Lake is the largest lake in southwestern BC. The glacier-fed lake is about 60-kilometres long and 9km across at its widest point covering approximately 250 square kilometers.\r\nHome to a wide variety of wildlife, the lake offers great opportunities for outdoor recreation. Whether you are into sailing, boating, windsurfing, kayaking, fishing or any combination of these Harrison Lake has something to offer. Have your own boat then head to the conveniently situated boat launch. Need to rent a boat check out our boat rental companies.', '2021-03-18 01:01:19', 3, 3, 12, 1),
(12, 'Stanley Park', 'Vancouver Downtown,BC', 'It can be difficult to cover all the ground in Stanley Park in one afternoon, as this sprawling urban sanctuary is packed with historic landmarks, upscale and casual restaurants, scenic gardens and sandy beaches. Ride the 10 kilometre (6 mile) paved path along the Stanley Park Seawall, which circles the entire park and promises plenty of spectacular sightseeing. Or speed things up and cruise the bike trails through the park, where you can coast by the rose garden, the Vancouver Rowing Club and Lost Lagoon.', '2021-03-20 18:24:52', 4, 2, 5, 1),
(13, 'Sunset Beach – False Creek – Kitsilano Beach', 'Vancouver Downtown,BC', 'Pedal along this seaside route to see Vancouver’s beaches and urban waterfront areas. Start at Sunset Beach on the English Bay, where rollerbladers and joggers often share the path and families take advantage of the floating slide and full-time lifeguard. Continue along the path, which circles False Creek, leading you past a number of museums, including Science World and Vancouver Maritime Museum. Foodies might be tempted to take a detour to Granville Island, which is known for its array of dining options, waterfront patios and the famous Granville Island Public Market. End the ride at Kitsilano Beach, where outdoor enthusiasts gather for recreational games along the sandy beaches and grassy areas. You can even cool off at Kitsilano Pool, an outdoor saltwater pool with impressive views of the city and ocean.', '2021-03-21 15:44:01', 4, 2, 13, 1),
(14, 'Central Valley Greenway', 'Lower Mainland,BC', 'This 24-kilometre (15-mile) route connects downtown Vancouver with the nearby municipalities of Burnaby and New Westminster, leading cyclists through metropolitan neighbourhoods, along historic shopping districts and into scenic, natural areas. The route begins at Science World on False Creek and curves down through Commercial Drive, making it easy to explore the nearby neighbourhoods and Trout Lake. Continue along through Burnaby, where you can see wildlife at Burnaby Lake and pass by the Nature House, Equestrian Centre and Rowing Pavilion. Finally, the path leads to New Westminster, where you can stop at one of the many outdoor cafés or browse fresh produce and locally-made goods at the River Market at New Westminster Quay.', '2021-03-27 20:15:20', 4, 3, 14, 1),
(15, 'Jericho Beach ', 'UBC – Pacific Spirit Regional Park,BC', 'Start out at Jericho Beach, where windsurfers and sailboats can be found coasting along the waters of the English Bay. The bike path winds along the shoreline, past Spanish Banks, where it’s easy to spot people playing soccer and volleyball. Stop at a nearby beach concession stand and enjoy a picnic on the sandy banks, or keep following the route, which leads up to the University of British Columbia. This sprawling campus is home to the renowned Museum of Anthropology, the UBC Botanical Garden, Greenheart TreeWalk and Nitobe Memorial Garden. End the trip at Pacific Spirit Regional Park, where unpaved bike paths cut through lushly forested areas. ', '2021-04-04 03:36:08', 1, 1, 15, 1),
(31, 'ferry', 'ferry', 'ferry', '2022-08-02 21:17:26', 2, 2, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `navigation`) VALUES
(1, 'Hiking', 'Climb mountains like a gaot', 1),
(2, 'Skiing', 'Winters can be fun!', 1),
(3, 'Boating', 'Explore lakes and oceans', 1),
(4, 'Biking', 'Workout in nature', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `file` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `file`, `alt`) VALUES
(1, 'garibaldi.jpg', 'garibaldi hiking'),
(2, 'seymour.jpg', 'seymour skiing'),
(3, 'joffre.jpg', 'joffre hiking'),
(4, 'grouse.jpg', 'grouse hiking'),
(5, 'stanleyPark.jpg', 'Stanley Park Biking'),
(6, 'stawamus.jpg', 'stawamus-hiking'),
(7, 'cypress.jpg', 'cypress skiing'),
(8, 'grouseSki.jpg', 'grouse skiing'),
(9, 'whistler.jpg', 'whistler skiing'),
(10, 'DesolationSound.jpg', 'Desolation baoting'),
(11, 'atlin.jpg', 'altin baoting'),
(12, 'harrison.jpg', 'harrison baoting'),
(13, 'sunsetBeach.jpg', 'sunsetBeach Biking'),
(14, 'centralGreenway.jpg', 'central Greenway biking'),
(15, 'jericho.jpg', 'jericho biking'),
(31, 'ferry(1).png', 'ferry'),
(32, 'ferry(1).png', 'ferry'),
(33, 'ferry(1).png', 'ferry'),
(34, 'ferry(1).png', 'ferry'),
(35, 'ferry(1).png', 'this is edited ferry');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `full_name` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `picture` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `full_name`, `email`, `password`, `joined`, `picture`) VALUES
(1, 'Ivy Stone', 'ivy@eg.link', 'c63j-82ve-2sv9-qlb38', '2021-01-26 20:04:23', 'member.png'),
(2, 'Luke Wood', 'luke@eg.link', 'saq8-2f2k-3nv7-fa4k', '2021-01-26 20:15:18', 'member2.png'),
(3, 'Emiko Ito', 'emi@eg.link', 'sk3r-vd92-3vn1-exm2', '2021-02-12 18:53:47', 'member3.png'),
(5, 'admin', 'admin@outdoors.ca', '$2y$10$fiJKj7L//OIDkpEcYMEMhuUAyjV4yT53LLiC31DRyuLznN/WyeUN.', '2022-08-03 03:14:40', 'memberdefault.png'),
(6, 'simon ', 'schauke@sfu.ca', '$2y$10$JZ.SZuc20Z/4vg6i4/FGMOq8IRW/2qYd2JlYMx1bhWKRhOafalNZa', '2022-08-03 06:03:25', 'member2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `authorID` (`memberID`),
  ADD KEY `imageID` (`imageID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `category_exists` FOREIGN KEY (`categoryID`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `image_exists` FOREIGN KEY (`imageID`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `member_exists` FOREIGN KEY (`memberID`) REFERENCES `member` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 02:27 PM
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
-- Database: `adventureseek`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `ActivityID` int(255) NOT NULL,
  `ActivityName` varchar(255) NOT NULL,
  `ActivityDescription` varchar(455) NOT NULL,
  `ActivityPopularity` varchar(255) NOT NULL,
  `PriceChild` int(255) NOT NULL,
  `PriceAdult` int(255) NOT NULL,
  `LocationID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`ActivityID`, `ActivityName`, `ActivityDescription`, `ActivityPopularity`, `PriceChild`, `PriceAdult`, `LocationID`) VALUES
(112, 'Tunku Abdul Rahman Island Visit & Boat Snorkelling Experience', 'Tunku Abdul Rahman Island, located off the coast of Kota Kinabalu in Sabah, Malaysia, is a pristine paradise perfect for snorkeling enthusiasts. The island boasts crystal-clear turquoise waters, vibrant coral reefs, and a diverse array of marine life, including colorful tropical fish, sea turtles, and occasionally even reef sharks. Its calm, shallow waters provide an ideal environment for both beginners and experienced snorkelers.', 'Least Popular', 230, 280, 121110),
(113, 'Private Boat Fun Snorkelling at Redang Island', 'Pulau Redang is a tropical paradise renowned for its crystal-clear waters and vibrant marine life, making it an ideal destination for snorkeling enthusiasts. The island\'s pristine coral reefs are home to an array of colorful fish, sea turtles, and other aquatic creatures. Snorkelers can explore the shallow waters near the shore or venture to deeper spots for a more immersive experience. ', 'Most Popular', 65, 80, 121111),
(114, 'Langkawi Boat Island Hopping Private Boat Tour', 'Pulau Langkawi, an idyllic archipelago in Malaysia, offers a prime spot for snorkeling enthusiasts. With its crystal-clear waters and vibrant coral reefs, the island provides an underwater haven teeming with marine life. Snorkelers can explore various spots like Pulau Payar Marine Park, renowned for its colorful fish and diverse sea creatures. The warm waters and gentle currents make it accessible for beginners and experienced snorkelers alike. ', '', 60, 75, 121114),
(115, 'Boat Snorkeling Experience in Tioman Island', 'Pulau Tioman, an enchanting island off Malaysia\'s east coast, offers an idyllic haven for snorkeling enthusiasts. The crystal-clear turquoise waters teem with vibrant marine life and stunning coral reefs, providing an underwater spectacle. Snorkelers can explore the rich biodiversity, spotting colorful fish, sea turtles, and even small sharks. ', '', 100, 130, 121112),
(116, 'Rawa Island Snorkeling Tour in Johor', 'Pulau Rawa in Johor is a paradise for snorkeling enthusiasts, offering crystal-clear waters teeming with vibrant marine life and colorful coral reefs. The island\'s pristine beaches and tranquil ambiance provide an ideal setting for exploring the underwater world. Snorkelers can expect to encounter a variety of fish species, sea turtles, and other marine creatures.', '', 40, 60, 121113),
(117, 'Pulau Sipadan Private Snorkeling Experience in Sabah', 'Pulau Sipadan, located off the coast of Sabah, is a world-renowned snorkeling destination offering crystal-clear waters teeming with vibrant marine life. Snorkelers can expect to see a stunning array of coral reefs, tropical fish, sea turtles, and even the occasional reef shark. The island\'s protected status ensures pristine conditions, making it a must-visit for underwater enthusiasts. ', '', 270, 286, 121115),
(118, 'Mabul Island Snorkeling Tour in Semporna', 'Pulau Mabul, located off the southeastern coast of Sabah, Malaysia, is a premier destination for snorkeling enthusiasts. Renowned for its crystal-clear waters and abundant marine life, this tropical paradise offers a captivating underwater experience. Snorkelers can explore vibrant coral reefs teeming with colorful fish, sea turtles, and other fascinating sea creatures. The island\'s serene environment and stunning underwater scenery make it an ideal s', '', 175, 190, 121116),
(119, 'Tun Sakaran Marine Park Island Hopping Tour', 'Tun Sakaran Marine Park in Sabah is a breathtaking haven for snorkeling enthusiasts, offering crystal-clear waters teeming with vibrant marine life and stunning coral reefs. Nestled in the Celebes Sea, the park boasts a diverse underwater ecosystem, including colorful fish, sea turtles, and various coral species. Snorkelers can explore the enchanting seascape, discovering hidden coves and experiencing the serene beauty of this protected area.', '', 210, 250, 121117),
(120, 'Perhentian Island Hopping Tour', 'Perhentian Island is a paradise for snorkeling enthusiasts. Its crystal-clear turquoise waters, vibrant coral reefs, and diverse marine life create an underwater haven. Visitors can explore shallow coral gardens teeming with colorful fish, sea turtles, and even reef sharks. With calm, warm waters and excellent visibility, the island offers an unforgettable snorkeling experience. Various snorkeling spots, including Turtle Bay and Shark Point, provide', '', 193, 216, 121118),
(121, 'Pulau Kapas Visit & Boat Snorkeling Experience', 'Experience the enchanting beauty of Pulau Kapas with an unforgettable Boat Snorkeling Adventure. Dive into crystal-clear waters teeming with vibrant marine life and stunning coral reefs. Your journey begins with a scenic boat ride to the island, where you’ll be captivated by the serene surroundings and pristine beaches. Snorkel amidst colorful fish and diverse underwater landscapes, making for an exhilarating and memorable excursion. ', '', 287, 295, 121119),
(122, 'Explore Klias Wildlife Safari', 'Explore the Klias Wetlands on this all-day guided tour from Kota Kinabalu. Cruise down the Klias River in search of proboscis monkeys, long-tailed macaques, the rare silver langur, and other local wildlife. At dusk, enjoy a village-style dinner before traveling through the mangrove swamp to see the fireflies’ flickering lights.', '', 241, 260, 131110),
(123, 'Mangrove Safari Boat Tour in Langkawi', 'The mangrove forests of Langkawi are home to an incredible variety of wildlife. With this tour, explore the flooded forests on a small boat and learn all about the region’s biodiversity from your guide. Along the way, look out for otters, dolphins, and eagles, and if you’re lucky, catch sight of the unique land-walking fish.', '', 174, 190, 131111),
(124, 'Amazing Fireflies With Blue Tears Watching & Kuala Selangor Tour', 'Enjoy an evening tour with a difference as you travel from Kuala Lumpur to Kuala Selangor for natural entertainment after dark. Take a boat ride through mangroves along the Selangor River, looking out for the thousands of magnificent fireflies that live in the forest. You’ll also get the chance to see the unusual blue tears phenomenon: marine plankton that emits an eerie blue-green light.', '', 100, 125, 131112),
(125, 'Tiarasa Escapes, Janda Baik', 'Tiarasa Escapes is a dreamy glamping site nestled in the cool foothills of Janda Baik, dotted with pretty safari-style tents and rooftop villas. Relax and unwind while being surrounded by nature in this lovely nature-inspired space!', '', 210, 230, 141110),
(126, 'Glamping Experience at Stellar Golden Hill Cameron', 'Malaysia’s first caravan glamping company, Stellar Golden Hills, is a perfect nature escape for families, couples, friends, and corporate retreats. Glamping ranging from caravans to luxury tents to bell tents, brings you into a unique nature setting and allows you to recharge and reconnect with yourself, others, and the beautiful world.\r\nWhile staying at Stellar Golden Hill, you can explore natural attractions nearby and indulge in a range of thrillin', '', 140, 180, 141111),
(127, 'Glamping Experience at Gopeng Glamping Park', 'Fancy sleeping in a tent beneath a starry sky, surrounded by hills, rivers, caves, and a lush forest? Located in the laid-back historical town of Gopeng,  Gopeng Glamping Park the is a perfect weekend getaway spot great for a relaxed trip.', '', 180, 210, 141112),
(128, 'Lagoon Villa Experience at Sunway Lagoon', 'Lagoon Villa is a collection of four beautifully designed villas located in the heart of Sunway Lagoon. Set amongst lush greenery, experience a uniquely charming getaway that features modern amenities, access to private pools and your very own balcony. Even better: You can get a view of the World’s Lagoon Villa is the perfect holiday destination where you’ll find both luxurious comfort and the excitement.', '', 290, 290, 141113),
(129, 'Dusun Bonda is a glamping site located in a fruit orchard in Batang Kali! ', 'DUSUN BONDA, a small privately-owned Villas and Bell Tent Glamping site in a fruit orchard, offers a harmonious stay with a breath taking atmosphere and surroundings. DUSUN BONDA is located at Ulu Tamu, Batang Kali, Selangor. It offers kids-friendly facilities, a beautiful serene view alongside a river and man-made waterfall and pool.', '', 320, 350, 141114),
(130, 'Glamping and Camping at The Rubber Escape', 'Nestled in a sprawling rubber estate,The Rubber Escape is a hidden gem located just a 30-minute drive away from the Melaka city centre. This peaceful, secluded nature retreat promises peace, relaxation, and a tinge of romance.\r\nDue to the small number of units at The Rubber Escape, guests get to enjoy privacy and lots of personal space - the rooms even come with private patios overlooking the rubber trees.', '', 189, 195, 141115),
(131, 'Hiking Experience at Mount Kinabalu', 'Rising like a pointy fang from the jungles of northern Borneo, Mt Kinabalu is Malaysia’s highest peak, and it', '', 180, 230, 151110),
(133, 'Fun Filled Kayaking Adventure in Kuching', 'Spend an active but relaxing day in nature on this kayaking day trip in Kuching. Your local guide will navigate you safely down the Sungai Sarawak Kiri River while pointing out the wide variety of tropical plant and flower species found here. Have plenty of swimming and photo stops, plus eat lunch in a local village. Kayaking is suitable for various experience levels, including kids over five.', '', 100, 239, 161111),
(134, 'Lebam River Kayaking Adventure', 'Experience the thrill of kayaking along the beautiful Lebam River in Johor. This adventure is perfect for nature enthusiasts and adventure seekers alike. As you paddle through the serene waters, you will be surrounded by lush mangroves and diverse wildlife. This experience is suitable for all levels, including beginners.', '', 150, 300, 161112),
(135, 'Little Amazon of Terengganu', 'The easiest way to experience the clear waters and abundance of animals along the banks of the Sungai Berang river is by kayak. As you travel down the river you may see monkeys, buffalo, eagles, hornbill, kingfishers, and cows. The Sungai Berang is classified as a class I river, and you will be fully guided, so you can fully relax and enjoy the beautiful environment.', '', 100, 217, 161113),
(136, 'Kayak Experience at Kota Kinabalu Sabah', 'Get onto a Kayak Board in Kota Kinabalu, and enjoy the beauty of Borneo at sunrise or sunset. Before you start, you’ll get a short briefing from our guide to make sure you can handle the equipment. Then off you go and enjoy kayaking with an awesome view. This is a group tour, so you might make some new friends as you go along. We provide land transfer within city area as well. So there will be a short travel time and also we will provide a place for y', '', 50, 110, 161114),
(1967, 'Hiking at Penang Hill', 'Take a break from the city attractions of Georgetown and turn to the abundance of nature available on the island of Penang. Affectionately known as Bukit Bendera by the locals, Penang Hill is the hill first colonial hill station developed in Peninsular Malaysia, but also a must-visit spot for nature lovers when in Penang.\r\nWith its highest point set 833m above Georgetown, Penang Hill offers amazing views of the city from the top, as well as a chilly c', '', 20, 25, 151111),
(1987, 'Broga Hill, Hiking', 'Bukit Broga Hill along the border of Negeri Sembilan and Selangor is a must-visit for outdoor lovers and avid hikers. This well-marked hiking spot sees droves of hikers in the morning, hoping to scale its three main peaks. The first two peaks, while shorter, offer unobstructed panoramas of the verdant valley landscapes, especially stunning at sunrise. If you\'re feeling up for it, make the ascent up the last and highest peak—it\'ll take only about an ho', '', 5, 10, 151115),
(2013, 'Bukit Beruang Forest Reserve', 'Bukit Beruang offers a challenging trail shared with mountain bikers. The route features multiple obstacles, frequent switchbacks, and steep ascents. However, the effort is worth it as you can take in the near 180-degree view at the Eye on Melaka lookout point. For those who seek an even better vantage point, some rock climbing can provide an alternative.\r\nAs you hike through Bukit Beruang, you will come across bamboo groves and some very large trees ', '', 10, 20, 151112),
(2015, 'Maxwell Hill, Bukit Larut', 'It is approximately 1250 m above sea level. Bukit Larut receives the highest rainfall in Malaysia because it is located in the wettest part of the country.\r\nWith daily temperatures of 10 to 25 degrees Celsius, Bukit Larut is indeed an ideal destination for those wanting to escape from the heat and humidity of Malaysia’s lowlands. Although it is the smallest hill compared to other hill resorts in the country, it preserves much more of the atmosphere of', '', 25, 30, 151113),
(2016, 'Gunung Tahan ', 'Let’s conquer the highest peak in Peninsular Malaysia, Gunung Tahan (2,187m). If you have courage to ascend and descend mountains, crossing rivers, long distance hiking and camping for nights, this might be one of your best experiences in life.\r\n\r\nGunung Tahan, is one of the most challenging mountains to climb. It’s about 32km from Kuala Juram, Sg Relau, Merapoh and 53km from Kampung Kuala Tahan. This trail requires you to be mentally and physically f', '', 40, 50, 151114),
(9064, ' Firefly Boat Tour with Roundtrip Transfer from Kuala Lumpur', 'Kuala Selangor is one of the world’s best places to see fireflies flashing in unison. This tour from Kuala Lumpur saves the hassle of traveling independently to see the phenomenon, with round-trip transport, a seafood dinner, plus time at the monkey-crowded Fort Altingsburg en route. The highlight is a boat ride along the Selangor River, glowing with the synchronized lights of thousands of fireflies.', '', 150, 299, 161116),
(9065, 'kayaking tengah bandar dan luar banda', 'kayak berdua dengan aweks jalilah', '', 50, 100, 161117);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(255) NOT NULL,
  `AdminEmail` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminEmail`, `AdminPassword`, `AdminName`) VALUES
(101, 'nina@adventure.com', 'nina123', 'Nina nom nom'),
(102, 'yasmin@adventure.com', 'yasmin123', 'Yasmin'),
(103, 'jalilah@adventure.com', 'jalilah123', 'Jalilah'),
(104, 'aisyah@adventure.com', 'aisyah123', 'Aisyah');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(255) NOT NULL,
  `ActivityName` varchar(100) NOT NULL,
  `ActivityPicture` varchar(255) NOT NULL,
  `PriceAdult` varchar(255) NOT NULL,
  `PriceChild` varchar(255) NOT NULL,
  `quantityAdult` int(50) NOT NULL,
  `quantityChild` int(50) NOT NULL,
  `CustEmail` varchar(255) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `cartDate` date DEFAULT NULL,
  `cartTime` time DEFAULT NULL,
  `cartStatus` enum('active','ordered') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `ActivityName`, `ActivityPicture`, `PriceAdult`, `PriceChild`, `quantityAdult`, `quantityChild`, `CustEmail`, `paymentID`, `cartDate`, `cartTime`, `cartStatus`) VALUES
(54, 'Pulau Sipadan Private Snorkeling Experience in Sabah', 'sipadan snor.jpeg', '286', '270', 1, 1, 'K@gmail.com', 19, '2024-06-29', '09:25:00', 'ordered'),
(55, 'Hiking at Penang Hill', 'Penang Hill, George Town.jpg', '25', '20', 1, 1, 'K@gmail.com', 20, '2024-07-04', '12:00:00', 'ordered'),
(56, 'kayaking tengah bandar dan luar banda', 'pixlr-image-generator-e42e0b8f-d18d-48f8-b85a-74009340e2b4.png', '1000', '900', 1, 0, 'min@gmail.com', 21, '2024-06-30', '13:36:00', 'ordered'),
(57, 'Tun Sakaran Marine Park Island Hopping Tour', 'sakaran.jpg', '250', '210', 1, 1, 'min@gmail.com', 22, '2024-07-04', '15:38:00', 'ordered'),
(58, 'Broga Hill, Hiking', 'broga hill kl.jpg', '10', '5', 1, 0, 'min@gmail.com', 23, '2024-06-30', '17:38:00', 'ordered'),
(59, 'Glamping Experience at Gopeng Glamping Park', 'gopeng.jpg', '210', '180', 2, 1, 'min@gmail.com', 24, '2024-07-06', '17:00:00', 'ordered'),
(60, 'Fun Filled Kayaking Adventure in Kuching', 'kayak_kucing.jpg', '239', '100', 1, 2, 'min@gmail.com', 25, '2024-08-07', '08:11:00', 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustID` int(255) NOT NULL,
  `CustEmail` varchar(255) NOT NULL,
  `CustNoPhone` varchar(255) NOT NULL,
  `CustPassword` varchar(255) NOT NULL,
  `CustName` varchar(255) NOT NULL,
  `CustPic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustID`, `CustEmail`, `CustNoPhone`, `CustPassword`, `CustName`, `CustPic`) VALUES
(7, 'K@gmail.com', '01789546320', '$2y$10$3X/2iKOqSyTyLlZX55SgYuuzDU5nQAcRVeNvAfLSS9f8USOmETUOu', 'Katheryn', 'Screenshot (255).png'),
(8, 'min@gmail.com', '0117853625', '$2y$10$7SeVwIX26pz/sVJjfMCys.e5mIaIcWjb1BRyE0GJKw1C0obVD/6Wq', 'min', 'Screenshot (241).png');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationID` int(255) NOT NULL,
  `SportType` varchar(255) NOT NULL,
  `LocationName` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `SportType`, `LocationName`, `pic`) VALUES
(121110, 'Snorkelling', 'Tunku Abdul Rahman Marine Park, Sabah', 'Tunku Abdul Rahman Island snorkeling.jpg'),
(121111, 'Snorkelling', 'Pulau Redang, Terengganu', 'redang snorkeling.jpg'),
(121112, 'Snorkelling', 'Pulau Tioman, Pahang', 'snor Tioman.jpg'),
(121113, 'Snorkelling', 'Pulau Rawa, Johor', 'Snorkelling-At-Rawa-Island.jpg'),
(121114, 'Snorkelling', 'Pulau Langkawi, Kedah', 'langkawi snorkeling.jpg'),
(121115, 'Snorkelling', 'Pulau Sipadan, Sabah', 'sipadan snor.jpeg'),
(121116, 'Snorkelling', 'Pulau Mabul, Sabah', 'mabul snor (1).jpg'),
(121117, 'Snorkelling', 'Tun Sakaran Marine Park, Sabah', 'sakaran.jpg'),
(121118, 'Snorkelling', 'Pulau Perhentian, Terengganu\r\n', 'perhentian snor (1).jpeg'),
(121119, 'Snorkelling', 'Pulau Kapas, Terengganu', 'Pulau-Kapas-Snorkeling.jpg'),
(131110, 'Wildlife Tour', 'Beaufort, Sabah', 'wildlife tour.jpg'),
(131111, 'Wildlife Tour', 'Langkawi', 'WildlifeTour_Langkawi.jpg'),
(131112, 'Wildlife Tour', 'Kuala Lumpur', 'fireflies kl.jpg'),
(141110, 'Camping & Glamping', 'Janda Baik, Pahang\r\n', 'tiarasa.jpg'),
(141111, 'Camping & Glamping', 'Cameron Highlands, Pahang', 'cameron.jpg'),
(141112, 'Camping & Glamping', 'Gopeng, Perak', 'gopeng.jpg'),
(141113, 'Camping & Glamping', 'Selangor', 'sunway camping.jpg'),
(141114, 'Camping & Glamping', 'Batang Kali, Selangor', 'dusunBonda.jpg'),
(141115, 'Camping & Glamping', 'Melaka', 'the-rubber-escape.jpg'),
(151110, 'Hiking', 'Mount Kinabalu, Sabah', 'kinabalu.jpg'),
(151111, 'Hiking', 'Penang Hill, George Town', 'Penang Hill, George Town.jpg'),
(151112, 'Hiking', 'Bukit Beruang, Melaka', 'beruang.jpg'),
(151113, 'Hiking', 'Bukit Larut, Taiping', 'bukit larut taiping.jpg'),
(151114, 'Hiking', 'Gunung Tahan, Taman Negara National Park', 'taman-negara-park.jpg'),
(151115, 'Hiking', 'Broga Hill, Kuala Lumpur', 'broga hill kl.jpg'),
(161111, 'kayaking', 'Kuching', 'kayak_kucing.jpg'),
(161112, 'kayaking', 'Sungai Lebam, Johor', 'lebamKayak.jpg'),
(161113, 'kayaking', 'Terengganu', 'amazonTerengganu.jpg'),
(161114, 'kayaking', 'Kota Kinabalu', 'kayakKotaKinabalu.jpg'),
(161116, 'Wildlife Tour', 'Kuala Selangor ', 'Firefly.jpg'),
(161117, 'kayaking', 'bukit bintang', 'pixlr-image-generator-e42e0b8f-d18d-48f8-b85a-74009340e2b4.png');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderID` int(255) NOT NULL,
  `orderDate` datetime NOT NULL,
  `orderStatus` varchar(255) NOT NULL,
  `totalAmount` int(255) NOT NULL,
  `custEmail` varchar(255) NOT NULL,
  `paymentID` int(255) NOT NULL,
  `cartID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderID`, `orderDate`, `orderStatus`, `totalAmount`, `custEmail`, `paymentID`, `cartID`) VALUES
(21, '2024-06-29 00:00:00', 'Completed', 556, 'K@gmail.com', 19, 54),
(22, '2024-06-29 00:00:00', 'Completed', 45, 'K@gmail.com', 20, 55),
(23, '2024-06-30 00:00:00', 'Pending', 1000, 'min@gmail.com', 21, 56),
(24, '2024-06-30 00:00:00', 'Pending', 460, 'min@gmail.com', 22, 57),
(25, '2024-06-30 00:00:00', 'Pending', 10, 'min@gmail.com', 23, 58),
(26, '2024-06-30 00:00:00', 'Pending', 600, 'min@gmail.com', 24, 59),
(27, '2024-06-30 00:00:00', 'Pending', 439, 'min@gmail.com', 25, 60);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `paymentStatus` varchar(255) NOT NULL,
  `custEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentMethod`, `paymentStatus`, `custEmail`) VALUES
(2, 'cash on delivery', 'pending', 'aminah@gmail.com'),
(3, 'credit card', 'pending', 'neynaly04@gmail.com'),
(8, 'credit card', 'success', 'Alice@gmail.com'),
(9, 'Touch n Go', 'success', 'Alice@gmail.com'),
(10, 'credit card', 'success', 'Alice@gmail.com'),
(12, 'Touch n Go', 'success', 'Alice@gmail.com'),
(13, 'Touch n Go', 'success', 'Alice@gmail.com'),
(14, 'Touch n Go', 'success', 'Alice@gmail.com'),
(15, 'credit card', 'success', 'Alice@gmail.com'),
(19, 'paypal', 'pending', 'K@gmail.com'),
(20, 'credit card', 'success', 'K@gmail.com'),
(21, 'paypal', 'pending', 'min@gmail.com'),
(22, 'Touch n Go', 'success', 'min@gmail.com'),
(23, 'Touch n Go', 'success', 'min@gmail.com'),
(24, 'Touch n Go', 'success', 'min@gmail.com'),
(25, 'Touch n Go', 'success', 'min@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL,
  `ReviewText` text DEFAULT NULL,
  `ReviewDateTime` datetime DEFAULT NULL,
  `ReviewRating` int(11) DEFAULT NULL,
  `CustEmail` varchar(255) DEFAULT NULL,
  `ActivityName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `ReviewText`, `ReviewDateTime`, `ReviewRating`, `CustEmail`, `ActivityName`) VALUES
(12, 'I LOVE HIKING HERE! THE TRACK IS EASY AND THE WORKER ARE SO HELPFUL', '2024-06-29 21:59:20', 5, 'K@gmail.com', 'Hiking at Penang Hill'),
(13, 'It\\\'s enjoyable and the scenery is what i paid for!', '2024-06-29 22:02:02', 3, 'K@gmail.com', 'Pulau Sipadan Private Snorkeling Experience in Sabah'),
(14, 'SAYA SUKA', '2024-06-30 13:39:14', 3, 'min@gmail.com', 'Broga Hill, Hiking');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`ActivityID`),
  ADD KEY `Location_ID` (`LocationID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `ForeignKey` (`custEmail`,`paymentID`,`cartID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `ActivityID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9066;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LocationID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161118;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `Location_ID` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 04:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `officeware`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `link_id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`link_id`, `title`, `href`) VALUES
(1, 'Manage products', 'admin-products.php'),
(2, 'Manage users', 'admin-users.php'),
(3, 'Manage messages', 'admin-messages.php'),
(4, 'Manage poll', 'admin-poll.php');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Pilot'),
(2, 'Pentel'),
(3, 'Lorell'),
(4, 'CEP'),
(5, 'Westcott'),
(6, 'Business Source'),
(7, 'COSCO'),
(8, 'Stanley'),
(9, 'Mead'),
(10, 'Office Depot'),
(11, 'Quality Park'),
(12, 'Just Basics'),
(14, 'Kantek'),
(16, 'BIC');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `user_id`, `quantity`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Pens & Pencils'),
(2, 'Pencil Holders'),
(3, 'Scissors, Rulers, Paper Trimmers'),
(4, 'Envelopes'),
(5, 'Copy Papers'),
(6, 'Notebooks, Pads');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`) VALUES
(1, 'Colorful'),
(2, 'Black'),
(3, 'Blue'),
(4, 'Silver'),
(5, 'Yellow'),
(6, 'White'),
(9, 'Green');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sender_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message_text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_name`, `sender_email`, `message_text`, `date_sent`) VALUES
(4, 'Website Administrator', 'admin@officeware.epizy.com', 'Ovo je probna poruka. Pojavice se u inboxu administratora.', '2021-03-09 11:46:34'),
(6, 'Mihailo Ilic', 'mihailoilic122@gmail.com', 'This is a test message.  This is a test message.  This is a test message.  This is a test message.  ', '2021-03-09 11:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `link_id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`link_id`, `title`, `href`) VALUES
(1, 'Home', 'index.php'),
(2, 'Shop', 'shop.php'),
(3, 'Contact', 'contact.php'),
(5, 'Author', 'author.php');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `choice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`choice_id`, `user_id`) VALUES
(1, 3),
(3, 5),
(3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `poll_choices`
--

CREATE TABLE `poll_choices` (
  `choice_id` int(11) NOT NULL,
  `choice_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `poll_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_choices`
--

INSERT INTO `poll_choices` (`choice_id`, `choice_title`, `poll_id`) VALUES
(1, 'Pens', NULL),
(2, 'Pencils', NULL),
(3, 'Mechanical pencils', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` decimal(10,3) NOT NULL,
  `package_size` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_price`, `package_size`, `product_image`, `category_id`, `brand_id`, `color_id`) VALUES
(1, 'Pilot G2 Premium Retractable Gel Pen, 0.5mm, Blue', 'Pilot G2 Premium Retractable Gel Pen, 0.5mm, Blue Ink, Smoke Barrel, Dozen - G2 retractable pen contains water-resistant, smearproof gel ink that offers exceedingly smooth writing. Retractable design means no cap to lose. Contoured, latex-free rubber grip provides writing comfort. G2 writes longer than the average of the top branded gel ink pens. Refillable.', '13.990', '12 pens', 'Pilot-G2-blue.jpg', 1, 1, 3),
(2, 'Pilot G2 Premium Retractable Gel Pen, 0.7mm, Black', 'Pilot G2 Premium Retractable Gel Pen, 0.7mm, Black Ink, Smoke Barrel, Dozen - One of the best-selling rollerball pens available, the Pilot G2 Retractable Pen uses a smearproof gel ink that is water-resistant, allowing for incredibly smooth writing. The gel pen has a rubber grip that is latex-free and provides comfort while writing. .7 mm fine point tip is refillable and the Pilot G2 is retractable so there is no cap to lose.', '13.990', '12 pens', 'Pilot-G2-black.jpg', 1, 1, 2),
(3, 'Pentel EnerGel RTX Liquid Gel Blue Pens 0.7mm', 'Pentel EnerGel RTX Liquid Gel Pens - EnerGel Liquid Gel Pen delivers the ultimate writing experience with a stainless steel tip and super-smooth blend of liquid and gel inks that glide across paper. 0.7mm medium metal tip conveniently retracts to protect pockets and purses. Latex-free grip delivers maximum comfort and control, and the stainless steel accents offer a professional look. Refill with Pentel LR7 or any EnerGel refill.', '21.990', '12 pens', 'pentel-energel-blue.jpg', 1, 2, 3),
(4, 'Pentel EnerGel RTX Retractable Liquid Gel Colorful Pens 0.7mm', 'Pentel EnerGel RTX Retractable Liquid Gel Pens, Medium Point, 0.7 mm, 54% Recycled, Silver Barrel, Assorted Ink Colors, Pack Of 6 Pens - Liquid gel ink dries quickly and writes smoothly, so these EnerGel RTX pens are great for busy offices. The Pentel pens provide a dependable writing utensil with a latex-free grip for comfort and control.', '11.990', '6 pens', 'pentel-energel-colorful.jpg', 1, 2, 1),
(5, 'Pilot FriXion Clicker Ball Erasable Colorful Gel Pens 0.7mm', 'Pilot FriXion Clicker Ball Erasable Gel Pens, Fine Point, 0.7 mm, Assorted Barrel Colors, Assorted Ink Colors, Pack Of 8 Pens - Never write a mistake again – retractable, erasable gel ink pen that allows you to write, erase and rewrite repeatedly without damaging documents. FriXion\'s unique thermo-sensitive ink is formulated to deliver both vibrant color and smooth writing. Great for editing, lists, scheduling and so much more! Now your writing can be stress free and mistake free.', '19.990', '8 pens', 'Pilot-frixion-colorful.jpg', 1, 1, 1),
(6, 'Pilot FriXion Clicker Erasable Retractable Blue Gel  Pens 0.7mm', 'Pilot FriXion Clicker Erasable Retractable Gel Pen, Fine 0.7mm, Blue Ink, Blue Barrel - FriXion Clicker combines the convenience of a retractable with amazing erasable gel ink. Pilot® FriXion gel ink pens allow you to write, erase and rewrite without damaging documents or leaving behind messy eraser crumbs. The unique, thermo-sensitive gel ink formula offers vibrant color and smooth writing. Great for editing documents, creating lists, scheduling, proofing and so much more!', '19.990', '12 pens', 'Pilot-frixion-blue.jpg', 1, 1, 3),
(21, 'Lorell Black Mesh/Wire Pencil Cup Holder', 'Lorell Black Mesh/Wire Pencil Cup Holder - Pencil cup holder offers an elegant way to keep your writing utensils handy. Steel mesh features double-rimmed, smooth edges and a powder-coat finish. Pencil cub holder is recyclable.', '6.990', '1 item', '16151645412624.jpg', 2, 3, 2),
(22, 'Kantek Acrylic Pencil Cup Clear', 'Kantek Acrylic Pencil Cup, 2 3/4 x 2 3/4 x 4, Clear - Acrylic Pen Cup. Enhance your desk and work space with this elegant acrylic desk series. Attractive classic design improves productivity and organization with style.', '8.990', '1 item', '16151647031985.jpg', 2, 14, 1),
(23, 'CEP Large Pencil Cup White', 'CEP Large Pencil Cup - Contemporary pencil cup features two compartments that keep your items separated and positioned vertically for space-saving organization. Its large capacity design holds up to 32 standard pens or pencils to help you keep more of your writing utensils readily available. Shock-resistant polystyrene withstands minor mishaps and daily use for long-lasting use. Pencil cup is perfect for keeping pens, pencils, scissors, highlighters and more.', '5.990', '1 item', '16151648018357.jpg', 2, 4, 6),
(32, 'Westcott All-Purpose Value Stainless Steel Scissors', 'Westcott All-Purpose Value Stainless Steel Scissors, 8-inch, Bent, Black - Ideal for light daily use in the home or office, these Westcott scissors deliver the smooth cutting performance you need. Stainless-steel blades slice through paper and other media.', '4.990', '1 item', '16153133340249.jpg', 3, 5, 2),
(33, 'Westcott Titanium Bonded Non-Stick Scissors, Pack Of 2', 'Westcott Titanium Bonded Non-Stick Scissors, 8-inch, Pointed, Gray/Yellow, Pack Of 2 - Westcott Titanium Bonded Non-Stick blades are six times longer lasting than the previous formula. Glide provides a no tool adjustable glide technology for optimal cutting performance. These scissors will stay sharp, smooth-cutting and residue-free for years making them an exceptional value like all Westcott products.', '9.990', '2 items', '16153136278678.jpg', 3, 5, 5),
(34, 'Business Source 12-inch Stainless Steel Ruler', 'Business Source 12-inch Stainless Steel Ruler - Back To School! Nonskid ruler is made of stainless steel. Ruler is ruled in 1/16 on one bevel and 1/32 in the first and last inch. The opposite bevel has metric measurements. All markings and numbers are engraved in black. Ruler has a nonskid cork backing.', '5.990', '1 item', '16153138655407.jpg', 3, 6, 4),
(35, 'COSCO Easycut Cutter Knife Black', 'COSCO Easycut Cutter Knife w/Self-Retracting Safety-Tipped Blade, Black/Blue - Safety-tipped blade retracts automatically upon release of handle. Unique adjustable dial allows different blade cutting lengths, ensuring the blade isn\\\'t too far out. Prevents cutting interior items in package. Handle features retractable edge guides for cutting box tops as well as a blade storage compartment. Includes three replacement blades.', '10.990', '1 item', '16153139463988.jpg', 3, 7, 2),
(36, 'Stanley Straight Handle Knife w/Retractable 13 Point Snap-Off Blade', 'Stanley Straight Handle Knife w/Retractable 13 Point Snap-Off Blade, Yellow/Gray - Quick Point Pocket Knife is manufactured from reinforced plastic. Uses 11-300 blades.', '3.990', '1 item', '16153139743769.jpg', 3, 8, 5),
(37, 'Mead Press-it Seal-it No. 10 Security Envelopes', 'Mead Press-it Seal-it No. 10 Security Envelopes, #10 (4.13 x 9.50), Peel & Seal, 45 Envelopes/ Box - Mail documents you need to keep private in these No. 10 security envelopes with a lining to shield your information. Press-it Seal-it, self-adhesive closure makes sealing the envelopes easy. Simply peel the strip, and the envelope instantly seals with no licking.', '2.990', '45 envelopes', '16153140946492.jpg', 4, 9, 6),
(38, 'Office DEPOT Invitation Envelopes, A2, Pack Of 100 White', 'Invitation Envelopes, A2, 4 3/8 x 5 3/4, White, Pack Of 100 - Ideal for computer-generated invitations and announcements.', '6.990', '100 envelopes', '16153141554548.jpg', 4, 10, 6),
(39, 'Quality Park Redi-Strip Catalog Envelope, #10 Kraft', 'Quality Park Redi-Strip Catalog Envelope, #10 1/2, Cheese Blade Flap, Redi-Strip Closure, 9 x 12, Brown Kraft, 100/Box - Removable strip provides a clean, quick seal immediately upon contact without the use of moisture. Paper strip keeps adhesive free of dust, assuring a long shelf life.', '19.990', '100 envelopes', '16153142265082.jpg', 4, 11, 5),
(40, 'Just Basics Paper, Letter Size, Ream Of 500 Sheets, Case Of 8 Reams', 'Just Basics Paper, Letter Size (8 1/2 x 11), 92 (U.S.) Brightness, 20 Lb, Ream Of 500 Sheets, Case Of 8 Reams - Create marketing materials, reports and other business essentials with Just Basics paper. The bright finish helps your text and graphics appear vibrant for an eye-catching look.', '39.990', '8 reams', '16153142725404.jpg', 5, 12, 6),
(41, 'Just Basics Paper, Letter Size, Ream Of 500 Sheets, Case Of 3 Reams', 'Just Basics Paper, Letter Size (8 1/2 x 11), 92 (U.S.) Brightness, 20 Lb, Ream Of 500 Sheets, Case Of 3 Reams - Create marketing materials, reports and other business essentials with Just Basics paper. The bright finish helps your text and graphics appear vibrant for an eye-catching look.', '18.990', '3 reams', '16153143349427.jpg', 5, 12, 6),
(42, 'Business Source 3x3 Adhesive Note Pads Colorful', 'Business Source 3 x 3 Adhesive Note Pads - Repositionable notes stay firmly in place. Apply and reapply. Self-adhesive notepads use solvent-free adhesive. Each pad includes 100 pastel sheets.', '3.990', '12 pads', '16153144435958.jpg', 6, 6, 1),
(43, 'Just Basics Wirebound Notebook, 3-Hole Punched', 'Just Basics Wirebound Notebook, 3-Hole Punched, 8 x 10 1/2, 1 Subject, College Ruled, 70 Sheets, Assorted Colors, Pack Of 6 - Great for all of your office or classroom needs', '9.990', '6 notebooks', '16153144995297.jpg', 6, 12, 1),
(44, 'Office Depot Perforated Writing Pads White', 'Perforated Writing Pads, 8-1/2 x 11-3/4, Legal Ruled, 50 Sheets, White, Pack Of 12 Pads - Jot down notes, to-do lists, homework and more on Office Depot Brand perforated writing pads. Office Depot perforated writing pads are ruled with 50 sheets to a pad and come in packs of multiple pads, so you will always have enough note paper.', '9.990', '12 pads', '16153145402074.jpg', 6, 10, 6),
(45, 'Office Depot Perforated Writing Pads Canary', 'Perforated Writing Pads, 8-1/2 x 11-3/4, Legal Ruled, 50 Sheets, Canary, Pack Of 12 Pads - Jot down notes, to-do lists, homework and more on Office Depot Brand perforated writing pads. Office Depot perforated writing pads are ruled with 50 sheets to a pad and come in packs of multiple pads, so you will always have enough note paper.', '9.990', '12 pads', '16153146032539.jpg', 6, 10, 5),
(46, 'Pentel EnerGel RTX Retractable Gel Pen, 0.7mm, Blue Ink', 'Pentel EnerGel RTX Retractable Gel Pen, 0.7mm, Blue Ink, White/Blue Barrel - The best qualities of liquid and gel ink are blended into a super-smooth ink and delivered via an exclusive ink/tip technology for the smoothest write. Vivid, acid-free ink dries quickly without smearing or blotting and is great for left-handed writers. Retractable.', '2.490', '1 pen', '16153149331575.jpg', 1, 2, 3),
(47, 'Pentel EnerGel RTX Retractable Gel Pen 0.7mm, Green Ink', 'Pentel EnerGel RTX Retractable Gel Pen, Medium 0.7mm, Green Ink, Green/Gray Barrel - The best qualities of liquid and gel ink are blended into a super-smooth ink and delivered via an exclusive ink/tip technology for the smoothest write. Vivid, acid-free ink dries quickly without smearing or blotting and is great for left-handed writers. Retractable to protect pockets and purses.', '2.490', '1 pen', '16153149975168.jpg', 1, 2, 9),
(48, 'BIC Xtra Precision 0.7 Mechanical Pencils', 'BIC Xtra Precision 0.7 Mechanical Pencils - Environmentally conscious mechanical pencil provides durable #2 leads, for high-performance equal to 2 1/2 woodcase pencils. Smooth, streamlined barrel provides solid grip and consistent markings. Soft erasure won\\\'t smudge or tear documents. Ideal for schools, office or home use.', '8.990', '24 pencils', '16153153921086.jpg', 1, 16, 1),
(49, 'BIC Velocity 0.9 Mechanical Pencils', 'BIC Velocity 0.9 Mechanical Pencils - Velocity Pencil features a sliding sleeve over the tip to prevent lead from breaking, a top advance lead mechanism, and a sleek barrel. Smooth opaque rubber grip provides comfort and control while writing. Mechanical pencil has a high-quality eraser, conical retractable lead and three tough leads. Eraser end with a cap keeps eraser clean. Refillable.', '7.990', '5 pencils', '1615315450587.jpg', 1, 16, 1),
(50, 'Business Source #2 Wood Pencils', 'Business Source #2 Wood Pencils - Wood-case No. 2 pencils feature a rounded, hexagonal shape for easy writing. The nonlead painted case is yellow and has a brass ferrule. Each HB pencil has an eraser on the tip to erase your mistakes. Latex-free eraser is smudge-resistant for clean erasing.', '1.990', '12 pencils', '1615315638025.jpg', 1, 6, 5),
(51, 'BIC Pencils Xtra Fun, HB (#2), Assorted Barrel Colors, 8/Pack', 'BIC #2 Pencil Xtra Fun, HB (#2), Black Lead, Assorted Barrel Colors, 8/Pack - #2 lead pencils in two-toned color barrels that make writing fun! They feature ultra-solid, break-resistant leads and are easy to erase with latex-free erasers. Durable with long-lasting leads and erasers. Sharpens First Time, Every Time™.', '4.990', '8 pencils', '16153157501462.jpg', 1, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` tinyint(4) NOT NULL,
  `role_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'User'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `image_id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`image_id`, `title`, `filename`) VALUES
(1, 'Slider Image 1', 'slider-1.jpg'),
(2, 'Slider Image 2', 'slider-2.jpg'),
(3, 'Slider Image 3', 'slider-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `date_created`, `role_id`) VALUES
(1, 'admin', 'bf48f2f7cb50764856c0b171995c625e', 'admin@officeware.epizy.com', 'Website Administrator', '2021-03-06 18:00:42', 2),
(3, 'mihailoilic', '02dc6f53318fde5b02733e40b4b421b3', 'mihailoilic121@gmail.com', 'Mihailo Ilic', '2021-03-06 17:59:04', 1),
(5, 'noviuser', '42f749ade7f9e195bf475f37a44cafcb', 'noviuser@gmail.com', 'Novi User', '2021-03-06 19:48:56', 1),
(8, 'user', '40f5d0b0e3b4fc8347d43f474fd26487', 'test.user1@gmail.com', 'Website Test User', '2021-03-08 21:51:07', 1),
(9, 'markknight', 'b38ac18016d255ee4e9a364fb6490ebf', 'markknight@gmail.com', 'Mark Knight', '2021-03-09 01:33:37', 1),
(12, 'sylvanas', '9780425a23bcf35fa88e4621ab1a4e9f', 'silvana@mail.com', 'Sylvanas Windrunner', '2021-03-09 18:01:59', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `cart_ibfk_1` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`choice_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `poll_choices`
--
ALTER TABLE `poll_choices`
  ADD PRIMARY KEY (`choice_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Unique username` (`username`),
  ADD UNIQUE KEY `Unique email` (`email`) USING BTREE,
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `poll_choices`
--
ALTER TABLE `poll_choices`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD CONSTRAINT `poll_answers_ibfk_1` FOREIGN KEY (`choice_id`) REFERENCES `poll_choices` (`choice_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poll_answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

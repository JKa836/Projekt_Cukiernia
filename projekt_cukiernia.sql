-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Cze 2023, 20:01
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_cukiernia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`ID`, `Nazwa`) VALUES
(1, 'Ciasta czekoladowe'),
(2, 'Ciasta tradycyjne'),
(3, 'Ciasta sezonowe'),
(4, 'Ciasta bezglutenowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `Imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Haslo` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`ID`, `Imie`, `Nazwisko`, `Email`, `Haslo`) VALUES
(1, 'Adam', 'Nowak', 'adamnowak@poczta.pl', '$2y$10$66M27j0eTbC0zB4naLMXZuuL4q8bP7FmI0ExoLZzh3HARmyyZX/Cu'),
(2, 'Ania', 'Kowal', 'akowal@poczta.pl', '$2y$10$nAJfDUyWwtck1bDvg56Rt./in5o.BN4chZu/r8YbDWPa5KKWTSILm'),
(3, 'Tomasz', 'Kot', 'tkot@poczta.pl', '$2y$10$XG5H0MitJXtT8OR/DgkCGetNTWk2ReR2ZXoahEwgXRIQFQKa3Vnhe'),
(4, 'Adam', 'Kot', 'akot@poczta.pl', '$2y$10$jA1XVTWDISJ5cQVxdp9lEOacJ3YqInMMlU9vOznOqucg9OzGlkfD.'),
(5, 'Kamil', 'Sus', 'ksus@poczta.pl', '$2y$10$yTiWhOsVcua5XexmbmDQMe9CxOPEJLPz7IDpMNE2U7D2QlwU7AEzO'),
(6, 'Taylor', 'Swift', 'tswift@poczta.pl', '$2y$10$r6Zy2IOjx3YvmVj/4kqCPuDL5hB0wlAI0UDXO8D4/EGm7ONWXc1bC'),
(7, 'Lana', 'Rej', 'lrej@poczta.pl', '$2y$10$Q//01H5hg5Uw0wMFHbejjOudWIO.a8bE4YI4OxHlElreiNHPPr3Ly'),
(8, 'Król', 'Lew', 'klew@poczta.pl', '$2y$10$6q7FOy4hVU7XEwIZZwooBumxJz7x4i/V2sibKzlFRepVLM3xSK8na'),
(9, 'Piotr', 'Koza', 'pkoza@poczta.pl', '$2y$10$YG3xgrdXGzIta5JH5EG2cu97GRPC5KuFIPngnZeEWjnz6vQzKa/eS'),
(10, 'Gustaw', 'Sikora', 'gsikora@poczta.pl', '$2y$10$csK50elvbBEoD/sxMse/3eUNQ0Yy0/uvno58elft0jt9fHVDMAxQm'),
(11, 'Martyna', 'Nowak', 'mnowak@poczta.pl', '$2y$10$CFgapRVZJbcy/urzjBU8Du63TbEaGbQm7RGyYUgrNZj6E0xzBogtC'),
(12, 'Alina', 'Jagoda', 'ajagoda@poczta.pl', '$2y$10$Zej/QnrSEZ/IkPWNREHD9u7M1dwCfnEWfVEMs2xR888thwBvRpKE6'),
(13, 'Karolina', 'Doniczka', 'kdoniczka@poczta.pl', '$2y$10$53SIRFXWMkjs3tEdnZKHr.7ls61j4G6YfHNHJqD2zkntnhLknklJi'),
(14, 'Tomasz', 'Zabek', 'tzabek@poczta.pl', '$2y$10$3WjJYsGThgM2kRTIIuzzgumPUHATSRDkgMmzrOKI0fxQrdbTIqpJC'),
(15, 'Janusz', 'Kubek', 'jkubek@poczta.pl', '$2y$10$LRaldOXjKbfPo8AtC7wta.v92aojkxxsqs2zZfbLZ5yNDHNx/.Kr6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employees`
--

CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `Imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Haslo` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `employees`
--

INSERT INTO `employees` (`ID`, `Imie`, `Nazwisko`, `Email`, `Haslo`) VALUES
(1, 'Jan', 'Test', 'jantest@poczta.pl', '$2y$10$2UFRWLdTlfR3rJiBRL6NUONxuVy1M/fKzY13ExUCz4FY/9E8YEUV.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orderdetails`
--

CREATE TABLE `orderdetails` (
  `ID` int(11) NOT NULL,
  `ZamowienieID` int(11) NOT NULL,
  `ProduktID` int(11) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `Cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orderdetails`
--

INSERT INTO `orderdetails` (`ID`, `ZamowienieID`, `ProduktID`, `Ilosc`, `Cena`) VALUES
(3, 1, 1, 1, '50.00'),
(4, 1, 5, 1, '45.00'),
(5, 2, 1, 1, '50.00'),
(6, 3, 2, 1, '54.00'),
(7, 4, 5, 1, '45.00'),
(8, 4, 4, 1, '49.00'),
(9, 5, 5, 1, '45.00'),
(10, 5, 4, 1, '49.00'),
(11, 6, 5, 1, '45.00'),
(12, 6, 9, 1, '57.00'),
(13, 7, 8, 1, '59.00'),
(14, 7, 6, 1, '55.00'),
(15, 7, 11, 1, '45.00'),
(16, 8, 7, 1, '7.00'),
(17, 9, 1, 1, '50.00'),
(18, 9, 2, 1, '54.00'),
(19, 10, 15, 1, '42.00'),
(20, 10, 4, 1, '49.00'),
(21, 10, 9, 1, '57.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `KlientID` int(11) NOT NULL,
  `DataZamowienia` datetime NOT NULL,
  `Cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`ID`, `KlientID`, `DataZamowienia`, `Cena`) VALUES
(1, 9, '2023-06-04 02:06:53', '0.00'),
(2, 9, '2023-06-04 02:10:11', '0.00'),
(3, 9, '2023-06-04 02:13:06', '0.00'),
(4, 10, '2023-06-04 19:27:16', '0.00'),
(5, 11, '2023-06-04 19:35:07', '0.00'),
(6, 13, '2023-06-04 19:49:23', '0.00'),
(7, 9, '2023-06-07 22:11:16', '0.00'),
(8, 9, '2023-06-09 01:08:50', '0.00'),
(9, 9, '2023-06-10 01:11:31', '0.00'),
(10, 15, '2023-06-11 18:53:36', '0.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `productcategories`
--

CREATE TABLE `productcategories` (
  `ID` int(11) NOT NULL,
  `ProduktID` int(11) NOT NULL,
  `KategoriaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `productcategories`
--

INSERT INTO `productcategories` (`ID`, `ProduktID`, `KategoriaID`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 3),
(9, 9, 3),
(10, 10, 3),
(11, 11, 4),
(12, 12, 4),
(13, 13, 4),
(14, 14, 4),
(15, 15, 3),
(16, 16, 1),
(26, 26, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `productreviews`
--

CREATE TABLE `productreviews` (
  `ID` int(11) NOT NULL,
  `ProduktID` int(11) NOT NULL,
  `KlientID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `productreviews`
--

INSERT INTO `productreviews` (`ID`, `ProduktID`, `KlientID`, `Rating`) VALUES
(1, 1, 9, 5),
(2, 2, 9, 4),
(3, 1, 11, 3),
(4, 8, 9, 3),
(5, 13, 9, 4),
(6, 4, 9, 5),
(7, 7, 9, 5),
(8, 10, 9, 3),
(9, 9, 9, 4),
(10, 2, 5, 3),
(11, 9, 5, 3),
(12, 3, 5, 3),
(13, 11, 5, 1),
(14, 6, 6, 4),
(15, 10, 6, 5),
(16, 12, 6, 4),
(17, 15, 15, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Opis` text COLLATE utf8_polish_ci NOT NULL,
  `Cena` decimal(10,2) NOT NULL,
  `Zdjecie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`ID`, `Nazwa`, `Opis`, `Cena`, `Zdjecie`, `Ilosc`) VALUES
(1, 'Sernik tradycyjny', 'Sernik tradycyjny to klasyczne ciasto cukiernicze, które cieszy się dużą popularnością ze względu na swój niepowtarzalny smak i konsystencję. Jest to delikatne i puszyste ciasto serowe, które składa się z kilku warstw.\r\n\r\nPodstawowym składnikiem sernika tradycyjnego jest twaróg, który nadaje mu charakterystyczną konsystencję i lekko kwaskowy smak. Twaróg jest starannie przetarty lub zmiksowany, aby uzyskać gładką masę bez grudek. Dodatkowo, do ciasta dodaje się jajka, cukier, mąkę i zazwyczaj odrobinę mleka, które pomagają nadając ciastu odpowiednią strukturę i słodycz.\r\n\r\nSernik tradycyjny ma charakterystyczne kruche, spodnie ciasto na spodzie, które stanowi bazę dla reszty ciasta. Często spód jest wykonany z ciasta kruchego lub herbatników, które dodają mu dodatkowej tekstury i smaku. Następnie, na spodzie umieszczana jest warstwa masy serowej. Ta warstwa jest gładka, kremowa i lekko wilgotna. Może mieć delikatny aromat wanilii lub cytryny, który dodaje subtelności i świeżości smakowej.\r\n\r\nSernik tradycyjny jest pieczony w umiarkowanie niskiej temperaturze, aby zapewnić równomierne i delikatne wypieczenie. Po upieczeniu ciasto powinno być puszyste, a wierzch delikatnie zrumieniony. Po ostudzeniu, sernik tradycyjny często jest dekorowany delikatnymi wiórkami czekolady, śmietaną lub owocami, które dodają mu estetycznego wyglądu i dodatkowego smaku.\r\n\r\nSernik tradycyjny ma unikalny, kremowy smak, który jest równocześnie lekko słodki i łagodnie kwaśny. Jego tekstura jest delikatna i jedwabista, co sprawia, że rozpływa się w ustach. To klasyczne ciasto cukiernicze, które zaspokaja pragnienie miłośników deserów i jest idealne zarówno na codzienne przyjemności, jak i na wyjątkowe okazje.', '50.00', 'https://www.kwestiasmaku.com/sites/v123.kwestiasmaku.com/files/sernik_tradycyjny_01.jpg', 9),
(2, 'Makowiec', 'Makowiec to wyjątkowe ciasto, które zachwyca swoim niezwykłym smakiem i charakterystyczną teksturą. Jest to tradycyjne polskie ciasto, które wykonuje się z maku, nadając mu intensywny aromat i unikalny wygląd.\r\n\r\nMakowiec składa się z puszystego i delikatnego ciasta drożdżowego, które jest wypełnione aromatycznym nadzieniem z maku, cukru, mleka, bakalii i przypraw. Nadzienie z maku jest gęste, pełne ziarenek maku i ma słodko-orzechowy smak. Dodatkowo, w niektórych wariantach makowca można znaleźć dodatki, takie jak rodzynki, orzechy lub skórka pomarańczowa, które nadają mu dodatkowych smaków i tekstur.\r\n\r\nMakowiec jest tradycyjnie przygotowywany na święta, takie jak Boże Narodzenie czy Wielkanoc, ale również cieszy się popularnością przez cały rok jako smaczny i wyjątkowy deser. Jest serwowany w kawałkach, które są często ozdobione delikatnym cukrem pudrem lub lukrem, co dodaje mu estetycznego wyglądu.\r\n\r\nKażdy kęs makowca to prawdziwa uczta dla podniebienia. Ciasto drożdżowe jest miękkie i puszyste, a nadzienie z maku nadaje mu intensywny smak i lekko chrupiący efekt ziarenek maku. Makowiec jest aromatyczny, słodki, a jednocześnie ma delikatnie wytrawną nutę, która doskonale komponuje się z kubkiem gorącej kawy lub herbaty.\r\n\r\nMakowiec jest nie tylko smacznym deserem, ale także ważnym elementem polskiej tradycji kulinarnej. Jego unikalny smak i wyjątkowy wygląd sprawiają, że jest nieodłącznym elementem wielu świątecznych stołów i rodzinnych spotkań.', '54.00', 'https://d3iamf8ydd24h9.cloudfront.net/pictures/articles/2017/12/20067-v-900x556.jpg', 7),
(3, 'Łabędzi puch', 'Łabędzi puch, znany również jako lalka z białych pianek lub biały puch, to eleganckie i delikatne cukiernicze dzieło sztuki. Jest to deser, który wyróżnia się swoim pięknym wyglądem i lekkością.\r\n\r\nŁabędzi puch składa się głównie z białej pianki, która jest formowana w kształt łabędzia. Pianka jest lekka, puszysta i ma konsystencję przypominającą puch. Wykorzystuje się specjalne formy do tworzenia delikatnych detali łabędzia, takich jak szyja, skrzydła i ogon. Deser ten jest często ozdobiony cukrowymi lub czekoladowymi elementami, takimi jak oczy lub pióra, aby nadać mu jeszcze większą elegancję i realizm.\r\n\r\nŁabędzi puch jest zwykle serwowany na specjalnych okazjach, takich jak przyjęcia weselne, uroczystości rodzinne czy eleganckie przyjęcia. Jego subtelny wygląd i wyjątkowy urok przyciągają uwagę i stanowią ozdobę każdego stołu.\r\n\r\nPod względem smaku, łabędzi puch jest zwykle przygotowywany z pianki o delikatnym smaku waniliowym lub cytrynowym. Jego tekstura jest niezwykle delikatna i rozpływa się w ustach, pozostawiając uczucie lekkości i przyjemności.\r\n\r\nŁabędzi puch to nie tylko deser, ale również wyraz kunsztu cukierniczego. Jego wykonanie wymaga precyzji i umiejętności, aby stworzyć idealnie ukształtowanego i estetycznie wyglądającego łabędzia. To prawdziwe dzieło sztuki, które wzbudza podziw i zachwyt zarówno ze względu na swoją wizualną atrakcyjność, jak i na niebiańską lekkość smaku.', '62.00', 'https://wszystkiegoslodkiego.pl/storage/images/202117/ciasto-labedzi-puch.jpg', 7),
(4, 'Kremówka papieska', 'Kremówka papieska, znana również jako \"Papieska\" lub \"Papieżka\", to słynne ciasto kremowe, które zyskało popularność dzięki swojemu związku z papieżem Janem Pawłem II. Jest to tradycyjne polskie ciasto, które składa się z dwóch warstw kruchego ciasta francuskiego i bogatego kremu waniliowego.\r\n\r\nKremówka papieska zaczyna się od spodu z chrupiącego i delikatnego ciasta francuskiego, które jest pieczone na złoty kolor. Następnie ciasto jest przekrawane na pół, a między dwiema warstwami umieszczany jest gęsty krem waniliowy. Krem jest wykonany z mleka, żółtek jaj, cukru i mąki, a następnie gotowany do zgęstnienia. Ma delikatny smak wanilii i kremową konsystencję, która doskonale komponuje się z chrupiącym ciastem.\r\n\r\nPo nałożeniu kremu, górna warstwa ciasta francuskiego jest delikatnie posypana cukrem pudrem lub przykrywana warstwą lukru, co dodaje ciastu elegancji i estetycznego wyglądu. Kremówka papieska jest często ozdobiona również trzema charakterystycznymi liniami z czekolady na wierzchu.\r\n\r\nKremówka papieska ma wyjątkowy smak i teksturę, która łączy w sobie chrupkość ciasta francuskiego i kremową delikatność kremu waniliowego. Jest to ciasto, które doskonale smakuje na ciepło, ale również smakujące po schłodzeniu w lodówce. Jest często serwowana jako deser lub przekąska, zarówno na specjalne okazje, jak i na codzienne przyjemności.\r\n\r\nKremówka papieska nie tylko zachwyca podniebienie, ale również stanowi ważny element polskiej kuchni i kultury. Jej nazwa jest związana z papieżem Janem Pawłem II, który wyraził swoje upodobanie do tego ciasta i często go spożywał podczas swojej wizyty w Polsce. To ciasto stało się symbolem, który kojarzy się z papieżem i jego miłością do polskiej kuchni.', '49.00', 'https://www.mojegotowanie.pl/media/cache/default_view/uploads/media/recipe/0001/94/kremowki-tradycyjna-kremowka-papieska.jpeg', 18),
(5, 'Wuzetka', 'Wuzetka, znana również jako krówka lub ciasto ptysiowe, to popularne polskie ciasto, które składa się z warstw kruchego ciasta ptysiowego, kremu śmietankowego i kakao.\r\n\r\nWuzetka rozpoczyna się od podstawy z chrupiącego ciasta ptysiowego, które jest wypiekane na złoty kolor. Następnie ciasto jest delikatnie pokruszone, tworząc charakterystyczne \"wuzety\" lub \"krówki\". Krem śmietankowy, zrobiony z gęstej śmietany, cukru pudru i wanilii, jest nakładany na pokruszone ciasto. Kolejna warstwa ciasta ptysiowego jest umieszczana na kremie, tworząc kolejną warstwę chrupkości. Całość jest dekorowana kakao, które dodaje subtelnej czekoladowej nuty.\r\n\r\nWuzetka ma lekki i puszysty charakter, z wyraźnym kontrastem między chrupiącym ciastem ptysiowym a kremowym nadzieniem. Jest to deser, który doskonale smakuje na zimno, gdy krem się solidyfikuje, tworząc kremowy i jednocześnie chrupiący smak. Wuzetka jest popularna na polskich stołach podczas różnych okazji, takich jak urodziny, imieniny czy święta, ale równie dobrze smakuje jako słodka przekąska na co dzień.\r\n\r\nWuzetka jest nie tylko pysznym deserem, ale również wizualnie atrakcyjnym ciastem. Jego charakterystyczny wygląd, z warstwami ciasta ptysiowego i kremu śmietankowego, sprawia, że jest ono nie tylko smaczne, ale również apetyczne dla oka. Jest to ciasto, które z pewnością przypadnie do gustu miłośnikom delikatnych i kremowych słodkości.', '45.00', 'https://www.kwestiasmaku.com/sites/v123.kwestiasmaku.com/files/wuzetka_01_0.jpg', 10),
(6, 'Brownie', 'Brownie to pyszne, czekoladowe ciasto o gęstej konsystencji i intensywnym smaku. Jest to popularny deser, który cieszy się dużą popularnością na całym świecie.\r\n\r\nBrownie jest zazwyczaj przygotowywane z kilku podstawowych składników, takich jak czekolada, masło, jajka, cukier i mąka. Czekolada jest rozpuszczana z masłem, tworząc gładką i bogatą masę czekoladową. Następnie dodawane są jajka, cukier i mąka, aby uzyskać jednolite i gęste ciasto. Dodatkowo, często można dodać orzechy, kawałki czekolady lub inne dodatki, aby dodać smaku i tekstury do brownie.\r\n\r\nBrownie jest pieczone w prostokątnej formie, a po upieczeniu ma chrupiącą skorupkę na zewnątrz i miękką, wilgotną strukturę wewnątrz. To jest charakterystyczne dla tego deseru i sprawia, że jest on niezwykle apetyczny dla miłośników czekolady.\r\n\r\nBrownie jest często podawane w kawałkach, które mogą być polane czekoladowym sosem lub posypane cukrem pudrem. Jest doskonałym towarzyszem do kawy, herbaty lub lodów. Może być również podawane z kulką lodów waniliowych lub bitą śmietaną, aby stworzyć jeszcze bardziej obłędne połączenie smakowe.\r\n\r\nTo, co wyróżnia brownie, to jego intensywny smak czekolady i tekstura, która łączy w sobie delikatność i gęstość. Jest to deser, który doskonale smakuje podczas różnych okazji, od rodzinnych spotkań po przyjęcia czy uroczystości. Brownie jest też świetnym rozwiązaniem, jeśli masz ochotę na coś słodkiego i czekoladowego.', '55.00', 'https://www.kwestiasmaku.com/sites/v123.kwestiasmaku.com/files/brownie-02.jpg', 24),
(7, 'Babeczki czekoladowe', 'Babeczki czekoladowe to małe, wyjątkowo smaczne i uwodzicielskie wypieki dla miłośników czekolady. Są to doskonałe mini-ciastka, które zachwycają nie tylko swoim intensywnym smakiem, ale również pięknym wyglądem.\r\n\r\nBabeczki czekoladowe są przygotowywane z bogatego ciasta czekoladowego, które jest puszyste, wilgotne i ma intensywny aromat czekolady. Ciasto jest wylewane do foremek na babeczki i pieczone do doskonałej tekstury i złocistego koloru.\r\n\r\nPo upieczeniu babeczki czekoladowe są ozdabiane różnymi kremami lub polewami czekoladowymi. Mogą być udekorowane bitą śmietaną, kawałkami czekolady, posypką czekoladową, kolorowymi posypkami lub cukrowymi kwiatkami, dodając im piękno i wyjątkowość.\r\n\r\nBabeczki czekoladowe są idealne jako małe przysmaki na imprezy, przyjęcia urodzinowe, baby showery, czy po prostu jako słodkie rozpieszczenie dla siebie. Ich mały rozmiar czyni je idealnymi do podania pojedynczo i jest to wspaniały sposób na delektowanie się smakiem czekolady w porcjach.\r\n\r\nSmak babeczek czekoladowych jest niezwykle kuszący, z głębokim smakiem czekolady, który dosłownie rozpływa się w ustach. Są one idealnie wilgotne i mają aksamitną teksturę, co sprawia, że są niezwykle zadowalające dla podniebienia.\r\n\r\nBabeczki czekoladowe to małe cuda, które dostarczają dużo radości i zaspokajają słodkie pragnienia. Niezależnie od okazji, babeczki czekoladowe są zawsze doskonałym wyborem dla miłośników czekolady i cukierniczych smakołyków.', '7.00', 'https://cdn.aniagotuje.com/pictures/articles/2023/02/39670231-v-1500x1500.jpg', 50),
(8, 'Ciasto z jeżynami', 'Ciasto jeżynowe to pyszny deser, który wypełniony jest soczystymi jeżynami. To idealna propozycja dla miłośników owocowych smaków i słodkich przysmaków.\r\n\r\nCiasto jeżynowe składa się z delikatnego, wilgotnego biszkoptu lub kruchego ciasta, które jest wypełnione świeżymi jeżynami. Jeżyny są układane równomiernie na cieście, tworząc aromatyczną i kolorową warstwę owocową. Często na wierzchu ciasta jeżynowego dodaje się delikatną posypkę lub kruszonkę, która nadaje dodatkowej tekstury i smaku.\r\n\r\nW zależności od przepisu, ciasto jeżynowe może być podawane na ciepło lub po schłodzeniu w lodówce. Jest doskonałe jako deser na letnie dni lub jako słodka przekąska o każdej porze roku.\r\n\r\nSmak ciasta jeżynowego jest harmonią słodkości i kwasowości jeżyn. Soczyste jeżyny rozpływają się w ustach, dodając świeżości i naturalnego smaku. Ciasto jeżynowe jest zwykle delikatne i lekko kwaśne, co doskonale kontrastuje z słodkim biszkoptem lub kruchym ciastem.\r\n\r\nCiasto jeżynowe jest idealne na różne okazje, od rodzinnych spotkań po przyjęcia i uroczystości. Może być podawane solo lub z dodatkowym bitą śmietaną, lodami waniliowymi lub polewą czekoladową dla jeszcze większej rozkoszy smakowej.\r\n\r\nJeżyny to pyszne owoce, a ciasto jeżynowe pozwala im zabłysnąć w pełnej krasie. To wyjątkowe ciasto cieszy się popularnością ze względu na swoją prostotę, smakowitość i naturalne składniki.', '59.00', 'https://poprostupycha.com.pl/wp-content/uploads/2022/08/ciasto-z-jezynami_10.jpg.webp', 15),
(9, 'Ciasto z truskawkami', 'Ciasto z truskawkami to letni deser, który w pełni wykorzystuje świeżość i słodycz tych pysznych owoców. Jest to idealne ciasto dla miłośników truskawek i słodkich, owocowych smaków.\r\n\r\nCiasto z truskawkami może mieć różne warianty, ale najczęściej składa się z lekkiego biszkoptu lub kruchego ciasta, które jest wypełnione świeżymi truskawkami. Truskawki są układane na cieście lub umieszczane na kremie śmietankowym, tworząc kolorową i aromatyczną warstwę owocową.\r\n\r\nDodatkowo, ciasto z truskawkami często jest polane delikatnym żelatynowym galaretkowym sosem, który dodaje dodatkowej świeżości i estetycznego wyglądu. Może być również ozdobione bitą śmietaną, posypką lub cukrem pudrem, aby podkreślić smak i wygląd truskawkowego deseru.\r\n\r\nSmak ciasta z truskawkami jest niezwykle soczysty, słodki i orzeźwiający. Truskawki nadają ciastu naturalny aromat i delikatną kwasowość, która doskonale komponuje się z lekkością i słodyczą ciasta. To jest idealne ciasto na ciepłe letnie dni, gdy truskawki są w pełnej sezonowej świeżości.\r\n\r\nCiasto z truskawkami jest idealne na różne okazje, od pikników i grillów po urodziny i imieniny. Jest doskonałym wyborem dla tych, którzy kochają truskawki i chcą cieszyć się ich smakiem w formie deseru.\r\n\r\nCiasto z truskawkami to wizualnie atrakcyjny deser, który zapewnia nie tylko wspaniałe doświadczenie smakowe, ale również wywołuje uśmiech na twarzach wszystkich, którzy go spróbują. Jest to idealne ciasto dla tych, którzy pragną słodkiego i owocowego rajdu dla swojego podniebienia.', '57.00', 'https://cdn.aniagotuje.com/pictures/articles/2019/06/666085-v-1500x1500.jpg', 14),
(10, 'Ciasto malinowy obłoczek', 'Ciasto malinowy obłoczek to prawdziwa uczta dla miłośników malin i lekkich, puszystych deserów. Jest to delikatne ciasto, które dosłownie rozpływa się w ustach i zachwyca swoim intensywnym smakiem malin.\r\n\r\nCiasto malinowy obłoczek składa się z delikatnego biszkoptu, który jest nasączony sokiem malinowym lub malinowym syropem, aby uzyskać dodatkowy smak owocowy. Następnie na biszkopt jest nakładany puszysty, lekki krem malinowy, który jest wykonany z malin, śmietany, cukru i żelatyny. Krem jest delikatnie rozprowadzany na biszkopt, tworząc warstwę intensywnego smaku malin.\r\n\r\nCiasto malinowy obłoczek jest często dekorowane świeżymi malinami na wierzchu, dodając piękno i świeżość do tego wspaniałego deseru. Może być również posypane cukrem pudrem lub ozdobione bitą śmietaną, aby wzbogacić doświadczenie smakowe i estetyczne ciasta.\r\n\r\nSmak ciasta malinowy obłoczek jest owocowy, słodki i orzeźwiający. Maliny nadają ciastu intensywny smak i kwasowość, które doskonale komponują się z delikatnym biszkoptem i puszystym kremem. To jest idealne ciasto na ciepłe letnie dni, kiedy maliny są w pełni sezonu i mają najbardziej soczysty smak.\r\n\r\nCiasto malinowy obłoczek jest doskonałe na różne okazje, od rodzinnych spotkań po przyjęcia i uroczystości. Jego wyjątkowy smak i piękny wygląd sprawiają, że jest ono nie tylko pysznym deserem, ale również efektownym elementem stołu.\r\n\r\nCiasto malinowy obłoczek to słodki rajd dla podniebienia, który uwodzi smakiem malin. To jest ciasto, które przynosi radość i delektowanie się owocowymi smakołykami na najwyższym poziomie.', '56.00', 'https://staticsmaker.iplsc.com/smaker_prod_2018_06_17/6c1c451773045c23195b8f6d25cef4c6-lg.jpg', 3),
(11, 'Ciasto marchewkowe bezglutenowe', 'Ciasto marchewkowe bezglutenowe to smaczna i zdrowsza wersja tradycyjnego ciasta marchewkowego, idealna dla osób z nietolerancją glutenu lub celiakią. Jest to wilgotne i aromatyczne ciasto, które zachwyca swoim intensywnym smakiem marchewki i przyjemną konsystencją.\r\n\r\nTo ciasto jest przygotowywane z mieszanki mąki bezglutenowej, takiej jak mąka ryżowa, mąka ziemniaczana lub mąka migdałowa, która zastępuje tradycyjną mąkę pszenną. Dodatkowo, ciasto zawiera starte marchewki, jajka, cukier, olej roślinny, przyprawy jak cynamon, gałka muszkatołowa i imbir, oraz dodatkowe składniki takie jak rodzynki, orzechy lub nasiona słonecznika.\r\n\r\nW rezultacie otrzymujemy ciasto marchewkowe o pięknej pomarańczowej barwie, które jest wilgotne, puszyste i bogate w smaku. Marchewki dodają słodkości i naturalnej soczystości, a przyprawy nadają mu charakterystyczny aromat i korzenny posmak. Ciasto marchewkowe bezglutenowe jest zwykle ozdobione lukrem śmietankowym lub kremem serowym, który doskonale komponuje się z jego smakiem.\r\n\r\nTo ciasto jest idealne na różne okazje, od przyjęć rodzinnych po urodziny czy święta. Może być podane na ciepło lub po schłodzeniu w lodówce. Jest również popularne jako zdrowsza alternatywa dla tradycyjnego ciasta marchewkowego, ponieważ jest wolne od glutenu, a jednocześnie nie traci na smaku i jakości.\r\n\r\nCiasto marchewkowe bezglutenowe to nie tylko smaczny deser, ale również doskonałe źródło błonnika i składników odżywczych dzięki obecności marchewki. Dlatego można cieszyć się tym pysznym ciastem bez obaw o nietolerancję glutenu i z pełnią smaku i przyjemności.\r\n\r\n\r\n\r\n', '45.00', 'https://kuchniabezglutenu.pl/wp-content/uploads/2021/12/P12201903.jpg', 13),
(12, 'Cytrynowa babka bezglutenowa', 'Bezglutenowa babka cytrynowa to wyjątkowe i orzeźwiające ciasto, które nie zawiera glutenu, ale zachwyca swoim intensywnym smakiem cytryny i miękką, wilgotną konsystencją. Jest to idealny wybór dla osób z nietolerancją glutenu lub celiakią, które chcą cieszyć się tradycyjnymi smakami bez konieczności rezygnowania z ulubionych deserów.\r\n\r\nTo ciasto jest przygotowywane z mąki bezglutenowej, takiej jak mąka ryżowa, mąka ziemniaczana lub mąka migdałowa, która zastępuje tradycyjną mąkę pszenną. Dodatkowo, ciasto zawiera świeży sok i skórkę z cytryn, jajka, cukier, olej roślinny i proszek do pieczenia. Te składniki tworzą aromatyczną i soczystą babkę, która doskonale nadaje się do podania na różne okazje.\r\n\r\nBabka cytrynowa bezglutenowa ma jasnożółtą barwę i delikatny cytrynowy aromat. Po upieczeniu ciasto nabiera puszystej i miękkiej konsystencji, która rozpływa się w ustach. Często jest polewana cytrynowym lukrem, który dodaje dodatkowego smaku i dekoracyjnego wykończenia.\r\n\r\nTo ciasto jest idealne na podwieczorek, przyjęcia, urodziny czy inne specjalne okazje. Jego świeży smak cytryny sprawia, że jest doskonałym wyborem na letnie dni, kiedy chcemy cieszyć się lekkimi i orzeźwiającymi smakami.\r\n\r\nBezglutenowa babka cytrynowa jest dowodem na to, że można cieszyć się wspaniałym smakiem i teksturą ciasta, nawet bez obecności glutenu. Jest to doskonały deser dla wszystkich miłośników cytrynowych smaków, którym zależy na zdrowym i przyjemnym jedzeniu.', '62.00', 'https://wszystkiegoslodkiego.pl/storage/images/202015/cytrynowa-babka-bezglutenowa-1.webp', 9),
(13, 'Sernik wegański z orzechów nerkowca', 'Sernik wegański z orzechów nerkowca to przepyszny deser dla osób preferujących dietę roślinną lub poszukujących alternatywy dla tradycyjnego sernika. Jest to bezmięsna i bez nabiału wersja sernika, która korzysta z orzechów nerkowca jako bazowego składnika.\r\n\r\nTen wegański sernik składa się z dwóch głównych warstw: spodu zmielonych orzechów nerkowca i daktyle oraz kremowej warstwy serowej. Spód ciasta jest zwykle przygotowywany z połączenia zmielonych orzechów nerkowca, daktyli, oleju kokosowego i szczypty soli, co daje mu chrupiącą i aromatyczną konsystencję.\r\n\r\nKremowa warstwa serowa jest zazwyczaj wykonana z namoczonego i zmielonego orzechów nerkowca, mleka roślinnego, syropu klonowego lub innego słodzika naturalnego, soku z cytryny i odrobinę ekstraktu waniliowego. Całość jest blendowana lub miksowana, aż do uzyskania gładkiej i kremowej konsystencji. Warstwa serowa jest układana na spodzie ciasta i schładzana, aby stężała.\r\n\r\nSernik wegański z orzechów nerkowca ma delikatny, kremowy smak, który doskonale komponuje się z naturalnymi nutami orzechów. Może być podawany samodzielnie lub z dodatkami, takimi jak świeże owoce, polewa czekoladowa lub bita śmietana roślinna.\r\n\r\nTen wegański sernik z orzechów nerkowca jest nie tylko smacznym deserem, ale także bogatym źródłem zdrowych tłuszczów, białka roślinnego i innych składników odżywczych. Jest to doskonała opcja dla wegan, wegetarian, osób z nietolerancją laktozy lub dla tych, którzy po prostu chcą spróbować czegoś innego i pysznego.', '54.00', 'https://s3.przepisy.pl/przepisy3ii/img/variants/500x0/dsc_28969026901592467597000.jpg', 6),
(14, 'Szarlotka bezglutenowa', 'Szarlotka bezglutenowa to wariacja klasycznego polskiego deseru, który jest przyjazny dla osób z nietolerancją glutenu lub celiakią. Ta smaczna i aromatyczna szarlotka zadowoli nawet najbardziej wymagające podniebienia.\r\n\r\nBezglutenowa szarlotka składa się z dwóch głównych warstw: kruchego ciasta na bazie mąki bezglutenowej i soczystego nadzienia z jabłek. Ciasto jest przygotowane z mieszanki mąki bezglutenowej, takiej jak mąka ryżowa, mąka kukurydziana lub mąka ziemniaczana, która zastępuje tradycyjną mąkę pszenną. Dodatkowo, ciasto może zawierać masło lub substytut roślinny, cukier, jajka, proszek do pieczenia i szczyptę soli. Kruche ciasto jest rozwałkowane i użyte jako spód i pokrywka szarlotki.\r\n\r\nNadzienie szarlotki bezglutenowej jest zazwyczaj przygotowane z pokrojonych jabłek, cukru, cynamonu i soku z cytryny. Jabłka są duszone lub smażone na patelni, aby stały się miękkie i delikatne. Następnie są rozłożone na spodzie ciasta, a druga warstwa ciasta jest nakładana na wierzch.\r\n\r\nSzarlotka bezglutenowa jest pieczona w piekarniku, aż do uzyskania złocistego koloru i chrupiącej tekstury. Po upieczeniu można ją podawać na ciepło lub po schłodzeniu w lodówce. Szarlotka bezglutenowa jest często posypana cynamonem lub cukrem pudrem przed podaniem.\r\n\r\nTa szarlotka bezglutenowa zachwyca pysznym smakiem jabłek, przyjemnym aromatem cynamonu i kruchą konsystencją ciasta. Jest to idealne ciasto na jesienne wieczory, kiedy jabłka są w pełni sezonu i mają intensywny smak. Może być podawana sama, z bitą śmietaną roślinną lub lodami waniliowymi dla dodatkowej rozkoszy smakowej.\r\n\r\nSzarlotka bezglutenowa to smaczny i satysfakcjonujący deser dla wszystkich, którzy chcą cieszyć się tradycyjnym smakiem szarlotki, bez obecności glutenu. Jest to doskonała alternatywa dla osób z nietolerancją glutenu, która pozwala na delektowanie się ulubionymi smakami w pełni.', '52.00', 'https://cdn.aniagotuje.com/pictures/articles/2021/09/19097895-v-1500x1500.jpg', 8),
(15, 'Tiramisu truskawkowe', 'Tiramisu truskawkowe to wariacja klasycznego włoskiego deseru tiramisu, wzbogacona o świeże truskawki. Jest to delikatny i apetyczny deser składający się z kilku warstw, których smaki i tekstury harmonijnie się ze sobą łączą.\r\n\r\nPodstawą tiramisu truskawkowego jest kremowy sos mascarpone, który jest mieszanką sera mascarpone, śmietany, cukru i wanilii. Sos ten jest lekko słodki i ma gładką, kremową konsystencję.\r\n\r\nWarstwy kremu mascarpone są przeplatane miękkimi biszkoptami nasączonymi aromatycznym syropem truskawkowym. Biszkopty są delikatne i lekko wilgotne, dodając do deseru odpowiednią teksturę.\r\n\r\nDodatkowo, tiramisu truskawkowe jest ozdobione świeżymi truskawkami na wierzchu, które dodają słodkiego smaku i koloru. Truskawki są soczyste, słodkie i pełne aromatu, idealnie komponując się z resztą składników.\r\n\r\nCałość tworzy niezwykle smakowite i atrakcyjne wizualnie danie, które jest idealne na letnie dni, gdy truskawki są w pełni sezonu.\r\n\r\nTiramisu truskawkowe to doskonały wybór dla miłośników deserów, którzy chcą spróbować czegoś nowego i świeżego, jednocześnie czerpiąc przyjemność z klasycznego włoskiego smaku tiramisu w nowej odsłonie.', '42.00', 'https://cdn.galleries.smcloud.net/t/photos/gf-xqs8-S5Bj-ZGum_truskawkowe-tiramisu-z-nuta-wanilii-przepis.jpg', 14),
(16, 'Ciasto Kinder Bueno', 'Kinder Bueno to pyszne czekoladowe ciasto, które jest ulubionym wyborem wielu smakoszy. Składa się z chrupiącej warstwy wafelków, delikatnego nadzienia kremowego o smaku mleczno-orzechowym oraz otoczony jest kremową czekoladą mleczną. Połączenie chrupiącego i kremowego smaku sprawia, że Kinder Bueno jest niezwykle apetyczne i satysfakcjonujące dla podniebienia. To idealna słodka przekąska, która cieszy się ogromną popularnością na całym świecie.', '37.00', 'https://cdn.aniagotuje.com/pictures/articles/2021/05/15177229-v-1500x1500.jpg', 15),
(26, 'Miodownik', 'Miodownik to tradycyjne polskie ciasto, które charakteryzuje się wyjątkowym smakiem i aromatem miodu. Jest to miękkie, wilgotne i delikatne ciasto, które często przyrządza się z dodatkiem innych składników, takich jak orzechy lub suszone owoce, dla wzbogacenia jego tekstury i smaku.\r\n\r\nPodstawowe składniki miodownika to mąka, miód, masło, jajka, cukier, mleko i proszek do pieczenia. Te składniki są starannie wymieszane, tworząc gładkie i kremowe ciasto. Po upieczeniu miodownik ma złocisto-brązowy kolor i lekko wilgotną konsystencję.\r\n\r\nMiodownik jest doskonałym wyborem na różne okazje, w tym na święta i uroczystości rodzinne. Może być podawany na ciepło z bitą śmietaną lub lukrem, co dodatkowo podkreśla jego słodki smak. Miodownik jest uwielbiany przez wielu Polaków i stanowi ważny element tradycyjnej polskiej kuchni.\r\n', '50.00', 'https://cdn.galleries.smcloud.net/t/galleries/gf-ey5f-qczv-ChaY_tradycyjny-polski-miodownik-sprawdzony-przepis-664x442-nocrop.jpg', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `question`
--

CREATE TABLE `question` (
  `ID` int(11) NOT NULL,
  `Pytanie` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `question`
--

INSERT INTO `question` (`ID`, `Pytanie`) VALUES
(1, 'Jaki jest twój ulubiony kolor?'),
(2, 'Jak ma na imię twój zwierzak?'),
(3, 'Na jakiej ulicy mieszkasz?'),
(4, 'Jaki jest twój ulubiony serial?');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questionuser`
--

CREATE TABLE `questionuser` (
  `ID` int(11) NOT NULL,
  `KlientID` int(11) NOT NULL,
  `PytanieID` int(11) NOT NULL,
  `Odpowiedz` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `questionuser`
--

INSERT INTO `questionuser` (`ID`, `KlientID`, `PytanieID`, `Odpowiedz`) VALUES
(1, 9, 1, 'czerwony'),
(2, 10, 1, 'czerwony'),
(3, 11, 1, 'czerwony'),
(4, 12, 1, 'zielony'),
(5, 13, 1, 'niebieski'),
(6, 14, 1, 'zielony'),
(7, 15, 1, 'zielony');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipping`
--

CREATE TABLE `shipping` (
  `ID` int(11) NOT NULL,
  `ZamowienieID` int(11) NOT NULL,
  `Ulica_nr` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Nr_mieszkania` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `Miasto` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Wojewodztwo` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `KodPocztowy` varchar(10) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `shipping`
--

INSERT INTO `shipping` (`ID`, `ZamowienieID`, `Ulica_nr`, `Nr_mieszkania`, `Miasto`, `Wojewodztwo`, `KodPocztowy`) VALUES
(5, 1, 'Ciastowa 1', '4', '0', 'lubuskie', '65-562'),
(6, 2, 'Sezamowa 4', '1', '0', 'lubuskie', '65-642'),
(7, 3, 'Testowa 12', '23', 'Zielona Góra', 'lubuskie', '65-231'),
(8, 4, 'Kolorowa 4', '23', 'Zielona Góra', 'lubuskie', '12-245'),
(9, 5, 'Testowa 4', '5', 'Gorzów Wielkopolski', 'lubuskie', '52-415'),
(10, 6, 'Lampowa', '24', 'Żagań', 'lubuskie', '53-241'),
(11, 7, 'Test 4', '5', 'Testowo', 'testowe', '11-111'),
(12, 8, 'Test 4', '2', 'Test', 'testowe', '11-111'),
(13, 9, 'Testowa 4', '12', 'Zielona Góra', 'lubuskie', '65-524'),
(14, 10, 'Test 4', '5', 'Test', 'test', '11-111');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ZamowienieID` (`ZamowienieID`),
  ADD KEY `ProduktID` (`ProduktID`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KlientID` (`KlientID`);

--
-- Indeksy dla tabeli `productcategories`
--
ALTER TABLE `productcategories`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProduktID` (`ProduktID`),
  ADD KEY `KategoriaID` (`KategoriaID`);

--
-- Indeksy dla tabeli `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProduktID` (`ProduktID`),
  ADD KEY `KlientID` (`KlientID`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `questionuser`
--
ALTER TABLE `questionuser`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KlientID` (`KlientID`),
  ADD KEY `PytanieID` (`PytanieID`);

--
-- Indeksy dla tabeli `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ZamowienieID` (`ZamowienieID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `employees`
--
ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `question`
--
ALTER TABLE `question`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `questionuser`
--
ALTER TABLE `questionuser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`ZamowienieID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProduktID`) REFERENCES `products` (`ID`);

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`KlientID`) REFERENCES `customers` (`ID`);

--
-- Ograniczenia dla tabeli `productcategories`
--
ALTER TABLE `productcategories`
  ADD CONSTRAINT `productcategories_ibfk_1` FOREIGN KEY (`ProduktID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `productcategories_ibfk_2` FOREIGN KEY (`KategoriaID`) REFERENCES `categories` (`ID`);

--
-- Ograniczenia dla tabeli `productreviews`
--
ALTER TABLE `productreviews`
  ADD CONSTRAINT `productreviews_ibfk_1` FOREIGN KEY (`ProduktID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `productreviews_ibfk_2` FOREIGN KEY (`KlientID`) REFERENCES `customers` (`ID`);

--
-- Ograniczenia dla tabeli `questionuser`
--
ALTER TABLE `questionuser`
  ADD CONSTRAINT `questionuser_ibfk_1` FOREIGN KEY (`KlientID`) REFERENCES `customers` (`ID`),
  ADD CONSTRAINT `questionuser_ibfk_2` FOREIGN KEY (`PytanieID`) REFERENCES `question` (`ID`);

--
-- Ograniczenia dla tabeli `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`ZamowienieID`) REFERENCES `orders` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

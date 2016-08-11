CREATE DATABASE  IF NOT EXISTS `sctcc_cms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sctcc_cms`;
-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: sctcc_cms
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cms_cat`
--

DROP TABLE IF EXISTS `cms_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_desc` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_desc_UNIQUE` (`cat_desc`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_cat`
--

LOCK TABLES `cms_cat` WRITE;
/*!40000 ALTER TABLE `cms_cat` DISABLE KEYS */;
INSERT INTO `cms_cat` VALUES (14,'Aerospace 1'),(1,'Fireman Training'),(8,'Information Technology (IT)'),(9,'Manufacturing'),(6,'Motorcycle Training'),(12,'Nuclear Engineer'),(2,'Nursing'),(5,'Police Officer & Forensics'),(13,'Rocket Scientists'),(4,'Sailor'),(7,'Truck Driver Training');
/*!40000 ALTER TABLE `cms_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_contact`
--

DROP TABLE IF EXISTS `cms_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_contact` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `email_address` varchar(100) COLLATE utf8_bin NOT NULL,
  `street_address` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `zip` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `soft_delete` bit(1) DEFAULT b'0',
  PRIMARY KEY (`cms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_contact`
--

LOCK TABLES `cms_contact` WRITE;
/*!40000 ALTER TABLE `cms_contact` DISABLE KEYS */;
INSERT INTO `cms_contact` VALUES (1,'Valentine','Mclaughlin','1-836-162-7730','Valentine.Mclaughlin@elitdictumeuassociates.com','P.O. Box 181, 7914 Odio. St.','Cambridge','Massachusetts','97633','United States','Elit Dictum Eu Associates','\0'),(2,'Brooke','Jennings','1-448-384-5633','Brooke.Jennings@sociosquinstitute.com','Ap #458-8081 Viverra. St.','Stratford','PE','C7V 8N5','Canada','Sociosqu Institute','\0'),(3,'Zelda','Hopper','1-106-306-6152','Zelda.Hopper@nequetellusimperdietassociates.com','Ap #207-9625 Arcu. St.','Annapolis Royal','NS','B8N 9V6','Canada','Neque Tellus Imperdiet Associates','\0'),(4,'Cairo','Randolph','1-316-965-8417','Cairo.Randolph@consectetuerinstitute.com','P.O. Box 554, 7325 Orci, Avenue','South Burlington','Vermont','89306','United States','Consectetuer Institute','\0'),(5,'Melyssa','Rivers','549-4271','Melyssa.Rivers@nonfoundation.com','Ap #967-287 Mattis. Rd.','Dorval','QC','G3P 5H1','Canada','Non Foundation','\0'),(6,'Cleo','Mullen','296-3470','Cleo.Mullen@vitaediamproincorp..com','P.O. Box 364, 7588 Sed Street','Richmond','VA','21267','United States','Vitae Diam Proin Corp.','\0'),(7,'Zeus','Maxwell','1-756-752-7434','Zeus.Maxwell@rutrumcorp..com','695-2513 Non Av.','Fort Worth','TX','86290','United States','Rutrum Corp.','\0'),(8,'Ann','Richard','654-7114','Ann.Richard@tortorcompany.com','P.O. Box 619, 2843 Aliquet Av.','Bloomington','MN','29466','United States','Tortor Company','\0'),(9,'Lacota','Yang','1-310-648-0542','Lacota.Yang@pharetranibhaliquampc.com','131-8456 Cras Ave','Champlain','QC','H8R 6M6','Canada','Pharetra Nibh Aliquam PC',''),(10,'Henry','Mcdonald','910-6565','Henry.Mcdonald@nuncsollicitudincommodollc.com','387 Eu Ave','Auburn','ME','51426','United States','Nunc Sollicitudin Commodo LLC','\0'),(11,'Cally','Bates','827-2023','Cally.Bates@loremvehiculainc..com','957-6770 Eget Street','Edmundston','NB','E4G 2K9','Canada','Lorem Vehicula Inc.','\0'),(12,'Sydney','English','268-2475','Sydney.English@rutruminstitute.com','583-8827 Nulla Ave','Fort McPherson','NT','X5G 0R9','Canada','Rutrum Institute','\0'),(13,'Ciara','Chen','494-4425','Ciara.Chen@vitaelimited.com','7169 Aliquam Ave','Langford','British Columbia','V7G 5G0','Canada','Vitae Limited','\0'),(14,'Gwendolyn','Dale','1-836-493-8667','Gwendolyn.Dale@quisqueinc..com','P.O. Box 636, 4120 Placerat, Av.','Halifax','NS','B9W 9W5','Canada','Quisque Inc.','\0'),(15,'Byron','Sykes','396-9537','Byron.Sykes@posuerevulputatelacusllp.com','P.O. Box 800, 6172 At, Rd.','Charlottetown','PE','C8W 7N9','Canada','Posuere Vulputate Lacus LLP','\0'),(16,'Harper','Franklin','1-344-785-9310','Harper.Franklin@sagittisfelisdonecpc.com','421-5329 Torquent Rd.','Beausejour','Manitoba','R8G 2B8','Canada','Sagittis Felis Donec PC',''),(17,'Oliver','Mack','1-643-666-9986','Olivier.Mack@ninjasinc.com','P.O. Box 825, 7911 Iaculis St.','Independence','MO','28545','United States','Ninjas Inc.','\0'),(18,'Cherokee','Zimmerman','876-9022','Cherokee.Zimmerman@euismodllc.com','P.O. Box 154, 4609 Interdum Rd.','Houston','British Columbia','V4R 1G7','Canada','Euismod LLC',''),(19,'Charissa','Roberts','1-643-729-9843','Charissa.Roberts@adipiscingnonluctusconsulting.com','6778 Cras St.','Saint Louis','MO','79122','United States','Adipiscing Non Luctus Consulting','\0'),(20,'Abra','Fry','440-6194','Abra.Fry@nuncidindustries.com','P.O. Box 619, 2014 Tellus. Ave','Gary','Indiana','30602','United States','Nunc Id Industries','\0'),(21,'Lexi','Bonner','768-8151','Lex.Bonner@nonnisiatheneaninstitute.com','P.O. Box 687, 6928 Est. Avenue','Casper','Wyoming','46783','United States','Non Nisi Athenean Institute',''),(22,'Harper','Moody','1-464-190-6848','Harper.Moody@quismassainc..com','P.O. Box 370, 466 Sed, Rd.','Sandy','Utah','90576','United States','Quis Massa Inc.','\0'),(23,'Fletcher','Walker','688-1263','Fletcher.Walker@purussapiengravidacompany.com','P.O. Box 954, 1043 Vitae Ave','Southaven','Mississippi','18972','United States','Purus Sapien Gravida Company','\0'),(24,'Chanda','Munoz','226-7734','Chanda.Munoz@arculimited.com','Ap #339-2677 Et Av.','Yorkton','Saskatchewan','S6J 2C5','Canada','Arcu Limited','\0'),(25,'Simone','Lewis','840-8389','Simone.Lewis@sagittisplaceratassociates.com','6437 In Avenue','Annapolis Royal','Nova Scotia','B8P 3Z7','Canada','Sagittis Placerat Associates','\0'),(26,'Joy','Curry','496-1254','Joy.Curry@quisdiampellentesqueincorporated.com','P.O. Box 820, 8846 Arcu. Street','Frankfort','KY','47044','United States','Quis Diam Pellentesque Incorporated',''),(27,'Gail','Patton','1-996-725-3920','Gail.Patton@aliquamauctorfoundation.com','Ap #340-8109 Vel Avenue','Springfield','Missouri','56585','United States','Aliquam Auctor Foundation','\0'),(28,'Lex','Luthor','288-2637','Lex.Luthor@lexcorp.com','Ap #842-3687 Eleifend Avenue','Metropolis','New York','Y5N 4K8','Canada','LexCorp','\0'),(29,'Alova','Alvara','814-1552','Alova.Alvara@charter.com','P.O. Box 935, 9404 Orci. Rd.','Timbuktu','Tombouctou','99712','Mali','Orci Lacus LLC',''),(30,'Francis','Blanchard','297-1863','Francis.Blanchard@sociisnatoqueincorporated.com','979-4115 Eu, Av.','Athens','Minnesota','61887','United States','Sociis Natoque Incorporated','\0'),(31,'Eagan','Walton','1-125-901-3718','Eagan.Walton@magnaincorporated.com','719-9822 Tempor, Rd.','Lowell','Massachusetts','35981','United States','Magna Incorporated','\0'),(32,'Ferdinand','Horne','965-1834','Ferdinand.Horne@aliquetodiocorp..com','Ap #341-1787 Nascetur St.','Dallas','TX','54739','United States','Aliquet Odio Corp.','\0'),(33,'Samantha','Beasley','955-6452','Samantha.Beasley@adipiscingligulacompany.com','4927 Interdum St.','Halifax','NS','B4Y 4B6','Canada','Adipiscing Ligula Company','\0'),(34,'Guinevere','Petersen','602-9301','Guinevere.Petersen@temporllc.com','3586 Cras Street','Beausejour','MB','R3H 4L3','Canada','Tempor LLC','\0'),(35,'Hayfa','Knight','423-3603','Hayfa.Knight@tellusphaselluselitllp.com','Ap #806-326 Erat Av.','Newmarket','Ontario','K0E 1J4','Canada','Tellus Phasellus Elit LLP','\0'),(36,'Lesley','Kennedy','1-315-376-2305','Lesley.Kennedy@praesentcorp..com','Ap #479-4768 Elit, Street','Gjoa Haven','NU','X7K 1H4','Canada','Praesent Corp.','\0'),(37,'Buckminster','Lane','1-133-594-1633','Buckminster.Lane@phasellusliberocompany.com','235-4217 In Avenue','Scarborough','Ontario','L4T 6B9','Canada','Phasellus Libero Company','\0'),(38,'Hillary','Rose','1-461-894-7019','Hillary.Rose@proinincorporated.com','844-7196 Aliquet Street','Fort Smith','NT','X3G 4M0','Canada','Proin Incorporated','\0'),(39,'Keefe','Rios','1-471-950-9892','Keefe.Rios@vulputatemaurislimited.com','998-4645 Dapibus St.','Chattanooga','TN','77581','United States','Vulputate Mauris Limited','\0'),(40,'Ila','Harris','742-2752','Ila.Harris@urnavivamusconsulting.com','984-5400 Gravida Road','Arviat','Nunavut','X9C 1L8','Canada','Urna Vivamus Consulting',''),(41,'Cameran','Wolfe','231-7737','Cameran.Wolfe@mauriscorp..com','667-2154 Mauris Street','Langenburg','SK','S8M 6S4','Canada','Mauris Corp.',''),(42,'Dara','Wilson','1-869-429-9011','Dara.Wilson@eratinstitute.com','745-7485 Magnis St.','Shipshaw','QC','G7T 5W2','Canada','Erat Institute',''),(43,'Cairo','Hudson','352-9618','Cairo.Hudson@nonbibendumsedllc.com','Ap #429-3590 Euismod St.','Mobile','AL','36170','United States','Non Bibendum Sed LLC','\0'),(44,'Xavier','Vance','263-6229','Xavier.Vance@cursusintegermollisincorporated.com','Ap #124-1824 Facilisis, Street','Olathe','KS','41854','United States','Cursus Integer Mollis Incorporated','\0'),(45,'Kathleen','Clemons','271-7729','Kathleen.Clemons@auguesedpc.com','Ap #579-9044 In St.','Ucluelet','BC','V6S 5G7','Canada','Augue Sed PC','\0'),(46,'Chandler','Waters','1-932-376-1733','Chandler.Waters@ultricesposuerelimited.com','833-2118 Arcu Rd.','Eugene','OR','45027','United States','Ultrices Posuere Limited','\0'),(47,'Zahir','Newman','815-8955','Zahir.Newman@donecnibhquisquellp.com','199-6776 Fringilla, Avenue','Omaha','NE','44221','United States','Donec Nibh Quisque LLP','\0'),(48,'Bernard','Love','1-941-232-9519','Bernard.Love@eratinconsectetuerllp.com','P.O. Box 917, 5170 Semper. St.','Campbellton','New Brunswick','E4W 1G6','Canada','Erat In Consectetuer LLP','\0'),(49,'Dorian','Mckenzie','832-8511','Dorian.Mckenzie@enimnoninc..com','P.O. Box 634, 1308 Dui Rd.','Rockville','Maryland','64398','United States','Enim Non Inc.','\0'),(50,'Kimberly','Stein','1-267-948-7891','Kimberly.Stein@duiconsulting.com','Ap #368-6763 Sem, Rd.','Tulsa','Oklahoma','32968','United States','Dui Consulting','\0'),(51,'Nathaniel','Chan','613-5515','Nathaniel.Chan@scelerisquenequesedltd.com','P.O. Box 339, 516 Sit Street','Kimberly','BC','V7J 5R8','Canada','Scelerisque Neque Sed Ltd','\0'),(52,'Xena','Snow','838-7831','Xena.Snow@posuerecubiliacurae;associates.com','599-1634 Eu St.','Calder','SK','S0W 0T4','Canada','Posuere Cubilia Curae; Associates','\0'),(53,'Kaitlin','Gross','1-870-340-8545','Kaitlin.Gross@tinciduntduiconsulting.com','Ap #374-9422 Maecenas St.','Madison','WI','10922','United States','Tincidunt Dui Consulting','\0'),(54,'Buckminster','Nielsen','822-9105','Buckminster.Nielsen@necconsulting.com','971-1701 Augue Street','Charlottetown','Prince Edward Island','C7V 3J6','Canada','Nec Consulting','\0'),(55,'Heidi','Dalton','959-1101','Heidi.Dalton@etiamcompany.com','352-8065 Auctor Ave','Colorado Springs','Colorado','58063','United States','Etiam Company','\0'),(56,'Randall','Howell','862-6748','Randall.Howell@liberointegercompany.com','449 Convallis, Avenue','Las Vegas','Nevada','91633','United States','Libero Integer Company','\0'),(57,'Gareth','Cunningham','184-7374','Gareth.Cunningham@cursusintegermollisinstitute.com','891-7805 In Rd.','Dover','Delaware','47024','United States','Cursus Integer Mollis Institute',''),(58,'Tasha','Pierce','545-5832','Tasha.Pierce@cubiliacurae;phaselluslimited.com','Ap #644-3734 Mauris Rd.','Lewiston','Maine','75256','United States','Cubilia Curae; Phasellus Limited','\0'),(59,'Grant','Tyler','468-7892','Grant.Tyler@necurnacorporation.com','P.O. Box 808, 2711 Erat, Road','Town of Yarmouth','NS','B1G 7C1','Canada','Nec Urna Corporation','\0'),(60,'Kaye','Russo','1-642-186-0607','Kaye.Russo@duilimited.com','Ap #150-1797 Lacus. Ave','Boston','MA','22980','United States','Dui Limited','\0'),(61,'Hop','Vang','533-3631','Hop.Vang@ipsumdolorsitconsulting.com','189-3598 Aliquam Avenue','Biloxi','MS','81656','United States','Ipsum Dolor Sit Consulting',''),(62,'Hop','Farmer','1-831-480-6093','Hop.Farmer@lacusvestibulumcorp..com','195-121 Non, Avenue','Lourdes','Manitoba','R6M 1Z1','Canada','Lacus Vestibulum Corp.','\0'),(63,'Fulton','Webb','1-351-869-5042','Fulton.Webb@loremsemperauctorpc.com','6142 Magna Av.','Tulsa','Oklahoma','69791','United States','Lorem Semper Auctor PC','\0'),(65,'Sonya','Burton','1-499-643-3781','Sonya.Burton@magnanamligulainstitute.com','Ap #867-8016 Sapien. Road','Virginia Beach','Virginia','99484','United States','Magna Nam Ligula Institute','\0'),(66,'Hilel','Acevedo','1-449-414-1875','Hilel.Acevedo@anteipsumlimited.com','Ap #860-176 Dignissim. Road','Charlottetown','PE','C0W 2Z2','Canada','Ante Ipsum Limited','\0'),(67,'Morgana','Bowman','293-9784','Morgana.Bowman@orksinc.com','3534 Ac Rd.','Lavis','Quebec','G4C 8M5','Canada','Orks Incorporated','\0'),(68,'Brooke','Branch','997-8910','Brooke.Branch@fermentummetusaeneanlimited.com','9692 Ac, Ave','Erie','Pennsylvania','72558','United States','Fermentum Metus Aenean Limited','\0'),(69,'Morgan','Barker','1-325-214-8048','Morgan.Barker@nuncrisusassociates.com','691-9406 Quisque Av.','Phoenix','Arizona','85607','United States','Nunc Risus Associates','\0'),(70,'Griffith','Lester','758-5619','Griffith.Lester@vestibulumneceuismodcompany.com','P.O. Box 957, 5785 Cursus. Road','Clearwater Municipal District','Alberta','T4K 5W3','Canada','Vestibulum Nec Euismod Company','\0'),(71,'Rooney','Mccullough','1-340-191-1155','Rooney.Mccullough@necltd.com','P.O. Box 517, 7146 Eu Street','Sachs Harbour','NT','X2X 2B1','Canada','Nec Ltd','\0'),(72,'Shaine','Melendez','1-642-712-6326','Shaine.Melendez@sodalesmaurisblanditcorporation.com','763-9709 Sed Ave','Bloomington','Minnesota','10970','United States','Sodales Mauris Blandit Corporation','\0'),(73,'Curran','Burris','1-761-958-4754','Curran.Burris@maurisnullaltd.com','965-9000 Egestas Road','Helena','Montana','61202','United States','Mauris Nulla Ltd',''),(74,'Colt','Russo','669-0579','Colt.Russo@dapibusquamquisinc..com','P.O. Box 715, 1390 Nec St.','Charlottetown','Prince Edward Island','C8X 5G9','Canada','Dapibus Quam Quis Inc.','\0'),(75,'Ryder','Price','1-383-797-9752','Ryder.Price@vellectuscumindustries.com','8522 Curae; St.','Pangnirtung','Nunavut','X8C 8R2','Canada','Vel Lectus Cum Industries','\0'),(76,'Clio','Peck','421-7713','Clio.Peck@euelitnullaltd.com','627-2924 Dolor Street','Arviat','Nunavut','X2M 1K5','Canada','Eu Elit Nulla Ltd','\0'),(77,'Vaughan','Harper','179-9988','Vaughan.Harper@suspendisseltd.com','Ap #252-1352 Nam St.','Denver','CO','74991','United States','Suspendisse Ltd',''),(79,'Scott','Knight','611-2774','Scott.Knight@neccursusinstitute.com','9338 Fusce Avenue','Harrisburg','PA','47358','United States','Nec Cursus Institute','\0'),(80,'Linus','Little','1-752-276-7282','Linus.Little@etmagnisdisinstitute.com','8287 Consectetuer St.','Fortune','NL','A9P 9Y3','Canada','Et Magnis Dis Institute','\0'),(81,'Alden','Moon','1-393-371-1101','Alden.Moon@egetcorporation.com','6520 Volutpat St.','Augusta','Georgia','40642','United States','Eget Corporation','\0'),(82,'Barclay','Peters','1-207-914-8000','Barclay.Peters@sedcorp..com','321-594 Donec Avenue','Stratford','Prince Edward Island','C0M 5Y6','Canada','Sed Corp.','\0'),(83,'Zeus','Nieves','828-9417','Zeus.Nieves@acmattisornareconsulting.com','5955 Pharetra, Ave','Westmount','QC','G3R 3G5','Canada','Ac Mattis Ornare Consulting','\0'),(84,'Xenos','Glenn','983-3963','Xenos.Glenn@duismienimllp.com','5973 Blandit Road','Bellevue','Nebraska','80824','United States','Duis Mi Enim LLP','\0'),(85,'Tiger','Oneil','565-1155','Tiger.Oneil@orciindustries.com','6733 Pellentesque Street','Berwick','Nova Scotia','B6B 1W4','Canada','Orci Industries','\0'),(86,'Francis','Robertson','1-313-391-2780','Francis.Robertson@egetipsumdonecinstitute.com','Ap #435-4836 Consectetuer Road','Prince Albert','SK','S1Y 6G4','Canada','Eget Ipsum Donec Institute','\0'),(87,'Reagan','Gonzalez','482-0224','Reagan.Gonzalez@molestietortornibhindustries.com','7877 Ut St.','Macklin','Saskatchewan','S4L 6B9','Canada','Molestie Tortor Nibh Industries','\0'),(88,'Rose','Hayes','1-565-518-2818','Rose.Hayes@aliquameratvolutpatlimited.com','P.O. Box 869, 8198 Morbi Ave','Detroit','MI','29437','United States','Aliquam Erat Volutpat Limited','\0'),(89,'Macy','Potts','473-3742','Macy.Potts@innecorciincorporated.com','Ap #794-4318 Interdum Av.','Whitehorse','YT','Y5E 2W5','Canada','In Nec Orci Incorporated','\0'),(90,'Keaton','Blackburn','1-431-535-5181','Keaton.Blackburn@egestaslimited.com','673-8099 Luctus Av.','Castor','Alberta','T3L 6A0','Canada','Egestas Limited','\0'),(92,'Alvin','Hood','494-7918','Alvin.Hood@nonummylimited.com','2578 Non, Avenue','Toledo','Ohio','32844','United States','Nonummy Limited','\0'),(93,'Amanda','Guzman','1-867-806-5842','Amanda.Guzman@maecenascompany.com','Ap #162-7925 Eu Ave','Isle-aux-Coudres','Quebec','J7Z 0W5','Canada','Maecenas Company','\0'),(94,'Helen','Serrano','1-461-822-4930','Helen.Serrano@noncursusnoninc..com','Ap #444-5931 Pede. Street','Gander','NL','A1W 7J4','Canada','Non Cursus Non Inc.','\0'),(95,'Flynn','Mendoza','732-6750','Flynn.Mendoza@egetvariusultricesllp.com','3286 Nascetur Rd.','Topeka','Kansas','55776','United States','Eget Varius Ultrices LLP','\0'),(96,'Lyle','Hull','1-775-437-1995','Lyle.Hull@namllc.com','Ap #763-2842 Tempus Street','Berwick','NS','B9S 8J7','Canada','Nam LLC','\0'),(98,'Bernard','Maddox','1-261-243-9314','Bernard.Maddox@interduminstitute.com','619 Libero St.','Portland','OR','64294','United States','Interdum Institute',''),(99,'Abdul','Gonzalez','938-2923','Abdul.Gonzalez@dignissimcompany.com','4133 Egestas Street','Yorkton','Saskatchewan','S2H 5A4','Canada','Dignissim Company',''),(100,'Glenna','Murphy','856-5158','Glenna.Murphy@nisiaeneanegetllp.com','785-1954 Ac Rd.','Tumbler Ridge','British Columbia','V3J 0P1','Canada','Nisi Aenean Eget LLP','\0'),(101,'Somebody','Somewhere','320-555-5555','somebody.somewhere@email.com','1234 False St','St. Cloud','MN','56303','USA','Programmer Heaven','\0'),(102,'Hikuvar','Blackblade','233-445-0533','Hikuvar.Blackblade@brotherhood.com','1565 Shadow Road','North Lab','Destral','43324','Brotherhood Territory','Brotherhood of Makuta','\0'),(103,'Hikuvar','Blackblade','233-445-0533','Hikuvar.Blackblade@brotherhood.com','1565 Shadow Road','North Lab','Destral','43324','Brotherhood Territory','Brotherhood of Makuta','\0'),(104,'Hikuvar','Blackblade','233-445-0533','Hikuvar.Blackblade@brotherhood.com','1565 Shadow Road','North Lab','Destral','43324','Brotherhood Territory','Brotherhood of Makuta','\0'),(105,'Hikuvarius','Blackblade','233-445-0533','Hikuvar.Blackblade@brotherhood.com','1565 Shadow Road','North Lab','Destral','43324','Brotherhood Territory','Brotherhood of Makuta','\0'),(106,'Somebody','Somewhere','320-244-4444','Lex.Luthor@lexcorp.com','','','','',NULL,'','\0'),(107,'Somebody','Somewhere','320-244-4444','Lex.Luthor@liberocompany.com','1565 Shadow Road','Destral','New York','44323',NULL,'Something','\0'),(108,'Somebody','aaa','','Alova.Alvara@charter.com','','','','',NULL,'','\0'),(109,'Somebody','Somewhere','','b@g.com','','','','',NULL,'','\0'),(110,'Somebody','Somewhere','','b@g.com','','','','',NULL,'','\0');
/*!40000 ALTER TABLE `cms_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_contact_categories`
--

DROP TABLE IF EXISTS `cms_contact_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_contact_categories` (
  `cms_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`cms_cat_id`),
  KEY `fk_cms_contact_idx` (`cms_id`),
  KEY `fk_cms_categories_idx` (`cat_id`),
  CONSTRAINT `fk_cms_categories` FOREIGN KEY (`cat_id`) REFERENCES `cms_cat` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cms_contact` FOREIGN KEY (`cms_id`) REFERENCES `cms_contact` (`cms_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_contact_categories`
--

LOCK TABLES `cms_contact_categories` WRITE;
/*!40000 ALTER TABLE `cms_contact_categories` DISABLE KEYS */;
INSERT INTO `cms_contact_categories` VALUES (1,1,8),(2,2,8),(3,3,9),(4,4,4),(5,5,5),(6,6,8),(7,7,7),(8,8,2),(10,10,7),(11,11,9),(12,12,7),(13,13,2),(14,14,7),(15,15,9),(19,19,5),(20,20,1),(23,23,5),(24,24,7),(26,26,7),(27,27,9),(31,31,4),(32,32,6),(34,34,6),(35,35,7),(36,36,5),(37,37,4),(38,38,6),(39,39,9),(40,40,8),(41,41,1),(42,42,7),(43,43,6),(44,44,1),(45,45,8),(46,46,1),(49,49,7),(50,50,5),(53,53,4),(55,55,4),(57,57,4),(59,59,2),(60,60,7),(62,62,1),(63,63,9),(69,69,9),(70,70,8),(71,71,8),(73,73,7),(74,74,1),(75,75,2),(76,76,2),(77,77,4),(79,79,2),(80,80,8),(81,81,8),(82,82,4),(83,83,7),(84,84,6),(85,85,9),(86,86,4),(87,87,5),(89,89,2),(90,90,1),(92,92,9),(93,93,8),(94,94,2),(98,98,7),(99,99,6),(103,3,7),(104,4,2),(105,5,1),(106,6,9),(107,7,1),(109,9,5),(112,12,4),(113,13,5),(115,15,8),(116,16,8),(118,18,8),(119,19,9),(120,20,9),(122,22,6),(123,23,7),(125,25,5),(127,27,6),(131,31,7),(134,34,1),(136,36,9),(137,37,6),(138,38,9),(139,39,4),(140,40,5),(141,41,9),(143,43,1),(144,44,9),(145,45,9),(146,46,8),(147,47,8),(148,48,2),(149,49,9),(150,50,7),(151,51,9),(152,52,1),(153,53,6),(154,54,2),(155,55,6),(156,56,2),(158,58,9),(159,59,5),(160,60,5),(161,61,2),(163,63,7),(170,70,7),(171,71,9),(172,72,2),(174,74,9),(175,75,6),(176,76,6),(177,77,2),(179,79,7),(180,80,2),(181,81,9),(182,82,8),(185,85,4),(186,86,5),(188,88,2),(189,89,7),(192,92,2),(193,93,1),(194,94,6),(195,95,6),(196,96,2),(199,99,2),(200,100,8),(220,68,6),(221,68,4),(270,30,2),(271,30,4),(272,67,1),(274,67,2),(275,67,5),(276,29,9),(277,29,4),(279,21,9),(280,21,6),(281,21,7),(285,28,6),(286,17,1),(291,105,6),(292,105,4);
/*!40000 ALTER TABLE `cms_contact_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-11 16:12:42
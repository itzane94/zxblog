-- MySQL dump 10.13  Distrib 5.6.39, for Linux (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.6.39

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gravatar` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/images/placeholder.png',
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autograph` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'itzane','itzane@163.com','/upload/20180728/kruDaFYrFpd8L4WHNJqP22KznM8pxB9P3ZIoegmg.jpeg','$2y$10$lbQC3A8DMPRN.zRsGN0BdOOM9PLgX7NCmM4PiF0RzPwJKVQYxfnB6','我们的世界值得我们为之而奋斗！','sUMlT1EGRCU33nLsQmw0z91MvVgcjUgAXJGtHtH7UKz0jnyElRszgitndVVa','2018-03-30 16:38:20','2018-03-30 16:38:20','开发小白，努力学习中，我是最胖的～'),(2,'Jarret Bode DDS','celestine.roberts@example.org','/images/placeholder.png','$2y$10$wsrjjVpF6d/dZ6K8Z03SA.o72Mz9gGP5LPWGSJGTleKLsH1QLJisS',NULL,'LvqRkCrOmM','2018-04-12 19:18:37','2018-04-12 19:18:37',NULL),(3,'Jessy Runolfsson IV','gulgowski.maudie@example.net','/images/placeholder.png','$2y$10$wsrjjVpF6d/dZ6K8Z03SA.o72Mz9gGP5LPWGSJGTleKLsH1QLJisS',NULL,'P6ilPULUQp','2018-04-12 19:18:37','2018-04-12 19:18:37',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `display` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'php session 的GC机制',2,'php的session默认有效期是24分钟（1440s），如果客户端超过24分钟没有刷新，session就应当会被回收，失效。用户关闭浏览器，会话结束，session也应当失效。但是事实情况往往并非如此！\n\n首先谈谈关于session gc的基本设置。\nsession的生命周期可以通过session.gc_maxlifetime来设置。\nphp中session的默认存储方式是文件，可以通过php.ini中session.save_handler来设置，使用文件进行存储时，默认的存储位置为/var/lib/php/session(ubuntu系统)，也可通过session.save_path自行修改存储位置。\n\n注释：phpini中对于配置session.save_path同时给出这种方式：session.save_path = \"N;MODE;/tmp\"\n其中，N表示多级目录，值为数字。MODE表示创建session文件权限。/tmp表示session存储路径。官方给出如下解释性说明：\n\n此指令还有一个可选的 N 参数来决定会话文件分布的目录深度。 例如，设定为 \'5;/tmp\' 将使创建的会话文件和路径类似于 /tmp/4/b/1/e/3/sess_4b1e384ad74619bd212e236e52a5a174If。 要使用 N 参数，必须在使用前先创建好这些目录。 在 ext/session 目录下有个小的 shell 脚本名叫 mod_files.sh，windows 版本是 mod_files.bat 可以用来做这件事。 此外注意如果使用了 N 参数并且大于 0，那么将不会执行自动垃圾回收，更多信息见 php.ini。 另外如果用了 N 参数，要确保将 session.save_path 的值用双引号 \"quotes\" 括起来，因为分隔符分号（ ;）在 php.ini 中也是注释符号。 文件储存模块默认使用 mode 600 创建文件。 通过 修改可选参数 MODE 来改变这种默认行为： N;MODE;/path ，其中 MODE 是 mode 的八进制表示。 MODE 设置不影响进程的掩码(umask)。 Caution：使用以上描述的可选目录层级参数 N 时请注意，对于绝大多数站点， 大于1或者2的值会不太合适——因为这需要创建大量的目录：例如，值设置为 3 需要在文件系统上创建 64^3 个目录，将浪费很多空间和 inode。 仅仅在绝对肯定站点足够大时，才可以设置 N 大于2。\n\n除此之外，与session有关的还有一个比较重要的，那就是session.cookie_lifetime，这是设置存储phpsessionID所使用的cookie生命周期，默认时间是0，所以用户关闭浏览器，session就失效了，其实是用来存储phpsessionID的cookie失效了！\n那么接下来就简单讨论下session的GC机制。\n\n第一种方式，用户可以通过修改php.ini中session.gc_probability和session.gc_divisor来设置php session的回收概率，默认情况下是1和100，也就是说当用户使用session_start()时，会执行这种回收机制，回收概率是1/100。不过，从性能的角度讲，不建议将这个比率设置过大。\n\n另一种方式在ubuntu下，通过外部的cron进程来完成gc的回收，可以在/etc/cron.d/php中查看\n```\nvi /etc/cron.d/php \n# Look for and purge old sessions every 30 minutes\n09,39 * * * * root [ -x /usr/lib/php/sessionclean ] && if [ ! -d /run/systemd/system ]; then /usr/lib/php/sessionclean; fi\n\n```\n除此之外，用户也可以通过程序的方式清除session\n```\nsession_destory()\nunset();\n```\n对于如何设置一个严格30分钟过期的session，鸟哥有给出完美的答案，可供参考学习。\n附上链接地址：[风雪之隅](http://www.laruence.com/2012/01/10/2469.html)',1,1,'2018-07-28 08:46:47','2018-07-28 08:49:13');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `site` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'itzane','itzane@163.com','www.itzane.com','把typecho博文搬到这来了。QAQ，自己写的博客系统惹～','2018-07-28 09:16:02','2018-07-28 09:16:02');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_03_31_081600_create_admins_table',2),(4,'2018_04_03_070954_create_articles_table',3),(5,'2018_04_03_072424_alter_articles_table',4),(6,'2018_04_03_081139_create_types_table',5),(7,'2018_04_11_084522_alter_articles_table',6),(8,'2018_04_13_111334_create_tags_table',7),(9,'2018_04_13_145606_create_tag_article_table',8),(10,'2018_04_15_031402_create_comments_table',9),(11,'2018_07_14_133819_create_tips_table',10),(12,'2018_07_14_135050_alter_tips_table',11),(13,'2018_07_15_100113_alter_tips_table',12),(14,'2018_07_21_161519_alter_articles_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_article`
--

DROP TABLE IF EXISTS `tag_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_article`
--

LOCK TABLES `tag_article` WRITE;
/*!40000 ALTER TABLE `tag_article` DISABLE KEYS */;
INSERT INTO `tag_article` VALUES (1,1,2,'2018-07-28 08:46:48','2018-07-28 08:46:48');
/*!40000 ALTER TABLE `tag_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'前端',NULL,'2018-07-28 08:40:05'),(2,'PHP',NULL,'2018-04-12 22:33:16'),(3,'云计算',NULL,NULL),(4,'区块链',NULL,NULL),(5,'机器学习',NULL,NULL),(6,'swoole','2018-04-12 21:07:10','2018-04-12 21:07:10'),(12,'MySQL','2018-04-12 22:33:34','2018-07-28 08:40:23'),(13,'笔记','2018-04-15 15:52:49','2018-07-28 08:40:36');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tips`
--

DROP TABLE IF EXISTS `tips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wisdom` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `author` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tips`
--

LOCK TABLES `tips` WRITE;
/*!40000 ALTER TABLE `tips` DISABLE KEYS */;
INSERT INTO `tips` VALUES (1,'What\'s in a name? That which we call a rose By any other name would smell as sweet.','William Shakespeare','2018-07-14 16:48:28','2018-07-14 18:16:49'),(2,'你的时间有限，所以不要为别人而活。不要被教条所限，不要活在别人的观念里。不要让别人的意见左右自己内心的声音。最重要的是，勇敢的去追随自己的心灵和直觉，只有自己的心灵和直觉才知道你自己的真实想法，其他一切都是次要。','乔布斯','2018-07-14 16:48:32','2018-07-28 08:56:29'),(5,'我认出风暴而激动如大海','里克尔','2018-07-14 18:28:10','2018-07-28 08:54:04');
/*!40000 ALTER TABLE `tips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Life&',0,'2018-04-02 08:00:00','2018-04-02 08:00:00'),(2,'PHP',0,NULL,NULL),(3,'前端',0,'2018-04-05 08:00:00','2018-04-05 08:00:00'),(4,'JavaScript',3,'2018-04-05 08:00:00','2018-04-06 08:00:00'),(5,'生活感悟',1,'2018-04-12 15:27:01','2018-04-12 15:54:36'),(6,'laravel',2,'2018-04-12 15:30:00','2018-04-12 15:30:00'),(7,'swoole',2,'2018-04-12 15:30:42','2018-04-12 15:30:42'),(8,'vue.js',3,'2018-04-12 15:31:01','2018-04-12 15:31:01'),(9,'JQuery',3,'2018-04-12 15:45:49','2018-04-12 15:45:49');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'itzane','itzane@163.com','$2y$10$jbjOmux7DE5WemGzQ2BekuHbhtuhKfegpxuCh/MGfZlM0FBVUlQae','6UTNHnqUQNiUrVMIMtfitXqr0lMOsQOy8C2x9Sm1cglEKD5uiFkNyBl2sLAe','2018-03-30 15:18:53','2018-03-30 15:18:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-29  9:33:13

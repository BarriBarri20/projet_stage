-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.23 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table symgent.blog_post : ~0 rows (environ)

-- Listage des données de la table symgent.blog_post_categorie : ~0 rows (environ)

-- Listage des données de la table symgent.categorie : ~0 rows (environ)

-- Listage des données de la table symgent.historique : ~0 rows (environ)

-- Listage des données de la table symgent.migration_versions : ~1 rows (environ)
INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
	('20200729123337', '2023-02-08 12:23:57');

-- Listage des données de la table symgent.old_post : ~0 rows (environ)

-- Listage des données de la table symgent.old_post_categorie : ~0 rows (environ)

-- Listage des données de la table symgent.reset_password_request : ~0 rows (environ)

-- Listage des données de la table symgent.role : ~4 rows (environ)
INSERT INTO `role` (`id`, `role_name`, `libelle`) VALUES
	(5, 'ROLE_SUPERUSER', 'Super Admin'),
	(6, 'ROLE_EDITORIAL', 'Manager'),
	(7, 'ROLE_ADMINISTRATOR', 'Admin'),
	(8, 'ROLE_WRITER', 'Redacteur');

-- Listage des données de la table symgent.user : ~1 rows (environ)
INSERT INTO `user` (`id`, `username`, `roles`, `nom_complet`, `email`, `valid`, `deleted`, `password`, `admin`) VALUES
	(1, 'admin', '["ROLE_SUPERUSER"]', 'Admin', 'admin@example.com', 1, 0, '$argon2id$v=19$m=65536,t=4,p=1$VXd6STBHelBWUFNBTlRpdw$/DTecOjn9/Sf7ZqmKWJWxi4qDjsEmXUvLVmi/d/diIs', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

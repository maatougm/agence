-- Création de la base de données (si nécessaire)
CREATE DATABASE IF NOT EXISTS `agence_de_voyage` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `gence_de_voyage`;

-- Table `admins`
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
    `id_admin` INT PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('superadmin', 'editeur') DEFAULT 'editeur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `client` (fusion de client et users)
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
    `id_client` INT PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `numtel` VARCHAR(20) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'client') DEFAULT 'client',
    `status` ENUM('actif', 'inactif') DEFAULT 'actif',
    `date_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `destinations`
DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
    `id_destination` INT PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(100) NOT NULL,
    `pays` VARCHAR(50) NOT NULL,
    `description` TEXT,
    `prix` DECIMAL(10,2) NOT NULL,
    `id_admin` INT NOT NULL,
    FOREIGN KEY (`id_admin`) REFERENCES `admins`(`id_admin`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `vols`
DROP TABLE IF EXISTS `vols`;
CREATE TABLE `vols` (
    `id_vol` INT PRIMARY KEY AUTO_INCREMENT,
    `compagnie` VARCHAR(50) NOT NULL,
    `numero_vol` VARCHAR(20) UNIQUE NOT NULL,
    `ville_depart` VARCHAR(50) NOT NULL,
    `ville_arrivee` VARCHAR(50) NOT NULL,
    `date_depart` DATETIME NOT NULL,
    `date_arrivee` DATETIME NOT NULL,
    `places` INT NOT NULL,
    `prix` DECIMAL(10,2) NOT NULL,
    `id_destination` INT NOT NULL,
    `id_admin` INT NOT NULL,
    FOREIGN KEY (`id_destination`) REFERENCES `destinations`(`id_destination`) ON DELETE CASCADE,
    FOREIGN KEY (`id_admin`) REFERENCES `admins`(`id_admin`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table `reservation`
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
    `id_reservation` INT PRIMARY KEY AUTO_INCREMENT,
    `id_client` INT NOT NULL,
    `id_destination` INT NOT NULL,
    `id_vol_aller` INT,
    `id_vol_retour` INT,
    `datedepart` DATE NOT NULL,
    `dateretour` DATE NOT NULL,
    `nbvoyageurs` INT NOT NULL,
    `prixtotal` DECIMAL(10,2) NOT NULL,
    `statut` ENUM('confirmée', 'en_attente', 'annulée') DEFAULT 'en_attente',
    `date_reservation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`id_client`) REFERENCES `client`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_destination`) REFERENCES `destinations`(`id_destination`) ON DELETE CASCADE,
    FOREIGN KEY (`id_vol_aller`) REFERENCES `vols`(`id_vol`) ON DELETE SET NULL,
    FOREIGN KEY (`id_vol_retour`) REFERENCES `vols`(`id_vol`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--- 1. Table admins (avec IDs explicites)
INSERT INTO `admins` (`id_admin`, `nom`, `email`, `password`, `role`) VALUES

(1, 'Admin Principal', 'admin@exploremonde.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin'),
(2, 'Editeur Voyages', 'editeur@exploremonde.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editeur');

ALTER TABLE `admins` AUTO_INCREMENT = 3;

-- 2. Table destinations (avec référence aux admins)
INSERT INTO `destinations` (`id_destination`, `nom`, `pays`, `description`, `prix`, `id_admin`) VALUES
(1, 'Paris Tour', 'France', 'Découvrez la ville lumière avec ses monuments emblématiques', 1200.00, 1),
(2, 'New York Adventure', 'USA', 'Visite de la grande pomme et ses attractions célèbres', 2500.00, 1),
(3, 'Tokyo Discovery', 'Japon', 'Expérience culturelle unique dans la capitale japonaise', 3000.00, 2),
(4, 'Bali Relax', 'Indonésie', 'Détente sur les plages paradisiaques de Bali', 1800.00, 2),
(5, 'Rome Antique', 'Italie', 'Voyage à travers lhistoire de la Rome antique', 1500.00, 1);

ALTER TABLE `destinations` AUTO_INCREMENT = 6;

-- 3. Table vols (avec référence aux destinations et admins)
INSERT INTO `vols` (`id_vol`, `compagnie`, `numero_vol`, `ville_depart`, `ville_arrivee`, `date_depart`, `date_arrivee`, `places`, `prix`, `id_destination`, `id_admin`) VALUES
(1, 'Air France', 'AF123', 'Tunis', 'Paris', '2023-12-01 08:00:00', '2023-12-01 11:30:00', 150, 450.00, 1, 1),
(2, 'Emirates', 'EK456', 'Tunis', 'New York', '2023-12-05 10:00:00', '2023-12-05 18:30:00', 200, 1200.00, 2, 1),
(3, 'Japan Airlines', 'JL789', 'Tunis', 'Tokyo', '2023-12-10 14:00:00', '2023-12-11 08:00:00', 180, 1500.00, 3, 2),
(4, 'Qatar Airways', 'QR321', 'Tunis', 'Bali', '2023-12-15 22:00:00', '2023-12-16 16:00:00', 170, 1300.00, 4, 2),
(5, 'Alitalia', 'AZ654', 'Tunis', 'Rome', '2023-12-20 07:00:00', '2023-12-20 09:30:00', 160, 350.00, 5, 1);

ALTER TABLE `vols` AUTO_INCREMENT = 6;

-- 4. Table client 
INSERT INTO `client` (`id_client`, `nom`, `prenom`, `email`, `numtel`, `password`, `role`, `status`) VALUES
(1, 'ayadi', 'meriam', 'mariemayadi@gmail.com', '20145163', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(2, 'souilhi', 'shadi', 'souilhishadi@gmail.com', '90145236', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(3, 'ahmed', 'khalli', 'ahmedkhalli@gmail.com', '50123698', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(4, 'ayari', 'rania', 'raniaayari@gmail.com', '20145789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(5, 'ben hmida', 'selim', 'selimbenhmida@gmail.com', '21456789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(6, 'ben mahmoud', 'mourad', 'mourad@gmail.com', '90789600', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(7, 'ben jemaaa', 'mohamed amine', 'mohamedamine@gmail.com', '90789601', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(8, 'grami', 'manel', 'manel@gmail.com', '98456123', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif'),
(9, 'ben salah', 'rami', 'rami@gmail.com', '90789601', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', 'actif');

ALTER TABLE `client` AUTO_INCREMENT = 10;

-- 5. Table reservation (avec référence aux clients, destinations et vols)
INSERT INTO `reservation` (`id_reservation`, `id_client`, `id_destination`, `id_vol_aller`, `id_vol_retour`, `datedepart`, `dateretour`, `nbvoyageurs`, `prixtotal`, `statut`) VALUES
(1, 1, 1, 1, NULL, '2023-12-01', '2023-12-08', 2, 2400.00, 'confirmée'),
(2, 2, 2, 2, NULL, '2023-12-05', '2023-12-15', 1, 2500.00, 'confirmée'),
(3, 3, 3, 3, NULL, '2023-12-10', '2023-12-20', 3, 9000.00, 'en_attente'),
(4, 4, 4, 4, NULL, '2023-12-15', '2023-12-25', 2, 3600.00, 'confirmée'),
(5, 5, 5, 5, NULL, '2023-12-20', '2023-12-27', 4, 6000.00, 'annulée');

ALTER TABLE `reservation` AUTO_INCREMENT = 6;
-- ============================================
-- GOOGLE VISION PROVIDER VERIFICATION SETUP
-- ============================================
-- Fichier SQL pour import direct dans phpMyAdmin (cPanel O2Switch)
-- Compatible MySQL 5.7+ / MariaDB 10.2+
-- ============================================

-- ============================================
-- 1. TABLE: provider_document_verifications
-- ============================================

CREATE TABLE IF NOT EXISTS `provider_document_verifications` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `document_type` ENUM('passport', 'license', 'european_id') NOT NULL,
  `document_side` ENUM('front', 'back') NULL DEFAULT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `verification_status` ENUM('pending', 'processing', 'verified', 'rejected', 'error') NOT NULL DEFAULT 'pending',
  `confidence_score` INT NULL DEFAULT NULL,
  `detected_text` TEXT NULL DEFAULT NULL,
  `detected_labels` JSON NULL DEFAULT NULL,
  `google_response` JSON NULL DEFAULT NULL,
  `rejection_reason` TEXT NULL DEFAULT NULL,
  `retry_count` INT NOT NULL DEFAULT 0,
  `verified_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_user_document` (`user_id`, `document_type`),
  INDEX `idx_verification_status` (`verification_status`),
  CONSTRAINT `fk_provider_document_verifications_user_id` 
    FOREIGN KEY (`user_id`) 
    REFERENCES `users` (`id`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. TABLE users: Ajout colonnes Google Vision
-- ============================================

ALTER TABLE `users` 
  ADD COLUMN IF NOT EXISTS `profile_photo_path` VARCHAR(255) NULL DEFAULT NULL AFTER `email`,
  ADD COLUMN IF NOT EXISTS `profile_photo_verified` BOOLEAN NOT NULL DEFAULT FALSE AFTER `profile_photo_path`,
  ADD COLUMN IF NOT EXISTS `profile_photo_verification_data` JSON NULL DEFAULT NULL AFTER `profile_photo_verified`,
  ADD COLUMN IF NOT EXISTS `profile_photo_rejection_reason` TEXT NULL DEFAULT NULL AFTER `profile_photo_verification_data`,
  ADD COLUMN IF NOT EXISTS `identity_verified` BOOLEAN NOT NULL DEFAULT FALSE AFTER `profile_photo_rejection_reason`,
  ADD COLUMN IF NOT EXISTS `identity_verified_at` TIMESTAMP NULL DEFAULT NULL AFTER `identity_verified`;

-- Note: Si "ADD COLUMN IF NOT EXISTS" ne fonctionne pas sur ta version MySQL,
-- utilise les commandes ci-dessous à la place (décommente-les):

-- ALTER TABLE `users` ADD COLUMN `profile_photo_path` VARCHAR(255) NULL DEFAULT NULL AFTER `email`;
-- ALTER TABLE `users` ADD COLUMN `profile_photo_verified` BOOLEAN NOT NULL DEFAULT FALSE AFTER `profile_photo_path`;
-- ALTER TABLE `users` ADD COLUMN `profile_photo_verification_data` JSON NULL DEFAULT NULL AFTER `profile_photo_verified`;
-- ALTER TABLE `users` ADD COLUMN `profile_photo_rejection_reason` TEXT NULL DEFAULT NULL AFTER `profile_photo_verification_data`;
-- ALTER TABLE `users` ADD COLUMN `identity_verified` BOOLEAN NOT NULL DEFAULT FALSE AFTER `profile_photo_rejection_reason`;
-- ALTER TABLE `users` ADD COLUMN `identity_verified_at` TIMESTAMP NULL DEFAULT NULL AFTER `identity_verified`;

-- ============================================
-- 3. TABLE: jobs (Laravel Queue)
-- ============================================

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_queue` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 4. TABLE: failed_jobs (Laravel Queue)
-- ============================================

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL UNIQUE,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- FIN DU SETUP
-- ============================================
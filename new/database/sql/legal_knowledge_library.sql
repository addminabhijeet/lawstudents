-- =====================================================================
-- "Legal Knowledge" library feature (Rules-style browsing/PDF library)
-- Same structure/behaviour as the existing Rules feature
-- (rules / rule_categories / rule_subcategories), namespaced under its
-- own tables. Running this does NOT touch the rules tables, nor the
-- existing legal-knowledge inquiry-form feature/tables.
-- =====================================================================

-- --------------------------------------------------------
-- Table: legal_knowledge_categories  (mirrors rule_categories)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `legal_knowledge_categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `delete` TINYINT NOT NULL DEFAULT 1 COMMENT '1 = visible, 0 = soft-deleted',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: legal_knowledge_subcategories  (mirrors rule_subcategories)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `legal_knowledge_subcategories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `legal_knowledge_category_id` BIGINT UNSIGNED NOT NULL,
  `delete` TINYINT NOT NULL DEFAULT 1 COMMENT '1 = visible, 0 = soft-deleted',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lk_subcategories_category_id` (`legal_knowledge_category_id`),
  CONSTRAINT `fk_lk_subcategories_category_id`
    FOREIGN KEY (`legal_knowledge_category_id`) REFERENCES `legal_knowledge_categories` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: legal_knowledge_notes  (mirrors rules)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `legal_knowledge_notes` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` BIGINT UNSIGNED NOT NULL,
  `subcategory_id` BIGINT UNSIGNED NOT NULL,
  `description` TEXT NULL,
  `pdfs` JSON NULL COMMENT 'array of stored PDF paths, same convention as rules.pdfs',
  `delete` TINYINT NOT NULL DEFAULT 1 COMMENT '1 = visible, 0 = soft-deleted',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `legal_knowledge_notes_category_id_foreign` (`category_id`),
  KEY `legal_knowledge_notes_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `legal_knowledge_notes_category_id_foreign`
    FOREIGN KEY (`category_id`) REFERENCES `legal_knowledge_categories` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `legal_knowledge_notes_subcategory_id_foreign`
    FOREIGN KEY (`subcategory_id`) REFERENCES `legal_knowledge_subcategories` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

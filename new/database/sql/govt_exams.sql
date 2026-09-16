-- =====================================================================
-- "Centre & State Govt. Examination" feature
-- Same structure/behaviour as the existing Rules feature
-- (rules / rule_categories / rule_subcategories), namespaced under its
-- own tables. Running this does NOT touch the rules tables.
-- =====================================================================

-- --------------------------------------------------------
-- Table: govt_exam_categories  (mirrors rule_categories)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `govt_exam_categories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `delete` TINYINT NOT NULL DEFAULT 1 COMMENT '1 = visible, 0 = soft-deleted',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: govt_exam_subcategories  (mirrors rule_subcategories)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `govt_exam_subcategories` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `govt_exam_category_id` BIGINT UNSIGNED NOT NULL,
  `delete` TINYINT NOT NULL DEFAULT 1 COMMENT '1 = visible, 0 = soft-deleted',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `govt_exam_subcategories_govt_exam_category_id_foreign` (`govt_exam_category_id`),
  CONSTRAINT `govt_exam_subcategories_govt_exam_category_id_foreign`
    FOREIGN KEY (`govt_exam_category_id`) REFERENCES `govt_exam_categories` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: govt_exams  (mirrors rules)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `govt_exams` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` BIGINT UNSIGNED NOT NULL,
  `subcategory_id` BIGINT UNSIGNED NOT NULL,
  `description` TEXT NULL,
  `pdfs` JSON NULL COMMENT 'array of stored PDF paths, same convention as rules.pdfs',
  `delete` TINYINT NOT NULL DEFAULT 1 COMMENT '1 = visible, 0 = soft-deleted',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `govt_exams_category_id_foreign` (`category_id`),
  KEY `govt_exams_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `govt_exams_category_id_foreign`
    FOREIGN KEY (`category_id`) REFERENCES `govt_exam_categories` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `govt_exams_subcategory_id_foreign`
    FOREIGN KEY (`subcategory_id`) REFERENCES `govt_exam_subcategories` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

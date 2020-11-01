-- Skyfallen TES API
-- SFR-A9IXXX
-- https://tokenexchange.theskyfallen.com
--

CREATE TABLE `token` (
  `token` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `command` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `creation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expire` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `token`
  ADD UNIQUE KEY `token` (`token`);
COMMIT;
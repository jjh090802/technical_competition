-- C 모듈 데이터베이스 (phpMyAdmin 가져오기 또는 mysql -uroot < schema.sql)
CREATE DATABASE IF NOT EXISTS c_module DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE c_module;

-- 회원·전문가 (type 으로 구분)
CREATE TABLE IF NOT EXISTS users (
  idx      INT NOT NULL AUTO_INCREMENT,
  userid   VARCHAR(50)  NOT NULL,
  password VARCHAR(255) NOT NULL,
  name     VARCHAR(50)  NOT NULL,
  photo    VARCHAR(255) NOT NULL,
  type     ENUM('user','specialist') NOT NULL DEFAULT 'user',
  PRIMARY KEY (idx),
  UNIQUE KEY userid (userid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 온라인 집들이
CREATE TABLE IF NOT EXISTS housewarming (
  idx        INT NOT NULL AUTO_INCREMENT,
  user_idx   INT NOT NULL,
  before_img VARCHAR(255) NOT NULL,
  after_img  VARCHAR(255) NOT NULL,
  knowhow    TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 집들이 평점 (한 회원이 한 글에 한 번)
CREATE TABLE IF NOT EXISTS housewarming_rating (
  idx      INT NOT NULL AUTO_INCREMENT,
  post_idx INT NOT NULL,
  user_idx INT NOT NULL,
  score    TINYINT NOT NULL,
  PRIMARY KEY (idx),
  UNIQUE KEY post_idx (post_idx, user_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 시공 후기
CREATE TABLE IF NOT EXISTS review (
  idx            INT NOT NULL AUTO_INCREMENT,
  specialist_idx INT NOT NULL,
  writer_idx     INT NOT NULL,
  cost           INT NOT NULL,
  content        TEXT NOT NULL,
  score          TINYINT NOT NULL,
  created_at     DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 견적 요청 (selected_idx 가 비어 있으면 진행 중)
CREATE TABLE IF NOT EXISTS estimate_request (
  idx          INT NOT NULL AUTO_INCREMENT,
  user_idx     INT NOT NULL,
  work_date    DATE NOT NULL,
  content      TEXT NOT NULL,
  selected_idx INT DEFAULT NULL,
  created_at   DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 견적 (요청마다 전문가 한 번)
CREATE TABLE IF NOT EXISTS estimate (
  idx            INT NOT NULL AUTO_INCREMENT,
  request_idx    INT NOT NULL,
  specialist_idx INT NOT NULL,
  cost           INT NOT NULL,
  created_at     DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (idx),
  UNIQUE KEY request_idx (request_idx, specialist_idx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 전문가 4명 (비밀번호 1234)
INSERT IGNORE INTO users (userid, password, name, photo, type) VALUES
  ('specialist1', '1234', '전문가1', 'specialist1.jpg', 'specialist'),
  ('specialist2', '1234', '전문가2', 'specialist2.jpg', 'specialist'),
  ('specialist3', '1234', '전문가3', 'specialist3.jpg', 'specialist'),
  ('specialist4', '1234', '전문가4', 'specialist4.jpg', 'specialist');

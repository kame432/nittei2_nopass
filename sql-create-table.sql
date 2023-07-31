-- 参加者
-- 入力を受けて入れていく
CREATE TABLE participant (
  -- 自動採番
  id INT AUTO_INCREMENT,
  names VARCHAR(30) NOT NULL,
  affiliation VARCHAR(50) NOT NULL,
  school_year INT(1),
  PRIMARY KEY (id)
);

-- 調整
CREATE TABLE schedule (
  -- 自動採番
  id INT AUTO_INCREMENT,
  participant_id INT,
  daytime_id VARCHAR(8),
  -- 外部キー参照
  FOREIGN KEY (participant_id)
    REFERENCES participant (id), 
  FOREIGN KEY (daytime_id)
    REFERENCES daytime (id),
  PRIMARY KEY (id)
);

-- 日程
-- 値は最初から入れておく
-- 入力を受けて、countだけを増やしていく
CREATE TABLE daytime (
  -- ペアが分かりやすいように、自動採番にはしない。
  id VARCHAR(8) NOT NULL,
  -- id VARCHAR(7) NOT NULL,
  day_of_week VARCHAR(3) NOT NULL,
  -- 文字として時間を入れておく
  start_end VARCHAR(10) NOT NULL,
  count INT NOT NULL,
  PRIMARY KEY (id)
);






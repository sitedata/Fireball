-- 3.0.0 Beta 2
ALTER TABLE cms1_content CHANGE position position VARCHAR(255) NOT NULL;
ALTER TABLE cms1_page ADD COLUMN wcfPageID INT(10);

ALTER TABLE cms1_page ADD FOREIGN KEY (wcfPageID) REFERENCES wcf1_page (pageID) ON DELETE SET NULL;
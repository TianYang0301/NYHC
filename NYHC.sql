create database NYHC;
use NYHC;

CREATE TABLE NYHCAdmin
(
adminID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
adminPassword VARCHAR(128)
);

INSERT INTO NYHCAdmin VALUES('1995', 'admin');


CREATE TABLE NYHCUser /*ID - 10000001-99999999*/
(
userID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
userName VARCHAR(128),
userEmail VARCHAR(128),
userSex VARCHAR(128),
userPassword VARCHAR(128),
userRegisterDate DATE,
userPoint INT,
userLevel INT,
userExp INT
);

INSERT INTO NYHCUser VALUES(20190301, 'Tian Yang', 'tianyang0301@163.com', 'Female', 'ty20190301', '2019-03-01', 1245, 2, 1857);

ALTER TABLE NYHCUser ADD userBackground VARCHAR(255) NOT NULL;
ALTER TABLE NYHCUser ADD userImg VARCHAR(255) NOT NULL;
ALTER TABLE NYHCUser ADD userCard VARCHAR(255) NOT NULL;
ALTER TABLE NYHCUser ADD user_draw_num INT;
ALTER TABLE NYHCUser ADD user_bit_num INT;


CREATE TABLE NYHCUserRecord
(
userID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
userRound INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
GMID INT,
userPointEarn INT,
userCardNo INT,
userLevelExp INT
);

INSERT INTO NYHCUserRecord(301, 1, 1001, 18, 19, 121);


CREATE TABLE NYHCGameMode /*ID - 1001-1999*/
(
GMID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
GMName VARCHAR(128),
GMCardNo INT,
GMLevel INT,
GMPlayer INT,
GMPointLimit INT,
GMDescription VARCHAR(128)
);

INSERT INTO NYHCGameMode VALUES(1001,'Guess Updown', 48, 1, 1, 200, 'guess_point.php');
INSERT INTO NYHCGameMode VALUES(1002,'Five King', 54, 1, 1, 200, 'five_king.php');

CREATE TABLE NYHCReward /*ID - 2001-2999*/
(
rewardID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
rewardName VARCHAR(128),
rewardStartDate DATE,
rewardLastDate DATE,
rewardCondition INT(1), /*1 = No Condition, 2 = Play 1 mode, 3 = Earn/Use 100 Point, 4 = Improve Level*/
rewardQuatity INT(10),
rewardStatus VARCHAR(128)
);

INSERT INTO NYHCReward VALUES(2001,'Day Login In', '2019-01-01', '2099-12-31', 1, 188, 'on');


CREATE TABLE NYHCPointRedemption /*ID - 3001-3999*/
(
pointID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
pointName VARCHAR(128),
pointStartDate DATE,
pointLastDate DATE,
pointCondition INT(1), /*1 = No Level Limit, 2 = Level 5-9, 3 = Level 10-19, 4 = Level 20-99*/
unlockType INT(1), /*1 = Game Mode, 2 = Background, 3 = Card Style*/
pointQuatity INT(10)
);

INSERT INTO NYHCPointRedemption VALUES(3001,'Fishing', '2019-01-01', '2099-12-31', 1, 1, 688);
INSERT INTO NYHCPointRedemption VALUES(3002,'Background_1', '2021-09-01', '2021-12-31', 1, 2, 888);
ALTER TABLE NYHCPointRedemption ADD pointLink VARCHAR(255) NOT NULL;
ALTER TABLE NYHCPointRedemption DROP COLUMN GameFont;

CREATE TABLE NYHCCard /*ID - 4001-4999*/
(
cardID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
cardName VARCHAR(128),
cardPicture varchar(255) NOT NULL
);


CREATE TABLE NYHCBackground /*ID - 5001-5999*/
(
backgroundID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
backgroundName VARCHAR(128),
backgroundPicture varchar(255) NOT NULL
);

INSERT INTO NYHCBackground VALUES(5001, 'Summer_2020', 1, 'bg0001.png');

CREATE TABLE NYHCUserImg /*ID - 9001-9999*/
(
userImgID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
userImgName VARCHAR(128),
userImgPicture varchar(255) NOT NULL
);

INSERT INTO NYHCUserImg VALUES(9001, 'Default Photo', 'default_photo.png');

CREATE TABLE GAMESETTING
(
settingsID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
GameRGB VARCHAR (128)
)

INSERT INTO GAMESETTING VALUES(10001, 'rgb(123, 200, 32)');
ALTER TABLE GAMESETTING ADD GameFont VARCHAR(255) NOT NULL;
ALTER TABLE GAMESETTING ADD red_color INT(3) NOT NULL;
ALTER TABLE GAMESETTING ADD green_color INT(3) NOT NULL;
ALTER TABLE GAMESETTING ADD blue_color INT(3) NOT NULL;


CREATE TABLE News_Info /*ID - 6001-6999*/
(
newID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
newDate DATE,
newTitle VARCHAR(128),
newDesc VARCHAR(128)
)

INSERT INTO News_Info VALUES(6001, '2019-01-01', 'New Game Start', 'NYHC have a different');
INSERT INTO News_Info VALUES(6002, '2019-01-11', 'Can Bit a Point', 'Play in Game and get point');
INSERT INTO News_Info VALUES(6003, '2019-01-17', 'Reward Hao Ji in 01/18-01/25', 'Login day get 888 Points');
INSERT INTO News_Info VALUES(6004, '2021-12-01', 'Winter Draw 2021 in 12/01-01/29', 'Every Day can get 2 chance draw.');
INSERT INTO News_Info VALUES(6005, '2022-01-01', 'Yao Hu Draw 2022 in 01/01-02/26', 'Every Day can get 2 chance draw.');

CREATE TABLE NYHCOfficalReward /*ID - 20001-29999*/
(
orID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
orName VARCHAR(128),
orStartDate DATE,
orLastDate DATE,
orQuality INT,
orRemark VARCHAR(128)
);

INSERT INTO NYHCOfficalReward VALUES(20001,'Offical Login', '2021-01-01', '2021-12-31', 188, 'aaa');

CREATE TABLE reward_claim
(
userID_rc INT,
rewardID_rc INT,
claim_date DATE,
num_of_claim INT
);

INSERT INTO reward_claim VALUES (20190301, 2001, '2021-12-17', 1);
INSERT INTO reward_claim VALUES (20190301, 2003, '2021-12-17', 0);
INSERT INTO reward_claim VALUES (20190301, 2003, '2021-12-18', 0);
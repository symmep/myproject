/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100128
 Source Host           : localhost:3306
 Source Schema         : webtest

 Target Server Type    : MySQL
 Target Server Version : 100128
 File Encoding         : 65001

 Date: 14/03/2018 15:47:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for checkbox
-- ----------------------------
DROP TABLE IF EXISTS `checkbox`;
CREATE TABLE `checkbox`  (
  `checkbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '题干',
  `opa` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '选项A',
  `opb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '选项B',
  `opc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '选项C',
  `opd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '选项D',
  `true` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '正确答案，用逗号分割',
  `class_id` int(11) DEFAULT NULL COMMENT '科目名',
  PRIMARY KEY (`checkbox_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of checkbox
-- ----------------------------
INSERT INTO `checkbox` VALUES (1, 'Every year he goes to Paris ______.', 'by plane', 'by air', 'by sky', 'by flight', 'by plane;by air', 3);
INSERT INTO `checkbox` VALUES (2, 'Do you still remember the day ______ he arrived?', 'which', 'that', '/', 'when', '/;when', 3);
INSERT INTO `checkbox` VALUES (4, '由CO2、H2和CO组成的混合气体在同温同压下与氮气的密度相同。则该混合气体中CO2、H2和CO的体积比为', '29:08:13', '22:01:14', '13:08:29', '26:16:57', '13:08:29;26:16:57', 2);
INSERT INTO `checkbox` VALUES (5, '下列离子方程式中正确的是', '偏铝酸钾溶液和过量盐酸：AlO2－＋4H＋＝Al3＋＋2H2O', '醋酸铵溶液和盐酸反应：CH3COONH4＋H＋＝CH3COOH＋NH4＋', '碳酸氢钙溶液中加入少量氢氧化钙溶液：Ca2＋＋OH－＋HCO3－＝CaCO3↓+H2O', '氢氧化亚铁在空气中氧化：4Fe2++O2+2H2O=4Fe3++4OH－', '偏铝酸钾溶液和过量盐酸：AlO2－＋4H＋＝Al3＋＋2H2O;碳酸氢钙溶液中加入少量氢氧化钙溶液：Ca2＋＋OH－＋HCO3－＝CaCO3↓+H2O', 2);
INSERT INTO `checkbox` VALUES (6, '下列离子方程式正确的是', '向NaAlO2溶液中通入过量CO2：AlO2—＋CO2＋2H2O= Al(OH)3↓+CO32—', '用氯化铁溶液腐蚀铜板：2Fe3＋+Cu＝Cu2++2Fe2+', '用小苏打治疗胃酸过多：NaHCO3+H+＝Na+＋CO2↑+H2O', 'Fe3O4与足量稀HNO3反应：3Fe3O4＋28H＋＋NO3—＝9Fe3＋＋NO↑＋14H2O', '用氯化铁溶液腐蚀铜板：2Fe3＋+Cu＝Cu2++2Fe2+;Fe3O4与足量稀HNO3反应：3Fe3O4＋28H＋＋NO3—＝9Fe3＋＋NO↑＋14H2O', 2);
INSERT INTO `checkbox` VALUES (7, '类推的思维方法在化学学习和研究中常会产生错误的结论，因此类推出的结论最终要经过实践的检验才能决定其正确与否。下列几种类推结论中不正确的是', 'Mg失火不能用CO2灭火,Na失火也不能用CO2灭火', 'Fe3O4可写成FeO·Fe2O3,Pb3O4也可写成PbO·pb2O3', '不能用电解熔融AlCl3来制取金属铝,也不用电解熔融AgCl来制取金属镁', '不能用电解熔融AlCl3来制取金属铝,也不用电解熔融MgCl2来制取金属镁', 'Fe3O4可写成FeO·Fe2O3,Pb3O4也可写成PbO·pb2O3;不能用电解熔融AlCl3来制取金属铝,也不用电解熔融MgCl2来制取金属镁', 2);
INSERT INTO `checkbox` VALUES (8, '臭氧分子的结构与SO2（极性分子）相似，可读做二氧化氧，在臭氧层中含量达0.2 ppm（ppm表示百万分之一）。臭氧是氧气吸收了太阳的波长小于242 nm的紫外线形成的，不过当波长在220 nm～320 nm的紫外线照射臭氧时，又会使其分解。下列说法中正确的是', '打雷时也能产生臭氧，臭氧分子是直线型分子', '臭氧转化为氧气和氧气转化为臭氧均须吸收能量', '臭氧和氧气的相互转化能保持大气中臭氧的含量基本稳定', '向大气中排放氮的氧化物和氟氯代烃均能加快臭氧的分解', '臭氧和氧气的相互转化能保持大气中臭氧的含量基本稳定;向大气中排放氮的氧化物和氟氯代烃均能加快臭氧的分解', 2);
INSERT INTO `checkbox` VALUES (9, '下列反应必须用稀硫酸，而不能用浓硫酸的是', '跟锌反应制氢气 ', '跟苯、浓硝酸作用制硝基苯', '溶解金属铜', '作乙酸乙酯水解的催化剂', '跟锌反应制氢气 ;作乙酸乙酯水解的催化剂', 2);
INSERT INTO `checkbox` VALUES (10, '下列公式哪一个能用来精确地计算任意浓度c（HCl）的HCl水溶液中的氢离子浓度c（H+）（KW为水的离子积常数）', 'c（H+）= c（HCl）', 'c（H+）= c（HCl）+KW/ c（H+）', 'c（H+）= c（HCl）+KW ', 'c（H+）= c（HCl）－KW/ c（H+）', 'c（H+）= c（HCl）;c（H+）= c（HCl）－KW/ c（H+）', 2);
INSERT INTO `checkbox` VALUES (12, '为了使宇航员在神舟飞船中得到一个稳定的、良好的生存环境，一般在飞船内安装了盛有Na2O2（或K2O2）颗粒的装置，它的用途是产生氧气。下列有关Na2O2的叙述正确的是', 'Na2O2中阴、阳离子的个数比是1∶1', 'Na2O2分别与水及CO2反应产生相同量氧气时，需水和CO2的质量相等', 'Na2O2的漂白原理与SO2的漂白原理不相同', '与CO2、H2O反应耗Na2O2的质量相同时，转移电子数相同', 'Na2O2的漂白原理与SO2的漂白原理不相同;与CO2、H2O反应耗Na2O2的质量相同时，转移电子数相同', 2);
INSERT INTO `checkbox` VALUES (13, 'The followings can be classified as off-balance sheet business are', 'Deposits', 'Trust Consulting', 'L/C', 'Agency', 'Trust Consulting;L/C;Agency', 3);
INSERT INTO `checkbox` VALUES (14, 'The typical measures of internal control included', 'risk identified', 'behavior control', 'assessment and authorization', 'Information Exchange', 'behavior control;assessment and authorization', 3);
INSERT INTO `checkbox` VALUES (15, '在日光灯电路中接有启动器、镇流器和日光灯管，下列说法中正确的是', '日光灯点燃后，镇流器、启动器都不起作用', '镇流器在点燃灯管时产生瞬时高压，点燃后起降压限流作用', '日光灯点亮后，启动器不再起作用，可以将启动器去掉', '日光灯点亮后，使镇流器短路，日光仍灯能正常发光，并能降低对电能的消耗', '日光灯点燃后，镇流器、启动器都不起作用;日光灯点亮后，启动器不再起作用，可以将启动器去掉', 3);
INSERT INTO `checkbox` VALUES (16, '下列物理理论与事实合理的是', '赫兹用实验测定了电磁波的速度', '电磁波从真空传入水中时，波长将变长', 'γ射线的一种来源是原子核衰变过程中受激发的原子核从高能级向低能级跃迁', '示踪原子利用了放射性同位素的放射可跟踪性', '赫兹用实验测定了电磁波的速度;γ射线的一种来源是原子核衰变过程中受激发的原子核从高能级向低能级跃迁;示踪原子利用了放射性同位素的放射可跟踪性', 1);
INSERT INTO `checkbox` VALUES (17, '电梯内的地板上竖直放置一根轻质弹簧，弹簧上方有一质量为m的物体．当电梯静止时弹簧被压缩了x；当电梯运动时弹簧又被压缩了x.试判断电梯运动的可能情况是', '以大小为2g的加速度加速上升', '以大小为2g的加速度减速上升', '以大小为g的加速度加速上升', '以大小为g的加速度减速下降', '以大小为g的加速度加速上升;以大小为g的加速度减速下降', 1);
INSERT INTO `checkbox` VALUES (18, '在2009年第11届全运会上，福建女选手郑幸娟以“背越式”成功地跳过了1.95 m的高度，成为全国冠军，若不计空气阻力，则下列说法正确的是', '下落过程中她处于失重状态', '起跳以后上升过程她处于超重状态', '起跳时地面对她的支持力等于她对地面的压力', '起跳时地面对她的支持力大于她对地面的压力', '下落过程中她处于失重状态;起跳时地面对她的支持力等于她对地面的压力', 1);
INSERT INTO `checkbox` VALUES (19, '下列说法中错误的是', '在冬季，剩有半瓶热水的暖水瓶经过一个夜晚后，第二天拔瓶口的软木塞时觉得很紧，不易拔出，是因为白天气温升高，大气压强变大', '一定质量的理想气体，先等温膨胀，再等压压缩，其体积必低于起始体积', '布朗运动就是液体分子的运动', '在轮胎爆裂这一短暂过程中，气体膨胀，温度下降', '在冬季，剩有半瓶热水的暖水瓶经过一个夜晚后，第二天拔瓶口的软木塞时觉得很紧，不易拔出，是因为白天气温升高，大气压强变大;一定质量的理想气体，先等温膨胀，再等压压缩，其体积必低于起始体积;布朗运动就是液体分子的运动', 1);
INSERT INTO `checkbox` VALUES (20, '对一定量的气体，下列说法正确的是', '气体体积是指所有气体分子的体积之和', '气体分子的热运动越剧烈，气体的温度就越高', '气体对器壁的压强是由大量气体分子对器壁不断碰撞而产生的', '当气体膨胀时，气体的分子势能减小，因而气体的内能一定减少', '气体分子的热运动越剧烈，气体的温度就越高;气体对器壁的压强是由大量气体分子对器壁不断碰撞而产生的', 1);
INSERT INTO `checkbox` VALUES (21, '下列有关热学知识的论述正确的是', '两个温度不同的物体相互接触时，热量既能自发地从高温物体传给低温物体，也可以自发地从低温物体传给高温物体', '在一定条件下，低温物体可以向高温物体传递能量', '第一类永动机违背能的转化和守恒定律，第二类永动机不违背能的转化和守恒定律，随着科技的进步和发展，第二类永动机可以制造出来', '温度是物体分子热运动平均动能的标志', '在一定条件下，低温物体可以向高温物体传递能量;温度是物体分子热运动平均动能的标志', 1);
INSERT INTO `checkbox` VALUES (22, '一定质量的气体(分子力及分子势能不计)处于平衡状态Ⅰ，现设法使其温度升高同时压强减小，达到平衡状态Ⅱ，则在状态Ⅰ变为状态Ⅱ的过程', '气体分子的平均动能必定减小', '单位时间内气体分子对器壁单位面积的碰撞次数减少', '气体的体积可能不变', '气体必定吸收热量', '单位时间内气体分子对器壁单位面积的碰撞次数减少;气体必定吸收热量', 1);

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class`  (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '课程名称',
  PRIMARY KEY (`c_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES (1, '大学物理');
INSERT INTO `class` VALUES (2, '有机化学');
INSERT INTO `class` VALUES (3, '大学英语1');
INSERT INTO `class` VALUES (48, '大学英语2');

-- ----------------------------
-- Table structure for class_student
-- ----------------------------
DROP TABLE IF EXISTS `class_student`;
CREATE TABLE `class_student`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) DEFAULT NULL COMMENT '课程id',
  `s_id` int(11) DEFAULT NULL COMMENT '学生id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of class_student
-- ----------------------------
INSERT INTO `class_student` VALUES (4, 4, 1);
INSERT INTO `class_student` VALUES (5, 1, 2);
INSERT INTO `class_student` VALUES (6, 1, 3);
INSERT INTO `class_student` VALUES (7, 48, 1);

-- ----------------------------
-- Table structure for opinion
-- ----------------------------
DROP TABLE IF EXISTS `opinion`;
CREATE TABLE `opinion`  (
  `opinion_id` int(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '题干',
  `bool` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '对错',
  `class_id` int(11) DEFAULT NULL COMMENT '科目名',
  PRIMARY KEY (`opinion_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of opinion
-- ----------------------------
INSERT INTO `opinion` VALUES (1, 'The answer was staring us on the face.  ', 'true', 3);
INSERT INTO `opinion` VALUES (2, 'They have burdened themselves with a high morthgage.  ', 'true', 3);
INSERT INTO `opinion` VALUES (3, 'The pace of modern society get increasingly fast, but it get even faster when mobile phone comes into play.  ', 'true', 3);
INSERT INTO `opinion` VALUES (4, 'She managed to escape from the burning car. ', 'true', 3);
INSERT INTO `opinion` VALUES (5, 'This is a famous private school. Each class has not more than 8 students.', 'true', 3);
INSERT INTO `opinion` VALUES (6, ' It\'s getting darker and darker. Let’s go home.', 'true', 3);
INSERT INTO `opinion` VALUES (7, 'Please join with your children to save the world they will live in. ', 'true', 3);
INSERT INTO `opinion` VALUES (8, ' I only achieved an average at 70 in my first semester. ', 'true', 3);
INSERT INTO `opinion` VALUES (9, 'She is very sensitive for other people\'s feelings. ', 'true', 3);
INSERT INTO `opinion` VALUES (10, 'Teacher divided us to four groups to exercise English dialogues.', 'true', 3);
INSERT INTO `opinion` VALUES (11, 'The answer was staring us on the face.  ', 'true', 48);
INSERT INTO `opinion` VALUES (12, 'They have burdened themselves with a high morthgage.  ', 'true', 48);
INSERT INTO `opinion` VALUES (13, 'The pace of modern society get increasingly fast, but it get even faster when mobile phone comes into play.  ', 'true', 48);
INSERT INTO `opinion` VALUES (14, 'She managed to escape from the burning car. ', 'true', 48);
INSERT INTO `opinion` VALUES (15, 'This is a famous private school. Each class has not more than 8 students.', 'true', 48);
INSERT INTO `opinion` VALUES (16, ' It\'s getting darker and darker. Let’s go home.', 'true', 48);
INSERT INTO `opinion` VALUES (17, 'Please join with your children to save the world they will live in. ', 'true', 48);
INSERT INTO `opinion` VALUES (18, ' I only achieved an average at 70 in my first semester. ', 'true', 48);
INSERT INTO `opinion` VALUES (19, 'She is very sensitive for other people\'s feelings. ', 'true', 48);
INSERT INTO `opinion` VALUES (20, 'Teacher divided us to four groups to exercise English dialogues.', 'true', 48);
INSERT INTO `opinion` VALUES (21, '羟基官能团可能发生反应类型：取代、消去、酯化、氧化、缩聚、中和反应', 'true', 2);
INSERT INTO `opinion` VALUES (23, '甲浣与氯气在紫外线照射下的反应产物有4种', 'false', 2);
INSERT INTO `opinion` VALUES (24, '等质量甲烷、乙烯、乙炔充分燃烧时，所耗用的氧气的量由多到少', 'true', 2);
INSERT INTO `opinion` VALUES (25, '酯的水解产物可能是酸和醇也可能是酸和酚；四苯甲烷的一硝基取代物有3种', 'false', 2);
INSERT INTO `opinion` VALUES (26, '应用水解、取代、加成、还原、氧化等反应类型型均可能在有机物分子中引入羟基', 'true', 2);
INSERT INTO `opinion` VALUES (27, '苯中混有已烯，可在加入适量溴水后分液除去', 'false', 2);
INSERT INTO `opinion` VALUES (28, '由2-丙醇与溴化钠、硫酸混合加热，可制得丙烯', 'false', 2);
INSERT INTO `opinion` VALUES (29, '混在溴乙烷中的乙醇可加入适量氢溴酸除去', 'true', 2);
INSERT INTO `opinion` VALUES (30, '应用干馏方法可将煤焦油中的苯等芳香族化合物分离出来', 'false', 2);
INSERT INTO `opinion` VALUES (31, '常温下，乙醇、乙二醇、丙三醇、苯酚都能以任意比例与水互溶', 'false', 2);
INSERT INTO `opinion` VALUES (32, '光的干涉和衍射不仅说明了光具有波动性，还说明了光是横波', 'false', 1);
INSERT INTO `opinion` VALUES (33, '拍摄玻璃橱窗内的物品时，往往在镜头前加一个偏振片以增加透射光的强度', 'false', 1);
INSERT INTO `opinion` VALUES (34, '爱因斯坦提出的光子说否定了光的波动说', 'false', 1);
INSERT INTO `opinion` VALUES (35, '太阳辐射的能量主要来自太阳内部的裂变反应', 'false', 1);
INSERT INTO `opinion` VALUES (36, '一种元素的同位素具有相同的质子数和不同的中子数', 'true', 1);
INSERT INTO `opinion` VALUES (37, '全息照片往往用激光来拍摄，主要是利用了激光的相干性', 'true', 1);
INSERT INTO `opinion` VALUES (38, '卢瑟福的α粒子散射实验可以估测原子核的大小', 'true', 1);
INSERT INTO `opinion` VALUES (39, '紫光光子的能量比红光光子的能量大', 'true', 1);
INSERT INTO `opinion` VALUES (40, '对于氢原子，量子数越大，其电势能也越大', 'true', 1);
INSERT INTO `opinion` VALUES (41, '在玻璃中红光的速度最大', 'true', 1);

-- ----------------------------
-- Table structure for score
-- ----------------------------
DROP TABLE IF EXISTS `score`;
CREATE TABLE `score`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) DEFAULT NULL COMMENT '学生id',
  `c_id` int(11) DEFAULT NULL COMMENT '课程id',
  `score` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '分数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of score
-- ----------------------------
INSERT INTO `score` VALUES (1, 1, 1, '50');
INSERT INTO `score` VALUES (2, 1, 48, NULL);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '学生姓名',
  `s_pwd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '密码',
  `s_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '学号',
  `grade` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '年级',
  `major` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '专业',
  PRIMARY KEY (`s_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES (1, '张三', '1234', '2017012001', '17', '网络工程');
INSERT INTO `student` VALUES (2, '李四', '123', '2017012002', '16', '软件工程');
INSERT INTO `student` VALUES (3, '王五', '123', '2017012003', '15', '计算机科学');
INSERT INTO `student` VALUES (4, '赵六', '123', '2017012022', '17', '网络工程');

-- ----------------------------
-- Table structure for student_competence
-- ----------------------------
DROP TABLE IF EXISTS `student_competence`;
CREATE TABLE `student_competence`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) DEFAULT NULL COMMENT '课程id',
  `s_id` int(11) DEFAULT NULL COMMENT '学生id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of student_competence
-- ----------------------------
INSERT INTO `student_competence` VALUES (14, 1, 1);
INSERT INTO `student_competence` VALUES (15, 2, 1);
INSERT INTO `student_competence` VALUES (16, 48, 1);

-- ----------------------------
-- Table structure for t_num
-- ----------------------------
DROP TABLE IF EXISTS `t_num`;
CREATE TABLE `t_num`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_num` int(11) DEFAULT NULL COMMENT '教师工号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_num
-- ----------------------------
INSERT INTO `t_num` VALUES (1, 1234567890);
INSERT INTO `t_num` VALUES (2, 123);
INSERT INTO `t_num` VALUES (3, 456);

-- ----------------------------
-- Table structure for t_select
-- ----------------------------
DROP TABLE IF EXISTS `t_select`;
CREATE TABLE `t_select`  (
  `select_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '题干',
  `opa` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '错误选项A',
  `opb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '错误选项B',
  `opc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '错误选项C',
  `true` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '正确答案',
  `class_id` int(11) DEFAULT NULL COMMENT '科目id',
  PRIMARY KEY (`select_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_select
-- ----------------------------
INSERT INTO `t_select` VALUES (1, 'The doctor suggests that I should sleep with the window open（） it’s very cold.', 'if', 'unless', 'when', 'unless', 3);
INSERT INTO `t_select` VALUES (2, 'The missing boys were last seen（） near the river.', 'playing', 'to be playing', 'play', 'playing', 3);
INSERT INTO `t_select` VALUES (3, 'His speech made（） deep impression on the audience that they could hardly forget it.', 'such a', 'so a', 'so', 'such a', 3);
INSERT INTO `t_select` VALUES (4, 'When you are planning a garden party, you’ll have to take the weather into （）.', 'regard', 'account', 'counting', 'account', 3);
INSERT INTO `t_select` VALUES (5, 'You would be （） a risk to let your kid go to school by himself.', 'making', 'running', 'affording', 'running', 3);
INSERT INTO `t_select` VALUES (6, 'I wonder if he（） us, and I think if he（） us we’ll be able to complete the task ahead of time.', 'helps; help', 'will help; helps', 'will help; will help', 'will help; helps', 3);
INSERT INTO `t_select` VALUES (7, 'Very seldom（） that two clocks or watches exactly agree.', 'you find', 'you will find', 'you do find', 'do you find', 3);
INSERT INTO `t_select` VALUES (8, 'The gate is too（） for a car; we’ll have to walk through.', 'shallow', 'loose', 'broad', 'narrow', 3);
INSERT INTO `t_select` VALUES (9, 'The audience sits in a circle and the performance（） in the centre.', 'takes place', 'is taken place', 'holds', 'takes place', 3);
INSERT INTO `t_select` VALUES (10, 'The Americans and the British not only speak the same language but also （）a large number of social customs.', 'share', 'join', 'take', 'share', 3);
INSERT INTO `t_select` VALUES (11, 'The doctor suggests that I should sleep with the window open（） it’s very cold.', 'if', 'unless', 'when', 'unless', 48);
INSERT INTO `t_select` VALUES (12, 'The missing boys were last seen（） near the river.', 'playing', 'to be playing', 'play', 'playing', 48);
INSERT INTO `t_select` VALUES (13, 'His speech made（） deep impression on the audience that they could hardly forget it.', 'such a', 'so a', 'so', 'such a', 48);
INSERT INTO `t_select` VALUES (14, 'When you are planning a garden party, you’ll have to take the weather into （）.', 'regard', 'account', 'counting', 'account', 48);
INSERT INTO `t_select` VALUES (15, 'You would be （） a risk to let your kid go to school by himself.', 'making', 'running', 'affording', 'running', 48);
INSERT INTO `t_select` VALUES (16, 'I wonder if he（） us, and I think if he（） us we’ll be able to complete the task ahead of time.', 'helps; help', 'will help; helps', 'will help; will help', 'will help; helps', 48);
INSERT INTO `t_select` VALUES (17, 'Very seldom（） that two clocks or watches exactly agree.', 'you find', 'you will find', 'you do find', 'do you find', 48);
INSERT INTO `t_select` VALUES (18, 'The gate is too（） for a car; we’ll have to walk through.', 'shallow', 'loose', 'broad', 'narrow', 48);
INSERT INTO `t_select` VALUES (19, 'The audience sits in a circle and the performance（） in the centre.', 'takes place', 'is taken place', 'holds', 'takes place', 48);
INSERT INTO `t_select` VALUES (20, 'The Americans and the British not only speak the same language but also （）a large number of social customs.', 'share', 'join', 'take', 'share', 48);
INSERT INTO `t_select` VALUES (21, '近年来，我国许多城市禁止汽车使用含铅汽油，其主要原因是\r\n近年来，我国许多城市禁止汽车使用含铅汽油，其主要原因是	提高汽油燃烧效率	降低汽油成本	铅资源短缺	避免铅污染大气\r\n近年来，我国许多城市禁止汽车使用含铅汽油，其主要原因是	提高汽油燃烧效率	降低汽油成本	铅资源短缺	避免铅污染大气\r\n近年来，我国许多城市禁止', '提高汽油燃烧效率', '降低汽油成本', '铅资源短缺', '避免铅污染大气', 2);
INSERT INTO `t_select` VALUES (22, '向100mL的FeBr2溶液中通入标准状况下的Cl23.36L时，Cl2全部被还原,测得此时溶液中c(Br—)=c(Cl—)，则原FeBr2溶液的物质的量浓度是', '0.75mol• L—1', '1.5mol• L—1', '3mol• L—1', '2mol• L—1 ', 2);
INSERT INTO `t_select` VALUES (23, '已知2H2S+SO2=3S+2H2O,现将等物质的量的SO2和H2S常温下在定容的密闭容器中反应，待充分反应后恢复至常温。容器内的压强是原压强的', '1／2', '1／4', '>1／4', '<1／4', 2);
INSERT INTO `t_select` VALUES (24, '下列说法符合工业实际的是', '电解精炼铜时，粗铜板做阴极', '工业上采取把氯气通入烧碱溶液的方法生产漂白粉', '玻璃、水泥、高温结构陶瓷均为传统硅酸盐工业产品', '冶金工业中，常用铝热反应原理冶炼钒、铬、锰等金属', 2);
INSERT INTO `t_select` VALUES (25, '下列分子或离子在无色透明的溶液中能大量共存的是', 'Na+、H+、SO32-、HClO   ', 'Al3+、Mg2+、OH一、CO32-', 'Ba2+、Fe3+、NO3-、Cl一', 'K+、OH一、Cl一、NH3·H2O', 2);
INSERT INTO `t_select` VALUES (26, 'Mg—AgCl电池是一种用海水激活的一次电池，在军事上用作电动鱼雷的电源。电池的总反应可表示为：Mg+2AgCl     MgCl2+2Ag。下列关于该电池的说法错误的是', '该电池工作时，正极反应为：2AgCl+2e一    2C1一+2Ag', '镁电极做该电池负极，负极反应为：Mg一2e一      Mg2+', '装备该电池的鱼雷在水中行进时，海水作为电解质溶液', '有24g Mg被氧化时，可还原得到108 g Ag', 2);
INSERT INTO `t_select` VALUES (27, '化学与科学、技术、社会、环境密切相关。下列有关说法中不正确的是', '食用的蛋白质、淀粉和脂肪都可发生水解反应', '大力开发和应用氢能源有利于实现“低碳经济”', '工业上，用电解熔融MgCl2的方法制得金属镁', '海轮外壳上镶入铅块，可减缓船体的腐蚀速率', 2);
INSERT INTO `t_select` VALUES (28, '下列现象或事实可用同一化学原理加以说明的是', '氯化铵和碘都可以用加热法进行提纯', '氯水和二氧化硫气体均能使品红溶液褪色', '硫酸亚铁溶液和水玻璃在空气中久置后均会变质', '铁片和铝片置于冷的浓硫酸中均无明显现象', 2);
INSERT INTO `t_select` VALUES (29, '用NA表示阿伏加德罗常数的值。下列叙述正确的是', '11.2L乙烯、乙炔的混合物中C原子数为NA', '1 L1 mol·L－1Na2CO3溶液中含CO32 －离子数为NA', '1mol乙醇和1mol乙酸反应生成的水分子数为NA', '常温常压下11g CO2中共用电子对的数目为NA', 2);
INSERT INTO `t_select` VALUES (30, '下列说法不正确的是', '高温能杀死H1N1流感病毒的原因是蛋白质受热变性', '可用水鉴别苯、四氯化碳、乙醇三种无色液体', '用灼烧闻气味的方法可区别纯棉织物和纯毛织物', '生活中可以使用明矾对饮用水进行消毒、杀菌', 2);
INSERT INTO `t_select` VALUES (31, '在下列各溶液中，离子可能大量共存的是', '无色透明的溶液中：Cu2＋、Fe3+、NO3－、、Cl－', '含有大量ClO—的溶液中：K＋、H＋、I－、SO32—', '水电离产生的c(H+) =10—12mol·L—1的溶液中：Na＋、Fe2＋、SO42—、NO3－ ', '使pH试纸变红的溶液中：NH4+、Na+、SO42－、Cl－', 2);
INSERT INTO `t_select` VALUES (32, '有X、Y两种元素，原子序数均不超过20，X的原子半径小于Y，且X、Y原子的最外层电子数相同（选项中m、n均为正整数）。下列说法正确的是', '若Y(OH)n为强碱，则X(OH)n也一定为强碱', '若HnXOm为强酸，则HnYOm也一定为强酸', '若X元素的单质是非金属，则Y元素的单质也一定是非金属', '若Y的最低负价为－n，则X的最低负价也一定为－n ', 2);
INSERT INTO `t_select` VALUES (33, '主链为4个碳原子的某烷烃有2种同分异构体,则相同碳原子数、主链也为4个碳原子的烯烃,其同分异构体有', '3种', '5种', '2种', '4种', 2);
INSERT INTO `t_select` VALUES (34, '应用纳米新材料能给人民币进行杀菌、消毒。我国纳米专家王雪平发明的“WXP复合纳米材料”的主要化学成份是氨基二氯代戊二醛的含硅衍生物，它能保持长期杀菌作用。有鉴于此，35位人大代表联名提交了一份议案，要求加快将此新技术应用到人民币制造中去。若戊二醛是直链的，请你根据所学的知识推断沸点不同的氨基二氯代戊二醛的同分异构体可能有  ', '4种', '5种', '6种', '8种', 2);
INSERT INTO `t_select` VALUES (35, '在托盘天平的两盘中各放入同浓度同体积的足量稀硫酸，分别加入0.1mol两种金属，反应后需在游码中拔动0.2个大格后，天平才能恢复平衡。两金属是', '铁和铝', '镁和钠', '铁和铜', '镁和铝', 2);
INSERT INTO `t_select` VALUES (36, '下面几个理论中，吸收了普朗克的量子化思想的是', '卢瑟福的原子核式结构学说', '汤姆生的原子模型', '麦克斯韦的光的电磁说', '爱因斯坦的光子说', 1);
INSERT INTO `t_select` VALUES (37, '下列说法中正确的是', '布朗运动实验中看到的小颗粒的运动就是液体分子的无规则运动', '只要温度相同，任何物体分子运动的平均速率都相等', '第二类永动机都以失败告终，导致了热力学第一定律的发现', '当物体的机械能发生变化时，内能不一定发生变化', 1);
INSERT INTO `t_select` VALUES (38, '为了利用海洋资源，海洋工作者有时根据水流切割地磁场所产生的感应电动势来测量海水的流速．假设海洋某处的地磁场竖直分量为B＝0.5×10－4T，水流是南北流向，如图将两个电极竖直插入此处海水中，且保持两电极的连线垂直水流方向．若两极相距L＝10m，与两电极相连的灵敏电压表的读数为U＝2mV，则海水的流速大小为', '40 m／s', '0.4 m／s', '4×10－3m／s', '4 m／s', 1);
INSERT INTO `t_select` VALUES (39, '我国发射的神舟六号载人飞船的周期约为90min，如果把它绕地球的运动看作匀速圆周运动，那么它的运动和周期为一天的地球同步卫星的运动相比，下列判断中正确的是', '飞船的轨道半径大于同步卫星的轨道半径', '飞船的运行速度小于同步卫星的运行速度', '飞船运动的角速度小于同步卫星运动的角速度', '飞船运动的向心加速度大于同步卫星运动的向心加速度', 1);
INSERT INTO `t_select` VALUES (40, '重核的裂变和轻核的聚变是人类利用原子核能的两条途径。下面关于它们的说法正确的是', '裂变过程有质量亏损，聚变过程质量有所增加', '聚变过程有质量亏损，裂变过程质量有所增加', '裂变过程和聚变过程质量都有所增加', '裂变和聚变过程都有质量亏损', 1);
INSERT INTO `t_select` VALUES (41, '下列说法正确的是', '线圈中磁通量变化越大，线圈中产生的感应电动势一定越大', '线圈中的磁通量越大，线圈中产生的感应电动势一定越大', '线圈处在磁场越强的位置，线圈中产生的感应电动势一定越大', '线圈中磁通量变化得越快，线圈中产生的感应电动势越大', 1);
INSERT INTO `t_select` VALUES (42, '设在地球上和x天体上以相同的初速度竖直上抛一物体的最大高度之比为k（均不计阻力），且已知地球和x天体的半径之比也为k。则地球质量与x天体的质量之比为', 'k2', '1/k', '1/ k2', 'k', 1);
INSERT INTO `t_select` VALUES (43, '飞机在万米高空飞行时，舱外气温往往在-50℃以下。在研究大气现象时可把温度、压强相同的一部分气体作为研究对象，叫做气团．气团直径可达几千米，由于气团很大，边缘部分与外界的热交换对整个气团没有明显影响，可以忽略．高空气团温度很低的原因可能是 ', '地面的气团上升到高空的过程中膨胀，同时对外放热，使气团自身温度降低', '地面的气团上升到高空的过程中收缩，同时从周围吸收热量，使周围温度降低', '地面的气团上升到高空的过程中收缩，外界对气团做功，故周围温度降低', '地面的气团上升到高空的过程中膨胀，气团对外做功，气团内能大量减少，气团温度降低', 1);
INSERT INTO `t_select` VALUES (44, '我们将质点的运动与物体的转动进行对比，可以看到它们的规律有许多相似之处，存在着较强的对应性。如；运动的位移与转动的角度、运动的速度与转动的角速度、运动的加速度a与转动的角加速度β(其中β=Δω/Δt)；力是产生加速度的原因，而且F合=ma，力矩是产生角加速度的原因，而且M合=Iβ（其中的I叫转动惯量）.则下列关于角加速度β的单位、转动惯量I的单位（国际单位制主单位）正确的是', 'm/s2、N', 'rad/s2、N', 'm/s2、kg·m2', 'rad/s2、kg·m2', 1);
INSERT INTO `t_select` VALUES (45, '下列叙述中，正确的是', '物体的温度越高，分子热运动就越剧烈，每个分子动能也越大', '布朗运动就是液体分子的热运动', '根据热力学第二定律可知热量能够从高温物体传到低温物体，但不可能从低温物体传到高温物体', '一定质量的理想气体从外界吸收热量，其内能可能不变', 1);
INSERT INTO `t_select` VALUES (46, '关于物体的内能，下列说法中正确的是', '温度升高时，每个分子的动能都增大', '机械能越大，分子的平均动能就越大', '机械能越大，物体的内能就越大', '温度升高时，分子的平均动能增大', 1);
INSERT INTO `t_select` VALUES (47, '下列说法中正确的是', '第二类永动机无法制成是因为它违背了热力学第一定律', '教室内看到透过窗子的“阳光柱”里粉尘颗粒杂乱无章的运动，这种运动是布朗运动', '热量只能从高温物体向低温物体传递，不可能由低温物体传给高温物体', '地面附近有一正在上升的空气团（视为理想气体），它与外界的热交换忽略不计。已知大气压强随高度增加而降低，则该气团在此上升过程中气团体积增大，温度降低', 1);
INSERT INTO `t_select` VALUES (48, '爱因斯坦由光电效应的实验规律，猜测光具有粒子性，从而提出光子说。从科学研究的方法来说，这属于', '等效替代', '控制变量', '数学归纳', '科学假说', 1);

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher`  (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '老师名字',
  `t_pwd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '登录密码',
  `t_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '教师工号',
  PRIMARY KEY (`t_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES (10, '1', '2', '1234567890');
INSERT INTO `teacher` VALUES (11, '12', '23', '123');
INSERT INTO `teacher` VALUES (12, '123', '1234', '456');

SET FOREIGN_KEY_CHECKS = 1;

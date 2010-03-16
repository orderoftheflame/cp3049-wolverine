
INSERT INTO `wv_person` VALUES ('0601163', 'Danny', 'Dawes', 'd.dawes@wlv.ac.uk', 'e860705d2b061a6853517cac9b524be4bf41bace', '0000-00-00 00:00:00');
INSERT INTO `wv_person` VALUES ('0607658', 'Ben', 'Mitchell', 'ben.mitchell@wlv.ac.uk', '4a9a355ddb627100671cd4774209fde5effd76d3', '0000-00-00 00:00:00');
INSERT INTO `wv_person` VALUES ('123456', 'Module', 'Leader', 'd.dawes@wlv.ac.uk', '6ce3c81fcb95900af70c2ff35ecc51f48bb9a62e', '2010-03-14 11:49:57');
INSERT INTO `wv_person` VALUES ('0601162', 'Daniel', 'Dawes', 'info@noirenex.com', '6182b624d5095e32124336491b836a83ddec3584', '2010-03-09 16:11:48');
INSERT INTO `wv_person` VALUES ('0613584', 'Andrew', 'Cashmore', 'avenyet@gmail.com', 'd3f8dc48e3965c64f17be81a3277be72322ad02c', '2010-03-09 16:26:37');
INSERT INTO `wv_person` VALUES ('in1234', 'Derek', 'Beardsmore', 'd.dawes@wlv.ac.uk', '90f68055a77bce9c2087d9625c25762075a560c8', '2010-03-14 00:56:13');
INSERT INTO `wv_person` VALUES ('in1235', 'Arline', 'Wilson', 'd.dawes@wlv.ac.uk', '1bcb6ad10e8ad895303525d14f673b0aa616798d', '2010-03-14 11:55:27');
INSERT INTO `wv_person` VALUES ('in9999', 'Admin', 'User', 'd.dawes@wlv.ac.uk', '023e3b53a0f848964c0507934bfd2bffe0a5b61f', '2010-03-14 14:20:28');


INSERT INTO `wv_staff` VALUES ('0601163', 1, 1);
INSERT INTO `wv_staff` VALUES ('in1234', 0, 0);
INSERT INTO `wv_staff` VALUES ('123456', 0, 1);
INSERT INTO `wv_staff` VALUES ('in1235', 1, 1);
INSERT INTO `wv_staff` VALUES ('in9999', 1, 0);

INSERT INTO `wv_staffstudentgrouplink` VALUES (1, 8, '0601163');

INSERT INTO `wv_studentgroups` VALUES (3, 'Group A', 'Reserved for Arline Wilson', 'Monday', '10:30:00', '2010-03-13 14:52:27');
INSERT INTO `wv_studentgroups` VALUES (4, 'Group B', 'For Derek Beardsmore', 'Monday', '10:30:00', '2010-03-13 15:38:42');
INSERT INTO `wv_studentgroups` VALUES (5, 'Group C', 'This is a seperate group for students who cannot come on a monday, this will be a small group of students so will only need a small room', 'Tuesday', '13:00:00', '2010-03-13 17:50:32');
INSERT INTO `wv_studentgroups` VALUES (8, 'Group D', 'Test Group', 'Monday', '09:00:00', '2010-03-13 21:34:06');
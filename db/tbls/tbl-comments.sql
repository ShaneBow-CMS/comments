(
 `otype` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'obj(page) type',
 `oid` int(10) unsigned NOT NULL COMMENT 'obj id',
 `debut` int(10) unsigned NOT NULL COMMENT 'unix timestamp',
 `uid` int(10) unsigned NOT NULL COMMENT 'commenter',
 `lft` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT 'for preorder tree only',
 `rgt` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT 'for preorder tree only',
 `score` tinyint(3) unsigned NOT NULL DEFAULT 0,
 `entry` text,
 PRIMARY KEY (`otype`,`oid`,`debut`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

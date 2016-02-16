
/*

tabele:
+-----------------------+
| Tables_in_wpxy        |
+-----------------------+
| wp_commentmeta        |
| wp_comments           |
| wp_links              |
| wp_options            |
| wp_postmeta           |
| wp_posts              |
| wp_term_relationships |
| wp_term_taxonomy      |
| wp_terms              |
| wp_usermeta           |
| wp_users              |
+-----------------------+

MariaDB [wpxy]> show columns in wp_commentmeta;
+------------+---------------------+------+-----+---------+----------------+
| Field      | Type                | Null | Key | Default | Extra          |
+------------+---------------------+------+-----+---------+----------------+
| meta_id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| comment_id | bigint(20) unsigned | NO   | MUL | 0       |                |
| meta_key   | varchar(255)        | YES  | MUL | NULL    |                |
| meta_value | longtext            | YES  |     | NULL    |                |
+------------+---------------------+------+-----+---------+----------------+


MariaDB [wpxy]> show columns in wp_comments;
+----------------------+---------------------+------+-----+---------------------+----------------+
| Field                | Type                | Null | Key | Default             | Extra          |
+----------------------+---------------------+------+-----+---------------------+----------------+
| comment_ID           | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
| comment_post_ID      | bigint(20) unsigned | NO   | MUL | 0                   |                |
| comment_author       | tinytext            | NO   |     | NULL                |                |
| comment_author_email | varchar(100)        | NO   | MUL |                     |                |
| comment_author_url   | varchar(200)        | NO   |     |                     |                |
| comment_author_IP    | varchar(100)        | NO   |     |                     |                |
| comment_date         | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| comment_date_gmt     | datetime            | NO   | MUL | 0000-00-00 00:00:00 |                |
| comment_content      | text                | NO   |     | NULL                |                |
| comment_karma        | int(11)             | NO   |     | 0                   |                |
| comment_approved     | varchar(20)         | NO   | MUL | 1                   |                |
| comment_agent        | varchar(255)        | NO   |     |                     |                |
| comment_type         | varchar(20)         | NO   |     |                     |                |
| comment_parent       | bigint(20) unsigned | NO   | MUL | 0                   |                |
| user_id              | bigint(20) unsigned | NO   |     | 0                   |                |
+----------------------+---------------------+------+-----+---------------------+----------------+



MariaDB [wpxy]> show columns in wp_links;
+------------------+---------------------+------+-----+---------------------+----------------+
| Field            | Type                | Null | Key | Default             | Extra          |
+------------------+---------------------+------+-----+---------------------+----------------+
| link_id          | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
| link_url         | varchar(255)        | NO   |     |                     |                |
| link_name        | varchar(255)        | NO   |     |                     |                |
| link_image       | varchar(255)        | NO   |     |                     |                |
| link_target      | varchar(25)         | NO   |     |                     |                |
| link_description | varchar(255)        | NO   |     |                     |                |
| link_visible     | varchar(20)         | NO   | MUL | Y                   |                |
| link_owner       | bigint(20) unsigned | NO   |     | 1                   |                |
| link_rating      | int(11)             | NO   |     | 0                   |                |
| link_updated     | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| link_rel         | varchar(255)        | NO   |     |                     |                |
| link_notes       | mediumtext          | NO   |     | NULL                |                |
| link_rss         | varchar(255)        | NO   |     |                     |                |
+------------------+---------------------+------+-----+---------------------+----------------+


MariaDB [wpxy]> show columns in wp_options;
+--------------+---------------------+------+-----+---------+----------------+
| Field        | Type                | Null | Key | Default | Extra          |
+--------------+---------------------+------+-----+---------+----------------+
| option_id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| option_name  | varchar(64)         | NO   | UNI |         |                |
| option_value | longtext            | NO   |     | NULL    |                |
| autoload     | varchar(20)         | NO   |     | yes     |                |
+--------------+---------------------+------+-----+---------+----------------+


MariaDB [wpxy]> show columns in wp_postmeta;
+------------+---------------------+------+-----+---------+----------------+
| Field      | Type                | Null | Key | Default | Extra          |
+------------+---------------------+------+-----+---------+----------------+
| meta_id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| post_id    | bigint(20) unsigned | NO   | MUL | 0       |                |
| meta_key   | varchar(255)        | YES  | MUL | NULL    |                |
| meta_value | longtext            | YES  |     | NULL    |                |
+------------+---------------------+------+-----+---------+----------------+

MariaDB [wpxy]> show columns in wp_posts;
+-----------------------+---------------------+------+-----+---------------------+----------------+
| Field                 | Type                | Null | Key | Default             | Extra          |
+-----------------------+---------------------+------+-----+---------------------+----------------+
| ID                    | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
| post_author           | bigint(20) unsigned | NO   | MUL | 0                   |                |
| post_date             | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| post_date_gmt         | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| post_content          | longtext            | NO   |     | NULL                |                |
| post_title            | text                | NO   |     | NULL                |                |
| post_excerpt          | text                | NO   |     | NULL                |                |
| post_status           | varchar(20)         | NO   |     | publish             |                |
| comment_status        | varchar(20)         | NO   |     | open                |                |
| ping_status           | varchar(20)         | NO   |     | open                |                |
| post_password         | varchar(20)         | NO   |     |                     |                |
| post_name             | varchar(200)        | NO   | MUL |                     |                |
| to_ping               | text                | NO   |     | NULL                |                |
| pinged                | text                | NO   |     | NULL                |                |
| post_modified         | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| post_modified_gmt     | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| post_content_filtered | longtext            | NO   |     | NULL                |                |
| post_parent           | bigint(20) unsigned | NO   | MUL | 0                   |                |
| guid                  | varchar(255)        | NO   |     |                     |                |
| menu_order            | int(11)             | NO   |     | 0                   |                |
| post_type             | varchar(20)         | NO   | MUL | post                |                |
| post_mime_type        | varchar(100)        | NO   |     |                     |                |
| comment_count         | bigint(20)          | NO   |     | 0                   |                |
+-----------------------+---------------------+------+-----+---------------------+----------------+


MariaDB [wpxy]> show columns in wp_term_relationships;
+------------------+---------------------+------+-----+---------+-------+
| Field            | Type                | Null | Key | Default | Extra |
+------------------+---------------------+------+-----+---------+-------+
| object_id        | bigint(20) unsigned | NO   | PRI | 0       |       |
| term_taxonomy_id | bigint(20) unsigned | NO   | PRI | 0       |       |
| term_order       | int(11)             | NO   |     | 0       |       |
+------------------+---------------------+------+-----+---------+-------+


MariaDB [wpxy]> show columns in wp_term_taxonomy;
+------------------+---------------------+------+-----+---------+----------------+
| Field            | Type                | Null | Key | Default | Extra          |
+------------------+---------------------+------+-----+---------+----------------+
| term_taxonomy_id | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| term_id          | bigint(20) unsigned | NO   | MUL | 0       |                |
| taxonomy         | varchar(32)         | NO   | MUL |         |                |
| description      | longtext            | NO   |     | NULL    |                |
| parent           | bigint(20) unsigned | NO   |     | 0       |                |
| count            | bigint(20)          | NO   |     | 0       |                |
+------------------+---------------------+------+-----+---------+----------------+


MariaDB [wpxy]> show columns in wp_terms;
+------------+---------------------+------+-----+---------+----------------+
| Field      | Type                | Null | Key | Default | Extra          |
+------------+---------------------+------+-----+---------+----------------+
| term_id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(200)        | NO   | MUL |         |                |
| slug       | varchar(200)        | NO   | MUL |         |                |
| term_group | bigint(10)          | NO   |     | 0       |                |
+------------+---------------------+------+-----+---------+----------------+

MariaDB [wpxy]> show columns in wp_usermeta;
+------------+---------------------+------+-----+---------+----------------+
| Field      | Type                | Null | Key | Default | Extra          |
+------------+---------------------+------+-----+---------+----------------+
| umeta_id   | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| user_id    | bigint(20) unsigned | NO   | MUL | 0       |                |
| meta_key   | varchar(255)        | YES  | MUL | NULL    |                |
| meta_value | longtext            | YES  |     | NULL    |                |
+------------+---------------------+------+-----+---------+----------------+


MariaDB [wpxy]> show columns in wp_users;
+---------------------+---------------------+------+-----+---------------------+----------------+
| Field               | Type                | Null | Key | Default             | Extra          |
+---------------------+---------------------+------+-----+---------------------+----------------+
| ID                  | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
| user_login          | varchar(60)         | NO   | MUL |                     |                |
| user_pass           | varchar(64)         | NO   |     |                     |                |
| user_nicename       | varchar(50)         | NO   | MUL |                     |                |
| user_email          | varchar(100)        | NO   |     |                     |                |
| user_url            | varchar(100)        | NO   |     |                     |                |
| user_registered     | datetime            | NO   |     | 0000-00-00 00:00:00 |                |
| user_activation_key | varchar(60)         | NO   |     |                     |                |
| user_status         | int(11)             | NO   |     | 0                   |                |
| display_name        | varchar(250)        | NO   |     |                     |                |
+---------------------+---------------------+------+-----+---------------------+----------------+
| event_time                 | user_host                 | thread_id | server_id | command_type | argument
--------------------------------------------------------------------------------------------------------------------
| 2015-12-23 10:19:43.686694 | [root] @ localhost []     |         5 |         0 | Connect      | root@localhost as anonymous on                                                                                                                                                                                                                                                                             |
| 2015-12-23 10:19:43.686820 | root[root] @ localhost [] |         5 |         0 | Query        | SET NAMES utf8mb4                                                                                                                                                                                                                                                                                          |
| 2015-12-23 10:19:43.686942 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT @@SESSION.sql_mode                                                                                                                                                                                                                                                                                  |
| 2015-12-23 10:19:43.687540 | root[root] @ localhost [] |         5 |         0 | Init DB      | wpxy                                                                                                                                                                                                                                                                                                       |
| 2015-12-23 10:19:43.689837 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_name, option_value FROM wp_options WHERE autoload = 'yes'                                                                                                                                                                                                                                    |
| 2015-12-23 10:19:43.763317 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'WPLANG' LIMIT 1                                                                                                                                                                                                                                   |
| 2015-12-23 10:19:43.766850 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'theme_mods_twentyfifteen' LIMIT 1                                                                                                                                                                                                                 |
| 2015-12-23 10:19:43.767033 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'current_theme' LIMIT 1                                                                                                                                                                                                                            |
| 2015-12-23 10:19:43.767914 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'mods_Twenty Fifteen' LIMIT 1                                                                                                                                                                                                                      |
| 2015-12-23 10:19:43.768558 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1                                                                                                                                                                                                                             |
| 2015-12-23 10:19:43.768719 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1                                                                                                                                                                                                                          |
| 2015-12-23 10:19:43.768859 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1                                                                                                                                                                                                                         |
| 2015-12-23 10:19:43.768934 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1                                                                                                                                                                                                                          |
| 2015-12-23 10:19:43.769149 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT option_value FROM wp_options WHERE option_name = 'theme_switched' LIMIT 1                                                                                                                                                                                                                           |
| 2015-12-23 10:19:43.769448 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')  ORDER BY wp_posts.post_date DESC LIMIT 0, 10                                                                                                                     |
| 2015-12-23 10:19:43.770128 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT FOUND_ROWS()                                                                                                                                                                                                                                                                                        |
| 2015-12-23 10:19:43.770207 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT wp_posts.* FROM wp_posts WHERE ID IN (1)                                                                                                                                                                                                                                                            |
| 2015-12-23 10:19:43.770319 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT t.*, tt.*, tr.object_id FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON tt.term_id = t.term_id INNER JOIN wp_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('category', 'post_tag', 'post_format') AND tr.object_id IN (1) ORDER BY t.name ASC |
| 2015-12-23 10:19:43.772345 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (1) ORDER BY meta_id ASC                                                                                                                                                                                                            |
| 2015-12-23 10:19:43.775623 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT   wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND ((wp_posts.post_status = 'publish'))  ORDER BY wp_posts.post_date DESC LIMIT 0, 5                                                                                                                                       |
| 2015-12-23 10:19:43.775843 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT * FROM wp_users WHERE ID = '1'                                                                                                                                                                                                                                                                      |
| 2015-12-23 10:19:43.776261 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1) ORDER BY umeta_id ASC                                                                                                                                                                                                           |
| 2015-12-23 10:19:43.776904 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT * FROM wp_comments JOIN wp_posts ON wp_posts.ID = wp_comments.comment_post_ID WHERE ( comment_approved = '1' ) AND  wp_posts.post_status IN ('publish')  ORDER BY wp_comments.comment_date_gmt DESC LIMIT 5                                                                                         |
| 2015-12-23 10:19:43.777706 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM wp_posts  WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC                                                                                   |
| 2015-12-23 10:19:43.778088 | root[root] @ localhost [] |         5 |         0 | Query        | SELECT t.*, tt.* FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('category') AND tt.count > 0 ORDER BY t.name ASC                                                                                                                                     |
| 2015-12-23 10:19:43.780482 | root[root] @ localhost [] |         5 |         0 | Quit         |                                                                                                                                                                                                                                                                                                            |
| 2015-12-23 10:19:55.308764 | [root] @ localhost []     |         6 |         0 | Connect      | root@localhost as anonymous on                                                                                                                                                                                                                                                                             |
| 2015-12-23 10:19:55.308927 | root[root] @ localhost [] |         6 |         0 | Query        | select @@version_comment limit 1

*/
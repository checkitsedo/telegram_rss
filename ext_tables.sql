#
# Table structure for table 'tx_telegramrss_departments'
#
CREATE TABLE tx_telegramrss_departments (
	code varchar(4) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL
);


#
# Table structure for table 'tx_telegramrss_teams'
#
CREATE TABLE tx_telegramrss_teams (
	code varchar(5) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	members text
);


#
# MM-table for teams-fe_users relations
#
CREATE TABLE tx_telegramrss_teams_feusers_mm (
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


#
# Table structure for extending table 'fe_users'
#
CREATE TABLE fe_users (
	tx_telegramrss_code varchar(10) DEFAULT '' NOT NULL,
	tx_telegramrss_department text,
	tx_telegramrss_holidays int(11) DEFAULT '0' NOT NULL
);


#
# Table structure for extending table 'tx_news_domain_model_news'
#
CREATE TABLE tx_news_domain_model_news (
	tx_telegramrss_externalid varchar(255) DEFAULT '' NOT NULL
);
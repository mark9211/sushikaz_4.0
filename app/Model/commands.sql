#買掛金額
create table kaikake_fees(
	id int not null primary key auto_increment,
	location_id int,
	store_id int,
	fee int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

#中間テーブル Location & KaikakeStore
create table intermediate_one(
	id int not null primary key auto_increment,
	association_id int,
	store_id int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

#中間テーブル グループ & 部門
create table intermediate_two(
	id int not null primary key auto_increment,
	group_id int,
	section_id int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 定額支出type
create table expense_df_types(
	id int not null primary key auto_increment,
	name varchar(255),
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 定額支出fee
create table expense_df_fees(
	id int not null primary key auto_increment,
	association_id int,
	type_id int,
	fee int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 中間テーブル
create table intermediate_three(
	id int not null primary key auto_increment,
	association_id int,
	type_id int,
	cost int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 売上成績給与保存
create table monthly_salaries(
	id int not null primary key auto_increment,
	association_id int,
	style enum('full', 'part'),
	fee int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 店内経費種類
create table monthly_expense_types(
	id int not null primary key auto_increment,
	name varchar(255),
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 店内経費保存
create table monthly_expenses(
	id int not null primary key auto_increment,
	association_id int,
	type_id int,
	working_month date,
	fee int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 卓番
create table table_numbers(
	id int not null primary key auto_increment,
	association_id int,
	max_person int,
	number int,
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);

# 予約情報
create table reserves(
	id int not null primary key auto_increment,
	day varchar(255),
	time varchar(255),
	c_num varchar(255),
	table_id varchar(255),
	course_id varchar(255),
	purpose_id varchar(255),
	member_id varchar(255),
	user_name varchar(255),
	user_phone varchar(255),
	status enum('active', 'deleted') default 'active',
	created datetime default null,
	modified datetime default null
);


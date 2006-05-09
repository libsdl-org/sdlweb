CREATE TABLE groups
(id SERIAL,
 name VARCHAR(30) NOT NULL,
 
 addproject BOOLEAN NOT NULL,
 reviewproject BOOLEAN NOT NULL,
 editproject BOOLEAN NOT NULL,
 removeproject BOOLEAN NOT NULL,

 addprojectcategory BOOLEAN NOT NULL,
 editprojectcategory BOOLEAN NOT NULL,
 removeprojectcategory BOOLEAN NOT NULL,
 
 addnews BOOLEAN NOT NULL,
 editnews BOOLEAN NOT NULL,
 removenews BOOLEAN NOT NULL,
  
 addarticle BOOLEAN NOT NULL,
 editarticle BOOLEAN NOT NULL,
 removearticle BOOLEAN NOT NULL,

 addfaqentry BOOLEAN NOT NULL,
 editfaqentry BOOLEAN NOT NULL,
 removefaqentry BOOLEAN NOT NULL,

 managefaqcategories BOOLEAN NOT NULL,
 manageoses BOOLEAN NOT NULL,
 managegroups BOOLEAN NOT NULL,
 manageusers BOOLEAN NOT NULL,
 
 PRIMARY KEY (id),
 UNIQUE (name));

CREATE TABLE users
(id SERIAL,
 groupid INT NOT NULL,
 login VARCHAR(20) NOT NULL,
 password CHAR(32) NOT NULL,
 nickname VARCHAR(30) NOT NULL,
 name VARCHAR(40) NOT NULL,
 email VARCHAR(64) NOT NULL,
 PRIMARY KEY (id),
 UNIQUE (login),
 FOREIGN KEY (groupid) references groups);

CREATE TABLE projecttypes
(id INT NOT NULL,
 name VARCHAR(30) NOT NULL,
 PRIMARY KEY (id));

CREATE TABLE projectcategories
(id SERIAL,
 type INT NOT NULL,
 name VARCHAR(40) NOT NULL,
 description VARCHAR(255) NOT NULL,
 PRIMARY KEY (id),
 FOREIGN KEY (type) references projecttypes);

CREATE TABLE projects
(id SERIAL,
 userid INT NOT NULL,
 type INT NOT NULL,
 category INT NOT NULL,
 name VARCHAR(30) NOT NULL,
 description VARCHAR(255) NOT NULL,
 versionrequired INT NOT NULL,
 url VARCHAR(100) NOT NULL,
 contact VARCHAR(64) NOT NULL,
 reviewed BOOLEAN NOT NULL,
 timestamp TIMESTAMP NOT NULL,
 license VARCHAR(32),
 PRIMARY KEY (id),
 FOREIGN KEY (userid) references users, 
 FOREIGN KEY (type) references projecttypes,
 FOREIGN KEY (category) references projectcategories);

CREATE TABLE oses
(id SERIAL,
 shortname VARCHAR(10) NOT NULL,
 name VARCHAR(30) NOT NULL,
 PRIMARY KEY (id));

CREATE TABLE projectstatus
(project INT NOT NULL,
 os INT NOT NULL,
 status NUMERIC(3) NOT NULL,
 PRIMARY KEY (project,os),
 FOREIGN KEY (project) references projects,
 FOREIGN KEY (os) references oses);

CREATE TABLE news
(id SERIAL,
 userid INT NOT NULL,
 timestamp TIMESTAMP NOT NULL,
 text TEXT NOT NULL,
 PRIMARY KEY (id),
 FOREIGN KEY (userid) references users);

CREATE TABLE faqcategories
(id SERIAL,
 name VARCHAR(20) NOT NULL,
 description VARCHAR(255) NOT NULL,
 sorted REAL,
 PRIMARY KEY (id));

CREATE TABLE faqentries
(id SERIAL,
 category INT NOT NULL,
 question TEXT NOT NULL,
 answer TEXT NOT NULL,
 sorted REAL,
 PRIMARY KEY (id),
 FOREIGN KEY (category) references faqcategories);


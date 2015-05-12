/* SQL TodoList version 1.0 24/03/2015 */

CREATE DATABASE IF NOT EXISTS ppil;

USE ppil;

DROP TABLE IF EXISTS associations;
DROP TABLE IF EXISTS notifier;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS todo_lists;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users(
    id int(11) NOT NULL AUTO_INCREMENT,
    nom varchar(30) NOT NULL,
    prenom varchar(30) NOT NULL,
    date_de_naissance date NOT NULL,
    sexe char(1) NOT NULL,
    mail varchar(30) NOT NULL,
    mot_de_passe varchar(100) NOT NULL,
    photo varchar(30) NOT NULL,
    id_facebook varchar(32) DEFAULT '0',
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS todo_lists (
  	id int(11) NOT NULL AUTO_INCREMENT,
  	nom varchar(30) NOT NULL,
  	date date NULL,
  	frequence int(11) NULL,
  	unite_frequence int(11) NULL,
  	date_fin date NULL,
  	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS notifications (
  	id int(11) NOT NULL AUTO_INCREMENT,
	id_utilisateur int(11) NOT NULL,
	id_todolist int(11) NOT NULL,
  	texte varchar(1000) NOT NULL,
  	consulte boolean NOT NULL,
  	PRIMARY KEY (id),
  	FOREIGN KEY (id_utilisateur) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS items(
  	id int(11) NOT NULL AUTO_INCREMENT,
  	nom varchar(30) NOT NULL,
  	checked boolean  NOT NULL,
  	id_todo_lists int(11) NOT NULL,
  	PRIMARY KEY (id),
  	FOREIGN KEY (id_todo_lists) REFERENCES todo_lists(id)
);

CREATE TABLE IF NOT EXISTS notifier (
    id int(11) NOT NULL AUTO_INCREMENT,
  	id_notifications int(11) NOT NULL,
  	id_users int(11) NOT NULL,
  	id_todo_lists int(11) NOT NULL,
  	PRIMARY KEY (id),
  	FOREIGN KEY (id_notifications) REFERENCES notifications(id),
  	FOREIGN KEY (id_users) REFERENCES users(id),
  	FOREIGN KEY (id_todo_lists) REFERENCES todo_lists(id)
);

CREATE TABLE IF NOT EXISTS associations (
    id int(11) NOT NULL AUTO_INCREMENT,
  	id_users int(11) NOT NULL,
  	id_todo_lists int(11) NOT NULL,
  	PRIMARY KEY (id),
  	FOREIGN KEY (id_users) REFERENCES users(id),
  	FOREIGN KEY (id_todo_lists) REFERENCES todo_lists(id)
);
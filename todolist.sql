/* SQL TodoList version 1.0 24/03/2015 */

CREATE DATABASE IF NOT EXISTS todolist;

USE todolist;

DROP TABLE IF EXISTS appartient;
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
	mot_de_passe varchar(30) NOT NULL,
  	photo varchar(30) NOT NULL,
  	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS todo_lists (
  	id int(11) NOT NULL AUTO_INCREMENT,
  	nom varchar(30) NOT NULL,
  	date date NOT NULL,
  	frequence int(11) NOT NULL,
  	unite_frequence int(11) NOT NULL,
  	date_fin date NOT NULL,
  	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS notifications (
  	id_notifications int(11) NOT NULL AUTO_INCREMENT,
  	texte varchar(1000) NOT NULL,
  	consulte boolean NOT NULL,
  	PRIMARY KEY (id_notifications)
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
  	FOREIGN KEY (id_notifications) REFERENCES notifications(id_notifications),
  	FOREIGN KEY (id_users) REFERENCES users(id),
  	FOREIGN KEY (id_todo_lists) REFERENCES todo_lists(id)
);

CREATE TABLE IF NOT EXISTS appartient (
	id int(11) NOT NULL AUTO_INCREMENT,
  	id_users int(11) NOT NULL,
  	id_todo_lists int(11) NOT NULL,
  	PRIMARY KEY (id),
  	FOREIGN KEY (id_users) REFERENCES users(id),
  	FOREIGN KEY (id_todo_lists) REFERENCES todo_lists(id)
);
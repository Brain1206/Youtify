DROP DATABASE IF EXISTS youtify;
CREATE DATABASE youtify;
USE youtify;

CREATE TABLE usuario(
usu_user varchar(200) primary key,
usu_password varchar(200) not null,
usu_nombre varchar(200) not null,
usu_foto varchar(200) not null);


CREATE TABLE video(
vid_id int auto_increment primary key,
vid_nombre varchar(200) not null,
vid_descripcion text not null,
vid_fecha timestamp not null,
vid_nombrearchivo varchar(200) not null,
vid_categoria int(11) not null,
vid_user varchar(200) not null);


CREATE TABLE audio(
AUD_id int auto_increment primary key,
AUD_nombre varchar(200) not null,
AUD_descripcion text not null,
AUD_fecha timestamp not null,
AUD_genero int(11) not null,
AUD_nombrearchivo varchar(200) not null,
AUD_user varchar(200) not null);

CREATE TABLE categoria(
cat_id int auto_increment primary key,
cat_categoria varchar(200) not null);

CREATE TABLE genero(
gen_id int auto_increment primary key,
gen_genero varchar(200) not null);

CREATE TABLE comentario(
com_id int auto_increment primary key,
com_user varchar(200)not null,
com_texto text not null,
com_fecha timestamp not null,
com_id_video int(11) null,
com_id_audio int(11) null);

ALTER TABLE video
	ADD CONSTRAINT fk_vid_usu FOREIGN KEY (vid_user)
	REFERENCES usuario(usu_user) ON DELETE CASCADE  ON UPDATE CASCADE;

ALTER TABLE video
	ADD CONSTRAINT fk_vid_cat FOREIGN KEY (vid_categoria)
	REFERENCES categoria(cat_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE audio 
	ADD CONSTRAINT fk_aud_usu FOREIGN KEY (aud_user)	
	REFERENCES usuario(usu_user) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE audio
	ADD CONSTRAINT fk_aud_gen FOREIGN KEY (aud_genero)
	REFERENCES genero(gen_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE comentario
	ADD CONSTRAINT fk_com_usu FOREIGN KEY (com_user)
	REFERENCES usuario(usu_user) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE comentario
	ADD CONSTRAINT fk_com_vid FOREIGN KEY (com_id_video)
	REFERENCES video(vid_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE comentario
	ADD CONSTRAINT fk_com_aud FOREIGN KEY (com_id_audio)
	REFERENCES audio(aud_id) ON DELETE CASCADE ON UPDATE CASCADE;
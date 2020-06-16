CREATE DATABASE IF NOT EXISTS laravel_master;

USE laravel_master;

CREATE table users(
    id              int(255) auto_increment not null,
    role            varchar(255),
    name            varchar(100),
    surname         varchar(200),
    nick            varchar(100),
    email           varchar(255),
    password        varchar(255),
    image           varchar(255),
    create_at       datetime,
    update_at       datetime,
    remember_token  varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)

)ENGINE=INNODB;

USE laravel_master;

INSERT INTO users VALUES(null, 'user', 'vadick', 'palomino', 'vadick22', 'vadick@vadick.com','vadick', null, CURTIME(), CURTIME(), NULL );
INSERT INTO users VALUES(null, 'user', 'juan', 'lopez', 'juanlopez', 'juan@juan.com','juan', null, CURTIME(), CURTIME(), NULL );
INSERT INTO users VALUES(null, 'user', 'Manolo', 'Garcia', 'manologarcia', 'manolo@manolo.com','manolo', null, CURTIME(), CURTIME(), NULL );


USE laravel_master;
CREATE table images(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_path      varchar(255),
    description     text,
    created_at      datetime,
    updated_at      datetime,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) references users(id)
)ENGINE=INNODB;

USE laravel_master;
INSERT INTO images VALUES(null, 1, 'test.jpg', 'descripcion de prueba 1', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 1, 'playa.jpg', 'descripcion de prueba 2', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 1, 'arena.jpg', 'descripcion de prueba 3', CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 3, 'familia.jpg', 'descripcion de prueba 4', CURTIME(), CURTIME());

USE laravel_master;
SELECT * FROM images;


USE laravel_master;

CREATE table comments(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_id        int(255),
    content         text,
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) references users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) references images(id)



)ENGINE=INNODB;

USE laravel_master;

INSERT INTO comments VALUES(NULL, '1', '4', 'Buena foto de familia', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, '2', '1', 'Buena foto de playa', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, '2', '4', 'Que bueno', CURTIME(), CURTIME());


USE laravel_master;

CREATE table likes(
    id          int(255) auto_increment not null,
    user_id     int(255),
    image_id    int(255),
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)


INSERT INTO likes VALUES(NULL, 1, 4,  CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 4,  CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, CURTIME(), CURTIME());
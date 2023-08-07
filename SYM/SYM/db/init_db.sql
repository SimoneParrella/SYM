CREATE TABLE users (
  id SERIAL,
  user_name varchar(255) NOT NULL ,
  password varchar(255) NOT NULL,
  name varchar(255) NOT NULL
);
ALTER TABLE users  ADD PRIMARY KEY (id);

CREATE TABLE favourites (
id SERIAL,
user_id INT,
movie_id INT,
FOREIGN KEY (user_id) REFERENCES users(id)

)
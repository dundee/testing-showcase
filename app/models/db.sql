
CREATE TABLE article (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name TEXT UNIQUE,
	content TEXT,
	seen INTEGER
);

INSERT INTO article (name, content)
VALUES ('Clean code', 'Clean code should be prefered over performance');

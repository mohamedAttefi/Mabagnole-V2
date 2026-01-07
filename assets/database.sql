CREATE TABLE vehicle_favorites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    vehicle_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_id) REFERENCES vehicules(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_vehicle_favorite (user_id, vehicle_id)
);
CREATE TABLE Themes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    description TEXT
);


CREATE TABLE blog_articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT,
    theme_id INT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (theme_id) REFERENCES Themes(id) ON DELETE CASCADE
);


SELECT
    b.*,
    u.nom AS user_name,
    t.name AS theme_name,
    COUNT(c.id) AS total_comments
    FROM blog_articles b
    JOIN themes t ON b.theme_id = t.id
    JOIN utilisateurs u ON b.user_id = u.id
    LEFT JOIN blog_comments c ON b.id = c.article_id
    WHERE b.id = 2
    GROUP BY b.id, u.nom, t.name;


SELECT *
FROM blog_tags t
JOIN article_tags at ON t.id = at.tag_id
JOIN blog_articles a ON a.id = at.article_id
WHERE a.id = 5;

SELECT a.*, v.marque, v.modele, v.image_url
                FROM avis a
                JOIN vehicules v ON a.vehicule_id = v.id
                WHERE a.client_id = 3
                ORDER BY a.date_creation DESC


CREATE TABLE blog_tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);
CREATE TABLE article_tags (
    article_id INT,
    tag_id INT,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES blog_articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES blog_tags(id) ON DELETE CASCADE
);
CREATE TABLE blog_comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    article_id INT,
    user_id INT,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES blog_articles(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);
INSERT INTO vehicle_favorites (user_id, vehicle_id)
VALUES (1, 3);
INSERT INTO themes (name, description)
VALUES
(
  'Conseils de conduite',
  'Astuces pour conduire en toute sécurité et réduire la consommation.'
),
(
  'Actualités automobiles',
  'Nouveautés, tendances et innovations du monde automobile.'
),
(
  'Voyages & Road Trips',
  'Idées de voyages, itinéraires et expériences en voiture.'
);
INSERT INTO blog_articles (title, content, user_id, theme_id)
VALUES (
    'Comment choisir une voiture de location',
    'Voici quelques conseils pour bien choisir votre voiture selon vos besoins.',
    1,
    1
);


INSERT INTO blog_tags (name)
VALUES ('SUV'), ('Économie'), ('Voyage');

INSERT INTO article_tags (article_id, tag_id)
VALUES
(2, 1),
(2, 2);

INSERT INTO blog_comments (article_id, user_id, content)
VALUES
(2, 1, 'Article très utile, merci !');


SELECT * from blog_articles b join themes t on b.theme_id = t.id


SELECT * from blog_comments c join utilisateurs u on c.user_id = u.id join blog_articles a on c.article_id = a.id



select * from reservations r left join utilisateurs u on r.client_id = u.id;

SELECT * FROM reservations r JOIN vehicules v on r.vehicule_id = v.id WHERE r.id = 2



 SELECT a.*, v.marque, v.modele, v.image_url
                FROM avis a
                JOIN vehicules v ON a.vehicule_id = v.id
                WHERE a.client_id = 11
                ORDER BY a.date_creation DESC

SELECT * FROM reservations r JOIN vehicules v on r.vehicule_id = v.id r.id = 1;

SELECT * FROM reservations r JOIN liste_vehicules v on r.vehicule_id = v.id


SELECT *, c.content as commentaire, u.nom as user_name from blog_comments c join utilisateurs u on c.user_id = u.id join blog_articles a on c.article_id = a.id
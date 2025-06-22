-- Struktur database Forum Diskusi Mahasiswa

CREATE DATABASE IF NOT EXISTS forum_diskusi;
USE forum_diskusi;

-- Tabel users
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('guest', 'user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel categories
CREATE TABLE categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Tabel topics
CREATE TABLE topics (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    content TEXT NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    view_count INT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel tags
CREATE TABLE tags (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Tabel pivot topic_tag (many to many antara topics dan tags)
CREATE TABLE topic_tag (
    topic_id INT UNSIGNED NOT NULL,
    tag_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (topic_id, tag_id),
    FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Tabel comments
CREATE TABLE comments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    topic_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    parent_comment_id INT UNSIGNED DEFAULT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_comment_id) REFERENCES comments(id) ON DELETE SET NULL
);

-- Tabel likes
CREATE TABLE likes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    comment_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_like (comment_id, user_id)
);

-- Tabel reports
CREATE TABLE reports (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    topic_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    reason VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel activity_logs
CREATE TABLE activity_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    action VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Index tambahan untuk performa (optional)
CREATE INDEX idx_topics_author ON topics(author_id);
CREATE INDEX idx_comments_topic ON comments(topic_id);
CREATE INDEX idx_likes_comment ON likes(comment_id);
CREATE INDEX idx_reports_topic ON reports(topic_id);

-- Dummy data for users
INSERT INTO users (name, email, password, role) VALUES
('Admin Forum', 'admin@forum.com', '$2y$10$9a0J6s4sUyfW4PxHq3uFqOyPUwKZ.0yt3SrGcpJwXlAKcnw9q.e6a', 'admin'),
('Mahasiswa 1', 'mhs1@forum.com', '$2y$10$9a0J6s4sUyfW4PxHq3uFqOyPUwKZ.0yt3SrGcpJwXlAKcnw9q.e6a', 'user'),
('Mahasiswa 2', 'mhs2@forum.com', '$2y$10$9a0J6s4sUyfW4PxHq3uFqOyPUwKZ.0yt3SrGcpJwXlAKcnw9q.e6a', 'user'),
('Guest User', 'guest@forum.com', '$2y$10$9a0J6s4sUyfW4PxHq3uFqOyPUwKZ.0yt3SrGcpJwXlAKcnw9q.e6a', 'guest');

-- Dummy data for categories
INSERT INTO categories (name) VALUES
('Teknologi'),
('Pendidikan'),
('Hiburan'),
('Olahraga');

-- Dummy data for tags
INSERT INTO tags (name) VALUES
('Laravel'),
('PHP'),
('Kuliah'),
('Futsal'),
('Film'),
('Javascript'),
('Tips');

-- Dummy data for topics
INSERT INTO topics (title, category_id, content, author_id, view_count) VALUES
('Bagaimana Cara Belajar Laravel?', 1, 'Saya ingin belajar Laravel, ada saran sumber belajar?', 2, 5),
('Tips Sukses Kuliah Online', 2, 'Bagikan pengalaman atau tips saat kuliah online!', 3, 12),
('Rekomendasi Film untuk Mahasiswa', 3, 'Film apa yang bagus untuk mengisi waktu luang?', 2, 8),
('Komunitas Futsal Kampus', 4, 'Siapa saja yang suka futsal? Yuk buat komunitas!', 3, 15);

-- Dummy data for topic_tag (topik 1: Laravel, PHP; topik 2: Kuliah, Tips; dst)
INSERT INTO topic_tag (topic_id, tag_id) VALUES
(1, 1), (1, 2),
(2, 3), (2, 7),
(3, 5),
(4, 4);

-- Dummy data for comments
INSERT INTO comments (topic_id, user_id, parent_comment_id, content) VALUES
(1, 3, NULL, 'Coba buka laracasts atau dokumentasi resminya!'),
(1, 1, 1, 'Betul, laracasts sangat bagus untuk pemula.'),
(2, 2, NULL, 'Jangan lupa disiplin dan buat jadwal harian.'),
(2, 3, 3, 'Saya juga pakai aplikasi manajemen waktu.'),
(4, 2, NULL, 'Saya tertarik gabung komunitas futsal.'),
(4, 1, 5, 'Boleh, kapan kumpul pertama?');

-- Dummy data for likes (like pada comment id 1, 2, 3, 5)
INSERT INTO likes (comment_id, user_id) VALUES
(1, 2),
(2, 3),
(3, 1),
(5, 3);

-- Dummy data for reports (topik 3 direport user 1, topik 4 direport user 2)
INSERT INTO reports (topic_id, user_id, reason) VALUES
(3, 1, 'Konten kurang relevan'),
(4, 2, 'Mengandung ajakan yang tidak jelas');

-- Dummy data for activity_logs
INSERT INTO activity_logs (user_id, action, description) VALUES
(1, 'Login', 'Admin berhasil login ke dashboard.'),
(2, 'Buat Topik', 'Mahasiswa 1 membuat topik tentang Laravel.'),
(3, 'Komentar', 'Mahasiswa 2 memberikan komentar di topik kuliah online.'),
(2, 'Like', 'Mahasiswa 1 menyukai komentar pada topik futsal.');

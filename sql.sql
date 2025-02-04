INSERT INTO users (name, email, email_verified_at, password, remember_token, created_at, updated_at)
VALUES
('John Doe', 'johndoe@example.com', NOW(), '$2y$10$KXl...', 'abcdef1234', NOW(), NOW()),
('Jane Smith', 'janesmith@example.com', NOW(), '$2y$10$A1bC...', 'ghijk5678', NOW(), NOW()),
('Michael Johnson', 'michaelj@example.com', NULL, '$2y$10$M9nO...', 'lmnop9876', NOW(), NOW());


DELETE FROM users
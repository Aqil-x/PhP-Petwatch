INSERT INTO users (username, password_hash, name, role)
VALUES
    ('owner1','hash1','Alice Owner','owner'),
    ('owner2','hash2','Bob Owner','owner'),
;

INSERT INTO users (username, password_hash, name, role)
VALUES
    ('user1','hash1','Charlie User','user'),
    ('user2','hash2','Dana User','user'),
;

INSERT INTO pets (owner_id, name, type, description, status)
VALUES
    (1,'Fluffy','Cat','White cat','Missing'),
    (2,'Rover','Dog','Brown dog','Found'),
;

INSERT INTO sightings (pet_id, user_id, note, latitude, longitude, image_path)
VALUES
    (1,51,'Saw Fluffy near the park',40.7128,-74.006,'uploads/fluffy1.jpg'),
    (2,52,'Rover spotted',34.0522,-118.2437,'uploads/rover1.jpg'),
;

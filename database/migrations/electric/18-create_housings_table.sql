create table if not exists "housings"
(
    id   uuid not null primary key,
    name text not null
);

-- Create Indexes
CREATE INDEX idx_housings_id ON "housings" ("id");

CREATE INDEX idx_housings_name ON "housings" ("name");

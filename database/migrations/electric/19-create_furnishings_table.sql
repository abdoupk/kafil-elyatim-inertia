create table if not exists "furnishings"
(
    id   uuid not null primary key,
    name text not null
);

-- Create Indexes
CREATE INDEX idx_furnishings_id ON "furnishings" ("id");

CREATE INDEX idx_furnishings_name ON "furnishings" ("name");

create table if not exists "family_furnishing"
(
    "id"            uuid not null primary key,
    "family_id"     uuid not null references "families" ("id") on delete cascade,
    "furnishing_id" uuid not null references "furnishings" ("id") on delete cascade,
    value           text not null
);

-- Create Indexes
CREATE INDEX idx_family_furnishing_id ON "family_furnishing" ("id");

CREATE INDEX idx_family_furnishing_family_id ON "family_furnishing" ("family_id");

CREATE INDEX idx_family_furnishing_furnishing_id ON "family_furnishing" ("furnishing_id");

CREATE INDEX idx_family_furnishing_value ON "family_furnishing" ("value");

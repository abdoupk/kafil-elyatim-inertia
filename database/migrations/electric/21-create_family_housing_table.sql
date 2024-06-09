create table if not exists "family_housing"
(
    id           uuid not null primary key,
    "family_id"  uuid not null references "families" ("id") on delete cascade,
    "housing_id" uuid not null references "housings" ("id") on delete cascade,
    value        text not null
);

CREATE INDEX idx_family_housing_id ON "family_housing" ("id");

CREATE INDEX idx_family_housing_family_id ON "family_housing" ("family_id");

CREATE INDEX idx_family_housing_housing_id ON "family_housing" ("housing_id");

CREATE INDEX idx_family_housing_value ON "family_housing" ("value");

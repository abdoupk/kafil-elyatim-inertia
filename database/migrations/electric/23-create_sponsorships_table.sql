CREATE TYPE sponsorship_type AS ENUM ('family', 'orphan', 'sponsor');

CREATE TABLE IF NOT EXISTS sponsorships
(
    "id"         uuid                           not null primary key,
    "type"       sponsorship_type               not null,
    "name"       text                           not null,
    "tenant_id"  text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "deleted_at" timestamp(0) without time zone null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_sponsorships_id ON sponsorships ("id");

CREATE INDEX idx_sponsorships_type ON sponsorships ("type");

CREATE INDEX idx_sponsorships_name ON sponsorships ("name");

CREATE INDEX idx_sponsorships_tenant_id ON sponsorships ("tenant_id");

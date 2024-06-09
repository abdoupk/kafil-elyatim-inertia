create table if not exists families
(
    "id"         uuid primary key,
    "name"       text                           not null,
    "report"     text                           not null,
    "tenant_id"  text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

CREATE INDEX idx_families_id ON families ("id");

CREATE INDEX idx_families_name ON families ("name");

CREATE INDEX idx_families_tenant_id ON families ("tenant_id");

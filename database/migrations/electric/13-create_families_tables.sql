create table if not exists families
(
    "id"          uuid primary key,
    "name"        text                           not null,
    "zone_id"     uuid                           not null,
    "branch_id"   uuid                           null,
    "address"     text                           not null,
    "file_number" integer                        not null,
    "start_date"  date                           not null,
    "tenant_id"   text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at"  timestamp(0) without time zone null,
    "updated_at"  timestamp(0) without time zone null,
    "deleted_at"  timestamp(0) without time zone null
);

CREATE INDEX idx_families_id ON families ("id");

CREATE INDEX idx_families_name ON families ("name");

CREATE INDEX idx_families_tenant_id ON families ("tenant_id");

CREATE INDEX idx_families_zone_id ON families ("zone_id");

create table if not exists "zones"
(
    "id"          uuid                           not null primary key,
    "name"        text                           not null,
    "description" text                           not null,
    "tenant_id"   text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at"  timestamp(0) without time zone null,
    "updated_at"  timestamp(0) without time zone null,
    "deleted_at"  timestamp(0) without time zone null
);

create index "zones_name_index" on "zones" ("id");

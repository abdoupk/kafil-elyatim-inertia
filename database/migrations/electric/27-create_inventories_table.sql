create table if not exists "inventories"
(
    "id"         uuid                           not null primary key,
    "name"       text                           not null,
    "qty"        integer                        not null,
    "note"       text                           null,
    "tenant_id"  text                           not null references "tenants" ("id") on delete cascade,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null,
    "deleted_at" timestamp(0) without time zone null
)

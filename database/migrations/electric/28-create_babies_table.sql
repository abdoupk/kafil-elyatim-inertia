create table if not exists "babies"
(
    "id"                 uuid                           not null primary key,
    "baby_milk_quantity" integer                        null,
    "baby_milk_type"     uuid                           null references "inventories" ("id") on delete cascade,
    "diapers_quantity"   integer                        null,
    "diapers_type"       text                           null references "inventories" ("id") on delete cascade,
    "orphan_id"          uuid                           not null references "orphans" ("id") on delete cascade,
    "family_id"          uuid                           not null references "families" ("id") on delete cascade,
    "tenant_id"          text                           not null references "tenants" ("id") on delete cascade,
    "created_at"         timestamp(0) without time zone null,
    "updated_at"         timestamp(0) without time zone null,
    "deleted_at"         timestamp(0) without time zone null
)

create table if not exists "branches"
(
    "id"             uuid                           not null primary key,
    "tenant_id"      uuid                           not null references tenants ("id"),
    "city_id"        integer                        not null references cities ("id"),
    "president_id" uuid                           not null references users ("id"),
    "created_at"   timestamp(0) without time zone null,
    "updated_at"   timestamp(0) without time zone null
)

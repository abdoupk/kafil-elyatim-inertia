create table "private_schools"
(
    "id"         uuid                           not null,
    "name"       text                           not null,
    "quota"      integer                        not null,
    "tenant_id"  text                           not null references "tenants" ("id"),
    "deleted_at" timestamp(0) without time zone null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

alter table "private_schools"
    add primary key ("id")

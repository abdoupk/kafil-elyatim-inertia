create table "archives"
(
    "id"               uuid                           not null,
    "occasion"         text                           not null,
    "tenant_id"        uuid                           not null,
    "saved_by"         uuid                           not null,
    "saved_month"      text                           not null,
    "archiveable_id"   uuid                           not null,
    "archiveable_type" text                           not null,
    "created_at"       timestamp(0) without time zone null,
    "updated_at"       timestamp(0) without time zone null
);

-- alter table "archives"
--     add constraint "archives_tenant_id_foreign" foreign key ("tenant_id") references "tenants" ("id");


alter table "archives"
    add constraint "archives_saved_by_foreign" foreign key ("saved_by") references "users" ("id");

alter table "archives"
    add primary key ("id");

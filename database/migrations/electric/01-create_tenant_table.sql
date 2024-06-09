create table if not exists "tenants"
(
    "id"         text                           not null primary key,
    "data"       jsonb                          null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

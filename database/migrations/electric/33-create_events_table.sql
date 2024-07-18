create table "events"
(
    "id"         uuid                           not null,
    "title"      text                           not null,
    "subject_id" integer                        not null,
    "school_id"  uuid                           not null,
    "start_date" timestamp(0) without time zone not null,
    "end_date"   timestamp(0) without time zone not null,
    frequency    text                           not null,
    interval     integer                        not null,
    until        date                           null,
    "color"      text                           not null,
    "tenant_id"  text                           not null references "tenants" ("id"),
    "deleted_at" timestamp(0) without time zone null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

alter table "events"
    add primary key ("id")

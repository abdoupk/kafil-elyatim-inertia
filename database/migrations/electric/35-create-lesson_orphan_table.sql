create table "lesson_orphan"
(
    "id"         uuid                           not null,
    "lesson_id"  uuid                           not null references events (id) on delete cascade,
    "orphan_id"  uuid                           not null references orphans (id) on delete cascade,
    "tenant_id"  text                           not null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

alter table "lesson_orphan"
    add primary key ("id")

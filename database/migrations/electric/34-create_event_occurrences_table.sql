create table event_occurrences
(
    "id"         uuid primary key,
    "start_date" timestamp(0) without time zone not null,
    "end_date"   timestamp(0) without time zone not null,
    "event_id"   uuid                           not null references events (id) on delete cascade,
    "tenant_id"  text                           not null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
)

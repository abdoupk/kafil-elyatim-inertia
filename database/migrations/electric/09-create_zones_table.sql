create table if not exists "zones"
(
    "id"   uuid not null primary key,
    "name" text not null
);

create index "zones_name_index" on "zones" ("id");

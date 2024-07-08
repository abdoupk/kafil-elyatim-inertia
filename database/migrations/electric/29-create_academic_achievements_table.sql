create table if not exists "academic_achievements"
(
    "id"               uuid                           not null primary key,
    "academic_level"   text                           null,
    "academic_phase"   text                           null,
    "first_trimester"  double precision               null,
    "second_trimester" double precision               null,
    "third_trimester"  double precision               null,
    "first_semester"   double precision               null,
    "second_semester"  double precision               null,
    "total"            double precision               null,
    "orphan_id"        uuid                           not null references "orphans" ("id") on delete cascade,
    "tenant_id"        text                           not null references "tenants" ("id") on delete cascade,
    "created_at"       timestamp(0) without time zone null,
    "updated_at"       timestamp(0) without time zone null
)

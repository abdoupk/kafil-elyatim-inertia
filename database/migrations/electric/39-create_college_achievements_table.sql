create table "college_achievements"
(
    "id"              uuid                           not null primary key,
    "orphan_id"       uuid                           not null references orphans (id) on delete cascade,
    "first_semester"  double precision               null,
    "second_semester" double precision               null,
    "speciality"      text                           null,
    "university"      text                           null,
    "note"            text                           null,
    "tenant_id"       uuid                           not null,
    "created_at"      timestamp(0) without time zone null,
    "updated_at"      timestamp(0) without time zone null
)

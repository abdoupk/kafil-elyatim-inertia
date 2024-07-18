create table "repetitions"
(
    "id"              bigserial                      not null primary key,
    "repeatable_type" varchar(255)                   not null,
    "repeatable_id"   uuid                         not null,
    "type"            varchar(255)
        check ("type" in ('simple', 'complex'))      not null default 'simple',
    "start_at"        timestamp(0) without time zone not null,
    "interval"        integer                        null,
    "year"            varchar(255)
                                                     null,
    "month"           varchar(255)                   null,
    "day"             varchar(255)                   null,
    "week"            varchar(255)                   null,
    "weekday"         varchar(255)                   null,
    "end_at"          timestamp(0) without time zone null,
    "created_at"      timestamp(0) without time zone null,
    "updated_at"      timestamp(0) without time zone null
);
create index "repetitions_repeatable_type_repeatable_id_index" on "repetitions" ("repeatable_type", "repeatable_id");
alter table "repetitions"
    add column "tz_offset" integer not null default '0';
alter table "repetitions"
    add column "week_of_month" varchar(255) null;

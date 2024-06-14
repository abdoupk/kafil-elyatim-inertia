create table if not exists "users"
(
    "id"                uuid                           not null primary key,
    "first_name"        text                           not null,
    "last_name"         text                           not null,
    "phone"             text                           not null,
    "email"             text                           not null,
    "zone_id"           text                           null,
    "email_verified_at" timestamp(0) without time zone null,
    "password"          text                           not null,
    "remember_token"    text                           null,
    "tenant_id"         text                           not null references "tenants" ("id") on delete cascade,
    "created_at"        timestamp(0) without time zone null,
    "updated_at"        timestamp(0) without time zone null
);
-- TODO: check how to fix
-- alter table "users"
-- add
-- constraint "users_email_unique" unique ("email");
create table if not exists "password_reset_tokens"
(
    "email"      text                           not null primary key,
    "token"      text                           not null,
    "created_at" timestamp(0) without time zone null
);
create table if not exists "sessions"
(
    "id"            text    not null primary key,
    "user_id"       uuid    null references "users" ("id") on delete cascade,
    "ip_address"    text    null,
    "user_agent"    text    null,
    "payload"       text    not null,
    "last_activity" integer not null
);

create index "sessions_user_id_index" on "sessions" ("user_id");

create index "sessions_last_activity_index" on "sessions" ("last_activity");

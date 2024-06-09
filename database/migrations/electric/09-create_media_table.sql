create table if not exists "media"
(
    "id"                    uuid                           not null primary key,
    "model_type"            text                           not null,
    "model_id"              bigint                         not null,
    "uuid"                  uuid                           null,
    "collection_name"       text                           not null,
    "name"                  text                           not null,
    "file_name"             text                           not null,
    "mime_type"             text                           null,
    "disk"                  text                           not null,
    "conversions_disk"      text                           null,
    "size"                  bigint                         not null,
    "manipulations"         jsonb                          not null,
    "custom_properties"     jsonb                          not null,
    "generated_conversions" jsonb                          not null,
    "responsive_images"     jsonb                          not null,
    "order_column"          integer                        null,
    "created_at"            timestamp(0) without time zone null,
    "updated_at"            timestamp(0) without time zone null
);

create index "media_model_type_model_id_index" on "media" ("model_type", "model_id");


-- TODO: check how to fix
-- alter table
--    "media"
-- add
--    constraint "media_uuid_unique" unique ("uuid");

create index "media_order_column_index" on "media" ("order_column");

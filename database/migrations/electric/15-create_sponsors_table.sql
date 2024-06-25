CREATE TABLE IF NOT EXISTS sponsors
(
    "id"                       uuid                           not null primary key,
    "first_name"               text                           not null,
    "last_name"                text                           not null,
    "phone_number"             text                           not null,
    "sponsorship_type"         text                           not null,
    "birth_date"               date                           not null,
    "father_name"              text                           not null,
    "mother_name"              text                           not null,
    "birth_certificate_number" text                           not null,
    "academic_level"           text                           not null,
    "function"                 text                           not null,
    "health_status"            text                           not null,
    "diploma"                  text                           null,
    "card_number"              text                           null,
    "ccp"                      text                           null,
    "gender"                   text                           not null,
    tenant_id                  text                           not null references tenants (id) on delete cascade,
    "created_by"               uuid                           not null references users (id),
    "deleted_by"               uuid                           null references users (id),
    "deleted_at"               timestamp(0) without time zone null,
    "created_at"               timestamp(0) without time zone null,
    "updated_at"               timestamp(0) without time zone null
);

CREATE INDEX idx_sponsors_created_by ON sponsors ("created_by");

CREATE INDEX idx_sponsors_deleted_by ON sponsors ("deleted_by");

CREATE INDEX idx_sponsors_tenant_id ON sponsors ("tenant_id");

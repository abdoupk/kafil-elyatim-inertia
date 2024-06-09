CREATE TABLE IF NOT EXISTS second_sponsors
(
    "id"              uuid                           not null primary key,
    first_name        text                           not null,
    last_name         text                           not null,
    degree_of_kinship text                           not null,
    phone_number      text                           not null,
    address           text                           not null,
    income            double precision               not null,
    "family_id"       uuid                           not null references families (id) on delete cascade,
    tenant_id         text                           not null references tenants (id) on delete cascade,
    "deleted_at"      timestamp(0) without time zone null,
    "created_at"      timestamp(0) without time zone null,
    "updated_at"      timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_second_sponsors_id ON second_sponsors ("id");

CREATE INDEX idx_second_sponsors_family_id ON second_sponsors ("family_id");

CREATE INDEX idx_second_sponsors_tenant_id ON second_sponsors ("tenant_id");

CREATE INDEX idx_second_sponsors_name ON second_sponsors (first_name, last_name);

CREATE INDEX idx_second_sponsors_phone_number ON second_sponsors (phone_number);

CREATE INDEX idx_second_sponsors_address ON second_sponsors (address);

CREATE INDEX idx_second_sponsors_income ON second_sponsors (income);

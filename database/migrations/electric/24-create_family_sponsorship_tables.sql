create type family_sponsorship_type as enum (
    'ramadan_basket',
    'monthly_expense',
    'eid_al_adha',
    'zakat',
    'housing_assistance'
    );
create table if not exists family_sponsorship
(
    "id"         uuid primary key,
    "family_id"  uuid                           not null references families (id) on delete cascade,
    "type"       family_sponsorship_type        not null,
    "value"      text                           not null,
    "tenant_id"  text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_family_sponsorship_id ON family_sponsorship ("id");

CREATE INDEX idx_family_sponsorship_family_id ON family_sponsorship ("family_id");

CREATE INDEX idx_family_sponsorship_type ON family_sponsorship ("type");

CREATE INDEX idx_family_sponsorship_value ON family_sponsorship ("value");

CREATE INDEX idx_family_sponsorship_tenant_id ON family_sponsorship ("tenant_id");

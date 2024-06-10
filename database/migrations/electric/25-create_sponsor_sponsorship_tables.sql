create type sponsor_sponsorship_type as enum (
    'guaranteed_medical',
    'support_the_draft',
    'literacy_classes',
    'direct_sponsorship'
    );

create table if not exists sponsor_sponsorship
(
    "id"         uuid primary key,
    "sponsor_id" uuid                           not null references sponsors (id) on delete cascade,
    "type"       sponsor_sponsorship_type       not null,
    "value"      text                           not null,
    "tenant_id"  text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_sponsor_sponsorship_id ON sponsor_sponsorship ("id");

CREATE INDEX idx_sponsor_sponsorship_sponsor_id ON sponsor_sponsorship ("sponsor_id");

CREATE INDEX idx_sponsor_sponsorship_type ON sponsor_sponsorship ("type");

CREATE INDEX idx_sponsor_sponsorship_value ON sponsor_sponsorship ("value");

CREATE INDEX idx_sponsor_sponsorship_tenant_id ON sponsor_sponsorship ("tenant_id");

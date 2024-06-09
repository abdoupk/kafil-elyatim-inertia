create type orphan_sponsorship_type as enum (
    'school_bag',
    'private_lessons',
    'eid_suit',
    'summer_camp',
    'college_trips',
    'fellowship',
    'guaranteed_medical',
    'other'
    );

create table if not exists orphan_sponsorship
(
    "id"         uuid primary key,
    "orphan_id"  uuid                           not null references orphans (id) on delete cascade,
    "type"       orphan_sponsorship_type        not null,
    "value"      text                           null,
    "tenant_id"  text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_orphan_sponsorship_id ON orphan_sponsorship ("id");

CREATE INDEX idx_orphan_sponsorship_orphan_id ON orphan_sponsorship ("orphan_id");

CREATE INDEX idx_orphan_sponsorship_type ON orphan_sponsorship ("type");

CREATE INDEX idx_orphan_sponsorship_value ON orphan_sponsorship ("value");

CREATE INDEX idx_orphan_sponsorship_tenant_id ON orphan_sponsorship ("tenant_id");

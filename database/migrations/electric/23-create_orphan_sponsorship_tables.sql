create table if not exists orphan_sponsorship
(
    "id"                     uuid primary key,
    "orphan_id"              uuid                           not null references orphans (id) on delete cascade,
    "medical_sponsorship"    boolean                        not null,
    "university_scholarship" boolean                        not null,
    "university_trips"       boolean                        not null,
    "summer_camp"            boolean                        not null,
    "eid_suit"               boolean                        not null,
    "private_lessons"        boolean                        not null,
    "school_bag"             boolean                        not null,
    "tenant_id"              text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at"             timestamp(0) without time zone null,
    "updated_at"             timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_orphan_sponsorship_id ON orphan_sponsorship ("id");

CREATE INDEX idx_orphan_sponsorship_orphan_id ON orphan_sponsorship ("orphan_id");

CREATE INDEX idx_orphan_sponsorship_type ON orphan_sponsorship ("type");

CREATE INDEX idx_orphan_sponsorship_value ON orphan_sponsorship ("value");

CREATE INDEX idx_orphan_sponsorship_tenant_id ON orphan_sponsorship ("tenant_id");

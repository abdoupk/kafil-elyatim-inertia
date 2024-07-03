create table if not exists orphan_sponsorship
(
    "id"                     uuid primary key,
    "orphan_id"              uuid                           not null references orphans (id) on delete cascade,
    "medical_sponsorship"    text                           null,
    "university_scholarship" text                           null,
    "association_trips"      text                           null,
    "summer_camp"            text                           null,
    "eid_suit"               text                           null,
    "private_lessons"        text                           null,
    "school_bag"             text                           null,
    "tenant_id"              text                           not null references "tenants" ("id") on delete cascade on update cascade,
    "created_at"             timestamp(0) without time zone null,
    "updated_at"             timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_orphan_sponsorship_id ON orphan_sponsorship ("id");

CREATE INDEX idx_orphan_sponsorship_orphan_id ON orphan_sponsorship ("orphan_id");


CREATE INDEX idx_orphan_sponsorship_tenant_id ON orphan_sponsorship ("tenant_id");

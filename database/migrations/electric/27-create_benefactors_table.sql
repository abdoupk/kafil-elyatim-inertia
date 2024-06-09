CREATE TABLE IF NOT EXISTS benefactors
(
    "id"         uuid                           not null primary key,
    tenant_id    text                           not null references tenants (id) on delete cascade,
    "deleted_at" timestamp(0) without time zone null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_benefactors_id ON benefactors ("id");

CREATE INDEX idx_benefactors_tenant_id ON benefactors ("tenant_id");


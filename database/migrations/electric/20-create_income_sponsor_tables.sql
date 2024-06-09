create table if not exists income_sponsor
(
    "id"         uuid primary key,
    "income_id"  uuid                           not null references incomes (id) on delete cascade,
    "sponsor_id" uuid                           not null references sponsors (id) on delete cascade,
    "tenant_id"  text                           not null references tenants (id) on delete cascade,
    "value"      double precision               not null,
    "created_at" timestamp(0) without time zone null,
    "updated_at" timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_income_sponsor_id ON income_sponsor ("id");

CREATE INDEX idx_income_sponsor_income_id ON income_sponsor ("income_id");

CREATE INDEX idx_income_sponsor_sponsor_id ON income_sponsor ("sponsor_id");

CREATE INDEX idx_income_sponsor_tenant_id ON income_sponsor ("tenant_id");

CREATE INDEX idx_income_sponsor_value ON income_sponsor ("value");

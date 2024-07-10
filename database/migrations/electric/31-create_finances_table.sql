create table "finances"
(
    "id"          uuid                           not null,
    "amount"      double precision               not null,
    "description" text                           null,
    "date"        timestamp(0) without time zone not null,
    "created_by"  uuid                           not null,
    "tenant_id"   uuid                           not null,
    "created_at"  timestamp(0) without time zone null,
    "updated_at"  timestamp(0) without time zone null
);

-- Create Indexes
CREATE INDEX idx_finances_id ON finances ("id");

alter table "finances"
    add primary key ("id")

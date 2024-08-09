CREATE TYPE donation_specification AS ENUM (
    'drilling_wells',
    'monthly_sponsorship',
    'eid_el_adha',
    'eid_el_fitr',
    'other',
    'school_entry',
    'analysis',
    'therapy',
    'ramadan_basket'
    );


CREATE TABLE "finances"
(
    "id"            UUID                           NOT NULL,
    "amount"        double precision               NOT NULL,
    "description"   text                           NULL,
    "date"          timestamp(0) WITHOUT TIME ZONE NOT NULL,
    "specification" donation_specification         NOT NULL,
    "created_by"    UUID                           NOT NULL,
    "tenant_id"     UUID                           NOT NULL,
    "created_at"    timestamp(0) WITHOUT TIME ZONE NULL,
    "updated_at"    timestamp(0) WITHOUT TIME ZONE NULL,
    "deleted_at"    timestamp(0) without time zone null
);

-- Create Indexes

CREATE INDEX idx_finances_id ON finances ("id");


ALTER TABLE "finances"
    ADD PRIMARY KEY ("id")

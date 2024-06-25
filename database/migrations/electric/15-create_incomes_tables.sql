create table if not exists incomes
(
    "id"           uuid primary key,
    "cnr"          text not null,
    "cnas"         text not null,
    "casnos"       text not null,
    "pension"      text not null,
    "account"      text not null,
    "other_income" text not null,
    "sponsor_id"   uuid not null references sponsors ("id")
);

-- Create Indexes
CREATE INDEX idx_incomes_id ON incomes ("id");

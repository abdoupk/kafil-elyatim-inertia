create table if not exists incomes
(
    "id"   uuid primary key,
    "name" text not null
);

-- Create Indexes
CREATE INDEX idx_incomes_id ON incomes ("id");

CREATE INDEX idx_incomes_name ON incomes ("name");

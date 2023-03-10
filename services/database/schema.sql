CREATE TABLE sales (
  id          bigserial,
  uuid        uuid,
  total       numeric(7, 2) DEFAULT 0.0,
  sale_date   timestamp with time zone NOT NULL,
  created_at  timestamp with time zone NOT NULL DEFAULT NOW()
);
CREATE TABLE public.checkout (
                                 id integer NULL GENERATED BY DEFAULT AS IDENTITY,
                                 item varchar NULL,
                                 "time" date NULL
);
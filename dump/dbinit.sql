CREATE TABLE payments (
  id SERIAL PRIMARY KEY,
  title text,
  value double precision DEFAULT NULL,
  date date DEFAULT NULL,
  external_tax double precision DEFAULT NULL,
  comments varchar(255) DEFAULT NULL
)  ;


INSERT INTO payments (title, value, date, external_tax, comments) VALUES
('Pagamento Exemplo', 42, '2020-11-16', 2.1, 'N/A'),
('Exemplo 2', 72, '2020-09-29', 3.6, 'Pago');
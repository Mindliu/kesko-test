-- # 11. Create SQL which will normalize phone numbers in table contacts by removing country code. Country code is predefined 371
SELECT *,
    CASE
        WHEN phone_number LIKE '+371%' THEN REPLACE(phone_number, '+371', '')
        WHEN phone_number LIKE '371%' THEN REPLACE(phone_number, '371', '')
        WHEN phone_number LIKE '371%' THEN REPLACE(phone_number, '00371', '')
        WHEN phone_number LIKE '371%' THEN REPLACE(phone_number, '371 ', '')
        WHEN phone_number LIKE '371%' THEN REPLACE(phone_number, '+371 ', '')
        ELSE phone_number
        END AS normalized_phone_number
FROM contacts;

-- # For actually updating the table values using chunks
-- DO $$
--     DECLARE
-- total_rows INT;
--     chunk_size INT := 300;
--     current_offset INT := 0;
-- BEGIN
-- SELECT COUNT(*) INTO total_rows FROM contacts;
--
-- WHILE current_offset < total_rows LOOP
-- UPDATE contacts AS main
-- SET phone_number =
--         CASE
--             WHEN main.phone_number LIKE '+371%' THEN REPLACE(main.phone_number, '+371', '')
--             WHEN main.phone_number LIKE '371%' THEN REPLACE(main.phone_number, '371', '')
--             ELSE main.phone_number
--             END
--     FROM (
--                      SELECT id, phone_number
--                      FROM contacts
--                               OFFSET current_offset
--                      LIMIT chunk_size
--                  ) AS subquery
-- WHERE main.id = subquery.id;
--
-- current_offset := current_offset + chunk_size;
-- END LOOP;
-- END $$;

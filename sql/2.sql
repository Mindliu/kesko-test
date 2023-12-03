-- # 2. Create SQL query which will select all possible delivery addresses for pickup point delivery types
SELECT * FROM addresses
    LEFT JOIN pickup_points ON addresses.id = pickup_points.addr_id
WHERE dty_id = 5;

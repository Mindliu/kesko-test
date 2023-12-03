-- # 9. Create SQL query to retrieve Pickup Point count for Omniva grouped by city
SELECT city_addr.value, COUNT(*) as count FROM pickup_points
    LEFT JOIN (SELECT * FROM address_objects WHERE aot_id IN (SELECT id FROM address_object_types WHERE code = 'CITY')) city_addr ON pickup_points.addr_id = city_addr.addr_id
WHERE dty_id = 5
GROUP BY city_addr.value;

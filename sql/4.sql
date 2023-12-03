-- # 4. Create SQL query which will select address display values where each address object type is row. For example:
SELECT aot.code as type, COALESCE(aotv.value, address_objects.value) AS VALUE FROM address_objects
    LEFT JOIN (SELECT id, code FROM address_object_types) aot ON address_objects.aot_id = aot.id
    LEFT JOIN (SELECT id, value FROM address_object_type_values) aotv ON address_objects.aov_id = aotv.id
WHERE address_objects.addr_id = 1292;

-- # 6. Create SQL query which will select delivery fee for delivery type, order amount, order weight and for specific address type value
SELECT dtaat.dty_id, delivery_fee, order_total_amount_from, order_total_amount_to, total_product_weight_from, total_product_weight_to
FROM delivery_type_available_address_types dtaat
         LEFT JOIN delivery_fee_configuration ON dtaat.dty_id = delivery_fee_configuration.dty_id
WHERE dtaat.dty_id = 5
AND dtaat.atp_id = 5;

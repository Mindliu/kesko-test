1. Create SQL query which will select all possible address object type values for given address object type
-- @see sql\1.sql

2. Create SQL query which will select all possible delivery addresses for pickup point delivery types
-- @see sql\2.sql

3. Create PHP class or function which will create and edit user inputted address
@see App\Console\Commands\CreateOrUpdateAddress or run php artisan app:create-or-update-address for testing

4. Create SQL query which will select address display values where each address object type is row. For example:
-- @see sql\4.sql

5. Create PHP class or function which will build Full Address for inputted address
@see App\Console\Commands\BuildFullAddress or run php artisan app:build-full-address for testing

6. Create SQL query which will select delivery fee for delivery type, order amount, order weight and for specific address type value
-- @see sql\6.sql

7. Change delivery fee configuration so that DPD delivery for Riga will be 5 EUR cheaper than current delivery fee for DPD
@see App\Console\Commands\ChangeDeliveryFeeConfiguration or run php artisan app:change-delivery-fee-configuration

8. Change delivery fee configuration for extra 3 EUR charge for deliveries on Saturday
@see App\Console\Commands\ChangeDeliveryFeeOnSaturdays or run php artisan app:change-delivery-fee-on-saturdays

9. Create SQL query to retrieve Pickup Point count for Omniva grouped by city
-- @see sql\9.sql

10. Create delivery fee configuration for delivery to Lithuania shipped by DPD with fee 10 EUR if order weight is less than 10kg and 20 EUR otherwise
@see App\Console\Commands\CreateCustomDeliveryFeeConfiguration or run app:create-custom-delivery-fee-configuration

11. Create SQL which will normalize phone numbers in table contacts by removing country code. Country code is predefined 371
-- @see sql\11.sql

12. Eliminate normalized phone number duplicates in table contacts. Leave most recent contact (sorting by ID descending)
@see App\Console\Commands\DeleteNormalizedPhoneNumbers or run app:delete-normalized-phone-numbers

13. Assume you have orders table and there is a requirement to generate unique order numbers which can’t have gaps.
Create needed database structures and PHP class or function to generate unique order numbers without gaps
@see App\Console\Commands\CreateOrdersTable or run app:create-orders-table

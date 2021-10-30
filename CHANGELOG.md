# Changelog
Please put latest changes on top
Use ISO-8601 date format: YYYY-MM-DD

# 2021-10-29 
Move latest code 
From: https://github.com/BradGibson-coding/team-crider-02-orange
To: https://github.com/bpawletzki/team-crider-02-orange-docker 

Per instructions on https://hub.docker.com/_/mariadb "Initializing a fresh instance", created a docker-entrypoint-initdb.d directory to build new instances of the database.

# 2021-10-15 - Database Menu

                                    CHANGES
REMOVED FILES:

productsDetails.php
product-gallery.php
ajax-action.php
includes/connection.php

NEW FILES:

dbcontroller.php
cart.php
assets/img/cart.png
assets/css/cartstyle.css
directory setup_tables


CHANGED FILES:

Menu.php
components/nav.php

NEW DATABASE TABLES:

checkout
checkoutDetail
tblproduct

NEW FOLDER:


                                DETAILS
Removed Files:

All files under removed files were removed as they are now deprecated due to new menu. includes/connection.php is now dbcontroller.php which creates a class with private variables and functions for database connection, access, and queries.

New Files:
All new files are from template Brad found, modified slightly for local functionality, except for setup_tables folder.

db.controler.php -- purpose mentioned in removed files details above.

cart.php -- new checkout screen. Features a button to clear cart, remove individual items, and to checkout. Upon checkout, two database tables are updated. One to reflect items, quantities, and price, the other to reflect time the checkout button was pressed. Created action checkout case from lines 43-55. Added checkout button pointing to the checkout action.

assets/img/cart.png -- image for nav bar to reach cart.php. Will need resized.

assets/css/cartstyle.css -- stylesheet for cart.php. From the template Brad provided, currently has stylings for classes in both Menu.php and cart.php, may need integrated with styles.css

setup_tables -- contains a text file with sql statements for creating the new tables as well as a .sql file that can be imported via PHPMyAdmin meant to populate the new product table.

Changed Files:

Menu.php -- Completely new menu. Code that generated menu when viewing cart was taken from the original cart.php file and moved into this file. iframe named dummyframe created so page is not redirected to cart upon adding an item to the cart.

components/nav.php -- Just updated to hold cart icon linking to cart.php


Database Tables:

SQL to create these new tables found in setup_tables/sql_for_tables.txt

checkout just has columns "id"(primary key) and "checkoutTime" (generated when checkout button is pressed.)

checkoutDetail has foreign key relationships with product_id and checkout_id. Has columns price and quantity. Query will need to be written to join all necessary information for story. 

product contains new "code" column that was added for compatibility with previously written code in the template. 

# 2021-10-9 - 2nd iteration

Bootstrap and JQuery have both been updated to their current version.

The FAQs page was introuduced in this iteration as well as the hardcode menu.


# 2021-10-12 - 3rd iteration
Laura - i updated/added code for 'Add to cart' on the Menu page for each item. you will see Brad's initial items list is still in there. he  had added 'small, medium, large' but we need to add also pricing for each and ensure those added to the cart properly reflect. NOTE: i added prices for smalls and we could add an additional .50 for each size up from that. example: SM: 3.00 MED: 3.50 LG: 4.00
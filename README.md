# shopping_cart

# SetUp Codeginiter application for online shopping and web services for react application online shopping
- Change base_url from config folder
  application\config\config.php 
  $config['base_url'] = 'http://localhost/netmeds';
  
- Take database schema file from git database folder (netmeds.sql)
  
- Setup database connection detail
  application\config\database.php 
  $db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'netmeds',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
  );
  
- Login screen detail in codeginter
   username:- admin@admin.com
   password:- admin
 
- All Package list landing page after login
- Add to cart package
- Delete package from cart.


# SetUp React application for online shopping

- git clone https://github.com/sachin9785/shopping_cart.git

- Go to inside of netmeds-react folder and open git bash here
- npm init
- npm install
- npm start

- Login screen detail in react
   username:- admin@admin.com
   password:- admin
   
   
- Package list
- Add to cart :- Saved cart item into database of login user
- Login User Cart list with total price
- Delete cart package
- Place order

  
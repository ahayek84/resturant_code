<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


session_cache_limiter('private, must-revalidate');
session_cache_expire(60);

//Start PHP session
session_start();

require '../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../settings.php';
//print_r($settings);

$app = new \Slim\App($settings);

// setting up the dependencies
require __DIR__.'/../dependencies.php';

$app->get('/','HomeController:index')->setName('home');
$app->map(['POST', 'GET'], '/dashboard','AuthController:postSignIn');
$app->map(['POST', 'GET'], '/user','AuthController:viewUser');
$app->map(['POST', 'GET'], '/adduser', 'AuthController:addUser');
$app->map(['POST', 'GET'],'/edituser/{id}', 'AuthController:editUser');
$app->map(['POST', 'GET'], '/userdelete/{id}', 'AuthController:deleteUser');
$app->get('/logout', 'AuthController:logoutUser');
$app->map(['POST', 'GET'], '/requestpasswordreset/{token}/{email}', 'AuthController:requestPasswordReset');
$app->get('/success', 'HomeController:success')->setName('success');
$app->get('/reset', 'HomeController:reset');

$app->map(['POST', 'GET'], '/menu', 'MenuController:viewMenu');
$app->map(['POST', 'GET'], '/addmenu', 'MenuController:addMenu');
$app->map(['POST', 'GET'], '/editmenu/{id}', 'MenuController:editMenu');
$app->map(['POST', 'GET'], '/deletemenu/{id}', 'MenuController:deleteMenu');

$app->map(['POST', 'GET'], '/menuitem', 'MenuItemController:viewMenuItem');
$app->map(['POST', 'GET'], '/addmenuitem', 'MenuItemController:addMenuItem');
$app->map(['POST', 'GET'], '/editmenuitem/{id}', 'MenuItemController:editMenuItem');
$app->map(['POST', 'GET'], '/deletemenuitem/{id}', 'MenuItemController:deleteMenuItem');

$app->map(['POST', 'GET'], '/aboutus/{id}', 'HomeController:aboutusInformation');
$app->map(['POST', 'GET'], '/editaboutus/{id}', 'HomeController:editAboutusInformation');

$app->map(['POST', 'GET'], '/order', 'OrderController:viewOrders');
$app->map(['POST', 'GET'], '/singleorder/{id}', 'OrderController:viewSingleOrders');

// login from mobile client
$app->post('/signin', 'AuthController:signInMobileUser');
$app->post('/signinDelivery', 'AuthController:signInMobileUserDelivery');
$app->post('/signinAdmin', 'AuthController:signInMobileAdminUser');
$app->post('/register', 'AuthController:registerMobileUser');
$app->post('/passwordreset', 'AuthController:resetPassword');
$app->get('/mobilerestuarant', 'HomeController:viewMobileHomePage');
$app->map(['POST', 'GET'], '/mobilerestuarant/{id}', 'HomeController:viewMobileHomePageToOne');
$app->get('/mobilemenu', 'MobileController:viewMobileMenu');
$app->map(['POST', 'GET'], '/mobilemenu/{id}', 'MobileController:viewMobileMenuToOne');

$app->post('/mobilemenuitem', 'MobileController:viewMobileMenuItemById');
$app->map(['POST', 'GET'],'/mobileorderhistory/{id}', 'MobileController:viewMobileUserOrderHistory');
$app->get('/mobilehotdeal', 'MobileController:viewMobileHotDeal');
$app->map(['POST', 'GET'],'/mobileuseredit', 'MobileController:editUserProfile');
$app->map(['POST', 'GET'],'/mobileusereditpassword', 'MobileController:editUserPassword');
$app->post('/placeorder', 'MobileController:addOrderFromMobileUser');
$app->get('/allorders', 'MobileController:viewAllMobileOrderHistory');
$app->get('/allordersAdmin', 'MobileController:viewAllMobileOrderHistoryAdmin');
$app->get('/allordersDelivery', 'MobileController:viewAllMobileOrderHistoryDelivery');
$app->map(['POST', 'GET'], '/doneorder/{id}', 'MobileController:setStatus');

$app->map(['POST', 'GET'], '/doneorderAdmin/{id}', 'MobileController:setStatusAdmin');

// SMS functions
$app->map(['POST', 'GET'],'/SendSMS/{id}/{msg}', 'SMSController:SendSMS');
$app->map(['POST', 'GET'],'/GetMessageLog', 'SMSController:GetMessageLog');




$capsule = $app->getContainer()->get('capsule');
//$capsule->setAsGlobal();
$capsule->bootEloquent();

$app->run();

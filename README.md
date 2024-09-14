User Authentication and Product Management API

** Sample App For Authenticate Users - Products System.

*** Technology Stack Chosen:

* Programing Language:
-- PHP 

* Framework:
--Laravel

* Auth Package:
-- JWT

* Database: 
-- mysql 

* Provide API documentation:
-- swagger

*** User Management:
-- name
-- email
-- password
-- role => Must Be Super Admin - User ONLY.
-- address

**Endpoints:
--Register a new user: POST api/register
--Login: POST api/login
--Reset password: POST api/reset-password
--Get all users: GET api/users
--Get user details: POST api/user/{id}
--Update user details: PUT api/user/{id}
--Delete a user: DELETE api/user/{id}



*** Products Management:
-- name
-- description
-- prices
-- currency
-- stock_quantity

** Endpoints:
--Create a new product: POST api/product
--Get all products: GET api/product
--Get product details by ID: GET api/product/{id}
--Update product details: PUT api/product/{id}
--Delete a product: DELETE api/product/{id}


*** Testing:
-- Make a test validation in functions for errors [ status code ]

-----------------------------------------------------

*** How to Use:

- You can test it using postman or any other tool.
-- register new user.
-- login to get token.
-- use token in other Routes.


- using swagger
-- php artisan serve.
-- [your-localhost-path]/api/documentation
-- use register method.
-- login to get token.
-- use Authorize Button to paste token.
-- enjoy using all methods

--------------------------------------
ROUTS:

  GET|HEAD  / ................................................................ 
  GET|HEAD  api/documentation l5-swagger.default.api › L5Swagger\Http › Swagg…
  POST      api/login ................................... AuthController@login
  POST      api/logout ................................. AuthController@logout
  GET|HEAD  api/oauth2-callback l5-swagger.default.oauth2_callback › L5Swagge…
  POST      api/password/reset .................. AuthController@resetPassword
  POST      api/product .............................. ProductController@store
  GET|HEAD  api/product/{id} .......................... ProductController@show
  PUT       api/product/{id} ........................ ProductController@update
  DELETE    api/product/{id} ....................... ProductController@destroy
  GET|HEAD  api/products ............................. ProductController@index
  POST      api/register ............................. AuthController@register
  GET|HEAD  api/user/{id} ................................ UserController@show
  PUT       api/user/{id} .............................. UserController@update
  DELETE    api/user/{id} ............................. UserController@destroy
  GET|HEAD  api/users ................................... UserController@index
  GET|HEAD  docs/asset/{asset} l5-swagger.default.asset › L5Swagger\Http › Sw…
  GET|HEAD  docs/{jsonFile?} l5-swagger.default.docs › L5Swagger\Http › Swagg…
  GET|HEAD  sanctum/csrf-cookie sanctum.csrf-cookie › Laravel\Sanctum › CsrfC…
  GET|HEAD  storage/{path} ..................................... storage.local
  GET|HEAD  up ............................................................... 


[IMPORTANT] => login to get token from response to can use all methodes

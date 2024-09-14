# User Authentication and Product Management API

**Sample App for Authenticating Users and Managing Products**

### Technology Stack

- **Programming Language**: PHP
- **Framework**: Laravel
- **Auth Package**: JWT
- **Database**: MySQL
- **API Documentation**: Swagger

### User Management

- **User Properties**:
  - `name`
  - `email`
  - `password`
  - `role` (Must be "super admin" or "user")
  - `address`

- **Endpoints**:
  - **Register a New User**: `POST api/register`
  - **Login**: `POST api/login`
  - **Reset Password**: `POST api/reset-password`
  - **Get All Users**: `GET api/users`
  - **Get User Details**: `GET api/user/{id}`
  - **Update User Details**: `PUT api/user/{id}`
  - **Delete a User**: `DELETE api/user/{id}`

### Product Management

- **Product Properties**:
  - `name`
  - `description`
  - `price`
  - `currency`
  - `stock_quantity`

- **Endpoints**:
  - **Create a New Product**: `POST api/product`
  - **Get All Products**: `GET api/product`
  - **Get Product Details by ID**: `GET api/product/{id}`
  - **Update Product Details**: `PUT api/product/{id}`
  - **Delete a Product**: `DELETE api/product/{id}`

### Testing

- Validate functionality and error handling using Postman or similar tools.
- Ensure token-based authentication works properly.

### How to Use

1. **Using Postman**:
   - Register a new user.
   - Log in to obtain a token.
   - Use the token in subsequent requests.

2. **Using Swagger**:
   - Run `php artisan serve`.
   - Visit `[your-localhost-path]/api/documentation`.
   - Register and log in to obtain a token.
   - Use the "Authorize" button to paste the token.
   - Test endpoints using Swagger's interface.

### Routes

- **GET|HEAD** `/` ........................................................... /
- **GET|HEAD** `api/documentation` ......................... Open Swagger
- **POST** `api/login` ........................................ AuthController@login
- **POST** `api/logout` ...................................... AuthController@logout
- **POST** `api/password/reset` ........................ AuthController@resetPassword
- **POST** `api/product` ........................................... ProductController@store
- **GET|HEAD** `api/product/{id}` ...................... ProductController@show
- **PUT** `api/product/{id}` ............................... ProductController@update
- **DELETE** `api/product/{id}` .......................... ProductController@destroy
- **GET|HEAD** `api/products` ................................ ProductController@index
- **POST** `api/register` .................................... AuthController@register
- **GET|HEAD** `api/user/{id}` ................................. UserController@show
- **PUT** `api/user/{id}` .................................... UserController@update
- **DELETE** `api/user/{id}` ............................... UserController@destroy
- **GET|HEAD** `api/users` .................................... UserController@index

**[IMPORTANT]**: Log in to obtain a token and use it for accessing protected methods.

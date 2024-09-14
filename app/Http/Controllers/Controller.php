<?php

namespace App\Http\Controllers;
use OpenApi\Annotations as OA;
/**

 * @OA\Info(

 *     title="User Authentication and Product Management API",

 *     description="You Must Login First to get Token and Use Authintcate Button to Can Test The App",

 *     version="1.0.0"

 * )

 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer"
 * )

 */
abstract class Controller
{
    //
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *  @OA\Info(
 *      description="Challenge developed to apply for a position at Studio Sol.",
 *      version="1.0.0",
 *      title="Studio Sol Challenge",
 * 		@OA\Contact(
 * 			email="guilhermecostadev@gmail.com"
 * 		),
 * 		@OA\License(
 * 			name="Apache 2.0",
 * 			url="http://www.apache.org/licenses/LICENSE-2.0.html"
 * 		)
 *  ),
 *
 *  @OA\Tag(
 *      name="verify",
 *      description="Methods to verify password"
 *  ),
 *
 *  @OA\PathItem(
 *      path="/app"
 *  ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

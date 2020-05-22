<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('get')->group(function($route){
    $route->get('coupon', 'CouponController@getCoupon');
    $route->get('test', function (){
        $collection = collect([
           [
               'product_id'=>2
           ],
           [
               'product_id'=>21
           ],
           [
               'product_id'=>23
           ],
        ]);

        $res = $collection->pluck('product_id');

        dd(
            $res->toArray()
        );
    });
    $route->get('import', 'ExportController@getImportInfo');
});

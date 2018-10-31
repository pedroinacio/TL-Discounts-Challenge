<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/*
|----------------------------------------------------------------------------
| Discounts
|----------------------------------------------------------------------------
|
| Here is we check which discounts can be used. The request is passed through 
| the different types of possibles discounts, and updated if any of the 
| discounts can be applied.
|
*/

class DiscountsController extends Controller
{   
    const TYPE1_MIN_REVENUE = 1000; //Minimum customer revenue for type 1 discount
    const TYPE1_DISCOUNT    = 10;   //Discount for type 1
    
    const TYPE2_CAT         = 2;    //Category for the type 2 discount
    const TYPE2_MIN_CAT_2   = 5;    //Minimum number of items of category TYPE2_CAT that grants the type 2 discount
    const TYPE2_DISCOUNT    = 1;    //Free items added for type 2 discount

    const TYPE3_CAT         = 1;    //Category for the type 3 discount
    const TYPE3_MIN_CAT_1   = 2;    //Minimum number of items of category TYPE3_CAT that grants the type 3 discount
    const TYPE3_DISCOUNT    = 20;   //Discount for type 3

    public function update(Request $request) {
        $response = $this->getDiscount($request);

    	return response()->json($response, 201);
    }

    /**
     * The order request, 'cascades' through the many discounts available, and returns updated
     */
    private function getDiscount(Request $request) {        
        $request = $this->discountType1($request);
        $request = $this->discountType2($request);
        $request = $this->discountType3($request);
        //Add your next discount here

        return $request;
    }

    //A customer who has already bought for over € 1000, gets a discount of 10% on the whole order
    private function discountType1(Request $request) {
        $customer = Customer::where('id',$request->id)->first();        
        
        if($customer->revenue >= self::TYPE1_MIN_REVENUE){
            $request['total'] = $request->total - ($request->total/10);

            //Verbose message reply
            $request->request->add(['type1' => true]);
        }

        return $request;
    }

    //For every product of category "Switches" (id 2), when you buy five, you get a sixth for free
    private function discountType2(Request $request) {      
        $items = $request->items;

        for($i = 0; count($items) > $i; $i++) {
            //It's easier to get the quantity, so we check it before checking the category
            if($items[$i]['quantity'] >= self::TYPE2_MIN_CAT_2){
                $category = Product::where('product_id',$items[$i]['product-id'])->first();

                if($category['category'] == self::TYPE2_CAT){
                    //Add one free item
                    $items[$i]['quantity'] = $items[$i]['quantity'] + self::TYPE2_DISCOUNT;

                    //Verbose message reply
                    $request->request->add(['type2' => true]);
                }
            }
        }

        $request['items'] = $items;

        return $request;
    }

    //If you buy two or more products of category "Tools" (id 1), you get a 20% discount on the cheapest product
    private function discountType3(Request $request) {
        $items = $request->items;
        $number_of_products_of_cat_3 = 0;
        $cheapest_product_of_cat_3 = [];//No cheapest item in the beggining of the process

        for($i = 0; count($items) > $i; $i++) {
            $category = Product::where('product_id',$items[$i]['product-id'])->first();

            //If this item is from the TYPE3_CAT category, save item if cheaper than current cheapest
            if($category['category'] == self::TYPE3_CAT){
                $number_of_products_of_cat_3 += $items[$i]['quantity'];
                if(!isset($cheapest_product_of_cat_3['unit-price']) || $items[$i]['unit-price'] < $cheapest_product_of_cat_3['unit-price']){
                    $cheapest_product_of_cat_3['unit-price'] = $items[$i]['unit-price'];
                    $cheapest_product_of_cat_3['product_key'] = $i;
                }
            }
        }

        //Finally, if $cheapest_product_of_cat_3 is not empty and $number_of_products_of_cat_3 is bigger than TYPE3_MIN_CAT_1, 
        //apply the 20% to the item with the product-id in $cheapest_product_of_cat_3['product-id'], for that is the cheapest item
        if(isset($cheapest_product_of_cat_3['product_key']) && $number_of_products_of_cat_3 >= self::TYPE3_MIN_CAT_1){
            $i = $cheapest_product_of_cat_3['product_key'];
            $items[$i]['total'] = $items[$i]['total'] - ($items[$i]['total']/20);

            //Verbose message reply
            $request->request->add(['type3' => true]);
        }

        $request['items'] = $items;

        return $request;
    }
}
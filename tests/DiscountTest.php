<?php
class DiscountTest extends TestCase
{
    /**
     * /products [GET]
     * Return all products
     */
    
    public function testShouldReturnAllProducts(){
        $payload = [];

        $headers = [];

        
        $this->json('GET', 'products', $payload);
        $this->seeStatusCode(201);
        
    }
    
    /**
     * /discounts [PUT]
     * This test was build so type 1 discount can be applied
     */
    
    public function testShouldReturnDiscountType1(){
        $payload = [
            'id' => '2',
            'customer-id' => '2',
            'items' => [                
                [
                    'product-id' => 'A102',
                    'quantity' => '2',
                    'unit-price' => '9.75',
                    'total' => '19.50'
                ]
            ],
            'total' => '19.50'
        ];

        $this->json('PUT', 'discounts', $payload);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(                
                [
                    'id',
                    'customer-id',
                    'items',
                    'total',
                    'type1'
                ]
            );
    }

    /**
     * /discounts [PUT]
     * This test was build so type 2 discount can be applied
     */
    
    public function testShouldReturnDiscountType2(){
        $payload = [
            'id' => '2',
            'customer-id' => '2',
            'items' => [                
                [
                    'product-id' => 'B102',
                    'quantity' => '5',
                    'unit-price' => '4.99',
                    'total' => '24.95'
                ]
            ],
            'total' => '24.95'
        ];

        $this->json('PUT', 'discounts', $payload);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(                
                [
                    'id',
                    'customer-id',
                    'items',
                    'total',
                    'type2'
                ]
            );
    }

    /**
     * /discounts [PUT]
     * This test was build so type 3 discount can be applied
     */
    
    public function testShouldReturnDiscountType3(){
        $payload = [
            'id' => '2',
            'customer-id' => '1',
            'items' => [                
                [
                    'product-id' => 'A102',
                    'quantity' => '2',
                    'unit-price' => '9.75',
                    'total' => '19.50'
                ]
            ],
            'total' => '143.45'
        ];

        $this->json('PUT', 'discounts', $payload);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(                
                [
                    'id',
                    'customer-id',
                    'items',
                    'total',
                    'type3'
                ]
            );
    }

    /**
     * /discounts [PUT]
     * This test was build so every 3 types of discount can be applied
     */
    
    public function testShouldReturnDiscount(){
        $payload = [
            'id' => '2',
            'customer-id' => '2',
            'items' => [
                [
                    'product-id' => 'A101',
                    'quantity' => '1',
                    'unit-price' => '49.50',
                    'total' => '49.50'
                ],
                [
                    'product-id' => 'A102',
                    'quantity' => '2',
                    'unit-price' => '9.75',
                    'total' => '19.50'
                ],
                [
                    'product-id' => 'B102',
                    'quantity' => '5',
                    'unit-price' => '4.99',
                    'total' => '24.95'
                ],
                [
                    'product-id' => 'B101',
                    'quantity' => '1',
                    'unit-price' => '49.50',
                    'total' => '49.50'
                ]
            ],
            'total' => '143.45'
        ];

        $this->json('PUT', 'discounts', $payload);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(                
                [
                    'id',
                    'customer-id',
                    'items',
                    'total',
                    'type1',
                    'type2',
                    'type3'
                ]
            );
    }    
}
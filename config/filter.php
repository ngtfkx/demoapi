<?php

return [
    'default' => [
        'price_from' => ['>=', 'price'],
        'price_till' => ['<=', 'price'],
        'calorific' => ['='],
        'is_new' => ['='],
        'is_top' => ['='],
        'query' => ['like', ['name', 'description', 'photo_desc']],
    ],
];
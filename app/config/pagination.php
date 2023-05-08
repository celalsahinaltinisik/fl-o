<?php

/** @see \App\Http\Middleware\CheckPerPageQueryParameterForPagination::handle() */
return [

    // Query parameter name
    'param_name' => 'per_page',

    // Default per page value. It must be the same as the first element
    // in the allowed array.
    'per_page' => 10,

    // Allowed per page values. Arrange according to the paging component
    // used in Frontend.
    'allowed' => [
        25,
        50,
        100,
        150,
        200,
        1,
        2,
        5,
        1000,
        2000,
        3000,
    ],

    // If strict is true, non-allowed values will trigger an exception.
    // Otherwise, the value will be changed to default, silently...
    'strict' => true,
];

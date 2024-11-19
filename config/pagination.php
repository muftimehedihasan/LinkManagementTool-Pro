<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Pagination View
    |--------------------------------------------------------------------------
    |
    | This option controls the default pagination view that will be used by
    | the framework when generating pagination links for your application.
    | You are free to customize this view and use a different one.
    |
    */

    'default' => 'tailwind',

    /*
    |--------------------------------------------------------------------------
    | Pagination View Names
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the view names that should be used when the
    | framework needs to paginate a given set of items. You can customize
    | these views based on the styling framework or design you prefer.
    |
    */

    'views' => [
        'simple' => 'pagination::simple-tailwind',
        'default' => 'pagination::tailwind',
    ],

];

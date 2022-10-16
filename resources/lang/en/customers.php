<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'badged_status' =>  [
        'enabled' => '<span class="badge badge-success">Enabled</span>',
        'disabled' => '<span class="badge badge-danger">Disabled</span>',
        'expire_soon' => '<span class="badge badge-warning">Expire Soon</span>',
    ],
    'options_status' =>  [
        [
            'value'=>'enabled',
            'label'=>'Enabled'
        ],
        [
            'value'=>'disabled',
            'label'=>'Disabled'
        ],
        [
            'value'=>'expire_soon',
            'label'=>'Expire Soon'
        ],
    ],

];

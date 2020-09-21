<?php
/*-----------------------------------------------------------------------------------

Register Cesis Custom grids

-----------------------------------------------------------------------------------*/
add_filter('tg_register_item_skin', function($skins) {

    // just push your skin slugs (file name) inside the registered skin array
    $skins = array_merge($skins,
        array(
            'tg-cesis-coffee-blog' => array(
                'filter'   => 'Blog', // filter name used in slider skin preview
                'name'     => 'Cesis Coffee Blog', // Skin name used in skin preview label
                'col'      => 1, // col number in preview skin mode
                'row'      => 1  // row number in preview skin mode
            )
        )
    );
    $skins = array_merge($skins,
        array(
            'tg-cesis-coffee-on-image-blog' => array(
                'filter'   => 'Blog', // filter name used in slider skin preview
                'name'     => 'Cesis Coffee On Image Blog', // Skin name used in skin preview label
                'col'      => 1, // col number in preview skin mode
                'row'      => 1  // row number in preview skin mode
            )
        )
    );
    $skins = array_merge($skins,
        array(
            'tg-cesis-coffee-products' => array(
                'filter'   => 'WooCommerce', // filter name used in slider skin preview
                'name'     => 'Cesis Coffee Products', // Skin name used in skin preview label
                'col'      => 1, // col number in preview skin mode
                'row'      => 1  // row number in preview skin mode
            )
        )
    );

    // return all skins + the new one we added (my-skin1)
    return $skins;

});

?>

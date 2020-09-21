<?php

    // All extensions placed within the extensions directory will be auto-loaded for your Redux instance.
    Redux::setExtensions( 'cesis_data', get_parent_theme_file_path('/admin/redux-extensions/extensions/' ));

    // Any custom extension configs should be placed within the configs folder.
    if ( file_exists( get_parent_theme_file_path('/admin/redux-extensions/configs/' )) ) {
        $files = glob( get_parent_theme_file_path('/admin/redux-extensions/configs/*.php' ));
        if ( ! empty( $files ) ) {
            foreach ( $files as $file ) {
                include $file;
            }
        }
    }

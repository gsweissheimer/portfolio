<?php
return array(
	'PLUGIN_ROOT'           => CP_PLUGIN_DIR,
	'WP_ROOT'               => preg_replace( '/$\//', '', ABSPATH ),
	'PLUGIN_DIR'            => basename( CP_PLUGIN_DIR ),
	'PLUGIN_URI'            => CP_PLUGIN_URL,
	'CONFIG_DIR'            => CP_PLUGIN_DIR . '/config',
	'LIB_DIR'               => CP_PLUGIN_DIR . '/lib',
	'ASSETS_DIR'            => CP_PLUGIN_DIR . '/assets',
	'ASSETS_URI'            => CP_PLUGIN_URL . 'assets',
	'ASSETS_IMG_URI'        => CP_PLUGIN_URL . 'assets/img',
	'ASSETS_IMG_DIR'        => CP_PLUGIN_DIR . 'assets/img',
	'INCLUDE_DIR'           => CP_PLUGIN_DIR . '/include',
	'ASSETS_DIR_NAME'       => 'assets',

	'BLOCKS_DIR'            => CP_PLUGIN_DIR . 'blocks',
	'BLOCKS_URI'            => CP_PLUGIN_URL . 'blocks',
	'BLOCKS_IMG_ASSETS_DIR' => CP_PLUGIN_DIR . 'blocks/assets/img',
	'BLOCKS_IMG_ASSETS_URL' => CP_PLUGIN_URL . 'blocks/assets/img',


	'PLUGIN_URI_FILES'      => CP_PLUGIN_URL . 'files',
	'PLUGIN_DIR_FILES'      => CP_PLUGIN_DIR . '/files',
	'TEMP_DIR'              => CP_PLUGIN_DIR . 'files/stock_photos/',
	'TEMP_URL'              => CP_PLUGIN_DIR . 'files/',
);

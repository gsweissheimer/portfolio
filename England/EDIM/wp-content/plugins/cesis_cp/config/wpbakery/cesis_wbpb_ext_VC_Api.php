<?php
// don't load directly
if( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class cesis_wbpb_ext_VC_Api
{

	function __construct()
	{
	}

	/**
	 * Confirm if whe are on frontend editor
	 *
	 * @since   1.0.0
	 * @version 1.0
	 *
	 * @return  boolean
	 */
	public
	function in_frontend_editor() {
		if(vc_mode() == "page_editable" OR vc_mode() == "admin_page" ):
			return true;
		else:
			return false;
		endif;

	}
}



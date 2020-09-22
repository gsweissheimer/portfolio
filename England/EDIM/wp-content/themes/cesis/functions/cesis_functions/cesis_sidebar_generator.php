<?php

if (!class_exists('sidebar_generator')) {

class sidebar_generator {

	public function __construct(){

		add_action('init',array('sidebar_generator','init'));
		add_action('admin_menu',array('sidebar_generator','admin_menu'));
		add_action('admin_enqueue_scripts', array('sidebar_generator','admin_enqueue_scripts'));
		add_action('admin_print_scripts', array('sidebar_generator','admin_print_scripts'));

		if ( current_user_can('manage_options') ){

		add_action('wp_ajax_add_sidebar', array('sidebar_generator','add_sidebar') );
		add_action('wp_ajax_remove_sidebar', array('sidebar_generator','remove_sidebar') );

		}

	}

public static function init(){
		//go through each sidebar and register it
	    $sidebars = sidebar_generator::get_sidebars();


	    if(is_array($sidebars)){
			foreach($sidebars as $sidebar){
				$sidebar_class = sidebar_generator::name_to_class($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,

					'id' => sanitize_title('thefox_'.strtolower($sidebar_class)),
					'before_widget' => '<section id="%1$s" class="cesis_widget %2$s">',
					'after_widget' => '</section>',
					'before_title' => '<h2 class="cesis_widget_title">',
					'after_title' => '</h2>',
		    	));
			}
		}
	}

public static function admin_enqueue_scripts() {
		wp_enqueue_script( array( 'sack' ));
}

	public static function admin_print_scripts(){

		?>
			<script>
				function add_sidebar( sidebar_name )
				{
					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );

				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "add_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
					mysack.setVar( 'sidebar_generator_nonce', '<?php echo wp_create_nonce('add_sidebar'); ?>' );
				  	//mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					return true;
				}

				function remove_sidebar( sidebar_name,num )
				{

					var mysack = new sack("<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );

				  	mysack.execute = 1;
				  	mysack.method = 'POST';
				  	mysack.setVar( "action", "remove_sidebar" );
				  	mysack.setVar( "sidebar_name", sidebar_name );
				  	mysack.setVar( "row_number", num );
						mysack.setVar( 'sidebar_generator_nonce', '<?php echo wp_create_nonce('remove_sidebar'); ?>' );
				  	//mysack.encVar( "cookie", document.cookie, false );
				  	mysack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	mysack.runAJAX();
					//alert('hi!:::'+sidebar_name);
					return true;
				}
			</script>

		<?php

	}

	public static function add_sidebar(){
check_admin_referer( 'add_sidebar', 'sidebar_generator_nonce' );
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);

		if(is_array($sidebars) && !empty($sidebars)){
			$counter = count( $sidebars ) + 1;
		} else {
			$counter = 1;
		}
		$id = sidebar_generator::name_to_class($name);

		if(isset($sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}

		$sidebars[$id] = $name;
		sidebar_generator::update_sidebars($sidebars);

		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);

			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);

			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);

			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)

			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
	  		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\', $counter)');
			removeLink.setAttribute('href', 'javascript:void(0)');

	  		removeLink.appendChild(linkText);
	  		cellLeft.appendChild(removeLink);


		";


		die( "$js");
	}

	public static function remove_sidebar(){
check_admin_referer( 'remove_sidebar', 'sidebar_generator_nonce' );
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if(!isset($sidebars[$id])){
			die("alert('Sidebar does not exist.')");
		}
		$row_number = $_POST['row_number'];
		unset($sidebars[$id]);
		sidebar_generator::update_sidebars($sidebars);
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)

		";
		die($js);
	}

	public static function admin_menu(){
		add_theme_page('Sidebars', 'Sidebars', 'manage_options', 'multiple_sidebars', array('sidebar_generator','admin_page'));

}

	public static function admin_page(){
		?>
		<script>
			function remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = prompt("Sidebar Name:","");
				//alert(sidebar_name);
				add_sidebar(sidebar_name);
			}
		</script>
		<div class="wrap">
			<h2>Sidebars</h2>
			<br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Sidebar Name</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$sidebars = sidebar_generator::get_sidebars();
				$cnt=0;
				if(is_array($sidebars) && !empty($sidebars)){
					$cnt=0;
					foreach($sidebars as $sidebar){
						$alt = ($cnt%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo esc_attr($alt) ?>">
					<td><?php echo esc_html($sidebar); ?></td>
					<td><?php echo esc_html(sidebar_generator::name_to_class($sidebar)); ?></td>
					<td><a href="javascript:void(0);" onclick="return remove_sidebar_link('<?php echo esc_attr($sidebar); ?>',<?php echo esc_attr($cnt+1); ?>);" title="Remove this sidebar">remove</a></td>
				</tr>
				<?php
						$cnt++;
					}
				}
				?>
			</table><br /><br />
			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="Add a sidebar" class="button-primary">+ Add New Sidebar</a>

			</div>

		</div>
		<?php
	}



	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
public static function get_sidebar($name="0"){
		if(!is_singular()){
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar('Sidebar');
			}
			return;//dont do anything
		}
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
		$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
		$did_sidebar = false;
		//this page uses a generated sidebar
		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "";
			if(is_array($selected_sidebar) && !empty($selected_sidebar)){
				for($i=0;$i<sizeof($selected_sidebar);$i++){

					if($name == "0" && $selected_sidebar[$i] == "0" &&  $selected_sidebar_replacement[$i] == "0"){
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar('Sidebar');//default behavior
						$did_sidebar = true;
						break;
					}elseif($name == "0" && $selected_sidebar[$i] == "0"){
						//we are replacing the default sidebar with something
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						$did_sidebar = true;
						break;
					}elseif($selected_sidebar[$i] == $name){
						//we are replacing this $name
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						$did_sidebar = true;
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						break;
					}
					//echo "<!-- called=$name selected={$selected_sidebar[$i]} replacement={$selected_sidebar_replacement[$i]} -->\n";
				}
			}
			if($did_sidebar == true){
				echo "";
				return;
			}
			//go through without finding any replacements, lets just send them what they asked for
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar('Sidebar');
			}
			echo "";
			return;
		}else{
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar('Sidebar');
			}
		}
	}

	/**
	 * replaces array of sidebar names
	*/
	public static function update_sidebars($sidebar_array){
		$sidebars = update_option('sbg_sidebars',$sidebar_array);
	}

	/**
	 * gets the generated sidebars
	*/
	public static function get_sidebars(){
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}
	public static function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}

}
$sbg = new sidebar_generator;

function generated_dynamic_sidebar($name='0'){
	sidebar_generator::get_sidebar($name);
	return true;
}

}
?>

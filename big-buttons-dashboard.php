<?php
/*
Plugin Name: Big Buttons Dashboard
Plugin URI: 
Description: This is a plugin to make the dashboard easy to use for non-WordPress, non-technical people, and for those of us who don't normally use the Dashboard.
Version: 0.1
Author: J.J. Springer
Author URI: http://chickadeedesignery.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This is adding the custom style for the classic WordPress dashboard.
*/
function add_custom_classic_style()
{
	wp_enqueue_style(
		'bbdash-classicstyle',
		plugins_url( 'css/classic-style.css', __FILE__ ),
		false,
		'v0.1'
	);
}
add_action( 'admin_enqueue_scripts', 'add_custom_classic_style' );

/*
This is adding the custom style for the MP6 plugin.
*/
function add_custom_mp6_style()
{
	wp_enqueue_style(
		'bbdash-mp6style',
		plugins_url( 'css/mp6-style.css', __FILE__ ),
		false,
		'v0.1'
	);
}
add_action( 'admin_enqueue_scripts', 'add_custom_mp6_style' );

// register Open Sans stylesheet for MP6
add_action( 'init', 'dashboard_register_open_sans' );
function dashboard_register_open_sans() {
	wp_register_style(
		'light-open-sans-light',
		'//fonts.googleapis.com/css?family=Open+Sans:300',
		false,
		'v0.1'
	);
}

/* 
Let's remove all the old widgets, shall we? 
If you would like any of the widgets back, just delete the section of the function that relates the dashboard widget below.
*/

// Remove the classic widgets from the dashboard
add_action( 'wp_dashboard_setup', 'remove_all_dashboard_widget' );

function remove_all_dashboard_widget() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}

// Changing the footer message
function remove_footer_admin () {
    echo "I like Big Buttons and I cannot lie.";
}
add_filter('admin_footer_text', 'remove_footer_admin');


// Changing the Welcome message
function bbdash_welcome_panel() {
?>
	<div class="welcome-panel-content">
	<h3><?php _e( 'Welcome to your WordPress site.' ); ?></h3>
	<p class="about-description"><?php _e( 'This site is enhanced with the Big Buttons Dashboard plugin. To get started, please click on any of the big buttons below!' ); ?></p>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h4><?php _e( 'Editing Big Buttons Dashboard Options' ); ?></h4>
		<ul>
		<li><?php _e( 'Click on the "Screen Options" tab in the upper right hand corner of this screen to access all of the big buttons. From here you can select new buttons to add or buttons to remove. To rearrange the buttons, scroll over the inside top of the button until the cursor changes. Then click, hold, and drag your button to a new location on the screen where a dashed box should appear. Let your button go there and it should snap in place.' ); ?></li>
		</ul>
	</div>
	<div class="welcome-panel-column">
		<h4><?php _e( 'Next Steps' ); ?></h4>
		<ul>
		<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
		<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
		<?php else : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
		<?php endif; ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
		</ul>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h4><?php _e( 'New to WordPress?' ); ?></h4>
		<ul>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
			<li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Have questions?' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
		</ul>
	</div>
	</div>
	</div>

<?php
}

remove_action('welcome_panel','wp_welcome_panel');
add_action('welcome_panel','bbdash_welcome_panel');
	


// Step 1: Creating functions to output plugin specific dashboard widgets
function jjdashboard_newpost_widget_function() {
	// Display whatever it is you want to show
		?>
	<div class="dashboardpost">
		<a href="<?php echo admin_url( 'post-new.php' ) ?>"><?php _e( 'Create a New Post' ); ?></a>
		</div>
		<?php
} 

function jjdashboard_editpost_widget_function() {
	$num_posts = wp_count_posts( 'post' );
	// Display whatever it is you want to show
		?>
	<div class="dashboardpost">
		<a href="<?php echo admin_url( 'post.php' ) ?>"><?php _e( 'Edit Old Post' ); ?></a>
	</div></br>
		<div class="dashboardborder"></div>
		<div>
			<h2 id="dashboardlower"><a href="<?php echo admin_url( 'post.php' ) ?>">You have  
			<?php
				$count_posts = wp_count_posts();
				echo $count_posts->publish;
				?>
				posts published.</a></h2>
		</div>
		<?php
} 
function jjdashboard_newpage_widget_function() {
		?>
	<div class="dashboardpage">
		<a href="<?php echo admin_url( 'post-new.php?post_type=page' ) ?>"><?php _e( 'Create a New Page' ); ?></a>
		</div>
		<?php
} 

function jjdashboard_editpage_widget_function() {
		?>
	<div class="dashboardpage">
		<a href="<?php echo admin_url( 'edit.php?post_type=pagep' ) ?>"><?php _e( 'Edit Old Page' ); ?></a>
	</div></br>
		<div class="dashboardborder"></div>
		<div>
			<h2 id="dashboardlower"><a href="<?php echo admin_url( 'edit.php?post_type=page' ) ?>">You have  
			<?php
				$num_pages = wp_count_posts( 'page' );
				echo $num_pages->publish;
				?>
				pages published.</a></h2>
		</div>
		<?php
} 
function jjdashboard_comments_widget_function() {
	$num_comm = wp_count_comments( '' );
		?>
	<div class="dashboardcomments">
		<a href="<?php echo admin_url( 'edit-comments.php' ) ?>"><?php _e( 'See All Comments' ); ?></a></br></br></div>
		<div class="dashboardborder"></div>
		<div>
			<h2 id="dashboardlower">
			<a href="<?php echo admin_url( 'edit-comments.php?comment_status=approved' ) ?>"> <?php echo $num_comm->approved; _e(' Approved' ); ?></a> | <a href="<?php echo admin_url( 'edit-comments.php?comment_status=moderated' ) ?>"> <?php echo $num_comm->moderated; _e(' Pending' ); ?></a>
		</div>
		<?php
} 

function jjdashboard_cattags_widget_function() {
		?>
	<div class="dashboardcattags"></br>
		<a href="<?php echo admin_url( 'dit-tags.php?taxonomy=category' ) ?>"><?php _e( 'Add/Edit Categories' ); ?></a>
	</div>
	<div class="dashboardcattags">
		<a href="<?php echo admin_url( 'edit-tags.php?taxonomy=post_tag' ) ?>"><?php _e( 'Add/Edit Tags' ); ?></a>
	</div></br>
		
		<?php
} 
function jjdashboard_media_widget_function() {
		?>
	<div class="dashboardmedia"></br>
		<a href="<?php echo admin_url( 'upload.php' ) ?>"><?php _e( 'Add/Edit Media' ); ?></a>
	</div></br>
		<?php
} 
function jjdashboard_stats_widget_function() {
		?>
	<div class="dashboardstats"></br>
		<a href="<?php echo admin_url( 'admin.php?page=stats' ) ?>"><?php _e( 'Site Views and Statistics' ); ?></a>
	</div></br>
	<div class="dashboardborder"></div>
		<div>
			<h2 id="dashboardlower">
			<a href="<?php echo admin_url( 'edit.php?post_type=page' ) ?>">You must have Jetpack installed.  </a>
		</div>
		<?php
} 
function jjdashboard_theme_widget_function() {
		?>
	<div class="dashboardappearance"></br>
		<a href="<?php echo admin_url( 'themes.php' ) ?>"><?php _e( 'Change Theme' ); ?></a>
	</div></br>
		
		<?php
}
function jjdashboard_menu_widget_function() {
		?>
	<div class="dashboardappearance"></br>
		<a href="<?php echo admin_url( 'nav-menus.php' ) ?>"><?php _e( 'Change Menu Items' ); ?></a>
	</div></br>
		
		<?php
}
function jjdashboard_widgets_widget_function() {
		?>
	<div class="dashboardappearance"></br>
		<a href="<?php echo admin_url( 'widgets.php' ) ?>"><?php _e( 'Change Widgets' ); ?></a>
	</div></br>
		
		<?php
}
function jjdashboard_customizer_widget_function() {
		?>
	<div class="dashboardappearance"></br>
		<a href="<?php echo admin_url( 'customize.php' ) ?>"><?php _e( 'Open Customizer' ); ?></a>
	</div></br>
		
		<?php
}
function jjdashboard_users_widget_function() {
		?>
	<div class="dashboardusers"></br>
		<a href="<?php echo admin_url( 'users.php' ) ?>"><?php _e( 'Manage Users' ); ?></a>
	</div></br>
		
		<?php
}


// Functions!
function jjdashboard_add_newpost_widgets() {
	           wp_add_dashboard_widget('jjdashboard_newpost_widget', 'Create a New Post', 'jjdashboard_newpost_widget_function');	
} 

function jjdashboard_add_editpost_widgets() {
	           wp_add_dashboard_widget('jjdashboard_editpost_widget', 'Edit an Old Post', 'jjdashboard_editpost_widget_function');	
}

function jjdashboard_add_newpage_widgets() {
	           wp_add_dashboard_widget('jjdashboard_newpage_widget', 'Create a New Page', 'jjdashboard_newpage_widget_function');	
} 

function jjdashboard_add_editpage_widgets() {
	           wp_add_dashboard_widget('jjdashboard_editpage_widget', 'Edit an Old Page', 'jjdashboard_editpage_widget_function');	
} 
function jjdashboard_add_comments_widgets() {
	           wp_add_dashboard_widget('jjdashboard_comments_widget', 'Manage Comments', 'jjdashboard_comments_widget_function');	
} 
function jjdashboard_add_cattags_widgets() {
	           wp_add_dashboard_widget('jjdashboard_cattags_widget', 'Categories and Tags', 'jjdashboard_cattags_widget_function');	
} 
function jjdashboard_add_stats_widgets() {
	           wp_add_dashboard_widget('jjdashboard_stats_widget', 'View Statistics', 'jjdashboard_stats_widget_function');	
} 
function jjdashboard_add_theme_widgets() {
	           wp_add_dashboard_widget('jjdashboard_theme_widget', 'Change Theme', 'jjdashboard_theme_widget_function');	
} 
function jjdashboard_add_menu_widgets() {
	           wp_add_dashboard_widget('jjdashboard_menu_widget', 'Change Menu Items', 'jjdashboard_menu_widget_function');	
} 
function jjdashboard_add_widgets_widgets() {
	           wp_add_dashboard_widget('jjdashboard_widgets_widget', 'Manage Widgets', 'jjdashboard_widgets_widget_function');	
} 
function jjdashboard_add_customizer_widgets() {
	           wp_add_dashboard_widget('jjdashboard_customizer_widget', 'Open Customizer', 'jjdashboard_customizer_widget_function');	
} 
function jjdashboard_add_users_widgets() {
	           wp_add_dashboard_widget('jjdashboard_users_widget', 'Manage Users', 'jjdashboard_users_widget_function');	
}

add_filter('default_hidden_meta_boxes', 'jjdashboard_default_hidden_widgets', 10, 2);
function jjdashboard_default_hidden_widgets($hidden, $screen) {
    if ( 'dashboard' == $screen->base ) {
	    $new_hidden = array(
	    	'jjdashboard_stats_widget',
	    	'jjdashboard_users_widget',
	    );
	    
	    $hidden = array_merge($hidden, $new_hidden);
    }

    return $hidden;
}


// Step 3: Hook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'jjdashboard_add_newpost_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_editpost_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_newpage_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_editpage_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_comments_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_cattags_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_stats_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_theme_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_menu_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_widgets_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_customizer_widgets' );
add_action('wp_dashboard_setup', 'jjdashboard_add_users_widgets' );

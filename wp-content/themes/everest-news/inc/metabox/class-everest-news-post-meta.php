<?php
/**
 * Class to create custom post meta fields and save and update the meta values.
 *
 * @package    Everest_News
 * @author     everestthemes <themeseverest@gmail.com>
 * @copyright  Copyright (c) 2018, everestthemes
 * @link       http://everestthemes.com/themes/everest-news/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

class Everest_News_Post_Meta {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    'everest-news'       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function init() {
		// Register post meta fields and save meta fields values.
		add_action( 'admin_init', array( $this, 'register_post_meta' ) );
		add_action( 'save_post', array( $this, 'save_sidebar_position_meta' ) );
	}

	/**
	 * Register post custom meta fields.
	 *
	 * @since    1.0.0
	 */
	public function register_post_meta() {   

	    add_meta_box( 'sidebar_position_metabox', esc_html__( 'Sidebar Position', 'everest-news' ), array( $this, 'sidebar_position_meta' ), array( 'post', 'page' ), 'side', 'default' );
	}

	/**
	 * Custom Sidebar Post Meta.
	 *
	 * @since    1.0.0
	 */
	public function sidebar_position_meta() {

		global $post;

		$sidebar = get_post_meta( $post->ID, 'everest_news_sidebar_position', true );

		if( empty( $sidebar ) ) {
			$sidebar = 'right';
		}

	    wp_nonce_field( 'everest_news_sidebar_position_meta_nonce', 'everest_news_sidebar_position_meta_nonce_id' );

	    $sidebar_positions = array(
	        'right' => esc_html__( 'Right', 'everest-news' ),
	        'left' => esc_html__( 'Left', 'everest-news' ),
	        'none' => esc_html__( 'None', 'everest-news' ),
	    );

	    ?>

	    <table width="100%" border="0" class="options" cellspacing="5" cellpadding="5">
	        <tr>
	            <?php
	                foreach( $sidebar_positions as $key => $option ) {
	                    ?>
	                    <td width="10%">
	                        <input type="radio" name="sidebar_position" id="sidebar_position" value="<?php echo esc_attr( $key ); ?>" <?php if( $sidebar == $key ) { esc_attr_e( 'checked', 'everest-news' ); } ?>><label><?php echo esc_html( $option ); ?></label>               
	                    </td>  
	                    <?php
	                }
	            ?>        
	        </tr> 
	    </table>   
	    <?php   
	}

	/**
	 * Save Custom Sidebar Position Post Meta.
	 *
	 * @since    1.0.0
	 */
	public function save_sidebar_position_meta() {

	    global $post;  

	    // Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	        return;
	    }
	    
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST['everest_news_sidebar_position_meta_nonce_id'] ) || !wp_verify_nonce( sanitize_key( $_POST['everest_news_sidebar_position_meta_nonce_id'] ), 'everest_news_sidebar_position_meta_nonce' ) ) {
	        return;
	    }
	    
	    // if our current user can't edit this post, bail
	    if ( ! current_user_can( 'edit_post', $post->ID ) ) {
	        return;
	    } 

	    if( isset( $_POST['sidebar_position'] ) ) {
			update_post_meta( $post->ID, 'everest_news_sidebar_position', sanitize_text_field( wp_unslash( $_POST['sidebar_position'] ) ) ); 
		}
	}
}

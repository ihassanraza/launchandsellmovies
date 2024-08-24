<?php
/**
 * MoviesPostType class
 *
 * This class registers a custom post type for movies and adds a meta box for the released year.
 *
 * @since 1.0.0
*/
class MoviesPostType {
    /**
     * Singleton instance of the class
     *
     * @var MoviesPostType
    */
    private static $instance;

    /**
     * Get the singleton instance of the class
     *
     * @return MoviesPostType
    */
    public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new MoviesPostType();
		}

		return self::$instance;
	}

    /**
     * Constructor
     *
     * Registers the custom post type and meta box.
    */
    public function __construct() {
        add_action( 'init', array( $this, 'register_movies_post_type' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_released_year_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_released_year_meta' ) );
    }

    /**
     * Register the movies post type
     *
     * @return void
    */
    public function register_movies_post_type() {
        register_post_type('movies',
            array(
                'labels' => array(
                    'name_admin_bar' => 'Movies',
                    'name' => __( 'Movies', 'lsm' ),
                    'singular_name' => __( 'Movie', 'lsm' ),
                    'menu_name' => __( 'Movies', 'lsm' ),
                    'all_items' => __( 'All Movies', 'lsm' ),
                    'add_new' => __( 'Add New Movie', 'lsm' ),
                    'add_new_item' => __( 'Add New Movie', 'lsm' ),
                    'edit_item' => __( 'Edit Movie', 'lsm' ),
                    'new_item' => __( 'New Movie', 'lsm' ),
                    'view_item' => __( 'View Movie', 'lsm' ),
                    'search_items' => __( 'Search Movies', 'lsm' ),
                    'not_found' => __( 'No movies found', 'lsm' ),
                    'not_found_in_trash' => __( 'No movies found in trash', 'lsm' ),
                ),
                'public' => true,
                'has_archive' => true,
                'supports' => array( 'title', 'editor' ),
                'menu_position' => 20,
                'menu_icon' => 'dashicons-video-alt',
            )
        );
    }

    /**
     * Add the released year meta box
     *
     * @return void
    */
    public function add_released_year_meta_box() {
        add_meta_box(
            'released_year',
            __( 'Released Year', 'lsm' ),
            array( $this, 'released_year_meta_box_callback' ),
            'movies',
            'side',
            'high'
        );
    }

    /**
     * Callback function for the released year meta box
     *
     * @param WP_Post $post The current post object
     * @return void
    */
    public function released_year_meta_box_callback( $post ) {
        $released_year = get_post_meta( $post->ID, 'released_year', true );
        wp_nonce_field( 'save_released_year_meta', 'released_year_nonce' );
        ?>
        <input type="number" id="released_year" name="released_year" value="<?php echo esc_attr( $released_year ); ?>" />
        <?php
    }

    /**
     * Save the released year meta data
     *
     * @param int $post_id The ID of the post being saved
     * @return void
    */
    public function save_released_year_meta( $post_id ) {
        if ( ! isset( $_POST['released_year_nonce'] ) || ! wp_verify_nonce( $_POST['released_year_nonce'], 'save_released_year_meta' ) ) {
            return;
        }

        if ( isset( $_POST['released_year'] ) ) {
            update_post_meta( $post_id, 'released_year', sanitize_text_field( $_POST['released_year'] ) );
        }
    }
}
?>
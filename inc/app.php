<?php
/**
 * MoviesApp class
 *
 * This class handles the Movies App functionality, including enqueuing scripts and rendering the app.
 *
 * @since 1.0.0
*/
class MoviesApp {
    /**
     * Instance of the MoviesApp class
     *
     * @var MoviesApp
    */
    private static $instance;

    /**
     * Get the instance of the MoviesApp class
     *
     * @return MoviesApp
    */
    public static function get_instance() {
		if (null === self::$instance) {
			self::$instance = new MoviesApp();
		}

		return self::$instance;
	}

    /**
     * Constructor
     *
     * Hooks into WordPress actions to enqueue scripts and render the app.
    */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
        add_shortcode( 'lsm_movies_app', array($this, 'render_app') );
    }

    /**
     * Enqueue scripts
     *
     * Enqueues React, React DOM, and the app's JavaScript and CSS files on the "movies" page.
     *
     * @since 1.0.0
    */
    public function enqueue_scripts() {
        if ( is_page('movies') ) {
            $nonce = wp_create_nonce('wp_rest');
            wp_enqueue_script( 'react', LSM_PLUGIN_URL . 'src/public/js/react.min.js', array(), null, true );
            wp_enqueue_script( 'react-dom', LSM_PLUGIN_URL . 'src/public/js/react-dom.min', array(), null, true );
            wp_enqueue_script( 'launch-sell-movies', LSM_PLUGIN_URL . 'build/index.js', array('react', 'react-dom'), '1.0.0', true );
            wp_localize_script('launch-sell-movies', 'MoviesAPI', array(
                'root' => esc_url_raw( rest_url() ),
                'nonce' => $nonce
            ));
            wp_enqueue_style( 'bootstrap', LSM_PLUGIN_URL . 'src/public/css/bootstrap.min.css' );
            wp_enqueue_style( 'launch-sell-movies', LSM_PLUGIN_URL . 'src/public/css/movies.css' );
        }
    }

    /**
     * Render the app
     *
     * Renders the app container if the user is logged in, otherwise displays a message.
     *
     * @return string
     * @since 1.0.0
    */
    public function render_app() {
        if (is_user_logged_in()) {
            return '<div id="lsm-app"></div>';
        } else {
            return '<div class="alert alert-secondary" role="alert">You need to be logged in to view this page.</div>';
        }
    }
}
?>
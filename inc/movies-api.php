<?php
/**
 * Movies API class
 * 
 * Handles registration of REST API routes and callbacks for movies data.
 * 
 * @since 1.0.0
*/
class MoviesAPI {
    /**
     * Singleton instance of the class
     *
     * @var MoviesAPI
    */
    private static $instance;

    /**
     * Get the singleton instance of the class
     *
     * @return MoviesAPI
    */
    public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new MoviesAPI();
		}

		return self::$instance;
	}

    /**
     * Constructor
     *
     * Registers the REST API routes on initialization.
    */
    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    /**
     * Register REST API routes
     *
     * Registers two routes: one for retrieving a list of movies and one for retrieving a single movie by ID.
    */
    public function register_routes() {
        $namespace = 'launchandsell/v1';

        register_rest_route( $namespace, 'movies', array(
            'methods' => 'GET',
            'callback' => array( $this, 'get_movies' ),
            'permission_callback' => array( $this, 'permissions_check' )
        ));

        register_rest_route( $namespace, 'movies/(?P<id>\d+)', array(
            'methods' => 'GET',
            'callback' => array( $this, 'get_movie' ),
            'permission_callback' => array( $this, 'permissions_check' )
        ));
    }

    /**
     * Check permissions for API requests
     *
     * Returns true if the user is logged in, otherwise returns a WP_Error object with a 401 status code.
     *
     * @return bool|WP_Error
    */
    public function permissions_check($request) {
        return is_user_logged_in() ? true : new WP_Error('rest_forbidden', 'You are not allowed to access this resource.', array('status' => 401));
    }

    /**
     * Retrieve a list of movies
     *
     * Returns a list of movies in the format of an array of objects, each containing the movie's ID, title, description, and year.
     *
     * @return WP_REST_Response
    */
    public function get_movies() {
        $movies = get_posts(
            array(
                'post_type' => 'movies',
                'posts_per_page' => -1,
            )
        );

        if ( empty( $movies ) ) {
            return new WP_Error( 'no_movies_found', 'No movies found', array( 'status' => 404 ) );
        }

        $data = array();
        foreach ( $movies as $movie ) {
            $data[] = array(
                'id' => $movie->ID,
                'title' => $movie->post_title,
                'description' => $movie->post_content,
                'year' => get_post_meta( $movie->ID, 'released_year', true ),
            );
        }

        return rest_ensure_response( new WP_REST_Response( $data ) );
    }

    /**
     * Retrieve a single movie by ID
     *
     * Returns a movie object containing the movie's ID, title, description, and year.
     *
     * @param WP_REST_Request $request
     * @return WP_REST_Response
    */
    public function get_movie( WP_REST_Request $request ) {
        $id = $request['id'];

        if ( ! is_numeric( $id ) ) {
            return new WP_Error( 'invalid_id', 'Invalid movie ID', array( 'status' => 400 ) );
        }

        $movie = get_post( $id );

        if ( ! $movie ) {
            return new WP_Error( 'not_found', 'Movie not found', array( 'status' => 404 ) );
        }

        $data = array(
            'id' => $movie->ID,
            'title' => $movie->post_title,
            'description' => $movie->post_content,
            'year' => get_post_meta( $movie->ID, 'released_year', true ),
        );

        return rest_ensure_response( new WP_REST_Response( $data ) );
    }
}
?>
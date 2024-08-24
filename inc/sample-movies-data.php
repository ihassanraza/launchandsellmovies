<?php
/**
 * Adds sample movies data to the 'Movies' custom post type.
 *
 * This function is meant to be run only once during plugin activation.
 *
 * @since 1.0.0
*/

function lsm_add_sample_movies_data() {
    $movies = array(
        array( 'title' => 'The Matrix', 'description' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 'year' => 1999 ),
        array( 'title' => 'Inception', 'description' => 'A thief who enters the dreams of others to steal secrets must perform the impossible task of planting an idea in a target\'s mind.', 'year' => 2010 ),
        array( 'title' => 'Interstellar', 'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', 'year' => 2014 ),
        array( 'title' => 'The Dark Knight', 'description' => 'Batman raises the stakes in his war on crime as he faces the Joker, a criminal mastermind who wants to plunge Gotham into anarchy.', 'year' => 2008 ),
        array( 'title' => 'Pulp Fiction', 'description' => 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'year' => 1994 ),
        array( 'title' => 'Forrest Gump', 'description' => 'The presidencies of Kennedy and Johnson, the events of Vietnam, Watergate, and other historical events unfold from the perspective of an Alabama man with a low IQ.', 'year' => 1994 ),
        array( 'title' => 'The Shawshank Redemption', 'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'year' => 1994 ),
        array( 'title' => 'The Godfather', 'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'year' => 1972 ),
        array( 'title' => 'Fight Club', 'description' => 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much more.', 'year' => 1999 ),
        array( 'title' => 'Gladiator', 'description' => 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.', 'year' => 2000 ),
        array( 'title' => 'The Lord of the Rings: The Fellowship of the Ring', 'description' => 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth.', 'year' => 2001 ),
        array( 'title' => 'Star Wars: Episode IV - A New Hope', 'description' => 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee, and two droids to save the galaxy from the Empire\'s world-destroying battle station.', 'year' => 1977 ),
        array( 'title' => 'Jurassic Park', 'description' => 'A pragmatic paleontologist visiting an almost complete theme park is tasked with protecting a couple of kids after a power failure causes the park\'s cloned dinosaurs to run loose.', 'year' => 1993 ),
        array( 'title' => 'The Lion King', 'description' => 'Lion prince Simba and his father are targeted by his bitter uncle, who wants to ascend the throne himself.', 'year' => 1994 ),
        array( 'title' => 'The Silence of the Lambs', 'description' => 'A young FBI cadet must receive the help of an incarcerated and manipulative cannibal killer to help catch another serial killer, a madman who skins his victims.', 'year' => 1991 ),
        array( 'title' => 'Schindler\'s List', 'description' => 'In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.', 'year' => 1993 ),
        array( 'title' => 'The Departed', 'description' => 'An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in South Boston.', 'year' => 2006 ),
        array( 'title' => 'Titanic', 'description' => 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', 'year' => 1997 ),
        array( 'title' => 'Avatar', 'description' => 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', 'year' => 2009 ),
        array( 'title' => 'The Avengers', 'description' => 'Earth\'s mightiest heroes must come together and learn to fight as a team if they are going to stop the mischievous Loki and his alien army from enslaving humanity.', 'year' => 2012 )
    );

    foreach ( $movies as $movie ) {
        wp_insert_post( 
            array(
                'post_title' => $movie['title'],
                'post_content' => $movie['description'],
                'post_type' => 'movies',
                'post_author' => 1,
                'meta_input' => array( 'released_year' => $movie['year'] ),
                'post_status' => 'publish',
            )
        );
    }
}
?>
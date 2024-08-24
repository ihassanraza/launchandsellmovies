import { useState, useEffect, useContext } from 'react';
import Spinner from 'react-bootstrap/Spinner';
import Alert from 'react-bootstrap/Alert';

import { MovieContext } from '../../context/MovieContext';
import MovieItem from '../movies/MovieItem';

export default function MyList() {
    const [movies, setMovies] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState('');
    const { listIds } = useContext(MovieContext);

    useEffect(() => {
        const fetchMovies = async () => {
            try {
                if (listIds.length) {
                    const responses = await Promise.all(
                        listIds.map((id) => fetch(`${MoviesAPI.root}launchandsell/v1/movies/${id}`, {
                            method: 'GET',
                            headers: {
                                'X-WP-Nonce': MoviesAPI.nonce,
                                'Content-Type': 'application/json'
                            }
                        }))
                    );
                    const data = await Promise.all(responses.map((response) => response.json()));
                    setMovies(data);
                }
            } catch(error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }
        fetchMovies();
    }, [listIds]);

    if (isLoading) {
        return (
            <div>
                <Spinner animation="border" role="status" size="sm"></Spinner>
                <span>Loading...</span>
            </div>
        );
    };

    if (error) return <Alert variant="danger">{error}</Alert>;

    return (
        movies.length ? 
        <ul className="movies">
            {
                movies.map((movie) => (
                    <li key={movie.id}>
                        <MovieItem {...movie} />
                    </li>
                ))
            }
        </ul> :
        <Alert variant="primary" className="mt-4">No movies in your list.</Alert>
    );
}
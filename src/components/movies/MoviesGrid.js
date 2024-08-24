import { useState, useEffect } from 'react';
import Spinner from 'react-bootstrap/Spinner';
import Pagination from 'react-bootstrap/Pagination';
import Alert from 'react-bootstrap/Alert';

import MovieItem from './MovieItem';

export default function MoviesGrid() {
    const [movies, setMovies] = useState(null);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    const [currentPage, setCurrentPage] = useState(1);

    useEffect(() => {
        const fetchMovies = async () => {
            try {
                const response = await fetch(`${MoviesAPI.root}launchandsell/v1/movies`, {
                    method: 'GET',
                    headers: {
                        'X-WP-Nonce': MoviesAPI.nonce,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error("An error occured while fetching the data. Please try again later!");

                const data = await response.json();
                setMovies(data);
            } catch(error) {
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }
        fetchMovies();
    }, []);

    if (isLoading) {
        return (
            <div>
                <Spinner animation="border" role="status" size="sm"></Spinner>
                <span>Loading...</span>
            </div>
        );
    };

    if (error) return <Alert variant="danger" className="mt-4">{error}</Alert>;

    const totalPages = Math.ceil(movies.length / 10);
    const startIndex = (currentPage - 1) * 10;
    const endIndex = startIndex + 10;
    const paginatedMovies = movies.slice(startIndex, endIndex);

    return (
        <>
            <ul className="movies">
                {
                    paginatedMovies.map((movie) => (
                        <li key={movie.id}>
                            <MovieItem {...movie} />
                        </li>
                    ))
                }
            </ul>
            <Pagination className="d-flex justify-content-center">
                {
                    Array(totalPages).fill(0).map((_, index) => (
                        <Pagination.Item key={index} active={currentPage === index + 1} onClick={() => setCurrentPage(index + 1)}>
                            {index + 1}
                        </Pagination.Item>
                    ))
                }
            </Pagination>
        </>
    );
}
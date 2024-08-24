import { useContext } from 'react';

import { MovieContext } from '../../context/MovieContext';

export default function MovieItem({ id, title, description, year }) {
    const { listIds, toggleToMyList } = useContext(MovieContext);

    return (
        <div className="movie">
            <h2>{title}</h2>
            <p>{description}</p>
            <div className="movie-featured">
                <p><strong>Released Year:</strong> {year}</p>
                <div className="my-list">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none" onClick={() => toggleToMyList(id)} className={listIds.includes(id) ? 'active' : undefined}>
                        <path d="M8.10089 2.18039L8.5 2.70927L8.89911 2.18039C9.66697 1.16287 10.8986 0.5 12.274 0.5C14.6091 0.5 16.5 2.38461 16.5 4.71066C16.5 5.65861 16.3475 6.53332 16.0827 7.3449L16.0816 7.34817C15.4464 9.341 14.1435 10.9504 12.7328 12.1524C11.32 13.3562 9.82828 14.1262 8.86719 14.4504L8.86718 14.4504L8.86186 14.4522C8.78706 14.4784 8.65584 14.5 8.5 14.5C8.34416 14.5 8.21294 14.4784 8.13814 14.4522L8.13815 14.4522L8.13282 14.4504C7.17172 14.1262 5.68002 13.3562 4.26721 12.1524C2.85647 10.9504 1.55358 9.341 0.918386 7.34817L0.918397 7.34817L0.91733 7.3449C0.652483 6.53332 0.5 5.65861 0.5 4.71066C0.5 2.38461 2.39091 0.5 4.726 0.5C6.10137 0.5 7.33303 1.16287 8.10089 2.18039Z" stroke="#964B00"/>
                    </svg>
                </div>
            </div>
        </div>
    );
}
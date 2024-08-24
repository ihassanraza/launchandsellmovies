import React from 'react';
import ReactDOM from 'react-dom';

import MovieContextProvider from './context/MovieContext';
import App from './App';

const rootElement = document.getElementById('lsm-app');

ReactDOM.render(
    <React.StrictMode>
        <MovieContextProvider>
            <App />
        </MovieContextProvider>
    </React.StrictMode>,
    rootElement
);

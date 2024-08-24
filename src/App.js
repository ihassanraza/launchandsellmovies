import React from 'react';
import Nav from 'react-bootstrap/Nav';
import Tab from 'react-bootstrap/Tab';

import MoviesGrid from './components/movies/MoviesGrid';
import MyList from './components/mylist/MyList';

export default function App() {
    return (
        <header>
            <Tab.Container defaultActiveKey="movies">
                <div className="d-flex justify-content-between">
                    <h5>Launch and Sell Movies</h5>
                    <Nav variant="pills">
                        <Nav.Item>
                            <Nav.Link eventKey="movies">Show All Movies</Nav.Link>
                        </Nav.Item>
                        <Nav.Item>
                            <Nav.Link eventKey="myList">My List</Nav.Link>
                        </Nav.Item>
                    </Nav>
                </div>
                <Tab.Content>
                    <Tab.Pane eventKey="movies">
                        <MoviesGrid />
                    </Tab.Pane>
                    <Tab.Pane eventKey="myList">
                        <MyList />
                    </Tab.Pane>
                </Tab.Content>
            </Tab.Container>
        </header>
    );
};

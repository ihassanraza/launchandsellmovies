import { createContext, useState, useEffect } from "react";

export const MovieContext = createContext();

export default function MovieContextProvider({ children }) {
    const [listIds, setListIds] = useState([]);

    useEffect(() => {
        const myList = sessionStorage.getItem('myList');
        if (myList) {
            const myListIds = JSON.parse(myList);
            setListIds(myListIds);
        }
    }, [listIds]);

    const toggleToMyList = (id) => {
        let updatedListIds = listIds;

        if (listIds.includes(id)) {
            updatedListIds = listIds.filter((listId) => listId !== id);
        } else {
            updatedListIds = [...listIds, id];
        }

        setListIds(updatedListIds);
        sessionStorage.setItem('myList', JSON.stringify(updatedListIds));
    };

    return (
        <MovieContext.Provider value={{ listIds, toggleToMyList }}>
            {children}
        </MovieContext.Provider>
    )
}
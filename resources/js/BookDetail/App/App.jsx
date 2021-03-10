import React from "react";
import { useState, useEffect } from "react";
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link,
    useParams,
} from "react-router-dom";
import BookDetail from "./BookDetail";
import BookReview from "./BookReview";

function App() {
    let { bookId } = useParams();
    const [book, setBook] = useState(null);

    async function fetchBookData() {
        const response = await fetch(`/api/books/${bookId}`);
        const data = await response.json();
        setBook(data);
    }

    useEffect(() => {
        fetchBookData();
    }, []);

    if (book === null) {
        return <h1>Loading...</h1>;
    }

    return (
        <Switch>
            <Route path="/book/:id/review">
                <BookReview id={bookId} book={book} />
            </Route>

            <Route path="/book/:id">
                {book && <BookDetail id={bookId} book={book} />}
            </Route>
        </Switch>
    );
}

export default App;

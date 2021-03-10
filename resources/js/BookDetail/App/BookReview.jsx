import { useState } from "react";

function BookReview(props) {
    const { book } = props;
    /* 
    const [rating, setRating] = useState(0);
    const [text, setText] = useState(""); */

    const [values, setValues] = useState({
        rating: 0,
        text: "",
    });

    const [errors, setErrors] = useState({});

    const [successMessage, setSuccessMessage] = useState("");

    const handleValueChange = (e) => {
        let name = e.target.name;
        let value = e.target.value;

        setValues((previous_values) => {
            return {
                ...previous_values,
                [name]: value,
            };
        });
    };

    /* const handleRatingChange = (e) => {
        setRating(Math.min(100, e.target.value));
    };

    const handleTextChange = (e) => {
        setText(e.target.value);
    }; */

    async function handleSubmit(e) {
        e.preventDefault();

        setErrors({});
        setSuccessMessage("");

        //      /api/books/review/12345
        const response = await fetch("/api/books/review/" + book.id, {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(values),
        });

        console.log(response.status);

        // determine if validation failed on the server
        // (server returne with code 422)
        const validation_failed = response.status == 422;

        // parse response as JSON (because we get JSON
        // both on success and failure)
        const data = await response.json();

        if (validation_failed) {
            // display the error messages
            setErrors(data.errors);
        } else {
            // display success message
            setSuccessMessage(data.message);
        }

        console.log(data);
    }

    return (
        <div className="book-review">
            <h1 className="book-review__headline">
                {book.title}
                <div className="book-review__headline-sub">Submit a review</div>
            </h1>
            <form action="" method="post" onSubmit={handleSubmit}>
                {successMessage ? (
                    <div className="success-message">{successMessage}</div>
                ) : (
                    ""
                )}

                <div className="form-group">
                    <label>
                        <div className="form-group__label">Rating</div>
                        <input
                            type="number"
                            name="rating"
                            value={values.rating}
                            onChange={handleValueChange}
                        />
                        {errors.rating
                            ? errors.rating.map((error) => (
                                  <div key={error} className="error-messgage">
                                      {error}
                                  </div>
                              ))
                            : ""}
                    </label>
                </div>
                <div className="form-group">
                    <label>
                        <div className="form-group__label">Review</div>
                        <textarea
                            name="text"
                            cols="30"
                            rows="10"
                            value={values.text}
                            onChange={handleValueChange}
                        ></textarea>
                        {errors.text
                            ? errors.text.map((error) => (
                                  <div key={error} className="error-messgage">
                                      {error}
                                  </div>
                              ))
                            : ""}
                    </label>
                </div>
                <button>Submit review</button>
            </form>
        </div>
    );
}

export default BookReview;

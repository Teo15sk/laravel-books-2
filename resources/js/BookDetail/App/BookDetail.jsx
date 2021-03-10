import { Link } from "react-router-dom";

function BookDetail(props) {
    return (
        <>
            <h1>{props.book.title}</h1>
            <h2>
                {props.book.authors.map((author, id) => (
                    <span key={id}>{author.name}</span>
                ))}
            </h2>
            <p>{props.book.publication_date}</p>
            <div
                dangerouslySetInnerHTML={{ __html: props.book.description }}
            ></div>

            <Link to={`/book/${props.book.id}/review`}>Review this book</Link>
            <div className="book-detail__reviews">
                <h2>Reviews</h2>
                {props.book.reviews.length ? (
                    props.book.reviews.map((review, index) => (
                        <div key={index}>
                            <div> {review.rating}</div>
                            <div>{review.text}</div>
                        </div>
                    ))
                ) : (
                    <p>
                        There are no reviews yet.{" "}
                        <Link to={`/book/${props.book.id}/review`}>
                            Be the first to review this book.
                        </Link>
                    </p>
                )}
            </div>
        </>
    );
}

export default BookDetail;

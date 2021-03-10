import React from "react";
import ReactDOM from "react-dom";
import App from "./App/App";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";

function Index() {
    return (
        <Router>
            <Switch>
                <Route path="/book/:bookId" children={<App />} />
            </Switch>
        </Router>
    );
}

ReactDOM.render(<Index />, document.getElementById("app"));

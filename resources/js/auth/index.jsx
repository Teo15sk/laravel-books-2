import React from "react";
import ReactDOM from "react-dom";
import Login from "./Login";
import Register from "./Register";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";

function Index() {
    return (
        <Router>
            <Switch>
                <Route path="/login" children={<Login />} />
                <Route path="/register" children={<Register />} />
            </Switch>
        </Router>
    );
}

ReactDOM.render(<Index />, document.getElementById("app"));

import React, { Component } from "react";
import { render } from "react-dom";

export default class App extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return <h1>Test</h1>;
    }
}

const appDiv = document.getElementById("app");
render (<app />, appDiv);
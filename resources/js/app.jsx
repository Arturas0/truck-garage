import './bootstrap.js';

import React from 'react';
import ReactDom from 'react-dom';

import App from './Components/App'

if(document.getElementById('app')) {
    ReactDom.render(<App />,document.getElementById('app'));
}
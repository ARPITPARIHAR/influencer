
import './components/Example';
import React from 'react';
import ReactDOM from 'react-dom';
import Form from './components/Form';

if (document.getElementById('form')) {
    ReactDOM.render(<Form />, document.getElementById('form'));
}


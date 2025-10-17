import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navigation from './Navigation';
import SettingsRoute from './SettingsRoute';

const SettingsWrap = () => {

    return (
        <Router>
            <Navigation/>
			<Routes>
                <Route path="/*" element={<SettingsRoute />} />
			</Routes>
		</Router>
    );
};

export default SettingsWrap;

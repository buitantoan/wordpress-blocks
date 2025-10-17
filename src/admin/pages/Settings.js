import { useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { useEffect } from '@wordpress/element';

const Settings = () => {
    const query = new URLSearchParams( useLocation()?.search );
    const navigate = useNavigate();

    return (
        <div>
            Settings Page
        </div>
    );
}

export default Settings;
import { useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { useEffect } from '@wordpress/element';

const Welcome = () => {
    const query = new URLSearchParams( useLocation()?.search );
    const navigate = useNavigate();

    return (
        <div>
            Welcome Page
        </div>
    );
}

export default Welcome;
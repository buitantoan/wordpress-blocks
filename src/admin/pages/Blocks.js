import { useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { useEffect } from '@wordpress/element';

const Blocks = () => {
    const query = new URLSearchParams( useLocation()?.search );
    const navigate = useNavigate();

    return (
        <div>
            Blocks Page
        </div>
    );
}

export default Blocks;
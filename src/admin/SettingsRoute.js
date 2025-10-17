import React from 'react';
import { useLocation } from 'react-router-dom';
import { __ } from '@wordpress/i18n';
import Welcome from './pages/Welcome.js';
import Settings from './pages/Settings.js';
import Blocks from './pages/Blocks.js';


const SettingsRoute = () => {
    const query = new URLSearchParams( useLocation().search );
    const page = query.get( 'page' );
    const path = query.get( 'path' );
    const currentEvent = query.get( 'event' );

    let routePage = <p>{ __( 'Default route fallback', 'wpb-blocks' ) }</p>;
    switch ( path ) {
        case 'blocks':
            routePage = <Blocks/>;
            break;
        case 'settings':
            routePage = <Settings/>;
            break;
        default:
            routePage = <Welcome/>;
            break;
    }
    
    return (
        <>
        { routePage }
        </>
    );
}

export default SettingsRoute;
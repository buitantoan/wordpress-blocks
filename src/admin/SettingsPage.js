import React from 'react';
import { __ } from '@wordpress/i18n';
import { useLocation, useHistory } from 'react-router-dom';
import { useEffect } from '@wordpress/element';

const SettingsPage = () => {

    const tabSettings = {
        'global-settings': __( 'Editor Options', 'wpb-blocks' ),
    }

    return (
        <div>
            Settings Page Content
        </div>
    );
}

export default SettingsPage;
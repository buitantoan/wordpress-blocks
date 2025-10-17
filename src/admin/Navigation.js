import React, { Fragment } from 'react'
import { Disclosure, Menu, Transition } from '@headlessui/react';
import { Bars3Icon, XMarkIcon } from '@heroicons/react/24/outline';
import { Link, useLocation } from 'react-router-dom';
import { __ } from '@wordpress/i18n';

const Navigation = () => {
    const menus = [
        {
			name: __( 'Dashboard', 'wpb-blocks' ),
			slug: 'wp-blocks',
			path: '',
		},
		{
			name: __( 'Blocks', 'wpb-blocks' ),
			slug: 'wp-blocks',
			path: 'blocks',
		},
		{
			name: __( 'Settings', 'wpb-blocks' ),
			slug: 'wp-blocks',
			path: 'settings',
		},
    ];

    const query = new URLSearchParams( useLocation()?.search );
	const activePage = query.get( 'page' ) ? query.get( 'page' ) : 'wp-blocks';
	const activePath = query.get( 'path' ) ? query.get( 'path' ) : '';
    
    return (
        <>
            <Disclosure as="nav" className="bg-white shadow border border-solid border-border-subtle">
                <div>
                { menus.map( ( menu, key ) => (
                    <Link
                        index={ key }
                        key={ `?page=${ menu.slug }&path=${ menu.path }` }
                        // to={ {
                        //     pathname: './admin.php',
                        //     search: `?page=${ menu.slug }${ '' !== menu.path ? '&path=' + menu.path : '' }`,
                        // } }
                        to={window.location.origin + '/wp-admin/admin.php?page=' + menu.slug + (menu.path ? '&path=' + menu.path : '')}
                        className={ `content-center no-underline relative h-full py-0 px-1 m-0 bg-transparent outline-none shadow-none border-0 focus:outline-none ${
                            activePage === menu.slug && activePath === menu.path ? 'text-text-primary' : 'text-[#4B5563]'
                        } text-sm font-medium cursor-pointer` }
                    >
                        { menu.name }
                        { activePage === menu.slug && activePath === menu.path && (
                            <span className="absolute md:bottom-0 -bottom-6 left-0 w-full h-px bg-brand-primary-600 lg:block hidden"></span>
                        ) }
                    </Link>
                ) ) }
                </div>
            </Disclosure>
        </>
    );
}

export default Navigation;
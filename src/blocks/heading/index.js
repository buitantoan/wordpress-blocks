import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import save from './save';

registerBlockType('wpb-block/heading', {
    title: __('Heading', 'wpb-blocks'),
    attributes: {
        block_id: {
            type: 'string',
        },
    },
    providesContext: {
        'wpb-block/heading': 'block_id',
    },
    edit: Edit,
    save,
});
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import save from './save';

registerBlockType('wordpress-blocks/heading', {
    title: __('Heading', 'wpb-blocks'),
    edit: Edit,
    save,
});
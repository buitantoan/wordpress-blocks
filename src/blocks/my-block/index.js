import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import save from './save';

registerBlockType('wordpress-blocks/my-block', {
	title: __('My Block', 'wpb-blocks'),
	edit: Edit,
	save,
});
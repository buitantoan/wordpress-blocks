import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<>
			<div { ...useBlockProps() }>
				{ __('Hello from the editor!', 'wpb-blocks') }
			</div>
		</>
	);
}
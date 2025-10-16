import { useBlockProps } from '@wordpress/block-editor';

export default function save() {
	return (
		<>
			<div { ...useBlockProps.save() }>
				Hello from the frontend!
			</div>
		</>
	);
}
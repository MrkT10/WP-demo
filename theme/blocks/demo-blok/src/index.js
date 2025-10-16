import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';

registerBlockType('wpbasestarter/demo-blok', {
    title: 'Demo Blok',
    icon: 'edit',
    category: 'text',

    attributes: {
        content: { type: 'string', source: 'html', selector: 'p' },
    },

    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();

        return (
            <RichText
                {...blockProps}
                tagName="p"
                value={attributes.content}
                onChange={(newContent) => setAttributes({ content: newContent })}
                placeholder="Wpisz swój tekst do zapisania..."
            />
        );
    },

    save({ attributes }) {
        const blockProps = useBlockProps.save();

        return (
            <RichText.Content
                {...blockProps}
                tagName="p"
                value={attributes.content}
            />
        );
    },
});

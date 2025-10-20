import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';

registerBlockType('wpbasestarter/demo-blok', {
    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();
        return (
            <RichText
                {...blockProps}
                tagName="p"
                value={attributes.content}
                onChange={(value) => setAttributes({ content: value })}
                placeholder="Wpisz swój tekst do zapisania..."
            />
        );
    },
    save({ attributes }) {
        const blockProps = useBlockProps.save();
        if (!attributes.content) return null;
        return <RichText.Content {...blockProps} tagName="p" value={attributes.content} />;
    }
});

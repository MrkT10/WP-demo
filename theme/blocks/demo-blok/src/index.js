import { registerBlockType } from '@wordpress/blocks';
import { useState, useEffect } from '@wordpress/element';
import { useBlockProps, RichText } from '@wordpress/block-editor';

registerBlockType('wpbasestarter/demo-blok', {
    title: 'Demo Blok',
    icon: 'edit',
    category: 'text',

    attributes: {
        content: { type: 'string' },
    },

    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();
        useEffect(() => {
            fetch(`${window.location.origin}/wp-json/wpbasestarter/v1/demo-block/1`)
                .then(res => res.json())
                .then(data => {
                    setAttributes({ content: data.content });
                });
        }, []);

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

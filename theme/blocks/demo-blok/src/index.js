import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import './style.scss'

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
        const blockProps = useBlockProps.save({
            className: 'demo-block',
        });
        if (!attributes.content) return null;

        const apiUrl = `${window.location.origin}/wp-json/wpbasestarter/v1/demo-block/1`;
        const wpApiUrl = `${window.location.origin}/wp-json/wp/v2/posts/1`;

        return (
            <div {...blockProps}>
                <h2>W tym miejscu zaczyna się wygenerowany blok gutenberga</h2>
                <div>
                    <p><span class="ol">1.</span>Tutaj znajdziesz swój tekst po zapisie z custom block:</p>
                    <div class="textarea">
                        <RichText.Content tagName="p" value={attributes.content} />
                    </div>
                </div>
                <div>
                    <p><span class="ol">2.</span>Sprawdź zapis w meta danych wpisu w standardowym WP API pod nazwą '<span class="font-bold">demo_block_content</span>'':</p>
                    <div class="code">
                        <p>{wpApiUrl}</p>
                    </div>
                    <p>Sprawdź sam w przeglądarce lub kliknij w <a href={wpApiUrl} target="_blank" rel="noopener noreferrer">ten link</a></p>
                </div>
                <div>
                    <p><span class="ol">3.</span>Tutaj sprawdzisz dane bezpośrednio z custom REST API</p>
                    <div class="code">
                        <p>{apiUrl}</p>    
                    </div>
                    <span>Sprawdź sam w przeglądarce lub kliknij w </span><a href={apiUrl} target="_blank" rel="noopener noreferrer">Link do custom REST API</a>
                </div>
                <div>
                    <p><span class="ol">4.</span>Eksport z custom rest api do pliku json:</p>             
                    <a
                        href={apiUrl}
                        class="demo-block-download-button"
                        download="demo-block-1.json"
                        onClick={e => {
                            e.preventDefault();
                            fetch(apiUrl)
                                .then(res => res.json())
                                .then(data => {
                                    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
                                    const url = URL.createObjectURL(blob);
                                    const a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'demo-block-1.json';
                                    a.click();
                                    URL.revokeObjectURL(url);
                                });
                        }}
                    >Pobierz plik</a>
                </div>
                <h3>Koniec bloku</h3>
            </div>
        );
    }
});

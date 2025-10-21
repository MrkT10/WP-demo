/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

// form validate
document.getElementById('demo-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const city = document.getElementById('city').value.trim();
    const email = document.getElementById('email').value.trim();
    const result = document.getElementById('form-result');

    result.textContent = "Przetwarzanie...";
    result.style.color = "#555";

    fetch('/wp-admin/admin-ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'form_check',
            name,
            city,
            email
        })
    })
    .then(res => res.json())
    .then(data => {
        result.textContent = data.message;
        result.style.color = data.success ? "#02d102" : "#d10202";
    })
    .catch(() => {
        result.textContent = "Wystąpił błąd połączenia.";
        result.style.color = "#d10202";
    });
});

import 'cookieconsent/build/cookieconsent.min.css';
import * as cookieconsent from 'cookieconsent';

document.addEventListener('DOMContentLoaded', function() {
    cookieconsent.initialize({
        "palette": {
            "popup": {
                "background": "#000"
            },
            "button": {
                "background": "#f1d600"
            }
        },
        "theme": "classic",
        "position": "bottom-right",
        "content": {
            "message": "This website uses cookies to ensure you get the best experience on our website.",
            "dismiss": "Got it!",
            "link": "Learn more",
            "href": "/privacy-policy"
        }
    });
});

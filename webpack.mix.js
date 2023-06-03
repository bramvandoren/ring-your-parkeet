const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.disableNotifications();
// mix.setNotification({
//     title: "Laravel Mix",
//     successIcon: "path/to/custom/success/icon.png",
//     failureIcon: "path/to/custom/failure/icon.png",
// });

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [
        //
    ]
);

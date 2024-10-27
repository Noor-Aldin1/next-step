const mix = require("laravel-mix");

// Compiling JavaScript and Sass files
mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")

    // Copying Mobiscroll CSS and JS to the specified locations
    .styles(
        "node_modules/mobiscroll/css/mobiscroll.min.css", // Source
        "public/event/css/mobiscroll.min.css" // Destination for CSS
    )
    .scripts(
        "node_modules/mobiscroll/js/mobiscroll.jquery.min.js", // Source
        "public/event/mobiscroll.jquery.min.js" // Destination for JS
    );

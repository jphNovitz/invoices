module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily:{
              'header': ["Fira Sans", "sans-serif"],
              'body': ["Montserrat", "sans-serif"],
            },
            backgroundImage: {
                // 'hero': "url('/img/screenshot 2023-01.webp')",
                'hero-mobile': "url('/img/screenshot-test.webp')",
                'hero-md': "url('/img/screenshot-test.webp')",
                'auth': "url('/img/invoice-bg.webp')",
            },
            transitionProperty: {
                'height': 'height',
                'width': 'width',
                'hover': 'hover',
                ':after': ':after'
            }
        },
    },
    plugins: [],
}
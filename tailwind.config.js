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
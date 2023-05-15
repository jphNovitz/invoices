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
                'hero-mobile': "url('/img/hero-mobile.webp')",
                'hero-md': "url('/img/hero-md.webp')",
                'auth-mobile': "bg-gradient-to-r from-slate-900 via-slate-50 to-slate-100",
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
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './Modules/**/Resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
          },
          animation: {
            fadeIn: 'fadeIn 3s ease-in-out',
          },
        },
      },
    // theme: {
    //     extend: {
    //         fontFamily: {
    //             sans: ['Figtree', ...defaultTheme.fontFamily.sans],
    //         },
    //     },
    // },

    plugins: [forms, require('flowbite/plugin')],
};

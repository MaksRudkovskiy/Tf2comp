import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            backgroundColor: {
                // Задний фон
                'back': '#1D1C1A',
                // Цвет основного заднего блока
                'main': '#141414',
                // Цвет переднего блока
                'front': '#0E0E0E',
                // Кнопки
                'buttons': '#0A0A0A',
                // Средние блоки
                'block': '#131313',
                // Каталоговые блоки
                'catalog': '#262222',
                'catalog_selected': '#B1A996',
            },
            colors: {
                custom: {
                    'text-hover': '#4C7285',
                    'primary': '#EBE3CB',
                    '202124': '#202124',
                    'EDF1FF': '#EDF1FF',
                    'C1CFFF': '#C1CFFF',
                    '4D52BC': '#4D52BC',
                    '2d2f37': '#2d2f37',
                    'EBE3CB': '#EBE3CB',
                    'A1A1A1': '#A1A1A1',
                    'danger': '#380303',
                    'positive': '#A9CAF5',
                    'ret': '#9E2E2C',
                    'blu': '#4D758E',
                    'uncommon': '#FFDC00',

                    'back': '#1D1C1A',
                    // Цвет основного заднего блока
                    'main': '#141414',
                    // Цвет переднего блока
                    'front': '#0E0E0E',
                    // Кнопки
                    'buttons': '#0A0A0A',
                    // Средние блоки
                    'block': '#131313',
                    // Каталоговые блоки
                    'catalog': '#262222',
                    'catalog_selected': '#B1A996',
                }
            },
            fontFamily: {
                'tf2': ['TF2Secondary', ...defaultTheme.fontFamily.sans],
                'tf2build': ['TF2Build', ...defaultTheme.fontFamily.sans],
                'tf2icons': ['TF2 Character Icons', ...defaultTheme.fontFamily.sans],
                'tf2icons2': ['Hypnotize Icons Master', ...defaultTheme.fontFamily.sans],
                'tf2icons3': ['TF2 Icons', ...defaultTheme.fontFamily.sans],
            },
            hover: {
                'text-hover': '#4C7285',
                '4D52BC': '#4D52BC',
            },
            transitionDuration: {
                '0.5s': '0.5s',
                '0.3s': '0.3s',
            },
            border: {
                '4D52BC': '#4D52BC',
                'EBE3CB': '#EBE3CB',
            }
        },
    },

    plugins: [forms],
};

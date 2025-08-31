import './bootstrap';
import $ from 'jquery';

// Hacer jQuery disponible globalmente
window.$ = window.jQuery = $;

// Tu código jQuery aquí
$(document).ready(function() {
    console.log('jQuery está funcionando!');
});

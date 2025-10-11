import './bootstrap';


$('form').on('submit', function() {
    $(this).find('input[type="submit"]').prop('disabled', true);
});

function loadPage(page) {
    $.ajax({
        url: '/' + page,
        method: 'GET',
        success: function (data) {
            $('body').html(data);
        }
    });
}

$('.page-link').on('click', function (e) {
    e.preventDefault();
    var page = $(this).data('page');
    loadPage(page);
});
function loadPage(page) {
    $.ajax({
        url: '/' + page,
        method: 'GET',
        success: function (data) {
            $('body').html(data);
            window.history.pushState('', '', '/' + page);
        }
    });
}

$('.page-link').on('click', function (e) {
    e.preventDefault();
    var page = $(this).data('page');
    loadPage(page);
});

$('.page-link[data-page="logout"]').on('click', function (e) {
    e.preventDefault();
    
    $.ajax({
        url: '/logout',
        method: 'GET',
        success: function (response) {
            if (response.success) {
                loadPage('connexion');
            } else {
                console.error('Erreur lors de la déconnexion.');
            }
        }
    });
});



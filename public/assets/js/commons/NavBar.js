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

$('.page-link[data-page="logout"]').on('click', function (e) {
    e.preventDefault();
   
    $.ajax({
        url: '/logout',
        method: 'GET',
        success: function (response) {
            if (response) {
                console.log('logout');
                loadPage('connexion');
            } else {
                console.error('Erreur lors de la déconnexion.');
            }
        }
    });
});



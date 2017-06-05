$(function () {

    var title = 'Coding Avenue';
    var base_url = '/coding-avenue-v3/';
    var main = 'main.php';

    var load = function (url) {
        $.get(url).done(function (data) {
            $("#content").html(data);
        })
    };

    $(document).on('click', 'a', function (e) {

        e.preventDefault();

        var $this = $(this);
        var url = $this.attr("href");

        if(url == '#') return false;

        history.pushState({
            url: url
        }, title, base_url);

        document.title = title;

        load(url);

    });

    $(window).on('popstate', function (e) {
        var state = e.originalEvent.state;
        if (state !== null) {
            document.title = state.title;
            load(state.url);
        } else {
            document.title = title;
            load(main);
        }
    });

    load(main);
    
});
$(document).ready(function () {
    $('[data-bs-toggle="collapse"]').on('click', function () {
        var target = $($(this).attr('data-bs-target'));
        var clickedButton = $(this);
        var showMoreButton = target.siblings('.show-more-btn');
        var showLessButton = target.find('.show-less-btn');

        if (clickedButton.hasClass('show-more-btn')) {

            showMoreButton.hide();
            showLessButton.show();
        } else if (clickedButton.hasClass('show-less-btn')) {

            showMoreButton.show();
            showLessButton.hide();
        }
    });
});

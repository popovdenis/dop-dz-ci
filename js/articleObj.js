/**
 * Created by Denis on 24.01.2016.
 */
var articleObj = {
    baseUrl: null,

    setBaseUrl: function(baseUrl) {
        this.baseUrl = baseUrl;
    },

    init: function () {
        this.editEvent();
        this.deleteEvent();
        this.messageEvent();
    },

    editEvent: function () {
        $('.edit_article').each(function(){
            var elementSpan = $(this);
            var articleId = elementSpan.data('article-id');
            elementSpan.on('click', function(e) {
                e.preventDefault();
                articleObj.getArticle(articleId);
            });
        });
    },

    deleteEvent: function () {
        $('.delete_article').each(function(){
            var elementSpan = $(this);
            var articleId = elementSpan.data('article-id');
            elementSpan.on('click', function(e) {
                e.preventDefault();
                articleObj.deleteArticle(articleId);
            });
        });
    },

    messageEvent: function () {
        $('.message').delay(500).fadeOut(1200);
    },

    fillForm: function(articleData) {
        if (articleData == undefined || articleData == '') {
            return;
        }

        var modalBody = $('#editArticle').find('.modal-body');
        modalBody.find('.title').val(articleData.title);
        modalBody.find('.content').val(articleData.content);
        modalBody.find('.public-date').val(articleData.public_date);
        modalBody.find('.edit-article').on('click', function(e) {
            e.preventDefault();
            articleObj.updateArticle(articleData.id);
        });
    },

    updateArticle: function(articleId) {
        var modalBody = $('#editArticle').find('.modal-body');
        $.ajax({
            type: "POST",
            url: articleObj.baseUrl + '/update/' + articleId,
            data: {
                'title': modalBody.find('.title').val(),
                'content': modalBody.find('.content').val(),
                'public_date': modalBody.find('.public-date').val()
            },
            dataType: "json",
            beforeSend: function () {},
            success: function (data) {
                window.location.href = articleObj.baseUrl;
            },
            error: function (data) {}
        });
    },

    getArticle: function (articleId) {
        $.ajax({
            type: "POST",
            url: articleObj.baseUrl + '/getArticle/' + articleId,
            dataType: "json",
            beforeSend: function () {},
            success: function (data) {
                articleObj.fillForm(data);
                $('#editArticle').modal();
            },
            error: function (data) {}
        });
    },

    deleteArticle: function(articleId) {
        $.get(
            articleObj.baseUrl + '/delete/' + articleId,
            function(data) {
                $('.delete_article[data-article-id="' + articleId + '"]').closest('tr').remove();
            }
        ).fail(function() {alert( "error" );});
    }
};
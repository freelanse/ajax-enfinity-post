jQuery(function($) {
    let currentPostId = parseInt($('article').data('post-id')); // Текущий ID
    let isLoading = false; // Флаг, чтобы избежать нескольких запросов одновременно

    $(window).on('scroll', function() {
        if (isLoading) return; // Уже идёт загрузка

        const articleBottom = $('article').last().offset().top + $('article').last().outerHeight();
        const scrollPosition = $(window).scrollTop() + $(window).height();

        if (scrollPosition > articleBottom - 100) { // Если приблизились к концу последней статьи
            isLoading = true;

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'load_next_post',
                    current_post_id: currentPostId // Передаём ID текущей статьи
                },
                success: function(response) {
                    if (response.success) {
                        response.data.forEach(post => {
                            const postHtml = `
                                <article class="next-post-item" data-post-id="${post.id}">
                                    <h2>${post.title}</h2>
                                    <p>${post.excerpt}</p>
                                    <a href="${post.link}">Читать дальше</a>
                                </article>`;
                            $('article').last().after(postHtml);

                            // Обновляем текущий ID на последний загруженный
                            currentPostId = post.id;
                        });
                    } else {
                        console.log(response.data); // Логируем сообщение
                    }
                    isLoading = false;
                },
                error: function(xhr) {
                    console.error('Ошибка AJAX-запроса:', xhr);
                    isLoading = false;
                }
            });
        }
    });
});

<?php

function my_enqueue_scripts() {
    wp_enqueue_script('my-main-js', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);

    wp_localize_script('my-main-js', 'wp_localize_script_data', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

function my_ajaxurl_script() {
    echo '<script type="text/javascript">
        var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    </script>';
}
add_action('wp_head', 'my_ajaxurl_script');


function load_next_post() {
    if (!isset($_POST['current_post_id']) || !is_numeric($_POST['current_post_id'])) {
        wp_send_json_error('Текущий ID записи отсутствует или некорректен.');
    }

    $current_post_id = intval($_POST['current_post_id']); // Текущий ID записи

    $args = array(
        'post_type'      => 'post',       // Тип записей
        'posts_per_page' => 1,           // Загружаем одну запись за раз
        'orderby'        => 'date',      // Сортировка по дате
        'order'          => 'DESC',      // От новых к старым
        'post_status'    => 'publish',   // Только опубликованные записи
        'post__not_in'   => array($current_post_id), // Исключаем текущую запись
        'date_query'     => array(
            'before' => get_post_field('post_date', $current_post_id), // Старше текущей записи
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $posts = array();

        while ($query->have_posts()) {
            $query->the_post();

            $posts[] = array(
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_the_permalink(),
                'excerpt' => get_the_excerpt(),
            );
        }

        wp_reset_postdata();
        wp_send_json_success($posts);
    } else {
        wp_send_json_error('Нет следующих записей.');
    }
}

add_action('wp_ajax_load_next_post', 'load_next_post');
add_action('wp_ajax_nopriv_load_next_post', 'load_next_post');

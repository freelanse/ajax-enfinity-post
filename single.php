<!DOCTYPE html>
<html>
<head>
    <!-- PAGE TITLE -->
    <title>Готовый сайт "Штукатурка стен" Landing Page</title>
<style>
    
    #next-post-container .post-content {
    margin-top: 50px;
    border-top: 1px solid #ddd;
    padding-top: 20px;
}
.post{width: 300px;  margin:auto; margin-top: 100px;}

</style>
    <!-- META-DATA -->
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<?php wp_head()?>
</head>

<body>

<article id="post-<?php the_ID(); ?>" class="post" data-post-id="<?php the_ID(); ?>">
    <h1><?php the_title(); ?></h1>
    <div><?php the_content(); ?></div>
</article>



<?php wp_footer();?>

</body>
</html>

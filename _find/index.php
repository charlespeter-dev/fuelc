<?php

require '../wp-load.php';

if (!is_user_logged_in()) {
    exit('Please login');
}

$results = [];

if (isset($_GET['s']) && $_GET['s']) {
    global $wpdb;
    $sql = "SELECT DISTINCT p.ID, p.post_type, p.post_title, pm.meta_key, pm.meta_value FROM `wp_posts` p LEFT JOIN `wp_postmeta` pm ON (p.ID = pm.post_id) WHERE pm.meta_key = '_elementor_data' AND pm.meta_value LIKE '%s' AND (p.post_type = 'page' OR p.post_type = 'post') AND p.post_status = 'publish' ORDER BY p.post_type";
    $sql = $wpdb->prepare($sql, '%' . $wpdb->esc_like($_GET['s']) . '%');
    $res_elementor = $wpdb->get_results($sql, ARRAY_A);

    if ($res_elementor) {
        foreach ($res_elementor as $r) {
            $excluded_ids[] = $r['ID'];
        }

        if ($excluded_ids) {
            $sql = "SELECT DISTINCT p.ID, p.post_type, p.post_title FROM `wp_posts` p WHERE p.post_content LIKE '%s' AND p.ID NOT IN (%s) AND (p.post_type = 'page' OR p.post_type = 'post') AND p.post_status = 'publish' ORDER BY p.post_type";
            $sql = $wpdb->prepare($sql, '%' . $wpdb->esc_like($_GET['s']) . '%', implode(',', $excluded_ids));
            $res_default = $wpdb->get_results($sql, ARRAY_A);
        }
    }

    if ($res_elementor && $res_default) {
        $results = array_merge($res_elementor, $res_default);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Search &amp; Replace</title>
</head>

<body>

    <header class="mb-5">
        <section>
            <div class="container">
                <h1>
                    Search & Replace
                </h1>
            </div>
        </section>
    </header>

    <main>
        <section>
            <div class="container">
                <form action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="mb-3">
                        <label for="s" class="form-label">Search String:</label>
                        <input type="text" class="form-control" id="s" name="s" value="<?= isset($_GET['s']) ? urldecode($_GET['s']) : '' ?>">
                    </div>
                </form>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="alert alert-primary" role="alert">
                    Found: <strong><?= count($results) ?></strong>
                </div>
            </div>
        </section>

        <?php if ($results) : ?>

            <section>
                <div class="container">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Post Type</th>
                                    <th scope="col">Post Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $k => $r) : ?>
                                    <tr>
                                        <td><?= ($k + 1) ?></td>
                                        <th scope="row"><?= $r['ID'] ?></th>
                                        <td><?= $r['post_type'] ?></td>
                                        <td><a href="<?= get_the_permalink($r['ID']) . "#:~:text=" . rawurldecode($_GET['s']) ?>" target="_blank"><?= $r['post_title'] ?></a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

        <?php endif ?>
    </main>

</body>

</html>
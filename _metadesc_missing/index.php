<?php


require 'vendor/autoload.php';
require '../wp-load.php';

if (!is_user_logged_in()) {
    exit('Please login');
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;

global $wpdb;

/**
 * save metadesc
 */

$contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

if ($contentType === 'application/json') {
    $content = trim(file_get_contents("php://input"));
    $decoded = json_decode($content, true);

    if (isset($decoded['action']) && $decoded['action'] == 'save_metadesc') {
        if (isset($decoded['post_id']) && $decoded['post_id'] && isset($decoded['metadesc']) && $decoded['metadesc']) {

            $post_id = $decoded['post_id'];
            $metadesc = $decoded['metadesc'];

            /**
             * _2x_metadesc_missing
             */

            $sql = "UPDATE _2x_metadesc_missing SET new_metadesc = '%s' WHERE post_id = %d";
            $sql = $wpdb->prepare($sql, $metadesc, $post_id);
            $res = $wpdb->query($sql);

            /**
             * wp_postmeta
             */

            update_post_meta($post_id, '_yoast_wpseo_metadesc', $metadesc);

            /**
             * result
             */

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'result' => 'success',
                'metadesc' => $metadesc
            ]);
            exit;
        }
    }
}


/****************************
 * read xlsx
 */

$inputFileType = 'Xlsx';
$inputFileName = './metadesc.xlsx';
$sheetname = '14';

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $sheetname = '')
    {
        if (($column == 'A' || $column == 'G') && $row < 283) {
            return true;
        }
        return false;
    }
}

$filterSubset = new MyReadFilter();
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
$reader->setLoadSheetsOnly($sheetname);
$reader->setReadFilter($filterSubset);
$spreadsheet = $reader->load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray();
$valid = $invalid = [];


foreach ($sheetData as $sd) {
    if (is_array($sd)) {
        if (isset($sd[0]) && $sd[0] && isset($sd[6]) && $sd[6] && $sd[6] == 'Indexable') {
            if (filter_var($sd[0], FILTER_VALIDATE_URL))
                $valid[] = $sd[0];
        } else {
            $invalid[] = $sd;
        }
    }
}

sort($valid);

$exploded = array_map(function ($v) {
    return explode('/', $v);
}, $valid);

$filtered = [];

foreach ($exploded as $arr) {
    if (sizeof($arr) == 5)
        $filtered[] = $arr[3];
    if (sizeof($arr) == 6)
        $filtered[] = $arr[4];
}

$ids = [];
$sql = "TRUNCATE _2x_metadesc_missing";
$wpdb->query($sql);

foreach ($filtered as $post_name) {

    /**
     * get post_id
     */

    $sql = "SELECT ID FROM `wp_posts` WHERE post_name = '%s';";
    $sql = $wpdb->prepare($sql, $post_name);
    $res = $wpdb->get_results($sql, ARRAY_A);
    $post_id = $res[0]['ID'] ?? null;

    /**
     * get _yoast_wpseo_metadesc
     */

    $old_metadesc = get_post_meta($post_id, '_yoast_wpseo_metadesc', true);

    /**
     * insert to _2x_metadesc_missing
     */

    $sql = "INSERT INTO _2x_metadesc_missing SET post_id = %d, old_metadesc = '%s'";
    $sql = $wpdb->prepare($sql, $post_id, $old_metadesc);
    $res = $wpdb->query($sql);

    /**
     * collect
     */

    $ids[] = [
        'post_id' => $post_id,
        'old_metadesc' => $old_metadesc
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Meta Data Updater</title>
    <style>
        textarea {
            height: 130px;
        }

        a {
            text-decoration: none !important;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Status</th>
                        <th scope="col">Current Meta Description</th>
                        <th scope="col">URL</th>

                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($ids as $k => $id) :

                        $link = get_the_permalink($id['post_id']);
                        $title = get_the_title($id['post_id']);
                        $cat = get_the_category($id['post_id'])[0]->name ?? null;
                        $cat = $cat ? $cat . ' / ' : $cat;
                    ?>
                        <tr>
                            <td>
                                <?= ($k + 1) ?>
                            </td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?= $id['post_id'] ?>">EDIT</button>
                            </td>
                            <td>
                                <?php if (!$id['old_metadesc']) : ?>
                                    <span id="badge-<?= $id['post_id'] ?>" class="badge text-bg-warning">Missing</span>
                                <?php else : ?>
                                    <span id="badge-<?= $id['post_id'] ?>" class="badge text-bg-success">Found</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <div id="old-metadesc-<?= $id['post_id'] ?>">
                                    <?= $id['old_metadesc'] ?>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <?= $cat ?> <a href="<?= $link ?>" target="_blank"><?= $title ?></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <!-- modal -->

        <?php foreach ($ids as $k => $id) : ?>

            <div class="modal fade" id="modal-<?= $id['post_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5"><?= $k + 1 ?>. <?= get_the_title($id['post_id']) ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="new-meta-desc-<?= $id['post_id'] ?>" class="form-label">
                                        New Meta Description:
                                    </label>
                                    <textarea class="form-control" id="new-meta-desc-<?= $id['post_id'] ?>"></textarea>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-<?= $id['post_id'] ?>">Close</button>
                            <button type="button" class="save btn btn-primary" data-id="<?= $id['post_id'] ?>">Save Meta Description</button>
                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script>
        async function postData(url = "", data = {}) {
            // Default options are marked with *
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data), // body data type must match "Content-Type" header
            });
            return response.json(); // parses JSON response into native JavaScript objects
        };
        document.addEventListener('DOMContentLoaded', function() {
            const saveButtons = document.querySelectorAll('.save');
            saveButtons.forEach(function(saveButton) {

                saveButton.addEventListener('click', function() {
                    const post_id = saveButton.dataset.id;
                    const metadesc = document.querySelector(`textarea[id="new-meta-desc-${post_id}"]`);

                    if (metadesc.value.length) {
                        metadesc.setAttribute('disabled', 'disabled');
                        saveButton.setAttribute('disabled', 'disabled');

                        /**
                         * POST metadesc.value using fetch()
                         */

                        postData('<?= $_SERVER['PHP_SELF'] ?>', {
                            action: 'save_metadesc',
                            post_id: post_id,
                            metadesc: metadesc.value
                        }).then((data) => {
                            document.querySelector(`[id="old-metadesc-${post_id}"]`).innerHTML = metadesc.value;
                            document.querySelector(`[id="badge-${post_id}"]`).innerHTML = 'Found';
                            document.querySelector(`[id="badge-${post_id}"]`).classList.replace('text-bg-warning', 'text-bg-success');
                            document.querySelector(`[id="close-${post_id}"]`).click();

                            metadesc.removeAttribute('disabled');
                            saveButton.removeAttribute('disabled');
                            metadesc.value = '';
                        });
                    }

                })

            });
        });
    </script>
</body>

</html>
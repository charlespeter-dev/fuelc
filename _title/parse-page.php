<?php


require '../_metadesc/vendor/autoload.php';
require '../wp-load.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

global $wpdb;

/****************************
 * read xlsx
 */

$inputFileType = 'Xlsx';
$inputFileName = '../_metadesc/metadesc.xlsx';
$sheetname = 'Pages in Menu Bar (Priority)';

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $sheetname = '')
    {
        if (($column == 'A' || $column == 'D') && $row < 29) {
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
$invalid = [];

foreach ($sheetData as $sd) {
    if (is_array($sd)) {
        if (isset($sd[0]) && $sd[0]) {
            if (preg_match('/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/i', $sd[0], $matches)) {

                $sql = "INSERT INTO _2x_title_page_xlsx SET url = '%s', new_title = '%s'";
                $sql = $wpdb->prepare($sql, $sd[0], $sd[3]);
                $res = $wpdb->query($sql);
            } else {

                $invalid[] = [
                    'url' => $sd[0],
                    'new_title' => $sd[3]
                ];
            }
        }
    }
}

/***************/

$sql = "SELECT url, new_title FROM _2x_title_page_xlsx";
$res = $wpdb->get_results($sql, ARRAY_A);
$new_title = '';

foreach ($res as $xlsx) {

    // new title
    // %%sep%% %%sitename%%

    if (stripos($xlsx['new_title'], '- Fuel Cycle') !== false) {
        $new_title = str_replace('- Fuel Cycle', '', $xlsx['new_title']);
        $new_title = trim($new_title);
        $new_title = $new_title . " %%sep%% %%sitename%%";
    } else {
        $invalid[] = [
            'url' => $xlsx['url'],
            'new_title' => $xlsx['new_title']
        ];

        $new_title = '';
    }

    $slug = str_replace(['https://fuelcycle.com/', 'http://fuelcycle.com/'], '', $xlsx['url']);

    // fontpage

    if (!$slug) {

        $slug = '/';
        $front_id = get_option('page_on_front');

        if ($front_id) {

            // get old_title
            $old_title = get_post_meta($front_id, '_yoast_wpseo_title', true);

            $sql = "UPDATE _2x_title_page_xlsx SET old_title = '%s', post_id = %d, slug = '%s' WHERE url = '%s'";
            $sql = $wpdb->prepare($sql, $old_title, $front_id, $slug, $xlsx['url']);
            $wpdb->query($sql);

            if ($new_title) {

                // update wp_postmeta

                $sanitized_new_meta_value = wp_strip_all_tags($new_title);
                update_post_meta($front_id, '_yoast_wpseo_title', $sanitized_new_meta_value);
            }
        }

        continue;
    }

    $res_page = get_page_by_path($slug, ARRAY_A);

    if (isset($res_page['ID']) && $res_page['ID']) {

        // get old_title
        $old_title = get_post_meta($res_page['ID'], '_yoast_wpseo_title', true);

        $sql = "UPDATE _2x_title_page_xlsx SET old_title = '%s', post_id = %d, slug = '%s' WHERE url = '%s'";
        $sql = $wpdb->prepare($sql, $old_title, $res_page['ID'], $slug, $xlsx['url']);
        $wpdb->query($sql);

        if ($new_title) {

            // update wp_postmeta

            $sanitized_new_meta_value = wp_strip_all_tags($new_title);
            update_post_meta($res_page['ID'], '_yoast_wpseo_title', $sanitized_new_meta_value);
        }
    } else {

        $invalid[] = [
            'url' => $xlsx['url'],
            'slug' => $slug,
            'id' => 0
        ];
    }
}

print_r($invalid);



// SELECT DISTINCT x.post_id, x.url, x.old_title, m.meta_value AS new_title FROM `_2x_title_page_xlsx` x LEFT JOIN wp_postmeta m ON m.post_id = x.post_id WHERE m.meta_key = '_yoast_wpseo_title' ORDER BY `x`.`_2x_title_page_xlsx_id` ASC LIMIT 1000;

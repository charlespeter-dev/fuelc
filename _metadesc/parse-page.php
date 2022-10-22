<?php


require 'vendor/autoload.php';
require '../wp-load.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

global $wpdb;

/****************************
 * read xlsx
 */

$inputFileType = 'Xlsx';
$inputFileName = './metadesc.xlsx';
$sheetname = 'Pages in Menu Bar (Priority)';

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $sheetname = '')
    {
        if (($column == 'A' || $column == 'F') && $row < 29) {
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

                $sql = "INSERT INTO _2x_metadesc_page_xlsx SET url = '%s', new_meta_desc = '%s'";
                $sql = $wpdb->prepare($sql, $sd[0], $sd[5]);
                $res = $wpdb->query($sql);
            } else {

                $invalid[] = [
                    'url' => $sd[0],
                    'new_meta_desc' => $sd[5]
                ];
            }
        }
    }
}

/***************/

$sql = "SELECT url, new_meta_desc FROM _2x_metadesc_page_xlsx";
$res = $wpdb->get_results($sql, ARRAY_A);


foreach ($res as $xlsx) {

    $slug = str_replace(['https://fuelcycle.com/', 'http://fuelcycle.com/'], '', $xlsx['url']);

    // fontpage

    if (!$slug) {

        $slug = '/';
        $front_id = get_option('page_on_front');

        if ($front_id) {

            // get old_meta_desc
            $old_meta_desc = get_post_meta($front_id, '_yoast_wpseo_metadesc', true);

            $sql = "UPDATE _2x_metadesc_page_xlsx SET old_meta_desc = '%s', post_id = %d, slug = '%s' WHERE url = '%s'";
            $sql = $wpdb->prepare($sql, $old_meta_desc, $front_id, $slug, $xlsx['url']);
            $wpdb->query($sql);

            if ($xlsx['new_meta_desc']) {

                // update wp_postmeta

                $sanitized_new_meta_value = wp_strip_all_tags($xlsx['new_meta_desc']);
                update_post_meta($front_id, '_yoast_wpseo_metadesc', $sanitized_new_meta_value);
            }
        }

        continue;
    }

    $res_page = get_page_by_path($slug, ARRAY_A);

    if (isset($res_page['ID']) && $res_page['ID']) {

        // get old_meta_desc
        $old_meta_desc = get_post_meta($res_page['ID'], '_yoast_wpseo_metadesc', true);

        $sql = "UPDATE _2x_metadesc_page_xlsx SET old_meta_desc = '%s', post_id = %d, slug = '%s' WHERE url = '%s'";
        $sql = $wpdb->prepare($sql, $old_meta_desc, $res_page['ID'], $slug, $xlsx['url']);
        $wpdb->query($sql);

        if ($xlsx['new_meta_desc']) {

            // update wp_postmeta

            $sanitized_new_meta_value = wp_strip_all_tags($xlsx['new_meta_desc']);
            update_post_meta($res_page['ID'], '_yoast_wpseo_metadesc', $sanitized_new_meta_value);
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




// SELECT DISTINCT x.post_id, x.url, x.old_meta_desc, m.meta_value AS new_meta_desc FROM `_2x_metadesc_page_xlsx` x LEFT JOIN wp_postmeta m ON m.post_id = x.post_id WHERE m.meta_key = '_yoast_wpseo_metadesc' ORDER BY `x`.`_2x_metadesc_page_xlsx_id` ASC LIMIT 1000;

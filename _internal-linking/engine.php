<?php

if (!$links)
    return;
echo "Links: " . count($links) . "\n";

$k = 0;

foreach ($links as $source => $keyword) {
    $slug = str_replace(['https://fuelcycle.com/blog/', 'http://fuelcycle.com/blog/'], '', $source);
    $slug = str_replace('/', '', $slug);

    if ($slug) {

        $query = new WP_Query([
            'posts_per_page' => -1,
            'name' => $slug,
            'post_type' => 'post'
        ]);

        $post_id = $query->post->ID;
        $content = $query->post->post_content;
        $needle = $keyword;
        $len = strlen($needle);
        $start = $count = 0;

        while (($pos = stripos($content,  $needle, $start)) !== false) {
            
            $count++;
            $start = $pos + 1;

            $rpcounter = $replace_counter[$source] ?? null;

            if ($rpcounter && ($rpcounter == $count)) {
                $oldneedle = substr($content, $pos, $len);
                $replacement = sprintf('<a href="%s" target="_blank" rel="noreferrer noopener">%s</a>', $dest, $oldneedle);
                $content = substr_replace($content, $replacement, $pos, $len);

                if (isset($argv[1]) && $argv[1] == 'save') {

                    wp_update_post([
                        'ID' => $post_id,
                        'post_content' => $content
                    ]);

                    echo "Saved: ";
                }

                echo $k + 1 . " " . $post_id . " " . $replacement . "\n";
            }
        }
    }

    $k++;
}

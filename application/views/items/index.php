<?php
if (!$items) :
    echo '<p>No items found.</p>';

else :
    echo '<h2>Items</h2>';
    echo '<ul>';

    foreach ($items as $item) {
//        $segments = array('items', url_title($item->name, 'dash', true), $item->id);
        $segments = array('items', 'details', $item->id);
//        echo '<li>' . anchor($segments, $item->name) . ' &ndash; $' . $item->price . '</li>';
        echo '<li>' . anchor($segments, $item->name) . ' &ndash; $' . $item->price . '</li>';
    }

    echo '</ul>';

endif;
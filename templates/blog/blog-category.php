    <?php
    $categories =  get_the_category();

    $is_single_cat = is_single() ? 'position-static mb-20' : '';
    ?>


    <div class="tp-postbox-cat <?php echo $is_single_cat; ?>">
        <?php foreach ($categories as $category): ?>
            <a href="<?php echo get_category_link($category->term_id) ?>">
                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.86489 8.14369L6.35396 12.6328C6.47025 12.7492 6.60835 12.8415 6.76036 12.9046C6.91238 12.9676 7.07532 13 7.23987 13C7.40443 13 7.56737 12.9676 7.71938 12.9046C7.8714 12.8415 8.0095 12.7492 8.12579 12.6328L13.5039 7.2609V1H7.24301L1.86489 6.37811C1.63167 6.61273 1.50077 6.93009 1.50077 7.2609C1.50077 7.59171 1.63167 7.90908 1.86489 8.14369Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <?php echo esc_html($category->name); ?>
            </a>
        <?php endforeach; ?>

    </div>
<?php

function kindaid_header()
{
    $header_from_page = function_exists('tpmeta_field') ? tpmeta_field('header-from-page') : 'header-1';
    if ($header_from_page == 'header-1') {
        get_template_part('templates/header/header-1');
    } elseif ($header_from_page == 'header-2') {
        get_template_part('templates/header/header-2');
    } else {
        get_template_part('templates/header/header-3');
    }
}


function theme_header_logo()
{
    $kinaid_logo_url = get_theme_mod('header_logo', get_template_directory_uri() . '/assets/img/logo/logo.png');
?>
    <a href="<?php echo home_url() ?>"><img data-width="108" src="<?php echo esc_url($kinaid_logo_url) ?>" alt="<?php echo esc_attr__('logo', 'kindaid') ?>"></a>
<?php
}


function kindaid_main_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'primary_menu',
        'container' => '',
        'main_class' => '',
        'fallback_cb' => 'Kindaid_Walker_Nav_Menu::fallback',
        'walker' => new Kindaid_Walker_Nav_Menu,
    ));
}

/*
* Generate custom search form
*
* @param string $form Form HTML.
* @return string Modified from HTML.
*/

function kindaid_sidebar_search($form)
{
    $form = '<div class="tp-widget-search mb-20"><form action="' . home_url('/') . '" method="get">
    <input type="text" value="' . get_search_query() . '" placeholder="' . esc_attr__('Search for:') . '">
    <button type="submit">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#121018" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M19.0004 19.0004L14.6504 14.6504" stroke="#121018" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
</form></div>';

    return $form;
}

add_filter('get_search_form', 'kindaid_sidebar_search');


// kind aid blog pagination
function kindaid_blog_pagination()
{
    global $wp_query;

    $big = 999999999; // need an unlikely integer

    $pages = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => __('<i class="far fa-arrow-left"></i>'),
        'next_text' => __('<i class="far fa-arrow-right"></i>'),
    ));


    if (is_array($pages)) :
        echo '<ul class="custom-pagination">';
        foreach ($pages as $page) {

            // Extract page number
            if (preg_match('/>(\d+)</', $page, $matches)) {
                $number = sprintf('%02d', $matches[1]); // 01, 02
                $page = preg_replace('/>(\d+)</', '>' . $number . '<', $page);
            }

            echo '<li>' . $page . '</li>';
        }
        echo '</ul>';
    endif;
}

/**
 * Sanitize SVG markup for front-end display.
 *
 * @param  string $svg SVG markup to sanitize.
 * @return string 	  Sanitized markup.
 */
function kindAid_kses($tag = '')
{
    $allowed_html = [
        'a' => [
            'class'  => [],
            'href'   => [],
            'title'  => [],
            'target' => [],
            'rel'    => [],
        ],
        'b' => [],
        'blockquote' => [
            'cite'   => [],
        ],
        'cite'      => [
            'title' => [],
        ],
        'code'         => [],
        'del'          => [
            'datetime' => [],
            'title'    => [],
        ],
        'div'       => [
            'class' => [],
            'title' => [],
            'style' => [],
        ],
        'dl'        => [],
        'dt'        => [],
        'em'        => [],
        'h1'        => [],
        'h2'        => [],
        'h3'        => [],
        'h4'        => [],
        'h5'        => [],
        'h6'        => [],
        'i'         => [
            'class' => [],
        ],
        'img'        => [
            'alt'    => [],
            'class'  => [],
            'height' => [],
            'src'    => [],
            'width'  => [],
        ],
        'li'        => array(
            'class' => array(),
        ),
        'ol'        => array(
            'class' => array(),
        ),
        'p'         => array(
            'class' => array(),
        ),
        'q'         => array(
            'cite'  => array(),
            'title' => array(),
        ),
        'span'      => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'iframe'          => array(
            'width'       => array(),
            'height'      => array(),
            'scrolling'   => array(),
            'frameborder' => array(),
            'allow'       => array(),
            'src'         => array(),
        ),
        'strike'          => array(),
        'br'              => array(),
        'strong'          => array(),
    ];

    return wp_kses($tag, $allowed_html);
}

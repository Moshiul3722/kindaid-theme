<?php
// Check if comments are allowed
if (comments_open()) :
    ?>
    <div id="comments" class="contact-form-box mb-50 tp-contact-form">
        <?php
        // Display the comments list
        if (have_comments()) :
            ?>
            <div class="tp-blog-comments mt-95 mb-75">
                <h3 class="tp-blog-comments-title mb-30">
                    <?php
                    $comment_count = get_comments_number();
                    echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'solub');
                    ?>
                </h3>
                <div class="tp-blog-comments-main">
                    <ul class="postbox__comment mb-95">
                        <?php
                        wp_list_comments(array(
                            'style'       => 'ul',
                            'short_ping'  => true,
                            'callback' => 'custom_comment_list'
                        ));
                        ?>
                    </ul>
                </div>
            </div>


            <?php
            // Display comment pagination if needed
            the_comments_pagination(array(
                'prev_text' => esc_html__('Previous', 'exdos'),
                'next_text' => esc_html__('Next', 'exdos'),
            ));
        endif;
        
        if ( is_user_logged_in() ) {
            $cl = 'loginformuser';
        } else {
            $cl = '';
        }

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');

        $fields = array(
            'author' => '<div class="row"><div class="col-md-4 mb-20"><label for="author" class="tp-form-label">' . esc_html__('Your name', 'exdos') . '</label><input class="tp-input" type="text" name="author" id="author" placeholder="' . esc_attr__('Your name', 'exdos') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '>
            </div>',
            'email' => '<div class="col-md-4 mb-20"> <label for="email" class="tp-form-label">' . esc_html__('Your Email', 'exdos') . '</label>
               <input class="tp-input" type="email" name="email" id="email" placeholder="' . esc_attr__('Email', 'exdos') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
           </div>',
            'url' => '<div class="col-md-4 mb-20"><label for="url" class="tp-form-label">' . esc_attr__('Website', 'exdos') . '</label><input class="tp-input" type="text" name="url" id="url" placeholder="' . esc_attr__('Website', 'exdos') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
         </div></div>',
        );


        $defaults = [
            'fields'             => $fields,
            'comment_field' => '<div class="col-xl-12 mb-20 ' . $cl . '"><label for="comment" class="tp-form-label">' . esc_attr__('Your Comments *', 'exdos') . '</label>
                       <textarea class="tp-input tp-textarea" id="comment" name="comment" placeholder="' . esc_attr__('Your Comment Here...', 'exdos') . '" required></textarea>
                </div>
            ',
            'submit_button' => '<div class="col-12">
                                <button type="submit" class="tp-btn rounded-5 tp-btn-animetion">
                                    <span class="btn-text">' . esc_html__('Post Comment', 'exdos') . '</span>
                                    <span class="btn-icon">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 7H13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    </button>
                                </div>',

            'cookies' => '<div class="col-xxl-12 mb-30">
                <div class="tp-contact-remember mb-30">' .
                '<input class="tp-checkbox tp-form-label" id="remeber" type="checkbox" name="wp-comment-agree" value="1" checked>' .
                '<label class="e-check-label" for="remeber">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'exdos') . '</label></div></div>'
        ];
        // Display the comment form
        comment_form($defaults);
        ?>
    </div><!-- .comments-area -->
<?php endif; ?>


<?php
// Move the comment textarea to the bottom
function move_comment_textarea_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_action('comment_form_fields', 'move_comment_textarea_to_bottom');
// comments for end 


// custom_comment_list
function custom_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
        // Display pingbacks and trackbacks differently if needed
        ?>
        <li class="pingback">
            <p><?php esc_html_e('Pingback:', 'exdos'); ?> <?php comment_author_link(); ?></p>
        </li>
        <?php
    } else {
        // Display regular comments
        ?>
        <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">

            <div class="tp-blog-comments-list mb-45">
                <div class="tp-blog-comments-thumb">
                    <?php echo get_avatar($comment, 70); ?>
                </div>
                <div class="tp-blog-comments-content">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                            <h4 class="tp-blog-comments-author-name"><?php comment_author(); ?></h4>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <span class="tp-blog-comments-date"><?php comment_date(); ?></span>
                        </div>
                    </div>
                    <?php comment_text(); ?>
                    <div class="tp-blog-comments-btn">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>
                  
        <?php
    }
}

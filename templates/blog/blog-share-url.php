<?php
$url   = urlencode(get_permalink());
$title = urlencode(get_the_title());
?>


<div class="col-xl-4">
    <div class="tp-blog-social text-xl-end mn-20">

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="18" viewBox="0 0 12 18" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.62839 7.77713C0.911363 7.77713 0.761719 7.91782 0.761719 8.59194V9.81416C0.761719 10.4883 0.911363 10.629 1.62839 10.629H3.36172V15.5179C3.36172 16.192 3.51136 16.3327 4.22839 16.3327H5.96172C6.67874 16.3327 6.82839 16.192 6.82839 15.5179V10.629H8.77466C9.31846 10.629 9.45859 10.5296 9.60798 10.038L9.97941 8.81579C10.2353 7.97368 10.0776 7.77713 9.14609 7.77713H6.82839V5.74009C6.82839 5.29008 7.21641 4.92527 7.69505 4.92527H10.1617C10.8787 4.92527 11.0284 4.78458 11.0284 4.11046V2.48083C11.0284 1.80671 10.8787 1.66602 10.1617 1.66602H7.69505C5.30182 1.66602 3.36172 3.49004 3.36172 5.74009V7.77713H1.62839Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
            </svg>
        </a>

        <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor" />
            </svg>
        </a>

        <a href="https://wa.me/?text=<?php echo $title . '%20' . $url; ?>" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 32 32" fill="currentColor">
                <path d="M16 2.4C8.6 2.4 2.6 8.4 2.6 15.8c0 2.7.7 5.3 2.1 7.6L2 30l6.8-2.6c2.2 1.2 4.7 1.9 7.2 1.9 7.4 0 13.4-6 13.4-13.4S23.4 2.4 16 2.4zm7.8 18.9c-.3.8-1.6 1.5-2.6 1.6-.7.1-1.5.2-4.8-1-4.2-1.6-6.9-5.6-7.1-5.9-.2-.3-1.7-2.3-1.7-4.4s1.1-3.1 1.5-3.5c.4-.4.9-.5 1.2-.5h.9c.3 0 .7-.1 1 .7.3.8 1.1 2.7 1.2 2.9.1.2.2.5 0 .8-.2.3-.3.5-.6.8-.3.3-.5.5-.8.8-.3.3-.6.6-.3 1.2.3.6 1.4 2.3 3 3.7 2.1 1.9 3.9 2.5 4.5 2.8.6.3 1 .3 1.3-.2.4-.5 1.5-1.8 1.9-2.4.4-.6.8-.5 1.3-.3.5.2 3.2 1.5 3.8 1.8.6.3.9.4 1 .6.1.2.1.9-.2 1.7z" />
            </svg>

        </a>

        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>" target="_blank">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">

                <!-- Outer Circle -->
                <circle cx="10" cy="10" r="8.5"
                    stroke="currentColor" stroke-width="1.5" />

                <!-- "in" text container -->
                <rect x="6" y="7.2" width="8" height="5.8" rx="1.2"
                    stroke="currentColor" stroke-width="1.4" />

                <!-- i dot -->
                <circle cx="7.9" cy="8.8" r="0.6"
                    fill="currentColor" />

                <!-- i line -->
                <path d="M7.9 10v2.2"
                    stroke="currentColor"
                    stroke-width="1.4"
                    stroke-linecap="round" />

                <!-- n shape -->
                <path d="M9.8 10v2.2
             M9.8 10c.6-.8 2.2-.8 2.2.6v1.6"
                    stroke="currentColor"
                    stroke-width="1.4"
                    stroke-linecap="round"
                    stroke-linejoin="round" />

            </svg>

        </a>







    </div>
</div>
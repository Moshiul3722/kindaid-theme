(function ($) {
  $(document).ready(function () {
    var wrapperSelector =
      typeof ThemeAudioAdmin !== "undefined" && ThemeAudioAdmin.metaboxWrapper
        ? ThemeAudioAdmin.metaboxWrapper
        : "#theme-audio-metabox-wrapper";

    function toggleAudioMetabox() {
      var format = null;

      // Gutenberg (Block Editor) - select element exists in modern WP
      if ($(".editor-post-format__selector").length) {
        format = $(".editor-post-format__selector").val();
      }
      // Classic Editor - formatdiv (older WP) or post-formats-select (some themes)
      else if ($('#formatdiv input[name="post_format"]').length) {
        format = $('#formatdiv input[name="post_format"]:checked').val();
      } else if ($('#post-formats-select input[name="post_format"]').length) {
        format = $(
          '#post-formats-select input[name="post_format"]:checked'
        ).val();
      }

      if (format === "audio") {
        $(wrapperSelector).show();
        $("#theme_audio_metabox").show();
      } else {
        $("#theme_audio_metabox").hide();
        // $(wrapperSelector).hide();
      }
    }

    // Initial run (delay a bit to allow WP load)
    setTimeout(toggleAudioMetabox, 250);

    // Classic editor change binding
    $(document).on(
      "change",
      '#formatdiv input[name="post_format"], #post-formats-select input[name="post_format"]',
      function () {
        toggleAudioMetabox();
      }
    );

    // Gutenberg change binding (dropdown)
    $(document).on("change", ".editor-post-format__selector", function () {
      toggleAudioMetabox();
    });

    // Also listen to clicks on post format labels (some setups)
    $(document).on(
      "click",
      "#formatdiv .post-format, #post-formats-select label",
      function () {
        setTimeout(toggleAudioMetabox, 50);
      }
    );
  });
})(jQuery);

jQuery(document).ready(function ($) {
  /* ------------------------------
   * 1. Post Format Conditional Show/Hide
   * ------------------------------ */
  function toggleGalleryMetabox() {
    var selected = $('#formatdiv input[name="post_format"]:checked').val();

    if (selected === "gallery") {
      $("#theme_gallery_metabox").show();
    } else {
      $("#theme_gallery_metabox").hide();
    }
  }

  $(document).ready(function () {
    // Initial load
    toggleGalleryMetabox();

    // On Change
    $(document).on(
      "change",
      '#formatdiv input[name="post_format"]',
      function () {
        toggleGalleryMetabox();
      }
    );
  });

  /* ------------------------------
   * 2. WordPress Media Uploader
   * ------------------------------ */

  let frame;

  $(".theme-add-image").click(function (e) {
    e.preventDefault();

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: "Select Images",
      button: { text: "Add Images" },
      multiple: true,
    });

    frame.on("select", function () {
      let selection = frame.state().get("selection");

      let ids = $("#theme-image-ids").val().split(",").filter(Boolean);

      selection.map(function (item) {
        let attachment = item.toJSON();

        ids.push(attachment.id);

        $("#theme-sortable-list").append(`
                    <li class="theme-item" data-id="${attachment.id}">
                        <img src="${attachment.sizes.thumbnail.url}">
                        <span class="theme-remove">&times;</span>
                    </li>
                `);
      });

      $("#theme-image-ids").val(ids.join(","));
    });

    frame.open();
  });

  /* ------------------------------
   * 3. Remove Image
   * ------------------------------ */

  $(document).on("click", ".theme-remove", function () {
    $(this).parent().remove();

    let ids = [];
    $("#theme-sortable-list .theme-item").each(function () {
      ids.push($(this).data("id"));
    });

    $("#theme-image-ids").val(ids.join(","));
  });

  /* ------------------------------
   * 4. Drag & Drop Sortable
   * ------------------------------ */

  $("#theme-sortable-list").sortable({
    update: function () {
      let ids = [];

      $("#theme-sortable-list .theme-item").each(function () {
        ids.push($(this).data("id"));
      });

      $("#theme-image-ids").val(ids.join(","));
    },
  });
});

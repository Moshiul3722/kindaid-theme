jQuery(document).ready(function ($) {
  // Toggle visibility based on post format
  function toggleVideoBox() {
    var format = $('#formatdiv input[name="post_format"]:checked').val();

    if (format === "video") {
      $("#video_metabox").show();
    } else {
      $("#video_metabox").hide();
    }
  }

  toggleVideoBox();

  $(document).on("change", '#formatdiv input[name="post_format"]', function () {
    toggleVideoBox();
  });

  // Video upload
  $("#uploadVideoBtn").on("click", function (e) {
    e.preventDefault();

    var frame = wp.media({
      title: "Select or Upload Video",
      button: { text: "Use this video" },
      library: { type: "video" },
      multiple: false,
    });

    frame.on("select", function () {
      var attachment = frame.state().get("selection").first().toJSON();
      $("#video_file").val(attachment.id);

      $("#video-upload-field").append(
        '<div style="margin-top:15px;">' +
          '<video width="400" controls><source src="' +
          attachment.url +
          '"></video>' +
          "</div>"
      );
    });

    frame.open();
  });
});

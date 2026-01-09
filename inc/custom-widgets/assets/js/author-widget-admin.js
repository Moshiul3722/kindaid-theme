(function ($) {
  // ❗ Remove old handlers ONCE
  $(document).off("click", ".add-item").off("click", ".remove-item");

  let maxItems = 1;

  $(document).on("input change", ".max-item-input", function () {
    let newLimit = parseInt($(this).val(), 10) || 0;
    maxItems = newLimit;
    // console.log(maxItems);
  });

  // Add Item
  $(document).on("click", ".repeater-wrapper .add-item", function (e) {
    e.preventDefault();

    let wrapper = $(this).closest(".repeater-wrapper");
    let container = wrapper.find(".repeater-items");
    let fieldName = wrapper.data("name");
    let index = container.find(".repeater-item").length;

    if (index >= maxItems) {
      wrapper.find(".limit-message").show();
      $(this).hide();
      return;
    }

    // Append repeater item
    container.append(`
      <div class="repeater-item">
        <input type="text" class="widefat"
          name="${fieldName}[${index}][icon]"
          placeholder="Icon (fontawesome)">

        <input type="text" class="widefat"
          name="${fieldName}[${index}][url]"
          placeholder="https://www.example.com">

        <button type="button" class="button remove-item">Remove</button>
      </div>
    `);
  });

  // ✅ Remove item
  $(document).on("click.AuthorWidget", ".remove-item", function () {
    let wrapper = $(this).closest(".repeater-wrapper");
    let itemCount = wrapper.find(".repeater-item").length;

    // যদি itemCount 1 এর চাইতে বেশি হয় তাহলে 1টি item ছাড়া সকল item remove হবে।
    if (itemCount > 1) {
      $(this).closest(".repeater-item").remove();
    }

    wrapper.find(".add-item").show();
    wrapper.find(".limit-message").hide();

    // 🔥 activate Save button after remove item
    wrapper.closest(".widget-content").find("input:first").trigger("change");
  });

  /*
   * This script for media file
   */

  let mediaFrame;
  // Select Image
  $(document).on("click", ".select-image", function (e) {
    e.preventDefault();

    let button = $(this);
    let img_wrapper = button.closest(".image-field-wrapper");
    let previewImg = img_wrapper.find("img.widget-image-preview");
    let input = img_wrapper.find(".widget-image-id");
    let removeBtn = img_wrapper.find(".remove-image");

    if (mediaFrame) {
      mediaFrame.open();
      return;
    }

    mediaFrame = wp.media({
      title: "Select Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    mediaFrame.on("select", function () {
      let attachment = mediaFrame.state().get("selection").first().toJSON();
      // console.log("form media----", attachment);

      previewImg.attr("src", attachment.url).show();
      input.val(attachment.id).trigger("change");

      button.text("Change Image");
      removeBtn.show();
    });

    mediaFrame.open();
  });

  // Remove Image
  $(document).on("click", ".remove-image", function (e) {
    e.preventDefault();

    let wrapper = $(this).closest("p");

    wrapper.find(".widget-image-preview").hide().attr("src", "");
    wrapper.find(".widget-image-id").val("");
    wrapper.find(".select-image").text("Select Image");

    $(this).hide();
  });
})(jQuery);

jQuery(document).ready(function ($) {
  let rowCount = 1;

  // নতুন রো যোগ করার ফাংশন
  $("#user-repeater-wrapper").on("click", ".add-row", function () {
    rowCount++;

    let newIndex = "new_" + rowCount;

    let row = `
      <div class="repeater-row" style="margin-bottom:5px; border-radius:4px; padding:10px; border:1px solid #ddd; background:#f9f9f9;">
          <div style="display:flex; gap:10px;">
              <input type="text"
                  name="current_user_repeater_text[${newIndex}][icon]"
                  placeholder="fa-brands fa-facebook-f"
                  class="regular-text">
              <input type="text"
                  name="current_user_repeater_text[${newIndex}][url]"
                  placeholder="www.facebook.com"
                  class="regular-text">
          </div>
          <button type="button" class="button button-small remove-row">Remove</button>
      </div>
    `;

    // Add Row বাটনের আগে নতুন রো যোগ করুন
    $(this).before(row);
  });

  // রো মুছে ফেলার ফাংশন
  $("#user-repeater-wrapper").on("click", ".remove-row", function () {
    // কমপক্ষে একটি রো থাকা নিশ্চিত করুন
    if ($("#user-repeater-wrapper .repeater-row").length > 1) {
      $(this).closest(".repeater-row").remove();
    } else {
      // যদি শুধুমাত্র একটি রো থাকে, শুধু এর ভ্যালু ক্লিয়ার করুন
      $(this).closest(".repeater-row").find("input").val("");
    }
  });

  // ফর্ম সাবমিট করার আগে সব খালি রো মুছে ফেলুন
  $("form#your-profile").on("submit", function () {
    // প্রতিটি রো চেক করুন
    $("#user-repeater-wrapper .repeater-row").each(function () {
      let $inputs = $(this).find("input");
      let isEmpty = true;

      // চেক করুন কোনো ফিল্ডে ভ্যালু আছে কিনা
      $inputs.each(function () {
        if ($(this).val().trim() !== "") {
          isEmpty = false;
        }
      });

      // যদি সব ফিল্ড খালি থাকে, রোটি মুছে ফেলুন
      if (isEmpty && $("#user-repeater-wrapper .repeater-row").length > 1) {
        $(this).remove();
      }
    });
  });
});

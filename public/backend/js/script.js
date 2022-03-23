const csrf_token = $("meta[name='_token']").attr("content");
$(document).ready(function () {
    //nav-bar
    

    // preview image upload
    $("input[data-role='preview-image']").on("change", function () {
        $("#preview-image").html("");

        if (this.files) {
            for (let i = 0; i < this.files.length; i++) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $("#preview-image").append('<img src="' + e.target.result +
                        '" alt="...">');
                }

                reader.readAsDataURL(this.files[i]); // convert to base64 string
            }
        }
    });

    $("[data-role=removeImage]").click(function () {
        $remove = $(this).children(".remove");
        $id = $(this).children("input");

        if ($remove.hasClass("active")) {
            $remove.removeClass("active");
            $id.attr("disabled", "true");
        } else {
            $remove.addClass("active");
            $id.removeAttr("disabled");
        }
    });


    $(".pagination").addClass('rounded-separated pagination-danger');
    $(".previous a").html('<i class="mdi mdi-chevron-left"></i>');
    $(".next a").html('<i class="mdi mdi-chevron-right"></i>');
});
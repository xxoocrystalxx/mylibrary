var $k = jQuery.noConflict();
$k(function () {
    $k("input.check").on("change", function () {
        alert("Rating: " + $k(this).val());
    }),
        $k(".book-details").each(function () {
            $k('<span class="badge bg-info"></span>')
                .text($k(this).val() || "")
                .insertAfter(this);
        }),
        $k(".book-details").on("change", function () {
            //  $k(this).next(".badge").text($k(this).val());
            var badge = $k(this);
            var book_id = $k("#book_id").val();
            var spinner = $k(".myspinner");
            $k(spinner).show();
            $k.ajax({
                type: "POST",
                url: "/store/rating/" + book_id,
                cache: false,
                data: {
                    rating: $k(this).val(),
                },
            })
                .done(function (data) {
                    $k(spinner).hide();
                    badge.next(".badge").text(badge.val());
                    $k(".review").show();
                    toastr.success("Rated Successfully!");
                })
                .fail(function (xhr, status, error) {
                    window.location.href = "/login";
                    toastr.error(error);
                })
                .always(function (data) {
                    $k(spinner).hide();
                });
        }),
        $k(".write-review").each(function () {
            $k('<span class="badge bg-info"></span>')
                .text($k(this).val() || "")
                .insertAfter(this);
        }),
        $k(".write-review").on("change", function () {
            $k(this).next(".badge").text($k(this).val());
        }),
        $k(".mylibrary").each(function () {
            $k('<span class="badge bg-info"></span>')
                .text($k(this).val() || "")
                .insertAfter(this);
            $k(this).on("change", function () {
                //  $k(this).next(".badge").text($k(this).val());
                var badge = $k(this);
                var nextSiblins = $k(this).nextUntil(".book_id");
                var book_id = nextSiblins[1].value;
                var spinner = nextSiblins[2];
                $k(spinner).show();
                $k.ajax({
                    type: "POST",
                    url: "/store/rating/" + book_id,
                    cache: false,
                    data: {
                        rating: $k(this).val(),
                    },
                })
                    .done(function (data) {
                        $k(spinner).hide();
                        badge.next(".badge").text(badge.val());
                        $k(".review").show();
                        toastr.success("Rated Successfully!");
                    })
                    .fail(function (xhr, status, error) {
                        window.location.href = "/login";
                        toastr.error(error);
                    })
                    .always(function (data) {
                        $k(spinner).hide();
                    });
            });
        });
});

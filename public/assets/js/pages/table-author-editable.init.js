var $k = jQuery.noConflict();
$k(function () {
    var e = {};

    $k(".table-author tr").editableTable({
        // var data = $('td[data-field="firstname"]', this).text();
        // dropdowns: { gender: ["Male", "Female", "other"] },
        edit: function (values) {
            console.log(values);
            $k(".edit i", this)
                .removeClass("fa-pencil-alt")
                .addClass("fa-save")
                .attr("title", "Save");
        },
        save: function (values) {
            var spinner = $k(".myspinner", this);
            var editbutton = $k(".edit", this);
            var id = $k(this).data("id");
            var deletebutton = $k(".btn-danger", this);

            $k(spinner).show();
            $k(editbutton).hide();
            $k(deletebutton).addClass("disabled");

            $k(".edit i", this)
                .removeClass("fa-save")
                .addClass("fa-pencil-alt")
                .attr("title", "Edit"),
                this in e && (e[this].destroy(), delete e[this]);

            $k.ajax({
                type: "POST",
                url: "/update/author/" + id,
                cache: false,
                data: {
                    name: values.name,
                    born: values.born,
                    // _token: token,
                },
            })
                .done(function (data) {
                    toastr.success("Author Updated Successfully!");
                })
                .fail(function (xhr, status, error) {
                    toastr.error(error);
                })
                .always(function (data) {
                    $k(spinner).hide();
                    $k(editbutton).show();
                    $k(deletebutton).removeClass("disabled");
                });
        },
        cancel: function (t) {
            $k(".edit i", this)
                .removeClass("fa-save")
                .addClass("fa-pencil-alt")
                .attr("title", "Edit"),
                this in e && (e[this].destroy(), delete e[this]);
        },
    });
});

// JavaScript Document
$(document).ready(function (e) {
    submitForm = function (that) {
        $that = $(that);
        var $thatForm = $that.parents("form");
        $($thatForm).one("submit", function (e) {
            e.preventDefault();
            $btnVal = $that.val();
            $that.attr({"disabled": "disabled"});
            $that.val("Please Wait...");
            fd = new FormData(this);
            $.ajax({
                url: "submit.php",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                mimeType: "multipart/form-data",
                dataType: "json",
                success: function (r) {
                    //alert(r);
                    $that.removeAttr("disabled");
                    $that.val($btnVal);
                    if (r.success) {                    
//                       alert(r.message);
                        $("div.modal-body").css({"background-color":"#006600"}).html(r.message).fadeIn();
                        $thatForm.trigger('reset');
//                        location.href = "";
                    }
                    else {                       
                      $("div.modal-body").css({"background-color":"#C80000"}).html(r.message).fadeIn();
//                    alert(r.message);
                    }
                },
                error: function (a, b, c) {
                    $that.removeAttr("disabled");
                    $that.val($btnVal);
                    alert("Ajax ERROR!!!\n"+a.responseText);
                }
            });
            return false;
        });
    }
    deleteMe = function (that, tableName, idKey, id) {
        if (!tableName || !idKey || !id) {
            alert("Delete parameter missed!");
            return;
        }
        if (confirm("Do you really want to delete?")) {
            $.ajax({
                url: "submit.php",
                type: "POST",
                data: ({"action": "delete", "table": tableName, "idKey": idKey, "id": id}),
                dataType: "json",
                success: function (r) {
                    //alert(r);
                    //alert(r.message);
                    if (r.success) {
                        $(that).parents("tr").fadeOut(1000);
                        //location.href="";
                    }
                },
                error: function () {
                    alert("Ajax error!!!");
                }
            });
        }
    }
});
$(document).ready(function() {
    $("#submit").click(function(event) {
        var nickName = words_cut($("#nickName").val(), 30);
        var trueName = words_cut($("#trueName").val(), 30);
        var towho = words_cut($("#towho").val(), 30);
        var email = words_cut($("#email").val(), 30);
        var emailType = $("#emailType").val();
        var contents = $("#contents").val();
        var gender = $("#genderType").val();
        var itsGender = $("#itsGenderType").val();
        if (email != "") {
            //拼接
            email += emailType;
        } else {
            email = "";
        }

        if (nickName != "" && trueName != "" && towho != "" && contents != "") {
            $("#Hint").text('');
            $.ajax({
                url: 'php/action.php',
                type: 'POST',
                dataType: 'html',
                data: {act: 'say', nickName:nickName, trueName:trueName, towho:towho, email:email, contents:contents, gender:gender, itsGender:itsGender}
            })
                .done(function(result) {
                    console.log("success");
                    console.log(result);
                    $("#hint").html('表白成功！');
                    $("#nickName").val('');
                    $("#trueName").val('');
                    $("#towho").val('');
                    $("#email").val('');
                    $("#contents").val('');
                    $("#Hint").html(result);
                    //提示
                    layer.open({
                        content: result
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function(result) {
                    console.log("complete");
                });
        } else {
            //提示
            layer.open({
                content: "请检查昵称、真名、TA的名字、内容是否填写！"
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            $("#hint").text("请检查昵称、真名、TA的名字、内容是否填写！").css('color', 'red').css('font-size', '16px');
        }
    });


});
function words_deal()
{
    var curLength=$("#contents").val().length;
    if(curLength>520)
    {
        var num=$("#contents").val().substr(0,520);
        $("contents").val(num);
    }
    else
    {
        $("#textCount").text(520-$("#contents").val().length);
    }
}

function words_cut(sentences, lengthCut) {
    if (sentences.length > lengthCut) {
        return sentences.substr(0,lengthCut);
    }else{
        return sentences;
    }
}


// 启用与关闭邮件通知
$("#switch").change(function(event) {
    console.log(event);
    console.log($(this));
});

$("#switch").click(function(event) {
    console.log($(this));
});

function openEmailNotice() {
    var status = $("#switch:checked").val();
    if (status == "on") {
        $("#email-box").css('display', 'block');
    }else{
        $("#email-box").css('display', 'none');
    }
}
$(document).ready(function () {
    //var ajaxurl = "controller/ajaxcontroller.php";
    function PageName(url) {
        var index = url.lastIndexOf("/") + 1;
        var filenameWithExtension = url.substr(index);
        var filename = filenameWithExtension.split(".")[0];
        return filename;
    }
    var currentpage = PageName(window.location.href);

    var getURLParameter = function (sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return decodeURIComponent(sParameterName[1]);
            }
        }
    };
    if (currentpage == "datainsert") {
//        $("#carrier-form").steps({
//            headerTag: "h3",
//            bodyTag: "section",
//            transitionEffect: "slideLeft",
//            autoFocus: true
//        });


         var form = $("#form").show();
            form.steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                onStepChanging: function (event, currentIndex, newIndex)
                {
//                     Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }
//                     Forbid next action on "Warning" step if the user is to young
//                     if (newIndex === 3 && Number($("#age-2").val()) < 18)
//                     {
//                         return false;
//                     }
//                     Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        form.find(".body:eq(" + newIndex + ") label.error").remove();
                        form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                    }
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },
                 onStepChanged: function (event, currentIndex, priorIndex)
                 {

//                     if (currentIndex === 2 && newIndex === 3)
//                     {
//                         form.steps("next");
//                     }
//
//                     if (currentIndex === 2 && priorIndex === 1)
//                     {
//                         form.steps("previous");
//                     }
                 },
                onFinishing: function (event, currentIndex)
                {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    alert("Submitted!");
                }
            }).validate({
                errorPlacement: function errorPlacement(error, element) { element.before(error); },
                rules: {
                    confirm: {
                        equalTo: "#pwd"
                    }
                }
            });




       


        //Add Images
        $("#pdf").fileinput({
            theme: "fa",
            allowedFileExtensions: ['pdf'],
            showUpload: false,
            showRemove: false,
            maxFileSize: 2048,
            browseClass: "btn btn-warning",
            dropZoneEnabled: true
        });
        
    }

    

$("#submit").on("click" , function(){
	var fname = $("input[name='fname']").val();
	var lname = $("input[name='lname']").val();
	
	var pwd = $("input[name='pwd']").val();
	var cpwd = $("input[name='cpwd']").val();
	var file = $("input[name='pdf']").val();
	var email = $("input[name='email']").val();
	var gender = $("#gender").val();
	if(pwd == cpwd){
	 $.post("controller/ajaxcontroller.php", {req_type: "datasubmit", fname: fname, lname: lname, pwd: pwd,
	 file:file,email:email,gender:gender},
                function (result) {
               alert(result);
                   
				})
	}
});

});
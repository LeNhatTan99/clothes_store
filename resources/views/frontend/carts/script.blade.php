<script type="text/javascript">
	jQuery.validator.addMethod('regexPassword', function (value, element, param) {
        var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
        if (value) {
            return regex.test(value);
        }
        return true;
    });
    jQuery.validator.addMethod("regexPhone" , function(value, element) {
        var regex = /^([0-9]{10,15})$/;
        return regex.test(value);
    });
    jQuery.validator.addMethod("requiredRadio", function(value, element){
        var radios = $("input[name='payment']")
        for (var i=0; i<radios.length; i++) {
        if (radios[i].checked) {
            return true;
        }
    }
    })
    $("input[name='payment']").on('click',function(){
       var test = $("input[name='payment']").parent()
        console.log(test)
    })
    $().ready(function() {
	$("#form-checkout").validate({
		rules: {
            "name": {
				required: true,
				maxlength: 255,
			},
			"email": {
				required: true,
				maxlength: 255,
                email:true
			},
            "phone_number": {
                required: true,
                minlength: 10,
                maxlength: 15,
                regexPhone: true,
            },
            "address": {
                required: true,
                maxlength: 150,
            },
            "payment": {
                requiredRadio: true
            }
		},
		messages: {
			"name": {
				required: "Tên không được để trống",
				maxlength: "Tên tối đa 255 ký tự"
			},
			"email": {
				required: "Email không được để trống",
				maxlength: "Email tối đa 255 ký tự",
				email: "Vui lòng nhập đúng định dạng email"
			},
            "phone_number" : {
                required: "Số điện thoại không được để trống",
                minlength: "Số điện thoại tối thiểu 10 ký tự",
                maxlength: "Số điện thoại tối đa 15 ký tự",
                regexPhone: "Vui lòng nhập đúng định dạng số điện thoại",
            },
			"address": {
				required: "Địa chỉ không được để trống",
				maxlength: "Địa chỉ tối đa 150 ký tự"
			},
            "payment": {
                requiredRadio: "Vui lòng chọn phương thức thanh toán"
            }
		},
        errorPlacement: function (error, element) {
            element.parent().after(error);
        }
	});
	});
</script>
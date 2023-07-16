<script type="text/javascript">
	jQuery.validator.addMethod('regexPassword', function (value, element, param) {
        var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
        if (value) {
            return regex.test(value);
        }
        return true;
    });
    jQuery.validator.addMethod("regexPhone" , function(value, element) {
		var regex = /^0([0-9]{9})$/;
        return regex.test(value);
    });

	jQuery.validator.addMethod('requiredRule', function(value) {
		return value != '';
	});

    $().ready(function() {
	$("#form").validate({
		rules: {
            "name": {
				required: true,
				maxlength: 255,
			},
			"email": {
				required: true,
				maxlength: 255,
				email
			},
            "phone_number": {
                required: true,
                minlength: 10,
                maxlength: 15,
                regexPhone: true,
            },
			"password": {
				required: true,
				minlength: 6,
				regexPassword: true
			},
            "address": {
                required: true,
                maxlength: 150,
            },
			"roleId": {
				requiredRule: true
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
			"password": {
				required: "Mật khẩu không được để trống",
				minlength: "Mật khẩu ít nhất 6 ký tự",
                regexPassword: "Mật khẩu phải có ít nhất 1 chữ hoa, chữ thường và 1 số"
			},
			"roleId": {
                requiredRule: "Vui lòng chọn vai trò"
			},
		},
	});
	});
</script>
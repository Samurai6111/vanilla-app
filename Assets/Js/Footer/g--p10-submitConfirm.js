$(function () {
	setTimeout(function () {
		targetbtn = $("#buttonType1");

		if (targetbtn) {
			targetbtn.attr("type", "button");

			targetbtn.on("click", function () {
				var result = window.confirm("送信しますか？");

				if (result) {
					$(this).attr("type", "submit");
					setTimeout(function () {
						$(this).trigger("click");
					}, 100);
				} else {
				}
			});
		}
	}, 100);
});

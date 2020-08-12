	let allinputjawaban = $('textarea');
	let finishbut = "#finish";
	let jumsol = <?php echo $_SESSION['jumsol'] ?>;
	let durasi = <?php echo $_SESSION['durasi'] ?>;
	function hide(aa){
			
		for (var i = 0; i < aa; i++) {
			let bg = "#sub-container-soal"+i;
			$(bg).hide();
		};
	}
	function show(aa){
			
		for (var i = 0; i < aa; i++) {
			let bg = "#sub-container-soal"+i;
			$(bg).show();
		};
	}
	hide(jumsol);
	// show(jumsol);
	$("#flag-container").hide();
	$(finishbut).hide();

	$(document).ready(function(){
		
		$.each(allinputjawaban, function(data){
			let dflag = "#flag"+data;
			$(dflag).width(13*($("#flag-container").width()/100));
			$(dflag).height(13*($("#flag-container").width()/100));
			$(dflag).css("margin", 1.9*($("#flag-container").width()/100));
			$(dflag).css("padding", 4*($("#flag-container").width()/100));

			let flag =  "#flag";
			$('textarea[name="jawaban'+data+'"]').keydown(function(){
					console.log(data);
			})
			$('textarea[name="jawaban'+data+'"]').focus(function(){
				$(flag+data).css("background-color","#c5d86d");
			})					
			$('textarea[name="jawaban'+data+'"]').blur(function(){
				if ($(this).val() === "" ){
					console.log(data+"kosong");
					$(flag+data).css("background-color","#092327");

				}else{
					console.log(data+"isi");
					$(flag+data).css("background-color","#e59500");

				}
			})
			$("#flag"+data).click(function(){
				let yu = "#sub-container-soal"+data;
				// console.log(yu);
				$("div[id^='sub-container-soal']:not("+yu+")").slideUp("100","swing");
				$("#sub-container-soal"+data).slideDown("100","swing");
			})

		})

		$('#ad').click(function(){
			// console.log(jumsol);
			// console.log(allinputjawaban.length);
			// show(jumsol);		
				$("#ad").hide();
				$("#sub-container-soal0").fadeIn();
				$(finishbut).show();
				$("#flag-container").show();


		});


	});
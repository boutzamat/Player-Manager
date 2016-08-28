(function ($) {
	$(function () {
		if ($("#tabs").length > 0) {
			$("#tabs").tabs();
		}
		
		if ($(".TSBCalendar").length > 0) {
			
			function getSlots(cid, dt, booking_id){
				$.ajax({
					type: "GET",
					data: {
						"id": cid,
						"booking_id": booking_id,
						"date": dt
					},
					url: "index.php?controller=AdminBookings&action=getSlots",
					success: function(data){
						$("#TSBC_Slots").html(data);
					}
				});
			}
			
			function getCalendar(id, m, y){
				$.ajax({
					type: "GET",
					data: {
						id: id,
						month: m,
						year: y
					},
					url: "index.php?controller=AdminCalendars&action=getCalendar",
					success: function(data){
						$(".TSBCalendar").eq(0).html(data);
					}
				});
			}
			
			function getPrices(calendar_id) {
				$.getJSON("index.php?controller=AdminBookings&action=getPrices", {"calendar_id": calendar_id}, function () {
					
				}).success(function (json) {
					switch (json.code) {
						case 200:
							$("#booking_total").val(json.price);
							$("#booking_deposit").val(json.deposit);
							$("#booking_tax").val(json.tax);
							break;
						case 101:
							//TODO
							break;
					}
				});
			}
						
			// Add "click", "mouseover" and "mouseout" event to rows
			$("tr.TSBC_Slot_Enabled").live("mouseover", function() {
				$(this).addClass('TSBC_Slot_Hover');
			}).live("mouseout", function() {
				$(this).removeClass('TSBC_Slot_Hover');
			}).live("click", function (e) {
				if (e.target.type !== 'radio') {
					handleClick.apply($(":input.TSBC_Slot", $(this)), [false]);
				}						
			});
			
			$("tr.TSBC_Slot_Enabled :input.TSBC_Slot").live("change", function (e) {
				$(this).parent().parent().addClass("TSBC_Handle");
				handleClick.apply($(this), [true]);
			});

			$(":input[name^='member_id']").live("change", function () {
				$.ajax({
					type: "GET",
					url: "index.php?controller=AdminMembers&action=getmember&" + $(":input[name^='member_id']").serialize(),
					dataType: "json",
					success: function (json) {
						switch (json.code) {
							case 200:								
								$("#customer_name").val(json.name);
								$("#customer_email").val(json.email);
								$("#customer_phone").val(json.phone);
								$("#customer_city").val(json.city);
								$("#customer_address").val(json.address);
								$("#customer_zip").val(json.zip);
								$('select#customer_country').selectedIndex = json.country;
								break;
							case 101:
								//TODO
								break;
						}
					}
				});	
			});
			
			function handleClick(isCheckbox) {
				var row = this.parent().parent(),
					isHandle = row.hasClass("TSBC_Handle");// Tells whether or not checkbox is clicked
				$("tr.TSBC_Slot_Enabled :input[name!='"+this.attr("name")+"']").attr("checked", false);
				if ((!this.is(":checked") && !isHandle) || (this.is(":checked") && isHandle)) {
					if (!isCheckbox) {
						this.attr("checked", true);
					}
					var post = $(":input.TSBC_Slot").serialize();
					Cart.add.apply(row, [post]);
				} 
				row.removeClass("TSBC_Handle");
			}
			
			// Add "click", "mouseover" and "mouseout" event to rows
			$("tr.TSBC_Slot_Cart").live("mouseover", function() {
				$(this).addClass('TSBC_Slot_Remove');
			}).live("mouseout", function() {
				$(this).removeClass('TSBC_Slot_Remove');
			}).live("click", function () {
				var timeslot = $("input.TSBC_Slot", $(this)).eq(0);
				timeslot.attr("checked", false);
				var obj = {};
				obj[timeslot.attr("name")] = timeslot.val();
				//Cart.remove.apply($(this), [obj, true, calendar_id]);
			});
			
			$(".TSBC_Slot_Qty").live("change", function () {
				var timeslot = $(this);
				
				var obj = {};
				obj[timeslot.attr("name")] = timeslot.val();
				Cart.update.apply($(this), [obj, true, calendar_id]);
			});

			$("a.TSBC_JS_Proceed").live("click", function (e) {
				if (e.preventDefault) {
					e.preventDefault();
				}
				Cart.basket();
				$("#boxBookingDetails").show();
			});
			$("a.TSBC_JS_Close").live("click", function (e) {
				if (e.preventDefault) {
					e.preventDefault();
				}
				$("#TSBC_Slots").html("");
			});
			
			var cid = $(".TSBCalendar").eq(0).attr("id").split("_")[1];
			
			$(".TSBCalendar .calendar, .TSBCalendar .calendarPast").live("click", function(){
				getSlots.apply(null, [cid, $(this).attr("axis"), $(":input[name='id']").val()]);
			}).live("mouseover", function(){
				$(".calendarTooltip", this).css("visibility", "visible");
			}).live("mouseout", function(){
				$(".calendarTooltip", this).css("visibility", "hidden");
			});
			
			var today = new Date(), m = today.getMonth() + 1, y = today.getFullYear();
			$(".TSBCalendar .calendarLinkMonth").live("click", function(e){
				e.preventDefault();
				var rel = $(this).attr("rel"), id = $(".TSBCalendar").attr("id");
				switch (rel.split("-")[0]) {
					case 'next':
						y = m + 1 > 12 ? y + 1 : y;
						m = m + 1 > 12 ? m + 1 - 12 : m + 1;
						break;
					case 'prev':
						y = m - 1 < 1 ? y - 1 : y;
						m = m - 1 < 1 ? m - 1 + 12 : m - 1;
						break;
				}
				getCalendar.apply(null, [id.split("_")[1], m, y]);
				$("#TSBC_Slots").html("");
			});
		}
	});
})(jQuery);
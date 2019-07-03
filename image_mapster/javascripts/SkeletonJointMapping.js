$(document).ready(function () {
	var num;
	var $jointlist, $joint_map, default_options, mapsterConfigured;
	
	//$toolTipList = $('#hidden_divs');
	$jointlist = $('#jointlist');
	$joint_map = $('#body_hand_foot_image');

	$(document).on("change", "#cabeca", function () {
            num = $(this).val();
		if (num > 0 && num <= 3) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.2;
			$joint_map.mapster('rebind', default_options);
                        $joint_map.mapster('set', false, $(".HEAD")[0].alt);
			$joint_map.mapster('set', true, $(".HEAD")[0].alt);
			console.log(default_options);
		} else if (num > 3 && num <= 5) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.4;
			$joint_map.mapster('rebind', default_options);
                        $joint_map.mapster('set', false, $(".HEAD")[0].alt);
                $joint_map.mapster('set', true, $(".HEAD")[0].alt);
		} else if (num > 5 && num <= 7) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.6;
			$joint_map.mapster('rebind', default_options);
                        $joint_map.mapster('set', false, $(".HEAD")[0].alt);
			$joint_map.mapster('set', true, $(".HEAD")[0].alt);
		} else if (num > 7 && num <= 10) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.9;
			$joint_map.mapster('rebind', default_options);
                        $joint_map.mapster('set', false, $(".HEAD")[0].alt);
			$joint_map.mapster('set', true, $(".HEAD")[0].alt);
		} else {
			$joint_map.mapster('set', false, $(".HEAD")[0].alt);
		}
                
	});
$(document).on("change", "#pescoco", function () {
    var num = $(this).val();
    
                if (num > 0 && num <= 3) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.2;
			$joint_map.mapster('rebind', default_options);
			$joint_map.mapster('set', false, $(".C-Spine")[0].alt);
                        $joint_map.mapster('set', true, $(".C-Spine")[0].alt);
			console.log(default_options);
		} else if (num > 3 && num <= 5) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.4;
			$joint_map.mapster('rebind', default_options);
			$joint_map.mapster('set', false, $(".C-Spine")[0].alt);
			$joint_map.mapster('set', true, $(".C-Spine")[0].alt);
		} else if (num > 5 && num <= 7) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.6;
			$joint_map.mapster('rebind', default_options);
			$joint_map.mapster('set', false, $(".C-Spine")[0].alt);
                        $joint_map.mapster('set', true, $(".C-Spine")[0].alt);
		} else if (num > 7 && num <= 10) {
			default_options.render_select.fillColor = 'FF0000';
			default_options.fillOpacity = 0.9;
			$joint_map.mapster('rebind', default_options);
                        $joint_map.mapster('set', false, $(".C-Spine")[0].alt);
			$joint_map.mapster('set', true, $(".C-Spine")[0].alt);
		} else {
			$joint_map.mapster('set', false, $(".C-Spine")[0].alt);
		}

});
	function getFullCheckBoxID(item) {

		var checkBoxName = item.attr('name');
		var checkBoxId = item.attr('id');
		var rheumType;

		if (checkBoxId.indexOf("_swol") >= 1) {
			rheumType = "_swol"
		} else if (checkBoxId.indexOf("_tend") >= 1) {
			rheumType = "_tend"
		}
		return checkBoxName + rheumType;
	}

	function setMapsterArea(selectedInputs, name) {
		selected = selectedInputs.length > 0;
		$joint_map.mapster('set', selected, name);
		console.log(name);
	}

	$(document).on("click", "area", function () {
		console.log($(this).attr('class'));
		if ($(this).hasClass("1")) {
			$(this).toggleClass("1");
			$joint_map.mapster('set', false, $(this)[0].alt);
		} else {
			$(this).toggleClass("1");
			$joint_map.mapster('set', true, $(this)[0].alt);
		}
	});


	function setToolTipCheckBoxEvent(data) {
		// Get the two checkboxes within the 
		var checkBoxes = data.toolTip.find('input');

		checkBoxes.each(function () {

			var span = $(this).parent().find('span');

			span.unbind('click').bind('click', function (e) {
				var chk = $(this).parent().find('input');
				var isChecked = chk.is(':checked');
				// want to do opposite of what the check box is
				// set the checkbox
				chk.attr('checked', !isChecked);
				doCheckBoxAreaAction(chk, !isChecked);
			});

			var ttName = $(this).attr('name');

			var checkBoxId = getFullCheckBoxID($(this));
			var listCheckbox = $jointlist.find('#jl_' + checkBoxId);

			if (listCheckbox.attr('name') == ttName) {
				$(this).attr('checked', listCheckbox.attr('checked'));
			}

			// return the list to mapster so it can bind to it
			return $(this).unbind('click').click(function (e) {
				var selected = $(this).is(':checked');
				doCheckBoxAreaAction($(this), selected);
			});
		});
	}

	function toolTipCloseOptions() {
		return ['area-mouseout', 'tooltip-click'];
	}

	function getToolTip(jointName) {
		return $('#' + jointName + '_divID');
	}

	function buildAreas() {
		var items = $('#jointMap').find('area');
		var areaArray = [];

		items.each(function () {

			var areaName = $(this).attr('joint');
			var fullName = $(this).attr('full');
			// areaArray.push({ key: areaName, toolTip: buildToolTipArea(areaName, fullName) });
		});
		return areaArray;
	}

	default_options = {
		
		fillOpacity: 0.5,
		render_highlight: {
			fillColor: '22ff00',
			stroke: true
		},
		render_select: {
			fillColor: 'FF0000',
			stroke: false
		},
		fadeInterval: 50,
		isSelectable: false,
		singleSelect: false,
		mapKey: 'joint',
		mapValue: 'full',
		listKey: 'name',
		listSelectedAttribute: 'checked',
		sortList: false,
		showToolTip: true,
		toolTipClose: toolTipCloseOptions,
		onShowToolTip: setToolTipCheckBoxEvent,
		areas: buildAreas()
	};

	$joint_map.mapster(default_options);
	$joint_map.mapster('resize',500,0,0);
	

});

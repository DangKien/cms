$(document).ready(function () {
	var menuData;

getId = function () {
	var idMax = 0;
	$('.dd-item').each(function () {
		idNew = parseInt($(this).attr('data-id'));
		if (idNew > idMax) {
			idMax = idNew;
		}
	}); 
	return idMax;
}

var itemId = parseInt(getId()) + 1;


// get data nestable
var updateOutput = function(e, target) {
    var list   = e.length ? e : $(e.target);
    if (window.JSON) {
        return list.nestable('serialize');
    } else {
        return {};
    }
}

//show detail
function showDetail() {
	$('.dd .title-item-menu a').on('mousedown', function (event) {event.preventDefault (); return false;});
}

// sort data menu
$('#nestable').nestable({group: 1}).on('change', function(e, target) {
	var list   = e.length ? e : $(e.target);
    if (list[0].id == 'nestable') {
    	menuData = updateOutput(e);
    }
	
});

// add category to nestable
$('#add-category').on('click', function () {

	let id = $.map($('input[name="category_id[]"]:checked'), function(c){
		addNode('category', c.value, c.labels[0].innerHTML);
	})
	let title = "";
});

$('#add-link').on('click', function () {
	addNode('link');
});

// delete detail menu
function deleteDetail () {
	$('.delete-menu-detail').on('click', function () {
		$(this).parents('.dd-item').remove();
		menuData = updateOutput($('#nestable').data('output', $('#nestable-output')));
		setMenuData();
	});
}
//change data
function changeNameDisplay() {	
	$('input[name*="name_display"]').on('keyup', function() {
		$(this).parents('.dd-item').data('title', $(this).val());
		$(this).parents('.dd-item').attr('data-title', $(this).val());
		$('#nestable').nestable({group: 1});
		setMenuData();
	});
} 

//set data nestable

function setMenuData () {
	menuData = updateOutput($('#nestable').data('output', $('#nestable-output')));
}

//add item menu
function addNode(key, id = "", title = "" ) {
	var type= "", link_url = "";
	
	switch (key){
		case 'category':
			type  = type_category;
			// id    = $('select[name*="menu-detail-category"]').val();
			// title = $('select[name*="menu-detail-category"]').children("option:selected").html();
			// title = title.replace(/&nbsp;&nbsp;/g, "").trim();
	        if (id == -1) {
	        	return false;
	        }
	        break;
	    case 'post':
	        break;
	    case 'link':
			type  = type_url;
			link_url  = $('input[name*="link_url"]').val() || "";
			title = $('input[name*="url_name"]').val() || "";
	        if (link_url == "") {
				return false;
	        }
	        // title = title.trim();
	        break;

	    default:
	} 
	var html = "";
	if (itemId == 1) {
		html = '<ol class="dd-list">';
	}
	html += '<li class="dd-item" data-id="' + itemId + '"  data-menu-id="' + id + '" data-type="' + type + '"data-title="' + title + '" data-link="'+ link_url +'">'+
	'<div class="dd-handle dd-bg dd-anim title-item-menu" data-toggle="collapse" href="#nesable-menu-' + itemId + '">'+
	'<span class="title-item">'+
	'' + title + ''+
	'</span>'+
	'<span class="control-item">'+
	'<span>'+ type +'</span>'+
	'<a href=""><i class="fa fa-lg fa-sort-down"></i></a>'+
	'</span>'+
	'</div>'+
	'<div class="panel-collapse collapse" id="nesable-menu-' + itemId + '">'+
	'<div class="panel-body">'+
	'<div class="form-group">'+
	'<label class="control-label">'+ title +'</label>'+
	'<input type="text" class="form-control" name="name_display">'+
	'</div>'+
	'<div>'+
	'<p><span> Url: </span>'+
	'<a href="" class="text-info">'+
	'' + title + ''+
	'</a>'+
	'</p>'+
	'</div>'+
	'</div>'+
	'<div class="panel-footer text-right">'+
	'<button class="btn btn-sm btn-danger delete-menu-detail" type="button">'+
	' Delete</button>'+
	'</div>'+
	'</div>'+
	'</li>';
	if (itemId == 1) {
		html += "</ol>";
		$("#nestable").append(html);
	} else {
		$("#nestable > ol").append(html);
	}
    
    itemId++;
    showDetail();
    deleteDetail();
    changeNameDisplay();
    setMenuData();
}

showDetail();
deleteDetail();
changeNameDisplay();
setMenuData();

//save data menu
$('.btn-save-menu').click(function () {
	$.ajax({
		headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: SiteUrl + "/rest/admin/menu/update-detail/" + data_menu_id,
		data:JSON.stringify( {
		       'data': menuData,
		       'locale': $('select[name*="menu-locale"]').val(),
		       'menu_location': $('select[name*="menu_location"]').val()
		    }),
		contentType: false,
		processData: false,
		type: 'POST',
		dataType: 'json',
		contentType: 'application/json',
	}).done(function(resp) {
	  var heading   = headingNotifi.success;
	  var text      = messageNotifi.success;
	  var position  = position || 'top-right';
	  var loaderBg  = '#c6ede0';
	  var icon      = 'success';
	  var hideAfter = 3000;
	  var stack     = 1;
	  $.toast({ heading: heading,
	            text: text,
	            position: position,
	            loaderBg: loaderBg, 
	            icon: icon, 
	            hideAfter: hideAfter,
	            stack: stack,
	        });
	}).fail(function (error) {
	    var heading   = headingNotifi.failue;
        var text      = messageNotifi.failue;
        var position  = position || 'top-right';
        var loaderBg  = '#fcd8dc';
        var bgColor   = '#fcd8dc';
        var icon      = 'error';
        var hideAfter = 3000;
        var stack     = 1;
        console.log(text)
        $.toast({ heading: heading,
                  text: text,
                  position: position,
                  loaderBg: loaderBg, 
                  icon: icon, 
                  hideAfter: hideAfter,
                  stack: stack,
              });
	});;
});
})
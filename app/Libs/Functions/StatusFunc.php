<?php

	function statusAvailable($status) {
		if ($status ==  App\Libs\Configs\StatusConfig::CONST_AVAILABLE) {
			return true;
		} 
		return false;
	}

	function statusDisable($status) {
		if ($status ==  App\Libs\Configs\StatusConfig::CONST_DISABLE) {
			return true;
		} 
		return false;
	}

    // categories là list, parent_id là id cha, char: ki tu, selected là chon no, cate
	function showCategories($categories, $parent_id = 0, $char = '  ', $selected = 0, $category_id = -1) {
	    foreach ($categories as $key => $item) {
	    	if ($item->parent_id == $parent_id && $item->parent_id != $category_id && $category_id != $item->id) {
	    		if ($selected == $item->id) {
					echo '<option selected = "selected" value="'.$item->id.'">';
			        echo $char ." ". $item->name ." ". $char;
			        echo '</option>';

			        unset($categories[$key]);
	    		} else {
					echo '<option value="'.$item->id.'">';
			        echo $char ." ". $item->name ." ". $char;
			        echo '</option>';

			        unset($categories[$key]);
	    		}
	    		showCategories($categories, $item->id, $char.$char, $selected, $category_id);
	    	}
	    }
	}

	// sort 
	function _updateSortBy ($model, $sortByNew, $sortByOld) {
        $sortMax   = $model::max('sort_by');
        if ($sortMax + 1 != $sortByNew && $sortByOld != $sortByNew) {
            if ($sortByOld == -1) {
                //Insert sort by new
                $listSortUp = $model->select('id', 'sort_by')->where('sort_by', ">=" , (int) $sortByNew)->get();

                foreach ($listSortUp as $key => $sort) {
                    $dataSortUp          = $model->findOrFail($sort->id);
                    $sortOld             = $sort->sort_by;
                    $dataSortUp->sort_by = $sortOld + 1;
                    $dataSortUp->save();
                }
            } else {
                //Update sort by old
                if ($sortByNew > $sortByOld) {
                    // Ex: 1 -> 4 down 2 to 4 one time.
                    $listSortDown = $model->select('id', 'sort_by')->whereBetween('sort_by', [$sortByOld + 1, $sortByNew])->get();
                    foreach ($listSortDown as $key => $sort ) {
                        $dataSortUp          = $model->findOrFail($sort->id);
                        $sortOld             = $sort->sort_by;
                        $dataSortUp->sort_by = $sortOld - 1;
                        $dataSortUp->save();
                    }
                }
                else {
                    // Ex: 6 -> 3 up 5 to 3 on time
                    $listSortDown = $model->select('id', 'sort_by')->whereBetween('sort_by', [$sortByNew, $sortByOld - 1])->get();
                    foreach ($listSortDown as $key => $sort ) {
                        $dataSortUp          = $model->findOrFail($sort->id);
                        $sortOld             = $sort->sort_by;
                        $dataSortUp->sort_by = $sortOld + 1;
                        $dataSortUp->save();
                    }
                }
            }
            return $listSortDown;
        }         
    }

    function showCategoriesNew($categories, $parent_id = 0, $char = ' -- ', $selecteds) {
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                $check = false;
                foreach ($selecteds as $selected) {
                    if ($selected == $item->id ) {
                        $check = true;
                        break;
                    } 
                }
                if ($check) {
                    echo '<option selected = "selected" value="'.$item->id.'">';
                    echo $char ." ". $item->name ." ". $char;
                    echo '</option>';
                    unset($categories[$key]);
                } else {
                    echo '<option value="'.$item->id.'">';
                    echo $char ." ". $item->name ." ". $char;
                    echo '</option>';

                    unset($categories[$key]);
                }
                showCategoriesNew($categories, $item->id, $char.' -- ', $selecteds);
            }
        }
    }


    function showCategoriesMenu($categories, $parent_id = 0, $char = '  ') {
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                echo    '<div class="checkbox mt-10">'
                        .$char.' <input id="category-checkbox-'.$item->id.'" class="magic-checkbox" type="checkbox" title="'.$item->name.'" name="category_id[]" value="'.$item->id.'">
                                <label for="category-checkbox-'.$item->id.'">'.$item->name.'</label>
                        </div>';
                showCategoriesMenu($categories, $item->id, $char.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }
    }



    function showItemMenu($menus = array()) {
        if (!empty($menus)) {
            echo '<ol class="dd-list">';
                foreach ($menus as $key => $menu) {
                    if (@$menu->type == "Category")
                        $control = trans("backend.menu.controls.category");
                    else if(@$menu->type == "Post")
                        $control = trans("backend.menu.controls.post");
                    else if(@$menu->type == "Url")
                        $control = trans("backend.menu.controls.url");

                    echo '<li class="dd-item" data-id="'.@$menu->id. '" data-menu-id="'.@$detail->menuId.'"'.
                        'data-link="'.@$menu->link.'" data-type="'.@$menu->type.'" data-title="'.@$menu->title.'">'.
                        '<div class="dd-handle dd-bg dd-anim title-item-menu" data-toggle="collapse" href="#nesable-menu-'.@$menu->id.'">'
                            .'<span class="title-item">'
                                .@$menu->title.
                            '</span>
                            <span class="control-item">
                                <span>'. 
                                $control
                                .'</span>
                                <a href=""><i class="fa fa-lg fa-sort-down"></i></a>
                            </span>
                        </div>'.
                        '<div class="panel-collapse collapse" id="nesable-menu-'.@$menu->id.'">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label">'.trans("backend.menu.name_display").'</label>
                                    <input type="text" name="name_display" class="form-control">
                                </div>
                                <div>
                                    <p><span>'.trans('backend.menu.link') .': </span>
                                        <a href="" class="text-info">'
                                            .@$menu->title.
                                        '</a>
                                    </p>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button class="btn btn-sm btn-danger delete-menu-detail" type="button">'
                                .trans("backend.actions.delete").'</button>
                            </div>
                        </div>';
                        showItemMenu(@$menu->children ? $menu->children : array());
                echo '</li>';
            }
            echo '</ol>';
        }
    }

    function showMenuTop($menus = array()) {
        if (!empty($menus)) {
            foreach ($menus as $key => $menu) {
                if (empty(@$menu->children)) {
                    echo '<li class="menu-active">
                            <a href="index.html">
                                '.@$menu->title.'
                            </a>';
                    echo '</li>';
                } else {
                    echo '<li class="menu-has-children">
                            <a href="">'.@$menu->title.'</a>
                            <ul>';
                    showMenuTop(@$menu->children ? $menu->children : array());  
                    echo '</ul>
                    </li>';
                }
                
            }
        }
    } 


    function words ($value, $words = 100, $end = '...')
    {
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
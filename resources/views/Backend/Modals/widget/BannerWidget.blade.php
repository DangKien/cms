<div class="widget" data-id="@{{ item.data.id }}" data-name="@{{ item.data.name }}" data-category="" data-key="@{{ item.key }}" >
    <span class="list-group-item widget-item">@{{ item.key }}</span>
    <a data-toggle="collapse" href="#widget-center-item-@{{ key }}" class="widget-icon" href=""><i class="fa fa-lg fa-sort-down"></i></a> 
</div>
<div class="panel-collapse collapse widget-border" id="widget-center-item-@{{ key }}">
    <div class="panel-body"> 
        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.name_display") }}: </label>
            <input type="text" name="name_display" class="form-control">
        </div>
        <div>
            <p><span> {{ trans('backend.menu.link') }}: </span>
                <a href="" class="text-info">
                    title
                </a>
            </p>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-sm btn-danger delete-menu-detail" type="button">{{
        trans("backend.actions.delete") }} </button>
    </div>
</div>
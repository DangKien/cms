<div class="widget" data-id="@{{ infoWidget.data.id }}" data-name="@{{ infoWidget.data.name }}" data-category="" data-key="@{{ infoWidget.key }}" >
    <span class="list-group-item widget-item">@{{ infoWidget.data.name }}</span>
    <a data-toggle="collapse" href="#widget-center-item-@{{ infoWidget.id }}" class="widget-icon" href=""><i class="fa fa-lg fa-sort-down"></i></a> 
</div>
<div class="panel-collapse collapse widget-border" id="widget-center-item-@{{ infoWidget.id }}">
    <div class="panel-body"> 
        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.name_display") }}: </label>
            <input type="text" ng-model="infoWidget.data.name" name="name_display" class="form-control">
        </div>

        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.post") }}:</label>

            
        </div>

        <div>
            <p>
                <span> {{ trans('backend.menu.link') }}: </span>
                <a href="" class="text-info">
                    @{{ infoWidget.data.name }}
                </a>
            </p>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-sm btn-danger delete-menu-detail" type="button">{{
        trans("backend.actions.delete") }} </button>
        <button class="btn btn-sm btn-primary delete-menu-detail" type="button" ng-click="actions.updateWidget()">{{
        trans("backend.actions.save") }} </button>
    </div>
</div>
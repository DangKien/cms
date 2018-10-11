<div class="widget" data-id="@{{ infoWidget.data.id }}" data-name="@{{ infoWidget.data.name }}" data-category="" data-key="@{{ infoWidget.key }}" >
    <span class="list-group-item widget-item">@{{ infoWidget.data.name }}</span>
    <a data-toggle="collapse" href="#widget-center-item-@{{ infoWidget.data.id }}" class="widget-icon" href=""><i class="fa fa-lg fa-sort-down"></i></a> 
</div>
<div class="panel-collapse collapse widget-border" id="widget-center-item-@{{ infoWidget.data.id }}">
    <div class="panel-body"> 
        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.name_display") }}: </label>
            <input type="text" class="form-control" ng-model="infoWidget.data.name">
        </div>

        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.url_video") }}: </label>
            <textarea rows="5" type="text" class="form-control" ng-model="infoWidget.data.url_video"></textarea>
        </div>

    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-sm btn-danger delete-menu-detail" type="button">{{
        trans("backend.actions.delete") }} </button>
         <button class="btn btn-sm btn-primary delete-menu-detail" type="button" ng-click="actions.updateWidget()">{{
        trans("backend.actions.save") }} </button>
    </div>
</div>
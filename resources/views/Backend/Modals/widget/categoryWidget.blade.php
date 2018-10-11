<div class="widget" data-id="@{{ infoWidget.id }}" data-name="@{{ infoWidget.data.name }}" data-category="" data-key="@{{ infoWidget.key }}" >
    <span class="list-group-item widget-item">@{{ infoWidget.data.name }}</span>
    <a data-toggle="collapse" href="#widget-center-item-@{{ infoWidget.id }}" class="widget-icon" href=""><i class="fa fa-lg fa-sort-down"></i></a> 
</div>
<div class="panel-collapse collapse widget-border" id="widget-center-item-@{{ infoWidget.id }}">
    <div class="panel-body"> 

        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.name_display") }}: </label>
            <input type="text" name="name_display" class="form-control" ng-model="infoWidget.data.name">
        </div>

        <div class="form-group">
            <label class="control-label">{{ trans("backend.menu.category") }}:</label>

            <select class="selectpicker" data-live-search="true" data-width="100%" name="category_id" ng-model="infoWidget.data.id" ng-data="listCategories">
                <option value="">-- None --</option>
                <option ng-repeat="(key, category) in listCategories" value="@{{ category.id }}" 
                ng-selected="(category.id == infoWidget.data.id)"> @{{ category.name }}</option>
            </select>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <input type="radio" ng-model="infoWidget.data.cate_widget" value="1" ng-checked="(infoWidget.data.cate_widget == 1)">
                            Option 1
                        </label>
                        <img src="{{ url('Nifty/img/logo.png') }}" alt="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <input type="radio" ng-model="infoWidget.data.cate_widget" value="2" ng-checked="(infoWidget.data.cate_widget == 2)">
                            Option 2
                        </label>
                        <img src="{{ url('Nifty/img/logo.png') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <input type="radio" ng-model="infoWidget.data.cate_widget" value="3" ng-checked="(infoWidget.data.cate_widget == 3)">
                            Option 3
                        </label>
                        <img src="{{ url('Nifty/img/logo.png') }}" alt="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="radio">
                        <label>
                            <input type="radio" ng-model="infoWidget.data.cate_widget" value="4" ng-checked="(infoWidget.data.cate_widget == 4)">
                            Option 4
                        </label>
                        <img src="{{ url('Nifty/img/logo.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-sm btn-danger delete-menu-detail" type="button">{{
        trans("backend.actions.delete") }} </button>
        <button class="btn btn-sm btn-primary delete-menu-detail" type="button" ng-click="actions.updateWidget()">{{
        trans("backend.actions.save") }} </button>
    </div>
</div>
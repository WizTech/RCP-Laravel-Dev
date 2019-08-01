/**
 * Developed by Usama Bin Ishtiaque.
 * Email: ishtiaq@wiztech.pk
 * Autour: Usama Bin Ishtiaque
 * Date: 12/28/2015
 * Time: 10:49 AM
 */
$.prototype.addRemoveListItems = function (opt) {
    var $this = this;
    $this.ele = [];
    $this.options = [];
    $this.data = [];
    $this.addSuccess = function () {return true;};
    $this.pluginPrefix = 'wizplug-list-item';

    if(typeof $this.instanceNumber == 'undefined'){
        $this.instanceNumber = 1;
    } else {
        $this.instanceNumber++;
    }
    console.log($this.options.data)
    return new function () {
        $this.setOptions = function (o) {
            var options = [];
            for (var i in o) {
                options[i] = o[i];
            }
            $this.options = options;

            if(typeof $this.options.addSuccess == 'function'){
                $this.addSuccess = $this.options.addSuccess;
            }
        };
        $this.setContent = function () {
            var fieldClass = 'wizplug-input-field';
            if(typeof $this.options.fieldClass != 'undefined'){
                fieldClass = $this.options.fieldClass;
            }
            var fieldPlaceHolder = 'wizplug-field-placeholder';
            if(typeof $this.options.fieldPlaceHolder != 'undefined'){
                fieldPlaceHolder = $this.options.fieldPlaceHolder;
            }
            $this.ele.html('').append('<div style="margin-bottom:10px;" class="'+$this.pluginPrefix+'-container"><input data-input-field style="width:75%;" id="'+$this.pluginPrefix+'-field-'+$this.instanceNumber+'" placeholder="'+fieldPlaceHolder+'" type="text" class="'+fieldClass+' '+$this.pluginPrefix+'-field"><button data-button-action="add" style="width:21%;" class="btn green" type="button">Add</button></div><div class="" style="border: 1px solid #ccc;min-height: 150px;"><ul data-list-ul></ul></div>');
        };
        $this.setData = function () {

            if(typeof $this.options.data == 'object'){

                $this.data = $this.options.data;
                $this.updateData();
            }
        };
        $this.updateData = function () {
            var container = $this.ele.find('[data-list-ul]');
            container.html('');
            var template = '<li data-list-id="{{id}}">{{index}}. {{value}} <button class="btn red" data-remove-button type="button" style="padding: 1px 3px;font-size: 10px;line-height: 1;">X</button></li>';
            var index = 0;
            for(var id in $this.data){
                index++;
                var data = $this.data[id];
                var content = template;
                content = content.replace(new RegExp('{{id}}','g'),id);
                content = content.replace(new RegExp('{{value}}','g'),data);
                content = content.replace(new RegExp('{{index}}','g'),index);
                container.append(content);
                $this.listingEvents(container.find('[data-list-id="'+id+'"]'),id);
            }
        };
        $this.listingEvents = function (ele,i) {
            ele.find('[data-remove-button]').click(function () {
                if(confirm("Are You Sure?")){
                    var nonDeleted = [];
                    for( var ind in $this.data){
                        if(ind != i){
                            nonDeleted.push($this.data[ind]);
                        }
                    }
                    $this.data= nonDeleted;
                    ele.remove();
                    $this.updateData();
                    $this.addSuccess($this.data);
                }
            });
        };
        $this.globalFunc = function () {
            $this.ele.find('[data-button-action="add"]').on('click', function () {
                var val = $this.ele.find('[data-input-field]').val();
                if(val != ''){
                    $this.ele.find('[data-input-field]').val('');
                    $this.data.push(val);
                    $this.updateData();
                    $this.addSuccess($this.data);
                } else {
                    $this.ele.find('[data-input-field]').focus();
                }
            });
            $this.ele.find('[data-input-field]').on('keyup', function (e) {
                var code = e.keyCode || e.which;
                if(code == 13){
                    e.preventDefault();
                    var val = $this.ele.find('[data-input-field]').val();
                    $this.ele.find('[data-input-field]').val('');
                    $this.data.push(val);
                    $this.updateData();
                    $this.addSuccess($this.data);
                }
            });
            $this.ele.find('[data-input-field]').on('keypress', function (e) {
                var code = e.keyCode || e.which;
                if(code == 13){
                    e.preventDefault();
                }
            });
        };
        $this.init = function (opt) {
            var ele = $($this);
            $this.ele = ele;
            if($this.ele.length != 0){
                $this.setOptions(opt);
                $this.setContent();
                $this.globalFunc();
                $this.setData();
            }
        };
        $this.init(opt);
    }();
};
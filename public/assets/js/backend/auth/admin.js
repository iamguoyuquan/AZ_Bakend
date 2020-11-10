define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'auth/admin/index',
                    add_url: 'auth/admin/add',
                    edit_url: 'auth/admin/edit',
                    del_url: 'auth/admin/del',
                    multi_url: 'auth/admin/multi',
                }
            });

            var table = $("#table");
            //在表格内容渲染完成后回调的事件
            table.on('post-body.bs.table', function (e, json) {
                $("tbody tr[data-index]", this).each(function () {
                    if (parseInt($("td:eq(1)", this).text()) == Config.admin.id) {
                        $("input[type=checkbox]", this).prop("disabled", true);
                    }
                });
            });

            // 初始化表格
            debugger
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                columns: [
                    [
                        {field: 'state', checkbox: true, },
                        {field: 'id', title: 'ID'},
                        {field: 'username', title: __('Username')},
                        {field: 'nickname', title: __('Nickname')},
                        // {field: 'groups', title: __('Group'), visible:false, formatter: Table.api.formatter.search, searchList: Config.groupList},
                        {field: 'groups_text', title: __('Group'), operate:false, formatter: Table.api.formatter.label},
                        {field: 'email', title: '手机'},
                        {field: 'status', title: __("Status"), operate:false, formatter: Table.api.formatter.status},
                        {field: 'logintime', title: __('Login time'),formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'operate', title: __('Operate'), table: table,
                            events: Table.api.events.operate,
                            buttons: [{
                                    name: 'detail',
                                    text: __('Detail'),
                                    icon: 'fa fa-list',
                                    classname: 'btn btn-info btn-xs btn-detail btn-dialog',
                                    url: 'doctor/edit/admin_id/{id}/mobile/{email}'
                                }],
                                formatter: function (value, row, index) {
                                    if(row.id == Config.admin.id){
                                        return '';
                                    }
                                    return Table.api.formatter.operate.call(this, value, row, index);
                                }
                        }
                    ]
                ],
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Form.api.bindevent($("form[role=form]"));

            $('#group').on("change",function(){
                if($(this).val() !=  $('#doctor_groupid').val()){
                    $('#assistant_id').parents('.form-group').addClass('hidden')
                }else{
                    $('#assistant_id').parents('.form-group').removeClass('hidden')
                }
            })
            $('#group').change();
        },
        edit: function () {
            Form.api.bindevent($("form[role=form]"));
            $('#group').on("change",function(){
                if($(this).val() !=  $('#doctor_groupid').val()){
                    $('#assistant_id').parents('.form-group').addClass('hidden')
                }else{
                    $('#assistant_id').parents('.form-group').removeClass('hidden')
                }
            })
            $('#group').change();
        }
    };
    return Controller;
});
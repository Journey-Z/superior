@extends('admin.layouts.default')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="page-header">
                <h1>分类数据</h1>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">分类树</h3>
                        </div>
                        <div class="panel-body">
                            <div class="portlet-body">
                                <div id="tree"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script type="text/javascript">
        var categories = {!! json_encode($tree_data) !!};
        var tree = $("#tree");
        tree.jstree({
            'core': {
                'data': categories
            },
            'contextmenu': {
                'items': function (node) {
                    console.log(node);
                    return {
                        "open_link": {
                            'label': "编辑分类",
                            'action': function () {
                                window.open(node.a_attr.href, '_blank');
                            }
                        },
                        "add_sub": {
                            'label': "添加子分类",
                            'action': function () {
                                window.open("/admin/create/category" + "?parent_id=" + node.id);
                            }
                        },
                        "choose_products": {
                            'label': "添加商品",
                            'action': function () {
                                window.open("{{route('choose_products')}}" + "?category_id=" + node.id );
                            }
                        },
                        "chosen_products": {
                            'label': "已添加商品",
                            'action': function () {
                                window.open("{{route('chosen_products')}}" + "?category_id=" + node.id );
                            }
                        }
                    }
                }
            },
            'plugins': ["contextmenu"]
        });
    </script>
@endsection
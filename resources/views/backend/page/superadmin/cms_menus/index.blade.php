@extends('backend.layout.template')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Order menu</h5>
                    <span id="menu-saved-info"></span>
                </div>
                <div class="card-body">
                    @if(count($menu))
                        <ul class='draggable-menu draggable-menu-active'>
                            @foreach($menu as $row)
                                <li data-id="{{$row->id}}" data-name="{{$row->name}}">
                                    <div class=''>
                                        @if($row->icon!='-')
                                            <i class="{{$row->icon}}"></i>
                                        @endif
                                        <span class="ml-2">{{$row->name}}</span>
                                    </div>
                                    <ul>
                                        @if(count($row->sub_menu))
                                            @foreach($row->sub_menu as $sub)
                                                <li data-id="{{$sub->id}}" data-name="{{$sub->name}}">
                                                    <div>
                                                        <span>{{$sub->name}}</span>
                                                        <span class='pull-right'>
                                                      <a title='Edit' href="{{mainpath('edit/'.$sub->id)}}"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                                                      <a title="Delete" href='javascript:void(0)'><i class="icon-trash"></i></a>
                                                    </span>
                                                        <br/>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div align="center">Active menu is empty, please add new menu</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <form action="{{mainpath('add')}}" method="POST" enctype="multipart/form-data" class="form-validate">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{($edit)?$edit->id:''}}">
                    <input type="hidden" name="sorting" value="{{($edit)?$edit->sorting:''}}">
                    <div class="card-header">
                        <h5>Add menu</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Menu Name</label>
                            <input type="text" class="form-control" value="{{($edit)?$edit->name:old('name')}}" name="name" placeholder="Menu Name ...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Path Name</label>
                            <input type="text" class="form-control" value="{{($edit)?$edit->path:old('path')}}" name="path" placeholder="Path Name ...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Icon</label>
                            <input type="text" class="form-control" value="{{($edit)?$edit->icon:old('icon')}}" name="icon" placeholder="Icon ...">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn  btn-success btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('top')
        <style type="text/css">
            body.dragging, body.dragging * {
                cursor: move !important;
            }

            .dragged {
                position: absolute;
                opacity: 0.7;
                z-index: 2000;
            }

            .draggable-menu {
                padding: 0 0 0 0;
                margin: 0 0 0 0;
            }

            .draggable-menu li ul {
                margin-top: 6px;
            }

            .draggable-menu li div {
                padding: 11px 11px;
                border: 1px solid #cccccc;
                background: #eeeeee;
                cursor: move;
            }

            .draggable-menu li .is-dashboard {
                background: #fff6e0;
            }

            .draggable-menu li .icon-is-dashboard {
                color: #ffb600;
            }

            .draggable-menu li {
                list-style-type: none;
                margin-bottom: 4px;
                min-height: 35px;
            }

            .draggable-menu li.placeholder {
                position: relative;
                border: 1px dashed #b7042c;
                background: #ffffff;
                /** More li styles **/
            }

            .draggable-menu li.placeholder:before {
                position: absolute;
                /** Define arrowhead **/
            }
        </style>
    @endpush
    @push('bottom')
        <script>
            $(function () {
                var id_cms_privileges = '1';
                var sortactive = $(".draggable-menu").sortable({
                    group: '.draggable-menu',
                    delay: 200,
                    isValidTarget: function ($item, container) {
                        var depth = 1, // Start with a depth of one (the element itself)
                            maxDepth = 2,
                            children = $item.find('ul').first().find('li');

                        // Add the amount of parents to the depth
                        depth += container.el.parents('ul').length;

                        // Increment the depth for each time a child
                        while (children.length) {
                            depth++;
                            children = children.find('ul').first().find('li');
                        }

                        return depth <= maxDepth;
                    },
                    onDrop: function ($item, container, _super) {

                        if ($item.parents('ul').hasClass('draggable-menu-active')) {
                            var isActive = 1;
                            var data = $('.draggable-menu-active').sortable("serialize").get();
                            var jsonString = JSON.stringify(data, null, ' ');
                        } else {
                            var isActive = 0;
                            var data = $('.draggable-menu-inactive').sortable("serialize").get();
                            var jsonString = JSON.stringify(data, null, ' ');
                            $('#inactive_text').remove();
                        }

                        $.post(`{{mainpath('save-menu')}}`,
                            {
                                menus: jsonString, isActive: isActive,
                                _token : '{{csrf_token()}}'
                            }
                            , function (resp) {
                                $('#menu-saved-info').fadeIn('fast').delay(1000).fadeOut('fast').html(resp.message);
                            });

                        _super($item, container);
                    }
                });


            });
        </script>
    @endpush
@endsection

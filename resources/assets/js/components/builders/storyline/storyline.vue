<template>
    <div class="main">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Toolbox</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <draggable :list="toolbox" :options="{group:{ name:'tools',  pull:'clone', put:false}, handle: '.handle' }">
                            <div class="media" v-for="tool in toolbox" @dragstart="current_item(tool)" @dragend="remove_tool(tool)">
                                <div class="media-left">
                                    <span class="media-object">
                                        <span :class="tool.icon"></span>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ tool.name }} <i class="fa fa-arrows-alt pull-right handle"></i></h4>
                                </div>
                            </div>
                        </draggable>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10" @drop="dropped">
            <groups :parts="parts" :current_tool="current_tool" :cg="current_group" @update="upd" @updateGroups="updg"></groups>
        </div>
        <div class="clearfix"></div>
    </div>
</template>

<style>
    .main {
        --dragndrop-min-height: 400px;
        width: 100%;
        height: 100%;
        min-height: var(--dragndrop-min-height);
        position: relative;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import groups from './partials/groups'

    export default {
        components: {
            draggable,
            groups
        },
        props: ['group'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                parts:[],
                toolbox: [
                    {name: "Group", id: 1, icon: 'fa fa-object-group', type: 'group'},
                    {name: "Content", id: 2, icon: 'fa fa-file-o', type: 'content'}
                ],
                current_tool: false,
                current_group: false,
                dropping: false
            }
        },
        methods: {
            current_item(tool) {
                console.log('current tool', tool);
                this.current_tool = tool;
            },
            remove_tool(tool) {
                console.log('remove tool', tool);
                this.current_tool = false;
            },
            dropped(e) {
                console.log('e', e);
                console.log('this.current_tool', this.current_tool);
                console.log('this.current_group', this.current_group);

                if(!this.dropping) {
                    this.updg();
                } else {
                    this.dropping = false;
                }
            },
            upd(e) {
                console.log('this.current_group update', e);
                if(e.type != 'dragover') {
                    this.current_group = e;
                }
            },
            updg() {
                this.dropping = true;
                if(this.current_tool) {
                    var obj = this.clone(this.current_tool);
                    obj.id = Math.random();

                    console.log('obj', obj);

                    if(!this.current_group) {
                        this.parts.push(obj);
                    } else {
//                        if(!this.current_group.hasOwnProperty('children')) {
//                            this.current_group.children = [];
//                        }
//                        console.log('this.current_group in dropped', this.current_group);
//                        this.current_group.children.push(obj);
                    }
                }
                this.current_group = false;
            },
            clone(obj){
                var self = this;
                if(obj == null || typeof(obj) != 'object')
                    return obj;

                var temp = new obj.constructor();
                for(var key in obj)
                    temp[key] = self.clone(obj[key]);

                return temp;
            }
        }
    }
</script>

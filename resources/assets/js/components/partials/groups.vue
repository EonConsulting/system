<template>
    <div>
        <div class="droppable groups"
             @dragover.prevent="enter"
             @dragenter.prevent="enter"
             @dragleave.prevent="leave"
             @dragend.prevent="leave"
             @drop="dropped"
             :class="{ 'dragndrop--dragged': isDraggedOver }"
             data-type="groups">

            <draggable :list="parts" :options="{group:{ name:'groups'}}">
                <div v-for="part, index in parts" class="in-group">
                    <group :group="part" @groupUpdated="changeGroup"></group>
                </div>
            </draggable>

        </div>
    </div>
</template>

<style>
    .droppable {
        padding: 20px;
        width: 100%;
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #f9f9f9;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import item from './item'
    import group from './group'

    export default {
        components: {
            draggable,
            item,
            group
        },
        props: ['parts', 'current_tool'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOver: false,
                isDraggedOverGroup: false,
                dropped_in_droppable: false,
                current_group: false
            }
        },
        methods: {
            enter() {
                this.isDraggedOverGroup = true
            },
            leave() {
                this.isDraggedOverGroup = false
            },
            drop(e) {
                this.leave();
                console.log('e', e);
            },
            current_item(tool) {
                console.log(tool);
                this.current_tool = tool;
            },
            remove_tool(tool) {
                console.log(tool);
                this.dropped_in_droppable = false;
                this.current_tool = false;
            },
            dropped(e) {
                console.log('groups e', e);
                console.log('groups this.current_group', this.current_group);
                console.log('groups this.current_tool', this.current_tool);

                var tool = this.current_tool;

                if(this.current_group) {
                    if(!this.current_group.hasOwnProperty('children')) {
                        this.current_group.children = [];
                    }
                    this.current_group.children.push(this.clone(this.current_tool));
                }
//                if(this.parts.length == 0) {
//                    this.parts.push(this.current_tool);
//                }
//                this.dropped_in_droppable = true;
            },
            changeGroup(e) {
                this.current_group = e;
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

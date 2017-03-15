<template>
    <div class="group" v-show="group != false">
        <div>
            <p>{{ group.name }} {{ group.id }}</p>

            <div class="droppable group"
                 @dragover.prevent="enter(group)"
                 @dragenter.prevent="enter(group)"
                 @dragleave.prevent="leave(group)"
                 @dragend.prevent="leave(group)"
                 @drop.prevent="dropped"
                 :class="{ 'dragndrop--dragged': isDraggedOverGroup }"
                 data-type="group"
                 :data-groupid="group.id">

                <draggable :list="group.children" :options="{group:{ name:'groups'}}">
                    <div v-for="p, index in group.children" class="bottom_20"
                         @dragover.prevent="enter(p)"
                         @dragenter.prevent="enter(p)"
                         @dragleave.prevent="leave(p)"
                         @dragend.prevent="leave(p)"
                         @drop.prevent.stop="dropped">
                        <group :group="p" :ct="ct" @groupUpdated="updateGroup"></group>
                    </div>
                </draggable>
            </div>
        </div>
    </div>
</template>

<style>
    .droppable {
        padding: 20px;
        width: 100%;
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #efefef;
    }

    .group {
        border: 2px dashed #ccc;
        min-height: 50px;
        background: #efefef;
        padding: 20px;
        width: 100%;
    }

    .bottom_20 {
        margin-bottom: 20px;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    import group from './group'

    export default {
        components: {
            draggable,
            group
        },
        props: ['group', 'cg', 'ct'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOverGroup: false,
                current_group: false,
                dropping: false
            }
        },
        methods: {
            enter(e) {
                this.isDraggedOverGroup = true;
                this.current_group = e;
            },
            leave() {
                this.isDraggedOverGroup = false;
//                this.$emit('groupUpdated', false);
                this.current_group = false;
            },
            dropped(e) {
                e.stopImmediatePropagation();
                console.log('in dropped', this.group.id);
                if(this.current_group && !this.dropping) {
                    this.dropping = true;
                    console.log('e abc', this.current_group);

                    if(!this.current_group.hasOwnProperty('children')) {
                        this.current_group.children = [];
                    }

                    var obj = this.clone(this.ct);
                    obj.id = Math.random();

                    console.log('group in', obj);

                    this.current_group.children.push(obj);
                    this.leave();

//                    this.$emit('changeGroup', gr);
//                    this.$emit('updateGroups');


                }

                this.dropping = false;
                this.leave();
            },
            updateGroup(e) {
//                this.current_group = e;
                console.log('e updategroup', e);
//                this.$emit('groupUpdated', e);
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

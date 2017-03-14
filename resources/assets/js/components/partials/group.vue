<template>
    <div>
        <div class="group" v-show="group != false">
            <div>
                <p>{{ group.name }}</p>

                <div class="droppable group"
                     @dragover.prevent="enterGroup(group)"
                     @dragenter.prevent="enterGroup(group)"
                     @dragleave.prevent="leaveGroup(group)"
                     @dragend.prevent="leaveGroup(group)"
                     @drop="droppedInGroup(group)"
                     :class="{ 'dragndrop--dragged': isDraggedOverGroup }"
                     data-type="group"
                     :data-groupid="group.id">

                    <draggable :list="group.children" :options="{group:{ name:'groups'}}">
                        <div v-for="part, index in group.children" class="bottom_20">
                            <group :group="part" @groupUpdated="changeGroup"></group>
                        </div>
                    </draggable>
                </div>
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
    import item from './item'

    export default {
        components: {
            draggable,
            item
        },
        props: ['group'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOverGroup: false,
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
            enterGroup(e) {
                this.isDraggedOverGroup = true;
                this.$emit('groupUpdated', e);
            },
            leaveGroup() {
                this.isDraggedOverGroup = false;
                this.$emit('groupUpdated', false);
            },
            droppedInGroup(e) {
                this.leaveGroup();
                this.$emit('groupUpdated', e);
//                if(!this.group.hasOwnProperty('children')) {
//                    this.group.children = [];
//                }
//
//                this.group.children.push(gr);
            },
            changeGroup(e) {
                this.current_group = e;
                this.$emit('groupUpdated', e);
            }
        }
    }
</script>

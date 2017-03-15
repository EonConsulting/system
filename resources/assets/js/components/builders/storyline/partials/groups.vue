<template>
    <div
        class="droppable groups"
        @dragover.prevent="enter"
        @dragenter.prevent="enter"
        @dragleave.prevent="leave"
        @dragend.prevent="leave"
        @drop="dropped"
        :class="{ 'dragndrop--dragged': isDraggedOver }"
        data-type="groups">

        <draggable :list="parts" :options="{group:{ name:'groups'}}">
            <div v-for="part, index in parts" class="in-group">
                <group :group="part" :ct="current_tool" :cg="current_group" @changeGroup="changeGroup" @updateGroups="updateGroups"></group>
            </div>
        </draggable>

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

    .dragndrop--dragged {
        border-color: #bbbbbb;
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
        props: ['parts', 'current_tool', 'cg'],
        ready() {
            console.log('Component ready.')
        },
        data() {
            return {
                isDraggedOver: false,
                current_group: this.cg
            }
        },
        methods: {
            enter(e) {
                this.current_group = e;
                this.isDraggedOver = true;
            },
            leave(e) {
                this.current_group = false;
                this.isDraggedOver = false;
            },
            dropped(e) {
                var group = this.current_group;
                this.leave();
//                console.log('group', group);
//                console.log('group', typeof group);
//                console.log('update');
            },
            changeGroup(e) {
                this.current_group = e;
                this.$emit('update', e);
            },
            updateGroups() {
                this.$emit('updateGroups');
            }
        }
    }
</script>

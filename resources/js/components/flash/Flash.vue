<template>
    <div class="alert alert-flash"
         :class="'alert-'+level"
         role="alert"
         v-show="show"
         v-text="body">
    </div>
</template>

<script>
export default {
    props: ['message'],
    data() {
        return {
            body: this.message,
            level: 'success',
            show: false
        }
    },
    created() {
        if (this.message) {
            this.flash();
        }
        window.events.$on(
            'flash', data => this.flash(data)
        );
    },
    methods: {
        flash(data) {
            if (data) {
                this.body = data.message;
                this.level = data.level;
            }
            this.show = true;
            this.hide();
        },
        hide() {
            setTimeout(() => {
                this.show = false;
            }, 7000);
        }
    }
};
</script>

<style>
.alert-flash {
    z-index: 1000;
    position: fixed;
    right: 25px;
    bottom: 50px;
}
</style>

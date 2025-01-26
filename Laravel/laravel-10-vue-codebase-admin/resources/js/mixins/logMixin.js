export const logMixin = {
    data() {
        return {}
    },
    methods: {
        log (...args) {
            console.log("console", ...args)
        },
    }
}

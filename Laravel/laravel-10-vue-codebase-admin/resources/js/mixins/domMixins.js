export const domMixins = {
    data() {
        return {}
    },
    methods: {
        loadCSS (href, id = null) {
            const link = document.createElement("link");
            link.rel = "stylesheet";

            if (id) {
                link.id = id;
            }

            link.href = href;
            document.head.appendChild(link);
        },
        loadJS (href) {
            const jsScript = document.createElement("script");
            jsScript.href = href;
            document.head.appendChild(jsScript);
        }
    }
}

export function resolvePage(name) {
    if( name.includes('::') ) {
        const [module, page] = name.split('::');

        const pagePath = `../../Modules/${module}/resources/assets/js/Pages/${page}.vue`

        const pages = import.meta.glob(`../../Modules/**/resources/assets/js/Pages/*.vue`);

        if( !pages[pagePath] ) {
            throw new Error(`Page not found: ${pagePath}`);
        }

        return typeof pages[pagePath] === 'function' 
            ? pages[pagePath]()
            : pages[pagePath];
    }else{
        const pagePath = `./Pages/${name}.vue`;

        const pages = import.meta.glob('./Pages/**/*.vue');

        if( !pages[pagePath] ) {
            throw new Error(`Page not found: ${pagePath}`);
        }

        return typeof pages[pagePath] === 'function' 
            ? pages[pagePath]()
            : pages[pagePath];
    }
}

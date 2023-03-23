const redux = require('redux');
const createStore = redux.createStore;

const initialState = {
    drawerStatus: false,
    notificationSidebarStatus: false,
    widthComponent: 0,
    cart: [],
    products: [],
    categories: [],
    transactions: [],
    user: {},
    keywordProduct: "",
    currentPrinter: {},
    rangeProduct: 10,
    idProductUpdate: null
}

const rootReducer = (state = initialState, action) => {
    switch (action.type) {
        case `CHANGE_DRAWERSTATUS`:
            return {
                ...state,
                drawerStatus: action.newValue
            }
        case `CHANGE_NOTIFICATIONSIDEBARSTATUS`:
            return {
                ...state,
                notificationSidebarStatus: action.newValue
            }
        case `CHANGE_WIDTHCOMPONENT`:
            return {
                ...state,
                widthComponent: action.newValue
            }
        case `CHANGE_CART`:
            return {
                ...state,
                cart: action.newValue
            }
        case `CHANGE_PRODUCTS`:
            return {
                ...state,
                products: action.newValue
            }
        case `CHANGE_CATEGORIES`:
            return {
                ...state,
                categories: action.newValue
            }
        case `CHANGE_TRANSACTIONS`:
            return {
                ...state,
                transactions: action.newValue
            }
        case `CHANGE_USER`:
            return {
                ...state,
                user: action.newValue
            }
        case `CHANGE_KEYWORDPRODUCT`:
            return {
                ...state,
                keywordProduct: action.newValue
            }
        case `CHANGE_CURRENTPRINTER`: 
            return {
                ...state,
                currentPrinter: action.newValue
            }
        case `CHANGE_RANGEPRODUCT`:
            return {
                ...state,
                rangeProduct: action.newValue
            }
        case `CHANGE_IDPRODUCTUPDATE`:
            return {
                ...state,
                idProductUpdate: action.newValue
            }
        default:
            return state;
        }
    }

const store = createStore(rootReducer);

export default store;
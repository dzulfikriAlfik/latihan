import React, { Fragment, useState, useEffect } from "react"
import { SafeAreaView, Text, View, Image, TextInput, TouchableOpacity, Dimensions, TouchableHighlight, FlatList, ActivityIndicator, ToastAndroid } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon, PlusIcon, MinusIcon, ChevronRightIcon, ArrowLeftIcon } from "react-native-heroicons/solid"
import { QrcodeIcon, NewspaperIcon, XIcon, TrashIcon, TicketIcon, CheckCircleIcon, DocumentIcon, XCircleIcon, LogoutIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import Drawer from "../components/organisms/Drawer.organism"
import ButtonSecondaryBordered from "../components/molecules/ButtonSecondaryBordered.molecule"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import { TabView, SceneMap } from "react-native-tab-view"
// import ManualView from "../components/organisms/ManualView.organism"
import ProductView from "../components/organisms/ProductView.organism"
import FavoriteView from "../components/organisms/FavoriteView.organism"
import AsyncStorage from "@react-native-async-storage/async-storage"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import ToggleSwitch from "toggle-switch-react-native"
import OrderFetching from "../libs/fetching/OrderFetching.lib"
import { BLEPrinter } from "react-native-thermal-receipt-printer"
import Sound from "react-native-sound"
import Axios from "../configs/axios/Axios.config"

const renderScene = SceneMap({
    // manual: ManualView,
    product: ProductView,
    favorite: FavoriteView
})

Sound.setCategory("Playback")

const Transaction = ({ navigation, changeDrawerStatus, changeWidthComponent, cart, changeCart, changeProducts, transactions, changeTransactions, keywordProduct, changeKeywordProduct, user, currentPrinter, changeCurrentPrinter, products, changeRangeProduct }) => {
    const [index, setIndex] = useState(1)
    const [priceAll, setPriceAll] = useState(0)
    const [productEdit, setProductEdit] = useState(null)
    const [dataEdit, setDataEdit] = useState({})
    const [routes] = useState([
        // { key: 'manual', title: "Manual" },
        { key: 'product', title: "Product" },
        { key: 'favorite', title: "Favorite" }
    ])
    const [widthScreen, setWidthScreen] = useState(0)
    const [height, setHeight] = useState(0)
    const [isLoading, setIsLoading] = useState(true)
    const [isShowCheckout, setIsShowCheckout] = useState(false)
    const [isDiscount, setIsDiscount] = useState(false)
    const [methodPayment, setMethodPayment] = useState(null)
    const [priceCheckout, setPriceCheckout] = useState(0)
    const [dataCheckout, setDataCheckout] = useState(null)
    const [printers, setPrinters] = useState([])
    const [isShow, setIsShow] = useState(false)
    const [codeVoucher, setCodeVoucher] = useState("")
    const [vouchers, setVouchers] = useState([])
    const [voucherPrice, setVoucherPrice] = useState(0)
    const [isUse, setIsUse] = useState(false)
    const [discountAmount, setDiscountAmount] = useState(0)
    const [itemsDiscount, setItemDiscount] = useState([])
    const [isShowLogout, setIsShowLogout] = useState(false)

    useEffect(() => {
        const timeout = setTimeout(() => {
            setIsLoading(false)
            clearTimeout(timeout)
        }, 1500);
    }, []);

    const handleLogout = async () => {
        setIsLoading(true)

        try {
            await AsyncStorage.removeItem("employe")
            
            ToastAndroid.show("Success logout account.", 1500)
            navigation.reset({ index: 0, routes: [{ name: "Home" }] })
        } catch (error) {
            ToastAndroid.show("Failed logout account.", 1500)
        } finally {
            setIsLoading(false)
        }
    }

    const fixingNumberAmount = (value) => {
        const splitValue = value.split(",")[value.split(",").length - 1].split("").slice(1, 3).join("")
        let result = ""
        let arrResult = value.split(",")

        if(parseInt(splitValue) > 0 && parseInt(splitValue) <= 99) {
            result = `${ parseInt(value.split(",")[value.split(",").length - 1].split("")[0]) + 1 }00`

            if(parseInt(result) >= 1000) {
                result = "000"
                arrResult[arrResult.length - 2] = parseInt(arrResult[arrResult.length - 2]) + 1
            }
        } else {
            result = value.split(",")[value.split(",").length - 1]   
        }

        arrResult[arrResult.length - 1] = result
        arrResult = arrResult.join("")

        return arrResult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    const soundEffect = new Sound('backsound.mp3', Sound.MAIN_BUNDLE)

    const addTransaction = () => {
        AsyncStorage.getItem("cart")
            .then(resultCarts => {
                AsyncStorage.setItem("transactions", JSON.stringify([...transactions, { time: `${ new Date().getHours() }:${ new Date().getMinutes() }`, data: [...JSON.parse(resultCarts)] }]))
                .then(() => {
                    AsyncStorage.getItem("transactions")
                        .then(result => {
                            changeTransactions(JSON.parse(result))

                            AsyncStorage.setItem("cart", JSON.stringify([]))
                                .then(() => {
                                    changeCart([])
                                    setPriceAll(0)
                                })
                                .catch(error => ToastAndroid.show("Failed save transaction.", 1500))
                        }).catch(error => ToastAndroid.show("Failed save transaction.", 1500))
                }).catch(error => ToastAndroid.show("Failed save transaction.", 1500))
            }).catch(error => ToastAndroid.show("Failed save transaction.", 1500))
    }

    const deleteItemCart = () => {
        const result = cart.filter((item, index) => {
            return index !== productEdit
        })

        setProductEdit(null)
        setDataEdit({})

        changeCart([...result])
        AsyncStorage.setItem("cart", JSON.stringify([...result]))
    }

    useEffect(() => {
        AsyncStorage.getItem("cart")
            .then(result => {
                if(JSON.parse(result).length) {
                    changeCart(JSON.parse(result))
                }
            })
            .catch(error => ToastAndroid.show("Failed get data cart.", 1500))

        AsyncStorage.getItem("transactions")
            .then(result => {
                if(JSON.parse(result).length) {
                    changeTransactions(JSON.parse(result))
                }
            })
            .catch(error => ToastAndroid.show("Failed get data transactions.", 1500))

        setWidthScreen(() => Dimensions.get("screen").width)
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    useEffect(() => {
        if(cart.length) {
            AsyncStorage.setItem("cart", JSON.stringify(cart))
            
            let result = 0

            cart.forEach((item) => {
                result += parseFloat(fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")).split(",").join("")) * item.qty
            })

            setPriceAll(() => parseInt(fixingNumberAmount(result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")).split(",").join("")))
        }
    }, [cart])

    const renderTabBar = (props) => {
        return (
            <View 
                style={ Tailwind`w-full flex flex-row items-center justify-between bg-primary--red--20 p-1 rounded-lg mb-5` }
                onLayout={ (e) => changeWidthComponent(e.nativeEvent.layout.width) }
            >
                {
                    React.Children.toArray(props.navigationState.routes.map((route, i) => {
                        return (
                            <TouchableOpacity
                                onPress={() => setIndex(i)}
                                style={ Tailwind`flex-1 py-3 ${ index === i ? "bg-white" : "bg-transparent" } rounded-md flex flex-row items-center justify-center` }
                            >
                                <Text style={ Tailwind`font-rubik-bold text-base text-primary--red ${ index === i ? "opacity-100" : "opacity-50" }` }>{ route.title }</Text>
                            </TouchableOpacity>
                        );
                    }))
                }
            </View>
        );
    }

    const handlePlusQtyEdit = () => {
        let stockRemain = 0

        transactions.forEach(transaction => {
            transaction.data.forEach(itemProduct => {
                if(itemProduct.id === dataEdit.id) {
                    stockRemain += itemProduct.qty
                }
            })
        })

        cart.forEach(cartItem => {
            if(cartItem.id === dataEdit.id) {
                stockRemain += cartItem.qty
            }
        })

        if(dataEdit.qty <= (dataEdit.stock - stockRemain)) {
            setDataEdit({ ...dataEdit, qty: dataEdit.qty + 1 })
        }
    }

    const handleMinusQtyEdit = () => {
        if(dataEdit.qty > 1) {
            setDataEdit({ ...dataEdit, qty: dataEdit.qty - 1 })
        }
    }

    const handleSubmitEdit = async () => {
        const newCart = cart.map((item, index) => {
            return index === productEdit ? dataEdit : item
        })

        changeCart([...newCart])
        await AsyncStorage.setItem("cart", JSON.stringify(newCart))

        setProductEdit(null)
        setDataEdit({})
    }

    const handleSubmitCheckout = async (price) => {
        if(price < (priceAll - voucherPrice)) {
            ToastAndroid.show("Your money is less.", 1500)
        } else {
            setIsShowCheckout(false)
            setIsDiscount(false)
            setIsLoading(true)
            setMethodPayment(null)

            const idDiscount = itemsDiscount.map((item) => item.item_id)

            const cartDiscount = cart.map((item) => {
                if(idDiscount.includes(item.id)) {
                    return {
                        item_id: item.id,
                        qty: item.qty,
                        price_discount: itemsDiscount[idDiscount.indexOf(item.id)].price_discount,
                        discount: itemsDiscount[idDiscount.indexOf(item.id)].discount,
                        potongan: itemsDiscount[idDiscount.indexOf(item.id)].potongan
                    }
                } else {
                    return {
                        item_id: item.id,
                        qty: item.qty,
                        price_discount: 0,
                        discount: 0,
                        potongan: 0
                    }
                }
            })

            try {
                const result = await OrderFetching().storeOrder({
                    store_id: user.stores[0].id_store,
                    order_amount: priceAll,
                    vendor_id: user.id,
                    module_id: cart[0].module_id,
                    pay_amount: voucherPrice >= priceAll ? 0 : price,
                    change_amount: 0,
                    vouchers: vouchers.map(item => item.code),
                    discount_amount: discountAmount,
                    products: cartDiscount
                })
    
                if(result.length) {
                    const idUpdate = result.map(item => item.id.toString())

                    soundEffect.play((success) => {
                        console.log("Play")

                        if(success) {
                            soundEffect.release()
                            soundEffect.stop()
                        }
                    })

                    setDataCheckout({
                        method: "Cash",
                        total: voucherPrice >= priceAll ? 0 : priceAll - voucherPrice,
                        accept: price,
                        return: price <= (priceAll - voucherPrice) ? 0 : price - (priceAll - voucherPrice),
                        time: `${ new Date().getDate() } ${ new Date().getMonth() } ${ new Date().getFullYear() } - ${ new Date().getHours() } ${ new Date().getMinutes() }`
                    })

                    changeCart([])
                    setVouchers([])
                    setVoucherPrice(0)
                    setItemDiscount([])
                    
                    AsyncStorage.setItem("cart", JSON.stringify([]))

                    let dataUpdate = []

                    products.forEach((item) => {
                        if(Array.from(idUpdate).includes(item.id.toString())) {
                            dataUpdate.push({
                                id: result[Array.from(idUpdate).indexOf(item.id.toString())].id,
                                sku_id: result[Array.from(idUpdate).indexOf(item.id.toString())].sku_id,
                                name: result[Array.from(idUpdate).indexOf(item.id.toString())].name,
                                price: result[Array.from(idUpdate).indexOf(item.id.toString())].price,
                                stock: result[Array.from(idUpdate).indexOf(item.id.toString())].stock,
                                category_id: result[Array.from(idUpdate).indexOf(item.id.toString())].category_id,
                                module_id: result[Array.from(idUpdate).indexOf(item.id.toString())].module_id
                            })
                        } else {
                            dataUpdate.push(item)
                        }
                    })

                    changeProducts([...dataUpdate])
                    await AsyncStorage.setItem("products", JSON.stringify(dataUpdate))

                    ToastAndroid.show("Success checkout transactions.", 1500)
                } else {
                    console.log(result.data)
                    ToastAndroid.show("Failed when checkout transactions.", 1500)
                }
            } catch (error) {
                console.log(error.message)
                ToastAndroid.show("Failed when checkout transactions.", 1500)
            } finally {
                setIsLoading(false)
                setPriceCheckout(0)
                setIsUse(false)
            }
        }
    }
    
    useEffect(() => {
        BLEPrinter.init().then(() => {
            BLEPrinter.getDeviceList().then(results => {
                setPrinters(results)
            })
        })
    }, [])

    const connectPrinter = (printer) => {
        setIsLoading(true)

        BLEPrinter.connectPrinter(printer.inner_mac_address)
            .then((result, error) => {
                if(error) return ToastAndroid.show("Failed connecting printer.", 1500)

                changeCurrentPrinter(result)
                ToastAndroid.show("Success connecting printer.", 1500)
            }).catch(error => {
                ToastAndroid.show("Failed connecting printer.", 1500)
            }).finally(() => setIsLoading(false))
    }

    const renderSpace = (text1, text2) => {
        let space = 32
        let result = ""

        space -= text1.split("").length
        space -= text2.split("").length

        result += text1
        
        for (let index = 0; index < space; index++) {
            result += " "
        }

        result += text2
        return result
    }

    const randomString = () => {
        let text = ""
        const possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890097213897012938214213"

        for (let index = 0; index < 8; index++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length))
        }

        return text
    }

    const printStruct = async () => {
        const dataCk = dataCheckout

        setIsLoading(true)
        setDataCheckout(false)

        if(currentPrinter) {
            try {
                let data = await OrderFetching().getOrders({
                    "from_date": "2000-01-01T03:40:11.139Z",
                    "to_date": "2100-01-01T03:40:11.139Z"
                })
                let text = ""
    
                data = data[0]
    
                text += "<CB>WEMART</CB>\n\n"
                text += `<C>Wemart ${ user.stores[0].name_store }</C>\n`
                text += `<C>${ user.stores[0].address_store }</C>\n`
                text += "<C>Kota Bandung</C>\n"
                text += `<C>${ user.phone }</C>\n\n`
                text += `${ renderSpace("Kasir", user.name) }\n`
                text += `${ renderSpace("Waktu", data.order.created_at.toString()) }\n`
                text += `${ renderSpace("No.Struk", "#INV-"+randomString()) }\n`
                text += `${ renderSpace("Jenis Pembayaran", data.order.payment_method) }\n`
                text += `${ renderSpace("Pelanggan", "-") }\n`
                text += `................................\n\n`
                data.detail_order.forEach((item) => {
                    text += `${ item.item.name }\n`
                    text += `${ renderSpace(`Rp${ fixingNumberAmount(item.item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) } x ${ item.qty }`, `Rp${ fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }`) }\n`
                    if(item.discount_item) {
                        text += `${ renderSpace(`Diskon`, `Rp${ item.discount_item.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n\n`
                    } else {
                        text += "\n"
                    }
                })
                text += `................................\n\n`
                text += `${ renderSpace("Sub Total", `Rp${ (data.order.order_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
                text += `${ renderSpace("Diskon", "Rp0") }\n`
                text += `${ renderSpace("Voucher", `Rp${ (data.order.coupon_discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
                text += `................................\n\n`
                text += `${ renderSpace("Total", `Rp${ (data.order.order_amount - data.order.coupon_discount_amount < 0 ? 0 : data.order.order_amount - data.order.coupon_discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
                text += `................................\n\n`
                text += `${ renderSpace("Bayar", `Rp${ data.order.pay_amount.split(".")[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
                text += `${ renderSpace("Kembali", `${ data.order.order_amount <= data.order.coupon_discount_amount ? "Rp0" : data.order.pay_amount < (data.order.order_amount - data.order.coupon_discount_amount) ? `Rp0` : `Rp${ (data.order.pay_amount - (data.order.order_amount - data.order.coupon_discount_amount)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }` }`) }\n\n\n\n`
                text += "<C>Powered by WEMART</C>\n"
                text += "<C>www.wemart.co.id</C>"
    
                BLEPrinter.printBill(text)
            } catch (error) {
                ToastAndroid.show("Failed print struct.", 1500)
            } finally {
                setIsLoading(false)
                setDataCheckout(dataCk)
            }
        } else {
            ToastAndroid.show("Print not ready connected.", 1500)
        }
    }

    const checkVoucher = async () => {
        setIsLoading(true)
        setIsShowCheckout(false)

        try {
            const token = await AsyncStorage.getItem("token")
            
            const response = await Axios.post(
                "/vendor/pos/cek_voucher",
                {
                    products: cart.map((item) => {
                        return {
                            item_id: item.id,
                            qty: item.qty,
                            price: item.price
                        }
                    }),
                    vouchers: vouchers.map(item => item.code),
                    order_amount: priceAll
                },
                {
                    headers: {
                        "Authorization": `Bearer ${ JSON.parse(token) }`,
                        "Content-type": "application/json"
                    }
                }
            )

            setIsUse(true)
            setVouchers([...response.data[0].voucher_invalid.map((item) => new Object({ code: item, status: "Invalid" })), ...response.data[0].voucher_valid.map((item) => new Object({ code: item, status: "Valid" }))])
            setVoucherPrice(response.data[0].amount_voucher_valid)
            setDiscountAmount(response.data[0].discount_amount)
            setItemDiscount(response.data[0].item_discount)
    
            setIsShowCheckout(true)
            setIsLoading(false)
        } catch (error) {
            console.log(error.message)
            setIsShowCheckout(true)
            setIsLoading(false)
            setVouchers([])
            setIsUse(false)

            ToastAndroid.show("Failed check data voucher.", 1500)
        }
    }

    useEffect(() => {
        if(isDiscount) {
            if(!itemsDiscount.length) {
                ToastAndroid.show("No have items discounts.", 1500)
                setIsDiscount(false)
            }
        }
    }, [isDiscount])

    return (
        <Fragment>
            <SafeAreaView>
                <Drawer/>
                <View style={ [Tailwind`w-full flex bg-primary--red--20 flex-col`, { minHeight: Dimensions.get("screen").height }] }>
                    <View style={ Tailwind`w-full p-6 flex flex-row items-center justify-between` }>
                        <View style={ Tailwind`flex flex-row items-center` }>
                            <TouchableHighlight underlayColor={ "#10101010" } style={   Tailwind`rounded-lg` } onPress={ () => changeDrawerStatus(true) }>
                                <MenuIcon size={ 24 } style={ Tailwind.style(`text-accent--black opacity-70`) }/>
                            </TouchableHighlight>
                            <Image
                                source={ require("../assets/images/logo-red.png") }
                                style={ Tailwind`w-45 h-15 ml-5 ${ handleResponsive(["hidden", "flex"]) }` }
                                resizeMode={ "contain" }
                            />
                            <View style={ Tailwind`${ handleResponsive(["w-40 ml-6","w-80 ml-10"]) } px-3 py-2 rounded-md bg-gray-100 flex flex-row items-center border border-primary--red--20` }>
                                <SearchIcon size={ 22 } style={ Tailwind`text-primary--red opacity-70` }/>
                                <TextInput
                                    scrollEnabled={ false }
                                    placeholder={ "Cari Produk" }
                                    style={ Tailwind`p-0 text-sm text-primary--red flex-grow ml-3 tracking-wide font-rubik-regular` }
                                    placeholderTextColor={ "#F2414180" }
                                    value={ keywordProduct }
                                    onChangeText={ (value) => changeKeywordProduct(value) }
                                />
                                {
                                    keywordProduct ? 
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                            changeKeywordProduct("")
                                            changeRangeProduct(10)
                                        } }>
                                            <XCircleIcon size={ 22 } style={ Tailwind`text-primary--red opacity-70` }/>
                                        </TouchableHighlight> : null
                                }
                            </View>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("ScanQr") }>
                                <QrcodeIcon size={ 24 } style={ Tailwind`text-primary--red ml-5 opacity-70` }/>
                            </TouchableHighlight>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("ListTransaction") } style={ Tailwind`ml-5` }>
                                <View>
                                    <NewspaperIcon size={ 24 } style={ Tailwind`text-primary--red opacity-70` }/>
                                    <View style={ [Tailwind`w-5 h-5 absolute z-10 rounded-full bg-primary--red flex flex-row items-center justify-center`, { transform: [{ translateX: 10 }, { translateY: -7 }] }] }>
                                        <Text style={ Tailwind`font-rubik-regular text-xs text-white` }>
                                            { transactions.length || "0" }
                                        </Text>
                                    </View>
                                </View>
                            </TouchableHighlight>
                        </View>
                        <View style={ Tailwind`flex flex-row items-center` }>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`mr-5` } onPress={ () => setIsShowLogout(true) }>
                                <LogoutIcon size={ 24 } style={ Tailwind`text-primary--red opacity-70` }/>
                            </TouchableHighlight>
                            <Image
                                source={ { uri: user.avatar } }
                                resizeMode={ "contain" }
                                style={ Tailwind`w-11 h-11 rounded-full` }
                            />
                        </View>
                    </View>
                    <View style={ Tailwind`w-full flex-grow flex ${ handleResponsive(["flex-col", "flex-row"]) } items-center justify-between` }>
                        <View style={ Tailwind`${ handleResponsive(["w-full flex-grow", "w-8/12"]) } p-6 bg-white` }>
                            <TabView
                                navigationState={ { index, routes } }
                                renderScene={ renderScene }
                                onIndexChange={ setIndex }
                                renderTabBar={ renderTabBar }
                            />
                        </View>
                        <View style={ Tailwind`${ handleResponsive(["w-full", "w-4/12"]) } border-primary--red--20 bg-white py-6 pr-6 border-l border-gray-200` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-24 flex flex-row justify-center items-center py-3 rounded-md border border-gray-200 ${ cart.length ? "bg-transparent" : "bg-gray-200" }` } onPress={ () => {
                                    if(cart.length) {
                                        changeCart([])
                                        setPriceAll(0)
                                        AsyncStorage.setItem("cart", JSON.stringify([]))
                                    }
                                } }>
                                    <Text style={ Tailwind`font-medium text-sm ${ cart.length ? "text-accent--black" : "text-white" }` }>
                                        Hapus
                                    </Text>
                                </TouchableHighlight>
                            </View>
                            <View style={ Tailwind`w-full flex flex-col items-center flex-grow justify-between` }>
                                <View style={ Tailwind`flex-grow w-full flex flex-col py-5 pl-5` }>
                                    {
                                        cart.length ?
                                        <View>
                                            <FlatList
                                                data={ Array.from(cart).reverse() }
                                                keyExtractor={ (item, index) => index }
                                                style={ Tailwind`max-h-40` }
                                                renderItem={ ({ item, index }) => {
                                                    return (
                                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                                            setProductEdit(index)
                                                            setDataEdit(cart[index])
                                                        } }>
                                                            <View style={ Tailwind`flex flex-col mb-2` }>
                                                            <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                                                    { item.name }
                                                                </Text>
                                                            </View>
                                                            <View style={ Tailwind`flex flex-row items-center justify-between mt-1` }>
                                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                                    Rp{ fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) } x { item.qty }
                                                                </Text>
                                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                                    Rp{ fixingNumberAmount((parseFloat(fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")).split(",").join("")) * item.qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                                                </Text>
                                                            </View>
                                                            </View>
                                                        </TouchableHighlight>
                                                    )
                                                } }
                                            />
                                            <View style={ Tailwind`w-full h-px bg-gray-200 mt-4 mb-8` }/>
                                            <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                                    Subtotal
                                                </Text>
                                                <Text style={ Tailwind`text-sm text-accent--black opacity-80 tracking-wide` }>
                                                    Rp { fixingNumberAmount(priceAll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                                </Text>
                                            </View>
                                        </View> :
                                        <View style={ Tailwind`flex flex-col items-center justify-center` }>
                                            <Image
                                                source={ require("../assets/ilustrations/cart.png") }
                                                resizeMode={ "contain" }
                                                style={ Tailwind`w-40 h-40` }
                                            />
                                            <Text style={ Tailwind`font-medium text-accent--black text-sm mt-5` }>
                                                Keranjang Masih Kosong
                                            </Text>
                                            <Text style={ Tailwind`text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                                Silahkan tambahkan produk ke keranjang melalui katalog, scan, atau catat langsung.
                                            </Text>
                                        </View>
                                    }
                                </View>
                                <View style={ Tailwind`w-full py-5 pl-5 flex flex-col border-t border-gray-200` }>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                        <View style={ Tailwind`flex flex-col` }>
                                            <Text style={ Tailwind`font-medium text-accent--black text-base` }>
                                                Total
                                            </Text>
                                            <Text style={ Tailwind`text-accent--black text-xs opacity-40` }>
                                                { cart.length || 0 } Produk
                                            </Text>
                                        </View>
                                        <Text style={ Tailwind`font-medium text-primary--red text-base` }>
                                            Rp{ cart.length ? fixingNumberAmount(priceAll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) : 0 }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-3` }>
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => cart.length ? addTransaction() : null } style={ Tailwind`w-24` }>
                                            <ButtonSecondaryBordered text={ "Simpan" }/>
                                        </TouchableHighlight>
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => cart.length ? setIsShowCheckout(true) : null } style={ Tailwind`rounded-lg flex-grow ml-3` }>
                                            <ButtonPrimary text={ "Bayar" }/>
                                        </TouchableHighlight>
                                    </View>
                                </View>
                            </View>
                        </View>
                    </View>
                </View>
                {
                    productEdit !== null ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <Text style={ Tailwind`font-rubik-semibold text-lg text-accent--black` }>
                                        { dataEdit.name }
                                    </Text>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                        setProductEdit(null)
                                        setDataEdit({})
                                    } }>
                                        <XIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                    </TouchableHighlight>
                                </View>
                                <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <Text style={ Tailwind`font-rubik-medium text-base text-accent--black opacity-50` }>
                                        Harga
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-medium text-lg text-accent--black` }>
                                        Rp{ fixingNumberAmount(dataEdit.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-2` }>
                                    <Text style={ Tailwind`font-rubik-medium text-base text-accent--black opacity-50` }>
                                        Jumlah Barang
                                    </Text>
                                    <View style={ Tailwind`flex flex-row items-center p-1 rounded-md border border-gray-200` }>
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => handlePlusQtyEdit() }>
                                            <View style={ Tailwind`w-6 h-6 bg-gray-100 flex flex-row items-center justify-center rounded-sm` }>
                                                <PlusIcon size={ 16 } style={ Tailwind`text-accent--black` }/>
                                            </View>
                                        </TouchableHighlight>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-primary--red mx-5` }>
                                            { dataEdit.qty }
                                        </Text>
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => handleMinusQtyEdit() }>
                                            <View style={ Tailwind`w-6 h-6 bg-gray-100 flex flex-row items-center justify-center rounded-sm` }>
                                                <MinusIcon size={ 16 } style={ Tailwind`text-accent--black` }/>
                                            </View>
                                        </TouchableHighlight>
                                    </View>
                                </View>
                                <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <Text style={ Tailwind`font-rubik-medium text-base text-accent--black opacity-50` }>
                                        Total
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-medium text-lg text-primary--red` }>
                                        Rp{ fixingNumberAmount((dataEdit.price * dataEdit.qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                    </Text>
                                </View>
                                {/* <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black opacity-50 self-start` }>
                                    Tambah Diskon
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center mt-3` }>
                                    <View style={ Tailwind`px-3 h-10 rounded-md rounded-tr-none rounded-br-none bg-primary--red flex flex-row items-center justify-between` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-white` }>
                                            Harga Baru
                                        </Text>
                                    </View>
                                    <TextInput
                                        style={ Tailwind`flex-grow bg-white rounded-tl-none rounded-bl-none rounded-md border border-primary--red h-10` }
                                    />
                                </View>
                                <View style={ Tailwind`flex flex-row items-center mt-3` }>
                                    <View style={ Tailwind`px-3 h-10 rounded-md rounded-tr-none rounded-br-none bg-primary--red flex flex-row items-center justify-between` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-white` }>
                                            Diskon
                                        </Text>
                                    </View>
                                    <TextInput
                                        style={ Tailwind`flex-grow bg-white rounded-tl-none rounded-bl-none rounded-md border border-primary--red h-10` }
                                    />
                                </View>
                                <View style={ Tailwind`flex flex-row items-center mt-3` }>
                                    <View style={ Tailwind`px-3 h-10 rounded-md rounded-tr-none rounded-br-none bg-gray-200 flex flex-row items-center justify-between` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-white` }>
                                            Deskripsi
                                        </Text>
                                    </View>
                                    <TextInput
                                        style={ Tailwind`flex-grow bg-white rounded-tl-none rounded-bl-none rounded-md border border-gray-200 h-10` }
                                    />
                                </View> */}
                                <View style={ Tailwind`w-full h-px bg-gray-200 mt-5 mb-5` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => deleteItemCart() }>
                                        <View style={ Tailwind`flex flex-row items-center flex-grow rounded-lg border border-primary--red p-4` }>
                                            <TrashIcon size={ 20 } style={ Tailwind`text-primary--red` }/>
                                            <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red ml-3` }>
                                                Hapus Dari Keranjang
                                            </Text>
                                        </View>
                                    </TouchableHighlight>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => handleSubmitEdit() }>
                                        <View style={ Tailwind`w-32 ml-3` }>
                                            <ButtonPrimary text={ "Simpan" }/>
                                        </View>
                                    </TouchableHighlight>
                                </View>
                            </View>
                        </View> : null
                }
                {
                    isLoading ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                            <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                        </View> : null
                }
                {
                    isShowCheckout ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col` }>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <Text style={ Tailwind`font-rubik-semibold text-lg text-accent--black` }>
                                        Checkout Transaksi
                                    </Text>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                        setIsShowCheckout(false)
                                        setVouchers([])
                                        setCodeVoucher("")
                                        setDiscountAmount(0)
                                        setVoucherPrice(0)
                                        setItemDiscount([])
                                        setIsUse(false)
                                    } }>
                                        <XIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                    </TouchableHighlight>
                                </View>
                                <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 mt-3` }>
                                    Sub Total Produk
                                </Text>
                                <Text style={ Tailwind`font-rubik-semibold text-3xl text-primary--red mt-1` }>
                                    Rp { fixingNumberAmount(priceAll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 mt-5` }>
                                    Masukan Voucher
                                </Text>
                                <View style={ Tailwind`w-full flex flex-row items-center mt-2` }>
                                    <View style={ Tailwind`flex-grow flex flex-row items-center rounded-md bg-gray-100 border border-primary--red` }>
                                        <View style={ Tailwind`w-20 h-13 bg-primary--red rounded-md flex items-center justify-center` }>
                                            <TicketIcon size={ 30 } style={ Tailwind`text-white` }/>
                                        </View>
                                        <TextInput
                                            style={ Tailwind`font-rubik-medium text-base text-primary--red ml-2 w-40` }
                                            value={ codeVoucher }
                                            onChangeText={ (value) => setCodeVoucher(value) }
                                        />
                                    </View>
                                    <View style={ Tailwind`w-22 ml-2` }>
                                        {
                                            codeVoucher && !isUse ? 
                                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                                    if(vouchers.length) {
                                                        let exist = false

                                                        vouchers.forEach(item => {
                                                            if(item.code === codeVoucher) {
                                                                exist = true
                                                            }
                                                        })
                                                        
                                                        if(exist) {
                                                            ToastAndroid.show("Voucher already exist.", 1500)
                                                        } else {
                                                            setVouchers([...vouchers, { code: codeVoucher, status: "Pending" }])
                                                        }
                                                    } else {
                                                        setVouchers([...vouchers, { code: codeVoucher, status: "Pending" }])
                                                    }

                                                    setCodeVoucher("")
                                                } }>
                                                    <ButtonPrimary text={ "Pakai" }/>
                                                </TouchableHighlight> :
                                                <ButtonSecondary text={ "Pakai" }/>
                                        }
                                    </View>
                                </View>
                                <View style={ Tailwind`w-full flex flex-col` }>
                                    {
                                        vouchers.length ?
                                            React.Children.toArray(vouchers.map(item => {
                                                return (
                                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-3` }>
                                                        <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red` }>
                                                            #{ item.code }
                                                        </Text>
                                                        <Text style={ Tailwind`font-rubik-regular text-sm ${ item.status == "Pending" ? "text-gray-300" : item.status == "Valid" ? "text-green-400" : "text-red-400" }` }>
                                                            { item.status }
                                                        </Text>
                                                    </View>
                                                )
                                            })) : null
                                    }
                                </View>
                                {
                                    vouchers.length ?
                                        <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-full mt-3` } onPress={ () => {
                                            if(!isUse) {
                                                checkVoucher()
                                            } else {
                                                setVouchers([])
                                                setIsUse(false)
                                                setVoucherPrice(0)
                                                setDiscountAmount(0)
                                                setItemDiscount([])
                                            }
                                        } }>
                                            <ButtonPrimary text={ !isUse ? "Cek Voucher" : "Reset Voucher" }/>
                                        </TouchableHighlight> : null
                                }
                                <View style={ Tailwind`w-full flex flex-row justify-between` }>
                                    <View style={ Tailwind`flex flex-col flex-1` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 mt-3` }>
                                            Potongan Voucher
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-semibold text-xl text-primary--red mt-1` }>
                                            Rp{
                                                vouchers.length ? 
                                                    voucherPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")  : "-"
                                            }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`flex flex-col flex-1` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 mt-3` }>
                                            Total
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-semibold text-xl text-primary--red mt-1` }>
                                            Rp{
                                                vouchers.length ? 
                                                (priceAll - voucherPrice) < 0 ? 0 : fixingNumberAmount((Math.floor(priceAll - voucherPrice)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) : fixingNumberAmount(priceAll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
                                            }
                                        </Text>
                                    </View>
                                </View>
                                <Text style={ Tailwind`font-rubik-medium text-xl text-accent--black opacity-80 mt-3` }>
                                    Pembayaran
                                </Text>
                                <View style={ Tailwind`w-full h-px bg-gray-200 mt-2` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between my-2` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black opacity-80` }>
                                        Diskon Bundling
                                    </Text>
                                    <ToggleSwitch
                                        isOn={ isDiscount }
                                        onToggle={ (value) => setIsDiscount(value) }
                                    />
                                </View>
                                {
                                    isDiscount ? 
                                        React.Children.toArray(itemsDiscount.map(item => {
                                            return (
                                                <View style={ Tailwind`mb-2 w-full flex flex-row items-center justify-between` }>
                                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                                        { item.item_name }
                                                    </Text>
                                                    <Text style={ Tailwind`font-rubik-regular text-sm text-green-400` }>
                                                        Rp{ fixingNumberAmount(item.potongan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }/pcs
                                                    </Text>
                                                </View>
                                            )
                                        })) : null
                                }
                                <View style={ Tailwind`w-full h-px bg-gray-200 mb-4` }/>
                                {
                                    voucherPrice >= priceAll ? 
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                            if(voucherPrice < priceAll) {
                                                ToastAndroid.show("Voucher price less then order amount.", 1500)
                                            } else {
                                                setMethodPayment("cash")
                                                setIsShowCheckout(false)

                                                handleSubmitCheckout(priceAll)
                                            }
                                        } }>
                                            <View style={ Tailwind`w-full flex h-14 bg-gray-100 flex-row items-center justify-between px-4 rounded-md` }>
                                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black opacity-80` }>
                                                    Gunakan Voucher
                                                </Text>
                                                <ChevronRightIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                            </View>
                                        </TouchableHighlight> :
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                            setMethodPayment("cash")
                                            setIsShowCheckout(false)
                                        } }>
                                            <View style={ Tailwind`w-full flex h-14 bg-gray-100 flex-row items-center justify-between px-4 rounded-md` }>
                                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black opacity-80` }>
                                                    { voucherPrice ? "Bayar Tunai + Voucher" : "Bayar Tunai" }
                                                </Text>
                                                <ChevronRightIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                            </View>
                                        </TouchableHighlight>
                                }
                                {/* <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-1` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black opacity-80` }>
                                        Pembayaran Online
                                    </Text>
                                    <ChevronRightIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-1` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black opacity-80` }>
                                        QRIS
                                    </Text>
                                    <ChevronRightIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-1` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black opacity-80` }>
                                        Pembayaran Lainnya
                                    </Text>
                                    <ChevronRightIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                </View> */}
                                <View style={ Tailwind`w-full h-px bg-gray-200 my-4` }/>
                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                    if(cart.length) {
                                        changeCart([])
                                        setPriceAll(0)
                                        AsyncStorage.setItem("cart", JSON.stringify([]))
                                        setIsShowCheckout(false)
                                    }
                                } }>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                        <View style={ Tailwind`flex-grow h-14 flex flex-row items-center justify-center bg-primary--red rounded-md` }>
                                            <TrashIcon size={ 22 } style={ Tailwind`text-white mr-3` }/>
                                            <Text style={ Tailwind`font-rubik-medium text-sm text-white` }>
                                                Hapus Transaksi
                                            </Text>
                                        </View>
                                        <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-22 ml-2` } onPress={ () => {
                                            addTransaction()
                                            setIsShowCheckout()
                                        } }>
                                            <ButtonSecondary text={ "Simpan" }/>
                                        </TouchableHighlight>
                                    </View>
                                </TouchableHighlight>
                            </View>
                        </View> : null
                }
                {
                    dataCheckout ?
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                                <CheckCircleIcon size={ 100 } style={ Tailwind`text-green-400` }/>
                                <Text style={ Tailwind`font-rubik-medium text-accent--black mt-2 text-2xl` }>
                                    Transaksi Berhasil
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-sm text-gray-300` }>
                                    { dataCheckout.time }
                                </Text>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                    <Text style={ Tailwind`font-rubik-regular text-sm text-gray-500` }>
                                        Pembayaran
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-gray-500` }>
                                        { dataCheckout.method }
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-2` }>
                                    <Text style={ Tailwind`font-rubik-regular text-sm text-gray-500` }>
                                        Total Tagihan
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-gray-500` }>
                                        Rp{ dataCheckout.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-2` }>
                                    <Text style={ Tailwind`font-rubik-regular text-sm text-gray-500` }>
                                        Diterima
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-gray-500` }>
                                        Rp{ dataCheckout.accept.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-2` }>
                                    <Text style={ Tailwind`font-rubik-regular text-sm text-gray-500` }>
                                        Kembalian
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-gray-500` }>
                                        Rp{ dataCheckout.return.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => Object.keys(currentPrinter).length ? printStruct() : setIsShow(true) }>
                                        <View style={ Tailwind`flex-1 flex flex-row items-center justify-center border border-primary--red rounded-md py-3` }>
                                            <DocumentIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                            <Text style={ Tailwind`font-rubik-regular text-sm text-primary--red ml-2` }>
                                                Cetak Struk
                                            </Text>
                                        </View>
                                    </TouchableHighlight>
                                    <View style={ Tailwind`w-3` }/>
                                    <View style={ Tailwind`flex-1 flex flex-row items-center justify-center border border-primary--red rounded-md py-3` }>
                                        <NewspaperIcon size={ 22 } style={ Tailwind`text-primary--red` }/>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-primary--red ml-2` }>
                                            Kirim Struk
                                        </Text>
                                    </View>
                                </View>
                                <TouchableHighlight style={ Tailwind`w-full mt-3` } underlayColor={ "#10101010" } onPress={ () => setDataCheckout(null) }>
                                    <ButtonPrimary text={ "Transaksi Baru" }/>
                                </TouchableHighlight>
                            </View>
                        </View> : null
                }
                {
                    methodPayment === "cash" ?
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col` }>
                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => {
                                    setMethodPayment(null)
                                    setIsShowCheckout(true)
                                    setPriceCheckout(0)
                                } }>
                                    <View style={ Tailwind`w-full flex flex-row items-center` }>
                                        <ArrowLeftIcon size={ 22 } style={ Tailwind`text-accent--black opacity-70` }/>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-accent--black ml-2` }>
                                            Bayar Tunai
                                        </Text>
                                    </View>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 mt-5` }>
                                    Total
                                </Text>
                                <Text style={ Tailwind`font-rubik-semibold text-3xl text-green-400 mt-1` }>
                                    Rp{
                                        vouchers.length ? 
                                        (priceAll - voucherPrice) < 0 ? 0 : fixingNumberAmount((Math.floor(priceAll - voucherPrice)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) : fixingNumberAmount(priceAll.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
                                    }
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-50 mt-5` }>
                                    Uang yang diterima
                                </Text>
                                <TextInput
                                    placeholder="0"
                                    value={ priceCheckout ? priceCheckout.toString() : null }
                                    onChangeText={ (value) => setPriceCheckout(value) }
                                    style={ Tailwind`font-rubik-regular text-sm text-accent--black w-full p-4 rounded-md border border-gray-200 mt-3` }
                                    keyboardType={ "numeric" }
                                    onEndEditing={ () => setPriceCheckout(priceCheckout.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                    onTouchStart={ () => setPriceCheckout(typeof(priceCheckout) == typeof("str") ? parseInt(priceCheckout.split(",").join("")) : priceCheckout) }
                                />
                                {
                                    priceCheckout ?
                                        <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-full mt-5` } onPress={ () => handleSubmitCheckout(parseInt(priceCheckout.split(",").join(""))) }>
                                            <ButtonPrimary text={ "Bayar" }/>
                                        </TouchableHighlight> :
                                        <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-full mt-5` } onPress={ () => handleSubmitCheckout(priceAll - voucherPrice) }>
                                            <ButtonPrimary text={ "Uang Pas" }/>
                                        </TouchableHighlight>
                                }
                                <View style={ Tailwind`w-full flex flex-row items-center mt-10` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1 mr-2` } onPress={ () => setPriceCheckout(priceCheckout ? (parseInt(priceCheckout.split(",").join("")) + 5000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : (5000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }>
                                        <ButtonSecondary text={ `Rp${ (5000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }` }/>
                                    </TouchableHighlight>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => setPriceCheckout(priceCheckout ? (parseInt(priceCheckout.split(",").join("")) + 7500).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : (7500).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }>
                                        <ButtonSecondary text={ `Rp${ (7500).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }` }/>
                                    </TouchableHighlight>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center mt-2` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1 mr-2` } onPress={ () => setPriceCheckout(priceCheckout ? (parseInt(priceCheckout.split(",").join("")) + 10000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : (10000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }>
                                        <ButtonSecondary text={ `Rp${ (10000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }` }/>
                                    </TouchableHighlight>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => setPriceCheckout(priceCheckout ? (parseInt(priceCheckout.split(",").join("")) + 12500).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : (12500).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }>
                                        <ButtonSecondary text={ `Rp${ (12500).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }` }/>
                                    </TouchableHighlight>
                                </View>
                            </View>
                        </View> : null
                }
                {
                isShow ?
                    <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                        <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col` }>
                            <View style={ Tailwind`w-full flex flex-col` }>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                    Daftar Printer
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 text-left mt-1` }>
                                    Note: Jika printer memiliki password ketika diakses, pastikan sudah terhubung.
                                </Text>
                                <View style={ Tailwind`w-full mt-5 mb-2 h-px bg-gray-200` }/>
                                {
                                    React.Children.toArray(printers.map(item => {
                                        return (
                                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-3` }>
                                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                                    { item.inner_mac_address }
                                                </Text>
                                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => currentPrinter.device_name === item.device_name ? null : connectPrinter(item) }>
                                                    <Text style={ Tailwind`font-rubik-medium text-sm text-gray-400` }>
                                                        { currentPrinter.device_name === item.device_name ? "Terhubung" : "Hubungkan" }
                                                    </Text>
                                                </TouchableHighlight>
                                            </View>
                                        )
                                    }))
                                }
                            </View>
                            <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => setIsShow(false) }>
                                    <ButtonSecondary text={ "Kembali" }/>
                                </TouchableHighlight>
                            </View>
                        </View>
                    </View> : null
                }
                {
                    isShowLogout ?
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                                <View style={ Tailwind`w-full flex flex-col items-center` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                        Keluar Akun
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 text-center` }>
                                        Anda yakin ingin keluar?
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => handleLogout() }>
                                        <ButtonSecondary text={ "Keluar" }/>
                                    </TouchableHighlight>
                                    <View style={ Tailwind`w-3` }/>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIsShowLogout((value) => !value) } style={ Tailwind`flex-1` }>
                                        <ButtonPrimary text={ "Batal" }/>
                                    </TouchableHighlight>
                                </View>
                            </View>
                        </View> : null
                }
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        cart : state.cart,
        transactions: state.transactions,
        keywordProduct: state.keywordProduct,
        user: state.user,
        products: state.products,
        categories: state.categories,
        currentPrinter: state.currentPrinter,
        products: state.products
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
        changeWidthComponent : (value) => dispatch({ type: "CHANGE_WIDTHCOMPONENT", newValue: value }),
        changeCart: (value) => dispatch({ type: `CHANGE_CART`, newValue: value }),
        changeProducts: (value) => dispatch({ type: `CHANGE_PRODUCTS`, newValue: value }),
        changeTransactions: (value) => dispatch({ type: `CHANGE_TRANSACTIONS`, newValue: value }),
        changeKeywordProduct: (value) => dispatch({ type: `CHANGE_KEYWORDPRODUCT`, newValue: value }),
        changeCurrentPrinter: (value) => dispatch({ type: `CHANGE_CURRENTPRINTER`, newValue: value }),
        changeRangeProduct : (value) => dispatch({type: 'CHANGE_RANGEPRODUCT', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Transaction)